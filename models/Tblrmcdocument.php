<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "tblrmcdocument".
 *
 * @property int $RMCDocumentId
 * @property int $RMCDocumentTypeId
 * @property string $RMCDocument
 * @property string $RMCDocumentLocation
 * @property int $RMCId
 * @property int|null $RMCMemberId
 * @property string|null $Remarks
 * @property int $UserId
 * @property int $StatusId
 * @property string $TransactionDate
 */
class Tblrmcdocument extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     *  @var UploadedFile
     */
    public static function tableName()
    {
        return 'tblrmcdocument';
    }

    /**
     * {@inheritdoc}
     */
    
    public function rules()
    {
        return [
            [['RMCDocumentTypeId', 'RMCDocument', 'RMCDocumentLocation', 'RMCId', 'UserId'], 'required'],
            [['RMCDocumentTypeId', 'RMCId', 'RMCMemberId', 'UserId', 'StatusId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['RMCDocument', 'RMCDocumentLocation', 'Remarks'], 'string', 'max' => 255],
            [['RMCDocument'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, pdf, doc, docx'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'RMCDocumentId' => Yii::t('app', 'Rmc Document ID'),
            'RMCDocumentTypeId' => Yii::t('app', 'Rmc Document Type ID'),
            'RMCDocument' => Yii::t('app', 'Rmc Document'),
            'RMCDocumentLocation' => Yii::t('app', 'Rmc Document Location'),
            'RMCId' => Yii::t('app', 'Rmc ID'),
            'RMCMemberId' => Yii::t('app', 'Rmc Member ID'),
            'Remarks' => Yii::t('app', 'Remarks'),
            'UserId' => Yii::t('app', 'User ID'),
            'StatusId' => Yii::t('app', 'Status ID'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
        ];
    }
}