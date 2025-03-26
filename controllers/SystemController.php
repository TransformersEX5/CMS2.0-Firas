<?php

namespace app\controllers;
use yii;
use app\models\Tblsystem;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SystemController implements the CRUD actions for Tblsystem model.
 */
class SystemController extends Controller
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
     * Lists all Tblsystem models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tblsystem::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'SystemId' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tblsystem model.
     * @param int $SystemId System ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($SystemId)
    {
        return $this->render('view', [
            'model' => $this->findModel($SystemId),
        ]);
    }

    /**
     * Creates a new Tblsystem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tblsystem();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'SystemId' => $model->SystemId]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tblsystem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $SystemId System ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($SystemId)
    {
        $model = $this->findModel($SystemId);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'SystemId' => $model->SystemId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tblsystem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $SystemId System ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($SystemId)
    {
        $this->findModel($SystemId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tblsystem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $SystemId System ID
     * @return Tblsystem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($SystemId)
    {
        if (($model = Tblsystem::findOne(['SystemId' => $SystemId])) !== null) {
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
