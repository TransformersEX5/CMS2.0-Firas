<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblrmcdesignation".
 *
 * @property int $RMCDesignationId
 * @property string $RMCDesignation
 * @property int $UserId
 * @property int $StatusId
 * @property string $TransactionDate
 */
class Tblrmcdesignation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblrmcdesignation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['RMCDesignation', 'UserId'], 'required'],
            [['UserId', 'StatusId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['RMCDesignation'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'RMCDesignationId' => 'Rmc Designation ID',
            'RMCDesignation' => 'Rmc Designation',
            'UserId' => 'User ID',
            'StatusId' => 'Status ID',
            'TransactionDate' => 'Transaction Date',
        ];
    }
}
