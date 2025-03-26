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
class TeachingpermitController extends Controller
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

    public function actionTeachingpermitlist()
    {
        $stmt = "SELECT
        tblteachingpermit.PermitId,
        CONCAT(tblteachingpermit.UploadFileName, ';', tblteachingpermit.StaffId) as UploadFileName,
        tblteachingpermit.StaffId,
        tblteachingpermit.PermitNo,
        DATE_FORMAT(tblteachingpermit.StartDate,'%d-%m-%Y') AS StartDate,
        DATE_FORMAT(tblteachingpermit.ExpiryDate,'%d-%m-%Y') AS ExpiryDate,
        tblteachingpermit.PermitStatus,
        tblteachingpermit.Remarks,
        tblteachingpermit.TransactionDate,
        tblteachingpermit.PermitLevel,
        REPLACE(tblteachingpermit.PermitSubjects, ',', '<br />') AS PermitSubjects
        
        FROM
        tblteachingpermit WHERE StaffId = " . Yii::$app->user->identity->UserId;

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }
}
