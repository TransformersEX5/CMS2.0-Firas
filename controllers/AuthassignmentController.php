<?php

namespace app\controllers;

use Yii;
use app\models\Authassignment;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;


class AuthassignmentController extends \yii\web\Controller
{


    // public function behaviors()
    // {
    //     return array_merge(
    //         parent::behaviors(),
    //         [
    //             'verbs' => [
    //                 'class' => VerbFilter::className(),
    //                 'actions' => [
    //                     'delete' => ['GET'],
    //                 ],
    //             ],
    //         ]
    //     );
    // }

    public function actionIndex()
    {
        //return $this->render('index');
    }



    
    public function actionAssingmentlist()
    {
        $model = new Authassignment();

        $output = [];
        $output['data'] = '';

        $data = $model->getAssingmentlist();
        $output['data'] = $data;

        if (count($output) > 0) {
            return json_encode($output);
        } else {
            return json_encode($output);
        }
    }

    public function actionDelete()
    {
        if ($this->request->isPost) {
            $data = Yii::$app->request->post();

            $assignmentid = $data['assignmentid'];

            //1-Delete data in table  Tbltrainingpaticipant    
            $this->findModel($assignmentid)->delete();
        }

        //return $this->redirect(['index']);
    }

    protected function findModel($assignmentid)
    {
        if (($model = Authassignment::findOne(['assignmentid' => $assignmentid])) !== null) {
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
