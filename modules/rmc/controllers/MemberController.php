<?php

namespace app\modules\rmc\controllers;

use Yii;
use yii\web\Response;
use app\models\Tblprogrampchop;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;

use app\models\tblrmc;
use app\models\tblrmcmember;
use app\models\tblrmcdesignation;
use app\models\tblrmcservice;
use app\models\tblrmcstatus;

/**
 * Member controller for the `rmc` module
 */
class MemberController extends Controller
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

    public function actionGetmemberlist()
    {
        // $txtSearch = $_GET['txtSearch'];
        // $txtStatusId = $_GET['txtStatusId'];

        // if ($txtSearch == '') {
        //     $txtSearch = '.*';
        // }

        // if ($txtStatusId == '') {
        //     $txtStatusId = '.*';
        // }

        // $stmt = "SELECT tblrmc.RMCId, tblrmc.RMCTitle, tblrmc.UserId, tblrmcstatus.Status, tblrmc.TransactionDate 
        // FROM tblrmc 
        // INNER JOIN tblrmcstatus ON tblrmcstatus.StatusId = tblrmc.StatusId 
		// WHERE tblrmc.UserId = " . Yii::$app->user->identity->UserId . " AND tblrmc.RMCTitle REGEXP '$txtSearch' 
        // AND tblrmc.StatusId REGEXP '$txtStatusId' 
		// ORDER BY tblrmc.RMCId ASC";

        // $data = Yii::$app->db->createCommand($stmt)->queryAll();

        // Yii::$app->response->format = Response::FORMAT_JSON;

        // return ['data' => $data];
    }


    public function actionNewmember()
    {
        $RMCMemberId = Yii::$app->request->get('RMCMemberId');

        if($RMCMemberId)
        {
            $model = tblrmcmember::findOne(['RMCMemberId' => $RMCMemberId]);
        }
        else
        {
            $model = new tblrmcmember();
        }

        $checkboxItems = tblrmcdesignation::find()->select(['RMCDesignationId', 'RMCDesignation'])->where(['StatusId' => [1]])->asArray()->all();
        $checkboxItems2 = tblrmcservice::find()->select(['RMCServiceStatusId', 'RMCServiceStatus'])->where(['StatusId' => [1]])->asArray()->all();

        return $this->renderAjax('member', ['model' => $model, 'checkboxItems' => $checkboxItems, 'checkboxItems2' => $checkboxItems2]);
    }

    public function actionCreate()
    {
        // $RMCId = Yii::$app->request->post('RMCId');

        // if($RMCId)
        // {
        //     $model = tblrmc::findOne(['RMCId' => $RMCId]);
        // }
        // else
        // {
        //     $model = new tblrmc();
        // }


        // $data = Yii::$app->request->post('formData');
        // $datadecoded = json_decode($data);
        // $arrayData = array();
        // $i = 0;

        // foreach ($datadecoded as $fieldObject) {
        //     $arrayData[$i] = $fieldObject->value;
        //     $i++;
        // }

        // $model->RMCTitle = $arrayData[1];
        // $model->StatusId = $arrayData[2];
        // $model->UserId = Yii::$app->user->identity->UserId;

        // $model->save();
        
        // Yii::$app->response->format = Response::FORMAT_JSON;
        // return ['RMCId' => $model->RMCId];
    }
    
    public function actionDetails()
    {
        // $RMCId = base64_decode(Yii::$app->request->get('RMCId'));

        // if($RMCId)
        // {
        //     $stmt = "SELECT tblrmc.RMCTitle, tblrmc.UserId, tblrmcstatus.Status, tblrmc.TransactionDate 
        //     FROM tblrmc 
        //     INNER JOIN tbluser ON tbluser.UserId = tblrmc.UserId 
        //     INNER JOIN tblrmcstatus ON tblrmcstatus.StatusId = tblrmc.StatusId 
        //     WHERE tblrmc.RMCId = $RMCId";
    
        //     $data = Yii::$app->db->createCommand($stmt)->queryOne();
    
        //     return $this->render('details', ['data' => $data]);
        // }
        // else
        // {
        //     die('testing details page');
        // }
    }
}
