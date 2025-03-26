<?php

namespace app\controllers;

use yii;
use app\models\Tbltrainingduration;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrainingdurationController implements the CRUD actions for Tbltrainingduration model.
 */
class TrainingdurationController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Tbltrainingduration models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tbltrainingduration::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'TrainingDurationId' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tbltrainingduration model.
     * @param int $TrainingDurationId Training Duration ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($TrainingDurationId)
    {
        return $this->render('view', [
            'model' => $this->findModel($TrainingDurationId),
        ]);
    }

    /**
     * Creates a new Tbltrainingduration model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tbltrainingduration();

        if ($this->request->isPost) {
            $data = Yii::$app->request->post();

            // print_r($_POST);

            $model->TrainingId          = $data['TrainingId'];
            $model->TrainingDate        = $data['txttrainingdate'];
            $model->TrainingTimeStart   = $data['txttimestart'];
            $model->TrainingTimeEnd     = $data['txttimeend'];

            $time1 = strtotime($data['txttimestart']);
            $time2 = strtotime($data['txttimeend']);
            $difference = round(abs($time2 - $time1) / 3600, 2);

            $model->TraningTotHours     = $difference;



            if ($model->save()) {
                //  return $this->redirect(['view', 'TrainingDurationId' => $model->TrainingDurationId]);
            }
        } else {
            $model->loadDefaultValues();
        }

        // return $this->render('create', [
        //     'model' => $model,
        // ]);
    }

    /**
     * Updates an existing Tbltrainingduration model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $TrainingDurationId Training Duration ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($TrainingDurationId)
    {
        $model = $this->findModel($TrainingDurationId);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'TrainingDurationId' => $model->TrainingDurationId]);
        }

        // return $this->render('update', [
        //     'model' => $model,
        // ]);
    }

    /**
     * Deletes an existing Tbltrainingduration model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $TrainingDurationId Training Duration ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
        if ($this->request->isPost) {
            $data = Yii::$app->request->post();

            $TrainingDurationId = $data['TrainingDurationId'];

            $this->findModel($TrainingDurationId)->delete();
        }
        //return $this->redirect(['index']);
    }

    /**
     * Finds the Tbltrainingduration model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $TrainingDurationId Training Duration ID
     * @return Tbltrainingduration the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($TrainingDurationId)
    {
        if (($model = Tbltrainingduration::findOne(['TrainingDurationId' => $TrainingDurationId])) !== null) {
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
