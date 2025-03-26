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
class AcademicqualificationController extends Controller
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

    public function actionAcademicqualificationlist()
    {
        $stmt = "SELECT
        CONCAT(tblusereducation.EducationId,';',
        tblusereducation.UserId,';','educationadd') AS EduIdUserId,
        tblusereducation.EducationId,
        CONCAT
        (tblusereducation.UploadFileName, ';', tblusereducation.UserId) AS UploadFileName,
        tblusereducation.UserId,
        tblusereducation.ICPassportNo,
        tblusereducation.EducLevelId,
        tblusereducation.ProgramName,
        tblusereducation.EduUniName,
        tblusereducation.EduCourse,
        tblusereducation.EduMajoring,
        tblusereducation.EduCgpa,
        tblusereducation.ClassId,
        tblusereducation.EduYearComplete,
        tblusereducation.NationalityId,
        tblusereducation.TransactionDate,
        tblusereducation.StaffId,
        tbleducation.EducCode,
        tbleducation.EducName
        FROM tblusereducation
        INNER JOIN tbleducation ON tbleducation.EducLevelId = tblusereducation.EducLevelId 
		WHERE tblusereducation.UserId = ".Yii::$app->user->identity->UserId."
		ORDER BY tblusereducation.EduYearComplete";

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();    

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }


}
