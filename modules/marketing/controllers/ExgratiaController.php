<?php

namespace app\modules\marketing\controllers;

use yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Tblprogramregister;
use app\models\Tblexgratia;

use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;

/**
 * Default controller for the `marketing` module
 */
class ExgratiaController extends Controller
{

    public $layout = '@app/views/layouts/lexapurple_layouts';

    /**
     * Renders the index view for the module
     * @return string
     */

    public function actionIndex()
    {
       $result = \Yii::$app->db->createCommand("CALL GetMarketingExgratiaPayment()");
       $result->execute();
        return $this->render('index');
    }





    public function actionGetclaimexgratiap1list_sp()
    {
    }


    public function actionGetclaimexgratiap1list()
    {

        $txtSearch = trim(Yii::$app->request->get('txtSearch'));
        $userid = Yii::$app->user->identity->UserId;


        // if ($searchbox == '') {
        //     $searchbox = '.*';
        // }
        $stmt = " SELECT
        tblmarketingapplicationfee_temp.QFrom,
        tblmarketingapplicationfee_temp.StudentNo,
        tblmarketingapplicationfee_temp.StudName,
        tblmarketingapplicationfee_temp.ProgramRegId,
        tblmarketingapplicationfee_temp.ProgramCode,
        tblmarketingapplicationfee_temp.App_Fee,
        tblmarketingapplicationfee_temp.App_Paid,
        tblmarketingapplicationfee_temp.App_FullPaid,
        CONCAT('RM:',tblmarketingapplicationfee_temp.App_Fee,' / RM:',tblmarketingapplicationfee_temp.App_Paid) as ApplyFeePaid,
        tblmarketingapplicationfee_temp.Reg_Fee,
        tblmarketingapplicationfee_temp.Reg_Paid,
        tblmarketingapplicationfee_temp.Reg_FullPaid,
        CONCAT('RM:',tblmarketingapplicationfee_temp.Reg_Fee,' / RM:',tblmarketingapplicationfee_temp.Reg_Paid) as RegistFeePaid,

        tblmarketingapplicationfee_temp.StatusName,
        tblmarketingapplicationfee_temp.SemOne_Fee,
        tblmarketingapplicationfee_temp.SemOne_Paid,
        tblmarketingapplicationfee_temp.SemOne_FullPaid,
        CONCAT('RM:',tblmarketingapplicationfee_temp.SemOne_Fee,' / RM:',tblmarketingapplicationfee_temp.SemOne_Paid) as SemOnePaid,
        
        tblexgratia.P1,
        case when App_FullPaid = 'Yes' and Reg_FullPaid = 'Yes' and StatusName ='Active' and COALESCE(tblexgratia.P1,0) = 0 then 'Claim P1'  
        when COALESCE(tblexgratia.P1,0) <> 0 then tblexgratia.P1 else 'Sorry'  end As CanClaimP1,
        
        tblexgratia.P2,
        case when App_FullPaid = 'Yes' and Reg_FullPaid = 'Yes' and StatusName ='Active' and SemOne_FullPaid ='Yes' and  COALESCE(tblexgratia.P2,0) = 0 then 'Claim P2' 
        when COALESCE(tblexgratia.P2,0) <> 0 then tblexgratia.P2 else 'Sorry'  end As CanClaimP2,
        tbluser.UserNo,
        tbluser.ShortName,
        tbluser.FullName,
        tbluser.TargetNo,
        tbluser.ExgratiaRateP1,
        tbluser.ExgratiaRateP2,
        tblexgratia.P1,
        tblmarketingapplicationfee_temp.SBS,
        tblmarketingapplicationfee_temp.Agents
        
        FROM
        tblmarketingapplicationfee_temp
        -- INNER JOIN tblprogramregister ON tblprogramregister.ProgramRegId = tblmarketingapplicationfee_temp.ProgramRegId
        INNER JOIN tbluser ON tblmarketingapplicationfee_temp.UserNo = tbluser.UserNo 
LEFT JOIN tblexgratia on tblexgratia.ProgramRegId = tblmarketingapplicationfee_temp.ProgramRegId and tblexgratia.Branch = tblmarketingapplicationfee_temp.QFrom ";

$condition = "";


    //    $condition .= 'tbluser.FullName = "NUR AKMAL PUTRI BINTI MADUN" and ';

        if (!empty($txtSearch)) {
            $condition .= "CONCAT(tblmarketingapplicationfee_temp.QFrom,tblmarketingapplicationfee_temp.StudentNo,tblmarketingapplicationfee_temp.StudName, tbluser.FullName ) like '%$txtSearch%' and ";
        }

        if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }

      

          $stmt .= $condition ;

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;


        return ['data' => $data];
    }


    public function actionGetclaimexgratiap1()
    {
        $ProgramRegId = yii::$app->request->get('id');
        $Branch = yii::$app->request->get('qfrom');
        $UserNo = yii::$app->request->get('userno');


        $model = new Tblexgratia;

        //$model->load(Yii::$app->request->post()) &&
        if (Yii::$app->request->post() && Yii::$app->request->isAjax) {
            // $model->UserId = Yii::$app->user->identity->UserId;  
            $model->ProgramRegId = $ProgramRegId;
            $model->Branch = $Branch;
            $model->UserNo = $UserNo;
            $model->P1 = date('Y-m-d');

            Yii::$app->response->format = Response::FORMAT_JSON;

            if ($model->save()) {
                return ['success' => true];
            } else {
                return $model->getErrors();
            }
        }
    }


    public function actionGetclaimexgratiap2()
    {
        $ProgramRegId = yii::$app->request->get('id');
        $Branch = yii::$app->request->get('qfrom');
        $UserNo = yii::$app->request->get('userno');

        $model = Tblexgratia::find()
        ->where(['ProgramRegId' => $ProgramRegId])
        ->andWhere(['Branch' => $Branch])        
        ->one();


        //$model->load(Yii::$app->request->post()) &&
        if (Yii::$app->request->post() && Yii::$app->request->isAjax) {
            // $model->UserId = Yii::$app->user->identity->UserId;  
            
            $model->P2 = date('Y-m-d');

            Yii::$app->response->format = Response::FORMAT_JSON;

            if ($model->save()) {
                return ['success' => true];
            } else {
                return $model->getErrors();
            }
        }
    }




    public function actionRpt_param_p1()
    {
        $model = new Tblexgratia;

        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            // $model->UserId = Yii::$app->user->identity->UserId;

            Yii::$app->response->format = Response::FORMAT_JSON;

            
            // if ($model->save()) {
            //     return ['success' => true];
            // } else {
            //     return $model->getErrors();
            // }
        }

        return $this->renderAjax('rpt_param_p1', ['model' => $model]);
        
    }


    

    public function actionRpt_param_p2()
    {
        $model = new Tblexgratia;

        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            // $model->UserId = Yii::$app->user->identity->UserId;

            Yii::$app->response->format = Response::FORMAT_JSON;

            
            // if ($model->save()) {
            //     return ['success' => true];
            // } else {
            //     return $model->getErrors();
            // }
        }

        return $this->renderAjax('rpt_param_p2', ['model' => $model]);
        
    }



}
