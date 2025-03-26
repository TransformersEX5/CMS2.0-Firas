<?php

namespace app\controllers;


use Yii;
use app\Models\AuthItem;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;
use yii\web\Response;

/**
 * AuthItemController implements the CRUD actions for AuthItem model.
 */
class AuthItemController extends Controller
{

    public $modelClass = 'app\models\AuthItem';

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


    public function actionAuthitemlist()
    {
        $model = new AuthItem();

        $output = [];
        $output['data'] = '';

        $data = $model->getAuthitemlist();
        $output['data'] = $data;

        if (count($output) > 0) {
            return json_encode($output);
        } else {
            return json_encode($output);
        }
    }



    /**
     * Lists all AuthItem models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AuthItem::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'name' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $name Name
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($name)
    {
        // if(yii::$app->user->can('Department-View'))
        // {

            return $this->renderAjax('view', [
                'model' => $this->findModel($name),
            ]);

        // }else {

        
        //     return "Sorry , your access is denied";

        
        // }
    }

    /**
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {




        // if(yii::$app->user->can('Department-Create'))
        // {

            $model = new AuthItem();


            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
    
            if ($model->load(Yii::$app->request->post())) {
    
                $data = Yii::$app->request->post();
    
                if ($model->save(true)) {
                    // Save the form data to the database, send an email, etc.
                    //return ['success' => true];
    
                    Yii::$app->session->setFlash('success', "Record Successfully Create.");
                } else {
                    // return ['success' => false, 'errors' => $model->getErrors()];
    
                    Yii::$app->session->setFlash('error', "Record not saved.");
                }
                // return $this->redirect(['index']);
                return $this->redirect(Yii::$app->homeUrl . 'auth-item/index');
            }
    
            return $this->renderAjax('create', [
                'model' => $model,
            ]);


        // }else {

            
            //Yii::$app->session->setFlash('danger', "erro message");
            // throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
         
            // return "Sorry , your access is denied";

            //  echo '<script>  alert("xxx");              
            //         $("#modal-lg").modal("hide");
            //     </script>';

             
             //throw new ForbiddenHttpException("tak boleh");
        // }


    }

       
    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $name Name
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($name)
    {

        if(yii::$app->user->can('AuthItem-Update'))
        {

        $model = $this->findModel($name);
        

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
            return $this->redirect(Yii::$app->homeUrl . 'auth-item/index');
        
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
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $name Name
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($name)
    {
        //$this->findModel($name)->delete();

        //return $this->redirect(['index']);
    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $name Name
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($name)
    {
        if (($model = AuthItem::findOne(['name' => $name])) !== null) {
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
