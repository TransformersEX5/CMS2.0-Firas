<?php

namespace app\controllers;

use Yii;
use app\models\Tblprogramtype;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProgramtypeController implements the CRUD actions for Tblprogramtype model.
 */
class ProgramtypeController extends Controller
{

    public $layout = 'lexapurple_layouts';
    
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
     * Lists all Tblprogramtype models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tblprogramtype::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'ProgramTypeId' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tblprogramtype model.
     * @param int $ProgramTypeId Program Type ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ProgramTypeId)
    {
        return $this->render('view', [
            'model' => $this->findModel($ProgramTypeId),
        ]);
    }

    /**
     * Creates a new Tblprogramtype model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tblprogramtype();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'ProgramTypeId' => $model->ProgramTypeId]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tblprogramtype model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ProgramTypeId Program Type ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ProgramTypeId)
    {
        $model = $this->findModel($ProgramTypeId);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ProgramTypeId' => $model->ProgramTypeId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tblprogramtype model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $ProgramTypeId Program Type ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ProgramTypeId)
    {
        $this->findModel($ProgramTypeId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tblprogramtype model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ProgramTypeId Program Type ID
     * @return Tblprogramtype the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ProgramTypeId)
    {
        if (($model = Tblprogramtype::findOne(['ProgramTypeId' => $ProgramTypeId])) !== null) {
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
