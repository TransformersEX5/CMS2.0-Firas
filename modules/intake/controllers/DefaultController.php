<?php

namespace app\modules\intake\controllers;

use app\modules\intake\models\tblintake;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;

/**
 * DefaultController implements the CRUD actions for tblintake model.
 */
class DefaultController extends Controller
{

    public $layout ='@app/views/layouts/lexapurple_layouts';
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


    
    public function actionIntakelist()
    {
        $model = new Tblintake();

        $output = [];
        $output['data'] = '';

        $data = $model->getIntakelist();
        $output['data'] = $data;

        if (count($output) > 0) {
            return json_encode($output);
        } else {
            return json_encode($output);
        }
    }

    /**
     * Lists all tblintake models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => tblintake::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'IntakeId' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single tblintake model.
     * @param int $IntakeId Intake ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($IntakeId)
    {
        return $this->render('view', [
            'model' => $this->findModel($IntakeId),
        ]);
    }

    /**
     * Creates a new tblintake model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new tblintake();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'IntakeId' => $model->IntakeId]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing tblintake model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $IntakeId Intake ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($IntakeId)
    {
        $model = $this->findModel($IntakeId);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'IntakeId' => $model->IntakeId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing tblintake model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $IntakeId Intake ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($IntakeId)
    {
        $this->findModel($IntakeId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the tblintake model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $IntakeId Intake ID
     * @return tblintake the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($IntakeId)
    {
        if (($model = tblintake::findOne(['IntakeId' => $IntakeId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
