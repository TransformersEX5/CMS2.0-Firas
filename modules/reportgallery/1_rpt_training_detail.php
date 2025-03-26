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


/****SetHTMLHeader********************************************************************************************************************************************* */

$mpdf->SetHTMLHeader('<div style="text-align: left; font-family: tahoma; font-weight: bold; color:#000; font-size: 20pt;  ">List of Training 2023</div>');


/************************************************************************************************************************************************* */



$mpdf->AddPageByArray([
    'orientation' => 'P', // 'P' for portrait, 'L' for landscape
    'sheet-size' => 'A4', // Replace 'A4' with the desired paper size
    //  'sheet-size' => [8.5, 11], // Custom size: 8.5 inches wide, 11 inches high
]);

// $mpdf->SetDisplayMode('fullpage');

$i = 1;
$x = 1;


/************************************************************************************************************************************************* */

// $mpdf->SetWatermarkText('etutorialspoint');
// $mpdf->showWatermarkText = true;
// $mpdf->watermarkTextAlpha = 0.1;
// Include the autoload.php file


/************************************************************************************************************************************************* */


/***Get Param********************************************************************************************************************************************** */

$TrainingId = $_GET['id'];



/************************************************************************************************************************************************* */


?>


<?php


$select = " SELECT
tbltraining.TrainingId,
tbltraining.TrainingTitle,
tbltraining.TrainingObjective,
tbltraining.TrainingVenue,
tbltraining.TrainerId,
tbltraining.RequestId,
tbltraining.Remarks,
tbltraining.TrainingCategoryId,
tbltraining.TrainingClaimId,
tbltraining.TrainingVenueId,
tbltraining.TrainingGroupId,
tbltraining.TransactionDate,
QTraningDuration.TrainingStart,
QTraningDuration.TrainingEnd,
QTraningDuration.TotHours,
QTraningDuration.TotDays,
tbluser.FullName,
tbltrainingcategory.TrainingCategory,
QTrainingStatus.TrainingStatus,
QTrainingStatus.TrainingStatusId,
COALESCE(QTotAttan.TotStaff,0) AS TotStaff,
tbltrainingclaim.TrainingClaim,
tbltraininggroup.TrainingGroup
FROM
tbltraining
INNER JOIN tbluser ON tbltraining.RequestId = tbluser.UserId
INNER JOIN tbltrainingcategory ON tbltraining.TrainingCategoryId = tbltrainingcategory.TrainingCategoryId
LEFT JOIN (SELECT
tbltrainingduration.TrainingDurationId,
tbltrainingduration.TrainingId,
min(tbltrainingduration.TrainingDate) as TrainingStart,
max(tbltrainingduration.TrainingDate) as TrainingEnd,
Sum(tbltrainingduration.TraningTotHours) as TotHours,
count(tbltrainingduration.TrainingDate) as TotDays
from tbltrainingduration
GROUP BY tbltrainingduration.TrainingId) AS QTraningDuration ON QTraningDuration.TrainingId= tbltraining.TrainingId
LEFT JOIN (SELECT
tbltrainingstatushistory.TrainingId,
tbltrainingstatushistory.Remarks,
tbltrainingstatushistory.TransactionDate,
tbltrainingstatus.TrainingStatus,
tbltrainingstatushistory.TrainingStatusId
FROM
tbltrainingstatushistory
INNER JOIN tbltrainingstatus ON tbltrainingstatushistory.TrainingStatusId = tbltrainingstatus.TrainingStatusId
where tbltrainingstatushistory.CurrentStatusId = 1
) AS QTrainingStatus ON QTrainingStatus.TrainingId= tbltraining.TrainingId
LEFT JOIN (SELECT
tbltrainingattandance.TrainingId,
count(DISTINCT tbltrainingattandance.UserId) as TotStaff
from tbltrainingattandance
GROUP BY tbltrainingattandance.TrainingId) AS QTotAttan ON QTotAttan.TrainingId= tbltraining.TrainingId
INNER JOIN tbltrainingclaim ON tbltraining.TrainingClaimId = tbltrainingclaim.TrainingClaimId
INNER JOIN tbltraininggroup ON tbltraining.TrainingGroupId = tbltraininggroup.TrainingGroupId
where tbltraining.TrainingId = $TrainingId
Group By tbltraining.TrainingId
ORDER BY  tbltraining.TrainingTitle
 ";
$result = \Yii::$app->db->createCommand($select)->queryAll();

$html = '';
$table1 = '';


//$TrainingTitle = $result[0]['TrainingTitle'];

//$result = $conn->query($select);
// foreach ($result as $result) {
//     $TrainingTitle =  $result['TrainingTitle'];
//     $TrainingObjective =  $result['TrainingObjective'];
// }


function  getPaticipant($TrainingId)
{

    $paticipant = " SELECT
    tbltrainingattandance.TrainingId,
    tbluser.UserNo,
    tbluser.FullName,
    tbldepartment.DepartmentDesc
    FROM
    tbltrainingattandance
    INNER JOIN tbluser ON tbltrainingattandance.UserId = tbluser.UserId
    INNER JOIN tbldepartment ON tbluser.DepartmentId = tbldepartment.DepartmentId
    where  tbltrainingattandance.TrainingId = $TrainingId
    GROUP BY tbltrainingattandance.TrainingId,  tbltrainingattandance.UserId
    ORDER BY tbluser.FullName ";

    $result = \Yii::$app->db->createCommand($paticipant)->queryAll();

    return $result;
}





?>
<style>
    body {
        font-family: Arial;
        font-size: 12pt;
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
        font-size: 12pt;
        color: #000;
        border-width: 1px;
        border-color: #666666;
        border-collapse: collapse;
    }

    .table th {
        border-width: 1px;
        padding: 5px;
        border-style: solid;
        border-color: #666666;
        background-color: #dedede;
    }

    .table td {
        border-width: 1px;
        padding: 2px;
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



<!-- **Title on browser tab********************************************************************************************************************************************* -->
<?php
// Define the title for the browser tab
// $title = 'Training Report  - Tab';

// // Add content to the PDF
// $html = '<!DOCTYPE html>
//            <html>
//                 <head>
//                     <title>' . $title . '</title>
//                 </head>
//         </html>';

// // Set the title in mPDF
// $mpdf->SetTitle($title);


?>




<!-- ****Body - Start******************************************************************************************************************************************* -->

<body>
    <br><br>
    <table width="100%" border="0">
        <tbody>
            <tr>
                <td align="left"><b>Training Detail</b></td>
            </tr>
        </tbody>
    </table>
    <?php foreach ($result as $result) {

        $TrainingTitle      = $result['TrainingTitle'];
        $TrainingObjective  =  $result['TrainingObjective'];
        $TrainingVenue      =  $result['TrainingVenue'];
        $TrainingStart      =  $result['TrainingStart'];
        $TrainingEnd        =  $result['TrainingEnd'];
        $TotDays            =  $result['TotDays'];
        $TotHours           =  $result['TotHours'];
        $TotStaff           =  $result['TotStaff'];
        $TrainingCategory   =  $result['TrainingCategory'];
        $TrainingClaim      =  $result['TrainingClaim'];
        $TrainingStatus     =  $result['TrainingStatus'];
        $TrainingGroup      =  $result['TrainingGroup'];
        $TransactionDate      =  $result['TransactionDate'];
        
        $Remarks            =  $result['Remarks'];

        
    } ?>

    <br></br>
    <table width="70%" class="spacebar table">
        <tr>
            <td>Training </td>
            <td> <?= $TrainingTitle ?></td>
        </tr>
        <tr>
            <td>Objective </td>
            <td> <?= $TrainingObjective ?></td>
        </tr>
        <tr>
            <td>Venue </td>
            <td> <?= $TrainingVenue ?></td>
        </tr>

        <tr>
            <td> Training Date </td>
            <td> <?= $TrainingStart . ' -to- ' . $TrainingEnd  ?></td>
        </tr>


        <tr>
            <td> No of Days </td>
            <td> <?= $TotDays ?></td>
        </tr>

        <tr>
            <td> Total Hours </td>
            <td> <?= $TotHours ?></td>
        </tr>

        <tr>
            <td>No of Paticipant </td>
            <td> <?= $TotStaff ?></td>
        </tr>

        <tr>
            <td>Training Group </td>
            <td> <?= $TrainingGroup ?></td>
        </tr>


        <tr>
            <td>Training Category </td>
            <td> <?= $TrainingCategory ?></td>
        </tr>



        <tr>
            <td>Claim</td>
            <td> <?= $TrainingClaim ?></td>
        </tr>

        <tr>
            <td>Status </td>
            <td> <?= $TrainingStatus ?></td>
        </tr>

        <tr>
            <td>Request Date: </td>
            <td> <?= $TransactionDate ?></td>
        </tr>

        

        
        <tr>
            <td>Remarks</td>
            <td> <?= $Remarks ?></td>
        </tr>


    </table>



    <div style='page-break-after:always'>&nbsp;</div><br>


    <?php



    $data = getPaticipant($TrainingId);

    ?>


    <table width="100%" class="spacebar table" border="1">
        <tr>
            <th>No</th>
            <th>Paticipant</th>
            <th>Department/Faculty</th>

        </tr>

        <?php foreach ($data as $data) { ?>
            <tr>
                <td align="center"><?= $x++; ?> </td>
                <td><?= $data['FullName']; ?> </td>
                <td align="left"><?= $data['DepartmentDesc']; ?> </td>

            </tr>

        <?php } ?>

    </table>


    <?php

    date_default_timezone_set('Asia/Kuala_Lumpur');
    $current_time = date('Y-m-d H:i:s');

    $mpdf->SetHTMLFooter('

        <table width="100%" style="vertical-align: bottom; font-family: tahoma; font-size: 10pt; color:#000;"><tr>
        <td width="33%">' . $current_time . '</td>
        <td width="33%" align="center"></td>
        <td width="33%" style="text-align: right;">{PAGENO}/{nbpg}</td>
        </tr></table>

        ');


    $html = ob_get_contents();
    ob_end_clean();



    $mpdf->WriteHTML($html);
    $mpdf->Output();
    exit;
    ?>