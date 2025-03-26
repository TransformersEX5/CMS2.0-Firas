<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblprogramfeecategory".
 *
 * @property int $ProgFeeCatId
 * @property string $ProgFeeCatTitle
 * @property int|null $ProgramTypeId
 * @property string|null $ProgFeeCode
 * @property string|null $ProgEdition
 * @property string|null $ProgFeeCatRemarks
 * @property int $ResidencyId
 * @property int $SessionId
 * @property int|null $ProgFeePackageId
 * @property float $TotalPublishFee
 * @property float|null $TotalPromoFee
 * @property float $TotalSem
 * @property int|null $TermTypeId
 * @property int $StatusId
 * @property int|null $FeeStructureId
 * @property int $UserId
 * @property string $TransactionDate
 * @property string|null $ProgramCode
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
            [['ProgFeeCatTitle', 'SessionId', 'UserId'], 'required'],
            [['ProgramTypeId', 'ResidencyId', 'SessionId', 'ProgFeePackageId', 'TermTypeId', 'StatusId', 'FeeStructureId', 'UserId'], 'integer'],
            [['TotalPublishFee', 'TotalPromoFee', 'TotalSem'], 'number'],
            [['TransactionDate'], 'safe'],
            [['ProgFeeCatTitle', 'ProgFeeCatRemarks'], 'string', 'max' => 255],
            [['ProgFeeCode'], 'string', 'max' => 15],
            [['ProgEdition'], 'string', 'max' => 12],
            [['ProgramCode'], 'string', 'max' => 100],
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
            'ProgramTypeId' => Yii::t('app', 'Program Type ID'),
            'ProgFeeCode' => Yii::t('app', 'Prog Fee Code'),
            'ProgEdition' => Yii::t('app', 'Prog Edition'),
            'ProgFeeCatRemarks' => Yii::t('app', 'Prog Fee Cat Remarks'),
            'ResidencyId' => Yii::t('app', 'Residency ID'),
            'SessionId' => Yii::t('app', 'Session ID'),
            'ProgFeePackageId' => Yii::t('app', 'Prog Fee Package ID'),
            'TotalPublishFee' => Yii::t('app', 'Total Publish Fee'),
            'TotalPromoFee' => Yii::t('app', 'Total Promo Fee'),
            'TotalSem' => Yii::t('app', 'Total Sem'),
            'TermTypeId' => Yii::t('app', 'Term Type ID'),
            'StatusId' => Yii::t('app', 'Status ID'),
            'FeeStructureId' => Yii::t('app', 'Fee Structure ID'),
            'UserId' => Yii::t('app', 'User ID'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
            'ProgramCode' => Yii::t('app', 'Program Code'),
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
        tblprogram.ProgramId,
        tblprogram.ProgramCode,
        tblprogram.ProgramName,
        tblprogramtype.ProgramTypeName,
        QProgFee.ProgFeeCatId,
        QProgFee.FeeStructureName,
        QProgFee.ProgFeeCatTitle,
        QProgFee.ProgFeeCatCode,
        QProgFee.ProgFeeCatRemarks,
        QProgFee.ProgramTypeId,
        QProgFee.FeeStructurerId,
        QProgFee.ResidencyId,
        QProgFee.Residency,
        QProgFee.SessionId,
        QProgFee.StatusId,
        QProgFee.IntakeStart,
        QProgFee.IntakeEnd,
        QProgFee.TotalFee,
        QProgFee.TotalSem,
        tblprogramtype.ProgramTypeId
        
        
        FROM
        tblprogram
        LEFT JOIN (SELECT
        tblprogramfeecategory.ProgFeeCatId,
        tblprogramfeecategory.ProgramId,
        tblfeestructure.FeeStructureName,
        tblresidency.Residency,
        tblprogramfeecategory.ProgFeeCatTitle,
        tblprogramfeecategory.ProgFeeCatCode,
        tblprogramfeecategory.ProgFeeCatRemarks,
        tblprogramfeecategory.ProgramTypeId,
        tblprogramfeecategory.FeeStructurerId,
        tblprogramfeecategory.ResidencyId,
        tblprogramfeecategory.SessionId,
        tblprogramfeecategory.StatusId,
        tblprogramfeecategory.IntakeStart,
        
        tblprogramfeecategory.IntakeEnd,
        tblprogramfeecategory.TotalFee,
        tblprogramfeecategory.TotalSem,
        tblprogramfeecategory.UserId,
        tblprogramfeecategory.TransactionDate
        from tblprogramfeecategory
        INNER JOIN tblfeestructure ON tblprogramfeecategory.FeeStructurerId = tblfeestructure.FeeStructureId
        INNER JOIN tblresidency ON tblprogramfeecategory.ResidencyId = tblresidency.ResidencyId
        
        ) AS QProgFee ON QProgFee.ProgramId= tblprogram.ProgramId
        INNER JOIN tblprogramtype ON tblprogram.ProgramType = tblprogramtype.ProgramTypeId  ";



        $condition = "ProgramStatus = 1  and ";

        if (!empty($txtSearch)) {
            $condition .= "concat(QProgFee.ProgFeeCatTitle,tblprogramtype.ProgramTypeName,QProgFee.IntakeStart,QProgFee.FeeStructureName, tblprogram.ProgramCode) like '%$txtSearch%' and ";
        }


        if (!empty($txtProgramTypeId)) {
            $condition .= "  tblprogramtype.ProgramTypeId  = $txtProgramTypeId and ";
        }


        if (!empty($txtResidency)) {
            $condition .= " QProgFee.ResidencyId = $txtResidency and ";
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





    public function getProgramfeecategorylist_OLD()
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
