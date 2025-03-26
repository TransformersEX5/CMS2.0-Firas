<?php

namespace app\controllers;
use yii;
use app\models\Tblprogramregister;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProgramregisterController implements the CRUD actions for Tblprogramregister model.
 */
class ProgramregisterController extends Controller
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
     * Lists all Tblprogramregister models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tblprogramregister::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'ProgramRegId' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tblprogramregister model.
     * @param int $ProgramRegId Program Reg ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ProgramRegId)
    {
        return $this->render('view', [
            'model' => $this->findModel($ProgramRegId),
        ]);
    }

    /**
     * Creates a new Tblprogramregister model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tblprogramregister();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'ProgramRegId' => $model->ProgramRegId]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tblprogramregister model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ProgramRegId Program Reg ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ProgramRegId)
    {
        $model = $this->findModel($ProgramRegId);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ProgramRegId' => $model->ProgramRegId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tblprogramregister model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $ProgramRegId Program Reg ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ProgramRegId)
    {
        $this->findModel($ProgramRegId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tblprogramregister model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ProgramRegId Program Reg ID
     * @return Tblprogramregister the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ProgramRegId)
    {
        if (($model = Tblprogramregister::findOne(['ProgramRegId' => $ProgramRegId])) !== null) {
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
