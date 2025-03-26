<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblprogramtype".
 *
 * @property int $ProgramTypeId
 * @property string $ProgramTypeName
 * @property string|null $ProgramTypeCode
 * @property string $CodeLevel
 * @property int $StatusId
 * @property string $TransactionDate
 * @property int $UserId
 * @property int|null $KptConvo_ProgType
 * @property string|null $Ifms_Code
 * @property string|null $Ifms_Desc
 */
class Tblprogramtype extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblprogramtype';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ProgramTypeName', 'UserId'], 'required'],
            [['StatusId', 'UserId', 'KptConvo_ProgType'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['ProgramTypeName'], 'string', 'max' => 50],
            [['ProgramTypeCode'], 'string', 'max' => 1],
            [['CodeLevel'], 'string', 'max' => 2],
            [['Ifms_Code'], 'string', 'max' => 3],
            [['Ifms_Desc'], 'string', 'max' => 40],
            [['ProgramTypeName'], 'unique'],
            [['ProgramTypeCode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ProgramTypeId' => Yii::t('app', 'Program Type ID'),
            'ProgramTypeName' => Yii::t('app', 'Program Type Name'),
            'ProgramTypeCode' => Yii::t('app', 'Program Type Code'),
            'CodeLevel' => Yii::t('app', 'Code Level'),
            'StatusId' => Yii::t('app', 'Status ID'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
            'UserId' => Yii::t('app', 'User ID'),
            'KptConvo_ProgType' => Yii::t('app', 'Kpt Convo Prog Type'),
            'Ifms_Code' => Yii::t('app', 'Ifms Code'),
            'Ifms_Desc' => Yii::t('app', 'Ifms Desc'),
        ];
    }
}
