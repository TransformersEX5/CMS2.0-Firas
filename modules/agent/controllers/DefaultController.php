<?php

namespace app\modules\agent\controllers;

use Yii;
use yii\web\Response;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

use yii\helpers\FileHelper;
use yii\web\UploadedFile;

use app\modules\agent\models\tblusertest;
use app\modules\agent\models\tblusertest2;
use app\modules\agent\models\tblagentdocument;
use app\modules\agent\models\UploadForm;

/**
 * Default controller for the `agent` module
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
        $model = new tblusertest();

        return $this->render('index', ['model' => $model]);
    }

    public function actionDetails()
    {
        $UserId = Yii::$app->request->get('UserId');

        if($UserId == 0)
        {
            $model = new tblusertest();
        }
        else
        {
            $model = tblusertest::findOne(['UserId' => $UserId]);
        }
        return $this->renderAjax('details', ['model' => $model]);
    }

    public function actionGenerateagreement()
    {
        $UserId = base64_decode(Yii::$app->request->get('UserId'));

        $stmt = "SELECT AgentBankName 
        FROM tblusertest 
        WHERE UserId = $UserId";

        $checkAgent = Yii::$app->db->createCommand($stmt)->queryAll();

        if(!empty($checkAgent))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function actionAgreement()
    {
        $UserId = Yii::$app->request->get('UserId');

        $model = tblusertest::findOne(['UserId' => $UserId]);

        return $this->renderPartial('agreement', ['model' => $model]);
    }

    public function actionLetterofrepresentation()
    {
        $UserId = Yii::$app->request->get('UserId');

        $model = tblusertest::findOne(['UserId' => $UserId]);

        return $this->renderPartial('letterofrepresentation', ['model' => $model]);
    }

    public function actionCertificateofappointment()
    {
        $UserId = Yii::$app->request->get('UserId');

        $model = tblusertest::findOne(['UserId' => $UserId]);

        return $this->renderPartial('certificateofappointment', ['model' => $model]);
    }

    public function actionGetagentlist()
    {
        $searchbox = Yii::$app->request->get('searchbox');
        $statusId = Yii::$app->request->get('statusId');

        if ($searchbox == '') {
            $searchbox = '.*';
        }

        if ($statusId == '') {
            $statusId = '.*';
        }

        $stmt = "SELECT CONCAT(tblusertest.UserId, ',', tblusertest.AgentApplicationStatusId) AS LLL, UserNo, FullName, ICPassportNo, 
        CASE 
            WHEN tblusertest.AgentApplicationStatusId = 1 THEN 'Accepted'
            WHEN tblusertest.AgentApplicationStatusId = 2 THEN 'Rejected'
            ELSE 'Waiting for Approval'
            END AS AgentApplicationStatus , tblstatusai.Status
        FROM tblusertest 
        INNER JOIN tblstatusai ON tblstatusai.StatusId = tblusertest.StatusId
        WHERE DepartmentId = 28 AND tblusertest.FullName REGEXP '$searchbox' AND tblusertest.StatusId REGEXP '$statusId'
        ORDER BY tblusertest.StatusId, FullName
        ";

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }

    public function actionDetailsupdate()
    {
        $stmt = "SELECT tblusertest.UserNo, REPLACE(tblusertest.UserNo, 'AG', '') AS NoOnly, 
        CONCAT('AG', REPLACE(tblusertest.UserNo, 'AG', '') + 1) AS NewCode 
        FROM tblusertest 
        WHERE UserNo LIKE '%AG%'
        ORDER BY CAST(REPLACE(tblusertest.UserNo, 'AG', '') AS UNSIGNED) DESC LIMIT 1";

        $sqlAgent = \Yii::$app->db->createCommand($stmt)->queryAll();

        $UserId = Yii::$app->request->post('UserId');

        if($UserId == 0)
        {
            $model = new tblusertest2();
        }
        else
        {
            $model = tblusertest2::findOne(['UserId' => $UserId]);
        }

        $data = Yii::$app->request->post('formData');
        $datadecoded = json_decode($data);
        $arrayData = array();
        $i = 0;

        foreach ($datadecoded as $fieldObject) {
            $arrayData[$i] = $fieldObject->value;
            $i++;
        }

        $model->FullName = $arrayData[1];
        $model->ICPassportNo = $arrayData[2];
        $model->EmailAddress = $arrayData[3];

        $model->DepartmentId = $model->DepartmentId ?? 28;
        $model->UserNo = $model->UserNo ?? $sqlAgent[0]['NewCode'];
        $model->NationalityId = $model->NationalityId ?? 17;
        $model->PositionId = $model->PositionId ?? 29;
        $model->BranchId = $model->BranchId ?? 1;
        $model->StatusId = $model->StatusId ?? 2;
        $model->WorkingStatusId = $model->WorkingStatusId ?? 11;
        $model->DateJoin = $model->DateJoin ?? date("Y-m-d");
        $model->RaceId = $model->RaceId ?? 4;
        $model->Gender = $model->Gender ?? 1;
        $model->UserName = $model->UserName ?? 'NIL';
        $model->ChangePassword = $model->ChangePassword ?? date("Y-m-d");
        $model->ExtensionNo = $model->ExtensionNo ?? 'NIL';
        $model->MarketingTeamId = $model->MarketingTeamId ?? 0;

        $model->AgentNatureOfBusiness = $model->AgentNatureOfBusiness;
        $model->AgentBusinessAddress = $model->AgentBusinessAddress;
        $model->HandSetNo = $model->HandSetNo;
        $model->AgentSocialMedia = $model->AgentSocialMedia;
        $model->AgentPIC = $model->AgentPIC;
        $model->AgentYearsInBusiness = $model->AgentYearsInBusiness;
        $model->AgentNumberOfStaffs = $model->AgentNumberOfStaffs;
        $model->AgentRecruitmentBranch = $model->AgentRecruitmentBranch;
        $model->AgentPreferredCountry = $model->AgentPreferredCountry;
        $model->AgentFocusedCountry = $model->AgentFocusedCountry;
        $model->AgentInterestedProgram = $model->AgentInterestedProgram;
        $model->AgentNumberOfEvent = $model->AgentNumberOfEvent;
        $model->AgentBankName = $model->AgentBankName;
        $model->AgentBankAccountNumber = $model->AgentBankAccountNumber;
        $model->AgentBankBranch = $model->AgentBankBranch;
        $model->AgentBankCountry = $model->AgentBankCountry;
        $model->AgentBankSwiftCode = $model->AgentBankSwiftCode;
        $model->AgentApplicationStatusId = $model->AgentApplicationStatusId;
        if($model->AgentApplicationStatusId == 1)
        {
            $model->StatusId = 1;
        }
        else
        {
            $model->StatusId = 2;
        }

        if($model->save())
        {

        }
        else
        {
            die(print_r($model->getErrors()));
        }

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['UserId' => $model->UserId];
    }






    public function actionSendemail()
    {
        $UserId = Yii::$app->request->post('UserId');
        $encUserId = base64_encode($UserId);
        $date = date('Ymd');
        $encDate = base64_encode($date);

        $sql = "SELECT UserId, FullName, EmailAddress
        FROM tblusertest
        WHERE UserId = " . $UserId;

        $sqlEmail = Yii::$app->db->createCommand($sql)->queryAll();

        $data = "Dear " . $sqlEmail[0]['FullName'] . ",<br><br>";
        // $data .= "We need your time to fill up the training evaluation feedback.<br><br>";
        $data .= "Please click the link below to fill up the application form.<br><br>";
        $data .= "<a href='https://apps.city.edu.my" . Url::base() . "/agent/default/application?UserId=$encUserId'>LINK</a><br><br>";
        // $data .= "Your feedback is important for future training development.<br><br>";
        // $data .= "<b>This link will expired within 5 days from this email date<b>.<br><br>";
        //$email =  Yii::$app->mailer_creditcontrol->compose("@app/mail/layouts/html", ["content" => $content]);

        $subject_mail   = 'Agent Application Form';
        $setToEmail     = 'muhdfiqhree.mahmud@city.edu.my';
        $setToName      = $sqlEmail[0]['FullName'];

        // $setToEmail     = $row['EmailAddress'];
        // $setToName      = $row['FullName'];

        $emailContent = $this->renderPartial("@app/mail/layouts/trainingevaluation", ["content" => $data]);

        $email =  Yii::$app->mailer_creditcontrol->compose();
        $email->setTo([$setToEmail => $setToName]);

        //base on user login   user ->email
        $email->setFrom(['mohdnizamomarxxxx@gmail.com' => 'Training Unit']);
        $email->setSubject($subject_mail);

        $email->setHtmlBody($emailContent);

        // Path to the image file on your server
        $imagePath = Yii::getAlias('@webroot/image/city_logo_white.png');

        // Attach the image or logo file to the email
        // for image name ..no need the ext type "city_logo_white" only ..not this "city_logo_white.jpg" 
        $email->attach($imagePath, ['fileName' => 'city_logo_white']);


        if ($email->Send()) {

            // Clear the recipient after sending (for security reasons)
            $email->setTo([]); // Clear the recipient address

            Yii::$app->session->setFlash('success', "Record Successfully email.");

            return 1;
        } else {
            Yii::$app->session->setFlash('error', 'Error while sending email: ' . $email->ErrorInfo);
            // Yii::$app->getSession()->setFlash('error', 'Error while sending email: ' . $email->ErrorInfo);
        }

        //return $this->refresh();
        //return $this->render('index');
    }

    public function actionApplication()
    {
        $this->layout = '@app/views/layouts/loginlayout';

        $UserId = base64_decode(Yii::$app->request->get('UserId'));

        $model = tblusertest::findOne(['UserId' => $UserId]);

        $model2 = new tblagentdocument();

        return $this->render('application', ['model' => $model, 'model2' => $model2]);
    }

    public function actionSubmitapplication()
    {
        $UserId = Yii::$app->request->get('UserId');

        $model = tblusertest::findOne(['UserId' => $UserId]);

        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            $model->FullName = Yii::$app->request->post('Tblusertest')['FullName'];
            $model->AgentNatureOfBusiness = Yii::$app->request->post('Tblusertest')['AgentNatureOfBusiness'];
            $model->ICPassportNo = Yii::$app->request->post('Tblusertest')['ICPassportNo'];
            $model->AgentBusinessAddress = Yii::$app->request->post('Tblusertest')['AgentBusinessAddress'];
            $model->HandSetNo = Yii::$app->request->post('Tblusertest')['HandSetNo'];
            $model->EmailAddress = Yii::$app->request->post('Tblusertest')['EmailAddress'];
            $model->AgentSocialMedia = Yii::$app->request->post('Tblusertest')['AgentSocialMedia'];
            $model->AgentPIC = Yii::$app->request->post('Tblusertest')['AgentPIC'];
            $model->AgentYearsInBusiness = Yii::$app->request->post('Tblusertest')['AgentYearsInBusiness'];
            $model->AgentNumberOfStaffs = Yii::$app->request->post('Tblusertest')['AgentNumberOfStaffs'];
            $model->AgentRecruitmentBranch = Yii::$app->request->post('Tblusertest')['AgentRecruitmentBranch'];
            $model->AgentPreferredCountry = Yii::$app->request->post('Tblusertest')['AgentPreferredCountry'];
            $model->AgentFocusedCountry = Yii::$app->request->post('Tblusertest')['AgentFocusedCountry'];
            $model->AgentInterestedProgram = Yii::$app->request->post('Tblusertest')['AgentInterestedProgram'];
            $model->AgentNumberOfEvent = Yii::$app->request->post('Tblusertest')['AgentNumberOfEvent'];
            $model->AgentBankName = Yii::$app->request->post('Tblusertest')['AgentBankName'];
            $model->AgentBankAccountNumber = Yii::$app->request->post('Tblusertest')['AgentBankAccountNumber'];
            $model->AgentBankBranch = Yii::$app->request->post('Tblusertest')['AgentBankBranch'];
            $model->AgentBankCountry = Yii::$app->request->post('Tblusertest')['AgentBankCountry'];
            $model->AgentBankSwiftCode = Yii::$app->request->post('Tblusertest')['AgentBankSwiftCode'];
            $model->AgentApplicationStatusId = Yii::$app->request->post('Tblusertest')['AgentApplicationStatusId'] ?? 3;

            if ($model->save()) {
                $modelDoc = new tblagentdocument();

                $documentname = UploadedFile::getInstances($modelDoc, 'AgentDocName');

                $uploadPath = Yii::getAlias('upload/agent/' . $UserId . '/Event/');
                if (!is_dir($uploadPath)) {
                    FileHelper::createDirectory($uploadPath);
                }

                foreach ($documentname as $key => $files) {
                    $modelDoc = new tblagentdocument();
                    $modelDoc->AgentDocName = $uploadPath . $files->name;
                    $modelDoc->UserId = $UserId;
                    $modelDoc->save();
                    $files->saveAs($modelDoc->AgentDocName);
                }
                return ['success' => 'success'];
            } else {
                return $model->getErrors();
            }



            // $model->FullName = $arrayData[1];
            // $model->AgentNatureOfBusiness = $arrayData[2];
            // $model->ICPassportNo = $arrayData[3];
            // $model->AgentBusinessAddress = $arrayData[4];
            // $model->HandSetNo = $arrayData[5];
            // $model->EmailAddress = $arrayData[6];
            // $model->AgentSocialMedia = $arrayData[7];
            // $model->AgentPIC = $arrayData[8];
            // $model->AgentYearsInBusiness = $arrayData[9];
            // $model->AgentNumberOfStaffs = $arrayData[10];
            // $model->AgentRecruitmentBranch = $arrayData[11];
            // $model->AgentPreferredCountry = $arrayData[12];
            // $model->AgentFocusedCountry = $arrayData[13];
            // $model->AgentInterestedProgram = $arrayData[14];
            // $model->AgentNumberOfEvent = $arrayData[16] ?? 0;
            // $model->AgentBankName = $arrayData[17];
            // $model->AgentBankAccountNumber = $arrayData[18];
            // $model->AgentBankBranch = $arrayData[19];
            // $model->AgentBankCountry = $arrayData[20];
            // $model->AgentBankSwiftCode = $arrayData[21];

            // $model->DepartmentId = 28;

            // $model->UserNo = 'AG9999';

            // $model->NationalityId = 17;
            // $model->PositionId = 29;
            // $model->BranchId = 1;
            // $model->WorkingStatusId = 11;
            // $model->DateJoin = date("Y-m-d");
            // $model->RaceId = 4;
            // $model->Gender = 1;
            // $model->UserName = 'User';
            // $model->ChangePassword = date("Y-m-d");
            // $model->ExtensionNo = '000';
            // $model->MarketingTeamId = 0;
        }
        return ['AgentApplicationId' => $model->UserId];
    }
}
