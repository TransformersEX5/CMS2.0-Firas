<?php

namespace app\modules\hostel\controllers;

use app\modules\hostel\models\tblhostel;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HostelController implements the CRUD actions for tblhostel model.
 */
class HostelController extends Controller
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
     * Lists all tblhostel models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => tblhostel::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'HostelId' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single tblhostel model.
     * @param int $HostelId Hostel ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($HostelId)
    {
        return $this->render('view', [
            'model' => $this->findModel($HostelId),
        ]);
    }

    /**
     * Creates a new tblhostel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new tblhostel();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'HostelId' => $model->HostelId]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing tblhostel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $HostelId Hostel ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($HostelId)
    {
        $model = $this->findModel($HostelId);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'HostelId' => $model->HostelId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing tblhostel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $HostelId Hostel ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($HostelId)
    {
        $this->findModel($HostelId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the tblhostel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $HostelId Hostel ID
     * @return tblhostel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($HostelId)
    {
        if (($model = tblhostel::findOne(['HostelId' => $HostelId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
