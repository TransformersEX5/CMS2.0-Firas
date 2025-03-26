<?php

namespace app\modules\programfee\models;

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
            [['DateRegister', 'ConvoDate', 'TransactionUpdated', 'CertTakenDate', 'DebtStatusDate'], 'safe'],
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
            'ProgramRegId' => 'Program Reg ID',
            'StudentId' => 'Student ID',
            'ProgramId' => 'Program ID',
            'IntakeId' => 'Intake ID',
            'FeeIntakeId' => 'Fee Intake ID',
            'MapId' => 'Map ID',
            'YearEntryId' => 'Year Entry ID',
            'StudentNo' => 'Student No',
            'SessionId' => 'Session ID',
            'DateRegister' => 'Date Register',
            'MentorId' => 'Mentor ID',
            'MarketingId' => 'Marketing ID',
            'AgentId' => 'Agent ID',
            'MarketingLocalId' => 'Marketing Local ID',
            'ConvoDate' => 'Convo Date',
            'TransactionUpdated' => 'Transaction Updated',
            'CertTakenDate' => 'Cert Taken Date',
            'ConvoRemarks' => 'Convo Remarks',
            'CertNo' => 'Cert No',
            'PromoId' => 'Promo ID',
            'UserId' => 'User ID',
            'OldStudentNo' => 'Old Student No',
            'DataFrrom' => 'Data Frrom',
            'StudentGroupId' => 'Student Group ID',
            'OnlineIntake' => 'Online Intake',
            'ByUserId' => 'By User ID',
            'DebtUserId' => 'Debt User ID',
            'DebtStatusId' => 'Debt Status ID',
            'DebtStatusDate' => 'Debt Status Date',
            'AcademicOuts' => 'Academic Outs',
            'AcademicOutsPrevSem' => 'Academic Outs Prev Sem',
            'AssesmentOuts' => 'Assesment Outs',
            'HostelOuts' => 'Hostel Outs',
            'DiscountCategoryId' => 'Discount Category ID',
            'AcademicAging' => 'Academic Aging',
            'HostelAging' => 'Hostel Aging',
            'UtilitiesAging' => 'Utilities Aging',
            'UtilitiesOuts' => 'Utilities Outs',
            'AllowSubjReg' => 'Allow Subj Reg',
            'SemAdj' => 'Sem Adj',
            'AcadCalId' => 'Acad Cal ID',
            'OnOffSearch' => 'On Off Search',
            'InternationalId' => 'International ID',
            'InternationalDesc' => 'International Desc',
            'Description' => 'Description',
            'CurrentStatus' => 'Current Status',
            'ContinueStudy' => 'Continue Study',
            'ContinueStudyId' => 'Continue Study ID',
            'LeadId' => 'Lead ID',
            'ActiveEnroll' => 'Active Enroll',
            'FeeStructureId' => 'Fee Structure ID',
            'IeltsStatusId' => 'Ielts Status ID',
            'BlockSportalId' => 'Block Sportal ID',
            'ProgDiscCategoryId' => 'Prog Disc Category ID',
            'IcmsIcNo' => 'Icms Ic No',
            'MStudentNo' => 'M Student No',
            'ProgFeeCatId' => 'Prog Fee Cat ID',
        ];
    }
}
