<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblleaveholiday".
 *
 * @property int $HolidayId
 * @property string $Holiday
 * @property int $HolidayStatusId
 * @property int $UserId
 * @property string $TransactionDate
 */
class Tblleaveholiday extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblleaveholiday';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Holiday', 'UserId'], 'required'],
            [['HolidayStatusId', 'UserId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['Holiday'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'HolidayId' => 'Holiday ID',
            'Holiday' => 'Holiday',
            'HolidayStatusId' => 'Holiday Status ID',
            'UserId' => 'User ID',
            'TransactionDate' => 'Transaction Date',
        ];
    }
}
