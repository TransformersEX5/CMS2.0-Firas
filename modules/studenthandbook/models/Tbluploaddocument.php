<?php

namespace app\modules\studenthandbook\models;

use Yii;

/**
 * This is the model class for table "tbluploaddocument".
 *
 * @property int $UploadDocumentId
 * @property int $UploadDocumentTypeId
 * @property string $UploadDocumentTitle
 * @property string $UploadDocument
 * @property int $Year
 * @property string $Remarks
 * @property int $UserId
 * @property string $TransactionDate
 * @property int $StatusId
 * @property int $Visibility
 */
class Tbluploaddocument extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbluploaddocument';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UploadDocumentTypeId', 'UploadDocumentTitle', 'UploadDocument', 'Year', 'UserId', 'Visibility'], 'required'],
            [['UploadDocumentTypeId', 'Year', 'UserId', 'StatusId', 'Visibility'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['UploadDocumentTitle', 'UploadDocument'], 'string', 'max' => 255],
            [['Remarks'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'UploadDocumentId' => 'Upload Document ID',
            'UploadDocumentTypeId' => 'Upload Document Type ID',
            'UploadDocumentTitle' => 'Upload Document Title',
            'UploadDocument' => 'Upload Document',
            'Year' => 'Year',
            'Remarks' => 'Remarks',
            'UserId' => 'User ID',
            'TransactionDate' => 'Transaction Date',
            'StatusId' => 'Status ID',
            'Visibility' => 'Visibility',
        ];
    }
}
