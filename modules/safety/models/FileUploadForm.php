<?php

namespace app\modules\safety\models;

use yii\base\Model;
use yii\web\UploadedFile;

class FileUploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $fileToUpload;

    public function rules()
    {
        return [
            [['fileToUpload'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 20, 'message' => ''],
        ];
    }

    public function upload($uploadPath)
    {
        if ($this->validate()) {
            foreach ($this->fileToUpload as $file) {
                $file->saveAs($uploadPath.'/' . $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }
}

?>