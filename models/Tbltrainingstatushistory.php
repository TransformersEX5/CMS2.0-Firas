<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbltrainingstatushistory".
 *
 * @property int $TrainingStatusHistoryId
 * @property int $TrainingId
 * @property int $TrainingStatusId
 * @property string|null $Remarks
 * @property int|null $CurrentStatusId
 * @property string $TransactionDate
 * @property int $UserId
 */
class Tbltrainingstatushistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbltrainingstatushistory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TrainingId', 'TrainingStatusId', 'UserId'], 'required'],
            [['TrainingId', 'TrainingStatusId', 'CurrentStatusId', 'UserId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['Remarks'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TrainingStatusHistoryId' => Yii::t('app', 'Training Status History ID'),
            'TrainingId' => Yii::t('app', 'Training ID'),
            'TrainingStatusId' => Yii::t('app', 'Training Status ID'),
            'Remarks' => Yii::t('app', 'Remarks'),
            'CurrentStatusId' => Yii::t('app', 'Current Status ID'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
            'UserId' => Yii::t('app', 'User ID'),
        ];
    }
}
