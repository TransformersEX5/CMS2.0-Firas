<?php

namespace app\modules\programfeejb\models;

use Yii;

/**
 * This is the model class for table "tblprogramfeecategory".
 *
 * @property int $ProgFeeCatId
 * @property string $ProgFeeCatTitle
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
 * @property int $UserId
 * @property string $TransactionDate
 */
class Tblprogramfeecategory extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        return Yii::$app->dbcityjb; // Use the secondary database connection
    }

    
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
            [['ProgFeeCatTitle', 'SessionId', 'UserId',  'ResidencyId', 'ProgFeePackageId', 'TermTypeId', 'StatusId', 'ProgEdition', 'TotalPublishFee', 'TotalPromoFee', 'TotalSem', 'ProgramTypeId','FeeStructureId'], 'required'],
            [['ResidencyId', 'SessionId', 'ProgFeePackageId', 'TermTypeId', 'StatusId', 'UserId'], 'integer'],
            [['TotalPublishFee', 'TotalPromoFee', 'TotalSem'], 'number'],
            [['TransactionDate'], 'safe'],
            [['ProgFeeCatTitle', 'ProgFeeCatRemarks'], 'string', 'max' => 255],
            [['ProgFeeCode'], 'string', 'max' => 15],
            [['ProgEdition'], 'string', 'max' => 12],
            [['ProgFeeCatTitle'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ProgFeeCatId' => 'Prog Fee Cat ID',
            'ProgFeeCatTitle' => 'Prog Fee Cat Title',
            'ProgFeeCode' => 'Prog Fee Code',
            'ProgramTypeId' => 'For Program Type',
            'ProgEdition' => 'Prog Edition',
            'ProgFeeCatRemarks' => 'Prog Fee Cat Remarks',
            'ResidencyId' => 'Residency',
            'SessionId' => 'Session ',
            'ProgFeePackageId' => 'Prog Fee Package ',
            'TotalPublishFee' => 'Total Publish Fee',
            'TotalPromoFee' => 'Total Promo Fee',
            'TotalSem' => 'Total Sem',
            'TermTypeId' => 'Term Type ',
            'StatusId' => 'Status ',
            'UserId' => 'User ID',
            'TransactionDate' => 'Transaction Date',
        ];
    }




    public function get_combobox_programfeegroup()
    {

        $condition = "";

        $ProgramIntId = $_GET['ProgramIntId'];
        $ResidencyId = $_GET['ResidencyId'];
        $FeeStructureId = $_GET['FeeStructureId'];
        $ProgramTypeId = $_GET['ProgramTypeId'];

        $stmt = " SELECT
        tblprogramfeecategory.ProgFeeCatId,
        tblprogramfeecategory.ProgFeeCatTitle,
        tblprogramfeecategory.ProgramTypeId,
        tblprogramfeecategory.ProgFeeCode,
        concat(tblprogramfeecategory.ProgFeeCode,'->',tblprogramtype.ProgramTypeName,' & Promo Fee','->',tblprogramfeecategory.TotalPromoFee,'-> Tot Sem : ',tblprogramfeecategory.TotalSem) as ProgFeeCode2,
        tblprogramfeecategory.ProgEdition,
        tblprogramfeecategory.ProgFeeCatRemarks,
        tblprogramfeecategory.ResidencyId,
        tblprogramfeecategory.SessionId,
        tblprogramfeecategory.ProgFeePackageId,
        tblprogramfeecategory.TotalPublishFee,
        tblprogramfeecategory.TotalPromoFee,
        tblprogramfeecategory.TotalSem,
        tblprogramfeecategory.TermTypeId,
        tblprogramfeecategory.StatusId,
        tblprogramfeecategory.UserId,
        tblprogramfeecategory.TransactionDate
        from tblprogramfeecategory
        INNER JOIN tblprogramtype ON tblprogramfeecategory.ProgramTypeId = tblprogramtype.ProgramTypeId
        where tblprogramfeecategory.ProgramTypeId = $ProgramTypeId
        and  tblprogramfeecategory.ResidencyId =  $ResidencyId
        and  tblprogramfeecategory.StatusId=1
        and  tblprogramfeecategory.SessionId = 1  ";

        $data2 = \Yii::$app->dbcityjb->createCommand($stmt)->queryAll();


        return $data2;
    }




    public function getProgramIntake()
    {


        $condition = "";
        $txtprogramid = $_GET['txtprogramid'];
        $txtresidencyid = $_GET['txtresidencyid'];
        $txtfeestructureid = $_GET['txtfeestructureid'];



        $stmt = " SELECT
        tblprogrambatch.ProgramIntId,
        tblprogrambatch.ProgramId,
        tblprogrambatch.IntakeId,
        tblintake.IntakeYrMo,
        tblprogrambatch.StatusId,
        tblstatusai.`Status` AS QStatus,
        QQ.ProgFeeCatId,
        QQ.ProgramFeeId,
        concat(QQ.ProgFeeCode,'->',tblprogramtype.ProgramTypeName,' & Promo Fee','->',QQ.TotalPromoFee)as ProgFeeCode2,
        concat('Nizam','-',QQ.TransactionDate) as ShortName,
        -- concat(QQ.ShortName,'-',QQ.TransactionDate) as ShortName,
        
        tblprogramtype.ProgramTypeName
        FROM
        tblprogrambatch
        INNER JOIN tblintake ON tblintake.IntakeId = tblprogrambatch.IntakeId
        INNER JOIN tblstatusai ON tblprogrambatch.StatusId = tblstatusai.StatusId
        INNER JOIN tblprogram ON tblprogram.ProgramId = tblprogrambatch.ProgramId
        INNER JOIN tblprogramtype ON tblprogramtype.ProgramTypeId = tblprogram.ProgramType
        
        Left join (SELECT
        
        tblprogramfee.ProgramIntId,
        tblprogramfee.ProgramId,
        tblprogramfee.Residency,
        tblprogramfee.SessionId,
        tblprogramfee.FeeStructureId,
        tblprogramfee.ProgFeeCatId,
        tblprogramfee.ProgramFeeId,
        tblprogramfee.TransactionDate,
        tblprogramfeecategory.ProgFeeCode,tblprogramfeecategory.TotalPromoFee,
        tbluser.ShortName
        FROM
        tblprogramfee
        INNER JOIN tblprogramfeecategory ON tblprogramfee.ProgFeeCatId = tblprogramfeecategory.ProgFeeCatId
        INNER JOIN tbluser ON tblprogramfee.UserId = tbluser.UserId
        where tblprogramfee.Residency = $txtresidencyid and tblprogramfee.FeeStructureId = $txtfeestructureid
        ORDER BY tblprogramfee.ProgFeeCatId desc
        )QQ on QQ.ProgramIntId = tblprogrambatch.ProgramIntId
        
        
        WHERE tblprogrambatch.ProgramId = $txtprogramid
                and tblintake.IntakeYrMo >=202401 and  tblprogrambatch.StatusId = 1
        GROUP BY tblprogrambatch.ProgramIntId
        ORDER BY tblintake.IntakeYrMo     desc     ";

        $data2 = \Yii::$app->dbcityjb->createCommand($stmt)->queryAll();

        // var_dump( $data);
        // die();
        return  $data2;
    }



    public function getFeeStructure()
    {
        $txtresidency = $_GET['residency'];
        $txtprogramid = $_GET['programid'];

        // $condition = "";
        // $txtprogramid = $_GET['txtprogramid'];

    
        $stmt = " Select residency , programid,FeeStructureId,FeeStructureName,FeeStructureRemarks,StatusId, IntakeFeeId , COALESCE(IntakeFeeId2,0) as IntakeFeeId2 from (SELECT
        $txtresidency as residency ,
        $txtprogramid  as programid,
         tblfeestructure.FeeStructureId,
         tblfeestructure.FeeStructureName,
         tblfeestructure.FeeStructureRemarks,
         tblfeestructure.StatusId,
         CONCAT($txtprogramid ,$txtresidency,tblfeestructure.FeeStructureId) as IntakeFeeId
         from tblfeestructure 
         where tblfeestructure.StatusId = 1
 
            )QQ
            
            LEFT JOIN (SELECT
            CONCAT(tblprogramfee.ProgramId,tblprogramfee.Residency,tblprogramfee.FeeStructureId) as IntakeFeeId2
            from tblprogramfee
            where ProgramId = $txtprogramid and ProgFeeCatId >0
            and Residency = $txtresidency
            GROUP BY tblprogramfee.ProgramId,tblprogramfee.Residency,tblprogramfee.FeeStructureId)QFee
            on QFee.IntakeFeeId2= QQ.IntakeFeeId ";

        $data2 = \Yii::$app->dbcityjb->createCommand($stmt)->queryAll();

        // var_dump( $data);
        // die();
        return  $data2;
    }





    public function getProgramlist()
    {
        $condition = "";
        $txtSearchprogcode = $_GET['txtSearchprogcode'];

        $stmt = " SELECT
        tblprogram.ProgramId,
        tblprogram.ProgramType,
        tblprogram.programcode,
        tblprogram.programname,
        tblprogram.programname3,
        concat(tblprogram.programcode,'-->',tblprogram.programname3	)AS ProgCodeName,
      COALESCE(LocalFee) as localfee ,
    
    COALESCE(IntFee) as intfee 
    FROM
        tblprogram
    LEFT join (
    Select ProgramId , sum(LocalFee) as LocalFee, sum(IntFee) as IntFee  from (
    SELECT ProgramId,
    case when Residency = 1 and ProgFeeCatId >0 then 1 else 0  end as LocalFee ,
    case when Residency = 2 and ProgFeeCatId >0 then 1 else 0  end as IntFee 
    
    FROM tblprogramfee
    WHERE ProgFeeCatId >0 #and  ProgramId = 362 #and Residency = 2
    GROUP BY ProgramId , Residency
    )QQ GROUP BY ProgramId
    
    )QQQ on QQQ.ProgramId = tblprogram.ProgramId  ";

        $condition = "ProgramStatus = 1  and ";

        if (!empty($txtSearchprogcode)) {
            $condition .= " concat(tblprogram.programcode, tblprogram.programname)   like '%$txtSearchprogcode%' and ";
        }

        if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }

        $stmt .= $condition . ' ORDER BY tblprogram.programcode';

        $data = \Yii::$app->dbcityjb->createCommand($stmt)->queryAll();

        return $data;
    }


    public function getProgramfeecategorylist()
    {
        $condition = '';

        //$data = explode(";", $param);

        $condition = "";
        $txtSearch = $_GET['txtSearch'];
        $txtTermTypeId = $_GET['txtTermTypeId'];
        $txtStatusId = $_GET['txtStatusId'];
        $txtResidency = $_GET['txtResidency'];
        $txtProgramTypeId = $_GET['txtProgramTypeId'];





        $stmt = " SELECT
        tblprogramfeecategory.ProgFeeCatId,
        tblprogramfeecategory.ProgFeeCatTitle,
        tblprogramfeecategory.ProgFeePackageId,
        tblprogramfeecategory.ProgFeeCatRemarks,
        tblprogramfeecategory.ResidencyId,
        tblprogramfeecategory.SessionId,
        tblprogramfeecategory.StatusId,
        tblprogramfeecategory.TotalPromoFee,
        tblprogramfeecategory.TotalPublishFee,
        tblprogramfeecategory.TotalSem,
        tblprogramfeecategory.UserId,
        tblprogramfeecategory.TransactionDate,
        tblprogramfeecategory.ProgFeeCode,
        tblprogramfeecategory.ProgEdition,
        tblprogfeepackage.ProgFeePackage,
        tblstatusai.`Status`,
        tbluser.FullName,
        tblresidency.Residency,
        tbltermtype.TermType,
        tblprogramfeecategory.ProgramTypeId,
        tblprogramtype.ProgramTypeName
        FROM
        tblprogramfeecategory
        INNER JOIN tblresidency ON tblprogramfeecategory.ResidencyId = tblresidency.ResidencyId
        INNER JOIN tblprogfeepackage ON tblprogramfeecategory.ProgFeePackageId = tblprogfeepackage.ProgFeePackageId
        INNER JOIN tblstatusai ON tblstatusai.StatusId = tblprogramfeecategory.StatusId
        INNER JOIN tbluser ON tblprogramfeecategory.UserId = tbluser.UserId
        INNER JOIN tbltermtype ON tblprogramfeecategory.TermTypeId = tbltermtype.TermTypeId
        INNER JOIN tblprogramtype ON tblprogramfeecategory.ProgramTypeId = tblprogramtype.ProgramTypeId  ";



        // $condition = "ProgramStatus = 1  and ";

        if (!empty($txtSearch)) {

            $condition .= " concat(CONVERT( tblresidency.Residency USING utf8) ,tblprogramfeecategory.ProgFeeCode, tblprogramfeecategory.ProgEdition  , CONVERT( tblprogramtype.ProgramTypeName USING utf8) )   like '%$txtSearch%' and ";
            //$condition .= "concat( tblprogramfeecategory.ProgFeeCatTitle , CONVERT(tblprogramfeecategory.TotalPublishFee USING utf8))  like '%$txtSearch%' and ";
            // $condition .= "concat(QProgFee.ProgFeeCatTitle,tblprogramtype.ProgramTypeName,QProgFee.IntakeStart,QProgFee.FeeStructureName, CONVERT(tblprogram.ProgramCode USING utf8)) like '%$txtSearch%' and ";
        }



        if (!empty($txtProgramTypeId)) {
            $condition .= " tblprogramfeecategory.ProgramTypeId = $txtProgramTypeId and ";
        }

        if (!empty($txtResidency)) {
            $condition .= " tblresidency.ResidencyId = $txtResidency and ";
        }


        if (!empty($txtStatusId)) {
            $condition .= " tblprogramfeecategory.StatusId = $txtStatusId and ";
        }


        if (!empty($txtTermTypeId)) {
            $condition .= " tblprogramfeecategory.TermTypeId = $txtTermTypeId and ";
        }





        if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }

        $stmt .= $condition . ' ORDER BY tblprogramfeecategory.ProgFeeCatId desc';

        $data = \Yii::$app->dbcityjb->createCommand($stmt)->queryAll();

        return $data;
    }




    public function getProgramfeecategorylisthistory()
    {
        $condition = '';

        //$data = explode(";", $param);

        $condition = "";
        $ProgFeeCatId = $_GET['ProgFeeCatId'];

        $stmt = "  SELECT
        tblprogramfeecategorystatus.ProgFeeCatStatusId,
        tblprogramfeecategorystatus.ProgFeeCatId,
        tblprogramfeecategorystatus.ApprovalStatusId,
        tblprogramfeecategorystatus.CurrentStatusId,
        tblprogramfeecategorystatus.ProgFeeCatRemarks,
        tblprogramfeecategorystatus.UserId,
        tblprogramfeecategorystatus.TransactionDate,
        tblapprovalstatus.ApprovalStatus,
        tblprogramfeecategory.ProgFeeCatTitle,
        tbluser.FullName
        FROM
        tblprogramfeecategorystatus
        INNER JOIN tblapprovalstatus ON tblprogramfeecategorystatus.ApprovalStatusId = tblapprovalstatus.ApprovalStatusId
        INNER JOIN tblprogramfeecategory ON tblprogramfeecategory.ProgFeeCatId = tblprogramfeecategorystatus.ProgFeeCatId
        INNER JOIN tbluser ON tblprogramfeecategorystatus.UserId = tbluser.UserId  ";



        if (empty($ProgFeeCatId)) {
            $condition .= " tblprogramfeecategorystatus.ProgFeeCatId = 0 and ";
        }

        if (!empty($ProgFeeCatId)) {
            $condition .= " tblprogramfeecategorystatus.ProgFeeCatId = $ProgFeeCatId and ";
        }

        if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }

        $stmt .= $condition . ' ORDER BY tblprogramfeecategorystatus.TransactionDate desc ';

        $data = \Yii::$app->dbcityjb->createCommand($stmt)->queryAll();

        return $data;
    }
}
