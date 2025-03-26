<?php

namespace app\controllers;

use yii;
class ManpowerController extends \yii\web\Controller
{

    
    public function actionIndex()
    {
        return $this->render('index');
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
