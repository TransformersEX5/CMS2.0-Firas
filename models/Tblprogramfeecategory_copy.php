<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblprogramfeecategory".
 *
 * @property int $ProgFeeCatId
 * @property string $ProgFeeCatTitle
 * @property string|null $ProgFeeCatCode Short Title -Show for User
 * @property string|null $ProgFeeCatRemarks
 * @property int $ProgramTypeId
 * @property int $FeeStructurerId
 * @property int $ResidencyId
 * @property int $SessionId
 * @property int $StatusId
 * @property int $IntakeStart
 * @property int $IntakeEnd
 * @property float $TotalFee
 * @property float $TotalSem
 * @property int $UserId
 * @property string $TransactionDate
 */
class Tblprogramfeecategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblprogramfeecategory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ProgFeeCatTitle', 'ProgramTypeId', 'FeeStructurerId', 'SessionId', 'IntakeStart', 'IntakeEnd','ResidencyId', 'TotalFee', 'TotalSem','UserId'], 'required'],
            [['ProgramTypeId', 'FeeStructurerId', 'ResidencyId', 'SessionId', 'StatusId', 'IntakeStart', 'IntakeEnd', 'UserId'], 'integer'],
            [['TotalFee', 'TotalSem'], 'number'],
            [['TransactionDate'], 'safe'],
            [['ProgFeeCatTitle', 'ProgFeeCatRemarks'], 'string', 'max' => 255],
            [['ProgFeeCatCode'], 'string', 'max' => 100],
            [['ProgFeeCatTitle'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ProgFeeCatId' => Yii::t('app', 'Prog Fee Cat ID'),
            'ProgFeeCatTitle' => Yii::t('app', 'Prog Fee Cat Title'),
            'ProgFeeCatCode' => Yii::t('app', 'Prog Fee Cat Code'),
            'ProgFeeCatRemarks' => Yii::t('app', 'Prog Fee Cat Remarks'),
            'ProgramTypeId' => Yii::t('app', 'Program Type'),
            'FeeStructurerId' => Yii::t('app', 'Fee Structurer'),
            'ResidencyId' => Yii::t('app', 'Residency'),
            'SessionId' => Yii::t('app', 'Session'),
            'StatusId' => Yii::t('app', 'Status'),
            'IntakeStart' => Yii::t('app', 'Intake Start'),
            'IntakeEnd' => Yii::t('app', 'Intake End'),
            'TotalFee' => Yii::t('app', 'Total Fee (RM)'),
            'TotalSem' => Yii::t('app', 'Total Sem'),
            'UserId' => Yii::t('app', 'User ID'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
        ];
    }

    
    
    public function getProgramfeecategorylist()
    {
        $condition = '';

        //$data = explode(";", $param);

        $condition = "";
        $txtSearch = $_GET['txtSearch'];
        $txtFeeStructure = $_GET['txtFeeStructure'];
        $txtProgramTypeId = $_GET['txtProgramTypeId'];
        $txtResidency = $_GET['txtResidency'];

        


        $stmt = " SELECT
        tblprogramfeecategory.ProgFeeCatId,
        tblprogramfeecategory.ProgFeeCatTitle,
        tblprogramtype.ProgramTypeName,
        tblfeestructure.FeeStructureName,
        tblprogramfeecategory.SessionId,
        tblprogramfeecategory.IntakeStart,
        tblprogramfeecategory.IntakeEnd,
        tblprogramfeecategory.StatusId,
        tblresidency.Residency,
        Concat(tblprogramfeecategory.IntakeStart,'-',tblprogramfeecategory.IntakeEnd) AS QIntake,
        QProgFeeStatus.ApprovalStatus
        FROM
        tblprogramfeecategory
        INNER JOIN tblprogramtype ON tblprogramfeecategory.ProgramTypeId = tblprogramtype.ProgramTypeId
        INNER JOIN tblfeestructure ON tblprogramfeecategory.FeeStructurerId = tblfeestructure.FeeStructureId
        INNER JOIN tblresidency ON tblprogramfeecategory.ResidencyId = tblresidency.ResidencyId
        LEFT JOIN (SELECT
        tblprogramfeecategorystatus.ProgFeeCatStatusId,
        tblprogramfeecategorystatus.ProgFeeCatId,
        tblprogramfeecategorystatus.ApprovalStatusId,
        tblprogramfeecategorystatus.CurrentStatusId,
        tblprogramfeecategorystatus.ProgFeeCatRemarks,
        tblapprovalstatus.ApprovalStatus
        FROM
        tblprogramfeecategorystatus
        INNER JOIN tblapprovalstatus ON tblprogramfeecategorystatus.ApprovalStatusId = tblapprovalstatus.ApprovalStatusId
        where tblprogramfeecategorystatus.CurrentStatusId = 1 )QProgFeeStatus on QProgFeeStatus.ProgFeeCatId = tblprogramfeecategory.ProgFeeCatId";

        if (!empty($txtSearch)) {
            $condition .= "concat(tblprogramfeecategory.ProgFeeCatTitle,tblprogramtype.ProgramTypeName,tblprogramfeecategory.IntakeStart,tblfeestructure.FeeStructureName) like '%$txtSearch%' and ";
        }


        if (!empty($txtProgramTypeId)) {
            $condition .= "  tblprogramtype.ProgramTypeId  = $txtProgramTypeId and ";
        }


        if (!empty($txtResidency)) {
            $condition .= " tblprogramfeecategory.ResidencyId = $txtResidency and ";
        }

        if (!empty($txtProgramTypeId)) {
            $condition .= "  tblprogramtype.ProgramTypeId  = $txtProgramTypeId and ";
        }

        if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }

        $stmt .= $condition . ' ORDER BY tblprogramtype.ProgramTypeName ';

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }


   



}
