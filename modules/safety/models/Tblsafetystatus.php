<?php

namespace app\modules\safety\models;

use Yii;

/**
 * This is the model class for table "tblsafetystatus".
 *
 * @property int $SafetyStatusId
 * @property string|null $SafetyStatusDesc
 */
class Tblsafetystatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblsafetystatus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SafetyStatusDesc'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SafetyStatusId' => 'Safety Status ID',
            'SafetyStatusDesc' => 'Safety Status Desc',
        ];
    }
}
