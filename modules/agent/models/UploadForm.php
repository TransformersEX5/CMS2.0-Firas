<?php

// namespace app\modules\agent\models;

// use yii\base\Model;
// use yii\web\UploadedFile;

// class UploadForm extends Model
// {
//     /**
//      * @var UploadedFile[]
//      */
//     public $imageFiles;
//     // public $additionalFiles;

//     public function rules()
//     {
//         return [
//             [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, pdf'],
//         ];
//     }
    
//     public function upload($uploadPath)
//     {
//         if ($this->validate()) { 
//             foreach ($this->imageFiles as $file) {
//                 die('aaa');
//                 $file->saveAs($uploadPath . '/' . $file->baseName . '.' . $file->extension);
//                 die('bbb');
//             }
//             die('ccc');
//             return true;
//         } else {
//             die('d');
//             return false;
//         }
//     }
// }

namespace app\modules\agent\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) { 
            foreach ($this->imageFiles as $file) {
                $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }
}

?>