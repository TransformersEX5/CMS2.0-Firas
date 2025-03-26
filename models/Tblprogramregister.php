<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblprogramregister".
 *
 * @property int $ProgramRegId
 * @property int $StudentId
 * @property int $ProgramId
 * @property int $IntakeId
 * @property int $FeeIntakeId
 * @property int $MapId
 * @property int $YearEntryId Start Study Year
 * @property string|null $StudentNo
 * @property int $SessionId
 * @property string $DateRegister
 * @property int|null $MentorId
 * @property int|null $MarketingId
 * @property int|null $AgentId
 * @property int|null $MarketingLocalId
 * @property string|null $ConvoDate
 * @property string $TransactionUpdated
 * @property string|null $CertTakenDate
 * @property string|null $ConvoRemarks
 * @property string|null $CertNo
 * @property int $PromoId
 * @property int $UserId
 * @property string|null $OldStudentNo
 * @property string $DataFrrom
 * @property int $StudentGroupId
 * @property int $OnlineIntake
 * @property int $ByUserId
 * @property int|null $DebtUserId
 * @property int $DebtStatusId 0=No;1=Yes
 * @property string|null $DebtStatusDate
 * @property float $AcademicOuts
 * @property float $AcademicOutsPrevSem
 * @property float $AssesmentOuts
 * @property float $HostelOuts
 * @property int|null $DiscountCategoryId
 * @property int $AcademicAging
 * @property int $HostelAging
 * @property int $UtilitiesAging
 * @property float $UtilitiesOuts
 * @property int $AllowSubjReg 0=Block;1=allow by sys; 2=allow by user
 * @property int $SemAdj semester adjustment for mini intake
 * @property int|null $AcadCalId
 * @property int|null $OnOffSearch 1=can_search; 
 * @property int|null $InternationalId
 * @property string|null $InternationalDesc
 * @property string|null $Description
 * @property int|null $CurrentStatus
 * @property int|null $ContinueStudy For Student -F or DP ContinueStudy ; 1="-F/-DP" ; 2= Dip or founation to degree
 * @property int|null $ContinueStudyId 1=new
 * @property int|null $LeadId
 * @property int|null $ActiveEnroll
 * @property int|null $FeeStructureId 1=Normal Fee Structure
 * @property int|null $IeltsStatusId
 * @property int|null $BlockSportalId
 * @property int|null $ProgDiscCategoryId
 * @property string|null $IcmsIcNo
 * @property string|null $MStudentNo Student Bring Student
 * @property int|null $ProgFeeCatId
 * @property string|null $P1
 * @property string|null $P2
 */
class Tblprogramregister extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblprogramregister';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['StudentId', 'ProgramId', 'IntakeId', 'SessionId', 'UserId'], 'required'],
            [['StudentId', 'ProgramId', 'IntakeId', 'FeeIntakeId', 'MapId', 'YearEntryId', 'SessionId', 'MentorId', 'MarketingId', 'AgentId', 'MarketingLocalId', 'PromoId', 'UserId', 'StudentGroupId', 'OnlineIntake', 'ByUserId', 'DebtUserId', 'DebtStatusId', 'DiscountCategoryId', 'AcademicAging', 'HostelAging', 'UtilitiesAging', 'AllowSubjReg', 'SemAdj', 'AcadCalId', 'OnOffSearch', 'InternationalId', 'CurrentStatus', 'ContinueStudy', 'ContinueStudyId', 'LeadId', 'ActiveEnroll', 'FeeStructureId', 'IeltsStatusId', 'BlockSportalId', 'ProgDiscCategoryId', 'ProgFeeCatId'], 'integer'],
            [['DateRegister', 'ConvoDate', 'TransactionUpdated', 'CertTakenDate', 'DebtStatusDate', 'P1', 'P2'], 'safe'],
            [['AcademicOuts', 'AcademicOutsPrevSem', 'AssesmentOuts', 'HostelOuts', 'UtilitiesOuts'], 'number'],
            [['StudentNo', 'MStudentNo'], 'string', 'max' => 16],
            [['ConvoRemarks', 'InternationalDesc', 'Description'], 'string', 'max' => 255],
            [['CertNo'], 'string', 'max' => 20],
            [['OldStudentNo'], 'string', 'max' => 50],
            [['DataFrrom'], 'string', 'max' => 3],
            [['IcmsIcNo'], 'string', 'max' => 30],
            [['StudentId', 'ProgramId', 'IntakeId'], 'unique', 'targetAttribute' => ['StudentId', 'ProgramId', 'IntakeId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ProgramRegId' => Yii::t('app', 'Program Reg ID'),
            'StudentId' => Yii::t('app', 'Student ID'),
            'ProgramId' => Yii::t('app', 'Program ID'),
            'IntakeId' => Yii::t('app', 'Intake ID'),
            'FeeIntakeId' => Yii::t('app', 'Fee Intake ID'),
            'MapId' => Yii::t('app', 'Map ID'),
            'YearEntryId' => Yii::t('app', 'Year Entry ID'),
            'StudentNo' => Yii::t('app', 'Student No'),
            'SessionId' => Yii::t('app', 'Session ID'),
            'DateRegister' => Yii::t('app', 'Date Register'),
            'MentorId' => Yii::t('app', 'Mentor ID'),
            'MarketingId' => Yii::t('app', 'Marketing ID'),
            'AgentId' => Yii::t('app', 'Agent ID'),
            'MarketingLocalId' => Yii::t('app', 'Marketing Local ID'),
            'ConvoDate' => Yii::t('app', 'Convo Date'),
            'TransactionUpdated' => Yii::t('app', 'Transaction Updated'),
            'CertTakenDate' => Yii::t('app', 'Cert Taken Date'),
            'ConvoRemarks' => Yii::t('app', 'Convo Remarks'),
            'CertNo' => Yii::t('app', 'Cert No'),
            'PromoId' => Yii::t('app', 'Promo ID'),
            'UserId' => Yii::t('app', 'User ID'),
            'OldStudentNo' => Yii::t('app', 'Old Student No'),
            'DataFrrom' => Yii::t('app', 'Data Frrom'),
            'StudentGroupId' => Yii::t('app', 'Student Group ID'),
            'OnlineIntake' => Yii::t('app', 'Online Intake'),
            'ByUserId' => Yii::t('app', 'By User ID'),
            'DebtUserId' => Yii::t('app', 'Debt User ID'),
            'DebtStatusId' => Yii::t('app', 'Debt Status ID'),
            'DebtStatusDate' => Yii::t('app', 'Debt Status Date'),
            'AcademicOuts' => Yii::t('app', 'Academic Outs'),
            'AcademicOutsPrevSem' => Yii::t('app', 'Academic Outs Prev Sem'),
            'AssesmentOuts' => Yii::t('app', 'Assesment Outs'),
            'HostelOuts' => Yii::t('app', 'Hostel Outs'),
            'DiscountCategoryId' => Yii::t('app', 'Discount Category ID'),
            'AcademicAging' => Yii::t('app', 'Academic Aging'),
            'HostelAging' => Yii::t('app', 'Hostel Aging'),
            'UtilitiesAging' => Yii::t('app', 'Utilities Aging'),
            'UtilitiesOuts' => Yii::t('app', 'Utilities Outs'),
            'AllowSubjReg' => Yii::t('app', 'Allow Subj Reg'),
            'SemAdj' => Yii::t('app', 'Sem Adj'),
            'AcadCalId' => Yii::t('app', 'Acad Cal ID'),
            'OnOffSearch' => Yii::t('app', 'On Off Search'),
            'InternationalId' => Yii::t('app', 'International ID'),
            'InternationalDesc' => Yii::t('app', 'International Desc'),
            'Description' => Yii::t('app', 'Description'),
            'CurrentStatus' => Yii::t('app', 'Current Status'),
            'ContinueStudy' => Yii::t('app', 'Continue Study'),
            'ContinueStudyId' => Yii::t('app', 'Continue Study ID'),
            'LeadId' => Yii::t('app', 'Lead ID'),
            'ActiveEnroll' => Yii::t('app', 'Active Enroll'),
            'FeeStructureId' => Yii::t('app', 'Fee Structure ID'),
            'IeltsStatusId' => Yii::t('app', 'Ielts Status ID'),
            'BlockSportalId' => Yii::t('app', 'Block Sportal ID'),
            'ProgDiscCategoryId' => Yii::t('app', 'Prog Disc Category ID'),
            'IcmsIcNo' => Yii::t('app', 'Icms Ic No'),
            'MStudentNo' => Yii::t('app', 'M Student No'),
            'ProgFeeCatId' => Yii::t('app', 'Prog Fee Cat ID'),
            'P1' => Yii::t('app', 'P1'),
            'P2' => Yii::t('app', 'P2'),
        ];
    }


    function getRequestlist(){

 
       
        $stmt = " SELECT
        tblrequest.RequestId
        from tblrequest limit 1";


        $data = \Yii::$app->db->createCommand($stmt)->queryAll();


        return $data;
    }
    
    public function getProgramRegisterList()
    {
        $condition = '';

        //$data = explode(";", $param);
        

        $condition = "";
        $txtSearch      = $_GET['txtSearch'];
        // $txtStatusId    = $_GET['txtStatusId'];
        // $txtDeptCatId   = $_GET['txtDeptCatId'];


        $stmt = " SELECT
        tblstudent.StudentId,
        tblstudent.StudentNo,
        tblstudent.StudNRICPassportNo,
        tblstudent.StudName,
        tblprogram.ProgramCode,
        tblprogram.ProgramName,
        tblintake.IntakeYrMo,
        get_studentregisterstatus.StatusName,
        DATE_FORMAT(tblprogramregister.DateRegister,'%d-%m-%Y') as  DateRegister,
        tblprogramregister.AcademicOuts,
        tblprogramregister.ProgramRegId
        FROM
        tblstudent
        INNER JOIN tblprogramregister ON tblstudent.StudentId = tblprogramregister.StudentId
        INNER JOIN tblprogram ON tblprogram.ProgramId = tblprogramregister.ProgramId
        INNER JOIN tblintake ON tblprogramregister.IntakeId = tblintake.IntakeId
        INNER JOIN get_studentregisterstatus ON tblprogramregister.ProgramRegId = get_studentregisterstatus.ProgramRegId ";



        if (empty($txtSearch)) {
            $condition .= "datediff(CURRENT_DATE,tblprogramregister.DateRegister) <5 and ";
        }


        if (!empty($txtSearch)) {
            $condition .= "concat( tblstudent.StudentNo, tblstudent.StudNRICPassportNo, tblstudent.StudName) like '%$txtSearch%' and ";
        }

        // if (!empty($txtStatusId)) {
        //     $condition .= "tbldepartment.StatusId = $txtStatusId and ";
        // }

        //  if (!empty($txtDeptCatId)) {
        //      $condition .= "  tbldepartment.DeptCatId  = $txtDeptCatId and ";
        //  }

        if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }

        $stmt .= $condition . ' ORDER BY  tblstudent.StudName , tblprogramregister.DateRegister DESC ';

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }

  
}

