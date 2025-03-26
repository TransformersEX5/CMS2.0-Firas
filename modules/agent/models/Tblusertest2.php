<?php

namespace app\modules\agent\models;

use Yii;

/**
 * This is the model class for table "tblusertest2".
 *
 * @property int $UserId
 * @property string|null $UserNo
 * @property string|null $UserNo2
 * @property string|null $FullName
 * @property string|null $ICPassportNo
 * @property string|null $EmailAddress
 * @property int|null $NationalityId
 * @property string|null $UserDOB
 * @property int|null $DOBAlert
 * @property string|null $HandSetNo
 * @property string|null $FaxNo
 * @property string|null $OffLettPosition
 * @property int|null $PositionId
 * @property int|null $BranchId
 * @property int|null $StatusId
 * @property int|null $WorkingStatusId
 * @property string|null $DateJoin
 * @property string|null $DateConfirm
 * @property string|null $DateLast
 * @property string|null $ContractStart
 * @property string|null $ContractEnd
 * @property int|null $RaceId
 * @property int|null $ReligionId
 * @property int|null $Gender
 * @property int|null $MaritalStatusId
 * @property int|null $DepartmentId
 * @property string|null $Remarks
 * @property string|null $UserName
 * @property string|null $UserPassword
 * @property string|null $UserPasswordCrypt
 * @property string|null $user_password_code
 * @property string|null $ActivateCode
 * @property string|null $UserImage
 * @property int|null $TypeUser 1=Staff , 2= Agent
 * @property int|null $Hod1
 * @property int|null $Hod2
 * @property int|null $StaffLevelId 1-Head/2-Staff
 * @property int|null $CmsAccess 1=Active,2=Inactive CMS Access
 * @property int|null $DCollegeCode Defult College Code
 * @property string|null $ChangePassword
 * @property string|null $TransactionDate
 * @property string|null $TransactionUpdated
 * @property string|null $ExtensionNo
 * @property int $MarketingTeamId
 * @property int|null $MarketingSubTeamId
 * @property int|null $ThumbPrint 1= no absent email; 2= get absent email
 * @property int|null $hrcms
 * @property int|null $keyinId
 * @property int|null $TargetNo
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
 * @property string|null $AgentNatureOfBusiness
 * @property string|null $AgentBusinessAddress
 * @property string|null $AgentSocialMedia
 * @property string|null $AgentPIC
 * @property string|null $AgentYearsInBusiness
 * @property int|null $AgentNumberOfStaffs
 * @property string|null $AgentRecruitmentBranch
 * @property string|null $AgentPreferredCountry
 * @property string|null $AgentFocusedCountry
 * @property string|null $AgentInterestedProgram
 * @property int|null $AgentNumberOfEvent
 * @property string|null $AgentBankName
 * @property int|null $AgentBankAccountNumber
 * @property string|null $AgentBankBranch
 * @property string|null $AgentBankCountry
 * @property string|null $AgentBankSwiftCode
 */
class Tblusertest2 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblusertest';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UserNo', 'FullName', 'ICPassportNo', 'EmailAddress', 'NationalityId', 'PositionId', 'BranchId', 'WorkingStatusId', 'DateJoin', 'RaceId', 'Gender', 'DepartmentId', 'ChangePassword', 'MarketingTeamId'], 'required'],
            [['NationalityId', 'DOBAlert', 'PositionId', 'BranchId', 'StatusId', 'WorkingStatusId', 'RaceId', 'ReligionId', 'Gender', 'MaritalStatusId', 'DepartmentId', 'TypeUser', 'Hod1', 'Hod2', 'StaffLevelId', 'CmsAccess', 'DCollegeCode', 'MarketingTeamId', 'MarketingSubTeamId', 'ThumbPrint', 'hrcms', 'keyinId', 'TargetNo', 'ProfileConform', 'DueDay', 'MonthWork', 'Evaluation', 'Int_PositionId', 'Int_TeamId', 'Int_Target', 'AgentNumberOfStaffs', 'AgentNumberOfEvent', 'AgentBankAccountNumber'], 'integer'],
            [['UserDOB', 'DateJoin', 'DateConfirm', 'DateLast', 'ContractStart', 'ContractEnd', 'ChangePassword', 'TransactionDate', 'TransactionUpdated', 'ProfileConformDate', 'ExtProbationStart', 'ExtProbationEnd'], 'safe'],
            [['MarketingTeamId'], 'required'],
            [['UserNo', 'UserNo2', 'ExtensionNo'], 'string', 'max' => 10],
            [['FullName'], 'string', 'max' => 180],
            [['ICPassportNo'], 'string', 'max' => 16],
            [['EmailAddress'], 'string', 'max' => 150],
            [['HandSetNo', 'FaxNo'], 'string', 'max' => 15],
            [['OffLettPosition', 'UserPassword'], 'string', 'max' => 80],
            [['Remarks', 'ActivateCode'], 'string', 'max' => 250],
            [['UserName'], 'string', 'max' => 50, 'skipOnEmpty' => true],
            [['ExtensionNo'], 'string', 'max' => 10, 'skipOnEmpty' => true],
            [['UserPasswordCrypt', 'UserImage'], 'string', 'max' => 100],
            [['user_password_code'], 'string', 'max' => 30],
            [['AgentNatureOfBusiness', 'AgentBusinessAddress', 'AgentSocialMedia', 'AgentPIC', 'AgentYearsInBusiness', 'AgentRecruitmentBranch', 'AgentPreferredCountry', 'AgentFocusedCountry', 'AgentInterestedProgram', 'AgentBankName', 'AgentBankBranch', 'AgentBankCountry', 'AgentBankSwiftCode'], 'string', 'max' => 255],
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
            'AgentNatureOfBusiness' => 'Agent Nature Of Business',
            'AgentBusinessAddress' => 'Agent Business Address',
            'AgentSocialMedia' => 'Agent Social Media',
            'AgentPIC' => 'Agent Pic',
            'AgentYearsInBusiness' => 'Agent Years In Business',
            'AgentNumberOfStaffs' => 'Agent Number Of Staffs',
            'AgentRecruitmentBranch' => 'Agent Recruitment Branch',
            'AgentPreferredCountry' => 'Agent Preferred Country',
            'AgentFocusedCountry' => 'Agent Focused Country',
            'AgentInterestedProgram' => 'Agent Interested Program',
            'AgentNumberOfEvent' => 'Agent Number Of Event',
            'AgentBankName' => 'Agent Bank Name',
            'AgentBankAccountNumber' => 'Agent Bank Account Number',
            'AgentBankBranch' => 'Agent Bank Branch',
            'AgentBankCountry' => 'Agent Bank Country',
            'AgentBankSwiftCode' => 'Agent Bank Swift Code',
        ];
    }
}
