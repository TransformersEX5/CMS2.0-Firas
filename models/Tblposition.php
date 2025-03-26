<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblposition".
 *
 * @property int $PositionId
 * @property string $PositionName
 * @property int $PositionGradeId
 * @property int $UserId
 * @property string $TransactionDate
 */
class Tblposition extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblposition';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['PositionName', 'PositionGradeId', 'UserId'], 'required'],
            [['PositionGradeId', 'UserId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['PositionName'], 'string', 'max' => 150],
            [['PositionName'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'PositionId' => 'Position ID',
            'PositionName' => 'Position Name',
            'PositionGradeId' => 'Position Grade ID',
            'UserId' => 'User ID',
            'TransactionDate' => 'Transaction Date',
        ];
    }
}
