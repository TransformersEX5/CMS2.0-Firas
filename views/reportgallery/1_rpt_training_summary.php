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
    'orientation' => 'L', // 'P' for portrait, 'L' for landscape
    'sheet-size' => 'A3', // Replace 'A4' with the desired paper size
    //  'sheet-size' => [8.5, 11], // Custom size: 8.5 inches wide, 11 inches high
]);

// $mpdf->SetDisplayMode('fullpage');

$i = 1;


/************************************************************************************************************************************************* */

// $mpdf->SetWatermarkText('etutorialspoint');
// $mpdf->showWatermarkText = true;
// $mpdf->watermarkTextAlpha = 0.1;
// Include the autoload.php file

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
QTraningDuration.TrainingStart,
QTraningDuration.TrainingEnd,
QTraningDuration.TotHours,
QTraningDuration.TotDays,
tbluser.FullName,
tbltrainingcategory.TrainingCategory,
QTrainingStatus.TrainingStatus ,
QTrainingStatus.TrainingStatusId,
COALESCE(QTotAttan.TotStaff,0) as TotStaff
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
GROUP BY tbltrainingduration.TrainingId) AS QTraningDuration ON QTraningDuration.TrainingId = tbltraining.TrainingId


Left join (SELECT
tbltrainingstatushistory.TrainingId,
tbltrainingstatushistory.Remarks,
tbltrainingstatushistory.TransactionDate,
tbltrainingstatus.TrainingStatus,
tbltrainingstatushistory.TrainingStatusId
FROM
tbltrainingstatushistory
INNER JOIN tbltrainingstatus ON tbltrainingstatushistory.TrainingStatusId = tbltrainingstatus.TrainingStatusId
where tbltrainingstatushistory.CurrentStatusId = 1
)QTrainingStatus on QTrainingStatus.TrainingId = tbltraining.TrainingId

Left join (SELECT
tbltrainingattandance.TrainingId,
count(DISTINCT tbltrainingattandance.UserId) as TotStaff
from tbltrainingattandance
GROUP BY tbltrainingattandance.TrainingId)QTotAttan on  QTotAttan.TrainingId = tbltraining.TrainingId 

where year(QTraningDuration.TrainingStart) = 2023

Group By tbltraining.TrainingId ORDER BY  tbltraining.TrainingTitle

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
        padding: 8px;
        border-style: solid;
        border-color: #666666;
        background-color: #dedede;
    }

    .table td {
        border-width: 1px;
        padding: 8px;
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

    <br></br>


    <table width="100%" class="spacebar table" border="1">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Start</th>
            <th>End</th>
            <th>Tot Days</th>
            <th>Tot Hours</th>
            <th>Tot Paticipant</th>
            <th>Category</th>
            <th>Status</th>
        </tr>

        <?php foreach ($result as $result) { ?>
            <tr>
                <td align="center"><?= $i++; ?> </td>
                <td><?= $result['TrainingTitle']; ?> </td>
                <td align="center"><?= $result['TrainingStart']; ?> </td>
                <td align="center"><?= $result['TrainingEnd']; ?> </td>
                <td align="center"><?= $result['TotDays']; ?> </td>
                <td align="center"><?= $result['TotHours']; ?> </td>
                <td align="center"><?= $result['TotStaff']; ?> </td>
                <td><?= $result['TrainingCategory']; ?> </td>
                <td><?= $result['TrainingStatus']; ?> </td>
            </tr>

        <?php } ?>

    </table>

<!-- ****Body - End*********************************************************************************************************************************************** -->


<!-- ****Footer - Start******************************************************************************************************************************************* -->

    <?php

   date_default_timezone_set('Asia/Kuala_Lumpur');
   $current_time = date('Y-m-d H:i:s');
   
    $mpdf->SetHTMLFooter('

        <table width="100%" style="vertical-align: bottom; font-family: tahoma; font-size: 10pt; color:#000;"><tr>
        <td width="33%">'.$current_time.'</td>
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

    
<!-- ****Footer - End******************************************************************************************************************************************* -->
