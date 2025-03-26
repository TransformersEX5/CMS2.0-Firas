<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblsubjectregister".
 *
 * @property int $SubjectRegId
 * @property int $StudentId
 * @property int $IntakeRegId
 * @property int $ProgramRegId
 * @property int $SubjectId
 * @property int $SubjectRegStatusId
 * @property int|null $GradeId
 * @property int $SessionId
 * @property int|null $ClassId
 * @property float $SubjectCredit
 * @property string $SubjectRegDate
 * @property float|null $CarryMark
 * @property float|null $MidTerm
 * @property float|null $FinalMark
 * @property string|null $TransferRemarks
 * @property int $ReferralStatus 0=No ,1=Yes
 * @property string $ReferralDate
 * @property string|null $DropWihrwDate
 * @property int $DropProcessId 0=Nothing ,1=Request and wating approvel,2=Reject ,3=Approve, 
 * @property float $DropPercent
 * @property string|null $DropRemarks
 * @property int|null $DropWihrwUserId
 * @property string $TransactionDate
 * @property string $TransactionUpdated
 * @property int|null $UserId
 * @property int|null $AssessmentGroupId
 * @property int|null $GradingSchemaId
 * @property string|null $Grade
 * @property float|null $Point
 * @property string|null $Description
 * @property int $ApprovalStatus
 * @property int|null $ApprovalId
 * @property string|null $ApprovalDate
 * @property int|null $ApprovedBy
 * @property string|null $CURRENT_STATUS
 * @property int|null $ExamStatusId
 * @property string|null $GRADING_SCHEME
 * @property string|null $SubjectCode
 * @property int|null $MarkOption 1 - Calculate ; 2 - Pass @ Fail
 * @property int|null $MajorIntakeId
 * @property float|null $SGPA
 * @property float|null $SCGPA
 * @property float|null $SCH
 * @property float|null $STCH
 * @property float|null $SGTCH
 * @property float|null $SAttendance
 * @property float|null $SP_GPA
 * @property float|null $SP_CGPA
 * @property float|null $SP_CH
 * @property float|null $SP_TCH
 * @property float|null $SP_GTCH
 * @property int|null $CurrentSem
 * @property string $PASS_FAIL
 * @property int|null $SubjYear
 * @property int|null $Transcript if 1 then show in transcript
 */
class Tblsubjectregister extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblsubjectregister';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['StudentId', 'IntakeRegId', 'ProgramRegId', 'SubjectId', 'SessionId', 'SubjectCredit', 'SubjectRegDate', 'ReferralStatus', 'ReferralDate'], 'required'],
            [['StudentId', 'IntakeRegId', 'ProgramRegId', 'SubjectId', 'SubjectRegStatusId', 'GradeId', 'SessionId', 'ClassId', 'ReferralStatus', 'DropProcessId', 'DropWihrwUserId', 'UserId', 'AssessmentGroupId', 'GradingSchemaId', 'ApprovalStatus', 'ApprovalId', 'ApprovedBy', 'ExamStatusId', 'MarkOption', 'MajorIntakeId', 'CurrentSem', 'SubjYear', 'Transcript'], 'integer'],
            [['SubjectCredit', 'CarryMark', 'MidTerm', 'FinalMark', 'DropPercent', 'Point', 'SGPA', 'SCGPA', 'SCH', 'STCH', 'SGTCH', 'SAttendance', 'SP_GPA', 'SP_CGPA', 'SP_CH', 'SP_TCH', 'SP_GTCH'], 'number'],
            [['SubjectRegDate', 'ReferralDate', 'DropWihrwDate', 'TransactionDate', 'TransactionUpdated', 'ApprovalDate'], 'safe'],
            [['TransferRemarks', 'DropRemarks', 'Description'], 'string', 'max' => 100],
            [['Grade', 'PASS_FAIL'], 'string', 'max' => 5],
            [['CURRENT_STATUS'], 'string', 'max' => 35],
            [['GRADING_SCHEME'], 'string', 'max' => 15],
            [['SubjectCode'], 'string', 'max' => 20],
            [['StudentId', 'IntakeRegId', 'ProgramRegId', 'SubjectId'], 'unique', 'targetAttribute' => ['StudentId', 'IntakeRegId', 'ProgramRegId', 'SubjectId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SubjectRegId' => Yii::t('app', 'Subject Reg ID'),
            'StudentId' => Yii::t('app', 'Student ID'),
            'IntakeRegId' => Yii::t('app', 'Intake Reg ID'),
            'ProgramRegId' => Yii::t('app', 'Program Reg ID'),
            'SubjectId' => Yii::t('app', 'Subject ID'),
            'SubjectRegStatusId' => Yii::t('app', 'Subject Reg Status ID'),
            'GradeId' => Yii::t('app', 'Grade ID'),
            'SessionId' => Yii::t('app', 'Session ID'),
            'ClassId' => Yii::t('app', 'Class ID'),
            'SubjectCredit' => Yii::t('app', 'Subject Credit'),
            'SubjectRegDate' => Yii::t('app', 'Subject Reg Date'),
            'CarryMark' => Yii::t('app', 'Carry Mark'),
            'MidTerm' => Yii::t('app', 'Mid Term'),
            'FinalMark' => Yii::t('app', 'Final Mark'),
            'TransferRemarks' => Yii::t('app', 'Transfer Remarks'),
            'ReferralStatus' => Yii::t('app', 'Referral Status'),
            'ReferralDate' => Yii::t('app', 'Referral Date'),
            'DropWihrwDate' => Yii::t('app', 'Drop Wihrw Date'),
            'DropProcessId' => Yii::t('app', 'Drop Process ID'),
            'DropPercent' => Yii::t('app', 'Drop Percent'),
            'DropRemarks' => Yii::t('app', 'Drop Remarks'),
            'DropWihrwUserId' => Yii::t('app', 'Drop Wihrw User ID'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
            'TransactionUpdated' => Yii::t('app', 'Transaction Updated'),
            'UserId' => Yii::t('app', 'User ID'),
            'AssessmentGroupId' => Yii::t('app', 'Assessment Group ID'),
            'GradingSchemaId' => Yii::t('app', 'Grading Schema ID'),
            'Grade' => Yii::t('app', 'Grade'),
            'Point' => Yii::t('app', 'Point'),
            'Description' => Yii::t('app', 'Description'),
            'ApprovalStatus' => Yii::t('app', 'Approval Status'),
            'ApprovalId' => Yii::t('app', 'Approval ID'),
            'ApprovalDate' => Yii::t('app', 'Approval Date'),
            'ApprovedBy' => Yii::t('app', 'Approved By'),
            'CURRENT_STATUS' => Yii::t('app', 'Current Status'),
            'ExamStatusId' => Yii::t('app', 'Exam Status ID'),
            'GRADING_SCHEME' => Yii::t('app', 'Grading Scheme'),
            'SubjectCode' => Yii::t('app', 'Subject Code'),
            'MarkOption' => Yii::t('app', 'Mark Option'),
            'MajorIntakeId' => Yii::t('app', 'Major Intake ID'),
            'SGPA' => Yii::t('app', 'Sgpa'),
            'SCGPA' => Yii::t('app', 'Scgpa'),
            'SCH' => Yii::t('app', 'Sch'),
            'STCH' => Yii::t('app', 'Stch'),
            'SGTCH' => Yii::t('app', 'Sgtch'),
            'SAttendance' => Yii::t('app', 'S Attendance'),
            'SP_GPA' => Yii::t('app', 'Sp Gpa'),
            'SP_CGPA' => Yii::t('app', 'Sp Cgpa'),
            'SP_CH' => Yii::t('app', 'Sp Ch'),
            'SP_TCH' => Yii::t('app', 'Sp Tch'),
            'SP_GTCH' => Yii::t('app', 'Sp Gtch'),
            'CurrentSem' => Yii::t('app', 'Current Sem'),
            'PASS_FAIL' => Yii::t('app', 'Pass Fail'),
            'SubjYear' => Yii::t('app', 'Subj Year'),
            'Transcript' => Yii::t('app', 'Transcript'),
        ];
    }

    
    
    public function getSubjectRegisterList()
    {
        $condition = '';

        //$data = explode(";", $param);
        

        $condition = "";
        
        $txtProgramRegId    = $_GET['txtProgramRegId'];
        // $txtDeptCatId   = $_GET['txtDeptCatId'];


        $stmt = " SELECT
        tblclass.ClassCode,
        tblsubjectregister.SubjectRegId,
        tblsubjectregister.StudentId,
        tblsubjectregister.IntakeRegId,
        tblsubjectregister.ProgramRegId,
        tblsubject.SubjectCode,
        tblsubject.SubjectName,
        tblintakeregister.SemesterNo,
        get_view_academiccalendar.MajorIntakeYrMo,
        tblsubjectregister.Grade,
        case when tblsubjectregister.SubjectRegStatusId <>1 then CONCAT(tblsubjectregstatus.SubjectRegStatusDesc,'<br>', tblsubjectregister.DropWihrwDate,'<br>',tbluser.ShortName) else SubjectRegStatusDesc end as SubjectRegStatusDesc,
        tblsubjectregister.SubjectCredit,
        tblsubjectregister.DropWihrwDate,
        tblsubjectregister.SubjectRegStatusId,
        DropWihrwUserId,
        tbluser.ShortName
        FROM
        tblsubjectregister
        INNER JOIN tblclass ON tblsubjectregister.ClassId = tblclass.ClassId
        INNER JOIN tblsubject ON tblsubjectregister.SubjectId = tblsubject.SubjectId
        INNER JOIN tblintakeregister ON tblsubjectregister.IntakeRegId = tblintakeregister.IntakeRegId AND tblintakeregister.ProgramRegId = tblsubjectregister.ProgramRegId AND tblintakeregister.StudentId = tblsubjectregister.StudentId
        INNER JOIN get_view_academiccalendar ON tblclass.AcadCalId = get_view_academiccalendar.AcadCalId
        INNER JOIN tblsubjectregstatus ON tblsubjectregister.SubjectRegStatusId = tblsubjectregstatus.SubjectRegStatusId
        LEFT Join tbluser on tbluser.UserId = tblsubjectregister.DropWihrwUserId
        where tblsubjectregister.ProgramRegId = $txtProgramRegId";

//45803

        // if (empty($txtSearch)) {
        //     $condition .= "datediff(CURRENT_DATE,tblprogramregister.DateRegister) <10 and ";
        // }


        // if (!empty($txtSearch)) {
        //     $condition .= "concat( tblstudent.StudentNo, tblstudent.StudNRICPassportNo, tblstudent.StudName) like '%$txtSearch%' and ";
        // }

        // if (!empty($txtStatusId)) {
        //     $condition .= "tbldepartment.StatusId = $txtStatusId and ";
        // }

        //  if (!empty($txtDeptCatId)) {
        //      $condition .= "  tbldepartment.DeptCatId  = $txtDeptCatId and ";
        //  }

        if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }

        // $stmt .= $condition . ' ORDER BY  SemesterNo';

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }
}
