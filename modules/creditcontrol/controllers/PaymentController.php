<?php

namespace app\modules\creditcontrol\controllers;

use yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;

use yii\web\View;
use app\models\Tblprogramregister;
use app\models\Tbldebtoraction;

use yii\bootstrap5\ActiveForm;
use yii\web\Response;
use yii\helpers\FileHelper;




/**
 * Default controller for the `creditcontrol` module
 */
class PaymentController extends Controller
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




    
    public function beforeAction($action)
    {
        if (!isset(Yii::$app->user->identity->UserId)) {
            //echo '<script>alert("login lah");</script>';
            return Yii::$app->response->redirect(['site/login'])->send();
        }

        return parent::beforeAction($action);
    }
}
