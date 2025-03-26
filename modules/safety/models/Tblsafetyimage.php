<?php

namespace app\modules\safety\models;

use Yii;

/**
 * This is the model class for table "tblsafetyimage".
 *
 * @property int $SafetyImageId
 * @property int $SafetyId
 * @property int $SafetyAdminId
 * @property int $CategoryId 1=User Upload ; 2=admin Upload
 * @property string $file_name
 * @property int|null $file_size
 * @property string|null $file_type
 * @property string $TransactionDate
 * @property int $UserId
 */
class Tblsafetyimage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblsafetyimage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SafetyId', 'SafetyAdminId', 'UserId', 'file_name'], 'required'],
            [['SafetyId', 'SafetyAdminId', 'CategoryId', 'file_size', 'UserId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['file_name'], 'file', 'extensions' => ['jpg', 'jpeg', 'png']],
            [['file_type'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SafetyImageId' => 'Safety Image ID',
            'SafetyId' => 'Safety ID',
            'SafetyAdminId' => 'Safety Admin ID',
            'CategoryId' => 'Category ID',
            'file_name' => 'File Name',
            'file_size' => 'File Size',
            'file_type' => 'File Type',
            'TransactionDate' => 'Transaction Date',
            'UserId' => 'User ID',
        ];
    }
}
