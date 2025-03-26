<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblrmcsummary".
 *
 * @property int $RMCSummaryId
 * @property string $RMCSummaryBackground
 * @property string $RMCSummaryResearchObjective
 * @property string|null $RMCSummarySpecificObjective1
 * @property string|null $RMCSummarySpecificObjective2
 * @property string|null $RMCSummarySpecificObjective3
 * @property string $RMCSummaryReseachPublication
 * @property string $RMCSummaryFinding
 * @property string $RMCSummaryPotentialApplication
 * @property string $RMCSummaryNoOfGraduate
 * @property int $RMCId
 * @property int $UserId
 * @property int $StatusId
 * @property string $TransactionDate
 */
class Tblrmcsummary extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblrmcsummary';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['RMCSummaryBackground', 'RMCSummaryResearchObjective', 'RMCSummaryReseachPublication', 'RMCSummaryFinding', 'RMCSummaryPotentialApplication', 'RMCSummaryNoOfGraduate', 'RMCId', 'UserId'], 'required'],
            [['RMCId', 'UserId', 'StatusId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['RMCSummaryBackground', 'RMCSummaryResearchObjective', 'RMCSummarySpecificObjective1', 'RMCSummarySpecificObjective2', 'RMCSummarySpecificObjective3', 'RMCSummaryReseachPublication', 'RMCSummaryFinding', 'RMCSummaryPotentialApplication', 'RMCSummaryNoOfGraduate'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'RMCSummaryId' => Yii::t('app', 'Rmc Summary ID'),
            'RMCSummaryBackground' => Yii::t('app', 'Rmc Summary Background'),
            'RMCSummaryResearchObjective' => Yii::t('app', 'Rmc Summary Research Objective'),
            'RMCSummarySpecificObjective1' => Yii::t('app', 'Rmc Summary Specific Objective1'),
            'RMCSummarySpecificObjective2' => Yii::t('app', 'Rmc Summary Specific Objective2'),
            'RMCSummarySpecificObjective3' => Yii::t('app', 'Rmc Summary Specific Objective3'),
            'RMCSummaryReseachPublication' => Yii::t('app', 'Rmc Summary Reseach Publication'),
            'RMCSummaryFinding' => Yii::t('app', 'Rmc Summary Finding'),
            'RMCSummaryPotentialApplication' => Yii::t('app', 'Rmc Summary Potential Application'),
            'RMCSummaryNoOfGraduate' => Yii::t('app', 'Rmc Summary No Of Graduate'),
            'RMCId' => Yii::t('app', 'Rmc ID'),
            'UserId' => Yii::t('app', 'User ID'),
            'StatusId' => Yii::t('app', 'Status ID'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
        ];
    }
}
