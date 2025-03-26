<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblconvocationstaffposition".
 *
 * @property int $ConvoStaffPositionId
 * @property string $ConvoStaffPosition
 * @property string|null $TransactionDate
 */
class Tblconvocationstaffposition extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblconvocationstaffposition';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ConvoStaffPosition'], 'required'],
            [['TransactionDate'], 'safe'],
            [['ConvoStaffPosition'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ConvoStaffPositionId' => 'Convo Staff Position ID',
            'ConvoStaffPosition' => 'Convo Staff Position',
            'TransactionDate' => 'Transaction Date',
        ];
    }
}
