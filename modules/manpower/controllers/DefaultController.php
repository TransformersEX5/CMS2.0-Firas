<?php

namespace app\modules\manpower\controllers;

use Yii;
use yii\web\Controller;
use app\models\Tblcareer;
use app\models\Tblcareerapprovalsetup;
use app\models\Tblcareerapprovalstatus;
use app\models\Tblhod;
use app\models\Tbluser;
use yii\web\Response;

/**
 * Default controller for the `manpower` module
 */
class DefaultController extends Controller
{
    public $layout = '@app/views/layouts/lexapurple_layouts';

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRequest()
    {
        $CareerId = base64_decode(Yii::$app->request->get('id', 0));
        $UserId = Yii::$app->user->identity->UserId;

        if ($CareerId == NULL) 
        {
            $model = new Tblcareer();
        } 
        else 
        {
            $model = Tblcareer::findOne($CareerId);
            $CurrentStatus = Tblcareerapprovalstatus::findOne(['CareerId' => $CareerId, 'CurrentStatusId' => 1])->CareerApprovalSetupId ?? 0;

            $sql = "SELECT tblcareer.CareerId, tblcareerapprovalstatus.Remarks, CONCAT(SetupDesc2, '<br>Date/Time: <strong>',tblcareerapprovalstatus.TransactionDate, '</strong><br> Responsible: <strong>', FullName, '</strong>') AS StatusDetails
            from tblcareer
            INNER JOIN tblcareerapprovalstatus ON tblcareerapprovalstatus.CareerId = tblcareer.CareerId
            INNER JOIN tblcareerapprovalsetup ON tblcareerapprovalsetup.CareerApprovalSetupId = tblcareerapprovalstatus.CareerApprovalSetupId        
            INNER JOIN tbluser ON tbluser.UserId = tblcareerapprovalstatus.UserId
            WHERE 
            tblcareer.CareerId = $CareerId
            ORDER BY CareerApprovalStatusId ASC";

            $ApprovalHistory = Yii::$app->db->createCommand($sql)->queryAll();
        }

        if ($model->load(Yii::$app->request->post())) 
        {
            $model->UserId = $UserId;

            if (!$model->save()) 
            {
                return $this->render('request', ['model' => $model]);
            } 
            else 
            {
                if($model->StatusId == 2)
                {
                    $HodUserId = $this->getHodUserId(Yii::$app->user->identity->Hod1);
                    $CareerApprovalStatus = [1 => [2, $UserId], 2 => [3, $HodUserId]];

                    // die(print_r($CareerApprovalStatus));
                    foreach($CareerApprovalStatus as $CareerApprovalStatus)
                    {
                        Tblcareerapprovalstatus::updateAll(['CurrentStatusId' => 0], ['CareerId' => $model->CareerId]);
                        $modelApproval = new Tblcareerapprovalstatus();
                        $modelApproval->CareerId = $model->CareerId;
                        $modelApproval->CareerApprovalSetupId = $CareerApprovalStatus[0];
                        $modelApproval->CurrentStatusId = 1;
                        $modelApproval->UserId = $CareerApprovalStatus[1];
                        $modelApproval->save();
                    }
                }

                return Yii::$app->response->redirect(['manpower']);
            }
        }

        return $this->render('request', ['model' => $model, 'CurrentStatus' => $CurrentStatus ?? 0, 'ApprovalHistory' => $ApprovalHistory ?? 0]);
    }

    public function actionView()
    {
        $CareerId = base64_decode(Yii::$app->request->get('id', 0));

        $model = Tblcareer::findOne($CareerId);
        $CurrentCareerApprovalSetupId = Tblcareerapprovalstatus::findOne(['CareerId' => $model->CareerId, 'CurrentStatusId' => 1])->CareerApprovalSetupId;
        $StatusDesc = Tblcareerapprovalsetup::findOne(['CareerApprovalSetupId' => $CurrentCareerApprovalSetupId])->SetupDesc1; 

        $sql = "SELECT tblcareer.CareerId, tblcareerapprovalstatus.Remarks, CONCAT(SetupDesc2, '<br>Date/Time: <strong>',tblcareerapprovalstatus.TransactionDate, '</strong><br> Responsible: <strong>', FullName, '</strong>') AS StatusDetails
        from tblcareer
        INNER JOIN tblcareerapprovalstatus ON tblcareerapprovalstatus.CareerId = tblcareer.CareerId
        INNER JOIN tblcareerapprovalsetup ON tblcareerapprovalsetup.CareerApprovalSetupId = tblcareerapprovalstatus.CareerApprovalSetupId        
        INNER JOIN tbluser ON tbluser.UserId = tblcareerapprovalstatus.UserId
        WHERE 
        tblcareer.CareerId = $CareerId
        ORDER BY CareerApprovalStatusId DESC";

        $ApprovalHistory = Yii::$app->db->createCommand($sql)->queryAll();

        return $this->render('view', ['model' => $model, 'ApprovalHistory' => $ApprovalHistory, 
        'StatusDesc' => $StatusDesc]);
    }

    public function actionGetdraftlist()
    {
        $UserId = Yii::$app->user->identity->UserId;

        $sql = "SELECT tblcareer.CareerId, PositionName, TransDate, EndDate, FullName, BranchName, SetupDesc2, CareerApprovalSetupId AS CareerStatusId
        from tblcareer
        INNER JOIN tblposition ON tblposition.PositionId = tblcareer.PositionId
        INNER JOIN tbluser ON tbluser.UserId = tblcareer.UserId
        INNER JOIN tblbranch ON tblbranch.BranchId = tblcareer.BranchId
        INNER JOIN tblcareerapprovalsetup ON tblcareerapprovalsetup.CareerApprovalSetupId = tblcareer.StatusId        

        WHERE 
        tblcareer.StatusId = 1 
        AND tblcareer.UserId = $UserId
        ORDER BY TransDate DESC";

        $data = Yii::$app->db->createCommand($sql)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['data' => $data];
    }

    public function actionGetpendingapprovallist()
    {
        $UserId = Yii::$app->user->identity->UserId;
        $DepartmentId = Yii::$app->user->identity->DepartmentId;

        $sql = "SELECT tblcareer.CareerId, PositionName, SetupDesc2, TransDate, EndDate, FullName, BranchName,
        tblcareerapprovalstatus.CareerApprovalSetupId AS CareerStatusId
        from tblcareer
        INNER JOIN tblposition ON tblposition.PositionId = tblcareer.PositionId
        INNER JOIN tbluser ON tbluser.UserId = tblcareer.UserId
        INNER JOIN tblbranch ON tblbranch.BranchId = tblcareer.BranchId
        INNER JOIN tblcareerapprovalstatus ON tblcareerapprovalstatus.CareerId = tblcareer.CareerId
        INNER JOIN tblcareerapprovalsetup ON tblcareerapprovalsetup.CareerApprovalSetupId = tblcareerapprovalstatus.CareerApprovalSetupId        
		WHERE 
        tblcareerapprovalstatus.CareerApprovalSetupId in (3, 7, 11, 15, 19, 5, 9, 13, 17)
        AND CurrentStatusId = 1 
        -- AND tblcareer.UserId = $UserId
        AND tblcareer.FacultyId = $DepartmentId
        ORDER BY tblcareerapprovalstatus.TransactionDate DESC";

        $data = Yii::$app->db->createCommand($sql)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['data' => $data];
    }

    public function actionGetrejectedlist()
    {
        $UserId = Yii::$app->user->identity->UserId;
        $DepartmentId = Yii::$app->user->identity->DepartmentId;

        $sql = "SELECT tblcareer.CareerId, PositionName, SetupDesc2, TransDate, EndDate, FullName, BranchName,
        tblcareerapprovalstatus.CareerApprovalSetupId AS CareerStatusId
        from tblcareer
        INNER JOIN tblposition ON tblposition.PositionId = tblcareer.PositionId
        INNER JOIN tbluser ON tbluser.UserId = tblcareer.UserId
        INNER JOIN tblbranch ON tblbranch.BranchId = tblcareer.BranchId
        INNER JOIN tblcareerapprovalstatus ON tblcareerapprovalstatus.CareerId = tblcareer.CareerId
        INNER JOIN tblcareerapprovalsetup ON tblcareerapprovalsetup.CareerApprovalSetupId = tblcareerapprovalstatus.CareerApprovalSetupId        
		WHERE 
        tblcareerapprovalstatus.CareerApprovalSetupId in (6, 10, 14, 18)
        AND CurrentStatusId = 1 
        AND tblcareer.FacultyId = $DepartmentId
        -- AND tblcareer.UserId = $UserId
        ORDER BY tblcareerapprovalstatus.TransactionDate DESC";

        $data = Yii::$app->db->createCommand($sql)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['data' => $data];
    }

    public function actionGetactiverequestslist()
    {
        $UserId = Yii::$app->user->identity->UserId;
        $DepartmentId = Yii::$app->user->identity->DepartmentId;

        $sql = "SELECT tblcareer.CareerId, PositionName, SetupDesc2, TransDate, EndDate, FullName, BranchName,
        tblcareerapprovalstatus.CareerApprovalSetupId AS CareerStatusId
        from tblcareer
        INNER JOIN tblposition ON tblposition.PositionId = tblcareer.PositionId
        INNER JOIN tbluser ON tbluser.UserId = tblcareer.UserId
        INNER JOIN tblbranch ON tblbranch.BranchId = tblcareer.BranchId
        INNER JOIN tblcareerapprovalstatus ON tblcareerapprovalstatus.CareerId = tblcareer.CareerId
        INNER JOIN tblcareerapprovalsetup ON tblcareerapprovalsetup.CareerApprovalSetupId = tblcareerapprovalstatus.CareerApprovalSetupId        
		WHERE tblcareerapprovalstatus.CareerApprovalSetupId = 20
        AND CurrentStatusId = 1 
        AND tblcareer.FacultyId = $DepartmentId
        -- AND FIND_IN_SET($UserId, tblcareerapprovalstatus.UserId) > 0
        ORDER BY tblcareerapprovalstatus.TransactionDate DESC";

        $data = Yii::$app->db->createCommand($sql)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['data' => $data];
    }

    public function actionGetclosedrequestslist()
    {
        $UserId = Yii::$app->user->identity->UserId;
        $DepartmentId = Yii::$app->user->identity->DepartmentId;

        $sql = "SELECT tblcareer.CareerId, PositionName, SetupDesc2, TransDate, EndDate, FullName, BranchName,
        tblcareerapprovalstatus.CareerApprovalSetupId AS CareerStatusId
        from tblcareer
        INNER JOIN tblposition ON tblposition.PositionId = tblcareer.PositionId
        INNER JOIN tbluser ON tbluser.UserId = tblcareer.UserId
        INNER JOIN tblbranch ON tblbranch.BranchId = tblcareer.BranchId
        INNER JOIN tblcareerapprovalstatus ON tblcareerapprovalstatus.CareerId = tblcareer.CareerId
        INNER JOIN tblcareerapprovalsetup ON tblcareerapprovalsetup.CareerApprovalSetupId = tblcareerapprovalstatus.CareerApprovalSetupId        
		WHERE tblcareerapprovalstatus.CareerApprovalSetupId = 21
        AND CurrentStatusId = 1 
        AND tblcareer.FacultyId = $DepartmentId
        -- AND FIND_IN_SET($UserId, tblcareerapprovalstatus.UserId) > 0
        ORDER BY tblcareerapprovalstatus.TransactionDate DESC";

        $data = Yii::$app->db->createCommand($sql)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['data' => $data];
    }

    public function actionCheckrequester()
    {
        $UserId = Yii::$app->user->identity->UserId;
        $CareerId = Yii::$app->request->post('CareerId');

        $sql = "SELECT tblcareer.UserId
        from tblcareer
        WHERE tblcareer.CareerId = $CareerId
        AND tblcareer.UserId = $UserId
        ORDER BY TransDate DESC";

        $data = Yii::$app->db->createCommand($sql)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;
        
        if(empty($data))
        {
            return ['allow' => 'No'];
        }

        return ['allow' => 'Yes'];
    }

    public function getHodUserId($HodId)
    {
        return Tblhod::findOne(['HodId' => $HodId])->UserId;
    }
}
