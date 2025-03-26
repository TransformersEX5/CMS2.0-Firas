<?php

namespace app\controllers;

use Yii;
use app\models\Tbluser;
use app\models\Tbldocument;
use yii\web\UploadedFile;
use app\components\FileUploader;

class ProfileController extends \yii\web\Controller
{

    public $layout = 'lexapurple_layouts';



    public function actionIndex()
    {
        $model = new Tbluser();

        $data = $model->getMyUserDetail();

        return $this->render('index', ['data' => $data]);
    }

    public function actionUpload()
    {
        $uploader = Yii::$app->fileUploader;
        $model = new Tbldocument();
        
        //$model->load(Yii::$app->request->post(), '');

        $path = '/web/upload/couriers/images/';

        if (Yii::$app->request->isPost) {
            // $model->documentFile = UploadedFile::getInstance($model, 'documentFile');
            $model->documentFile = UploadedFile::getInstanceByName('file_name');
            if ($model->validate()) {

                $uploadedFilePath = $uploader->uploadDocument($model->documentFile);
                $model->path = $path;

                if ($model->upload()) {
                    return true;
                } else {
                    return $model->getErrors();
                }



                // Do something with the uploaded file path, e.g., save to database
                // return $this->redirect(['site/index']);
            }
        }

        return $this->render('upload', ['model' => $model]);
    }


    public function actionDisplayImage($imageName)
    {
        // Path to the directory where images are stored outside the web directory
        $imagePath = '/path/to/your/image/directory/';

        $imageFullPath = $imagePath . $imageName;

        if (file_exists($imageFullPath)) {
            // Set the response content type to image
            Yii::$app->response->format = Response::FORMAT_RAW;
            Yii::$app->response->headers->add('Content-Type', 'image/jpeg'); // Adjust the content type based on your image type

            // Read and output the image file
            return file_get_contents($imageFullPath);
        } else {
            throw new NotFoundHttpException('Image not found');
        }
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
