<?php

namespace app\modules\marketingadmin\models;

use Yii;

/**
 * This is the model class for table "tblstatusai".
 *
 * @property int $StatusId
 * @property string $Status
 * @property string $TransactionDate
 * @property int $UserId
 */
class Tblstatusai extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblstatusai';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Status', 'UserId'], 'required'],
            [['TransactionDate'], 'safe'],
            [['UserId'], 'integer'],
            [['Status'], 'string', 'max' => 10],
            [['Status'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'StatusId' => 'Status ID',
            'Status' => 'Status',
            'TransactionDate' => 'Transaction Date',
            'UserId' => 'User ID',
        ];
    }
}
