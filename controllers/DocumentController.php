<?php

namespace app\controllers;

use app\models\TblDocument;
use Yii;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

class DocumentController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionUploadhr()
    {
        $model = new TblDocument();



    
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            //Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $data = Yii::$app->request->post();

            $model->eventimage = UploadedFile::getInstance($model, 'eventimage');
            //Kena letak dekat sini sebelum validate.

            $model->DocTypeId = $data['Tbldocument']['DocTypeId'];
            $model->file_name = $model->eventimage->baseName . '.' . $model->eventimage->extension;


            $uploadPath =  Yii::getAlias("@imagesUrl");
            $destinationPath = $uploadPath . '/' . $model->eventimage->baseName . '.' . $model->eventimage->extension;

            $fileSize = $model->eventimage->size; // Size in bytes
            $fileType = $model->eventimage->type; // MIME type
            // You can format the file size for better readability (e.g., in kilobytes or megabytes)
            $formattedSize = \Yii::$app->formatter->asShortSize($fileSize);

            // You can convert the file size to human-readable format (e.g., KB, MB, GB)
            //$fileSizeHumanReadable = FileHelper::humanReadableFilesize($fileSizeInBytes);
            $model->file_size = $formattedSize;
            $model->file_type = $fileType;

           

            if ($model->eventimage->saveAs($destinationPath)) {

                // File has been uploaded successfully
                //  $model->fileurl  = $destinationPath;

                
                // return $this->redirect(['index']);
                //return $this->redirect(Yii::$app->homeUrl . 'department/index');
            }


            if ($model->save(false)) {
                ///Yii::$app->session->setFlash('success', "Record  successfully Update.");

                $response = [
                    'status' => 1,
                    'message' => 'Success, Successfully upload file ' . $model->eventimage->baseName
                ];

                // return json_encode(array('status' => 1, 'type' => 'success', 'message' => 'Contact created successfully.'));

                return json_encode($response);
            } else {
                //Yii::$app->session->setFlash('error', "Record not saved.");
                $response = [
                    'status' => 2,
                    'message' => 'Sorry , Record Not Saved ' . $model->eventimage->baseName
                ];
                return json_encode($response);
            }
            
        
        } else {

            return $this->renderAjax('uploadhr', [
                'model' => $model,
            ]);
        }
    
    }


}
