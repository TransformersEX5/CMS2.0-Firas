<?php

namespace app\modules\marketingadmin\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;


use app\modules\marketingadmin\models\tbluser;
use app\modules\marketingadmin\models\tblmarketingteam;

/**
 * Default controller for the `marketingadmin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public $layout = '@app/views/layouts/lexapurple_layouts';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionMarketingteam()
    {
        return $this->render('marketingteam');
    }

    public function actionStaffmarketinglist()
    {
        $searchbox = Yii::$app->request->get('txtSearch');

        if ($searchbox == '') {
            $searchbox = '.*';
        }

        $stmt = "SELECT tbluser.UserId, tbluser.UserNo, tbluser.FullName, tbldepartment.DepartmentDesc, tbluser.TargetNo, tblmarketingteam.MarketingTeamId, 
        tblmarketingteam.MarketingTeam, CONCAT(tblsalary.SalaryCode, '<br>', tblsalary.SalaryRange) AS SalaryRange, tblstatusai.Status
        FROM tbluser
        LEFT JOIN tblmarketingteam ON tblmarketingteam.MarketingTeamId = tbluser.MarketingTeamId
        INNER JOIN tbldepartment ON tbldepartment.DepartmentId = tbluser.DepartmentId
        INNER JOIN tblsalary ON tblsalary.SalaryId = tbluser.SalaryId
        INNER JOIN tblstatusai ON tblstatusai.StatusId = tbluser.StatusId
        WHERE (tbluser.FullName REGEXP '$searchbox' OR tbluser.ICPassportNo REGEXP '$searchbox' 
        OR tblmarketingteam.MarketingTeam REGEXP '$searchbox' OR tbluser.UserNo REGEXP '$searchbox')
        AND DeptCatId = 2 AND FullName NOT LIKE '%SA-%' AND FullName NOT LIKE '%TBA-%'
        ";

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }

    public function actionMarketingteamlist()
    {
        $searchbox = Yii::$app->request->get('txtSearch');

        if ($searchbox == '') {
            $searchbox = '.*';
        }

        $stmt = "SELECT tblmarketingteam.MarketingTeamId, tblmarketingteam.MarketingTeam, tblmarketingteam.TeamTarget, tblstatusai.Status, 
        COALESCE(qMemberno.CountNo, 0) AS CountNo 
        FROM tblmarketingteam
        INNER JOIN tblstatusai ON tblstatusai.StatusId = tblmarketingteam.StatusId
	    LEFT JOIN (
            SELECT MarketingTeamId, COUNT(UserId) AS CountNo 
            FROM tbluser 
            WHERE StatusId = 1
            GROUP BY MarketingTeamId
            )qMemberno on qMemberno.MarketingTeamId = tblmarketingteam.MarketingTeamId
        WHERE (tblmarketingteam.MarketingTeam REGEXP '$searchbox')
        GROUP BY tblmarketingteam.MarketingTeamId
        ORDER BY tblmarketingteam.MarketingTeam
        ";

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }

    public function actionAssignmt()
    {
        $UserId = Yii::$app->request->get('UserId');

        $model = tbluser::findOne(['UserId' => $UserId]);

        return $this->renderAjax('assignmt', ['model' => $model]);
    }

    public function actionAssign()
    {
        $UserId = Yii::$app->request->post('UserId');

        $model = tbluser::findOne(['UserId' => $UserId]);

        $data = Yii::$app->request->post('formData');
        $datadecoded = json_decode($data);
        $arrayData = array();
        $i = 0;

        foreach ($datadecoded as $fieldObject) {
            $arrayData[$i] = $fieldObject->value;
            $i++;
        }

        $model->TargetNo = $arrayData[1];
        $model->MarketingTeamId = $arrayData[2];
        $model->SalaryId = $arrayData[3];
        if ($model->UserName == '') {
            $model->UserName = 'A';
        }
        if ($model->HandSetNo == '') {
            $model->HandSetNo = 'A';
        }
        if ($model->ExtensionNo == '') {
            $model->ExtensionNo = 'A';
        }

        if ($model->save()) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ['success' => 'success'];
        } else {
            die(print_r($model->getErrors()));
        }
    }

    public function actionSetmt()
    {
        $MarketingTeamId = Yii::$app->request->get('MarketingTeamId');

        $model = tblmarketingteam::findOne(['MarketingTeamId' => $MarketingTeamId]);

        return $this->renderAjax('setmt', ['model' => $model]);
    }

    public function actionSet()
    {
        $MarketingTeamId = Yii::$app->request->post('MarketingTeamId');

        $model = tblmarketingteam::findOne(['MarketingTeamId' => $MarketingTeamId]);

        $data = Yii::$app->request->post('formData');
        $datadecoded = json_decode($data);
        $arrayData = array();
        $i = 0;

        foreach ($datadecoded as $fieldObject) {
            $arrayData[$i] = $fieldObject->value;
            $i++;
        }

        $model->TeamTarget = $arrayData[1];
        $model->StatusId = $arrayData[2];

        $model->save();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['success' => 'success'];
    }

    public function actionTeammember()
    {
        $MarketingTeamId = Yii::$app->request->get('MarketingTeamId');

        $stmt = "SELECT tbluser.UserId, tbluser.FullName, tblmarketingteam.MarketingTeam
        FROM tbluser
        INNER JOIN tblmarketingteam ON tblmarketingteam.MarketingTeamId = tbluser.MarketingTeamId
        WHERE tbluser.MarketingTeamId = $MarketingTeamId AND tbluser.StatusId = 1
        ORDER BY FullName
        ";

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $this->renderAjax('teammember', ['data' => $data]);
    }
}
