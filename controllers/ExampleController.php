<?php

namespace app\controllers;

use Yii;
use app\models\Tblapplication;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ApplicationController implements the CRUD actions for Tblapplication model.
 */
class ExampleController extends Controller
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


    public function actionApplicationlist()
    {
        $model = new Tblapplication();

        $output = [];
        $output['data'] = '';

        $data = $model->getApplicationlist();
        $output['data'] = $data;

        if (count($output) > 0) {
            return json_encode($output);
        } else {
            return json_encode($output);
        }
    }

    public function actionTestapply() { 
        $message = "index action of the ExampleController"; 
        return $this->render("example",[ 
           'message' => $message 
        ]); 
     } 

    /**
     * Lists all Tblapplication models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $message = "index action of the ExampleController"; 
        return $this->render("example",[ 
           'message' => $message 
        ]); 
     } 

    /**
     * Displays a single Tblapplication model.
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
     * Creates a new Tblapplication model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tblapplication();

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
     * Updates an existing Tblapplication model.
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
     * Deletes an existing Tblapplication model.
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
     * Finds the Tblapplication model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ApplicationId Application ID
     * @return Tblapplication the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ApplicationId)
    {
        if (($model = Tblapplication::findOne(['ApplicationId' => $ApplicationId])) !== null) {
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
