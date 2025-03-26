<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblrmcmember".
 *
 * @property int $RMCMemberId
 * @property string $RMCMemberName
 * @property string $RMCPassportNo
 * @property string $RMCStaffNo
 * @property string $RMCAcademicQualification
 * @property int $RMCDesignation
 * @property string $RMCFaculty
 * @property int $RMCMobileNo
 * @property string $RMCEmailAddress
 * @property int $RMCServiceStatusId
 * @property string|null $RMCAppointmentDate Only if RMCServiceStatusId = 1
 * @property string|null $RMCContractExpiryDate Only if RMCServiceStatusId = 2
 * @property int $RMCId
 * @property int $StatusId
 * @property string $TransactionDate
 */
class Tblrmcmember extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblrmcmember';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['RMCMemberName', 'RMCPassportNo', 'RMCStaffNo', 'RMCAcademicQualification', 'RMCDesignation', 'RMCFaculty', 'RMCMobileNo', 'RMCEmailAddress', 'RMCServiceStatusId', 'RMCId'], 'required'],
            [['RMCDesignation', 'RMCMobileNo', 'RMCServiceStatusId', 'RMCId', 'StatusId'], 'integer'],
            [['RMCAppointmentDate', 'RMCContractExpiryDate', 'TransactionDate'], 'safe'],
            [['RMCMemberName', 'RMCPassportNo', 'RMCStaffNo', 'RMCAcademicQualification', 'RMCFaculty', 'RMCEmailAddress'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'RMCMemberId' => 'Rmc Member ID',
            'RMCMemberName' => 'Rmc Member Name',
            'RMCPassportNo' => 'Rmc Passport No',
            'RMCStaffNo' => 'Rmc Staff No',
            'RMCAcademicQualification' => 'Rmc Academic Qualification',
            'RMCDesignation' => 'Rmc Designation',
            'RMCFaculty' => 'Rmc Faculty',
            'RMCMobileNo' => 'Rmc Mobile No',
            'RMCEmailAddress' => 'Rmc Email Address',
            'RMCServiceStatusId' => 'Rmc Service Status ID',
            'RMCAppointmentDate' => 'Rmc Appointment Date',
            'RMCContractExpiryDate' => 'Rmc Contract Expiry Date',
            'RMCId' => 'Rmc ID',
            'StatusId' => 'Status ID',
            'TransactionDate' => 'Transaction Date',
        ];
    }
}
