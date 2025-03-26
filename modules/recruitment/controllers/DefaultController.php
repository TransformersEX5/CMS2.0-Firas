<?php

namespace app\modules\recruitment\controllers;

use Yii;
use yii\web\Controller;
use app\models\Tblcareer;
use app\models\Tblcareerapprovalsetup;
use app\models\Tblcareerapprovalstatus;
use app\models\Tbldepartment;
use app\models\Tblhod;
use app\models\Tbluser;
use yii\web\Response;

/**
 * Default controller for the `recruitment` module
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

    public function actionApproval()
    {
        $CareerId = base64_decode(Yii::$app->request->get('id', 0));
        $UserId = Yii::$app->user->identity->UserId;

        $model = Tblcareer::findOne($CareerId);
        $modelNewApproval = new Tblcareerapprovalstatus();

        $CurrentCareerApprovalSetupId = Tblcareerapprovalstatus::findOne(['CareerId' => $model->CareerId, 'CurrentStatusId' => 1])->CareerApprovalSetupId;
        $CurrentLevelId = Tblcareerapprovalsetup::findOne(['CareerApprovalSetupId' => $CurrentCareerApprovalSetupId])->LevelId;
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

        if ($modelNewApproval->load(Yii::$app->request->post())) 
        {
            $modelNewApproval->CareerId = $model->CareerId;
            $modelNewApproval->UserId = $UserId;

            Tblcareerapprovalstatus::updateAll(['CurrentStatusId' => 0], ['CareerId' => $model->CareerId]);

            if($modelNewApproval->save())
            {
                //Only approve status will execute $NextLevelStatus array below
                $AllowProceedArray = [4, 8, 12, 16];

                if((in_array($modelNewApproval->CareerApprovalSetupId, $AllowProceedArray)))
                {
                    //Array's construction is ['CurrentApproverId']['NextAwaitingApproverId']
                    $AwaitingApproverId = [4 => 7, 8 => 11, 12 => 15, 16 => 19];
                    $AllApproverId = Tblcareerapprovalsetup::findOne(['CareerApprovalSetupId' => $AwaitingApproverId[$modelNewApproval->CareerApprovalSetupId]])->ApproverId;
                
                    Tblcareerapprovalstatus::updateAll(['CurrentStatusId' => 0], ['CareerId' => $model->CareerId]);
                    $modelAwaitingApproval = new Tblcareerapprovalstatus();
                    $modelAwaitingApproval->CareerId = $model->CareerId;
                    $modelAwaitingApproval->CareerApprovalSetupId = $AwaitingApproverId[$modelNewApproval->CareerApprovalSetupId];
                    $modelAwaitingApproval->CurrentStatusId = 1;

                    if($modelAwaitingApproval->CareerApprovalSetupId == 11)
                    {
                        $DeptCatId = Tbldepartment::findOne(['DepartmentId' => $model->FacultyId])->DeptCatId;
                        $SplitApproverId = explode(',', $AllApproverId);

                        if($DeptCatId == 1)
                        {
                            $modelAwaitingApproval->UserId = $SplitApproverId[0];
                        }
                        else
                        {
                            $modelAwaitingApproval->UserId = $SplitApproverId[1];
                        }
                    }
                    else
                    {
                        $modelAwaitingApproval->UserId = $AllApproverId;
                    }

                    if($modelAwaitingApproval->save())
                    {
                        if($model->load(Yii::$app->request->post()))
                        {
                            $model->save();
                        }
                    }
                }
            }
            
            return Yii::$app->response->redirect(['recruitment']);
        }

        return $this->render('approval', ['model' => $model, 'ApprovalHistory' => $ApprovalHistory, 
        'modelNewApproval' => $modelNewApproval, 'CurrentLevelId' => $CurrentLevelId,
        'StatusDesc' => $StatusDesc]);
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

        $sql = "SELECT tblcareer.CareerId, PositionName, SetupDesc2, TransDate, EndDate, FullName, BranchName,
        tblcareerapprovalstatus.CareerApprovalSetupId AS CareerStatusId
        from tblcareer
        INNER JOIN tblposition ON tblposition.PositionId = tblcareer.PositionId
        INNER JOIN tbluser ON tbluser.UserId = tblcareer.UserId
        INNER JOIN tblbranch ON tblbranch.BranchId = tblcareer.BranchId
        INNER JOIN tblcareerapprovalstatus ON tblcareerapprovalstatus.CareerId = tblcareer.CareerId
        INNER JOIN tblcareerapprovalsetup ON tblcareerapprovalsetup.CareerApprovalSetupId = tblcareerapprovalstatus.CareerApprovalSetupId        
		WHERE 
        tblcareerapprovalstatus.CareerApprovalSetupId not in (1, 6, 10, 14, 18, 20, 21)
        AND CurrentStatusId = 1 
        -- AND tblcareer.UserId = $UserId
        AND FIND_IN_SET($UserId, tblcareerapprovalstatus.UserId) > 0
        ORDER BY tblcareerapprovalstatus.TransactionDate DESC";

        $data = Yii::$app->db->createCommand($sql)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['data' => $data];
    }

    public function actionGetallrequestslist()
    {
        $UserId = Yii::$app->user->identity->UserId;
        $DepartmentId = Yii::$app->user->identity->DepartmentId;

        $sql = "SELECT tblcareer.CareerId, PositionName, SetupDesc2, TransDate, EndDate, FullName, BranchName,
        tblcareerapprovalstatus.CareerApprovalSetupId AS CareerStatusId,
        CONCAT('Requested by: <b>', FullName, '</b><br>Date/Time: <b>', TransDate,'</b>') AS TransDate
        -- CONCAT(PositionName, '<br><span style=font-size:11px;><b>Requested by: ', FullName, '</b></style>') AS PositionName
        from tblcareer
        INNER JOIN tblposition ON tblposition.PositionId = tblcareer.PositionId
        INNER JOIN tbluser ON tbluser.UserId = tblcareer.UserId
        INNER JOIN tblbranch ON tblbranch.BranchId = tblcareer.BranchId
        INNER JOIN tblcareerapprovalstatus ON tblcareerapprovalstatus.CareerId = tblcareer.CareerId
        INNER JOIN tblcareerapprovalsetup ON tblcareerapprovalsetup.CareerApprovalSetupId = tblcareerapprovalstatus.CareerApprovalSetupId        
		WHERE CurrentStatusId = 1 
        AND (tblcareer.FacultyId = $DepartmentId OR FIND_IN_SET($UserId, '4348,4510,4448,18,4028,69,4637') > 0)
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
        AND (tblcareer.FacultyId = $DepartmentId OR FIND_IN_SET($UserId, '4348,4510,4448,18,4028,69,4637') > 0)
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
        AND (tblcareer.FacultyId = $DepartmentId OR FIND_IN_SET($UserId, '4348,4510,4448,18,4028,69,4637') > 0)
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
        AND (tblcareer.FacultyId = $DepartmentId OR FIND_IN_SET($UserId, '4348,4510,4448,18,4028,69,4637') > 0)
        -- AND FIND_IN_SET($UserId, tblcareerapprovalstatus.UserId) > 0
        ORDER BY tblcareerapprovalstatus.TransactionDate DESC";

        $data = Yii::$app->db->createCommand($sql)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['data' => $data];
    }

    public function actionCheckapprover()
    {
        $UserId = Yii::$app->user->identity->UserId;
        $CareerId = Yii::$app->request->post('CareerId');

        $sql = "SELECT tblcareer.CareerId, PositionName, SetupDesc2, TransDate, EndDate, FullName, BranchName,
        tblcareerapprovalstatus.CareerApprovalSetupId AS CareerStatusId
        from tblcareer
        INNER JOIN tblposition ON tblposition.PositionId = tblcareer.PositionId
        INNER JOIN tbluser ON tbluser.UserId = tblcareer.UserId
        INNER JOIN tblbranch ON tblbranch.BranchId = tblcareer.BranchId
        INNER JOIN tblcareerapprovalstatus ON tblcareerapprovalstatus.CareerId = tblcareer.CareerId
        INNER JOIN tblcareerapprovalsetup ON tblcareerapprovalsetup.CareerApprovalSetupId = tblcareerapprovalstatus.CareerApprovalSetupId        
		WHERE 
        tblcareerapprovalstatus.CareerApprovalSetupId not in (1, 6, 10, 14, 18, 20, 21)
        AND CurrentStatusId = 1 
        AND tblcareer.CareerId = $CareerId
        AND FIND_IN_SET($UserId, tblcareerapprovalstatus.UserId) > 0
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
