<?php

namespace app\modules\rmc\controllers;

use Yii;
use yii\web\Response;
use app\models\tblrmcinformation;
use app\models\tblrmccluster;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;

use app\models\tblrmc;
use app\models\tblrmcstatus;

/**
 * Default controller for the `rmc` module
 */
class ResearchinfoController extends Controller
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

    public function actionRmclist()
    {
        $txtSearch = $_GET['txtSearch'];
        $txtStatusId = $_GET['txtStatusId'];

        if ($txtSearch == '') {
            $txtSearch = '.*';
        }

        if ($txtStatusId == '') {
            $txtStatusId = '.*';
        }

        $stmt = "SELECT tblrmc.RMCId, tblrmc.RMCTitle, tblrmc.UserId, tblrmcstatus.Status, tblrmc.TransactionDate 
        FROM tblrmc 
        INNER JOIN tblrmcstatus ON tblrmcstatus.StatusId = tblrmc.StatusId 
		WHERE tblrmc.UserId = " . Yii::$app->user->identity->UserId . " AND tblrmc.RMCTitle REGEXP '$txtSearch' 
        AND tblrmc.StatusId REGEXP '$txtStatusId' 
		ORDER BY tblrmc.RMCId ASC";

        $data = Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }


    public function actionCreateresearchinfo()
    {
        $RMCInformationId = Yii::$app->request->get('RMCInformationId');

        if ($RMCInformationId) {
            $model = Tblrmcinformation::findOne(['RMCInformationId' => $RMCInformationId]);
        } else {
            $model = new Tblrmcinformation();
        }

        // Fetch cluster names from tblrmccluster
        $clusters = Tblrmccluster::find()->select(['RMCCluster'])->indexBy('RMCClusterId')->column();

        return $this->renderAjax('create', [
            'model' => $model,
            'clusters' => $clusters, // Pass clusters list to view
        ]);
    }


    public function actionCreate()
    {
        $userId = Yii::$app->user->identity->UserId;
        $RMCId = base64_decode(Yii::$app->request->post('RMCId'));

        // Check if RMCId record already exists 
        $model = tblrmcinformation::findOne(['RMCId' => $RMCId]);

        if (!$model) {
            $model = new tblrmcinformation();
        }

        $data = Yii::$app->request->post('formData');


        $datadecoded = json_decode($data);

        $arrayData = array();
        $i = 0;

        foreach ($datadecoded as $fieldObject) {
            $arrayData[$i] = $fieldObject->value;

            $i++;
        }

        // Set the data
        $model->RMCId = $RMCId;
        $model->RMCClusterId = $arrayData[1];
        $model->RMCInformationFieldOfResearch = $arrayData[2];
        $model->RMCInformationResearchDuration = $arrayData[3];
        $model->RMCInformationStartDate = $arrayData[4];
        $model->RMCInformationEndDate = $arrayData[5];
        $model->RMCInformationResearchLocation = $arrayData[6];

        $model->UserId = $userId;

        if ($model->save()) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => true, 'RMCInformationId' => $model->RMCInformationId];
        } else {
            return ['success' => false, 'message' => 'Failed to save data.'];
        }
    }

    public function actionEditresearchinfo()
    {
        $RMCId = base64_decode(Yii::$app->request->get('RMCId'));

        if ($RMCId) {
            $model = Tblrmcinformation::findOne(['RMCId' => $RMCId]);
        } else {
            $model = new Tblrmcinformation();
        }

        // Fetch cluster names from tblrmccluster
        $clusters = Tblrmccluster::find()->select(['RMCCluster'])->indexBy('RMCClusterId')->column();

        return $this->renderAjax('edit', [
            'model' => $model,
            'clusters' => $clusters, // Pass clusters list to view
        ]);        
    }

    public function actionEdit()
    {
        $userId = Yii::$app->user->identity->UserId;
        $RMCId = base64_decode(Yii::$app->request->post('RMCId'));

        // Check if RMCId record already exists 
        $model = tblrmcinformation::findOne(['RMCId' => $RMCId]);

        if (!$model) {
            $model = new tblrmcinformation();
        }

        $data = Yii::$app->request->post('formData');
        $datadecoded = json_decode($data);
        $arrayData = array();
        $i = 0;

        foreach ($datadecoded as $fieldObject) {
            $arrayData[$i] = $fieldObject->value;
            $i++;
        }

        // Set the data
        $model->RMCClusterId = $arrayData[1];
        $model->RMCInformationFieldOfResearch = $arrayData[2];
        $model->RMCInformationResearchDuration = $arrayData[3];
        $model->RMCInformationStartDate = $arrayData[4];
        $model->RMCInformationEndDate = $arrayData[5];
        $model->RMCInformationResearchLocation = $arrayData[6];

        $model->UserId = $userId;

        if ($model->save()) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => true, 'RMCInformationId' => $model->RMCInformationId];
        } else {
            return ['success' => false, 'message' => 'Failed to save data.'];
        }
    }


    public function beforeAction($action)
    {
        if (!isset(Yii::$app->user->identity->UserId)) {
            //echo '<script>alert("login lah");</script>';
            return Yii::$app->response->redirect(['site/login'])->send();
        }
        return parent::beforeAction($action);
    }


}