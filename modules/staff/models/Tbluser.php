<?php

namespace app\modules\staff\models;

use Yii;

/**
 * This is the model class for table "tbluser".
 *
 * @property int $UserId
 * @property string $UserNo
 * @property string|null $UserNo2
 * @property string $FullName
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
 * @property string $ExtensionNo
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
            [['UserNo', 'FullName', 'ICPassportNo', 'EmailAddress', 'NationalityId', 'HandSetNo', 'PositionId', 'BranchId', 'WorkingStatusId', 'DateJoin', 'RaceId', 'Gender', 'DepartmentId', 'UserName', 'ChangePassword', 'ExtensionNo'], 'required'],
            [['NationalityId', 'DOBAlert', 'PositionId', 'BranchId', 'StatusId', 'WorkingStatusId', 'RaceId', 'ReligionId', 'Gender', 'MaritalStatusId', 'DepartmentId', 'TypeUser', 'Hod1', 'Hod2', 'StaffLevelId', 'CmsAccess', 'DCollegeCode', 'MarketingTeamId', 'MarketingSubTeamId', 'ThumbPrint', 'hrcms', 'keyinId', 'TargetNo', 'ProfileConform', 'DueDay', 'MonthWork', 'Evaluation'], 'integer'],
            [['UserDOB', 'DateJoin', 'DateConfirm', 'DateLast', 'ContractStart', 'ContractEnd', 'ChangePassword', 'TransactionDate', 'ProfileConformDate', 'ExtProbationStart', 'ExtProbationEnd'], 'safe'],
            [['UserNo', 'UserNo2', 'ExtensionNo'], 'string', 'max' => 10],
            [['FullName'], 'string', 'max' => 180],
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
            'UserId' => Yii::t('app', 'User ID'),
            'UserNo' => Yii::t('app', 'User No'),
            'UserNo2' => Yii::t('app', 'User No2'),
            'FullName' => Yii::t('app', 'Full Name'),
            'ICPassportNo' => Yii::t('app', 'Ic Passport No'),
            'EmailAddress' => Yii::t('app', 'Email Address'),
            'NationalityId' => Yii::t('app', 'Nationality ID'),
            'UserDOB' => Yii::t('app', 'User Dob'),
            'DOBAlert' => Yii::t('app', 'Dob Alert'),
            'HandSetNo' => Yii::t('app', 'Hand Set No'),
            'FaxNo' => Yii::t('app', 'Fax No'),
            'OffLettPosition' => Yii::t('app', 'Off Lett Position'),
            'PositionId' => Yii::t('app', 'Position ID'),
            'BranchId' => Yii::t('app', 'Branch ID'),
            'StatusId' => Yii::t('app', 'Status ID'),
            'WorkingStatusId' => Yii::t('app', 'Working Status ID'),
            'DateJoin' => Yii::t('app', 'Date Join'),
            'DateConfirm' => Yii::t('app', 'Date Confirm'),
            'DateLast' => Yii::t('app', 'Date Last'),
            'ContractStart' => Yii::t('app', 'Contract Start'),
            'ContractEnd' => Yii::t('app', 'Contract End'),
            'RaceId' => Yii::t('app', 'Race ID'),
            'ReligionId' => Yii::t('app', 'Religion ID'),
            'Gender' => Yii::t('app', 'Gender'),
            'MaritalStatusId' => Yii::t('app', 'Marital Status ID'),
            'DepartmentId' => Yii::t('app', 'Department ID'),
            'Remarks' => Yii::t('app', 'Remarks'),
            'UserName' => Yii::t('app', 'User Name'),
            'UserPassword' => Yii::t('app', 'User Password'),
            'UserPasswordCrypt' => Yii::t('app', 'User Password Crypt'),
            'user_password_code' => Yii::t('app', 'User Password Code'),
            'ActivateCode' => Yii::t('app', 'Activate Code'),
            'UserImage' => Yii::t('app', 'User Image'),
            'TypeUser' => Yii::t('app', 'Type User'),
            'Hod1' => Yii::t('app', 'Hod1'),
            'Hod2' => Yii::t('app', 'Hod2'),
            'StaffLevelId' => Yii::t('app', 'Staff Level ID'),
            'CmsAccess' => Yii::t('app', 'Cms Access'),
            'DCollegeCode' => Yii::t('app', 'D College Code'),
            'ChangePassword' => Yii::t('app', 'Change Password'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
            'ExtensionNo' => Yii::t('app', 'Extension No'),
            'MarketingTeamId' => Yii::t('app', 'Marketing Team ID'),
            'MarketingSubTeamId' => Yii::t('app', 'Marketing Sub Team ID'),
            'ThumbPrint' => Yii::t('app', 'Thumb Print'),
            'hrcms' => Yii::t('app', 'Hrcms'),
            'keyinId' => Yii::t('app', 'Keyin ID'),
            'TargetNo' => Yii::t('app', 'Target No'),
            'ProfileConform' => Yii::t('app', 'Profile Conform'),
            'ProfileConformDate' => Yii::t('app', 'Profile Conform Date'),
            'ExtProbationStart' => Yii::t('app', 'Ext Probation Start'),
            'ExtProbationEnd' => Yii::t('app', 'Ext Probation End'),
            'DueDay' => Yii::t('app', 'Due Day'),
            'MonthWork' => Yii::t('app', 'Month Work'),
            'Evaluation' => Yii::t('app', 'Evaluation'),
        ];
    }
}
