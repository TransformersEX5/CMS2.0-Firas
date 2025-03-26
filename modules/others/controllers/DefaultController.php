<?php

namespace app\modules\others\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

use yii\helpers\FileHelper;
use yii\web\UploadedFile;

use app\models\tbluser;

/**
 * Default controller for the `others` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public $layout = '@app/views/layouts/lexapurple_layouts';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionHeadofprogram()
    {
        return $this->render('headofprogram');
    }

    public function actionPhonedirectory()
    {
        return $this->render('phonedirectory');
    }

    public function actionChangepassword()
    {
        $model = tbluser::findOne(['UserId' => Yii::$app->user->identity->UserId]);

        return $this->render('changepassword', ['model' => $model]);
    }

    public function actionHoplist()
    {
        $stmt = "SELECT tblprogram.ProgramId, tblprogramtype.ProgramTypeName, tblprogram.ProgramCode, tblprogram.ProgramName, 
        tblprogram.ProgramCode2, tblprogram.ProgramName2, tblprogram.ProgramType, tblstatusai.Status, 
        COALESCE(HOPUser.FullName, 'NULL') AS HOPName, COALESCE(PCUser.FullName, 'NULL' ) AS PCName
        FROM
        tblprogram
        INNER JOIN tblprogramtype ON tblprogramtype.ProgramTypeId = tblprogram.ProgramType
        INNER JOIN tblstatusai ON tblprogram.ProgramStatus = tblstatusai.StatusId
        LEFT JOIN tbluser HOPUser ON HOPUser.UserId = tblprogram.HOPId
        LEFT JOIN tbluser PCUser ON PCUser.UserId = tblprogram.PCId
        ORDER BY tblstatusai.StatusId ASC, tblprogram.ProgramCode ASC";

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }

    public function actionPhonedirectorylist()
    {
        $txtSearch = Yii::$app->request->get('txtSearch');
        $txtDepartmentId = Yii::$app->request->get('txtDepartmentId');

        if ($txtSearch == '') {
            $txtSearch = '.*';
        }

        if ($txtDepartmentId == '') {
            $txtDepartmentId = '.*';
        }

        $stmt = "SELECT tbluser.FullName, tblposition.PositionName, tbluser.EmailAddress, tbldepartment.DepartmentDesc, 
        tbluser.ExtensionNo, tbluser.HandSetNo 
        FROM tbluser 
        INNER JOIN tbldepartment ON tbldepartment.DepartmentId = tbluser.DepartmentId
        INNER JOIN tblposition ON tblposition.PositionId = tbluser.PositionId
        WHERE tbluser.FullName REGEXP '$txtSearch' AND tbluser.StatusId = 1 AND tbldepartment.DepartmentId REGEXP '$txtDepartmentId' 
        AND tbluser.FullName NOT LIKE '%-TBA%' AND tbluser.FullName NOT LIKE '%SA-%' AND tbldepartment.DeptCatId != 3
        ORDER BY tbluser.FullName";

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }

    public function actionUpdatepassword()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = tbluser::findOne([
            'EmailAddress' => Yii::$app->user->identity->EmailAddress,
            'StatusId' => 1
        ]);

        $model->UserPassword = md5(Yii::$app->request->post('newPassword'));
        $model->UserPasswordCrypt = password_hash(Yii::$app->request->post('newPassword'), PASSWORD_DEFAULT);
        $model->ChangePassword = date('Y-m-d');
        
        if($model->UserName == '')
        {
            $model->UserName = 'A';

        }
        if($model->HandSetNo == '')
        {
            $model->HandSetNo = 'A';

        }
        if($model->ExtensionNo == '')
        {
            $model->ExtensionNo = 'A';
        }

        if($model->save())
        {
            \Yii::$app->db->createCommand("CALL UpdateSysPassAllDatabase('$model->EmailAddress')")->queryAll();

            return ['success' => 'success'];
        }
        else
        {
            die(print_r($model->getErrors()));
        }

    }
}

// public function actionChangepassword()
// {
//     $model->UploadDocument = Yii::$app->request->post('UploadDocumentName');


// }

