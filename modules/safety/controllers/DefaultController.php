<?php

namespace app\modules\safety\controllers;

use Yii;
use yii\web\Response;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

use app\modules\safety\models\tblsafety;
use app\modules\safety\models\Tblsafetyadmin;
use app\modules\safety\models\tblsafetyimage;
use app\modules\safety\models\tblsafetyincharge;

/**
 * Default controller for the `safety` module
 */
class DefaultController extends Controller
{
    public $layout = '@app/views/layouts/lexapurple_layouts';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionHazardreport()
    {
        return $this->render('hazardreport');
    }

    public function actionCreate()
    {
        $safetyId = Yii::$app->request->get('safetyId');
        if ($safetyId == 0) {
            $model = new tblsafety();
            $model2 = new tblsafetyimage();
        } else {
            $model = tblsafety::findOne(['SafetyId' => $safetyId]);
            $model2 = tblsafetyimage::findOne(['SafetyId' => $safetyId]);
        }

        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            $model->UserId = Yii::$app->user->identity->UserId;
            $document = UploadedFile::getInstances($model2, 'file_name');

            foreach ($document as $key => $files) {
                $model2->file_name = $files;
            }

            if (!$model->validate()) {
                return $model->getErrors();
            }

            if (!$model2->validate('file_name')) {
                return $model2->getErrors();
            }

            if ($model->save()) {
                $model3 = new tblsafetyadmin();

                $model3->SafetyId = $model->SafetyId;
                $model3->SafetyStatusId = 1;
                // $model3->SafetyRemarks = $model->SafetyId;
                $model3->CurrenStatustId = 1;
                $model3->UserId = Yii::$app->user->identity->UserId;
                // $model3->TransactionDate = '2024-02-23 17:04:16';

                if ($model3->save()) {
                    if ($model2->load(Yii::$app->request->post())) {

                        $document = UploadedFile::getInstances($model2, 'file_name');

                        $uploadPath = Yii::getAlias('@docsafety/');

                        if (!is_dir($uploadPath)) {
                            FileHelper::createDirectory($uploadPath);
                        }

                        foreach ($document as $key => $files) {
                            $model2 = new tblsafetyimage();
                            $model2->SafetyId = $model->SafetyId;
                            $model2->file_name = $files;
                            $model2->SafetyAdminId = 1;
                            $model2->CategoryId = 1;
                            $model2->UserId = Yii::$app->user->identity->UserId;
                            $model2->TransactionDate = '2024-02-23 17:04:16';

                            if ($model2->save()) {
                                $files->saveAs($uploadPath . '/' . $model2->file_name);
                            } else {
                                die(print_r($model2->getErrors()));
                            }
                        }
                        return ['success' => 'success'];
                    }
                } else {
                    die(print_r($model->getErrors()));
                }
            } else {
                return $model->getErrors();
            }
        }
        return $this->renderAjax('hazarddetails', ['model' => $model, 'model2' => $model2]);
    }

    public function actionView()
    {
        $safetyId = Yii::$app->request->get('safetyId');

        //Hazard Report Description
        $sql = "SELECT SafetyDesc, SafetyLocation, a.FullName AS ReportedBy, 
        COALESCE(tbluser.FullName, 'No Staff Assigned') AS StaffAssigned
        FROM tblsafety
        LEFT JOIN tblsafetyincharge ON tblsafetyincharge.SafetyId = tblsafety.SafetyId
        LEFT JOIN tbluser ON tbluser.UserId = tblsafetyincharge.UserId
        INNER JOIN tbluser a ON a.UserId = tblsafety.UserId
        WHERE tblsafety.SafetyId = $safetyId";

        //Hazard Report History
        $sql2 = "SELECT tblsafetyadmin.SafetyAdminId, 
        CASE WHEN SafetyRemarks IS NULL AND tblsafetyadmin.SafetyStatusId = 1 THEN 'Hazard Reported' ELSE SafetyRemarks END AS SafetyRemarks, 
        tblsafetystatus.SafetyStatusDesc, file_name, DATE_FORMAT(tblsafetyadmin.TransactionDate, '%d-%m-%Y %H:%i:%s') AS TransactionDate
        FROM tblsafetyadmin
        INNER JOIN tblsafetystatus ON tblsafetystatus.SafetyStatusId = tblsafetyadmin.SafetyStatusId
        LEFT JOIN 
        (
        SELECT SafetyAdminId, file_name FROM tblsafetyimage WHERE SafetyId = $safetyId AND CategoryId = 2
        )safetyimage ON safetyimage.SafetyAdminId = tblsafetyadmin.SafetyAdminId
        WHERE tblsafetyadmin.SafetyId = $safetyId 
        ORDER BY tblsafetyadmin.TransactionDate ASC";

        $data = Yii::$app->db->createCommand($sql)->queryAll();
        $data2 = Yii::$app->db->createCommand($sql2)->queryAll();

        $model = tblsafetyimage::find()->where(['SafetyId' => $safetyId])->andWhere(['CategoryId' => 1])->all();

        return $this->renderAjax('hazardview', ['model' => $model, 'data' => $data, 'data2' => $data2]);
    }

    public function actionFollowup()
    {
        $safetyId = Yii::$app->request->get('safetyId');

        //Hazard Report Description
        $sql = "SELECT SafetyDesc, SafetyLocation, a.FullName AS ReportedBy,COALESCE(tbluser.FullName, 'No Staff Assigned') AS StaffAssigned
        FROM tblsafety
        LEFT JOIN tblsafetyincharge ON tblsafetyincharge.SafetyId = tblsafety.SafetyId
        LEFT JOIN tbluser ON tbluser.UserId = tblsafetyincharge.UserId
        INNER JOIN tbluser a ON a.UserId = tblsafety.UserId
        WHERE tblsafety.SafetyId = $safetyId";

        $data = Yii::$app->db->createCommand($sql)->queryAll();

        $model = tblsafetyimage::find()->where(['SafetyId' => $safetyId])->andWhere(['CategoryId' => 1])->all();
        $model2 = tblsafetyadmin::findOne(['SafetyId' => $safetyId, 'CurrenStatustId' => 1]);
        $model3 = new tblsafetyimage();

        if ($model2->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            // $document = UploadedFile::getInstances($model3, 'file_name');

            // foreach ($document as $key => $files) {
            //     $model3->file_name = $files;
            // }

            // if (!$model2->validate()) {
            //     return $model2->getErrors();
            // }

            // if (!$model3->validate('file_name')) {
            //     return $model3->getErrors();
            // }

            tblsafetyadmin::updateAll(['CurrenStatustId' => 0], ['SafetyId' => $safetyId]);

            $model2 = new tblsafetyadmin();
            $model2->load(Yii::$app->request->post());
            $model2->SafetyId = $safetyId;
            $model2->UserId = Yii::$app->user->identity->UserId;

            if ($model2->save()) {
                if ($model3->load(Yii::$app->request->post())) {

                    $document = UploadedFile::getInstances($model3, 'file_name');

                    $uploadPath = \Yii::getAlias('@docsafety');
                    // Yii::getAlias('@docsafety/' );

                    if (!is_dir($uploadPath)) {
                        FileHelper::createDirectory($uploadPath);
                    }

                    foreach ($document as $key => $files) {
                        // $model3 = new tblsafetyimage();
                        $model3->SafetyId = $safetyId;
                        $model3->file_name = $files;
                        $model3->SafetyAdminId = $model2->SafetyAdminId;
                        $model3->CategoryId = 2;
                        $model3->UserId = Yii::$app->user->identity->UserId;
                        // $model3->TransactionDate = '2024-02-23 17:04:16';

                        if ($model3->save()) {

                            if ($files->saveAs($uploadPath . '/' . $model3->file_name)) {
                                return ['success' => 'success'];
                            } else {
                                die(print_r($model3->getErrors()));
                            }
                        } else {
                            die(print_r($model2->getErrors()));
                        }
                    }
                    return ['success' => 'success'];
                }
            }
        }
        return $this->renderAjax('hazardfollowup', ['model' => $model, 'model2' => $model2, 'model3' => $model3, 'data' => $data]);
    }

    public function actionAssign()
    {
        $safetyId = Yii::$app->request->get('safetyId');

        $model = tblsafetyincharge::findOne(['SafetyId' => $safetyId]);

        $sql = "SELECT SafetyId, tblsafetyincharge.UserId, FullName
        FROM tblsafetyincharge
        INNER JOIN tbluser ON tbluser.UserId = tblsafetyincharge.UserId 
        WHERE SafetyId = $safetyId";

        $data = Yii::$app->db->createCommand($sql)->queryAll();

        return $this->renderAjax('assign', ['model' => $model, 'data' => $data]);
    }

    public function actionRemove()
    {        
        $SafetyId = Yii::$app->request->get('safetyId');
        $UserId = Yii::$app->user->identity->UserId;

        $model = tblsafety::findOne(['SafetyId' => $SafetyId, 'UserId' => $UserId]);

        if($model->delete())
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ['success' => 'success'];
        }
    }

    public function actionAssignstaff()
    {        
        $SafetyId = Yii::$app->request->get('SafetyId');

        $model = new tblsafetyincharge();

        $model->SafetyId = $SafetyId;
        $model->UserId = Yii::$app->request->post('UserId');

        if($model->save())
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ['success' => 'success'];
        }
    }

    public function actionRemovestaff()
    {        
        $SafetyId = Yii::$app->request->get('SafetyId');
        $UserId = Yii::$app->request->get('UserId');

        $model = tblsafetyincharge::findOne(['SafetyId' => $SafetyId, 'UserId' => $UserId]);

        if($model->delete())
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ['success' => 'success'];
        }
    }

    public function actionPickup()
    {        
        $model = new tblsafetyincharge();

        $model->SafetyId = Yii::$app->request->get('safetyId');
        $model->UserId = Yii::$app->user->identity->UserId;

        if($model->save())
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ['success' => 'success'];
        }
    }

    public function actionRefreshtable(){
        //need improve
        $safetyId = Yii::$app->request->get('safetyId');

        $sql = "SELECT SafetyId, tblsafetyincharge.UserId, FullName
        FROM tblsafetyincharge
        INNER JOIN tbluser ON tbluser.UserId = tblsafetyincharge.UserId 
        WHERE SafetyId = $safetyId";

        $data = Yii::$app->db->createCommand($sql)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return $data;
    }

    public function actionGetsafetylist()
    {
        $searchbox = Yii::$app->request->post('txtSearch');

        if ($searchbox == '') {
            $searchbox = '.*';
        }

        $sql = "SELECT tblsafety.UserId, SafetyDesc, SafetyStatusDesc AS Status, tblsafetyadmin.SafetyStatusId, tbluser.FullName, 
        tblsafety.SafetyId, PImage.file_name, tblsafetyimage.SafetyAdminId, 
        CONCAT(DATE_FORMAT(tblsafetyadmin.TransactionDate,'%d-%m-%Y'), '<br>', 
        DATE_FORMAT(tblsafetyadmin.TransactionDate,'%H:%i:%s')) AS TransactionDate, 
        CONCAT(COALESCE(A.FullName,0), ';', tblsafety.SafetyId, ';', COALESCE(A.UserId, '0')) AS Incharge, 
        COALESCE(GROUP_CONCAT(DISTINCT A.UserId SEPARATOR ';'), 0) AS Incharges
        from tblsafety
        INNER JOIN (SELECT * FROM tblsafetyadmin WHERE CurrenStatustId = 1) tblsafetyadmin ON tblsafetyadmin.SafetyId = tblsafety.SafetyId
        INNER JOIN tblsafetystatus ON tblsafetystatus.SafetyStatusId = tblsafetyadmin.SafetyStatusId
        INNER JOIN tblsafetyimage ON tblsafetyimage.SafetyId = tblsafety.SafetyId
        INNER JOIN tbluser ON tbluser.UserId = tblsafety.UserId
        LEFT JOIN tblsafetyincharge ON tblsafetyincharge.SafetyId = tblsafety.SafetyId
        LEFT JOIN tbluser A ON A.UserId = tblsafetyincharge.UserId
        INNER JOIN (SELECT * FROM tblsafetyimage WHERE CategoryId = 1 ORDER BY SafetyImageId)PImage ON PImage.SafetyId = tblsafety.SafetyId
        WHERE (SafetyDesc REGEXP '$searchbox' OR tbluser.FullName REGEXP '$searchbox')
        GROUP BY tblsafety.SafetyId
        ORDER BY tblsafety.SafetyId DESC";

        $data = Yii::$app->db->createCommand($sql)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }

    public function actionGetstaffsummary()
    {
        $txtYear = Yii::$app->request->post('txtYear');

        if ($txtYear == '') {
            $txtYear = '.*';
        }
        
        $sql = "SELECT tblsafetyincharge.UserId, COALESCE(FullName, 'NO STAFF ASSIGNED') AS FullName, SafetyStatusDesc, 
        SUM(CASE WHEN tblsafetyadmin.SafetyStatusId = 1 THEN 1 ELSE 0 END) AS 'New', 
        SUM(CASE WHEN tblsafetyadmin.SafetyStatusId = 2 THEN 1 ELSE 0 END) AS 'On-going', 
        SUM(CASE WHEN tblsafetyadmin.SafetyStatusId = 3 THEN 1 ELSE 0 END) AS 'Completed', 
        SUM(CASE WHEN tblsafetyadmin.SafetyStatusId = 5 THEN 1 ELSE 0 END) AS 'Pending'
        FROM tblsafety
        LEFT JOIN tblsafetyincharge ON tblsafetyincharge.SafetyId = tblsafety.SafetyId
        LEFT JOIN tbluser ON tbluser.UserId = tblsafetyincharge.UserId
        INNER JOIN tblsafetyadmin ON tblsafetyadmin.SafetyId = tblsafety.SafetyId
        INNER JOIN tblsafetystatus ON tblsafetystatus.SafetyStatusId = tblsafetyadmin.SafetyStatusId
        WHERE ((CurrenStatustId = 1 AND FullName IS NULL) OR (CurrenStatustId = 1 AND tbluser.StatusId = 1))
        AND YEAR(tblsafety.TransactionDate) REGEXP '$txtYear'
        GROUP BY FullName
        ORDER BY CASE WHEN FullName IS NULL THEN 0 ELSE 1 END, FullName";

        $data = Yii::$app->db->createCommand($sql)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }

    public function actionEncode64()
    {
        $location =  \Yii::getAlias('@docsafety');
        $id = base64_decode(Yii::$app->request->get('id'));

        $imageData = file_get_contents($location . '/' . $id);
        return $imageData;
    }
}




