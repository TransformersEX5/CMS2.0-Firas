<?php

namespace app\modules\visa\models;

use Yii;

/**
 * This is the model class for table "tblapplicationemgs".
 *
 * @property int $ApplicationEMGSId
 * @property int $ApplicationId
 * @property string|null $SoftCopyDate
 * @property string $ApplicationReceivedDate
 * @property string $ApplicantFullName
 * @property string|null $Region
 * @property string $Nationality
 * @property string|null $State
 * @property string|null $City
 * @property string $StudNRICPassportNo
 * @property string|null $PassportIssuingCountry
 * @property string $CourseName
 * @property string $EMGSStatus
 * @property string|null $StudentPassExpiryDate
 * @property string $UpdatedAt
 * @property int $StatusId
 * @property int $UserId
 * @property string $TransactionDate
 */
class Tblapplicationemgs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblapplicationemgs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ApplicationId', 'ApplicationReceivedDate', 'ApplicantFullName', 'Nationality', 'StudNRICPassportNo', 'CourseName', 'EMGSStatus', 'UpdatedAt', 'StatusId', 'UserId'], 'required'],
            [['ApplicationId', 'StatusId', 'UserId'], 'integer'],
            [['SoftCopyDate', 'ApplicationReceivedDate', 'StudentPassExpiryDate', 'UpdatedAt', 'TransactionDate'], 'safe'],
            [['ApplicantFullName', 'Region', 'Nationality', 'State', 'City', 'StudNRICPassportNo', 'PassportIssuingCountry', 'CourseName', 'EMGSStatus'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ApplicationEMGSId' => 'Application Emgs ID',
            'ApplicationId' => 'Application ID',
            'SoftCopyDate' => 'Soft Copy Date',
            'ApplicationReceivedDate' => 'Application Received Date',
            'ApplicantFullName' => 'Applicant Full Name',
            'Region' => 'Region',
            'Nationality' => 'Nationality',
            'State' => 'State',
            'City' => 'City',
            'StudNRICPassportNo' => 'Stud Nric Passport No',
            'PassportIssuingCountry' => 'Passport Issuing Country',
            'CourseName' => 'Course Name',
            'EMGSStatus' => 'Emgs Status',
            'StudentPassExpiryDate' => 'Student Pass Expiry Date',
            'UpdatedAt' => 'Updated At',
            'StatusId' => 'Status ID',
            'UserId' => 'User ID',
            'TransactionDate' => 'Transaction Date',
        ];
    }
}
