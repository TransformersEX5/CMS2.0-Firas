<?php

namespace app\modules\safety\models;

use Yii;

/**
 * This is the model class for table "tblsafety".
 *
 * @property int $SafetyId
 * @property string $SafetyDesc
 * @property string $SafetyLocation
 * @property int|null $SafetyAdminPic
 * @property string|null $SafetyAdminDesc
 * @property string $TransactionDate
 * @property int $UserId
 */
class Tblsafety extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblsafety';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SafetyDesc', 'SafetyLocation', 'UserId'], 'required'],
            [['SafetyAdminPic', 'UserId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['SafetyDesc', 'SafetyLocation', 'SafetyAdminDesc'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SafetyId' => 'Safety ID',
            'SafetyDesc' => 'Description',
            'SafetyLocation' => 'Location',
            'SafetyAdminPic' => 'Safety Admin Pic',
            'SafetyAdminDesc' => 'Safety Admin Desc',
            'TransactionDate' => 'Transaction Date',
            'UserId' => 'User ID',
        ];
    }
}
