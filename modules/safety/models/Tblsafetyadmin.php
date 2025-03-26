<?php

namespace app\modules\safety\models;

use Yii;

/**
 * This is the model class for table "tblsafetyadmin".
 *
 * @property int $SafetyAdminId
 * @property int $SafetyId
 * @property int $SafetyStatusId
 * @property string|null $SafetyRemarks
 * @property int|null $CurrenStatustId
 * @property int|null $InchargeUserId
 * @property int $UserId
 * @property string $TransactionDate
 */
class Tblsafetyadmin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblsafetyadmin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SafetyId', 'UserId'], 'required'],
            [['SafetyId', 'SafetyStatusId', 'CurrenStatustId', 'InchargeUserId', 'UserId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['SafetyRemarks'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SafetyAdminId' => 'Safety Admin ID',
            'SafetyId' => 'Safety ID',
            'SafetyStatusId' => 'Safety Status ID',
            'SafetyRemarks' => 'Safety Remarks',
            'CurrenStatustId' => 'Curren Statust ID',
            'InchargeUserId' => 'Incharge User ID',
            'UserId' => 'User ID',
            'TransactionDate' => 'Transaction Date',
        ];
    }
}
