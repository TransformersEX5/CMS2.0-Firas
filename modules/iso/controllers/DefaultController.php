<?php

namespace app\modules\iso\controllers;

use Yii;
use yii\web\Response;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

use app\modules\iso\models\tblisodepartdocument;
use app\modules\iso\models\tblisodepartment;
use app\modules\iso\models\tblisodoctype;

/**
 * Default controller for the `iso` module
 */
class DefaultController extends Controller
{
    public $layout = '@app/views/layouts/lexapurple_layouts';

    public function actionIndex()
    {
        $model = tblisodepartment::find()->orderBy('IsoDepartDecc')->all();

        return $this->render('index', ['model' => $model]);
    }

    public function getIsodocument($IsoDepartId)
    {
        $sql = "SELECT
        QQ.IsodepartdocId,
        tblisodoctype.IsoDocTypeId,
        tblisodoctype.IsoDocDescription,
        QQ.IsoDepartId,
        COALESCE(QQ.log_filename,'') as log_filename,
        QQ.link
        FROM
        tblisodoctype
        LEFT JOIN (SELECT
        tblisodepartdocument.IsodepartdocId,
        tblisodepartdocument.IsoDepartId,
        tblisodepartdocument.IsoDocTypeId,
        tblisodepartdocument.FileCategoryId,
        tblisodepartdocument.Description,
        tblisodepartdocument.log_filename,
        tblisodepartdocument.log_size,
        tblisodepartdocument.log_ip,
        tblisodepartdocument.log_date,
        tblisodepartdocument.link,
        tblisodepartdocument.FileStatusId,
        tblisodepartdocument.UserId
        FROM tblisodepartdocument 
        WHERE tblisodepartdocument.IsoDepartId = 1 AND tblisodepartdocument.FileCategoryId = 2
        )QQ ON QQ.IsoDocTypeId = tblisodoctype.IsoDocTypeId
        ORDER BY tblisodoctype.IsoDocTypeId";

        $data = Yii::$app->db->createCommand($sql)->queryAll();

        return $data;
    }

    public function actionDocumentdownload()
    {
        $link = base64_decode(Yii::$app->request->get('link'));
        $filename = base64_decode(Yii::$app->request->get('filename'));

        $filePath = 'E:/QAADocument/'.$link.'/'.$filename;

        if (file_exists($filePath)) {
            Yii::$app->response->sendFile($filePath, $filename, ['inline' => false]);
        } else {
            die($filePath);
            Yii::$app->session->setFlash('error', 'File not found.');
            return $this->redirect(['index']);
        }
    }

    public function actionDocumentview()
    {
        $link = base64_decode(Yii::$app->request->get('link'));
        $filename = base64_decode(Yii::$app->request->get('filename'));

        $filePath = 'E:/QAADocument/'.$link.'/'.$filename;

        return Yii::$app->response->sendFile($filePath, $filename, ['inline' => true]);
    }
}