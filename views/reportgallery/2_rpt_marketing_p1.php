<?php
set_time_limit(600);
ini_set("memory_limit", "256M");

define('_MPDF_URI', '../');     // must be  a relative or absolute URI - not a file system path
define('_MPDF_PATH', '../');

// define("_TTF_FONT_NORMAL", 'arial.ttf');
// define("_TTF_FONT_BOLD", 'arialbd.ttf');



$vendorPath = Yii::getAlias('@vendor');
require_once $vendorPath . '/autoload.php';

//include("../mpdf/mpdf/src/Mpdf.php");


$mpdf = new \Mpdf\Mpdf();


$mpdf->ignore_invalid_utf8 = true;
ob_start();


$param1 = yii::$app->request->get('param1');


$result = \Yii::$app->db->createCommand("CALL GetMarketingExgratiaPaymentReport_P1($param1)");
$result->execute();

/****SetHTMLHeader********************************************************************************************************************************************* */
$mpdf->SetHTMLHeader('<div style="text-align: left; font-family: tahoma; font-weight: bold; color:#000; font-size: 20pt;  ">Summary Exgratia P1 Claim for ' . $param1 . '</div>');
echo '<br>';
/************************************************************************************************************************************************* */

$mpdf->AddPageByArray([
    'orientation' => 'L', // 'P' for portrait, 'L' for landscape
    'sheet-size' => 'A3', // Replace 'A4' with the desired paper size
    //  'sheet-size' => [8.5, 11], // Custom size: 8.5 inches wide, 11 inches high
]);

$i = 1;
?>

<style>
    body {
        font-family: Arial;
        font-size: 10pt;
        margin-top: 0px;
    }

    p {
        line-height: 170%;
    }

    .hr {
        border: 0;
        margin-top: auto;
        border-top: 4px double #8c8c8c;
        text-align: center;
    }

    .signature {
        margin-bottom: auto;
        width: 5px;
    }

    .table {
        font-family: Arial;
        font-size: 10pt;
        color: #000;
        border-width: 1px;
        border-color: #666666;
        border-collapse: collapse;
    }

    .table th {
        border-width: 1px;
        padding: 6px;
        border-style: solid;
        border-color: #666666;
        background-color: #dedede;
    }

    .table td {
        border-width: 1px;
        padding: 6px;
        border-style: solid;
        border-color: #666666;
        background-color: #ffffff;
        /* text-align: center; */
    }

    td {
        vertical-align: top;
        text-align: justify;
    }

    .spacebar {
        line-height: 170%;
    }
</style>



<!-- ****Body - Start******************************************************************************************************************************************* -->

<body>
    <br><br>
    <table width="100%" border="0">
        <tbody>
            <tr>
                <td align="left">Note Exgratia P1 Claim :</td>
            </tr>
            <tr>
                <td align="left">1- MUST paid full Application fee </td>
            </tr>
            <tr>
                <td align="left">2- MUST paid full Registration fee </td>
            </tr>
            <tr>
                <td align="left">3- MUST be ACTIVE status </td>
            </tr>
            <tr>
                <td align="left"> Note :  <br>SBS = Student bring student <br> AHS = Allied Health Science <br>NonAHS =Non - Allied Health Science </td>
            </tr>
           
        </tbody>
    </table>
    <br>
    <strong>
        <h3>Summary Exgratia P1 Claim</h3>
    </strong>

    <?php

    $team = " SELECT
                tblbranch.BranchName,
                tbluser.MarketingTeamId,
                tblmarketingteam.MarketingTeam,
                tblmarketingteam.Description

                FROM
                tblexgratiasummary_temp
                INNER JOIN tblsalary ON tblexgratiasummary_temp.SalaryId = tblsalary.SalaryId
                INNER JOIN tbluser ON tbluser.UserNo = tblexgratiasummary_temp.UserNo
                INNER JOIN tblmarketingteam ON tbluser.MarketingTeamId = tblmarketingteam.MarketingTeamId
                INNER JOIN tblbranch ON tbluser.BranchId = tblbranch.BranchId
                
                GROUP BY tbluser.MarketingTeamId
                ORDER BY tblbranch.BranchName , tbluser.MarketingTeamId ";
            $teams = \Yii::$app->db->createCommand($team)->queryAll();



    foreach ($teams as $teams) {

        $MarketingTeamId = $teams['MarketingTeamId'];
        echo "<br>".$teams['Description'];
        


        $select = " SELECT
                    tblexgratiasummary_temp.UserNo,
                    tblexgratiasummary_temp.FullName,
                    tblexgratiasummary_temp.ShortName,
                    tblexgratiasummary_temp.TargetNo,
                    tblexgratiasummary_temp.SalaryId,
                    tblexgratiasummary_temp.TotActive,
                    tblexgratiasummary_temp.TotSBS,
                    tblexgratiasummary_temp.TotAgent,
                    tblexgratiasummary_temp.TotCantClaim,
                    tblexgratiasummary_temp.TotClaim,
                    tblexgratiasummary_temp.TotRateP1,
                    tblexgratiasummary_temp.TotAHS,
                    tblexgratiasummary_temp.TotAHSAmt,
                    tblexgratiasummary_temp.TotNonAHS,
                    tblexgratiasummary_temp.TotNonAHSAmt,
                    tblexgratiasummary_temp.TotClaimP1,
                    tblexgratiasummary_temp.TotS1,
                    tblexgratiasummary_temp.TotClaimP2,
                    tblsalary.SalaryCode,
                    tblbranch.BranchName,
                    tblmarketingteam.Description,
                    tblmarketingteam.MarketingTeam,
                    tblmarketingteam.TeamTarget,
                    tbluser.MarketingTeamId
                    FROM
                    tblexgratiasummary_temp
                    INNER JOIN tblsalary ON tblexgratiasummary_temp.SalaryId = tblsalary.SalaryId
                    INNER JOIN tbluser ON tbluser.UserNo = tblexgratiasummary_temp.UserNo
                    INNER JOIN tblbranch ON tbluser.BranchId = tblbranch.BranchId
                    INNER JOIN tblmarketingteam ON tbluser.MarketingTeamId = tblmarketingteam.MarketingTeamId 
                    where tbluser.MarketingTeamId = $MarketingTeamId 
                    ORDER BY tblbranch.BranchName , tbluser.MarketingTeamId, tblexgratiasummary_temp.UserNo ";


        $result = \Yii::$app->db->createCommand($select)->queryAll();

        $html = '';
        $table1 = '';


    ?>

        <table width="100%" class="spacebar table" border="1">
            <tr>
                <th>No</th>               
                <th>Team</th>
                <th>Staff Name</th>
                <th>Category</th>
                <th>Target</th>
                <th>Tot<br>Active</th>
                <th>Tot<br>SBS</th>
                <th>Tot<br>Agent</th>
                <th>Tot<br>Claim</th>
                <th>Tot<br>AHS</th>
                <th>Tot<br>AHSAmt</th>
                <th>Tot<br>NonAHS</th>
                <th>Tot<br>NonAHSAmt</th>
                <th>Tot<br>ClaimP1</th>
            </tr>
            <?php foreach ($result as $result) { ?>

                <tr>
                    <td align="center"><?= $i++; ?> </td>
                    
                    <td align="center" width='12%' ><?= $result['Description']; ?> </td>
                    <td align="Left" width='25%'><?= $result['FullName']?> </td>
                    <td align="center"><?= $result['SalaryCode']; ?> </td>
                    <td align="center"><?= $result['TargetNo']; ?> </td>
                    <td align="center"><?= $result['TotActive']; ?> </td>
                    <td align="center"><?= $result['TotSBS']; ?> </td>
                    <td align="center"><?= $result['TotAgent']; ?> </td>
                    <td align="center"><?= $result['TotClaim']; ?> </td>

                    <td align="center"><?= $result['TotAHS']; ?> </td>
                    <td align="center"><?= $result['TotAHSAmt']; ?> </td>

                    <td align="center"><?= $result['TotNonAHS']; ?> </td>
                    <td align="center"><?= $result['TotNonAHSAmt']; ?> </td>

                    <td align="center"><?= $result['TotClaimP1']; ?> </td>
                </tr>

            <?php }
            ?>

        </table>

    <?php }
    ?>

    <!-- ****Body - End*********************************************************************************************************************************************** -->
<br>
    <pagebreak>


        <br><br>
        <strong>
            <h3>Staff Bring Student</h3>
        </strong>

        <?php


        $Staff  = "SELECT
                    tblmarketingapplicationfee_temp.QFrom,
                    tblmarketingapplicationfee_temp.UserNo,
                    tblmarketingapplicationfee_temp.FullName,
                    tblmarketingapplicationfee_temp.ShortName
                    FROM
                    tblmarketingapplicationfee_temp
                    INNER JOIN tblexgratia ON tblexgratia.ProgramRegId = tblmarketingapplicationfee_temp.ProgramRegId AND tblexgratia.Branch = tblmarketingapplicationfee_temp.QFrom
                    INNER JOIN tbluser ON tblexgratia.UserNo = tbluser.UserNo
                    Inner join tblbranch on tblbranch.BranchId = tbluser.BranchId
                    where date_format(tblexgratia.P1,'%Y%m') = $param1 
                    GROUP BY tblmarketingapplicationfee_temp.UserNo
                    ORDER BY tblbranch.BranchName , tbluser.MarketingTeamId, tblmarketingapplicationfee_temp.UserNo ";

        $Staffdata = \Yii::$app->db->createCommand($Staff)->queryAll();


        foreach ($Staffdata as $Staffdata) {
            $UserNo = $Staffdata['UserNo'];
            $FullName = $Staffdata['FullName'];


            $select = " SELECT
                    tblmarketingapplicationfee_temp.QFrom,
                    tblmarketingapplicationfee_temp.FullName,
                    tblmarketingapplicationfee_temp.StudentNo,
                    tblmarketingapplicationfee_temp.StudName,
                    tblmarketingapplicationfee_temp.ProgramRegId,
                    tblmarketingapplicationfee_temp.ProgramCode,
                    tblmarketingapplicationfee_temp.App_Fee,
                    tblmarketingapplicationfee_temp.App_Paid,
                    tblmarketingapplicationfee_temp.App_FullPaid,
                    tblmarketingapplicationfee_temp.Reg_Fee,
                    tblmarketingapplicationfee_temp.Reg_Paid,
                    tblmarketingapplicationfee_temp.Reg_FullPaid,
                    tblmarketingapplicationfee_temp.StatusName,
                    tblmarketingapplicationfee_temp.SemOne_Fee,
                    tblmarketingapplicationfee_temp.SemOne_Paid,
                    tblmarketingapplicationfee_temp.SemOne_FullPaid,
                    tblmarketingapplicationfee_temp.UserNo,
                    tblmarketingapplicationfee_temp.FullName,
                    tblmarketingapplicationfee_temp.ShortName,
                    tblmarketingapplicationfee_temp.SBS,
                    tblmarketingapplicationfee_temp.Agents,
                    tblmarketingapplicationfee_temp.StudGetStud,
                    tblmarketingapplicationfee_temp.StudGetStudName,
                    tblmarketingapplicationfee_temp.AgentName,
                    tbluser.TargetNo,
                    tbluser.ExgratiaRateP1,
                    tblexgratia.P1,
                    tblbranch.BranchName
                    FROM
                    tblmarketingapplicationfee_temp
                    INNER JOIN tblexgratia ON tblexgratia.ProgramRegId = tblmarketingapplicationfee_temp.ProgramRegId AND tblexgratia.Branch = tblmarketingapplicationfee_temp.QFrom
                    INNER JOIN tbluser ON tblexgratia.UserNo = tbluser.UserNo
                    Inner join tblbranch on tblbranch.BranchId = tbluser.BranchId
                    where tblmarketingapplicationfee_temp.UserNo = $UserNo and  
                        date_format(tblexgratia.P1,'%Y%m') = $param1 
            
            ORDER BY StudName ";

            $stud = \Yii::$app->db->createCommand($select)->queryAll();

            $html = '';
            $table1 = '';


            //$TrainingTitle = $result[0]['TrainingTitle'];

            //$result = $conn->query($select);
            // foreach ($result as $result) {
            //     $TrainingTitle =  $result['TrainingTitle'];
            //     $TrainingObjective =  $result['TrainingObjective'];
            // }
            $x = 1;
            echo '<br> Staff Name : ' . $FullName;

        ?>

            <table width="100%" class="spacebar table" border="1">
                <tr>
                    <th>No</th>
                    <th>Branch</th>
                    <th>Stud Name</th>
                    <th>Stud No</th>
                    <th>Program</th>
                    <th>Application <br>Fee/Paid</th>
                    <th>Registration <br>Fee/Paid</th>
                    <th>Status</th>
                    <th>SBS</th>
                    <th>Agent</th>

                </tr>

                <?php foreach ($stud as $stud) { ?>

                    <tr>
                        <td align="center" width='3%'><?= $x++; ?> </td>
                        <td align="center" width='5%'><?= $stud['QFrom']; ?> </td>
                        <td align="Left" width='25%'><?= $stud['StudName'];?> </td>
                        <td align="Left" width='8%'><?= $stud['StudentNo']; ?> </td>
                        <td align="Left" width='8%'><?= $stud['ProgramCode']; ?> </td>
                        <td align="center" width='7%'><?= $stud['App_FullPaid']; ?> </td>
                        <td align="center" width='7%'><?= $stud['Reg_FullPaid']; ?> </td>
                        <td align="center" width='7%'><?= $stud['StatusName']; ?> </td>
                        <?php if ($stud['SBS'] == 'Yes') { ?>
                            <td align="left" width='15%'><?= $stud['StudGetStudName']; ?> </td>
                        <?php } else { ?>
                            <td align="center" width='18%'><?= $stud['SBS']; ?> </td>
                        <?php } ?>



                        <?php if ($stud['Agents'] == 'Yes') { ?>
                            <td align="left" width='15%'><?= $stud['AgentName']; ?> </td>
                        <?php } else { ?>
                            <td align="center" width='18%'><?= $stud['Agents']; ?> </td>
                        <?php } ?>



                    </tr>

                <?php }  ?>

            </table>

        <?php } ?>



        <pagebreak>


            <br><br>

            <strong>
                <h3>Student Bring Student</h3>
            </strong>


            <!-- ****Footer - Start******************************************************************************************************************************************* -->

            <?php


            $sbslist = " SELECT
                        tblmarketingapplicationfee_temp.QFrom,
                        tblmarketingapplicationfee_temp.SBS,
                        tblmarketingapplicationfee_temp.Agents,
                        tblmarketingapplicationfee_temp.StudGetStud,
                        tblmarketingapplicationfee_temp.StudGetStudName
                        FROM tblmarketingapplicationfee_temp
                        INNER JOIN tblexgratia ON tblexgratia.ProgramRegId = tblmarketingapplicationfee_temp.ProgramRegId AND tblexgratia.Branch = tblmarketingapplicationfee_temp.QFrom
                        where tblmarketingapplicationfee_temp.SBS ='Yes'  and date_format(tblexgratia.P1,'%Y%m') = $param1     
                        GROUP BY StudGetStud  
                        ORDER BY StudName";


            $sbslistdata = \Yii::$app->db->createCommand($sbslist)->queryAll();


            foreach ($sbslistdata as $sbslistdata) {
                $StudGetStud = $sbslistdata['StudGetStud'];

                echo '<br>Student Name : ' . $sbslistdata['StudGetStudName'];

                $sbs = " SELECT
                    tblmarketingapplicationfee_temp.QFrom,
                    tblmarketingapplicationfee_temp.FullName,
                    tblmarketingapplicationfee_temp.StudentNo,
                    tblmarketingapplicationfee_temp.StudName,
                    tblmarketingapplicationfee_temp.ProgramRegId,
                    tblmarketingapplicationfee_temp.ProgramCode,
                    tblmarketingapplicationfee_temp.App_Fee,
                    tblmarketingapplicationfee_temp.App_Paid,
                    tblmarketingapplicationfee_temp.App_FullPaid,
                    tblmarketingapplicationfee_temp.Reg_Fee,
                    tblmarketingapplicationfee_temp.Reg_Paid,
                    tblmarketingapplicationfee_temp.Reg_FullPaid,
                    tblmarketingapplicationfee_temp.StatusName,
                    tblmarketingapplicationfee_temp.SemOne_Fee,
                    tblmarketingapplicationfee_temp.SemOne_Paid,
                    tblmarketingapplicationfee_temp.SemOne_FullPaid,
                    tblmarketingapplicationfee_temp.UserNo,
                    tblmarketingapplicationfee_temp.FullName,
                    tblmarketingapplicationfee_temp.ShortName,
                    tblmarketingapplicationfee_temp.SBS,
                    tblmarketingapplicationfee_temp.Agents,
                    tblmarketingapplicationfee_temp.StudGetStud,
                    tblmarketingapplicationfee_temp.StudGetStudName,
                    tblmarketingapplicationfee_temp.AgentName,
                    tbluser.TargetNo,
                    tbluser.ExgratiaRateP1,
                    tblexgratia.P1,
                    tblbranch.BranchName
                    FROM
                    tblmarketingapplicationfee_temp
                    INNER JOIN tblexgratia ON tblexgratia.ProgramRegId = tblmarketingapplicationfee_temp.ProgramRegId AND tblexgratia.Branch = tblmarketingapplicationfee_temp.QFrom
                    INNER JOIN tbluser ON tblexgratia.UserNo = tbluser.UserNo
                    Inner join tblbranch on tblbranch.BranchId = tbluser.BranchId
                    where  tblmarketingapplicationfee_temp.SBS ='Yes'  and tblmarketingapplicationfee_temp.StudGetStud = '$StudGetStud'
                    and date_format(tblexgratia.P1,'%Y%m') = $param1 
                    ORDER BY StudName ";

                $studsbs = \Yii::$app->db->createCommand($sbs)->queryAll();

                $StudGetStud = 0;
                $s = 1;
            ?>

                <table width="100%" class="spacebar table" border="1">
                    <tr>
                        <th>No</th>
                        <th>Branch</th>
                        <th>Stud Name</th>
                        <th>Stud No</th>
                        <th>Program</th>
                        <th>Application <br>Fee/Paid</th>
                        <th>Registration <br>Fee/Paid</th>
                        <th>Status</th>
                        <th>SBS</th>
                        <th>Agent</th>

                    </tr>

                    <?php foreach ($studsbs as $studsbs) { ?>

                        <tr>
                            <td align="center" width='3%'><?= $s++; ?> </td>
                            <td align="center" width='5%'><?= $studsbs['QFrom']; ?> </td>
                            <td align="Left" width='25%'><?= $studsbs['StudName']; ?> </td>
                            <td align="Left" width='8%'><?= $studsbs['StudentNo']; ?> </td>
                            <td align="Left" width='8%'><?= $studsbs['ProgramCode']; ?> </td>
                            <td align="center" width='7%'><?= $studsbs['App_FullPaid']; ?> </td>
                            <td align="center" width='7%'><?= $studsbs['Reg_FullPaid']; ?> </td>
                            <td align="center" width='7%'><?= $studsbs['StatusName']; ?> </td>
                            <?php if ($studsbs['SBS'] == 'Yes') { ?>
                                <td align="left" width='15%'><?= $studsbs['StudGetStudName']; ?> </td>
                            <?php } else { ?>
                                <td align="center" width='18%'><?= $studsbs['SBS']; ?> </td>
                            <?php } ?>

                            <?php if ($studsbs['Agents'] == 'Yes') { ?>
                                <td align="left" width='15%'><?= $studsbs['AgentName']; ?> </td>
                            <?php } else { ?>
                                <td align="center" width='18%'><?= $studsbs['Agents']; ?> </td>
                            <?php } ?>



                        </tr>

                    <?php }  ?>

                </table>

            <?php } ?>




            <pagebreak>


                <br><br>

                <strong>
                    <h3>Agent Bring Student</h3>
                </strong>


                <?php


                $agentlist = " SELECT
                                tblmarketingapplicationfee_temp.QFrom,
                                tblmarketingapplicationfee_temp.SBS,
                                tblmarketingapplicationfee_temp.Agents,
                                trim(tblmarketingapplicationfee_temp.AgentName) as AgentName,
                                tblmarketingapplicationfee_temp.StudGetStud,
                                tblmarketingapplicationfee_temp.StudGetStudName
                                FROM tblmarketingapplicationfee_temp
                                INNER JOIN tblexgratia ON tblexgratia.ProgramRegId = tblmarketingapplicationfee_temp.ProgramRegId AND tblexgratia.Branch = tblmarketingapplicationfee_temp.QFrom
                                where tblmarketingapplicationfee_temp.Agents ='Yes'  and date_format(tblexgratia.P1,'%Y%m') = $param1     
                                GROUP BY tblmarketingapplicationfee_temp.AgentName  
                                ORDER BY tblmarketingapplicationfee_temp.AgentName,tblmarketingapplicationfee_temp.StudName ";


                $agentlistdata = \Yii::$app->db->createCommand($agentlist)->queryAll();


                foreach ($agentlistdata as $agentlistdata) {
                    $AgentsName = $agentlistdata['AgentName'];

                    echo '<br>Agent Name : ' . $agentlistdata['AgentName'];

                    $sbs = " SELECT
                            tblmarketingapplicationfee_temp.QFrom,
                            tblmarketingapplicationfee_temp.FullName,
                            tblmarketingapplicationfee_temp.StudentNo,
                            tblmarketingapplicationfee_temp.StudName,
                            tblmarketingapplicationfee_temp.ProgramRegId,
                            tblmarketingapplicationfee_temp.ProgramCode,
                            tblmarketingapplicationfee_temp.App_Fee,
                            tblmarketingapplicationfee_temp.App_Paid,
                            tblmarketingapplicationfee_temp.App_FullPaid,
                            tblmarketingapplicationfee_temp.Reg_Fee,
                            tblmarketingapplicationfee_temp.Reg_Paid,
                            tblmarketingapplicationfee_temp.Reg_FullPaid,
                            tblmarketingapplicationfee_temp.StatusName,
                            tblmarketingapplicationfee_temp.SemOne_Fee,
                            tblmarketingapplicationfee_temp.SemOne_Paid,
                            tblmarketingapplicationfee_temp.SemOne_FullPaid,
                            tblmarketingapplicationfee_temp.UserNo,
                            tblmarketingapplicationfee_temp.FullName,
                            tblmarketingapplicationfee_temp.ShortName,
                            tblmarketingapplicationfee_temp.SBS,
                            tblmarketingapplicationfee_temp.Agents,
                            tblmarketingapplicationfee_temp.StudGetStud,
                            tblmarketingapplicationfee_temp.StudGetStudName,
                            tblmarketingapplicationfee_temp.AgentName,
                            tbluser.TargetNo,
                            tbluser.ExgratiaRateP1,
                            tblexgratia.P1,
                            tblbranch.BranchName
                            FROM
                            tblmarketingapplicationfee_temp
                            INNER JOIN tblexgratia ON tblexgratia.ProgramRegId = tblmarketingapplicationfee_temp.ProgramRegId AND tblexgratia.Branch = tblmarketingapplicationfee_temp.QFrom
                            INNER JOIN tbluser ON tblexgratia.UserNo = tbluser.UserNo
                            Inner join tblbranch on tblbranch.BranchId = tbluser.BranchId
                            where       tblmarketingapplicationfee_temp.Agents ='Yes'  and trim(tblmarketingapplicationfee_temp.AgentName) = '$AgentsName'
                                and date_format(tblexgratia.P1,'%Y%m') = $param1 

                            ORDER BY AgentName,StudName ";

                    $studsbs = \Yii::$app->db->createCommand($sbs)->queryAll();

                    $StudGetStud = 0;
                    $j = 1;

                ?>

                    <table width="100%" class="spacebar table" border="1">
                        <tr>
                            <th>No</th>
                            <th>Branch</th>
                            <th>Stud Name</th>
                            <th>Stud No</th>
                            <th>Program</th>
                            <th>Application <br>Fee/Paid</th>
                            <th>Registration <br>Fee/Paid</th>
                            <th>Status</th>
                            <th>SBS</th>
                            <th>Agent</th>

                        </tr>

                        <?php foreach ($studsbs as $studsbs) { ?>

                            <tr>
                                <td align="center" width='3%'><?= $j++; ?> </td>
                                <td align="center" width='5%'><?= $studsbs['QFrom']; ?> </td>
                                <td align="Left" width='25%'><?= $studsbs['StudName']; ?> </td>
                                <td align="Left" width='8%'><?= $studsbs['StudentNo']; ?> </td>
                                <td align="Left" width='8%'><?= $studsbs['ProgramCode']; ?> </td>
                                <td align="center" width='7%'><?= $studsbs['App_FullPaid']; ?> </td>
                                <td align="center" width='7%'><?= $studsbs['Reg_FullPaid']; ?> </td>
                                <td align="center" width='7%'><?= $studsbs['StatusName']; ?> </td>
                                <?php if ($studsbs['SBS'] == 'Yes') { ?>
                                    <td align="left" width='15%'><?= $studsbs['StudGetStudName']; ?> </td>
                                <?php } else { ?>
                                    <td align="center" width='18%'><?= $studsbs['SBS']; ?> </td>
                                <?php } ?>

                                <?php if ($studsbs['Agents'] == 'Yes') { ?>
                                    <td align="left" width='15%'><?= $studsbs['AgentName']; ?> </td>
                                <?php } else { ?>
                                    <td align="center" width='18%'><?= $studsbs['Agents']; ?> </td>
                                <?php } ?>
                            </tr>
                        <?php }  ?>
                    </table>
                <?php } ?>


        <?php

        date_default_timezone_set('Asia/Kuala_Lumpur');
        $current_time = date('Y-m-d H:i:s');

        $mpdf->SetHTMLFooter('
        <table width="100%" style="vertical-align: bottom; font-family: tahoma; font-size: 10pt; color:#000;"><tr>
        <td width="33%">' . $current_time . '</td>  <td width="33%" align="center"></td> <td width="33%" style="text-align: right;">{PAGENO}/{nbpg}</td>
        </tr></table>

        ');


        // Now collect the output buffer into a variable
        $html = ob_get_contents();
        ob_end_clean();

        // send the captured HTML from the output buffer to the mPDF class for processing
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;
        ?>


 <!-- ****Footer - End******************************************************************************************************************************************* -->