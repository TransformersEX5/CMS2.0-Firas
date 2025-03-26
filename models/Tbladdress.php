<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbladdress".
 *
 * @property int $AddressId
 * @property int $ApplicationId
 * @property string|null $CorrAddress1
 * @property string|null $CorrAddress2
 * @property string|null $CorrCity
 * @property string|null $CorrPostCode
 * @property int|null $CorrStateId
 * @property string|null $CorrHomeNo
 * @property string|null $CorrMobileNo
 * @property int $DunId
 * @property int $ParlimenId
 * @property string|null $StudGuardName
 * @property int|null $StudGuardRelationshipId
 * @property string|null $StudGuardEmailAddress
 * @property string|null $StudGurdOccupation
 * @property string|null $StudGurdHomeNo
 * @property string|null $StudGurdMobileNo
 * @property int|null $FamilyIncomes
 * @property string|null $StudEmergName
 * @property int|null $StudEmergRelationshipId
 * @property string|null $StudEmergHomeNo
 * @property string|null $StudEmergMobileNo
 * @property string|null $StudEmergOfficeNo
 * @property string|null $TransactionDate
 * @property string|null $TransactionUpdated
 */
class Tbladdress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbladdress';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['AddressId'], 'required'],
            [['AddressId', 'CorrStateId', 'DunId', 'ParlimenId', 'StudGuardRelationshipId', 'FamilyIncomes', 'StudEmergRelationshipId'], 'integer'],
            [['TransactionDate', 'TransactionUpdated'], 'safe'],
            [['CorrAddress1'], 'string', 'max' => 255],
            [['CorrAddress2', 'StudGuardEmailAddress', 'StudGurdOccupation'], 'string', 'max' => 100],
            [['CorrCity'], 'string', 'max' => 25],
            [['CorrPostCode'], 'string', 'max' => 6],
            [['CorrHomeNo', 'CorrMobileNo', 'StudGurdHomeNo', 'StudGurdMobileNo', 'StudEmergOfficeNo'], 'string', 'max' => 15],
            [['StudGuardName', 'StudEmergName'], 'string', 'max' => 60],
            [['StudEmergHomeNo', 'StudEmergMobileNo'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AddressId' => Yii::t('app', 'Address ID'),
            'ApplicationId' => Yii::t('app', 'Application ID'),
            'CorrAddress1' => Yii::t('app', 'Address Line 1'),
            'CorrAddress2' => Yii::t('app', 'Address Line 2'),
            'CorrCity' => Yii::t('app', 'City'),
            'CorrPostCode' => Yii::t('app', 'Postcode'),
            'CorrStateId' => Yii::t('app', 'State'),
            'CorrHomeNo' => Yii::t('app', 'Home No.'),
            'CorrMobileNo' => Yii::t('app', 'Mobile No.'),
            'DunId' => Yii::t('app', 'Dun'),
            'ParlimenId' => Yii::t('app', 'Parlimen'),
            'StudGuardName' => Yii::t('app', 'Guardian Name'),
            'StudGuardRelationshipId' => Yii::t('app', 'Relationship'),
            'StudGuardEmailAddress' => Yii::t('app', 'Email'),
            'StudGurdOccupation' => Yii::t('app', 'Occupation'),
            'StudGurdHomeNo' => Yii::t('app', 'Home No.'),
            'StudGurdMobileNo' => Yii::t('app', 'Mobile No.'),
            'FamilyIncomes' => Yii::t('app', 'Family Income'),
            'StudEmergName' => Yii::t('app', 'Emergency Name'),
            'StudEmergRelationshipId' => Yii::t('app', 'Relationship'),
            'StudEmergHomeNo' => Yii::t('app', 'Home No.'),
            'StudEmergMobileNo' => Yii::t('app', 'Mobile No.'),
            'StudEmergOfficeNo' => Yii::t('app', 'Office No.'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
            'TransactionUpdated' => Yii::t('app', 'Transaction Updated'),
        ];
    }
}
