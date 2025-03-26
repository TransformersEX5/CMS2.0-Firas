<?php

namespace app\modules\creditcontrol\controllers;

use yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;

use yii\web\View;
use app\models\Tblprogramregisterremarks;
use app\models\Tbldebtoraction;
use app\models\Tbldebtgroup;
use app\models\Tbldebtstudent;

use yii\bootstrap5\ActiveForm;
use yii\web\Response;
use yii\helpers\FileHelper;




/**
 * Default controller for the `creditcontrol` module
 */
class DefaultController extends Controller
{

    public $layout = '@app/views/layouts/lexapurple_layouts';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        Yii::$app->user->identity->UserId;

        /* Get Data debtgroup by user */
        $btngroupmodel = Tbldebtgroup::findAll(['UserId' => Yii::$app->user->identity->UserId]);

        return $this->render('index', [
            'btngroupmodel' => $btngroupmodel
        ]);
    }


    public function actionCreditcontrollist()
    {

        $model = new Tbldebtstudent();

        $output = [];
        $output['data'] = '';

        $data = $model->getCreditControlList();
        $output['data'] = $data;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $output;
    }


    public function actionFollowuplist()
    {

        $model = new Tbldebtoraction();

        $output = [];
        $output['data'] = '';

        $data = $model->getFollowupList();
        $output['data'] = $data;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $output;
    }


    public function actionMessages()
    {
          $prgid = yii::$app->request->get('prgid');
        // $model = Tblprogramregisterremarks::findOne(['ProgramRegId' => $prgid]);
        $model = new Tblprogramregisterremarks();

        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            $model->ProgramRegId = $prgid;
            $model->UserId = Yii::$app->user->identity->UserId;
            $remarks = Yii::$app->request->post('Tblprogramregisterremarks')['ProgRegRemarks'];
            $model->ProgRegRemarks = nl2br($remarks);


            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($model->save()) {
                return ['success' => true];
            } else {
                return $model->getErrors();
            }
        }

        return $this->renderAjax('messages', ['model' => $model]);
    }


    public function actionGroupcreate()
    {
        $model = new Tbldebtgroup();

        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            $model->UserId = Yii::$app->user->identity->UserId;

            Yii::$app->response->format = Response::FORMAT_JSON;

            if ($model->save()) {
                return ['success' => true];
            } else {
                return $model->getErrors();
            }
        }

        return $this->renderAjax('groupcreate', ['model' => $model]);
    }



    public function actionGroupAssign()
    {
        $model = new tbldebtgroup();

        return $this->renderAjax('group_assign', [
            'model' => $model,
        ]);
    }


    public function actionRemovefromgroup()
    {


        $data = Yii::$app->request->post();

        $ProgramRegId = yii::$app->request->get('id');
        $Debtstudid = yii::$app->request->get('debtstudid');

        // $deptbelongto= Tbldebtstudent::findOne(['UserId' => Yii::$app->user->identity->UserId, 'ProgramRegId' => $ProgramRegId]);
        $model = Tbldebtstudent::findOne($Debtstudid);

        Yii::$app->response->format = Response::FORMAT_JSON;


        if ($model->delete()) {
            return ['success' => true];
        } else {
            return $model->getErrors();
        }
    }



    public function actionPickthis()
    {
        $model = new Tbldebtstudent();

        $data = Yii::$app->request->post();

        $ProgramRegId = yii::$app->request->get('id');
        $Debtstudid = yii::$app->request->get('debtstudid');



        /* Udpdate/change/move Group */
        if ($Debtstudid > 0) {
            $model = Tbldebtstudent::findOne($Debtstudid);
        }

        // $deptbelongto= Tbldebtstudent::findOne(['UserId' => Yii::$app->user->identity->UserId, 'ProgramRegId' => $ProgramRegId]);

        Yii::$app->response->format = Response::FORMAT_JSON;

        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {

            $model->ProgramRegId = $ProgramRegId;
            $model->UserId = Yii::$app->user->identity->UserId;
            Yii::$app->response->format = Response::FORMAT_JSON;

            if ($model->save()) {
                return ['success' => true];
            } else {
                return $model->getErrors();
            }
        }

        return $this->renderAjax('groupassign', ['model' => $model]);
    }


    public function beforeAction($action)
    {
        if (!isset(Yii::$app->user->identity->UserId)) {
            //echo '<script>alert("login lah");</script>';
            return Yii::$app->response->redirect(['site/login'])->send();
        }



        return parent::beforeAction($action);
    }

    public function actionSendemail()
    {
        $ProgramRegId = Yii::$app->request->post('ProgramRegId');

        $table = 'style=" border-collapse: collapse; padding: 10px; width: 100%;   font-size: 16px; "';
        $table2 = 'style=" border-collapse: collapse; padding: 10px; width: 50%;   font-size: 14px; "';


        $sql = " SELECT
        tblprogramregister.ProgramRegId,
        tblstudent.StudName,
        tblstudent.StudentNo,
        tblstudent.StudEmail,
        tblstudent.ResidencyId,
        tblprogram.ProgramName,
        tblprogramregister.AcademicOuts,
        FORMAT((tblprogramregister.AcademicOuts), 2) AS TotalOutstanding,
        tblstudent.StudNationalityId
        FROM
        tblprogramregister
        INNER JOIN tblstudent ON tblstudent.StudentId = tblprogramregister.StudentId
        INNER JOIN tblprogram ON tblprogram.ProgramId = tblprogramregister.ProgramId
        WHERE tblstudent.StudNationalityId not in(7) and  tblprogramregister.ProgramRegId = $ProgramRegId ";


        $data = Yii::$app->db->createCommand($sql)->queryAll();

        $StudName           = $data[0]['StudName'];
        $AcademicOuts       = $data[0]['AcademicOuts'];
        $TotalOutstanding   = $data[0]['TotalOutstanding'];
        $ProgramName        = $data[0]['ProgramName'];
        $ResidencyId        = $data[0]['ResidencyId'];


$body = '
  <table ' . $table . '>
  <tr></tr>      
  <tr>    
    <td width="40%" align="center">&nbsp;</td>
    <td width="28%">&nbsp;</td>
  </tr>
  <tr>
    <td height="8" colspan="3"></td>
  </tr>
   <tr>
    <td height="46" colspan="3"></td>
  </tr>
   <tr>
    <td height="22" colspan="3"></td>
  </tr>
  
  <tr>
    <td height="25" colspan="3"><strong>Dear ' . $StudName . '</strong><br> ' . $ProgramName . '</td>
  </tr>
  <tr>
    <td height="28" style="font-size:11px" colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="8" colspan="3"></td>
  </tr>
  <tr>
    <td colspan="3"><strong>REMINDER REGARDING OUTSTANDING PAYMENT</strong></td>
  </tr>
  <tr>
    <td colspan="3"> <p style="border-bottom:1.8px solid #ccc;color:#666666;"></p></td>
  </tr>
  <tr>
    <td colspan="3" height="10" >
         I hope this letter finds you well. This is a formal reminder regarding the outstanding payment on your account. According to our records, <strong>the amount of RM:' . $TotalOutstanding . ' remains unpaid.</strong>
    
         <br><br>

         You are advised to make payment using IPAY88. <br>
         Click this link to make payment: https://payment.city.edu.my/Initiate.aspx
        
         <br><br>';

        if ($ResidencyId == 2) {
            $body .= "Others Payment Method :- <br>";
            $body .= "<table ' . $table2 . '>";
            $body .= "<tr>";

            $body .= "<tr>";
            $body .= "<td><b>1)NAME OF BANK </b></td>";
            $body .= "<td><b>: CIMB BANK BERHAD</b></td>";
            $body .= "</tr>";
            $body .= "<td><b>ACCOUNT NAME </b></td>";
            $body .= "<td><b>: U.C.I EDUCATION SDN BHD</b></td>";
            $body .= "</tr>";

            $body .= "<tr>";
            $body .= "<td><b>ACCOUNT NUMBER </b></td>";
            $body .= "<td><b>: 8002295164</b></td>";
            $body .= "</tr>";
            $body .= "<tr>";
            $body .= "<td><b>SWIFT CODE </b></td>";
            $body .= "<td><b>: CIBBMYKL</b></td>";
            $body .= "</tr>";
            $body .= "<tr>";
            $body .= "<td>&nbsp;</td>";
            $body .= "<td>&nbsp;</td>";
            $body .= "</tr>";

            $body .= "<tr>";
            $body .= "<td><b>2)NAME OF BANK </b></td>";
            $body .= "<td><b>: MALAYAN BANKING BERHAD</b></td>";
            $body .= "</tr>";
            $body .= "<tr>";
            $body .= "<td><b>ACCOUNT NAME </b></td>";
            $body .= "<td><b>: U.C.I EDUCATION SDN BHD</b></td>";
            $body .= "</tr>";

            $body .= "<tr>";
            $body .= "<td><b>ACCOUNT NUMBER </b></td>";
            $body .= "<td><b>: 512334334755</b></td>";
            $body .= "</tr>";
            $body .= "<tr>";
            $body .= "<td><b>SWIFT CODE </b></td>";
            $body .= "<td><b>: MBBEMYKL</b></td>";
            $body .= "</tr>";
            $body .= "</table>";
            $body .= "<br><br>";
        }

        $body .= '
         If you have already sent the payment, please disregard this notice. Otherwise, please contact us immediately to confirm the payment status or discuss any issues regarding the payment. 
                 
         <br><br>
         Thank you for your prompt attention to this urgent matter.

         <br><br>
         Credit Control Unit <br>
         credit.control@city.edu.my <br>

         City University Malaysia
     </td>
  </tr>
  </table>';

        // $body .= "<br><br><br>";

        // $body = "<table ' . $table . '>  <tr>";
        // $body .= "Dear Student,<br><br>";
        // $body .= "Based on your statement account, your overdue outstanding as follows:<br><br>";
        // $body .= "<b>Course : " . $data[0]['ProgramName'] . "</b><br><br>";
        // $body .= "<b>Total Outstanding : RM <span style='color:rgb(156,0,6);'>" . $data[0]['TotalOutstanding'] . "</span></b><br><br>";
        // $body .= "Students are advised to make payment via banking online as soon as possible. <br><br>";
        // $body .= "Please attach your receipt and include your full name, id no and purpose of payment via email credit.control@city.edu.my<br><br>";
        // $body .= "<b>Please do not hesitate to contact us for further assistance.</b><br><br>";
        // if ($data[0]['ResidencyId'] == 2) {
        //     $body .= "Here the account details as below :<br><br>";
        //     $body .= "<table ' . $table . '>";
        //     $body .= "<tr>";
        //     $body .= "<td><b>ACCOUNT NAME: </b></td>";
        //     $body .= "<td><b>U.C.I EDUCATION SDN BHD</b></td>";
        //     $body .= "</tr>";
        //     $body .= "<tr>";
        //     $body .= "<td><b>NAME OF BANK: </b></td>";
        //     $body .= "<td><b>CIMB Bank Berhad</b></td>";
        //     $body .= "</tr>";
        //     $body .= "<tr>";
        //     $body .= "<td><b>ACCOUNT NUMBER: </b></td>";
        //     $body .= "<td><b>8002295164</b></td>";
        //     $body .= "</tr>";
        //     $body .= "<tr>";
        //     $body .= "<td><b>SWIFT CODE: </b></td>";
        //     $body .= "<td><b>CIBBMYKL</b></td>";
        //     $body .= "</tr>";
        //     $body .= "<tr>";
        //     $body .= "<td>&nbsp;</td>";
        //     $body .= "<td>&nbsp;</td>";
        //     $body .= "</tr>";
        //     $body .= "<tr>";
        //     $body .= "<td><b>ACCOUNT NAME: </b></td>";
        //     $body .= "<td><b>U.C.I EDUCATION SDN BHD</b></td>";
        //     $body .= "</tr>";
        //     $body .= "<tr>";
        //     $body .= "<td><b>NAME OF BANK: </b></td>";
        //     $body .= "<td><b>MALAYAN BANKING BERHAD</b></td>";
        //     $body .= "</tr>";
        //     $body .= "<tr>";
        //     $body .= "<td><b>ACCOUNT NUMBER: </b></td>";
        //     $body .= "<td><b>512334334755</b></td>";
        //     $body .= "</tr>";
        //     $body .= "<tr>";
        //     $body .= "<td><b>SWIFT CODE: </b></td>";
        //     $body .= "<td><b>MBBEMYKL</b></td>";
        //     $body .= "</tr>";
        //     $body .= "</table><br>";
        // }
        // $body .= "<b>Students are advised to make payment using IPAY88.</b><br>";
        // $body .= "<b>Here is a link to make payment;-https://payment.city.edu.my/Initiate.aspx</b><br>";
        // $body .= "<span style='background-color: yellow;'><b>p/s- This link is for active students only and please make sure students have an ID,IC or Passport No. to use that link.</b></span><br><br>";
        // $body .= "<b>Failing to make payment, Student LMS will be blocked.Kindly Ignore this notice if payment has been made.</b><br><br>";
        // $body .= "<span style='color:white;'><b>P/S : If you have already sent your payment or made arrangements with this office, please disregard this letter and accept our thanks.</b></span><br><br>";
        // $body .= "<span><b>If you have already made your payment, please disregard this letter and accept our thanks.</b></span><br><br>";

        // $body = "</table>";

        $date = date_create();
        $currentdate = date_format($date, "d-m-Y");

        $subject_mail = "REMINDER TO PAY YOUR OVERDUE OUTSTANDING - " . $currentdate;
        $setToEmail = $data[0]['StudEmail'];
        //$setToEmail = 'mohdnizam@city.edu.my';
        $setToName = $data[0]['StudName'];

        // Path to the image file on your server
        $imagePath = Yii::getAlias("@webroot/image/CityU_logo.png");

        $email = Yii::$app->mailer_creditcontrol->compose();

        // Attach the image or logo file to the email
        // for image name ..no need the ext type "city_logo_white" only ..not this "city_logo_white.jpg" 
        $email->attach($imagePath, ["fileName" => "city_logo_white"]);

        //email templet /layout  / logo  
        $emailContent = $this->renderPartial("@app/mail/layouts/creditcontrol", ["content" => $body]);

        
        $email->setTo([$setToEmail => $setToName]);

        $email->setFrom(["credit.control@city.edu.my" => "Credit Control"]);
        $email->setSubject($subject_mail);

        $email->setHtmlBody($emailContent);

        if ($email->Send()) {

            // Clear the recipient after sending (for security reasons)
            $email->setTo([]); // Clear the recipient address

            Yii::$app->session->setFlash("success", "Record Successfully email.");

            $update = "UPDATE tbldebtoraction SET CurrentStatusId = 0 WHERE ProgramRegId = $ProgramRegId AND CurrentStatusId = 1";
            $data = Yii::$app->db->createCommand($update)->queryAll();

            $model = new tbldebtoraction();

            $model->ProgramRegId    = $ProgramRegId;
            $model->DebtActionCatId = 3;
            $model->OutsAmt         = $AcademicOuts;
            $model->CurrentStatusId = 1;
            $model->UserId          = Yii::$app->user->identity->UserId;

            if ($model->save()) {
                return true;
            }
            else
            {
                die(print_r($model->getErrors()));
                return false;
            }
        } else {

            Yii::$app->session->setFlash("error", "Error while sending email: " . $email->ErrorInfo);
        }

        return true;
    }
}
