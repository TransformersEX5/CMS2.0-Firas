<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblrmc".
 *
 * @property int $RMCId
 * @property string $RMCTitle
 * @property int $UserId
 * @property int $StatusId
 * @property string $TransactionDate
 */
class Tblrmc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblrmc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['RMCTitle', 'UserId'], 'required'],
            [['UserId', 'StatusId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['RMCTitle'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'RMCId' => 'Rmc ID',
            'RMCTitle' => 'Rmc Title',
            'UserId' => 'User ID',
            'StatusId' => 'Status ID',
            'TransactionDate' => 'Transaction Date',
        ];
    }
}
