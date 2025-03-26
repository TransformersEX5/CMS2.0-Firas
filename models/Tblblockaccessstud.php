<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblblockaccessstud".
 *
 * @property int $DocketId
 * @property int|null $ProgramRegId
 * @property int $BlockAcessId refer tblblockaccesstype
 * @property int|null $BlockOnOff 1=On ; 2=Off
 * @property int $CurrentStatusId
 * @property string $Remarks
 * @property float|null $Outstanding
 * @property int $UserId
 * @property string $TransactionDate
 */
class Tblblockaccessstud extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblblockaccessstud';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ProgramRegId', 'BlockAccessId', 'BlockOnOff', 'CurrentStatusId', 'UserId'], 'integer'],
            [['Outstanding'], 'number'],
            [['UserId','BlockOnOff','BlockAccessId','ProgramRegId'], 'required'],
            [['TransactionDate'], 'safe'],
            [['Remarks'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'DocketId' => Yii::t('app', 'Docket ID'),
            'ProgramRegId' => Yii::t('app', 'Program Reg ID'),
            'BlockAccessId' => Yii::t('app', 'Block Acess ID'),
            'BlockOnOff' => Yii::t('app', 'Block On/Off'),
            'CurrentStatusId' => Yii::t('app', 'Curren Status'),
            'Remarks' => Yii::t('app', 'Remarks'),
            'Outstanding' => Yii::t('app', 'Outstanding'),
            'UserId' => Yii::t('app', 'User ID'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
        ];
    }
}
