<?php

namespace app\models;

use Yii;

namespace app\models;

use yii\helpers\Url;
use yii\base\Model;
use yii\web\UploadedFile;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Tbluser;
use app\models\TbluploadTest;
use app\models\ContactForm;

/**
 * This is the model class for table "tbltestupload".
 *
 * @property int $id
 * @property string|null $filename
 * @property string|null $fileurl
 * @property string|null $trandate
 */
class Tbltestupload extends \yii\db\ActiveRecord
{


    public $eventImage;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbltestupload';
    }





    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trandate'], 'safe'],
            [['filename'], 'string', 'max' => 100],
            [['fileurl'], 'string', 'max' => 250],

            [['filename'], 'required'],
            [['eventImage'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['eventImage'], 'file', 'skipOnEmpty' => false],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'filename' => 'Filename',
            'fileurl' => 'Fileurl',
            'trandate' => 'Trandate',
            'eventImage' => 'Select File',
        ];
    }

  
    public function upload_xxx($id)
    {

        
        $tempFile = $_FILES["filename"]["tmp_name"];
        $targetFile = "C:/mypicture/mypicture.jpg";

        if (is_uploaded_file($tempFile)) {
            if (move_uploaded_file($tempFile, $targetFile)) {
                echo "File has been uploaded.";
            } else {
                echo "Error moving file.";
            }
        } else {
            echo "File upload failed.";
        }

        $path = $this->uploadPath() . $this->id . "." . $this->eventImage->extension;
        ///  $path = move_uploaded_file($_FILES['eventImage']['tmp_name'], $destinationPath . $_FILES['eventImage']['name']);
        $this->eventImage->saveAs($path);
        $this->filename = $this->eventImage . "." . $this->eventImage->extension;
        $this->save(false);
        return true;
    }

    public function uploadPathxxx()
    {


        return Yii::getAlias("@saftyimg");
    }
}
