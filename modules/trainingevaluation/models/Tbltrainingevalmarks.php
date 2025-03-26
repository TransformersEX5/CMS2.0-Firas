<?php

namespace app\modules\trainingevaluation\models;

use Yii;

/**
 * This is the model class for table "tbltrainingevalmarks".
 *
 * @property int $TrainingEvalMarksId
 * @property int $TrainingEvalQuestionId
 * @property string $Mark1
 * @property string $Mark2
 * @property string $Mark3
 * @property string $Mark4
 * @property string $Mark5
 * @property int $UserId
 * @property int $TrainingId
 * @property string $TransactionDate
 */
class Tbltrainingevalmarks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbltrainingevalmarks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TrainingEvalQuestionId', 'UserId', 'TrainingId'], 'required'],
            [['TrainingEvalQuestionId', 'UserId', 'TrainingId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['Mark1', 'Mark2', 'Mark3', 'Mark4', 'Mark5'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TrainingEvalMarksId' => 'Training Eval Marks ID',
            'TrainingEvalQuestionId' => 'Training Eval Question ID',
            'Mark1' => 'Mark1',
            'Mark2' => 'Mark2',
            'Mark3' => 'Mark3',
            'Mark4' => 'Mark4',
            'Mark5' => 'Mark5',
            'UserId' => 'User ID',
            'TrainingId' => 'Training ID',
            'TransactionDate' => 'Transaction Date',
        ];
    }
}
