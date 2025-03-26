<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbltrainingduration".
 *
 * @property int $TrainingDurationId
 * @property int|null $TrainingId
 * @property string|null $TrainingDate
 * @property string|null $TrainingTimeStart
 * @property string|null $TrainingTimeEnd
 * @property float|null $TraningTotHours
 * @property string|null $Remarks
 * @property string|null $TransactionDate
 * @property int|null $UserId
 */
class Tbltrainingduration extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbltrainingduration';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TrainingId', 'UserId'], 'integer'],
            [['TrainingDate', 'TrainingTimeStart', 'TrainingTimeEnd', 'TransactionDate'], 'safe'],
            [['TraningTotHours'], 'number'],
            [['Remarks'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TrainingDurationId' => Yii::t('app', 'Training Duration ID'),
            'TrainingId' => Yii::t('app', 'Training ID'),
            'TrainingDate' => Yii::t('app', 'Training Date'),
            'TrainingTimeStart' => Yii::t('app', 'Training Time Start'),
            'TrainingTimeEnd' => Yii::t('app', 'Training Time End'),
            'TraningTotHours' => Yii::t('app', 'Traning Tot Hours'),
            'Remarks' => Yii::t('app', 'Remarks'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
            'UserId' => Yii::t('app', 'User ID'),
        ];
    }
    

    

    
}
