<?php

namespace app\modules\hostel\models;

use Yii;

/**
 * This is the model class for table "tblhostel".
 *
 * @property int $HostelId
 * @property string|null $HostelCode
 * @property string $HostelName
 * @property int $HostelTypeId
 * @property string $HostelAddress1
 * @property string $HostelAddress2
 * @property string $HostelPostCode
 * @property string $HostelCityName
 * @property int $HostelStateId
 * @property string $HostelStatus A=Active; I=Inactive
 * @property int $UserId
 * @property string $TransactionDate
 */
class Tblhostel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblhostel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['HostelName', 'HostelTypeId', 'HostelAddress1', 'HostelAddress2', 'HostelPostCode', 'HostelCityName', 'HostelStateId', 'HostelStatus', 'UserId'], 'required'],
            [['HostelTypeId', 'HostelStateId', 'UserId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['HostelCode'], 'string', 'max' => 3],
            [['HostelName', 'HostelCityName'], 'string', 'max' => 30],
            [['HostelAddress1', 'HostelAddress2'], 'string', 'max' => 80],
            [['HostelPostCode'], 'string', 'max' => 6],
            [['HostelStatus'], 'string', 'max' => 1],
            [['HostelName'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'HostelId' => Yii::t('app', 'Hostel ID'),
            'HostelCode' => Yii::t('app', 'Hostel Code'),
            'HostelName' => Yii::t('app', 'Hostel Name'),
            'HostelTypeId' => Yii::t('app', 'Hostel Type ID'),
            'HostelAddress1' => Yii::t('app', 'Hostel Address1'),
            'HostelAddress2' => Yii::t('app', 'Hostel Address2'),
            'HostelPostCode' => Yii::t('app', 'Hostel Post Code'),
            'HostelCityName' => Yii::t('app', 'Hostel City Name'),
            'HostelStateId' => Yii::t('app', 'Hostel State ID'),
            'HostelStatus' => Yii::t('app', 'Hostel Status'),
            'UserId' => Yii::t('app', 'User ID'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
        ];
    }
}
