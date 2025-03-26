<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblpositiongrade".
 *
 * @property int $PositionGradeId
 * @property string $PositionGrade
 * @property string|null $PositionDesc
 * @property int|null $PositionTypeId
 * @property int $UserId
 * @property string $TransactionDate
 */
class Tblpositiongrade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblpositiongrade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['PositionGrade', 'UserId'], 'required'],
            [['PositionTypeId', 'UserId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['PositionGrade'], 'string', 'max' => 5],
            [['PositionDesc'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'PositionGradeId' => 'Position Grade ID',
            'PositionGrade' => 'Position Grade',
            'PositionDesc' => 'Position Desc',
            'PositionTypeId' => 'Position Type ID',
            'UserId' => 'User ID',
            'TransactionDate' => 'Transaction Date',
        ];
    }
}
