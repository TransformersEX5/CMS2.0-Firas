<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblrmcdocumenttype".
 *
 * @property int $RMCDocumentTypeId
 * @property string $RMCDocumentType
 * @property int $StatusId
 * @property int $UserId
 * @property string $TransactionDate
 */
class Tblrmcdocumenttype extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblrmcdocumenttype';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['RMCDocumentType', 'UserId'], 'required'],
            [['StatusId', 'UserId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['RMCDocumentType'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'RMCDocumentTypeId' => Yii::t('app', 'Rmc Document Type ID'),
            'RMCDocumentType' => Yii::t('app', 'Rmc Document Type'),
            'StatusId' => Yii::t('app', 'Status ID'),
            'UserId' => Yii::t('app', 'User ID'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
        ];
    }
}
