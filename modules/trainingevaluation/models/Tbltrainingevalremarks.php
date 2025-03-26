<?php

namespace app\modules\trainingevaluation\models;

use Yii;

/**
 * This is the model class for table "tbltrainingevalremarks".
 *
 * @property int $TrainingEvalRemarksId
 * @property string $TrainingEvalRemarks
 * @property int $TrainingId
 * @property int $UserId
 * @property string $TransactionDate
 */
class Tbltrainingevalremarks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbltrainingevalremarks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TrainingEvalRemarks', 'TrainingId', 'UserId'], 'required'],
            [['TrainingId', 'UserId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['TrainingEvalRemarks'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TrainingEvalRemarksId' => 'Training Eval Remarks ID',
            'TrainingEvalRemarks' => 'Training Eval Remarks',
            'TrainingId' => 'Training ID',
            'UserId' => 'User ID',
            'TransactionDate' => 'Transaction Date',
        ];
    }
}
