<?php
namespace app\modules\rmc\controllers;

use app\models\Tblrmcdocument;
use app\models\Tblrmcdocumenttype;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;

use app\models\tblrmc;
use app\models\tblrmcstatus;

class UploadController extends Controller
{
    public function actionUploadmodal()
    {
        $RMCDocumentId = Yii::$app->request->get('RMCDocumentId');

        if ($RMCDocumentId) {
            $model = Tblrmcdocument::findOne(['RMCDocumentId' => $RMCDocumentId]);
        } else {
            $model = new Tblrmcdocument();
        }
        $doctype = Tblrmcdocumenttype::find()->select(['RMCDocumentType'])->indexBy('RMCDocumentTypeId')->column();

        return $this->renderAjax('upload', [
            'model' => $model,
            'doctype' => $doctype, // Pass Document type list to view
        ]);
    }

    public function actionUpload()
    {
        $userId = Yii::$app->user->identity->UserId;
        $RMCId = base64_decode(Yii::$app->request->post('RMCId'));
        $RMCDocumentTypeId = Yii::$app->request->post('Tblrmcdocument')['RMCDocumentTypeId']; // Get RMCDocumentTypeId from form

        // Always create a new instance of tblrmcdocument
        $model = new tblrmcdocument();

        // Manually set required values if needed
        $model->RMCId = $RMCId;
        $model->UserId = $userId;
        $model->RMCDocumentTypeId = $RMCDocumentTypeId; // Set RMCDocumentTypeId based on form input

        $uploadedFile = UploadedFile::getInstance($model, 'RMCDocument');
        if ($uploadedFile) {
            $dir = Yii::getAlias('@rmcimage');
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            $filePath = $dir . '/' . $uploadedFile->name;
            if ($uploadedFile->saveAs($filePath)) {
                $model->RMCDocument = $uploadedFile->name; // Set RMCDocument to the file name
                $model->RMCDocumentLocation = $filePath; // Set RMCDocumentLocation to the file location
            }
        }

        if ($model->save()) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => true, 'RMCDocumentId' => $model->RMCDocumentId];
        } else {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => false, 'message' => 'Failed to save data.', 'errors' => $model->errors];
        }
    }

    public function actionViewmodal()
    {
        $RMCId = base64_decode(Yii::$app->request->get('RMCId'));
        // Retrieve documents filtered by RMCId
        $model = Tblrmcdocument::find()->where(['RMCId' => $RMCId])->all();

        return $this->renderAjax('view', ['files' => $model]);
    }

    public function actionViewFile($fileName)
    {
        $filePath = Yii::getAlias('@rmcimage') . '/' . $fileName;
        if (file_exists($filePath)) {
            return Yii::$app->response->sendFile($filePath, null, ['inline' => true]);
        }
        throw new NotFoundHttpException('File not found.');
    }

    public function actionDownloadFile($fileName)
    {
        $filePath = Yii::getAlias('@rmcimage') . '/' . $fileName;
        if (file_exists($filePath)) {
            return Yii::$app->response->sendFile($filePath);
        }
        throw new NotFoundHttpException('File not found.');
    }

    public function actionDeleteFile($id)
    {
        $model = Tblrmcdocument::findOne($id);
        if ($model) {
            $model->delete();
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => true];
        }
        throw new NotFoundHttpException('File not found.');
    }
}
