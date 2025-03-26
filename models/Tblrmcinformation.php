<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblrmcinformation".
 *
 * @property int $RMCInformationId
 * @property int $RMCClusterId
 * @property string $RMCInformationFieldOfResearch
 * @property string $RMCInformationResearchDuration
 * @property string $RMCInformationStartDate
 * @property string $RMCInformationEndDate
 * @property string $RMCInformationResearchLocation
 * @property int $UserId
 * @property int $StatusId
 * @property string $TransactionDate
 */
class Tblrmcinformation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblrmcinformation';
    }

    /**
     * {@inheritdoc}
     */

    public function getRmc()
    {
        return $this->hasOne(Tblrmc::class, ['RMCId' => 'RMCId']);
    }

        public function getRmcCluster()
    {
        return $this->hasOne(Tblrmccluster::class, ['RMCClusterId' => 'RMCClusterId']);
    }

    
    public function rules()
    {
        return [
            [['RMCClusterId', 'RMCInformationFieldOfResearch', 'RMCInformationResearchDuration', 'RMCInformationStartDate', 'RMCInformationEndDate', 'RMCInformationResearchLocation'], 'required'],
            [['RMCId', 'RMCClusterId', 'UserId', 'StatusId'], 'integer'],
            [['RMCInformationStartDate', 'RMCInformationEndDate', 'TransactionDate'], 'safe'],
            [['RMCInformationFieldOfResearch', 'RMCInformationResearchLocation'], 'string', 'max' => 255],
        ];
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'RMCInformationId' => Yii::t('app', 'Rmc Information ID'),
            'RMCId' => Yii::t('app', 'Rmc ID'),
            'RMCClusterId' => Yii::t('app', 'Rmc Cluster ID'),
            'RMCInformationFieldOfResearch' => Yii::t('app', 'Rmc Information Field Of Research'),
            'RMCInformationResearchDuration' => Yii::t('app', 'Rmc Information Research Duration'),
            'RMCInformationStartDate' => Yii::t('app', 'Rmc Information Start Date'),
            'RMCInformationEndDate' => Yii::t('app', 'Rmc Information End Date'),
            'RMCInformationResearchLocation' => Yii::t('app', 'Rmc Information Research Location'),
            'UserId' => Yii::t('app', 'User ID'),
            'StatusId' => Yii::t('app', 'Status ID'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
        ];
    }

}
