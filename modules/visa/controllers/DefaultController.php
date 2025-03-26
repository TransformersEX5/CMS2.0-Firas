<?php

namespace app\modules\visa\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

use yii\helpers\FileHelper;
use yii\web\UploadedFile;

use PhpOffice\PhpSpreadsheet\IOFactory;

use app\modules\visa\models\tblapplicationemgs;

/**
 * Default controller for the `visa` module
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
        return $this->render('index');
    }

    public function actionApplicationemgs()
    {
        return $this->render('applicationemgs');
    }

    public function actionUpload()
    {
        if (yii::$app->user->can('Visa Unit - Upload')) {

            $model = new tblapplicationemgs();

            return $this->renderAjax('upload', ['model' => $model]);
        } else {


            return "Sorry , your access is denied";
        }
    }

    public function actionUploadexcel()
    {
        $model = new tblapplicationemgs();

        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {

            $excelFile = UploadedFile::getInstance($model, 'StudNRICPassportNo');

            if ($excelFile) {
                $filePath = $excelFile->baseName . '.' . $excelFile->extension;
                if ($excelFile->saveAs($filePath)) {
                    $this->readExcelAndInsert($filePath);

                    tblapplicationemgs::updateAll(['StatusId' => 0]);

                    $sql = "UPDATE tblapplicationemgs
                    JOIN (
                        SELECT ApplicantFullName, StudNRICPassportNo, MAX(TransactionDate) AS MaxTransactionDate, StatusId 
                        FROM tblapplicationemgs
                        GROUP BY StudNRICPassportNo
                    ) AS maxDate ON tblapplicationemgs.StudNRICPassportNo = maxDate.StudNRICPassportNo
                       AND tblapplicationemgs.TransactionDate = maxDate.MaxTransactionDate
                    SET tblapplicationemgs.StatusId = 1";

                    Yii::$app->db->createCommand($sql)->queryAll();

                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ['success' => 'success'];
                }
            }
        }
    }

    private function readExcelAndInsert($filePath)
    {
        $spreadsheet = IOFactory::load($filePath);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        foreach ($sheetData as $row) {
            $newRecord = new tblapplicationemgs();
            $newRecord->ApplicationId = $row[0];
            $newRecord->SoftCopyDate = date('Y-m-d', strtotime($row[1]));
            $newRecord->ApplicationReceivedDate = date('Y-m-d', strtotime($row[2]));
            $newRecord->ApplicantFullName = $row[3];
            $newRecord->Region = $row[4];
            $newRecord->Nationality = $row[5];
            $newRecord->State = $row[6];
            $newRecord->City = $row[7];
            $newRecord->StudNRICPassportNo = $row[8];
            $newRecord->PassportIssuingCountry = $row[9];
            $newRecord->CourseName = $row[10];
            $newRecord->EMGSStatus = $row[11];
            $newRecord->StudentPassExpiryDate = ($row[12] === 'N/A') ? date('Y-m-d', strtotime('00/00/0000')) : date('Y-m-d', strtotime($row[12]));
            $newRecord->UpdatedAt = date('Y-m-d', strtotime($row[13]));
            $newRecord->StatusId = 1;
            $newRecord->UserId = Yii::$app->user->identity->UserId;
            $newRecord->save();
        }
    }

    public function actionEmgslist()
    {
        $searchbox = Yii::$app->request->get('txtSearch');

        if ($searchbox == '') {
            $searchbox = '.*';
        }

        $stmt = "SELECT ApplicationEMGSId, ApplicationId, DATE_FORMAT(ApplicationReceivedDate, '%d/%m/%Y') AS ApplicationReceivedDate, 
        ApplicantFullName, Nationality, StudNRICPassportNo, PassportIssuingCountry, CourseName, EMGSStatus, 
        CASE WHEN StudentPassExpiryDate = '1970-01-01' THEN 'N/A' ELSE DATE_FORMAT(StudentPassExpiryDate, '%d/%m/%Y') END AS StudentPassExpiryDate, 
        DATE_FORMAT(UpdatedAt, '%d/%m/%Y') AS UpdatedAt, TransactionDate
        FROM tblapplicationemgs 
        WHERE (ApplicantFullName REGEXP '$searchbox' OR StudNRICPassportNo REGEXP '$searchbox') AND StatusId = 1
        GROUP BY StudNRICPassportNo
        ";

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }









    public function actionDownload()
    {
        $filePath = 'uploads/Application EMGS Template 2024.xlsx';
        $fileName = 'Application EMGS Template 2024.xlsx';

        if (file_exists($filePath)) {
            Yii::$app->response->sendFile($filePath, $fileName, ['inline' => false]);
        } else {
            Yii::$app->session->setFlash('error', 'File not found.');
            return $this->redirect(['index']);
        }
    }
}
