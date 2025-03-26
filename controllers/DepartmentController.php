<?php

namespace app\controllers;

use Yii;
use app\models\Tbldepartment;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;
use yii\web\ForbiddenHttpException;

/**
 * DepartmentController implements the CRUD actions for Tbldepartment model.
 */
class DepartmentController extends Controller
{
    public $modelClass = 'app\models\Tbldepartment';

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

    public function actionDepartmentlist()
    {
        $model = new Tbldepartment();

        $output = [];
        $output['data'] = '';

        $data = $model->getDepartmentlist();
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
     * Lists all Tbldepartment models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tbldepartment::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'DepartmentId' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tbldepartment model.
     * @param int $DepartmentId Department ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($DepartmentId)
    {
        
        if(yii::$app->user->can('Department-View'))
        {

            return $this->renderAjax('view', [
                'model' => $this->findModel($DepartmentId),
            ]);

        }else {

        
            return "Sorry , your access is denied";

        
        }

    }

    /**
     * Creates a new Tbldepartment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {


        if(yii::$app->user->can('Department-Create'))
        {

            $model = new Tbldepartment();

            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
    
            if ($model->load(Yii::$app->request->post())) {
    
                $data = Yii::$app->request->post();
    
                $ProgramCode = $data['Tbldepartment']['DepartmentId'];
                $ProgramName = $data['Tbldepartment']['DepartmentId'];
                $ProgramType = $data['Tbldepartment']['DepartmentId'];
                //   $ProgramStatus = $data['Tblprogram']['ProgramStatus'];
    
                // $model->UserId = Yii::$app->user->identity->UserId;
    
    
                if ($model->save(true)) {
                    // Save the form data to the database, send an email, etc.
                    //return ['success' => true];
    
                    Yii::$app->session->setFlash('success', "Record " . $ProgramCode . " successfully create.");
                } else {
                    // return ['success' => false, 'errors' => $model->getErrors()];
    
                    Yii::$app->session->setFlash('error', "Record not saved.");
                }
                // return $this->redirect(['index']);
                return $this->redirect(Yii::$app->homeUrl . 'department/index');
            }
    
            return $this->renderAjax('create', [
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


    public function actionUpdate($DepartmentId)
    {



    if (yii::$app->user->can('Department-Update')) {

        $model = $this->findModel($DepartmentId);


        // if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
        //     $model->refresh();
        //     Yii::$app->response->format = Response::FORMAT_JSON;
        //     return json_encode(ActiveForm::validate($model));
        // } elseif ($model->load(Yii::$app->request->post()) && $model->save()) {

        // }

        //https://www.yiiframework.com/doc/guide/2.0/en/input-validation

        // if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
        //     Yii::$app->response->format = Response::FORMAT_JSON;
        //     echo json_encode(ActiveForm::validate($model));
        //     Yii::$app->end();
        // }

        // if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
        //     Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        //     return json_encode(ActiveForm::validate($model));
        // }

        // if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
        //     Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        //     echo json_encode(ActiveForm::validate($model));
        //     Yii::$app->end();
        // }





        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        if ($_POST) {

            $data = Yii::$app->request->post();

            $model->DepartmentDesc = $data['Tbldepartment']['DepartmentDesc'];
            $model->StatusId = $data['Tbldepartment']['StatusId'];
            $model->DeptCatId = $data['Tbldepartment']['DeptCatId'];
            $model->HODUserId = $data['Tbldepartment']['HODUserId'];
            $model->Department_iso = $data['Tbldepartment']['Department_iso'];
            $model->UserId = 15;

            // $model->UserId = Yii::$app->user->identity->UserId;

            if ($model->save(true)) {
                ///Yii::$app->session->setFlash('success', "Record  successfully Update.");

                $response = [
                    'status' => 1,
                    'message' => 'Record Successfully Update'
                ];

                // return json_encode(array('status' => 1, 'type' => 'success', 'message' => 'Contact created successfully.'));

                return json_encode($response);

            } else {
                //Yii::$app->session->setFlash('error', "Record not saved.");
                $response = [
                    'status' => 2,
                    'message' => 'Sorry , Record Not Saved'
                ];
                return json_encode($response);
            }
            // return $this->redirect(['index']);
            //return $this->redirect(Yii::$app->homeUrl . 'department/index');
        } else {

            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }

    } else {

        $response = [
            'status' => 3,
            'message' => 'Sorry , Your Access Is Denied'
        ];
        return json_encode($response);

        //Yii::$app->session->setFlash('danger', "erro message");
        // throw new \yii\web\HttpException(404, 'The requested Item could not be found.');

        // return "Sorry , your access is denied";

        //  echo '<script>  alert("xxx");              
        //         $("#modal-lg").modal("hide");
        //     </script>';

        //throw new ForbiddenHttpException("tak boleh");
    }

}



    /**
     * Updates an existing Tbldepartment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $DepartmentId Department ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdat_ori($DepartmentId)
    {

        
        if(yii::$app->user->can('Department-Update'))
        {

        $model = $this->findModel($DepartmentId);

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
            return $this->redirect(Yii::$app->homeUrl . 'department/index');
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
     * Deletes an existing Tbldepartment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $DepartmentId Department ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($DepartmentId)
    {
        $this->findModel($DepartmentId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tbldepartment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $DepartmentId Department ID
     * @return Tbldepartment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($DepartmentId)
    {
        if (($model = Tbldepartment::findOne(['DepartmentId' => $DepartmentId])) !== null) {
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