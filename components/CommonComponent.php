<?php


namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;


class CommonComponent extends Component
{

    public function getApplicationNo()
    {

        $result = Yii::$app->db->createCommand(' 
        Select 
          Case when COALESCE(CurrStudentNo,0) = 0 then CONCAT("AP-",DATE_FORMAT(CURRENT_DATE,"%Y%m"),"-00001")  
            when COALESCE(CurrStudentNo,0) >0 then CONCAT(LeftNo,CurrStudentNo ) end as NewAppNo
            from (Select  left(AppNo ,10) as LeftNo, LPAD(MAX(right( AppNo,5))+1,5,0) AS CurrStudentNo  
			FROM tblapplication
			where right( left( AppNo , 9 ) , 6 ) = DATE_FORMAT(CURRENT_DATE,"%Y%m") 
            )QQ')

            ->queryAll();

        return $result;
    }



    public function getAuthRole2($UserId)
    {

        $TypeAuth = Yii::$app->db->createCommand(' 
        SELECT auth_item.`name` as item_name , auth_item.type
        from auth_item where auth_item.type = 1  
        and  auth_item.`name` not in (SELECT
        auth_assignment.item_name
        from auth_assignment
        where user_id =:id )')
            ->bindValue(':id', $UserId)
            ->queryAll();

        $result = ArrayHelper::map($TypeAuth, 'item_name', 'item_name');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }


    public function getAuthRole()
    {

        $TypeAuth = Yii::$app->db->createCommand(' 
        SELECT auth_item.`name` as parent, auth_item.type
        from auth_item where auth_item.type = 1
        ORDER BY auth_item.`name` ')

            ->queryAll();

        $result = ArrayHelper::map($TypeAuth, 'parent', 'parent');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }



    public function getAuthPermission()
    {

        $TypeAuth = Yii::$app->db->createCommand(' 
        SELECT auth_item.`name` as child, auth_item.type
        from auth_item where auth_item.type = 2
        ORDER BY auth_item.`name` ')

            ->queryAll();

        $result = ArrayHelper::map($TypeAuth, 'child', 'child');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }










    public function getAuthTypeList()
    {

        $TypeAuth = Yii::$app->db->createCommand(' 
        SELECT auth_item_type.auth_item_typeid,
        auth_item_type.auth_item_desc from auth_item_type ')

            ->queryAll();

        $result = ArrayHelper::map($TypeAuth, 'auth_item_typeid', 'auth_item_desc');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }





    public function getFeeTypeForSetupList()
    {

        $TypeAuth = Yii::$app->db->createCommand(' SELECT
        tbl_feetype.feetypeid,
        tbl_feetype.feetypename,
        tbl_feetype.feetypecode,
        tbl_feetype.feecatid,
        tbl_feetype.feetypestatus,
        tbl_feetype.ledgerstatus,
        tbl_feetype.feetrans,
        tbl_feetype.paytrans,
        tbl_feetype.gstrate,
        tbl_feetype.gsttype,
        tbl_feetype.BilNo
        from tbl_feetype
        where feetypeid in (1,2,36,76,26,28,55,84,8,77,81)
        order by feetypename
        ')

            ->queryAll();

        $result = ArrayHelper::map($TypeAuth, 'feetypeid', 'feetypename');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }


    public function getBranchName()
    {

        $subject = Yii::$app->db->createCommand('
    SELECT
    tblbranch.BranchId,
    tblbranch.CollegeCode,
    tblbranch.CollegeName,
    tblbranch.BranchName,
    tblbranch.DomainName,
    tblbranch.Address1,
    tblbranch.Address2,
    tblbranch.CityName,
    tblbranch.PostCode,
    tblbranch.StateId,
    tblbranch.CountryId,
    tblbranch.BranchNameForLOA,
    tblbranch.PhoneNo,
    tblbranch.FaxNo,
    tblbranch.Email,
    tblbranch.LogoUrl,
    tblbranch.StatusId,
    tblbranch.BranchRemarks,
    tblbranch.SystemAdmin,
    tblbranch.CurrentCenter,
    tblbranch.TransactionDate,
    tblbranch.UserId
    from tblbranch where tblbranch.StatusId = 1 Order by  tblbranch.BranchName ')

            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'BranchId', 'BranchName');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }





    public function getRoomType()
    {

        $subject = Yii::$app->db->createCommand('
        SELECT
        tblroomtype.RoomTypeId,
        tblroomtype.RoomType,
        tblroomtype.StatusId,
        tblroomtype.TransactionDate,
        tblroomtype.UserId
        from tblroomtype
        ORDER BY tblroomtype.RoomType
        
            ')

            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'RoomTypeId', 'RoomType');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }

    public function getMenPowerTypeRequestDue()
    {

        $subject = Yii::$app->db->createCommand('
            SELECT tblmp_typerequestdue.TypeRequestDueId,
        tblmp_typerequestdue.TypeRequestDueDesc
        from tblmp_typerequestdue
            ')

            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'TypeRequestDueId', 'TypeRequestDueDesc');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }



    public function getMenPowerTypeRequest()
    {

        $subject = Yii::$app->db->createCommand('
    SELECT
tblmp_typerequest.TypeRequestId,
tblmp_typerequest.TypeRequestDesc
from tblmp_typerequest  ')

            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'TypeRequestId', 'TypeRequestDesc');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }


    public function getDun()
    {

        $subject = Yii::$app->db->createCommand('
        SELECT
        tbldun.DunId,
        tbldun.DunCode,
        tbldun.DunName
        from tbldun
        ORDER BY tbldun.DunName asc ')

            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'DunId', 'DunName');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }




    public function getParlimen()
    {

        $subject = Yii::$app->db->createCommand(' SELECT
        tblparlimen.ParlimenId,
        tblparlimen.ParlimenCode,
        tblparlimen.ParlimenName
        from tblparlimen
        ORDER BY tblparlimen.ParlimenName asc')

            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'ParlimenId', 'ParlimenName');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }









    public function getPassfail()
    {

        $subject = Yii::$app->db->createCommand(' SELECT
        tblpassfail.PassfailId,
        tblpassfail.PassfailDesc       
        from tblpassfail ')

            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'PassfailId', 'PassfailDesc');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }


    public function getYesNo()
    {

        $subject = Yii::$app->db->createCommand(' SELECT
        tblyesno.YesnoId,
        tblyesno.YesNoStatus     
        from tblyesno ')

            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'YesnoId', 'YesNoStatus');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }



    public function getStudentstatus()
    {

        $subject = Yii::$app->db->createCommand(' SELECT
        tblstudentstatus.StatusId,
        tblstudentstatus.StatusName,
        tblstudentstatus.StatusCode,
        tblstudentstatus.StatusLevel,
        tblstudentstatus.`Status`,
        tblstudentstatus.Description,
        tblstudentstatus.HowToUse,
        tblstudentstatus.WhenToUse,
        tblstudentstatus.Ifms_Code,
        tblstudentstatus.Ifms_Desc
        from tblstudentstatus
        where tblstudentstatus.Status = 1')
            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'StatusId', 'StatusName');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }



    public function getRelationship()
    {

        $subject = Yii::$app->db->createCommand(' SELECT
        tblrelationship.RelationshipId,
        tblrelationship.RelationshipType,
        tblrelationship.Ifms_Code,
        tblrelationship.Ifms_Desc
        from tblrelationship')
            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'RelationshipId', 'RelationshipType');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }




    public function getState()
    {

        $subject = Yii::$app->db->createCommand('SELECT
    tblstate.StateId,
    tblstate.StateName,
    tblstate.Ifms_Code,
    tblstate.KptConvo_State,
    tblstate.TransactionDate,
    tblstate.UserId
    from tblstate
    ORDER BY tblstate.StateName')
            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'StateId', 'StateName');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }


    public function getStatus()
    {

        $subject = Yii::$app->db->createCommand('SELECT StatusId, Status FROM tblstatusai')
            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'StatusId', 'Status');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }


    public function getProgramCode()
    {

        $subject = Yii::$app->db->createCommand(' SELECT
        tblprogram.ProgramId,
        tblprogram.ProgramCode,
        tblprogram.ProgramName,
        tblprogram.FacultyId,
        tblprogram.SchoolId,
        tblprogram.ProgramType,
        tblprogram.ProgramFromId,
        tblprogram.ProgramStatus        
        FROM tblprogram
        WHERE tblprogram.ProgramStatus = 1
         order by tblprogram.ProgramCode ')
            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'ProgramId', 'ProgramCode');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }

    public function getProgramName()
    {

        $subject = Yii::$app->db->createCommand(' SELECT
        tblprogram.ProgramId,
        tblprogram.ProgramCode,
        tblprogram.ProgramName,
        tblprogram.FacultyId,
        tblprogram.SchoolId,
        tblprogram.ProgramType,
        tblprogram.ProgramFromId,
        tblprogram.ProgramStatus        
        FROM tblprogram
        WHERE tblprogram.ProgramStatus = 1
GROUP BY tblprogram.ProgramName
         order by tblprogram.ProgramName')
            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'ProgramId', 'ProgramName');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }



    public function getProgramCodePlusName()
    {

        $subject = Yii::$app->db->createCommand('  SELECT
        tblprogram.ProgramId,
       CONCAT(tblprogram.ProgramCode,"   --> ",tblprogram.ProgramName) as ProgramName,
        tblprogram.FacultyId,
        tblprogram.SchoolId,
        tblprogram.ProgramType,
        tblprogram.ProgramFromId,
        tblprogram.ProgramStatus        
        FROM tblprogram
        WHERE tblprogram.ProgramStatus = 1
         order by tblprogram.ProgramCode ')
            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'ProgramId', 'ProgramName');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }

    public function getAgentList()
    {

        $subject = Yii::$app->db->createCommand(' 

SELECT
tbluser.UserId,
tbluser.FullName,
tblposition.PositionName,
tbluser.PositionId
FROM
tbluser
INNER JOIN tblposition ON tbluser.PositionId = tblposition.PositionId
where StatusId	 = 1
and tbluser.PositionId = 29
ORDER BY tbluser.FullName asc
    ')
            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'UserId', 'FullName');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }

    public function getEducation()
    {

        $subject = Yii::$app->db->createCommand(' SELECT
tbleducation.EducLevelId,
tbleducation.EducCode,
tbleducation.EducName,
tbleducation.KPT_EducationCode,
tbleducation.Ifms_Code,
tbleducation.EIPTSEducation,
tbleducation.Ifms_Desc,
tbleducation.LevelNo,
tbleducation.ProgramTypeId
FROM tbleducation
ORDER BY tbleducation.EducCode

    ')
            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'EducLevelId', 'EducCode');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }




    public function getStaffList()
    {

        $subject = Yii::$app->db->createCommand(' 

SELECT
tbluser.UserId,
tbluser.FullName,
tblposition.PositionName

FROM
tbluser
INNER JOIN tblposition ON tbluser.PositionId = tblposition.PositionId
INNER JOIN tbldepartment ON tbluser.DepartmentId = tbldepartment.DepartmentId
INNER JOIN tbldocumentcategory ON tbldocumentcategory.DocumentCategoryId = tbldepartment.DeptCatId
where tbluser.StatusId	 = 1
and tbldepartment.DeptCatId in(1,2) 
and tbluser.FullName not like "%-tba%"
and tbluser.UserId not in(198,226)
ORDER BY tbluser.FullName asc

    ')
            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'UserId', 'FullName');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }


    public function getYearEntry()
    {

        $subject = Yii::$app->db->createCommand(' 
SELECT
tblyearentry.YearEntryId,
tblyearentry.YearEntry,
tblyearentry.YearEntryCode,
tblyearentry.UserId,
tblyearentry.TransactionDate
from tblyearentry
    ')
            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'YearEntryId', 'YearEntry');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }


    public function getFeeStructure()
    {

        $subject = Yii::$app->db->createCommand(' 
    SELECT
    tblfeestructure.FeeStructureId,
    tblfeestructure.FeeStructureName,
    tblfeestructure.FeeStructureRemarks,
    tblfeestructure.StatusId
    from tblfeestructure
    where StatusId	 = 1
    ORDER BY tblfeestructure.FeeStructureName asc
        ')
            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'FeeStructureId', 'FeeStructureName');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }


    public function getResidency()
    {

        $subject = Yii::$app->db->createCommand(' 
        SELECT
    tblresidency.ResidencyId,
    tblresidency.Residency,
    tblresidency.TransactionDate,
    tblresidency.UserId
    from tblresidency

 
        ')
            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'ResidencyId', 'Residency');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }


    public function getIntake()
    {

        $subject = Yii::$app->db->createCommand(' 
    SELECT
    tblintake.IntakeId,
    tblintake.IntakeYrMo,
    tblintake.IntakeStatus,
    tblintake.IntakeTypeId,
    tblintake.MajorIntakeId,
    tblintake.TransactionDate,
    tblintake.UserId
    from tblintake
    where left(IntakeYrMo,4) = year(CURRENT_DATE)
    and  right(IntakeYrMo,2) >= month(CURRENT_DATE)
    order by IntakeYrMo asc
        ')
            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'IntakeId', 'IntakeYrMo');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }


    public function getIntakeStart()
    {

        $subject = Yii::$app->db->createCommand(' 
    SELECT
    tblintake.IntakeId,
    tblintake.IntakeYrMo as IntakeStart,
    tblintake.IntakeStatus,
    tblintake.IntakeTypeId,
    tblintake.MajorIntakeId,
    tblintake.TransactionDate,
    tblintake.UserId
    from tblintake
    ##where left(IntakeYrMo,4) = year(CURRENT_DATE)
    ##and  right(IntakeYrMo,2) >= month(CURRENT_DATE)
    order by IntakeYrMo desc limit 24
        ')
            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'IntakeStart', 'IntakeStart');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }




    public function getIntakeEnd()
    {

        $subject = Yii::$app->db->createCommand(' 
    SELECT
    tblintake.IntakeId,
    tblintake.IntakeYrMo as IntakeEnd,
    tblintake.IntakeStatus,
    tblintake.IntakeTypeId,
    tblintake.MajorIntakeId,
    tblintake.TransactionDate,
    tblintake.UserId
    from tblintake
   ## where left(IntakeYrMo,4) = year(CURRENT_DATE)
    ##and  right(IntakeYrMo,2) >= month(CURRENT_DATE)
    order by IntakeYrMo desc limit 24
        ')
            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'IntakeEnd', 'IntakeEnd');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }

    public function getSystemName()
    {

        $subject = Yii::$app->db->createCommand('SELECT
        tblsystem.SystemId,
        tblsystem.SystemName,
        tblsystem.SystemDescription,
        tblsystem.URL,
        tblsystem.IpCheck,
        tblsystem.Public,
        tblsystem.StatusId,
        tblsystem.SystemMsg,
        tblsystem.UserId,
        tblsystem.TransactionDate
        from tblsystem
        where StatusId = 1 
        ORDER BY tblsystem.SystemName ')
            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'SystemId', 'SystemName');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }


    public function getSession()
    {

        $subject = Yii::$app->db->createCommand('  SELECT
        tblsession.SessionId,
        tblsession.SessionCode,
        tblsession.SessionName,
        tblsession.`Status`,
        tblsession.TransactionDate,
        tblsession.UserId,
        tblsession.KptConvo_Session
        from tblsession
        ')
            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'SessionId', 'SessionName');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }


    public function getProgramType()
    {

        $subject = Yii::$app->db->createCommand(' SELECT
        tblprogramtype.ProgramTypeId,
        tblprogramtype.ProgramTypeName,
        tblprogramtype.ProgramTypeCode,
        tblprogramtype.CodeLevel,
        tblprogramtype.StatusId,
        tblprogramtype.TransactionDate,
        tblprogramtype.UserId,
        tblprogramtype.KptConvo_ProgType,
        tblprogramtype.Ifms_Code,
        tblprogramtype.Ifms_Desc
        from tblprogramtype order by tblprogramtype.ProgramTypeName
        ')
            // ->orderBy([
            //     'Status' => SORT_ASC
            //     ])
            ->queryAll();

        $result = ArrayHelper::map($subject, 'ProgramTypeId', 'ProgramTypeName');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }

    public function getWorkingStatus()
    {

        $subject = Yii::$app->db->createCommand('SELECT
        tblworkingstatus.WorkingStatusId,
        tblworkingstatus.WorkingStatusDesc,
        tblworkingstatus.WorkingCode,
        tblworkingstatus.WorkingRemarks,
        tblworkingstatus.UserId,
        tblworkingstatus.TransactionDate,
        tblworkingstatus.ShowId
        FROM tblworkingstatus ORDER BY tblworkingstatus.WorkingStatusDesc')
            ->queryAll();

        $result = ArrayHelper::map($subject, 'WorkingStatusId', 'WorkingStatusDesc');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];

        return $result;
    }


    public function getPosition()
    {

        $subject = Yii::$app->db->createCommand('SELECT
        tblposition.PositionId,
        concat(tblpositiongrade.PositionGrade ,"-",tblposition.PositionName) as PositionName ,
        tblposition.PositionGradeId,
        tblposition.UserId,
        tblposition.TransactionDate,
        tblpositiongrade.PositionGrade
        FROM
        tblposition
        INNER JOIN tblpositiongrade ON tblposition.PositionGradeId = tblpositiongrade.PositionGradeId
        ORDER BY tblposition.PositionName')
            ->queryAll();

        $result = ArrayHelper::map($subject, 'PositionId', 'PositionName');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];

        return $result;
    }

    public function getPositiongrade()
    {

        $subject = Yii::$app->db->createCommand('SELECT PositionGradeId, PositionGrade FROM tblpositiongrade ORDER BY PositionGrade')
            ->queryAll();

        $result = ArrayHelper::map($subject, 'PositionGradeId', 'PositionGrade');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];

        return $result;
    }

    public function getRace()
    {

        $subject = Yii::$app->db->createCommand('SELECT
        tblrace.RaceId,
        tblrace.RaceName,
        tblrace.Ifms_Code,
        tblrace.Ifms_Desc,
        tblrace.TransactionDate,
        tblrace.UserId,
        tblrace.KptConvo_Race,
        tblrace.Ifms_Bumiputera
        from tblrace ORDER BY tblrace.RaceName')
            ->queryAll();


        $result = ArrayHelper::map($subject, 'RaceId', 'RaceName');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];

        return $result;
    }



    public function getReligion()
    {

        $subject = Yii::$app->db->createCommand('SELECT
        tblreligion.ReligionId,
        tblreligion.ReligionName,
        tblreligion.Ifms_Code,
        tblreligion.Ifms_Desc
        from tblreligion ')
            ->queryAll();

        $result = ArrayHelper::map($subject, 'ReligionId', 'ReligionName');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];

        return $result;
    }




    public function getNationality()
    {

        $subject = Yii::$app->db->createCommand('SELECT
        tblnationality.NationalityId,
        tblnationality.NationalityName,
        tblnationality.Ifms_Code,
        tblnationality.Ifms_Desc,
        tblnationality.Ifms_CodeCountry,
        tblnationality.Ifms_DescCountry,
        tblnationality.`Default`,
        tblnationality.TransactionDate,
        tblnationality.UserId,
        tblnationality.KptConvo_Nationality,
        tblnationality.ICMSID
        from tblnationality
        ORDER BY tblnationality.NationalityName')
            ->queryAll();

        $result = ArrayHelper::map($subject, 'NationalityId', 'NationalityName');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];

        return $result;
    }

    public function getBranch()
    {

        $subject = Yii::$app->db->createCommand('
        SELECT  tblbranch.BranchId,  tblbranch.CollegeCode,
        tblbranch.CollegeName, tblbranch.BranchName,
        tblbranch.StatusId  from tblbranch
        where StatusId = 1
        ORDER BY tblbranch.BranchName')
            ->queryAll();

        $result = ArrayHelper::map($subject, 'BranchId', 'BranchName');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];

        return $result;
    }


    

    public function getDepartment_NoVendor()
    {

        $subject = Yii::$app->db->createCommand('
        SELECT
        tbldepartment.DepartmentId,
        tbldepartment.DeptCatId,
        tbldepartment.DepartmentDesc,
        tbldepartment.StatusId,
        tbldepartment.HODUserId,
        tbldepartment.UserId,
        tbldepartment.TransactionDate,
        tbldepartment.ShowId,
        tbldepartment.Department_iso,
        tbldepartmentcategory.DeptCatDesc
        FROM
        tbldepartment
        INNER JOIN tbldepartmentcategory ON tbldepartment.DeptCatId = tbldepartmentcategory.DeptCatId
        where StatusId = 1
        ORDER BY tbldepartmentcategory.DeptCatDesc,DepartmentDesc')
            ->queryAll();

        $result = ArrayHelper::map($subject, 'DepartmentId', 'DepartmentDesc');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];

        return $result;

    }


    
    public function getDepartment()
    {

        $subject = Yii::$app->db->createCommand('
        SELECT
        tbldepartment.DepartmentId,
        tbldepartment.DeptCatId,
        tbldepartment.DepartmentDesc,
        tbldepartment.StatusId,
        tbldepartment.HODUserId,
        tbldepartment.UserId,
        tbldepartment.TransactionDate,
        tbldepartment.ShowId,
        tbldepartment.Department_iso,
        tbldepartmentcategory.DeptCatDesc
        FROM
        tbldepartment
        INNER JOIN tbldepartmentcategory ON tbldepartment.DeptCatId = tbldepartmentcategory.DeptCatId
        where StatusId = 1
        ORDER BY tbldepartmentcategory.DeptCatDesc,DepartmentDesc')
            ->queryAll();

        $result = ArrayHelper::map($subject, 'DepartmentId', 'DepartmentDesc');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];

        return $result;
    }



    public function getDepartmentcategory()
    {

        $subject = Yii::$app->db->createCommand('
        SELECT tbldepartmentcategory.DeptCatId, tbldepartmentcategory.DeptCatDesc from tbldepartmentcategory')
            ->queryAll();

        $result = ArrayHelper::map($subject, 'DeptCatId', 'DeptCatDesc');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];

        return $result;
    }

    public function getMarital()
    {

        $subject = Yii::$app->db->createCommand('
        SELECT
        tblmaritalstatus.MaritalStatusId,
        tblmaritalstatus.MaritalStatusName,
        tblmaritalstatus.Ifms_Code,
        tblmaritalstatus.Ifms_Desc
        from tblmaritalstatus')
            ->queryAll();

        $result = ArrayHelper::map($subject, 'MaritalStatusId', 'MaritalStatusName');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];

        return $result;
    }

    public function getGender()
    {

        $subject = Yii::$app->db->createCommand('
        SELECT
        tblgender.GenderId,
        tblgender.GenderName,
        tblgender.Ifms_Code,
        tblgender.Ifms_Desc,
        tblgender.kptconvo_gender
        from tblgender')
            ->queryAll();


        $result = ArrayHelper::map($subject, 'GenderId', 'GenderName');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];

        return $result;
    }


    public function getLeedsSource()
    {

        $subject = Yii::$app->db->createCommand('
        SELECT
        tblleedssource.LeedsSourceId,
        tblleedssource.LeedsSource,
        tblleedssource.StatusId
        from tblleedssource
        ')
            ->queryAll();


        $result = ArrayHelper::map($subject, 'LeedsSourceId', 'LeedsSource');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];

        return $result;
    }



    public function getHod1()
    {

        $subject = Yii::$app->db->createCommand('
        SELECT
        tblhod.HodId as HodId1,
        CONCAT(tbluser.FullName," # ",tblhod.HodDesc) as HodName,
        tblhod.UserId,
        tblhod.ClassRepApprovalId,
        tblhod.StatusId,
        tblhod.TransactionTime,
        tblhod.StaffId
        FROM
        tblhod
        INNER JOIN tbluser ON tblhod.UserId = tbluser.UserId
        where tblhod.StatusId = 1 and tbluser.StatusId = 1
        ORDER BY tbluser.FullName')
            ->queryAll();


        $result = ArrayHelper::map($subject, 'HodId1', 'HodName');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];

        return $result;
    }



    public function getHod2()
    {

        $subject = Yii::$app->db->createCommand('
        SELECT
        tblhod.HodId as HodId2,
        CONCAT(tbluser.FullName," # ",tblhod.HodDesc) as HodName,
        tblhod.UserId,
        tblhod.ClassRepApprovalId,
        tblhod.StatusId,
        tblhod.TransactionTime,
        tblhod.StaffId
        FROM
        tblhod
        INNER JOIN tbluser ON tblhod.UserId = tbluser.UserId
        where tblhod.StatusId = 1 and tbluser.StatusId = 1
        ORDER BY tbluser.FullName')
            ->queryAll();


        $result = ArrayHelper::map($subject, 'HodId2', 'HodName');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];

        return $result;
    }




    public function getDocumentCategoryhr()
    {

        $subject = Yii::$app->db->createCommand(' SELECT
        tbldocumentcategory.DocumentCategoryId,
        tbldocumentcategory.DocumentCategory,
        tbldocumentcategory.DocumentRemarks,
        tbldocumenttype.DocTypeId,
        tbldocumenttype.DocType,
        tbldocumenttype.DocDesc,
        tbldocumenttype.DocExtension
        FROM
        tbldocumentcategory
        INNER JOIN tbldocumenttype ON tbldocumenttype.DocumentCategoryId = tbldocumentcategory.DocumentCategoryId
        where tbldocumentcategory.DocumentCategoryId = 7 ')

            ->queryAll();

        $result = ArrayHelper::map($subject, 'DocTypeId', 'DocType');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];

        return $result;
    }


    public function getProgFeePackage()
    {

        $subject = Yii::$app->db->createCommand(' SELECT
        tblprogfeepackage.ProgFeePackageId,
        tblprogfeepackage.ProgFeePackage
        from tblprogfeepackage ')
            ->queryAll();

        $result = ArrayHelper::map($subject, 'ProgFeePackageId', 'ProgFeePackage');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];

        return $result;
    }


    public function getTermType()
    {
        // Long Sem / Short Sem

        $subject = Yii::$app->db->createCommand(' SELECT
        tbltermtype.TermTypeId,
        tbltermtype.TermType
        from tbltermtype ')

            ->queryAll();

        $result = ArrayHelper::map($subject, 'TermTypeId', 'TermType');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];

        return $result;
    }

    public function getRandomCodeProgramFee()
    {
        // Long Sem / Short Sem

        $FiveDigitRandomNumber =  rand(10000, 99999);

        $result = $FiveDigitRandomNumber;
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];

        return $result;
    }

    public function getNextNoProgramFee()
    {
        // Long Sem / Short Sem

        $NextNoProgramFe = Yii::$app->db->createCommand(' SELECT
           tblprogramfeecategory.ProgFeeCatId+1 as next_no 
        from tblprogramfeecategory 
        ORDER BY tblprogramfeecategory.ProgFeeCatId desc limit 1 ')
            ->queryAll();

        $result = $NextNoProgramFe[0]['next_no'];

        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];

        return $result;
    }



    public function getSubjectRegStatusId()
    {

        $subject = Yii::$app->db->createCommand(' SELECT
        tblsubjectregstatus.SubjectRegStatusId,
        tblsubjectregstatus.SubjectRegStatusDesc,
        tblsubjectregstatus.InTranscript,
        tblsubjectregstatus.InProgress,
        tblsubjectregstatus.InResultSlip,
        tblsubjectregstatus.Description,
        tblsubjectregstatus.StatusId
        from tblsubjectregstatus where tblsubjectregstatus.StatusId = 1 order by tblsubjectregstatus.SubjectRegStatusDesc
         ')
            ->queryAll();

        $result = ArrayHelper::map($subject, 'SubjectRegStatusId', 'SubjectRegStatusDesc');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];

        return $result;
    }






    public function getRequestType()
    {

        $subject = Yii::$app->db->createCommand(' SELECT
        tblrequest.RequestId,tblrequest.RequestCatId,
        tblrequest.RequestType,tblrequest.RequestTypeDesc,
        tblrequest.ApprovalId,tblrequest.ApproveDuration,
        tblrequest.NewtApprovalId, tblrequest.StatusId
        from tblrequest
        where tblrequest.StatusId= 1
        and tblrequest.RequestCatId =1 ')
            ->queryAll();

        $result = ArrayHelper::map($subject, 'RequestId', 'RequestType');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];

        return $result;
    }
}
