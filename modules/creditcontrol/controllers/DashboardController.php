<?php

namespace app\modules\creditcontrol\controllers;

use yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;

use yii\web\View;
use app\models\Tblprogramregister;
use app\models\Tbldebtstudent;

use yii\bootstrap5\ActiveForm;
use yii\web\Response;
use yii\helpers\FileHelper;




/**
 * Default controller for the `creditcontrol` module
 */
class DashboardController extends Controller
{

    public $layout = '@app/views/layouts/lexapurple_layouts';
    /**
     * Renders the index view for the module
     * @return string
     */




    public function actionCollectionlist()
    {

        $condition = '';
        $model = new Tbldebtstudent();

        $output = [];
        $output['data'] = '';

        $collec = " Select QQ.FullName,

        FORMAT (sum(QToday),2)  as  QToday,
        FORMAT (sum(QMonth),2)  as  QMonth,
        FORMAT (sum(QYear),2)  as  QYear
       
        from (
       Select Q.FullName,
       Case when left(paymentdate,10) = left(CURRENT_DATE,10) and month(paymentdate) = month(CURRENT_DATE) and year(paymentdate) = year(CURRENT_DATE)  then Q.amountpaid else 0 end QToday,
       Case when month(paymentdate) = month(CURRENT_DATE) then Q.amountpaid else 0 end QMonth,
       Case when year(paymentdate) = year(CURRENT_DATE) then Q.amountpaid else 0 end QYear
       
       from (SELECT
       tbldebtstudent.DebtStudId,
       tbl_payment.paymentid,
       tbl_payment.ProgramRegId,
       tbl_payment.debtuserId,
       tbl_payment.amountpaid,
       tbluser.FullName,
       tbl_payment.paymentdate
        FROM
        tbl_payment
        INNER JOIN tbldebtstudent ON tbl_payment.ProgramRegId = tbldebtstudent.ProgramRegId AND tbl_payment.debtuserId = tbldebtstudent.UserId
        INNER JOIN tbluser ON tbldebtstudent.UserId = tbluser.UserId
        where year(paymentdate) = year(CURRENT_DATE)
 
       )Q )
       QQ
       GROUP BY QQ.FullName ";


        if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }

        $collec .= $condition . ' ORDER BY QQ.FullName ';

        $data = \Yii::$app->db->createCommand($collec)->queryAll();

        // $data = $model->getCreditControlList();
        $output['data'] = $data;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $output;
    }


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
