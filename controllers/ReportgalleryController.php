<?php

namespace app\controllers;
use Yii;
use mpdf\mpdf;

class ReportgalleryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }


    // public function actionViewreport()
    // {
    //     // $mpdf = new \Mpdf\Mpdf();
    //     // $html ="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
    //     // $mpdf->WriteHTML($html);
    //     // $mpdf->Output();

    //     return $this->render('1_rpt_training.php');
    // }


    public function actionTrainingreportsummary($id)
    {
        
        return $this->render($id);
    }


    public function actionTrainingreportdetail()
    {

        // $data=Yii::$app->request->get();
        // $ReportUrl=$data['id'];
        return $this->render('1_rpt_training_detail');
    }


    public function actionReport()
    {
        $rpt = yii::$app->request->get('rpt');
        return $this->render($rpt);
    }

    
    public function beforeAction($action)
    {
        if (!isset(Yii::$app->user->identity->UserId))
        {
           //echo '<script>alert("login lah");</script>';
            return Yii::$app->response->redirect(['site/login'])->send();
        }
        return parent::beforeAction($action);    
    }

}
