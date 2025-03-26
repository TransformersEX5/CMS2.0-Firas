<?php

namespace app\modules\creditcontrol\controllers;

use yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;

use yii\web\View;
use app\models\Tblprogramregister;
use app\models\Tbldebtoraction;
use app\models\tbldebtgroup;
use yii\bootstrap5\ActiveForm;
use yii\web\Response;
use yii\helpers\FileHelper;




/**
 * Default controller for the `creditcontrol` module
 */
class DefaultController extends Controller
{

    public $layout = '@app/views/layouts/lexapurple_layouts';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        return $this->render('index');
    }


    public function actionCreditcontrollist()
    {

        $model = new Tblprogramregister();

        $output = [];
        $output['data'] = '';

        $data = $model->getCreditControlList();
        $output['data'] = $data;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $output;
    }


    public function actionFollowup()
    {
        $model = new Tbldebtoraction();

        return $this->renderAjax('followup', [
            'model' => $model,
        ]);
    }


    

    public function actionGroupcreate()
    {
        $model = new tbldebtgroup();

   
        // $data = Yii::$app->request->post();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model->UserId = Yii::$app->user->identity->UserId;
            return ActiveForm::validate($model);
        }

            //base on user login
             $model->UserId = Yii::$app->user->identity->UserId;
           
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['success' => 'success'];
                // You can also return additional data like the model ID: 'id' => $model->id
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
             //   return $model->getErrors() ;
                return ['success' => false, 'errors' => $model->getErrors()];
            }
        

        return $this->renderAjax('groupcreate', [
            'model' => $model,
        ]);
    }



    public function actionGroupAssign()
    {
        $model = new tbldebtgroup();

        return $this->renderAjax('group_assign', [
            'model' => $model,
        ]);
    }


    public function beforeAction($action)
    {
        if (!isset(Yii::$app->user->identity->UserId)) {
            //echo '<script>alert("login lah");</script>';
            return Yii::$app->response->redirect(['site/login'])->send();
        }



        return parent::beforeAction($action);
    }
}
