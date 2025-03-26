<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblrmcservice".
 *
 * @property int $RMCServiceStatusId
 * @property string $RMCServiceStatus
 * @property int $UserId
 * @property int $StatusId
 * @property string $TransactionDate
 */
class Tblrmcservice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblrmcservice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['RMCServiceStatus', 'UserId'], 'required'],
            [['UserId', 'StatusId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['RMCServiceStatus'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'RMCServiceStatusId' => 'Rmc Service Status ID',
            'RMCServiceStatus' => 'Rmc Service Status',
            'UserId' => 'User ID',
            'StatusId' => 'Status ID',
            'TransactionDate' => 'Transaction Date',
        ];
    }
}
