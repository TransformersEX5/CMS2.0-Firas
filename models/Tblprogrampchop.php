<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblprogram".
 *
 * @property int $ProgramId
 * @property string $ProgramCode
 * @property string $ProgramName
 * @property string $ProgramCode2
 * @property string|null $ProgramName2
 * @property string $ProgramCode3
 * @property string $ProgramName3
 * @property int $FacultyId
 * @property int $SchoolId
 * @property int $ProgramType
 * @property int $ProgramFromId
 * @property int $ProgramStatus
 * @property string|null $ProgramContent
 * @property float $MinCreditHours
 * @property float $ActCreditHours
 * @property float $StudyDurationFT
 * @property float $StudyDurationPT
 * @property int $AcadCalTypeId link to academic calendars
 * @property int $NoOfSem
 * @property string|null $MQACode
 * @property string|null $MQAStatus
 * @property string|null $MQAExpDate
 * @property float $FullPaymentFT
 * @property float $FullPaymentPT
 * @property float $RepeatSubjFee for Repeat Fee PerSubject * Per Credit hours
 * @property float $CreditExamptionFee
 * @property float $TransferCreditFee
 * @property float|null $ReferralFee
 * @property float|null $AssesmentFee
 * @property string|null $Syllubes
 * @property string|null $ProgramFeeDoc
 * @property string $TransactionDate
 * @property string $TransactionUpdated
 * @property int|null $UserId
 * @property string|null $EMSProgramCode
 * @property string $ProgramDesc
 * @property string|null $MQRCode
 * @property string|null $MQRExpDate
 * @property int $ProgSubFieldId
 * @property int $LearningMethodId
 * @property int $NecDetailId
 * @property int $PracticalStatusId
 * @property int|null $ProgMajorId
 * @property int $HideId 1- Show; 2 - Hide
 * @property int $ReportGroup
 * @property string|null $Ifms_Code
 * @property string|null $Ifms_Desc
 * @property string|null $ExtensionDateFrom
 * @property string|null $ExtensionDateTo
 * @property string|null $StudenNewtIntakePermision
 * @property int|null $ProgramCategoryId
 * @property int|null $ViewResult 1=view; 0 =close
 * @property float|null $IELTS
 * @property int|null $ApplicationFee if 0=NoFee;1=yes
 * @property int|null $PCId
 * @property int|null $HOPId Head of program =userid
 */
class Tblprogrampchop extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblprogram';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['PCId', 'HOPId'], 'required'],
            [['FacultyId', 'SchoolId', 'ProgramType', 'ProgramFromId', 'ProgramStatus', 'AcadCalTypeId', 'NoOfSem', 'UserId', 'ProgSubFieldId', 'LearningMethodId', 'NecDetailId', 'PracticalStatusId', 'ProgMajorId', 'HideId', 'ReportGroup', 'ProgramCategoryId', 'ViewResult', 'ApplicationFee', 'PCId', 'HOPId'], 'integer'],
            [['ProgramContent'], 'string'],
            [['MinCreditHours', 'ActCreditHours', 'StudyDurationFT', 'StudyDurationPT', 'FullPaymentFT', 'FullPaymentPT', 'RepeatSubjFee', 'CreditExamptionFee', 'TransferCreditFee', 'ReferralFee', 'AssesmentFee', 'IELTS'], 'number'],
            [['MQAExpDate', 'TransactionDate', 'TransactionUpdated', 'MQRExpDate', 'ExtensionDateFrom', 'ExtensionDateTo'], 'safe'],
            [['ProgramCode', 'ProgramCode2', 'ProgramCode3'], 'string', 'max' => 25],
            [['ProgramName', 'ProgramName2', 'ProgramName3', 'ProgramDesc'], 'string', 'max' => 255],
            [['MQACode', 'MQAStatus', 'MQRCode', 'StudenNewtIntakePermision'], 'string', 'max' => 50],
            [['Syllubes', 'ProgramFeeDoc'], 'string', 'max' => 100],
            [['EMSProgramCode'], 'string', 'max' => 55],
            [['Ifms_Code'], 'string', 'max' => 15],
            [['Ifms_Desc'], 'string', 'max' => 150],
            [['ProgramCode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ProgramId' => 'Program ID',
            'ProgramCode' => 'Program Code',
            'ProgramName' => 'Program Name',
            'ProgramCode2' => 'Program Code2',
            'ProgramName2' => 'Program Name2',
            'ProgramCode3' => 'Program Code3',
            'ProgramName3' => 'Program Name3',
            'FacultyId' => 'Faculty ID',
            'SchoolId' => 'School ID',
            'ProgramType' => 'Program Type',
            'ProgramFromId' => 'Program From ID',
            'ProgramStatus' => 'Program Status',
            'ProgramContent' => 'Program Content',
            'MinCreditHours' => 'Min Credit Hours',
            'ActCreditHours' => 'Act Credit Hours',
            'StudyDurationFT' => 'Study Duration Ft',
            'StudyDurationPT' => 'Study Duration Pt',
            'AcadCalTypeId' => 'Acad Cal Type ID',
            'NoOfSem' => 'No Of Sem',
            'MQACode' => 'Mqa Code',
            'MQAStatus' => 'Mqa Status',
            'MQAExpDate' => 'Mqa Exp Date',
            'FullPaymentFT' => 'Full Payment Ft',
            'FullPaymentPT' => 'Full Payment Pt',
            'RepeatSubjFee' => 'Repeat Subj Fee',
            'CreditExamptionFee' => 'Credit Examption Fee',
            'TransferCreditFee' => 'Transfer Credit Fee',
            'ReferralFee' => 'Referral Fee',
            'AssesmentFee' => 'Assesment Fee',
            'Syllubes' => 'Syllubes',
            'ProgramFeeDoc' => 'Program Fee Doc',
            'TransactionDate' => 'Transaction Date',
            'TransactionUpdated' => 'Transaction Updated',
            'UserId' => 'User ID',
            'EMSProgramCode' => 'Ems Program Code',
            'ProgramDesc' => 'Program Desc',
            'MQRCode' => 'Mqr Code',
            'MQRExpDate' => 'Mqr Exp Date',
            'ProgSubFieldId' => 'Prog Sub Field ID',
            'LearningMethodId' => 'Learning Method ID',
            'NecDetailId' => 'Nec Detail ID',
            'PracticalStatusId' => 'Practical Status ID',
            'ProgMajorId' => 'Prog Major ID',
            'HideId' => 'Hide ID',
            'ReportGroup' => 'Report Group',
            'Ifms_Code' => 'Ifms Code',
            'Ifms_Desc' => 'Ifms Desc',
            'ExtensionDateFrom' => 'Extension Date From',
            'ExtensionDateTo' => 'Extension Date To',
            'StudenNewtIntakePermision' => 'Studen Newt Intake Permision',
            'ProgramCategoryId' => 'Program Category ID',
            'ViewResult' => 'View Result',
            'IELTS' => 'Ielts',
            'ApplicationFee' => 'Application Fee',
            'PCId' => 'Pc ID',
            'HOPId' => 'Hop ID',
        ];
    }


    public function getProgramlist()
    {
        $condition = '';

        //$data = explode(";", $param);

        $condition = "";
        $txtSearch = $_GET['txtSearch'];
        $txtStatusId = $_GET['txtStatusId'];
        $txtProgramTypeId = $_GET['txtProgramTypeId'];


        $stmt = " SELECT
        tblprogram.ProgramId,
        tblprogram.ProgramCode,
        tblprogram.ProgramName,
        tblprogram.ProgramCode2,
        tblprogram.ProgramName2,
     
        tblprogram.ProgramType,
        tblstatusai.Status
        FROM
        tblprogram
   
        
        INNER JOIN tblstatusai ON tblprogram.ProgramStatus = tblstatusai.StatusId
        
         ";

        if (!empty($txtSearch)) {
            $condition .= "concat(tblprogram.ProgramCode,tblprogram.ProgramName) like '%$txtSearch%' and ";
        }

        if (!empty($txtStatusId)) {
            $condition .= "tblstatusai.StatusId = $txtStatusId and ";
        }

        if (!empty($txtProgramTypeId)) {
            $condition .= "  tblprogram.ProgramType  = $txtProgramTypeId and ";
        }

        if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }

        $stmt .= $condition . ' ORDER BY tblprogram.ProgramCode ';

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }

    public function getProgramvspcvshop()
    {
        $txtSearch = $_GET['txtSearch'];
        $txtStatusId = $_GET['txtStatusId'];
        $txtProgramTypeId = $_GET['txtProgramTypeId'];

        if($txtSearch == '')
        {
            $txtSearch = '.*';
        }

        if ($txtStatusId == '') {
            $txtStatusId = '.*';
        }

        if ($txtProgramTypeId == '') {
            $txtProgramTypeId = '.*';
        }

        $stmt = "SELECT tblprogram.ProgramId, tblprogramtype.ProgramTypeName, tblprogram.ProgramCode, tblprogram.ProgramName, 
        tblprogram.ProgramCode2, tblprogram.ProgramName2, tblprogram.ProgramType, tblstatusai.Status, 
        COALESCE(HOPUser.FullName, 'NULL') AS HOPName, COALESCE(PCUser.FullName, 'NULL' ) AS PCName
        FROM
        tblprogram
        INNER JOIN tblprogramtype ON tblprogramtype.ProgramTypeId = tblprogram.ProgramType
		INNER JOIN tblstatusai ON tblprogram.ProgramStatus = tblstatusai.StatusId
        LEFT JOIN tbluser HOPUser ON HOPUser.UserId = tblprogram.HOPId
		LEFT JOIN tbluser PCUser ON PCUser.UserId = tblprogram.PCId
		WHERE (tblprogram.ProgramCode REGEXP '$txtSearch' OR tblprogram.ProgramName REGEXP '$txtSearch' OR HOPUser.FullName REGEXP '$txtSearch'
        OR PCUser.FullName REGEXP '$txtSearch') AND tblstatusai.StatusId REGEXP '$txtStatusId' 
        AND tblprogram.ProgramType REGEXP '$txtProgramTypeId'
		ORDER BY tblstatusai.StatusId ASC, tblprogram.ProgramCode ASC";

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }
}