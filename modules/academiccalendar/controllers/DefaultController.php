<?php

namespace app\modules\academiccalendar\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;
use yii\web\View;
use yii\helpers\FileHelper;

use app\modules\academiccalendar\models\tbluploaddocument;

/**
 * Default controller for the `academiccalendar` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public $layout = '@app/views/layouts/lexapurple_layouts';

    public function beforeAction($action)
    {
        if (!isset(Yii::$app->user->identity->UserId)) {
            return Yii::$app->response->redirect(['site/login'])->send();
        }
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        if (Yii::$app->user->can('Academic-Calendar-Index')) {
            return $this->render('index');
        } else {
            throw new ForbiddenHttpException(Yii::t('app', 'Access denied. You do not have permission to access this feature.'));
        }
    }

    public function actionCreate()
    {
        if (Yii::$app->user->can('Academic-Calendar-Upload')) {
            $model = new tbluploaddocument();

            return $this->renderAjax('create', ['model' => $model]);
        } else {
            return "Sorry , your access is denied";
        }
    }

    public function actionUpload()
    {
        $model = new tbluploaddocument();

        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            $model->UploadDocumentTypeId = 3;
            $model->UploadDocumentCategoryId = Yii::$app->request->post('UploadDocumentCategoryId') ?? 0;
            $model->UploadDocumentTitle = trim(str_replace('_', ' ', Yii::$app->request->post('UploadDocumentName')));
            $model->UploadDocument = trim(preg_replace('/(?<=\S)[\s\p{P}]+(?=\S)/u', '_', Yii::$app->request->post('UploadDocumentName')));
            $model->Remarks = Yii::$app->request->post('Tbluploaddocument')['Remarks'];
            $model->Year = Yii::$app->request->post('Tbluploaddocument')['Year'];
            $model->UserId = Yii::$app->user->identity->UserId;
            $model->Visibility = 1;

            if ($model->save()) {
                $model->UploadDocument = $model->UploadDocumentId . '_' . $model->UploadDocument;
                $document = UploadedFile::getInstances($model, 'UploadDocument');

                $uploadPath = Yii::getAlias('@documentupload/academiccalendar/' . $model->Year);
                if (!is_dir($uploadPath)) {
                    FileHelper::createDirectory($uploadPath);
                }

                foreach ($document as $key => $files) {
                    $model->UploadDocument = $uploadPath . '/' . $model->UploadDocument . '.' . $files->extension;
                    $model->save();
                    $files->saveAs($model->UploadDocument);
                }

                return ['success' => 'success'];
            } else {
                return $model->getErrors();
            }
        } else {
            die(print_r($model->getErrors()));
        }
    }

    public function actionDocumentlist()
    {
        $searchbox = Yii::$app->request->get('txtSearch');

        if ($searchbox == '') {
            $searchbox = '.*';
        }

        $stmt = "SELECT UploadDocumentId, Year, UploadDocumentTitle, 
        CONCAT(tbluser.FullName, '<br>',DATE_FORMAT(tbluploaddocument.TransactionDate, '%d/%m/%Y %H:%i:%s')) AS UploadBy, 
        CASE 
            WHEN tbluploaddocument.UploadDocumentCategoryId = 1 THEN 'Student Portal'
            WHEN tbluploaddocument.UploadDocumentCategoryId = 2 THEN 'Lecturer Portal'
            ELSE 'N/A' 
        END AS UploadDocumentCategory, tbluploaddocument.Remarks, tbluploaddocument.StatusId, tblstatusai.Status, Visibility
        FROM tbluploaddocument 
        INNER JOIN tbluser ON tbluser.UserId = tbluploaddocument.UserId
        INNER JOIN tblstatusai ON tblstatusai.StatusId = tbluploaddocument.StatusId
        WHERE (UploadDocument REGEXP '$searchbox' OR YEAR REGEXP '$searchbox') AND UploadDocumentTypeId = 3 AND Visibility = 1
        ORDER BY tbluploaddocument.TransactionDate DESC
        ";
        // AND tblusertest.StatusId REGEXP '$statusId'
        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }

    public function actionDownload()
    {
        $UploadDocumentId = Yii::$app->request->get('id');

        $stmt = "SELECT UploadDocumentId, UploadDocument, SUBSTRING_INDEX(UploadDocument, '/', -1) AS UploadDocumentName, Year
        FROM tbluploaddocument 
        WHERE UploadDocumentId = $UploadDocumentId
        ";

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        $filePath = $data[0]['UploadDocument'];
        $fileName = $data[0]['UploadDocumentName'];

        if (file_exists($filePath)) {
            Yii::$app->response->sendFile($filePath, $fileName, ['inline' => false]);
        } else {
            Yii::$app->session->setFlash('error', 'File not found.');
            return $this->redirect(['index']);
        }
    }

    public function actionDelete()
    {
        $UploadDocumentId = Yii::$app->request->get('id');

        $model = tbluploaddocument::findOne(['UploadDocumentId' => $UploadDocumentId]);

        $model->Visibility = 2;

        if ($model->save()) {

            Yii::$app->response->format = Response::FORMAT_JSON;

            return ['success' => 'success'];
        }
    }

    public function actionEdit()
    {
        $UploadDocumentId = Yii::$app->request->get('id');

        $model = tbluploaddocument::findOne(['UploadDocumentId' => $UploadDocumentId]);

        if ($model->StatusId == 1) {
            $model->StatusId = 2;
        } else {
            $model->StatusId = 1;
        }

        if ($model->save()) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => 'success'];
        } else {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['error' => 'Failed to update record'];
        }
    }
}
