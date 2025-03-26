<?php

namespace app\controllers;
use Yii;
use app\models\Tbladdress;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AddressController implements the CRUD actions for Tbladdress model.
 */
class AddressController extends Controller
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
     * Lists all Tbladdress models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tbladdress::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'ApplicationId' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tbladdress model.
     * @param int $ApplicationId Application ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ApplicationId)
    {
        return $this->render('view', [
            'model' => $this->findModel($ApplicationId),
        ]);
    }

    /**
     * Creates a new Tbladdress model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tbladdress();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'ApplicationId' => $model->ApplicationId]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tbladdress model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ApplicationId Application ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ApplicationId)
    {
        $model = $this->findModel($ApplicationId);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ApplicationId' => $model->ApplicationId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tbladdress model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $ApplicationId Application ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ApplicationId)
    {
        $this->findModel($ApplicationId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tbladdress model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ApplicationId Application ID
     * @return Tbladdress the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ApplicationId)
    {
        if (($model = Tbladdress::findOne(['ApplicationId' => $ApplicationId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
