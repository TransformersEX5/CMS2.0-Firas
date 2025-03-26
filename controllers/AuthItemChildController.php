<?php

namespace app\controllers;

use Yii;
use app\models\AuthItemChild;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;
use yii\web\ForbiddenHttpException;

/**
 * AuthItemChildController implements the CRUD actions for AuthItemChild model.
 */
class AuthItemChildController extends Controller
{

    public $modelClass = 'app\models\AuthItemChild';

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
                        'delete' => ['GET'],
                    ],
                ],
            ]
        );
    }

    

    public function actions()
    {
        $actions = parent::actions();
    //     unset($actions['create']);
    //     unset($actions['update']);
    //    // unset($actions['delete']);
    //     unset($actions['view']);
    //     unset($actions['index']);
        return $actions;
    }

    public function actionAuthitemchildlist()
    {
        $model = new AuthItemChild();

        $output = [];
        $output['data'] = '';

        $data = $model->getAuthitemchildlist();
        $output['data'] = $data;

        if (count($output) > 0) {
            return json_encode($output);
        } else {
            return json_encode($output);
        }
    }


    /**
     * Lists all AuthItemChild models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AuthItemChild::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'parent' => SORT_DESC,
                    'child' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItemChild model.
     * @param string $parent Parent
     * @param string $child Child
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($parent, $child)
    {

        if(yii::$app->user->can('AuthItemChild-View'))
        {

            return $this->renderAjax('view', [
                'model' => $this->findModel($parent, $child),
            ]);

        }else {

        
            return "Sorry , your access is denied";

        
        }
    }

    /**
     * Creates a new AuthItemChild model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {  

      

        // if(yii::$app->user->can('AuthItemChild-Create'))
        // {

            $model = new AuthItemChild();

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
                return $this->redirect(Yii::$app->homeUrl . 'auth-item-child/index');
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
     * Updates an existing AuthItemChild model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $parent Parent
     * @param string $child Child
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($parent, $child)
    {
        

        

        // if(yii::$app->user->can('AuthItemChild-Update'))
        // {

            $model = $this->findModel($parent, $child);

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
                return $this->redirect(Yii::$app->homeUrl . 'auth-item-child/index');
            }
    
            return $this->renderAjax('update', [
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
     * Deletes an existing AuthItemChild model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $parent Parent
     * @param string $child Child
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($parent, $child)
    {
        $this->findModel($parent, $child)->delete();

        return $this->redirect(['index']);

        Yii::$app->session->setFlash(
                'success',
                'Record  successfully delete.'
            );


        
    }

    /**
     * Finds the AuthItemChild model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $parent Parent
     * @param string $child Child
     * @return AuthItemChild the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($parent, $child)
    {
        if (($model = AuthItemChild::findOne(['parent' => $parent, 'child' => $child])) !== null) {
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
