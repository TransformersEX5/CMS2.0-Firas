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


}

?>