<?php

namespace app\controllers;

use Yii;
use app\models\Tbltrainingprovider;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;
/**
 * TrainingproviderController implements the CRUD actions for Tbltrainingprovider model.
 */
class TrainingproviderController extends Controller
{



    
    public $modelClass = 'app\models\Tbltrainingprovider';

    //public $layout = 'adminlte_layouts';
    public $layout = 'lexapurple_layouts';




    
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        unset($actions['view']);
        unset($actions['index']);
        return $actions;
    }

    public function actionTrainingproviderlist()
    {
        $model = new Tbltrainingprovider();

        $output = [];
        $output['data'] = '';

        $data = $model->getTrainingproviderlist();
        $output['data'] = $data;

        if (count($output) > 0) {
            return json_encode($output);
        } else {
            return json_encode($output);
        }
    }



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
     * Lists all Tbltrainingprovider models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tbltrainingprovider::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'TrainingProviderId' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tbltrainingprovider model.
     * @param int $TrainingProviderId Training Provider ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($TrainingProviderId)
    {
        if(yii::$app->user->can('TrainingProvider-View'))
        {

            return $this->renderAjax('view', [
                'model' => $this->findModel($TrainingProviderId),
            ]);

        }else {

        
            return "Sorry , your access is denied";

        
        }

    }
    /**
     * Creates a new Tbltrainingprovider model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if(yii::$app->user->can('TrainingProvider-Create'))
        {

            $model = new Tbltrainingprovider();

            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
    
            if ($model->load(Yii::$app->request->post())) {
    
                if ($model->save(true)) {
    
                    Yii::$app->session->setFlash('success', "Record  successfully create.");
                } else {
                    // return ['success' => false, 'errors' => $model->getErrors()];
    
                    Yii::$app->session->setFlash('error', "Record not saved.");
                }
                return $this->redirect(Yii::$app->homeUrl . 'trainingprovider/index');
            }
    
            return $this->renderAjax('create', [
                'model' => $model,
            ]);


        }else {

            return "Sorry , your access is denied";
        }

    }

    /**
     * Updates an existing Tbltrainingprovider model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $TrainingProviderId Training Provider ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($TrainingProviderId)
    {
   

        
        if(yii::$app->user->can('TrainingProvider-Update'))
        {

            $model = $this->findModel($TrainingProviderId);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

     
        


        if ($model->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post();

            // $ProgramCode = $data['Tbldepartment']['ProgramCode'];
            // $ProgramName = $data['Tbldepartment']['ProgramName'];
            // $ProgramType = $data['Tbldepartment']['ProgramType'];
            // $ProgramStatus = $data['Tblprogram']['ProgramStatus'];
            //  $model->UserId = Yii::$app->user->identity->UserId;

            if ($model->save(true)) {
                Yii::$app->session->setFlash('success', "Record  successfully Update.");
                // $respondata = [
                //     'status' => true,
                //     'message' => 'Data Saved '
                // ];

            } else {
                Yii::$app->session->setFlash('error', "Record not saved.");
            }
            // return $this->redirect(['index']);
            return $this->redirect(Yii::$app->homeUrl . 'trainingprovider/index');
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);


    }else {

            
        //Yii::$app->session->setFlash('danger', "erro message");
        // throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
     
       return "Sorry , your access is denied";

        //  echo '<script>  alert("xxx");              
        //         $("#modal-lg").modal("hide");
        //     </script>';

         
         //throw new ForbiddenHttpException("tak boleh");
    }


    }

    /**
     * Deletes an existing Tbltrainingprovider model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $TrainingProviderId Training Provider ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($TrainingProviderId)
    {
        $this->findModel($TrainingProviderId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tbltrainingprovider model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $TrainingProviderId Training Provider ID
     * @return Tbltrainingprovider the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($TrainingProviderId)
    {
        if (($model = Tbltrainingprovider::findOne(['TrainingProviderId' => $TrainingProviderId])) !== null) {
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
