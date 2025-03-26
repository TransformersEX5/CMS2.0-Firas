<?php

namespace app\models;

use Yii;
use yii\web\Response;

/**
 * This is the model class for table "tbldebtstudent".
 *
 * @property int $DebtStudId
 * @property int|null $ProgramRegId
 * @property int|null $DebtGroupId
 * @property string $Remarks
 * @property string|null $TransactionDate
 * @property int|null $UserId
 */
class Tbldebtstudent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbldebtstudent';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ProgramRegId', 'DebtGroupId', 'UserId'], 'integer'],
            //   [['Remarks'], 'required'],
            [['TransactionDate'], 'safe'],
            [['Remarks'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'DebtStudId' => Yii::t('app', 'Debt Stud ID'),
            'ProgramRegId' => Yii::t('app', 'Program Reg ID'),
            'DebtGroupId' => Yii::t('app', 'Debt Group ID'),
            'Remarks' => Yii::t('app', 'Remarks'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
            'UserId' => Yii::t('app', 'User ID'),
        ];
    }



    public function getCreditControlList()
    {
        $condition = '';
        $limit = '';
        $UserId         = Yii::$app->user->identity->UserId;
        $txtSearch      = $_GET['txtSearch'];
        $txtStatusId    = $_GET['txtStatusId'];
        $txttemp1       = $_GET['txttemp1'];
        $txttemp2       = $_GET['txttemp2'];
        $txttemp3       = $_GET['txttemp3'];
        $txttemp4       = $_GET['txttemp4'];
        


        $stmt = " SELECT
        tblstudent.StudName,
        tblprogramregister.ProgramRegId,
        tblstudent.StudNRICPassportNo,
        tblstudent.StudentId,
        tblstudent.StudCorrAddress1,
        tblstudent.StudCorrAddress2,
        tblstudent.StudCorrCity,
        tblstudent.StudCorrPostCode,
        tblstudent.StudCorrStateId,
        tblstate.StateName,
        tblnationality.NationalityName,
        tblstudent.StudGender,
        tblgender.GenderName,
        tblstudent.StudentNo,
        tblstudent.StudEmail,
        tblstudent.StudCorrPhoneNo,
        tblstudent.StudMobileNo,
        tblstudent.StudGuardHomePhoneNo,
        tblstudent.StudEmergHomePhoneNo,
        tblstudent.StudEmergHandPhone,
        tblstudent.StudEmergOfficePhone,
        tblprogram.ProgramCode,
        tblprogram.ProgramName,
        tblprogramtype.ProgramTypeName,
        tblprogramregister.DateRegister,
        tbluser.FullName,
        tbluser.EmailAddress,
        tbluser.HandSetNo,
        tblstatusai.`Status` AS MarketingStaffStatus,
        get_studentregisterstatus.StatusName,
        round(tblprogramregister.AcademicOuts,2) AS AcademicOuts,
        tblprogramregister.AcademicOutsPrevSem,
        tblprogramregister.AssesmentOuts,
        tblprogramregister.HostelOuts,
        tblprogramregister.AcademicAging,
        tblprogramregister.HostelAging,
        tblprogramregister.UtilitiesAging,
        tblprogramregister.UtilitiesOuts,
        getmarketingstaff.MarketingTeam,
         tbldebtstudent.DebtStudId,    
         tbldebtstudent.Remarks,    
         get_studentregisterstatus.StatusName, 
         COALESCE(QQGroup.UserId,0) as OwnerId,
         COALESCE(QQGroup.DebtGroupId,0) as DebtGroupId,
         QQGroup.DebtGroupName,QQGroup.ShortName,
        QFund.StudSponsorship ,
        QLastPaid.LastPaidDate ,
        QLastPaid.LastPaidAmount
        FROM
        tblprogramregister
        INNER JOIN tblstudent ON tblprogramregister.StudentId = tblstudent.StudentId      
        INNER JOIN tblnationality ON tblnationality.NationalityId = tblstudent.StudNationalityId
        INNER JOIN tblgender ON tblstudent.StudGender = tblgender.GenderId
        INNER JOIN tblprogram ON tblprogramregister.ProgramId = tblprogram.ProgramId
        INNER JOIN tblprogramtype ON tblprogramtype.ProgramTypeId = tblprogram.ProgramType
        INNER JOIN tbluser ON tbluser.UserId = tblprogramregister.MarketingId
        INNER JOIN tblstatusai ON tbluser.StatusId = tblstatusai.StatusId
        INNER JOIN get_studentregisterstatus ON tblprogramregister.ProgramRegId = get_studentregisterstatus.ProgramRegId
		LEFT JOIN tblstate ON tblstudent.StudCorrStateId = tblstate.StateId
        LEFT JOIN tbldebtstudent ON tbldebtstudent.ProgramRegId = tblprogramregister.ProgramRegId
        LEFT JOIN tbldebtgroup ON tbldebtstudent.DebtGroupId = tbldebtgroup.DebtGroupId
        LEFT JOIN tbluser AS tbluser2 ON tbluser2.UserId = tbldebtstudent.UserId
        LEFT JOIN (SELECT
        tbldebtstudent.DebtStudId,
        tbldebtstudent.ProgramRegId,
        tbldebtstudent.DebtGroupId,
        tbldebtstudent.Remarks,
        tbldebtstudent.TransactionDate,
        tbldebtstudent.UserId,
        tbluser.ShortName,
        case when  COALESCE(tbldebtstudent.DebtGroupId,0) >0 then  concat(tbldebtgroup.DebtGroupName ,'-',tbluser.ShortName) 
        when  COALESCE(tbldebtstudent.DebtGroupId,0) =0 then  tbluser.ShortName end as  DebtGroupName
        FROM
        tbldebtstudent
        INNER JOIN tbldebtgroup ON tbldebtstudent.DebtGroupId = tbldebtgroup.DebtGroupId
        INNER JOIN tbluser ON tbldebtgroup.UserId = tbluser.UserId
        ) QQGroup on QQGroup.ProgramRegId = tblprogramregister.ProgramRegId
        LEFT JOIN getmarketingstaff ON tbluser.UserId = getmarketingstaff.UserId

        LEFT JOIN (SELECT
        get_studentsponsor.ProgramRegId,
        CONCAT(get_studentsponsor.fundname,'-',get_studentsponsor.SponsorStatusDesc) as StudSponsorship,
        get_studentsponsor.fundid,
        get_studentsponsor.SponsorStatusId,
        get_studentsponsor.SponsorStatusDesc,
        get_studentsponsor.SponsorAmount
        from get_studentsponsor
        ) QFund on QFund.ProgramRegId = tblprogramregister.ProgramRegId 
        
        LEFT JOIN (SELECT
tbl_payment.ProgramRegId,
max(tbl_payment.paymentdate) as LastPaidDate,
tbl_payment.amountpaid  as LastPaidAmount

from tbl_payment
where tbl_payment.paymentstatusid = 0
GROUP BY tbl_payment.ProgramRegId
ORDER BY paymentid DESC

        ) QLastPaid on QLastPaid.ProgramRegId = tblprogramregister.ProgramRegId ";

        $condition .= "get_studentregisterstatus.StatusId not in (2,29,27) and ";


        if (!empty($txtSearch)) {
            $condition .= "concat( tblstudent.StudentNo, tblstudent.StudNRICPassportNo, tblstudent.StudName) like '%$txtSearch%' and ";
        }


        if (!empty($txttemp1)) {
            $condition .= " tblprogramregister.AcademicOuts>0 and tblprogramregister.AcademicAging >= $txttemp1  and  tblprogramregister.AcademicAging  <= $txttemp2 and ";
        }


        if (!empty($txttemp3)) {
            $condition .= " COALESCE(tbldebtstudent.DebtGroupId,0) = $txttemp3 and ";
        }

        if (!empty($txttemp4)) {
            $condition .= " tblprogramregister.ProgramRegId in( Select tbldebtoraction.programRegId from tbldebtoraction where tbldebtoraction.UserId = $UserId and CurrentStatusId = 1 and tbldebtoraction.DebtActionCatId = 1 ) and ";
        }


        if (!empty($txtStatusId)) {
            $condition .= "get_studentregisterstatus.StatusId = $txtStatusId and ";
        }

        if (empty($txtSearch) && empty($txttemp1) && empty($txtStatusId)) {
            $limit .= " ORDER BY tblstudent.StudName limit 10 ";
        } else {
            $limit .= " ORDER BY tblstudent.StudName ";
        }


        if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }

        $stmt .= $condition . $limit;


        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }






    public function getCreditControlList_ori()
    {
        $condition = '';
        $limit = '';
        $UserId         = Yii::$app->user->identity->UserId;
        $txtSearch      = $_GET['txtSearch'];
        $txtStatusId    = $_GET['txtStatusId'];
        $txttemp1       = $_GET['txttemp1'];
        $txttemp2       = $_GET['txttemp2'];
        $txttemp3       = $_GET['txttemp3'];


        $stmt = " SELECT
        tblstudent.StudentNo,
        tblstudent.StudNRICPassportNo,
        tblstudent.StudName,
        get_studentregisterstatus.StatusName,
        FORMAT(tblprogramregister.AcademicOuts,2) as AcademicOuts,
        tblprogramregister.AcademicOutsPrevSem,
        tblprogramregister.AssesmentOuts,
        tblprogramregister.HostelOuts,
        tblprogram.ProgramCode,
        tblprogram.ProgramName,
        tblprogramtype.ProgramTypeName,
        tblprogramregister.AcademicAging,
        tblprogramregister.HostelAging,
        tblprogramregister.ProgramRegId,
        tbldebtstudent.DebtStudId,        
        COALESCE(tbldebtstudent.UserId,0) as OwnerId,
        COALESCE(tbldebtstudent.DebtGroupId,0) as DebtGroupId,
        case when  COALESCE(tbldebtstudent.DebtGroupId,0) >0 then  concat(tbldebtgroup.DebtGroupName ,'-',tbluser.ShortName) 
             when  COALESCE(tbldebtstudent.DebtGroupId,0) =0 then  tbluser.ShortName end as  DebtGroupName
        FROM
        tblstudent
        INNER JOIN tblprogramregister ON tblstudent.StudentId = tblprogramregister.StudentId
        INNER JOIN get_studentregisterstatus ON tblprogramregister.ProgramRegId = get_studentregisterstatus.ProgramRegId
        INNER JOIN tblprogram ON tblprogramregister.ProgramId = tblprogram.ProgramId
        INNER JOIN tblprogramtype ON tblprogram.ProgramType = tblprogramtype.ProgramTypeId
        LEFT JOIN tbldebtstudent on tbldebtstudent.ProgramRegId = tblprogramregister.ProgramRegId
        LEFT JOIN tbldebtgroup ON tbldebtstudent.DebtGroupId = tbldebtgroup.DebtGroupId
		LEFT JOIN tbluser on tbluser.UserId = tbldebtstudent.UserId ";



        $condition .= "get_studentregisterstatus.StatusId not in (2,29,27) and ";


        if (!empty($txtSearch)) {
            $condition .= "concat( tblstudent.StudentNo, tblstudent.StudNRICPassportNo, tblstudent.StudName) like '%$txtSearch%' and ";
        }


        if (!empty($txttemp1)) {
            $condition .= " tblprogramregister.AcademicAging >= $txttemp1  and  tblprogramregister.AcademicAging  <= $txttemp2 and ";
        }


        if (!empty($txttemp3)) {
            $condition .= " COALESCE(tbldebtstudent.DebtGroupId,0) = $txttemp3 and ";
        }


        if (!empty($txtStatusId)) {
            $condition .= "get_studentregisterstatus.StatusId = $txtStatusId and ";
        }

        if (empty($txtSearch) && empty($txttemp1)) {
            $limit .= " ORDER BY tblstudent.StudName limit 10 ";
        } else {
            $limit .= " ORDER BY tblstudent.StudName ";
        }


        if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }

        $stmt .= $condition . $limit;




        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }
}
