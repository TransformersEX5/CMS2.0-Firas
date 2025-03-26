<?php

namespace app\modules\marketingadmin\models;

use Yii;

/**
 * This is the model class for table "tbluser".
 *
 * @property int $UserId
 * @property string $UserNo
 * @property string|null $UserNo2
 * @property string $FullName
 * @property string|null $ShortName
 * @property string $ICPassportNo
 * @property string $EmailAddress
 * @property int $NationalityId
 * @property string $UserDOB
 * @property int|null $DOBAlert
 * @property string $HandSetNo
 * @property string|null $FaxNo
 * @property string|null $OffLettPosition
 * @property int $PositionId
 * @property int $BranchId
 * @property int $StatusId
 * @property int $WorkingStatusId
 * @property string $DateJoin
 * @property string $DateConfirm
 * @property string $DateLast
 * @property string|null $ContractStart
 * @property string|null $ContractEnd
 * @property int $RaceId
 * @property int|null $ReligionId
 * @property int $Gender
 * @property int $MaritalStatusId
 * @property int $DepartmentId
 * @property string|null $Remarks
 * @property string $UserName
 * @property string $UserPassword
 * @property string|null $UserPasswordCrypt
 * @property string|null $user_password_code
 * @property string|null $ActivateCode
 * @property string|null $UserImage
 * @property int $TypeUser 1=Staff , 2= Agent
 * @property int|null $Hod1
 * @property int|null $Hod2
 * @property int $StaffLevelId 1-Head/2-Staff
 * @property int $CmsAccess 1=Active,2=Inactive CMS Access
 * @property int $DCollegeCode Defult College Code
 * @property string $ChangePassword
 * @property string $TransactionDate
 * @property string $TransactionUpdated
 * @property string $ExtensionNo
 * @property int $MarketingTeamId
 * @property int|null $MarketingSubTeamId
 * @property int|null $ThumbPrint 1= no absent email; 2= get absent email
 * @property int|null $hrcms
 * @property int|null $keyinId
 * @property int|null $TargetNo
 * @property int|null $ExgratiaRateP1 CommictionClaimRate
 * @property int|null $ExgratiaRateP2
 * @property int|null $ProfileConform 1=Not Conform; 2=Conform
 * @property string|null $ProfileConformDate
 * @property string|null $ExtProbationStart Extension of Probation Start Date
 * @property string|null $ExtProbationEnd Extension of Probation End Date
 * @property int|null $DueDay
 * @property int|null $MonthWork total Month Work
 * @property int|null $Evaluation for Staff Evaluation ;  0=No; 1=Yes
 * @property int|null $Int_PositionId
 * @property int|null $Int_TeamId
 * @property int|null $Int_Target
 * @property int|null $SalaryId
 */
class Tbluser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbluser';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UserNo', 'FullName', 'ICPassportNo', 'EmailAddress', 'NationalityId', 'HandSetNo', 'PositionId', 'BranchId', 'WorkingStatusId', 'DateJoin', 'RaceId', 'Gender', 'DepartmentId', 'UserName', 'ChangePassword', 'ExtensionNo', 'MarketingTeamId'], 'required'],
            [['NationalityId', 'DOBAlert', 'PositionId', 'BranchId', 'StatusId', 'WorkingStatusId', 'RaceId', 'ReligionId', 'Gender', 'MaritalStatusId', 'DepartmentId', 'TypeUser', 'Hod1', 'Hod2', 'StaffLevelId', 'CmsAccess', 'DCollegeCode', 'MarketingTeamId', 'MarketingSubTeamId', 'ThumbPrint', 'hrcms', 'keyinId', 'TargetNo', 'ExgratiaRateP1', 'ExgratiaRateP2', 'ProfileConform', 'DueDay', 'MonthWork', 'Evaluation', 'Int_PositionId', 'Int_TeamId', 'Int_Target', 'SalaryId'], 'integer'],
            [['UserDOB', 'DateJoin', 'DateConfirm', 'DateLast', 'ContractStart', 'ContractEnd', 'ChangePassword', 'TransactionDate', 'TransactionUpdated', 'ProfileConformDate', 'ExtProbationStart', 'ExtProbationEnd'], 'safe'],
            [['UserNo', 'UserNo2', 'ExtensionNo'], 'string', 'max' => 10],
            [['FullName'], 'string', 'max' => 180],
            [['ShortName'], 'string', 'max' => 20],
            [['ICPassportNo'], 'string', 'max' => 16],
            [['EmailAddress'], 'string', 'max' => 150],
            [['HandSetNo', 'FaxNo'], 'string', 'max' => 15],
            [['OffLettPosition', 'UserPassword'], 'string', 'max' => 80],
            [['Remarks', 'ActivateCode'], 'string', 'max' => 250],
            [['UserName'], 'string', 'max' => 50],
            [['UserPasswordCrypt', 'UserImage'], 'string', 'max' => 100],
            [['user_password_code'], 'string', 'max' => 30],
            [['UserNo', 'ICPassportNo'], 'unique', 'targetAttribute' => ['UserNo', 'ICPassportNo']],
            [['UserNo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'UserId' => 'User ID',
            'UserNo' => 'User No',
            'UserNo2' => 'User No2',
            'FullName' => 'Full Name',
            'ShortName' => 'Short Name',
            'ICPassportNo' => 'Ic Passport No',
            'EmailAddress' => 'Email Address',
            'NationalityId' => 'Nationality ID',
            'UserDOB' => 'User Dob',
            'DOBAlert' => 'Dob Alert',
            'HandSetNo' => 'Hand Set No',
            'FaxNo' => 'Fax No',
            'OffLettPosition' => 'Off Lett Position',
            'PositionId' => 'Position ID',
            'BranchId' => 'Branch ID',
            'StatusId' => 'Status ID',
            'WorkingStatusId' => 'Working Status ID',
            'DateJoin' => 'Date Join',
            'DateConfirm' => 'Date Confirm',
            'DateLast' => 'Date Last',
            'ContractStart' => 'Contract Start',
            'ContractEnd' => 'Contract End',
            'RaceId' => 'Race ID',
            'ReligionId' => 'Religion ID',
            'Gender' => 'Gender',
            'MaritalStatusId' => 'Marital Status ID',
            'DepartmentId' => 'Department ID',
            'Remarks' => 'Remarks',
            'UserName' => 'User Name',
            'UserPassword' => 'User Password',
            'UserPasswordCrypt' => 'User Password Crypt',
            'user_password_code' => 'User Password Code',
            'ActivateCode' => 'Activate Code',
            'UserImage' => 'User Image',
            'TypeUser' => 'Type User',
            'Hod1' => 'Hod1',
            'Hod2' => 'Hod2',
            'StaffLevelId' => 'Staff Level ID',
            'CmsAccess' => 'Cms Access',
            'DCollegeCode' => 'D College Code',
            'ChangePassword' => 'Change Password',
            'TransactionDate' => 'Transaction Date',
            'TransactionUpdated' => 'Transaction Updated',
            'ExtensionNo' => 'Extension No',
            'MarketingTeamId' => 'Marketing Team ID',
            'MarketingSubTeamId' => 'Marketing Sub Team ID',
            'ThumbPrint' => 'Thumb Print',
            'hrcms' => 'Hrcms',
            'keyinId' => 'Keyin ID',
            'TargetNo' => 'Target No',
            'ExgratiaRateP1' => 'Exgratia Rate P1',
            'ExgratiaRateP2' => 'Exgratia Rate P2',
            'ProfileConform' => 'Profile Conform',
            'ProfileConformDate' => 'Profile Conform Date',
            'ExtProbationStart' => 'Ext Probation Start',
            'ExtProbationEnd' => 'Ext Probation End',
            'DueDay' => 'Due Day',
            'MonthWork' => 'Month Work',
            'Evaluation' => 'Evaluation',
            'Int_PositionId' => 'Int Position ID',
            'Int_TeamId' => 'Int Team ID',
            'Int_Target' => 'Int Target',
            'SalaryId' => 'Salary ID',
        ];
    }
}
