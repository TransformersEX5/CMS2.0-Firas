<?php

namespace app\modules\staff\controllers;

use yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\bootstrap5\Toast;
use yii\bootstrap5\Widget;
use yii\web\View;
use yii\web\Response;
use app\models\Tbluser;
use app\models\Tblleaveholiday;
use app\models\tblbranch;
use app\models\tblcalendarbranch;
use yii\db\Expression;


/**
 * Holiday controller for the `staff` module
 */
class HolidayController extends Controller
{
    public $layout = '@app/views/layouts/lexapurple_layouts';

    /**
     * Renders the index view for the module
     * @return string
     */

    public function actionView($UserId)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($UserId),
        ]);
    }

    public function actionHolidaylist()
    {
        if (yii::$app->user->can('Staff-StaffList')) {

            return $this->render('holidaylist');
        } else {

            $js = <<<JS
                    toastr.error('Sorry. You do not have permission to access this feature', 'Access denied');
              JS;

            $this->getView()->registerJs($js, View::POS_READY);

            throw new ForbiddenHttpException(Yii::t('app', 'Access denied. You do not have permission to access this feature.'));
        }
    }

    public function actionGetholiday()
    {
        $txtSearch = Yii::$app->request->get('txtSearch');

        if ($txtSearch == '') {
            $txtSearch = '.*';
        }

        $stmt = "SELECT tblleaveholiday.HolidayId, tblleaveholiday.Holiday, tblstatusai.Status AS HolidayStatus 
        FROM tblleaveholiday 
        INNER JOIN tblstatusai ON tblleaveholiday.HolidayStatusId = tblstatusai.StatusId 
        WHERE tblleaveholiday.Holiday REGEXP '$txtSearch'
        ORDER BY tblleaveholiday.Holiday";

        $data = Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }

    public function actionHolidaynew()
    {
        $holidayId = Yii::$app->request->get('holidayId');
        if ($holidayId == '') {
            $model = new Tblleaveholiday();
        } else {
            $model = Tblleaveholiday::findOne(['HolidayId' => $holidayId]);
        }

        return $this->renderAjax('holidaynew', ['model' => $model]);
    }

    public function actionHolidaydetail()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $HolidayId = Yii::$app->request->post('HolidayId');
        if ($HolidayId == 0) {
            $model = new Tblleaveholiday();
        } else {
            $model = Tblleaveholiday::findOne(['HolidayId' => $HolidayId]);
        }

        $data = Yii::$app->request->post('formData');
        $datadecoded = json_decode($data);
        $arrayData = array();
        $i = 0;

        foreach ($datadecoded as $fieldObject) {
            $arrayData[$i] = $fieldObject->value;
            $i++;
        }

        $model->Holiday = $arrayData[1];
        $model->HolidayStatusId = $arrayData[2];
        $model->UserId = Yii::$app->user->identity->UserId;

        if ($model->save()) {
            return ['success' => true, 'HolidayId' => $model->HolidayId];
        } else {
            return ['success' => false, 'errors' => $model->errors];
        }
    }

    public function actionPublicholidaylist()
    {
        if (yii::$app->user->can('Staff-StaffList')) {

            return $this->render('publicholidaylist');
        } else {

            $js = <<<JS
                    toastr.error('Sorry. You do not have permission to access this feature', 'Access denied');
              JS;

            $this->getView()->registerJs($js, View::POS_READY);

            throw new ForbiddenHttpException(Yii::t('app', 'Access denied. You do not have permission to access this feature.'));
        }
    }

    public function actionGetpublicholiday()
    {
        $txtSearch = Yii::$app->request->get('txtSearch');
        $cboYear = Yii::$app->request->get('cboYear');
        $cboBranch = Yii::$app->request->get('cboBranch');

        if ($txtSearch == '') {
            $txtSearch = '.*';
        }

        if ($cboYear == '') {
            $cboYear = '.*';
        }

        if ($cboBranch == '') {
            $cboBranch = '.*';
        }

        $stmt = "SELECT
        tblcalendarbranch.PKBranchId,
        tblbranch.BranchName,
        date_format(tblcalendarbranch.lDate,'%d-%m-%Y') AS lDate,
        tblcalendarbranch.Remarks,
        tblleaveholiday.Holiday,
        tblleaveholiday.HolidayId
        FROM
        tblcalendarbranch
        INNER JOIN tblleaveholiday ON tblcalendarbranch.HolidayId = tblleaveholiday.HolidayId
        INNER JOIN tblbranch ON tblbranch.BranchId = tblcalendarbranch.BranchId
        WHERE tblleaveholiday.HolidayId != 0 AND tblcalendarbranch.BranchId REGEXP '$cboBranch' AND DATE_FORMAT(tblcalendarbranch.lDate,'%Y') REGEXP '$cboYear' 
        AND tblleaveholiday.Holiday REGEXP '$txtSearch'
        ORDER BY YEAR(lDate), MONTH(lDate), DAY(lDate), tblcalendarbranch.BranchId";

        $data = Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }

    public function actionPublicholidaynew()
    {
        $PKBranchId = Yii::$app->request->get('PKBranchId');
        if ($PKBranchId == '') {
            $model = new tblcalendarbranch();
        } else {
            $model = tblcalendarbranch::findOne(['PKBranchId' => $PKBranchId]);
        }

        $checkboxItems = tblbranch::find()->select(['BranchId', 'BranchName'])->where(['BranchId' => [1, 4, 5]])->asArray()->all();

        return $this->renderAjax('publicholidaynew', ['model' => $model, 'checkboxItems' => $checkboxItems]);
    }

    public function actionPublicholidaydetail()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $data = Yii::$app->request->post('formData');
        $datadecoded = json_decode($data);
        $arrayData = array();
        $i = 0;

        $remarksNo = COUNT($datadecoded) - 1;

        foreach ($datadecoded as $fieldObject) {
            $arrayData[$i] = $fieldObject->value;
            $i++;
        }

        $PKBranchId = Yii::$app->request->post('PKBranchId');
        $selectedBranches = Yii::$app->request->post('BranchId');

        $skippedBranches = [];

        if ($PKBranchId == 0) {

            $date = $arrayData[1];
            $timestamp = strtotime($date);
            $formattedDate = date('Y-m-d H:i:s', $timestamp);

            $model = new tblcalendarbranch();

            foreach ($selectedBranches as $rows) {
                $checkmodel = tblcalendarbranch::findOne(['lDate' => $formattedDate, 'BranchId' => $rows]);
                if (empty($checkmodel)) {
                    $model = new tblcalendarbranch();

                    $model->lDate = $formattedDate;
                    $model->HolidayId = $arrayData[2];
                    $model->BranchId = $rows;
                    $model->Remarks = $arrayData[$remarksNo];
                    $model->UserId = Yii::$app->user->identity->UserId;
                    $model->save();
                } else {
                    $modelBranch = tblbranch::findOne(['BranchId' => $rows]);

                    $skippedBranches[] = $modelBranch->BranchName;
                }
            }
            return ['success' => true, 'PKBranchId' => $model->PKBranchId, 'skippedBranches' => $skippedBranches];
        } else {
            $model = tblcalendarbranch::findOne(['PKBranchId' => $PKBranchId]);

            $model->HolidayId = $arrayData[1];
            $model->Remarks = $arrayData[2];
            $model->UserId = Yii::$app->user->identity->UserId;
            if ($model->save()) {
                return ['success' => true, 'PKBranchId' => $model->PKBranchId];
            } else {
                return ['success' => false, 'errors' => $model->errors];
            }
        }
    }

    public function actionPublicholidayremove()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $PKBranchId = Yii::$app->request->post('PKBranchId');

        $model = tblcalendarbranch::findOne(['PKBranchId' => $PKBranchId]);

        if ($model->delete()) {
            return ['success' => true, 'PKBranchId' => $model->PKBranchId];
        } else {
            return ['success' => false, 'errors' => $model->errors];
        }
    }



    protected function findModel($UserId)
    {
        if (($model = Tbluser::findOne(['UserId' => $UserId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
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
