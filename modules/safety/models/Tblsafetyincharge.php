<?php

namespace app\modules\safety\models;

use Yii;

/**
 * This is the model class for table "tblsafetyincharge".
 *
 * @property int $SafetyInchargeId
 * @property int $SafetyId
 * @property int $UserId
 */
class Tblsafetyincharge extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblsafetyincharge';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SafetyId', 'UserId'], 'required'],
            [['SafetyId', 'UserId'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SafetyInchargeId' => 'Safety Incharge ID',
            'SafetyId' => 'Safety ID',
            'UserId' => 'User ID',
        ];
    }
}
