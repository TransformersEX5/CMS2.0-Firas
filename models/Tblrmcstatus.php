<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblrmcstatus".
 *
 * @property int $StatusId
 * @property string $Status
 * @property string $TransactionDate
 */
class Tblrmcstatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblrmcstatus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Status'], 'required'],
            [['TransactionDate'], 'safe'],
            [['Status'], 'string', 'max' => 255],
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
        ];
    }
}
