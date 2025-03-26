<?php

namespace app\controllers;

use app\Models\Tblmenpower;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MenpowerController implements the CRUD actions for Tblmenpower model.
 */
class MenpowerController extends Controller
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
     * Lists all Tblmenpower models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tblmenpower::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'ManPowerId' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tblmenpower model.
     * @param int $ManPowerId Man Power ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ManPowerId)
    {
        return $this->render('view', [
            'model' => $this->findModel($ManPowerId),
        ]);
    }

    /**
     * Creates a new Tblmenpower model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tblmenpower();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'ManPowerId' => $model->ManPowerId]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tblmenpower model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ManPowerId Man Power ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ManPowerId)
    {
        $model = $this->findModel($ManPowerId);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ManPowerId' => $model->ManPowerId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tblmenpower model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $ManPowerId Man Power ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ManPowerId)
    {
        $this->findModel($ManPowerId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tblmenpower model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ManPowerId Man Power ID
     * @return Tblmenpower the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ManPowerId)
    {
        if (($model = Tblmenpower::findOne(['ManPowerId' => $ManPowerId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
