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
class DefaultController extends Controller
{
    public $layout = '@app/views/layouts/lexapurple_layouts';

    /**
     * Renders the index view for the module
     * @return string
     */




    //      ['html' => 'templates/template1', 'text' => 'templates/template1-text'],
    //      ['param1' => $value1, 'param2' => $value2]
    //  );

    public function actionSendemail()
    {
        //for style css
        $table = 'style=" border-collapse: collapse;  width: 100%;"';
        $css_td_tr_col = 'style="  border: 1px solid #ddd; padding: 8px;  border-bottom: 1px solid #ddd; background-color: #04AA6D;  color: white;"';
        $css_td_tr_col_red = 'style="  border: 1px solid #ddd; padding: 8px;  border-bottom: 1px solid #ddd; background-color:red;  color: white;"';
        $css_td_tr = 'style="  border: 1px solid #ddd; padding: 8px;  border-bottom: 1px solid #ddd; "';
        $black = 'style="  border: 1px solid #000; background-color:#000; width="8";"';


        $data = "";

        $data = " <p></p><p></p> <table " . $table . ">
                    <tr  ' . $css_td_tr_col . '>
                        <th  ' . $css_td_tr_col . '>Company</th>
                        <th  ' . $css_td_tr_col . '>Contact</th>
                        <th  ' . $css_td_tr_col . '>Country</th>
                    </tr>
                    <tr  ' . $css_td_tr . '>
                        <td  ' . $css_td_tr . '>Alfreds Futterkiste</td>
                        <td  ' . $css_td_tr . '>Maria Anders</td>
                        <td  ' . $css_td_tr . '>Germany</td>
                    </tr>
                    <tr  ' . $css_td_tr . '>
                        <td  ' . $css_td_tr . '>Centro comercial Moctezuma</td>
                        <td  ' . $css_td_tr . '>Francisco Chang</td>
                        <td  ' . $css_td_tr . '>Mexico</td>
                    </tr>
                    </table>";




        //$email =  Yii::$app->mailer_creditcontrol->compose("@app/mail/layouts/html", ["content" => $content]);

        $subject_mail   = 'testing send email from yee';
        $setToEmail     = 'mohdnizam@city.edu.my';
        $setToName      = 'Mohd Nizam';

        $emailContent = $this->renderPartial("@app/mail/layouts/html", ["content" => $data]);

        $email =  Yii::$app->mailer_creditcontrol->compose();
        $email->setTo([$setToEmail => $setToName]);

        //base on user login   user ->email

        $email->setFrom(['mohdnizamomar@gmail.com' => 'mohd.nizam.omar']);
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
            \Yii::info('This is an informational message', 'app\controllers\YourController');
            Yii::$app->session->setFlash('success', "Record Successfully email.");
        } else {
            Yii::$app->session->setFlash('error', 'Error while sending email: ' . $email->ErrorInfo);
            // Yii::$app->getSession()->setFlash('error', 'Error while sending email: ' . $email->ErrorInfo);
        }

        //return $this->refresh();
        //return $this->render('index');
        // $email->Send()
        // \Yii::info('This is an informational message', 'app\controllers\YourController');
        // Yii::$app->session->setFlash('success', "Record Successfully email.");
        // return $this->refresh();
    }



    public function actionView($UserId)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($UserId),
        ]);
    }




    public function actionCreate()
    {

        $model = new Tbluser();
        $model->scenario = 'create';
        // $model = new Tbluser(['scenario' => 'create']);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            // if ($model->save()) {
            //     Yii::$app->session->setFlash('success', 'User created successfully.');
            //     // return $this->redirect(['view', 'id' => $model->id]);
            // } else {
            //     Yii::$app->session->setFlash('error', 'Failed to create user.');
            // }

        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }


    public function actionStaffdetail_new() {
        return $this->renderAjax('newstaffdetail');
    }

    public function actionNewjoiner()
    {

        $model = new Tbluser();
        $model->scenario = 'create';
        // $model = new Tbluser(['scenario' => 'create']);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            // if ($model->save()) {
            //     Yii::$app->session->setFlash('success', 'User created successfully.');
            //     // return $this->redirect(['view', 'id' => $model->id]);
            // } else {
            //     Yii::$app->session->setFlash('error', 'Failed to create user.');
            // }

        }

        return $this->render('newjoiner', [
            'model' => $model,
        ]);
    }



    public function actionUpdate($UserId)
    {

        $model = new Tbluser();
        $model->scenario = 'update';
        $model = Tbluser::findOne($UserId);
        // $model = new Tbluser(['scenario' => 'create']);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            // if ($model->save()) {
            //     Yii::$app->session->setFlash('success', 'User created successfully.');
            //     // return $this->redirect(['view', 'id' => $model->id]);
            // } else {
            //     Yii::$app->session->setFlash('error', 'Failed to create user.');
            // }

        }

        return $this->renderAjax('update', [
            'model' => $this->findModel($UserId),
        ]);
    }



    public function actionGetimage($imageName)
    {


        $pathAlias =  \Yii::getAlias('@saftyimg');

        echo "xxxxxxxxx" . $pathAlias;
        die();
        $path = $pathAlias . '/' . $imageName; // Path to your images
        //$imagePath = 'E:/path_to_your_image_folder/' . $imageName;


        if ($fp = fopen($path, "rb", 0)) //open file
        {
            $path = fread($fp, filesize($path)); //read file
            fclose($fp);
            $path = chunk_split(base64_encode($path)); //encode image to base64
            // $encode = '<img src="data:image/jpeg;base64,' . $path .'"  width="210"; height="280">'; 
            $encode = '<img src="data:image/jpeg;base64,' . $path . '"  class="img-fluid" style="width:5%; height:5%;">';


            // echo $encode; //show image




        }



        return $encode;


        // if (file_exists($path)) {
        //     Yii::$app->response->format = Response::FORMAT_RAW;
        //     Yii::$app->response->headers->add('Content-Type', 'image/png'); // Adjust the content type based on your image format.

        //     return \Yii::$app->response->sendFile($path);
        // } else {
        //     throw new \yii\web\NotFoundHttpException('Image not found');
        // }
    }


    public function actionIndex()
    {
        if (yii::$app->user->can('Staff-Index')) {

            return $this->render('index');
        } else {

            $js = <<<JS
                  toastr.error('Sorry. You do not have permission to access this feature', 'Access denied');
            JS;

            $this->getView()->registerJs($js, View::POS_READY);


            throw new ForbiddenHttpException(Yii::t('app', 'Access denied. You do not have permission to access this feature.'));
        }
    }


    public function actionStafflist()
    {

        if (yii::$app->user->can('Staff-StaffList')) {

            return $this->render('stafflist');
        } else {

            $js = <<<JS
                    toastr.error('Sorry. You do not have permission to access this feature', 'Access denied');
              JS;

            $this->getView()->registerJs($js, View::POS_READY);

            throw new ForbiddenHttpException(Yii::t('app', 'Access denied. You do not have permission to access this feature.'));
            //return $this->render('index');
        }



        //https://codeseven.github.io/toastr/demo.html

        // Yii::$app->session->setFlash('error', 'Access denied. You do not have permission to access this feature - stafflist.');
        // Redirect the user to another page or render the view, which will display the flash message.
        // return $this->redirect(['index']); // Replace 'site/index' with your desired URL.
        //     Yii::$app->view->registerJs('
        //     $(document).ready(function onDocumentReady() {  
        //         setInterval(function doThisEveryTwoSeconds() {
        //           toastr.success("Hello World!");
        //         }, 1000);   // 2000 is 2 seconds  
        //       });
        // ');

        // $this->view->registerJs('
        // toastr.success("This is a success message");    ', \yii\web\View::POS_READY);

        // echo  Toast::widget([
        //     'id'=>'newMessage',
        //     'title' => 'New Message',
        //     'body' => 'You have new messages...',
        //     'options'=>[ 'role'=>'alert'],
        // ]);

        // Yii::$app->view->registerJs('            
        //     toastr.success("Access denied. You do not have permission to access this feature.");
        // ');

        // throw new NotFoundHttpException(Yii::t('app', 'Access denied. You do not have permission to access this feature.'));
        // throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.')); 
        // throw new NotFoundHttpException(Yii::t('app', 'You are not allowed to access this page.'));

        // echo Toast::widget([
        //     'title' => 'Hello world!',
        //     'dateTime' => 'now',
        //     'body' => 'Say hello...',
        // ]);


        // }
    }

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

        return $this->renderAjax('positionnew', ['model' => $model]);
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

    public function actionPositiongradenew()
    {
        $posgradeId = Yii::$app->request->get('posgradeId');
        if ($posgradeId == '') {
            $model = new Tblpositiongrade();
        } else {
            $model = Tblpositiongrade::findOne(['PositionGradeId' => $posgradeId]);
        }

        return $this->renderAjax('positiongradenew', ['model' => $model]);
    }

    public function actionPositiongradedetail()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $PositionGradeId = Yii::$app->request->post('PositionGradeId');
        if ($PositionGradeId == 0) {
            $model = new Tblpositiongrade();
        } else {
            $model = Tblpositiongrade::findOne(['PositionGradeId' => $PositionGradeId]);
        }

        $data = Yii::$app->request->post('formData');
        $datadecoded = json_decode($data);
        $arrayData = array();
        $i = 0;

        foreach ($datadecoded as $fieldObject) {
            $arrayData[$i] = $fieldObject->value;
            $i++;
        }

        $model->PositionGrade = $arrayData[1];
        $model->PositionDesc = $arrayData[2];
        $model->UserId = Yii::$app->user->identity->UserId;

        if ($model->save()) {
            return ['success' => true, 'PositionGradeId' => $model->PositionGradeId];
        } else {
            return ['success' => false, 'errors' => $model->errors];
        }
    }

    public function actionHodlist()
    {
        if (yii::$app->user->can('Staff-StaffList')) {

            return $this->render('hodlist');
        } else {

            $js = <<<JS
                    toastr.error('Sorry. You do not have permission to access this feature', 'Access denied');
              JS;

            $this->getView()->registerJs($js, View::POS_READY);

            throw new ForbiddenHttpException(Yii::t('app', 'Access denied. You do not have permission to access this feature.'));
        }
    }

    public function actionGethod()
    {
        $txtSearch = Yii::$app->request->get('txtSearch');

        if ($txtSearch == '') {
            $txtSearch = '.*';
        }

        $stmt = "SELECT tblhod.HodId, tblhod.HodDesc, tblstatusai.Status, tbluser.FullName, COALESCE(qTotalStaff.TotalStaff, 0) AS TotalStaff 
        FROM tblhod 
		INNER JOIN tbluser ON tbluser.UserId = tblhod.UserId 
		INNER JOIN tblstatusai ON tblstatusai.StatusId = tblhod.StatusId 
		LEFT JOIN ( 
        SELECT HodId, SUM(TotalStaff) AS TotalStaff 
        FROM ( 
            SELECT tbluser.Hod1 AS HodId, COUNT(tbluser.UserId) AS TotalStaff 
            FROM tbluser 
            WHERE tbluser.StatusId = 1 AND tbluser.FullName NOT LIKE '%TBA%' AND tbluser.FullName NOT LIKE '%REGISTR%'
            GROUP BY Hod1

            UNION ALL

            SELECT tbluser.Hod2 AS HodId, COUNT(tbluser.UserId) AS TotalStaff 
            FROM tbluser 
            WHERE tbluser.StatusId = 1 AND tbluser.FullName NOT LIKE '%TBA%' AND tbluser.FullName NOT LIKE '%REGISTR%' 
            GROUP BY Hod2 
            )combined 
            GROUP BY HodId
        )qTotalStaff ON qTotalStaff.HodId = tblhod.HodId 
		WHERE tblhod.UserId != 0 
		ORDER BY tblhod.HodDesc";

        $data = Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }

    public function actionHodnew()
    {
        $hodId = Yii::$app->request->get('hodId');
        if ($hodId == '') {
            $model = new Tblhod();
        } else {
            $model = Tblhod::findOne(['HodId' => $hodId]);
        }

        return $this->renderAjax('hodnew', ['model' => $model]);
    }

    public function actionHoddetail()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $HodId = Yii::$app->request->post('HodId');
        if ($HodId == 0) {
            $model = new Tblhod();
        } else {
            $model = Tblhod::findOne(['HodId' => $HodId]);
        }

        $data = Yii::$app->request->post('formData');
        $datadecoded = json_decode($data);
        $arrayData = array();
        $i = 0;

        foreach ($datadecoded as $fieldObject) {
            $arrayData[$i] = $fieldObject->value;
            $i++;
        }

        $model->HodDesc = $arrayData[1];
        $model->UserId = $arrayData[2];
        $model->ClassRepApprovalId = $arrayData[2];
        $model->StatusId = $arrayData[3];
        $model->StaffId = Yii::$app->user->identity->UserId;


        if ($model->save()) {
            return ['success' => true, 'HodId' => $model->HodId];
        } else {
            return ['success' => false, 'errors' => $model->errors];
        }
    }

    public function actionRptstaffbyhod()
    {
        $HodId = base64_decode(Yii::$app->request->get('HodId'));

        $stmt = "SELECT tbluser.UserId, tbluser.UserNo, tbluser.FullName, tbluser.ICPassportNo, tbldepartment.DepartmentDesc, tbluser.Hod1, tbluser.Hod2 
        FROM tbluser 
		INNER JOIN tbldepartment ON tbldepartment.DepartmentId = tbluser.DepartmentId
        WHERE tbluser.StatusId = 1 AND (tbluser.Hod1 = $HodId OR tbluser.Hod2 = $HodId) AND tbluser.FullName NOT LIKE '%TBA%' AND tbluser.FullName NOT LIKE '%REGISTR%' 
		ORDER BY tbluser.UserId";

        $stmt2 = "SELECT tblhod.HodDesc, tbluser.FullName 
        FROM tblhod 
        INNER JOIN tbluser ON tbluser.UserId = tblhod.UserId
        WHERE tblhod.HodId = $HodId";

        $data = Yii::$app->db->createCommand($stmt)->queryAll();
        $data2 = Yii::$app->db->createCommand($stmt2)->queryAll();

        return $this->render('rpt_staffbyhod', ['data' => $data, 'data2' => $data2]);
    }

    public function actionRptallstaff()
    {
        $stmt = "SELECT tblhod.HodId, tblhod.HodDesc, tbluser.FullName, CONCAT(tblhod.HodDesc, ' - ', tbluser.FullName) AS HoDName
        FROM tblhod 
        INNER JOIN tbluser ON tbluser.UserId = tblhod.UserId 
        WHERE tblhod.StatusId = 1 AND tblhod.UserId != 0
        ORDER BY tblhod.HodId";

        $data = Yii::$app->db->createCommand($stmt)->queryAll();

        return $this->render('rpt_allstaff', ['data' => $data]);
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
