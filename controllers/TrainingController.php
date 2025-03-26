<?php

namespace app\controllers;

use Yii;
use app\models\Tbltraining;
use app\models\Tbltrainingstatushistory;
use app\models\Tbltrainingattandance;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;

use yii\helpers\Url;

/**
 * TrainingController implements the CRUD actions for Tbltraining model.
 */
class TrainingController extends Controller
{



    public $modelClass = 'app\models\Tbltraining';

    //public $layout = 'adminlte_layouts';
    public $layout = 'lexapurple_layouts';





    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        unset($actions['view']);
        unset($actions['index']);
        return $actions;
    }

    public function actionTraininglist()
    {
        $model = new Tbltraining();

        $output = [];
        $output['data'] = '';

        $data = $model->getTraininglist();
        $output['data'] = $data;

        if (count($output) > 0) {
            return json_encode($output);
        } else {
            return json_encode($output);
        }
    }



    public function actionTrainingtimetablelist()
    {


        $model = new Tbltraining();

        $output = [];
        $txtTrainingId = $_GET['TrainingId'];
        $data = $model->getTrainingtimetablelist($txtTrainingId);
        $output['data'] = $data;
        $tbl = '';

        $tbl = "<p><table border=1 style='border-collapse: collapse;  width: 100%;' class='table table-bordered'>";

        $tbl .= "<tr style='text-align: center; border: 1px solid #ddd; padding: 8px;  border-bottom: 1px solid #ddd; background-color: #04AA6D;  color: white;' >";
        $tbl .= "<th>No</th>";
        $tbl .= "<th>Training Date</th>";
        $tbl .= "<th>Time Start</th>";
        $tbl .= "<th>Time End</th>";
        $tbl .= "<th width='100px'>Tot Hours</th>";

        $tbl .= "<th width='150px'>.:.</th>";
        $tbl .= "</tr>";
        $i = 1;

        foreach ($data as $data) {

            $tbl .= "<tr style=' text-align: center; border: 1px solid #ddd; padding: 8px;  border-bottom: 1px solid #ddd;'>";
            $tbl .= "<td>" . $i . "</td>";
            $tbl .= "<td>" . $data['TrainingDate'] . "</td>";
            $tbl .= "<td>" . $data['TrainingTimeStart'] . "</td>";
            $tbl .= "<td>" . $data['TrainingTimeEnd'] . "</td>";
            $tbl .= "<td>" . $data['TraningTotHours'] . "</td>";
            $tbl .= "<td>" . "<button id='EditDuration' class='DayTime_Edit btn btn-success btn-sm' type='button' OnClick ='DurationEdit(" . $data['TrainingDurationId'] . ");' value=" . $data['TrainingDurationId'] . "> Edit <i class='fas fa-ad far fa-edit'></i></button>" . '   ' . "<button id='DeleteDuration' class='DayTime_Delete btn btn-warning btn-sm DurationDelete' type='button'  value=" . $data['TrainingDurationId'] . "> Delete <i class='icon-file'></i></button></td>";
            $tbl .= "</tr>";
            $i++;
        }
        $tbl .= "</table>";



        if (count($output) > 0) {
            return $tbl;
        } else {
            return json_encode($output);
        }
    }



    public function actionTrainingdurationdatelist()
    {
        $model = new Tbltraining();

        $output = [];
        $txtTrainingId = $_GET['TrainingId'];
        $data = $model->getTrainingtimetablelist($txtTrainingId);
        $output['data'] = $data;
        $tbl = '';

        foreach ($data as $data) {

            $tbl .= " ";
            $tbl .= "<br><button class='btn btn-success btn-sm DurationAttandance' type='button' value=" . $data['TrainingDurationId'] . "> " . $data['TrainingDate'] . " </button>";
            $tbl .= "<br>";
        }


        if (count($output) > 0) {
            return $tbl;
        } else {
            return json_encode($output);
        }
    }






    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Tbltraining models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tbltraining::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'TrainingId' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tbltraining model.
     * @param int $TrainingId Training ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($TrainingId)
    {
        if (yii::$app->user->can('Training List-View')) {

            return $this->renderAjax('view', [
                'model' => $this->findModel($TrainingId),
            ]);
        } else {

            return "Sorry , your access is denied";
        }
    }


    public function actionDaytime($TrainingId)
    {


        if (yii::$app->user->can('Training List-Daytime')) {


            $model = Tbltraining::findOne($TrainingId);


            return $this->renderAjax('daytime', [
                'model' => $model,


            ]);
        } else {

            return "Sorry , your access is denied";
        }
    }





    public function actionTrainingattandance($TrainingId)
    {

        if (yii::$app->user->can('Training List-Attendance')) {

            return $this->renderAjax('trainingattandance', [
                'model' => $this->findModel($TrainingId),
            ]);
        } else {

            return "Sorry , your access is denied";
        }
    }

    /**
     * Creates a new Tbltraining model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */

    public function actionYear()
    {

        if (yii::$app->user->can('Training List-Create')) {

            $model = new Tbltraining();

            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            return $this->renderAjax('year', [
                'model' => $model,
            ]);
        } else {

            return "Sorry , your access is denied";
        }
    }

    public function actionTrainingsummary()
    {

        if (yii::$app->user->can('Training List-Create')) {

            $model = new Tbltraining();

            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            return $this->renderAjax('trainingsummary', [
                'model' => $model,
            ]);
        } else {

            return "Sorry , your access is denied";
        }
    }

    public function actionStaff()
    {

        if (yii::$app->user->can('Training List-Create')) {

            // $model = new Tbltraining();

            $sql = "SELECT tbluser.UserId, FullName 
            FROM tbluser 
            INNER JOIN tbldepartment ON tbldepartment.DepartmentId = tbluser.DepartmentId
            WHERE tbluser.StatusId = 1 AND tbldepartment.DeptCatId IN (1,2) AND FullName NOT LIKE '%-TBA%' AND FullName NOT LIKE '%SA-%'
            ORDER BY FullName";

            $data = Yii::$app->db->createCommand($sql)->queryAll();

            // if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            //     Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
            //     return ActiveForm::validate($model);
            // }

            return $this->renderAjax('staff', [
                'data' => $data,
            ]);
        } else {

            return "Sorry , your access is denied";
        }
    }

    public function actionTraininghours()
    {
        $year = Yii::$app->request->get('year');

        $sql = "SELECT FullName, PositionName, DepartmentDesc, SUM(TraningTotHours) AS TraningTotHours
        FROM
        (
        SELECT 
        tbluser.UserId, FullName, PositionName, DepartmentDesc, TraningTotHours
        FROM tbltrainingattandance
        INNER JOIN tbltrainingduration ON tbltrainingduration.TrainingDurationId = tbltrainingattandance.TrainingDurationId
        INNER JOIN tbltraining ON tbltraining.TrainingId = tbltrainingduration.TrainingId
        INNER JOIN tbluser ON tbluser.UserId = tbltrainingattandance.UserId
        INNER JOIN tblposition ON tblposition.PositionId = tbluser.PositionId
        INNER JOIN tbldepartment ON tbldepartment.DepartmentId = tbluser.DepartmentId
        WHERE AttandId = 1 AND YEAR(TrainingDate) = $year
        ORDER BY FullName
        )qtotalhours
        GROUP BY FullName
        ORDER BY FullName";

        $data = \Yii::$app->db->createCommand($sql)->queryAll();

        return $this->renderPartial('traininghours', ['data' => $data]);
    }

    public function actionStaffhours()
    {
        $UserId = Yii::$app->request->get('UserId');

        $sql = "SELECT tbltrainingattandance.UserId, FullName, TrainingTitle, TraningTotHours, DATE_FORMAT(TrainingDate, '%d-%m-%Y') AS TrainingDate 
        FROM tbltrainingattandance
        INNER JOIN tbluser ON tbluser.UserId = tbltrainingattandance.UserId
        INNER JOIN tbltrainingduration ON tbltrainingduration.TrainingDurationId = tbltrainingattandance.TrainingDurationId
        INNER JOIN tbltraining ON tbltraining.TrainingId = tbltrainingduration.TrainingId
        WHERE AttandId = 1 AND tbltrainingattandance.UserId = $UserId
        ORDER BY tbltrainingduration.TrainingDate";

        $sql2 = "SELECT UserId, FullName 
        FROM tbluser
        WHERE UserId = $UserId";

        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        $data2 = \Yii::$app->db->createCommand($sql2)->queryAll();

        return $this->renderPartial('staffhours', ['data' => $data, 'data2' => $data2]);
    }

    public function actionRpt_trainingsummary()
    {
        $year = Yii::$app->request->get('year');

        $sql = "SELECT tbltrainingattandance.UserId, tbluser.UserNo, tbluser.FullName, tblposition.PositionName, tbldepartment.DepartmentDesc, tbltraining.TrainingTitle, 
        DATE_FORMAT(tbltrainingduration.TrainingDate, '%d-%m-%Y') AS TrainingDate, tbltraining.TrainerName, tbltrainingduration.TraningTotHours 
        FROM tbltrainingattandance
        INNER JOIN tbluser ON tbluser.UserId = tbltrainingattandance.UserId
		INNER JOIN tblposition ON tblposition.PositionId = tbluser.PositionId
		INNER JOIN tbldepartment ON tbldepartment.DepartmentId = tbluser.DepartmentId
        INNER JOIN tbltrainingduration ON tbltrainingduration.TrainingDurationId = tbltrainingattandance.TrainingDurationId
        INNER JOIN tbltraining ON tbltraining.TrainingId = tbltrainingduration.TrainingId
		LEFT JOIN tbluser AS qrequest ON qrequest.UserId = tbltraining.RequestId
        WHERE AttandId = 1 AND DATE_FORMAT(tbltrainingduration.TrainingDate, '%Y') = $year 
        ORDER BY DATE_FORMAT(tbltrainingduration.TrainingDate, '%Y'), tbluser.FullName, tbltrainingduration.TrainingDate";

        $data = \Yii::$app->db->createCommand($sql)->queryAll();

        return $this->renderPartial('rpt_trainingsummary', ['data' => $data]);
    }

    public function actionCreate()
    {

        if (yii::$app->user->can('Training List-Create')) {


            $model = new Tbltraining();
            $history = new Tbltrainingstatushistory();

            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            if ($model->load(Yii::$app->request->post())) {

                //$data = Yii::$app->request->post();
                //$RequestId = $data['Tbltraining']['RequestId'];

                $model->RequestId = Yii::$app->user->identity->UserId;


                if ($model->save(true)) {

                    /* for Training Status History */
                    $history->TrainingId = $model->TrainingId;
                    $history->TrainingStatusId = 1;
                    $history->Remarks = "";
                    $history->CurrentStatusId = 1;
                    $history->UserId = Yii::$app->user->identity->UserId;
                    $history->save(true);

                    Yii::$app->session->setFlash('success', "Record successfully create.");
                } else {
                    return ['success' => false, 'errors' => $model->getErrors()];

                    //Yii::$app->session->setFlash('error', $model->getErrors());
                }
                return $this->redirect(Yii::$app->homeUrl . 'training/index');
            }

            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        } else {

            return "Sorry , your access is denied";
        }
    }

    /**
     * Updates an existing Tbltraining model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $TrainingId Training ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($TrainingId)
    {

        if (yii::$app->user->can('Training List-Edit')) {

            $model = $this->findModel($TrainingId);
            $history = new Tbltrainingstatushistory();

            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }


            if ($model->load(Yii::$app->request->post())) {


                if ($model->save(true)) {


                    /* for Training Status History */
                    //Tbltrainingstatushistory::updateAll(['CurrentStatusId' => 0], ['where', 'TrainingId ='. $TrainingId]);

                    $command = \Yii::$app->db->createCommand('UPDATE tbltrainingstatushistory SET CurrentStatusId = 0  WHERE TrainingId = ' . $TrainingId);
                    $command->execute();

                    $history->TrainingId = $model->TrainingId;
                    $history->TrainingStatusId = 1;
                    $history->Remarks = "";
                    $history->CurrentStatusId = 1;
                    $history->UserId = Yii::$app->user->identity->UserId;
                    $history->save(true);

                    Yii::$app->session->setFlash('success', "Record  successfully Update.");
                } else {
                    Yii::$app->session->setFlash('error', "Record not saved.");
                }
                // return $this->redirect(['index']);
                return $this->redirect(Yii::$app->homeUrl . 'training/index');
            }

            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        } else {

            return "Sorry , your access is denied";
        }
    }



    /**
     * Deletes an existing Tbltraining model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $TrainingId Training ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($TrainingId)
    {
        $this->findModel($TrainingId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tbltraining model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $TrainingId Training ID
     * @return Tbltraining the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($TrainingId)
    {
        if (($model = Tbltraining::findOne(['TrainingId' => $TrainingId])) !== null) {
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

    public function actionGenerateattendance()
    {
        $TrainingId = base64_decode(Yii::$app->request->get('TrainingId'));

        $stmt = "SELECT TrainingId 
        FROM tbltraining 
        WHERE TrainingId = $TrainingId";

        $checkTraining = Yii::$app->db->createCommand($stmt)->queryAll();

        if (!empty($checkTraining)) {
            return true;
        } else {
            return false;
        }
    }

    public function actionSendemail()
    {
        //for style css
        // $table = 'style=" border-collapse: collapse;  width: 100%;"';
        // $css_td_tr_col = 'style="  border: 1px solid #ddd; padding: 8px;  border-bottom: 1px solid #ddd; background-color: #04AA6D;  color: white;"';
        // $css_td_tr_col_red = 'style="  border: 1px solid #ddd; padding: 8px;  border-bottom: 1px solid #ddd; background-color:red;  color: white;"';
        // $css_td_tr = 'style="  border: 1px solid #ddd; padding: 8px;  border-bottom: 1px solid #ddd; "';
        // $black = 'style="  border: 1px solid #000; background-color:#000; width="8";"';

        $trainingId = Yii::$app->request->post('trainingId');
        $encTrainingId = base64_encode($trainingId);
        $date = date('Ymd');
        $encDate = base64_encode($date);


        $attendSql = "SELECT tbltraining.TrainingTitle, tbltrainingattandance.UserId, tbluser.FullName, tbluser.EmailAddress 
        FROM tbltrainingpaticipant
        INNER JOIN tbltrainingattandance ON tbltrainingattandance.TrainingId = tbltrainingpaticipant.TrainingId
        INNER JOIN tbltraining ON tbltraining.TrainingId = tbltrainingpaticipant.TrainingId
        INNER JOIN tbluser ON tbluser.UserId = tbltrainingattandance.UserId
        WHERE tbltrainingpaticipant.TrainingId = $trainingId AND tbltrainingattandance.AttandId = 1
		AND NOT EXISTS (
		SELECT UserId
		FROM tbltrainingevalmarks
		WHERE tbltrainingevalmarks.UserId = tbltrainingpaticipant.UserId AND tbltrainingevalmarks.TrainingId = $trainingId
		)
        GROUP BY tbltrainingpaticipant.TrainingId, tbltrainingattandance.UserId";

        $dateSql = "SELECT tbltraining.TrainingId, tbltraining.TrainingTitle, tbltraining.TrainingObjective, tbltraining.TrainingVenue, 
        tbltraining.TrainerId, tbltraining.RequestId, tbltraining.Remarks, tbltraining.TrainingCategoryId, tbltraining.TrainingClaimId, 
        tbltraining.TrainingVenueId, tbltraining.TrainingGroupId, DATE_FORMAT(QTraningDuration.TrainingStart, '%D %M %Y') AS TrainingStart,
        DATE_FORMAT(QTraningDuration.TrainingEnd, '%D %M %Y') AS TrainingEnd, QTraningDuration.TotHours, QTraningDuration.TotDays, 
        tbluser.FullName, tbltrainingcategory.TrainingCategory, QTrainingStatus.TrainingStatus, QTrainingStatus.TrainingStatusId, 
        COALESCE(QTotAttan.TotStaff,0) as TotStaff
        FROM
        tbltraining
        INNER JOIN tbluser ON tbltraining.RequestId = tbluser.UserId
        INNER JOIN tbltrainingcategory ON tbltraining.TrainingCategoryId = tbltrainingcategory.TrainingCategoryId
        LEFT JOIN (SELECT
        tbltrainingduration.TrainingDurationId,
        tbltrainingduration.TrainingId,
        min(tbltrainingduration.TrainingDate) as TrainingStart,
        max(tbltrainingduration.TrainingDate) as TrainingEnd,
        Sum(tbltrainingduration.TraningTotHours) as TotHours,
        count(tbltrainingduration.TrainingDate) as TotDays
        from tbltrainingduration
        GROUP BY tbltrainingduration.TrainingId) AS QTraningDuration ON QTraningDuration.TrainingId = tbltraining.TrainingId
        Left join (SELECT
        tbltrainingstatushistory.TrainingId,
        tbltrainingstatushistory.Remarks,
        tbltrainingstatushistory.TransactionDate,
        tbltrainingstatus.TrainingStatus,
        tbltrainingstatushistory.TrainingStatusId
        FROM
        tbltrainingstatushistory
        INNER JOIN tbltrainingstatus ON tbltrainingstatushistory.TrainingStatusId = tbltrainingstatus.TrainingStatusId
        where tbltrainingstatushistory.CurrentStatusId = 1
        )QTrainingStatus on QTrainingStatus.TrainingId = tbltraining.TrainingId
        Left join (SELECT
        tbltrainingattandance.TrainingId,
        count(DISTINCT tbltrainingattandance.UserId) as TotStaff
        from tbltrainingattandance
        GROUP BY tbltrainingattandance.TrainingId)QTotAttan on  QTotAttan.TrainingId = tbltraining.TrainingId
		WHERE tbltraining.TrainingId = $trainingId
		Group By tbltraining.TrainingId ORDER BY  tbltraining.TrainingTitle";

        $attendList = Yii::$app->db->createCommand($attendSql)->queryAll();
        $dateList = Yii::$app->db->createCommand($dateSql)->queryAll();

        $TrainingStart = $dateList[0]['TrainingStart'];
        $TrainingEnd = $dateList[0]['TrainingEnd'];

        foreach ($attendList as $row) {

            $encUserId = base64_encode($row['UserId']);

            $data = "Dear " . $row['FullName'] . ",<br><br>";
            $data .= "Thank you for attending the training, <b>" . $row['TrainingTitle'] . "</b> on the date, ";
            if ($TrainingEnd != '') {
                $data .= $TrainingStart . " to " . $TrainingEnd . ".<br><br>";
            } else {
                $data .= $TrainingStart . ".<br><br>";
            }
            $data .= "We need your time to fill up the training evaluation feedback.<br><br>";
            $data .= "Please click <a href='https://apps.city.edu.my" . Url::base() . "/trainingevaluation/default?userId=$encUserId&trainingId=$encTrainingId&date=$encDate'>here</a> to fill up the evaluation form.<br><br>";
            $data .= "Your feedback is important for future training development.<br><br>";
            $data .= "<b>This link will expired within 5 days from this email date<b>.<br><br>";
            //$email =  Yii::$app->mailer_creditcontrol->compose("@app/mail/layouts/html", ["content" => $content]);

            $subject_mail   = 'Training: Evaluation/Feedback';
            $setToEmail     = $row['EmailAddress'];
            $setToName      = $row['FullName'];

            $emailContent = $this->renderPartial("@app/mail/layouts/trainingevaluation", ["content" => $data]);

            $email =  Yii::$app->mailer_training->compose();
            $email->setTo([$setToEmail => $setToName]);

            //base on user login   user ->email
            $email->setFrom(['training@city.edu.my' => 'Learning & Development']);
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
                // Yii::$app->getSession()->setFlash('error', 'Error while sending email: ' . $email->ErrorInfo);
            }
        }
        return true;
        //return $this->refresh();
        //return $this->render('index');
    }

    public function actionGeneratereport()
    {
        $TrainingId = base64_decode(Yii::$app->request->get('TrainingId'));

        $stmt = "SELECT TrainingId 
        FROM tbltrainingevalmarks 
        WHERE TrainingId = $TrainingId";

        $checkEvaluation = Yii::$app->db->createCommand($stmt)->queryAll();

        if (!empty($checkEvaluation)) {
            return true;
        } else {
            return false;
        }
    }

    public function actionTrainingdetailreport()
    {
        return $this->renderPartial('trainingdetailreport');
    }

    public function actionReport()
    {
        return $this->render('report');
    }
}
