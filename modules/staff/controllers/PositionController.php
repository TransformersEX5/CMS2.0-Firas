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
use app\models\Tblposition;
use app\models\Tblpositiongrade;
use app\models\Tblhod;
use app\models\Tblleaveholiday;
use app\models\tblbranch;
use app\models\tblcalendarbranch;
use yii\db\Expression;


/**
 * Default controller for the `staff` module
 */
class PositionController extends Controller
{
    public $layout = '@app/views/layouts/lexapurple_layouts';

    /**
     * Renders the index view for the module
     * @return string
     */




    //      ['html' => 'templates/template1', 'text' => 'templates/template1-text'],
    //      ['param1' => $value1, 'param2' => $value2]
    //  );

    public function actionPositionlist()
    {
        if (yii::$app->user->can('Staff-StaffList')) {

            return $this->render('positionlist');
        } else {

            $js = <<<JS
                    toastr.error('Sorry. You do not have permission to access this feature', 'Access denied');
              JS;

            $this->getView()->registerJs($js, View::POS_READY);

            throw new ForbiddenHttpException(Yii::t('app', 'Access denied. You do not have permission to access this feature.'));
        }
    }

    public function actionGetposition()
    {
        $txtSearch = Yii::$app->request->get('txtSearch');

        if ($txtSearch == '') {
            $txtSearch = '.*';
        }

        $stmt = "SELECT tblposition.PositionId, tblposition.PositionName, tblpositiongrade.PositionGrade 
        FROM tblposition 
        INNER JOIN tblpositiongrade ON tblpositiongrade.PositionGradeId = tblposition.PositionGradeId 
        WHERE tblposition.PositionName REGEXP '$txtSearch' OR tblpositiongrade.PositionGrade REGEXP '$txtSearch' 
        ORDER BY tblposition.PositionName";

        $data = Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }

    public function actionPositionnew()
    {
        $posId = Yii::$app->request->get('posId');
        if ($posId == '') {
            $model = new Tblposition();
        } else {
            $model = Tblposition::findOne(['PositionId' => $posId]);
        }

        return $this->renderAjax('/position/positionnew', ['model' => $model]);
    }

    public function actionPositiondetail()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $PositionId = Yii::$app->request->post('PositionId');
        if ($PositionId == 0) {
            $model = new Tblposition();
        } else {
            $model = Tblposition::findOne(['PositionId' => $PositionId]);
        }

        $data = Yii::$app->request->post('formData');
        $datadecoded = json_decode($data);
        $arrayData = array();
        $i = 0;

        foreach ($datadecoded as $fieldObject) {
            $arrayData[$i] = $fieldObject->value;
            $i++;
        }

        $model->PositionName = $arrayData[1];
        $model->PositionGradeId = $arrayData[2];
        $model->UserId = Yii::$app->user->identity->UserId;

        if ($model->save()) {
            return ['success' => true, 'PositionId' => $model->PositionId];
        } else {
            return ['success' => false, 'errors' => $model->errors];
        }
    }

    public function actionPositiongradelist()
    {
        if (yii::$app->user->can('Staff-StaffList')) {

            return $this->render('positiongradelist');
        } else {

            $js = <<<JS
                    toastr.error('Sorry. You do not have permission to access this feature', 'Access denied');
              JS;

            $this->getView()->registerJs($js, View::POS_READY);

            throw new ForbiddenHttpException(Yii::t('app', 'Access denied. You do not have permission to access this feature.'));
        }
    }

    public function actionGetpositiongrade()
    {
        $txtSearch = Yii::$app->request->get('txtSearch');

        if ($txtSearch == '') {
            $txtSearch = '.*';
        }

        $stmt = "SELECT tblpositiongrade.PositionGradeId, tblpositiongrade.PositionGrade, tblpositiongrade.PositionDesc 
        FROM tblpositiongrade 
        WHERE tblpositiongrade.PositionGrade REGEXP '$txtSearch' OR tblpositiongrade.PositionDesc REGEXP '$txtSearch' 
        ORDER BY tblpositiongrade.PositionGrade";

        $data = Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
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
