<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
/**
 * This is the model class for table "tbldocument".
 *
 * @property int $DocId
 * @property int $DocTypeId
 * @property string|null $file_name
 * @property int|null $file_size
 * @property string|null $file_type
 * @property string $TransactionDate
 */
class Tbldocument extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbldocument';
    }

    public $eventimage;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['DocTypeId'], 'required'],
            [['DocTypeId', 'file_size'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['file_name'], 'string', 'max' => 255],
            [['file_type'], 'string', 'max' => 25],
            [['eventimage'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['eventimage'], 'file', 'skipOnEmpty' => false],
            [['file_name','eventimage'], 'unique'],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'DocId' => Yii::t('app', 'Doc ID'),
            'DocTypeId' => Yii::t('app', 'Doc Type'),
            'file_name' => Yii::t('app', 'File Name'),
            'file_size' => Yii::t('app', 'File Size'),
            'file_type' => Yii::t('app', 'File Type'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
            'eventimage' => 'Select File',
        ];
    }


 

}
