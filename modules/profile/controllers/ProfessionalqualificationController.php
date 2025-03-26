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
class ProfessionalqualificationController extends Controller
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

    public function actionProfessionalqualificationlist()
    {
        $stmt = "SELECT
        CONCAT(tbluserassociation.AssociationId,';',
        tbluserassociation.UserId,';','professionalqualification') as AssIdUserId,
        tbluser.UserId,
        CONCAT
        (tbluserassociation.UploadFileName, ';', tbluserassociation.UserId) as UploadFileName,
        tbluserassociation.AssociationId,
        tbluserassociation.UserId,
        tbluserassociation.AssBody,
        tbluserassociation.AssName,
        DATE_FORMAT(tbluserassociation.AssDateJoin, '%d-%m-%Y') as AssDateJoin,
        tbluserassociation.AssRegistrationNo,
        tbluserassociation.AssRefNo,
        tbluserassociation.AssRole,
        DATE_FORMAT(tbluserassociation.AssEndDate, '%d-%m-%Y') as AssEndDate,
        tbluserassociation.Remarks,
        tbluserassociation.TransactionDate,
        tbluserassociation.Duration,
        tbluserassociation.StaffId
        FROM
        tbluser
        INNER JOIN tbluserassociation ON tbluser.UserId = tbluserassociation.UserId
	    WHERE tbluser.UserId = ".Yii::$app->user->identity->UserId."
		ORDER BY tbluserassociation.AssociationId";

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();    

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }


}
