<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbluser".
 *
 * @property int $UserId
 * @property string $UserNo
 * @property string|null $UserNo2
 * @property string $FullName
 * @property string $ICPassportNo
 * @property string $PersonalEmail 
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

            [['UserDOB','UserNo', 'FullName'], 'required', 'on'=>['create','update']],

            // [['UserNo', 'FullName', 'ICPassportNo', 'EmailAddress', 'NationalityId', 'HandSetNo', 'PositionId', 'BranchId', 'WorkingStatusId', 'DateJoin', 'RaceId', 'Gender', 'DepartmentId', 'UserName', 'ChangePassword', 'ExtensionNo', 'MarketingTeamId'], 'required'],
            // [[ 'FullName', 'ICPassportNo', 'EmailAddress', 'NationalityId', 'HandSetNo', 'PositionId', 'BranchId', 'WorkingStatusId', 'RaceId', 'Gender', 'DepartmentId', 'UserName'], 'required'],
            [['NationalityId', 'DOBAlert', 'PositionId', 'BranchId', 'StatusId', 'WorkingStatusId', 'RaceId', 'ReligionId', 'Gender', 'MaritalStatusId', 'DepartmentId', 'TypeUser', 'Hod1', 'Hod2', 'StaffLevelId', 'CmsAccess', 'DCollegeCode', 'MarketingTeamId', 'MarketingSubTeamId', 'ThumbPrint', 'hrcms', 'keyinId', 'TargetNo', 'ProfileConform', 'DueDay', 'MonthWork', 'Evaluation'], 'integer'],
            [['UserDOB', 'DateJoin', 'DateConfirm', 'DateLast', 'ContractStart', 'ContractEnd', 'ChangePassword', 'TransactionDate',  'ProfileConformDate', 'ExtProbationStart', 'ExtProbationEnd'], 'safe'],
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

            // [['UserNo','FullName', 'ICPassportNo', 'EmailAddress', 'NationalityId'], 'customValidation', 'on'=>['create','update']],
        ];
    }


    public function customValidation($attributes, $params)
    {
        foreach ($attributes as $attribute) {
            if (empty($this->$attribute)) {
                $this->addError($attribute, 'The ' . $attribute . ' cannot be blanksssss.');
            }
        }
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
            'ICPassportNo' => Yii::t('app', 'NIRC/Passport No'),
            'PersonalEmail' => Yii::t('app', 'Personal Email Address'),            
            'EmailAddress' => Yii::t('app', 'CityU Email Address (@city.edu.my)'),
            'NationalityId' => Yii::t('app', 'Nationality'),
            'UserDOB' => Yii::t('app', 'User Dob'),
            'DOBAlert' => Yii::t('app', 'Dob Alert'),
            'HandSetNo' => Yii::t('app', 'Hand Set No'),
            'FaxNo' => Yii::t('app', 'Fax No'),
            'OffLettPosition' => Yii::t('app', 'Off Lett Position'),
            'PositionId' => Yii::t('app', 'Position'),
            'BranchId' => Yii::t('app', 'Location '),
            'StatusId' => Yii::t('app', 'Status ID'),
            'WorkingStatusId' => Yii::t('app', 'Working Status ID'),
            'DateJoin' => Yii::t('app', 'Date Join'),
            'DateConfirm' => Yii::t('app', 'Date Confirm'),
            'DateLast' => Yii::t('app', 'Date Last'),
            'ContractStart' => Yii::t('app', 'Contract Start'),
            'ContractEnd' => Yii::t('app', 'Contract End'),
            'RaceId' => Yii::t('app', 'Race'),
            'ReligionId' => Yii::t('app', 'Religion'),
            'Gender' => Yii::t('app', 'Gender'),
            'MaritalStatusId' => Yii::t('app', 'Marital Status'),
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
            // 'TransactionUpdated' => Yii::t('app', 'Transaction Updated'),
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




    public function getMyUserDetail()
    {
        $condition = '';
        $txtUser = Yii::$app->user->identity->UserId;
        $stmt = " SELECT
        tbluser.UserId,
        tbluser.UserNo,
        tbluser.UserNo2,
        tbluser.FullName,
        tbluser.ICPassportNo,
        tbluser.EmailAddress,
        tbluser.NationalityId,
        tbluser.UserDOB,
        tbluser.DOBAlert,
        tbluser.HandSetNo,
        tbluser.FaxNo,
        tbluser.OffLettPosition,
        tbluser.PositionId,
        tbluser.BranchId,
        tbluser.StatusId,
        tbluser.WorkingStatusId,
        tbluser.DateJoin,
        tbluser.DateConfirm,
        tbluser.DateLast,
        tbluser.ContractStart,
        tbluser.ContractEnd,
        tbluser.RaceId,
        tbluser.ReligionId,
        tbluser.Gender,
        tbluser.MaritalStatusId,
        tbluser.DepartmentId,
        tbluser.Remarks,
        tbluser.UserName,     
        tbluser.ActivateCode,
        tbluser.UserImage,
        tbluser.TypeUser,
        tbluser.Hod1,
        tbluser.Hod2,
        tbluser.StaffLevelId,
        tbluser.CmsAccess,
        tbluser.DCollegeCode,
        tbluser.ChangePassword,
        tbluser.TransactionDate,        
        tbluser.ExtensionNo,
        tbluser.MarketingTeamId,
        tbluser.MarketingSubTeamId,
        tbluser.ThumbPrint,
        tbluser.hrcms,
        tbluser.keyinId,
        tbluser.TargetNo,
        tbluser.ProfileConform,
        tbluser.ProfileConformDate,
        tbluser.ExtProbationStart,
        tbluser.ExtProbationEnd,
        tbluser.DueDay,
        tbluser.MonthWork,
        tbluser.Evaluation
   
        FROM
        tbluser ";


        if (!empty($txtUser)) {
            $condition .= "tbluser.UserId = $txtUser and ";
        }


        if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }

        $stmt .= $condition . ' ORDER BY   tbluser.FullName ';

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }


    public function getUserlist()
    {
        $condition = '';

        //$data = explode(";", $param);


        $condition = "";
        $txtSearch = $_GET['txtSearch'];
        $txtStatusId = $_GET['txtStatusId'];
        $txtDeptCatId = $_GET['txtDeptCatId'];
        // $txtUser = $_GET['txtUser'];

        $stmt = " SELECT
        tbluser.UserId,
        tbluser.UserNo,
        tbluser.UserNo2,
        tbluser.FullName,
        tbluser.ICPassportNo,
        tbluser.EmailAddress,
        tbluser.NationalityId,
        tbluser.UserDOB,
        tbluser.DOBAlert,
        tbluser.HandSetNo,
        tbluser.FaxNo,
        tbluser.OffLettPosition,
        tbluser.PositionId,
        tbluser.BranchId,
        tbluser.StatusId,
        tbluser.WorkingStatusId,
        tbluser.DateJoin,
        tbluser.DateConfirm,
        tbluser.DateLast,
        tbluser.ContractStart,
        tbluser.ContractEnd,
        tbluser.RaceId,
        tbluser.ReligionId,
        tbluser.Gender,
        tbluser.MaritalStatusId,
        tbluser.DepartmentId,
        tbluser.Remarks,
        tbluser.UserName,
        tbluser.UserPassword,
        tbluser.UserPasswordCrypt,
        tbluser.user_password_code,
        tbluser.ActivateCode,
        tbluser.UserImage,
        tbluser.TypeUser,
        tbluser.Hod1,
        tbluser.Hod2,
        tbluser.StaffLevelId,
        tbluser.CmsAccess,
        tbluser.DCollegeCode,
        tbluser.ChangePassword,
        tbluser.TransactionDate,        
        tbluser.ExtensionNo,
        tbluser.MarketingTeamId,
        tbluser.MarketingSubTeamId,
        tbluser.ThumbPrint,
        tbluser.hrcms,
        tbluser.keyinId,
        tbluser.TargetNo,
        tbluser.ProfileConform,
        tbluser.ProfileConformDate,
        tbluser.ExtProbationStart,
        tbluser.ExtProbationEnd,
        tbluser.DueDay,
        tbluser.MonthWork,
        tbluser.Evaluation,
        tblstatusai.`Status`,
        tbldepartment.DeptCatId,
        tbldepartment.DepartmentDesc,
        tbldepartmentcategory.DeptCatDesc
        FROM
        tbluser
        INNER JOIN tblstatusai ON tbluser.StatusId = tblstatusai.StatusId
        INNER JOIN tbldepartment ON tbluser.DepartmentId = tbldepartment.DepartmentId
        INNER JOIN tbldepartmentcategory ON tbldepartment.DeptCatId = tbldepartmentcategory.DeptCatId ";

        $condition .= "tbluser.FullName Not like '%-TBA%' and ";

        if (!empty($txtSearch)) {
            $condition .= "concat(tbluser.FullName,tbluser.HandSetNo) like '%$txtSearch%' and ";
        }

        if (!empty($txtStatusId)) {
            $condition .= "tbluser.StatusId = $txtStatusId and ";
        }

        if (!empty($txtDeptCatId)) {
            $condition .= "tbldepartment.DeptCatId = $txtDeptCatId and ";
        }

        if (!empty($txtUser)) {
            $condition .= "tbluser.UserId = $txtUser and ";
        }

        if (empty($txtSearch || $txtStatusId || $txtDeptCatId)) {

            $condition .= "tbluser.StatusId = 1 and tbldepartment.DeptCatId = 1 and ";
        }


        if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }

        $stmt .= $condition . ' ORDER BY   tbluser.FullName ';

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }
}
