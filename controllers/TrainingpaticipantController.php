<?php

namespace app\controllers;

use app\models\Tbltrainingattandance;
use yii;
use app\models\Tbltrainingpaticipant;
use app\models\Tbltrainingduration;


use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrainingpaticipantController implements the CRUD actions for Tbltrainingpaticipant model.
 */
class TrainingpaticipantController extends Controller
{
    /**
     * @inheritDoc
     */
    // public function behaviors()
    // {
    //     return array_merge(
    //         parent::behaviors(),
    //         [
    //             'verbs' => [
    //                 'class' => VerbFilter::className(),
    //                 'actions' => [
    //                     'delete' => ['POST'],
    //                 ],
    //             ],
    //         ]
    //     );
    // }


    public function actionTrainingstafflist()
    {
        $model = new Tbltrainingpaticipant();

        $output = [];
        $output['data'] = '';

        $data = $model->getTrainingstafflist();
        $output['data'] = $data;


        if (count($output) > 0) {
            return json_encode($output);
        } else {
            return json_encode($output);
        }
    }



    public function actionTrainingparticipantlist()
    {
        $model = new Tbltrainingpaticipant();

        $output = [];
        $output['data'] = '';

        $data = $model->getTrainingparticipantlist();
        $output['data'] = $data;

        if (count($output) > 0) {
            return json_encode($output);
        } else {
            return json_encode($output);
        }
    }


    /**
     * Lists all Tbltrainingpaticipant models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tbltrainingpaticipant::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'ParticipantId' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tbltrainingpaticipant model.
     * @param int $ParticipantId Participant ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ParticipantId)
    {
        return $this->render('view', [
            'model' => $this->findModel($ParticipantId),
        ]);
    }

    /**
     * Creates a new Tbltrainingpaticipant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {

        $TrainingId = $_GET['txtTrainingId'];
        $model = new Tbltrainingpaticipant();

        $DataDuration = Tbltrainingduration::find()->where(['TrainingId' => $TrainingId])->all();


        if ($this->request->isAjax && $this->request->isPost) {

            $data = Yii::$app->request->post();

            $model->TrainingId = $_GET['txtTrainingId'];
            $model->UserId     = $data['txtUserId'];


            if ($model->save()) {
                //tolong belajar how to use batchInsert
                // Yii::$app->db->createCommand()->batchInsert(tbltrainingattandance, ['attribute1', 'attribute2'], $DataDuration)->execute();
                foreach ($DataDuration as $DataDuration) {
                    $attandance = new Tbltrainingattandance();
                    $attandance->TrainingDurationId = $DataDuration['TrainingDurationId'];
                    $attandance->TrainingId = $TrainingId;
                    $attandance->UserId = $model->UserId;
                    $attandance->AttandId = 0;    
                    $attandance->save();             

                }
            }
        }
    }

    /**
     * Updates an existing Tbltrainingpaticipant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ParticipantId Participant ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ParticipantId)
    {
        $model = $this->findModel($ParticipantId);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ParticipantId' => $model->ParticipantId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tbltrainingpaticipant model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $ParticipantId Participant ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
        if ($this->request->isPost) {
            $data = Yii::$app->request->post();

            $ParticipantId = $data['ParticipantId'];
            $TrainingId = $data['TrainingId'];
            $UserId = $data['UserId'];

            //1-Delete data in table  Tbltrainingpaticipant    
            $this->findModel($ParticipantId)->delete();

            //2-Delete data in table  Tbltrainingattandance           
            Tbltrainingattandance::deleteAll(['TrainingId' => $TrainingId, 'UserId' => $UserId]);


        }
        //return $this->redirect(['index']);
    }

    /**
     * Finds the Tbltrainingpaticipant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ParticipantId Participant ID
     * @return Tbltrainingpaticipant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ParticipantId)
    {
        if (($model = Tbltrainingpaticipant::findOne(['ParticipantId' => $ParticipantId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    
    public function beforeAction($action)
    {
        if (!isset(Yii::$app->user->identity->UserId))
        {
           //echo '<script>alert("login lah");</script>';
            return Yii::$app->response->redirect(['site/login'])->send();
        }
        return parent::beforeAction($action);    
    }

    
}
