<?php

namespace app\modules\profile\controllers;

use Yii;
use app\models\Tbluser;
use app\models\Tbldocument;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\View;
use yii\web\Response;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;
use yii\helpers\URL;
use yii\web\ForbiddenHttpException;

/**
 * Default controller for the `profile` module
 */
class ServicesController extends Controller
{
    public $layout = '@app/views/layouts/lexapurple_layouts';
    /**
     * Renders the index view for the module
     * @return string
     */

    public function beforeAction($action)
    {
        if (!isset(Yii::$app->user->identity->UserId)) {
            //echo '<script>alert("login lah");</script>';
            return Yii::$app->response->redirect(['site/login'])->send();
        }
        return parent::beforeAction($action);
    }

    public function actionServiceslist()
    {
        $stmt = "SELECT
        UserServiceId,
        ServiceName,
        ServicePosition,
        CONCAT(tbluserservices.UploadFileName, ';', tbluserservices.UserId) as UploadFileName,
        Duration,
        TransDate,
        StaffId,
        UserId
        FROM
        tbluserservices
        where UserId = ".Yii::$app->user->identity->UserId;

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();    

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }
}
