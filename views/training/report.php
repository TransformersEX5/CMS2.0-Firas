<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>

<?php

$module = '/' . Yii::$app->controller->module->id;
$TrainingId = base64_decode(Yii::$app->request->get('trainingId'));

$script = <<<JS

$(document).ready(function() 
{

});

JS;
$this->registerJs($script);

?>
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

$mpdf->SetHTMLHeader('<div style="text-align: center; font-family: tahoma; color:#000; font-size: 20pt;  "></div>');


/************************************************************************************************************************************************* */



$mpdf->AddPageByArray([
    'orientation' => 'L', // 'P' for portrait, 'L' for landscape
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

// $TrainingId = $_GET['id'];



/************************************************************************************************************************************************* */


?>


<?php

$sql = "SELECT TrainingEvalQuestionId, TrainingTitle
FROM tbltrainingevalmarks
INNER JOIN tbltraining ON tbltraining.TrainingId = tbltrainingevalmarks.TrainingId
WHERE tbltrainingevalmarks.TrainingId = $TrainingId
GROUP BY TrainingEvalQuestionId";

$trainingdetails = \Yii::$app->db->createCommand($sql)->queryAll();

$sqlAttendance = "SELECT 'Attend' AS Attendance, COUNT(DISTINCT UserId) AS TotalUsers
FROM tbltrainingevalmarks
WHERE TrainingId = $TrainingId

UNION

SELECT 'TotalAttendance' AS Attendance, COUNT(DISTINCT UserId) AS TotalUsers
FROM tbltrainingattandance
WHERE TrainingId = $TrainingId";

$attendanceNo = \Yii::$app->db->createCommand($sqlAttendance)->queryAll();

$html = '';
$table1 = '';

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
    <table width="100%" border="0">
        <tbody>
            <tr>
                <td style="text-align:center;"><img src="<?= Url::base() ?>/image/city_logo_white.png" style="display:block; margin:0 auto; width:15%; height:9%;"></td>
            </tr>
            <tr>
                <td><b><?= $trainingdetails[0]['TrainingTitle']; ?></b></td>
            </tr>
            <tr>
                <td>Attendance: <?= $attendanceNo[0]['TotalUsers']; ?>/<?= $attendanceNo[1]['TotalUsers']; ?></td>
            </tr>
        </tbody>
    </table>

    <br>
    
    <table width="100%" class="spacebar table">
        <tr>
            <td style="vertical-align:middle; text-align:center;" rowspan="2">Question</td>
            <td style="text-align:center;" colspan="5">Marks VS Staff</td>
        </tr>
        <tr>
            <td style="width:5%;  text-align:center;">1</td>
            <td style="width:5%; text-align:center;">2</td>
            <td style="width:5%; text-align:center;">3</td>
            <td style="width:5%; text-align:center;">4</td>
            <td style="width:5%; text-align:center;">5</td>
            <!-- <td style="width:7%; text-align:center;">Total</td> -->
        </tr>

        <?php
        $TotalMark1 = 0;
        $TotalMark2 = 0;
        $TotalMark3 = 0;
        $TotalMark4 = 0;
        $TotalMark5 = 0;

        foreach ($trainingdetails as $rows) {
            $sql = "SELECT QuestionNo, Question, TotalMark1, TotalMark2, TotalMark3, TotalMark4, TotalMark5, 
            SUM(TotalMark1+TotalMark2+TotalMark3+TotalMark4+TotalMark5) AS TotalMark
            FROM
            (
            SELECT QuestionNo, Question, 
            SUM(CASE WHEN tbltrainingevalmarks.Mark1 = 1 THEN 1 ELSE 0 END) AS TotalMark1,
            SUM(CASE WHEN tbltrainingevalmarks.Mark2 = 2 THEN 1 ELSE 0 END) AS TotalMark2,
            SUM(CASE WHEN tbltrainingevalmarks.Mark3 = 3 THEN 1 ELSE 0 END) AS TotalMark3,
            SUM(CASE WHEN tbltrainingevalmarks.Mark4 = 4 THEN 1 ELSE 0 END) AS TotalMark4,
            SUM(CASE WHEN tbltrainingevalmarks.Mark5 = 5 THEN 1 ELSE 0 END) AS TotalMark5
            FROM tbltrainingevalquestion
            INNER JOIN tbltrainingevalmarks ON tbltrainingevalmarks.TrainingEvalQuestionId = tbltrainingevalquestion.TrainingEvalQuestionId
            WHERE tbltrainingevalquestion.TrainingEvalQuestionId = " . $rows['TrainingEvalQuestionId'] . " AND TrainingId = " . $TrainingId . "
            )QMarks
            GROUP BY QuestionNo";
            $result = \Yii::$app->db->createCommand($sql)->queryAll();
            foreach ($result as $result) {
                $TotalMark1 += $result['TotalMark1'];
                $TotalMark2 += $result['TotalMark2'];
                $TotalMark3 += $result['TotalMark3'];
                $TotalMark4 += $result['TotalMark4'];
                $TotalMark5 += $result['TotalMark5'];
        ?>
                <tr>
                    <td style="text-align:left;"><?= $result['Question']; ?></td>
                    <td style="text-align:center;"><?= $result['TotalMark1']; ?></td>
                    <td style="text-align:center;"><?= $result['TotalMark2']; ?></td>
                    <td style="text-align:center;"><?= $result['TotalMark3']; ?></td>
                    <td style="text-align:center;"><?= $result['TotalMark4']; ?></td>
                    <td style="text-align:center;"><?= $result['TotalMark5']; ?></td>

                </tr>
        <?php
            }
        }
        ?>
        <tr>
            <td style="text-align:right;">Total</td>
            <td style="text-align:center;"><?= $TotalMark1; ?></td>
            <td style="text-align:center;"><?= $TotalMark2; ?></td>
            <td style="text-align:center;"><?= $TotalMark3; ?></td>
            <td style="text-align:center;"><?= $TotalMark4; ?></td>
            <td style="text-align:center;"><?= $TotalMark5; ?></td>

        </tr>
    </table>

    <!-- <div style='page-break-after:always'>&nbsp;</div><br> -->

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