<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\TbluploadTest;
use app\models\ContactForm;
use yii\helpers\Url;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    public $layout = 'lexapurple_layouts';

    /**
     * {@inheritdoc}
     */
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::class,
    //             'only' => ['logout'],
    //             'rules' => [
    //                 [
    //                     'actions' => ['logout'],
    //                     'allow' => true,
    //                     'roles' => ['@'],
    //                 ],
    //             ],
    //         ],
    //         'verbs' => [
    //             'class' => VerbFilter::class,
    //             'actions' => [
    //                 'logout' => ['post'],
    //             ],
    //         ],
    //     ];
    // }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {


        if (!isset(Yii::$app->user->identity->UserId)) {
            return Yii::$app->response->redirect(['site/login']);
        } else {
            return $this->render('index');
        }
    }





    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionGetaccess()
    {
        $this->layout = 'loginlayout';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return Yii::$app->response->redirect(Url::base());
        }

        return $this->render('getaccess', ['model' => $model]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'loginlayout';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return Yii::$app->response->redirect(Url::base());
        }

        return $this->render('login', ['model' => $model]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


      /**
     * Displays about page.
     *
     * @return string
     */
    public function actionForgotpws()
    {
        $this->layout = 'loginlayout';
        return $this->render('forgotpws');
    }


    
    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionDashboard()
    {
        if (!isset(Yii::$app->user->identity->UserId)) {
            //echo '<script>alert("login lah");</script>';
            return Yii::$app->response->redirect(['site/login'])->send();
        }
        
        return $this->render('dashboard');
    }

    // public function actionTestupload()
    // {
    //     $model = new TbluploadTest();

    //     if ($model->load(Yii::$app->request->post())) {

    //         $this->UploadDoc(12);
    //     }

    //     return $this->render('testupload', ['model' => $model]);
    // }

    // function UploadDoc($DocTypeId)
    // // function UploadDoc($fileName, $fileType, $file_size, $DocTypeId)
    // {
    //     $model = new TbluploadTest();
    //     $file = UploadedFile::getInstance($model, 'imageFile');
    //     $model->file_name = $file->name;
    //     $model->file_type = $file->type;
    //     $model->file_size = $file->size;
    //     $model->DocTypeId = $DocTypeId;

    //     if ($model->validate()) {
    //         $model->save();
    //     }
    //     else
    //     {
    //         die(print_r($model->errors));
    //     }
    // }

    public function actionSendemail()
    {
        $getEmail = Yii::$app->request->post('email') ?? 0;

        if (strpos($getEmail, '@city.edu.my') === false) {
            $getEmail .= '@city.edu.my';
        }

        $sqlEmail = "SELECT FullName, EmailAddress 
        FROM tbluser
        WHERE EmailAddress = '" . $getEmail . "' AND StatusId = 1";

        $check = Yii::$app->db->createCommand($sqlEmail)->queryAll();

        if (!empty($check)) {
            $newPass = random_int(100000, 999999);
            $cryptPass = md5($newPass);

            $sqlPass = "UPDATE tbluser 
            SET UserPassword = '$cryptPass',
            ChangePassword = CURDATE()
            WHERE EmailAddress = '$getEmail'";

            Yii::$app->db->createCommand($sqlPass)->queryAll();

            Yii::$app->db->createCommand("CALL UpdateSysPassAllDatabase(:email)")
                ->bindParam(':email', $getEmail)
                ->execute();

            $data = "Dear " . $check[0]['FullName'] . ",<br><br>";
            $data .= "Welcome to CITY MANAGEMENT SYSTEM (CMS).<br><br>";
            $data .= "Your username and password for login to CMS.<br><br>";
            $data .= "Username: " . $check[0]['EmailAddress'] . "<br><br>";
            $data .= "Password: " . $newPass . "<br><br>";
            $data .= "Click <a href='https://apps.city.edu.my/cms2/site/login'>here</a> to login.<br><br>";
            $data .= "<b>Please change password after login.</b><br><br>";
            $data .= "<b>If you did not do this, your account has been hacked. Please contact system admin immediately.</b><br><br>";
            $data .= "Thank you.<br><br>";
            $data .= "System Admin<br>";
            $data .= "mohdnizam@city.edu.my<br>";
            $data .= "Ext: 1665<br><br>";
            $data .= "<br><br>";
            $data .= "==========================================================================================<br>";
            $data .= "This email transmission and any accompanying attachments contain confidential information intended only for the use of the 
            individual or entity named above. If the reader of this message is not the intended recipient, or the employee or agent responsible 
            for delivering this message to the intended recipient, then any dissemination, distribution, duplication of, or action taken in 
            reliance to this message is strictly prohibited. If you have received this message in error, please delete this email immediately and 
            notify the sender at the above email address.<br>";
            $data .= "==========================================================================================<br><br>";

            //$email =  Yii::$app->mailer_creditcontrol->compose("@app/mail/layouts/html", ["content" => $content]);

            $subject_mail   = 'CMS : Your Password';
            $setToEmail     = $getEmail;
            $setToName      = $check[0]['FullName'];

            // $setToEmail     = $row['EmailAddress'];

            $emailContent = $this->renderPartial("@app/mail/layouts/email", ["content" => $data]);

            $email =  Yii::$app->mailer_sysadmin->compose();
            $email->setTo([$setToEmail => $setToName]);

            //base on user login   user ->email
            $email->setFrom(['mohdnizamomarxxxx@gmail.com' => 'sysadmin']);
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
            } else {
                Yii::$app->session->setFlash('error', 'Error while sending email: ' . $email->ErrorInfo);
            }
            return true;
        } else {
            return false;
        }
    }





    public function actionSessionmid()
    {                                                           
        Yii::$app->session->remove('mid');
        $mid = base64_decode(Yii::$app->request->get('mid'));
        if ($mid == 0) {
            Yii::$app->session->set('mid', 'Dashboard');
        } else {
            Yii::$app->session->set('mid', $mid);
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['success' => 'success'];
    }
}
