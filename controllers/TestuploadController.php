<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Tbltestupload;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\web\Response;



class TestuploadController extends \yii\web\Controller
{

    public $layout = 'lexapurple_layouts';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView()
    {
        return $this->render('view');
    }



    public function actionUploadajx()
    {
        $model = new Tbltestupload();


        // if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
        //     Yii::$app->response->format = Response::FORMAT_JSON;
        if ($_POST) {


            $data = Yii::$app->request->post();
            //Kena letak dekat sini sebelum validate.
            $model->eventImage = UploadedFile::getInstance($model, 'eventImage');
            $model->filename   = $data['Tbltestupload']['filename'];



            if ($model->validate()) {

                $uploadPath =  Yii::getAlias("@imagesUrl");
                $destinationPath = $uploadPath . '/' . $model->eventImage->baseName . '.' . $model->eventImage->extension;


                if ($model->eventImage->saveAs($destinationPath)) {

                    $model->fileurl  = $destinationPath;

                    $model->save(false);

                    echo '<script>
                    alert("success upload");
                     
                </script>';

                    // $response = [
                    //     'status' => 1,
                    //     'message' => 'Record Successfully Save'
                    // ];
                    // return json_encode($response);
                    
                } else {

                    echo '<script>
                    alert("error upload");
                     
                </script>';
                    // $response = [
                    //     'status' => 1,
                    //     'message' => 'Record Successfully Save'
                    // ];
                    // return json_encode($response);
                    
                }
                return $this->render('uploadajx', ['model' => $model]);
                // return $this->redirect(Yii::$app->homeUrl . 'testupload/uploadajx');
            }

        } else {
            return $this->render(
                'uploadajx',
                ['model' => $model]
            );
        }
    }


    ///======================================================================================================================

    public function actionUpload()
    {
        $model = new Tbltestupload();

        $data = Yii::$app->request->post();

        if (Yii::$app->request->isPost) {

            $model->eventImage = UploadedFile::getInstance($model, 'eventImage');
            //Kena letak dekat sini sebelum validate.
            $model->filename = $data['Tbltestupload']['filename'];

            if ($model->validate()) {
                $uploadPath =  Yii::getAlias("@imagesUrl");
                $destinationPath = $uploadPath . '/' . $model->eventImage->baseName . '.' . $model->eventImage->extension;

                // Move the uploaded file to the destination directory
                if ($model->eventImage->saveAs($destinationPath)) {

                    // File has been uploaded successfully
                    $model->fileurl  = $destinationPath;

                    $model->save(false);

                    Yii::$app->session->setFlash('success', "File successfully upload.");

                    echo '<script>
                           alert("success upload");
                            
                       </script>';

                    // You can perform additional actions, such as saving to the database
                    return $this->render('upload', ['model' => $model]);
                } else {
                    // Error moving file to the destination directory
                    // Handle the error appropriately
                }
            }
        }

        return $this->render('upload', ['model' => $model]);
    }
}


