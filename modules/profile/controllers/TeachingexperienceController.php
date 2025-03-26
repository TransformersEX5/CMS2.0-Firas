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
class TeachingexperienceController extends Controller
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

    public function actionTeachingexperiencelist()
    {
        $stmt = "SELECT
        tblworkspecialization.WorkSpecName,
        CONCAT
        (tbluseremploymenthistory.UploadFileName, ';', tbluseremploymenthistory.UserId) as UploadFileName,
        tblworkspecialization1.WorkSpecName AS WorkSpecName1,
        tblworkspecialization2.WorkSpecName AS WorkSpecName2,
        tblroleofworkspecialization.RoleDesc,
        tblroleofworkspecialization1.RoleDesc AS RoleDesc1,
        tblroleofworkspecialization2.RoleDesc AS RoleDesc2,
        tbluseremploymenthistory.EmpCompanyId,
        tbluseremploymenthistory.UserId,
        tbluseremploymenthistory.EmpCompanyName,
        tbluseremploymenthistory.EmpPosition,
        tbluseremploymenthistory.EmpSalary,
        tbluseremploymenthistory.EmpAddress,
        tbluseremploymenthistory.NationalityId,
        DATE_FORMAT(tbluseremploymenthistory.EmpDateJoin, '%d-%m-%Y') AS EmpDateJoin,
        DATE_FORMAT(tbluseremploymenthistory.EmpDateEnd, '%d-%m-%Y') AS EmpDateEnd,
        tbluseremploymenthistory.EmpReasonLeaving,
        tbluseremploymenthistory.EmpRefereeName,
        tbluseremploymenthistory.EmpRefereeDesignation,
        tbluseremploymenthistory.EmpRefereeContact,
        tbluseremploymenthistory.WorkSpecId,
        tbluseremploymenthistory.WorkSpecId1,
        tbluseremploymenthistory.WorkSpecId2,
        tbluseremploymenthistory.RoleId,
        tbluseremploymenthistory.RoleId1,
        tbluseremploymenthistory.RoleId2,
        tbluseremploymenthistory.EmpDuration,
        tblusercorporatelevel.CorporateLevelDesc,
        tbluseremploymenthistory.CorporateLevelId
        FROM
        tbluseremploymenthistory
        LEFT JOIN tbluser ON tbluseremploymenthistory.UserId = tbluser.UserId
        LEFT JOIN tblnationality ON tbluseremploymenthistory.NationalityId = tblnationality.NationalityId
        LEFT JOIN tblworkspecialization ON tbluseremploymenthistory.WorkSpecId = tblworkspecialization.WorkSpecId
        LEFT JOIN tblworkspecialization AS tblworkspecialization1 ON tbluseremploymenthistory.WorkSpecId1 = tblworkspecialization1.WorkSpecId
        LEFT JOIN tblworkspecialization AS tblworkspecialization2 ON tbluseremploymenthistory.WorkSpecId2 = tblworkspecialization2.WorkSpecId
        LEFT JOIN tblroleofworkspecialization ON tbluseremploymenthistory.RoleId = tblroleofworkspecialization.RoleId
        LEFT JOIN tblroleofworkspecialization AS tblroleofworkspecialization1 ON tbluseremploymenthistory.RoleId1 = tblroleofworkspecialization1.RoleId
        LEFT JOIN tblroleofworkspecialization AS tblroleofworkspecialization2 ON tbluseremploymenthistory.RoleId2 = tblroleofworkspecialization2.RoleId
        LEFT JOIN tblusercorporatelevel ON tbluseremploymenthistory.CorporateLevelId = tblusercorporatelevel.CorporateLevelId
        WHERE tbluser.UserId = " . Yii::$app->user->identity->UserId . " AND TypeId = 2 
        ORDER BY tbluseremploymenthistory.EmpDateJoin ";

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }
}
