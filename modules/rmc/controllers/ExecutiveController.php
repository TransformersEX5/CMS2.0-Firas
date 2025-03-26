<?php

namespace app\modules\rmc\controllers;
use Yii;
use yii\web\Response;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;
use app\models\tblrmcSummary;



class ExecutiveController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreateexecutive()
    {
        $RMCSummaryId = Yii::$app->request->get('RMCSummaryId');

        if ($RMCSummaryId) {
            $model = TblrmcSummary::findOne(['RMCSummaryId ' => $RMCSummaryId]);
        } else {
            $model = new TblrmcSummary();
        }

        return $this->renderAjax('create', ['model' => $model]);
    }

    public function actionCreate()
    {
        $userId = Yii::$app->user->identity->UserId;
        $RMCId = base64_decode (Yii::$app->request->post('RMCId'));
    
        // Check if RMCId record already exists 
        $model = tblrmcsummary::findOne(['RMCId' => $RMCId]);

         if (!$model) {
        $model = new tblrmcsummary();
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
        $model->RMCSummaryBackground = $arrayData[1];
        $model->RMCSummaryResearchObjective = $arrayData[2];
        $model->RMCSummarySpecificObjective1 = $arrayData[3];
        $model->RMCSummarySpecificObjective2 = $arrayData[4];
        $model->RMCSummarySpecificObjective3 = $arrayData[5];
        $model->RMCSummaryReseachPublication = $arrayData[6];
        $model->RMCSummaryFinding = $arrayData[7];
        $model->RMCSummaryPotentialApplication = $arrayData[8];
        $model->RMCSummaryNoOfGraduate = $arrayData[9];

        $model->UserId = $userId;

        if ($model->save()) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => true, 'RMCSummaryId' => $model->RMCSummaryId];
        } else {
            return ['success' => false, 'message' => 'Failed to save data.'];
        }
    }

    public function actionEditexecutive()
    {
        $RMCId = base64_decode (Yii::$app->request->get('RMCId'));

        if ($RMCId) {
            $model = Tblrmcsummary::findOne(['RMCId' => $RMCId]);
        } else {
            $model = new Tblrmcsummary();
        }

        return $this->renderAjax('edit', ['model' => $model]);
    }

    public function actionEdit()
    {
        $userId = Yii::$app->user->identity->UserId;
        $RMCId = base64_decode (Yii::$app->request->post('RMCId'));

        // Check if RMCId record already exists 
        $model = tblrmcsummary::findOne(['RMCId' => $RMCId]);

        if (!$model) {
            $model = new tblrmcsummary();
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
        $model->RMCSummaryBackground = $arrayData[1];
        $model->RMCSummaryResearchObjective = $arrayData[2];
        $model->RMCSummarySpecificObjective1 = $arrayData[3];
        $model->RMCSummarySpecificObjective2 = $arrayData[4];
        $model->RMCSummarySpecificObjective3 = $arrayData[5];
        $model->RMCSummaryReseachPublication = $arrayData[6];
        $model->RMCSummaryFinding = $arrayData[7];
        $model->RMCSummaryPotentialApplication = $arrayData[8];
        $model->RMCSummaryNoOfGraduate = $arrayData[9];

        $model->UserId = $userId;

        if ($model->save()) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => true, 'RMCSummaryId' => $model->RMCSummaryId];
        } else {
            return ['success' => false, 'message' => 'Failed to save data.'];
        }
    }

}
