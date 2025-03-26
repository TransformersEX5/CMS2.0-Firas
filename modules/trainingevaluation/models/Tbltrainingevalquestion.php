<?php

namespace app\modules\trainingevaluation\models;

use Yii;

/**
 * This is the model class for table "tbltrainingevalquestion".
 *
 * @property int $TrainingEvalQuestionId
 * @property int $TrainingEvalCategoryId
 * @property int $QuestionNo
 * @property string $Question
 * @property int $Mark1
 * @property int $Mark2
 * @property int $Mark3
 * @property int $Mark4
 * @property int $Mark5
 * @property int $StatusId
 * @property string $TransactionDate
 */
class Tbltrainingevalquestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbltrainingevalquestion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TrainingEvalCategoryId', 'QuestionNo', 'Question'], 'required'],
            [['TrainingEvalCategoryId', 'QuestionNo', 'Mark1', 'Mark2', 'Mark3', 'Mark4', 'Mark5', 'StatusId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['Question'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TrainingEvalQuestionId' => 'Training Eval Question ID',
            'TrainingEvalCategoryId' => 'Training Eval Category ID',
            'QuestionNo' => 'Question No',
            'Question' => 'Question',
            'Mark1' => 'Mark1',
            'Mark2' => 'Mark2',
            'Mark3' => 'Mark3',
            'Mark4' => 'Mark4',
            'Mark5' => 'Mark5',
            'StatusId' => 'Status ID',
            'TransactionDate' => 'Transaction Date',
        ];
    }
}
