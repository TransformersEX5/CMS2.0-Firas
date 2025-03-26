<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>

<?php

$module = '/' . Yii::$app->controller->module->id;
$UserId = base64_decode(Yii::$app->request->get('UserId'));

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

$currentDate = new DateTime();
$currentDate = $currentDate->format('jS M Y');
list($day, $month, $year) = explode(' ', $currentDate);

$dayNumber = substr($day, 0, -2);
$ordinalIndicator = substr($day, -2);
$month = strtoupper($month);



// $mpdf->SetHTMLHeader('<div style="text-align: center; font-family: arial; color:#000; font-size: 14pt;  ">DATED ' . $dayNumber . '<sup>' . $ordinalIndicator . '</sup> THIS DAY OF ' . $month . ' ' . $year . '</div>');


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

// $TrainingId = $_GET['id'];



/************************************************************************************************************************************************* */


?>


<?php


$select = "SELECT 
* 
FROM tblusertest 
WHERE UserId = " . $UserId;
$result = \Yii::$app->db->createCommand($select)->queryAll();

$html = '';
$table1 = '';

?>

<style>
    body {
        font-family: Arial;
        font-size: 10px;
        margin-top: 0px;
        text-align: justify;
    }

    .table {
        font-family: Arial;
        font-size: 10px;
        color: #000;
        border-width: 1px;
        border-color: #666666;
        border-collapse: collapse;
    }

    .td-subject {
        font-family: Arial;
        font-size: 50pt;
        text-align: center;
        border: none;
    }

    .td-detail {
        font-family: Arial;
        font-size: 16pt;
        text-align: center;
        border: none;
    }

    .td-body {
        font-family: 'Times New Roman';
        font-size: 13pt;
        text-align: center;
        border: none;
    }

    .spacebar {
        line-height: 170%;
    }

    .justify {
        text-align: justify;
    }

    .center {
        text-align: center;
    }

    .vertical-top {
        width: 10%;
        vertical-align: top;
    }

    .bottom-border {
        text-align: right;
        padding: 5px;
        border-bottom: 2px solid black;
        /* Applying left border to specific cell */
    }

    .left-border {
        text-align: left;
        padding: 5px;
        border-left: 2px solid black;
        /* Applying left border to specific cell */
    }

    .custom-header {
        font-family: 'Times New Roman';
        font-size: 10px;
        position: absolute;
        left: 15px;
        top: 25px;
        padding: 10px;
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

    <br></br>

    <div class="custom-header">
        <i>Ref-Serial No.:EXT(IMO)/SO/<?= $result[0]['UserId']; ?>/<?= date("m"); ?>/<?= date("Y"); ?></i>
    </div>

    <table width="100%" class="spacebar table" border="0" style="border-collapse:collapse;">
        <tr>
            <td align="center">
                <div>
                    <?php
                    $imagePath = Yii::$app->request->baseUrl . '/image/city_u_logo.png';
                    echo Html::img($imagePath, ['width' => '45%']);
                    ?>
                </div>
            </td>
        </tr>

        <!-- <tr>
            <td class="td-subject" colspan="2">&nbsp;</td>
        </tr> -->

        <!-- <tr>
            <td class="td-subject" colspan="2">&nbsp;</td>
        </tr> -->

        <tr>
            <td align="center">
                <div>
                    <?php
                    $imagePath = Yii::$app->request->baseUrl . '/image/certificate_of_appointment.png';
                    echo Html::img($imagePath, ['width' => '100%']);
                    ?>
                </div>
            </td>
        </tr>

        <tr>
            <td class="td-subject" colspan="2">&nbsp;</td>
        </tr>

        <tr>
            <td class="td-body" style="font-size:16px;"><i>This is certified that</i></td>
        </tr>

        <tr>
            <td class="td-subject" colspan="2">&nbsp;</td>
        </tr>

        <tr>
            <td class="td-detail"><b><?= $result[0]['FullName']; ?></b></td>
        </tr>

        <tr>
            <td class="td-detail" colspan="2"><b>(Co Registration No.: <?= $result[0]['ICPassportNo']; ?>)</b></td>
        </tr>

        <tr>
            <td class="td-subject" colspan="2">&nbsp;</td>
        </tr>

        <tr>
            <td class="td-body" style="font-size:15.5px;"><i>Has the authority to advise, counsel, and assist in processing applications</i></td>
        </tr>

        <tr>
            <td class="td-body" style="font-size:15.5px;"><i>From qualified students for all programmes at</i></td>
        </tr>

        <tr>
            <td class="td-body" style="font-size:15.5px;"><i>City University of Malaysia</i></td>
        </tr>

        <tr>
            <td class="td-subject" colspan="2">&nbsp;</td>
        </tr>

        <tr>
            <td class="td-body" style="font-size:13px;"><i>This Appointment if for a period of One (1) year</i></td>
        </tr>

        <tr>
            <td class="td-body" style="font-size:13px;"><i>Effective from XXX 2023 until XXX 2023</i></td>
        </tr>

        <tr>
            <td class="td-subject" colspan="2">&nbsp;</td>
        </tr>

        <tr>
            <td class="td-subject" colspan="2">&nbsp;</td>
        </tr>

        <tr>
            <td class="td-subject" colspan="2">&nbsp;</td>
        </tr>

        <tr>
            <td align="center">
                <div>
                    <?php
                    $imagePath = Yii::$app->request->baseUrl . '/image/curved_line.png';
                    echo Html::img($imagePath, ['width' => '60%']);
                    ?>
                </div>
            </td>
        </tr>

        <tr>
            <td class="td-body" style="font-size:9px;"><b>Sara Oshaghi</b></td>
        </tr>

        <tr>
            <td class="td-body" style="font-size:11px;">Director</td>
        </tr>

        <tr>
            <td class="td-body" style="font-size:11px;">Marketing & Business Development</td>
        </tr>
    </table>
</body>


<img src="<?= Url::base() ?>/image/city_logo_white.png" style="display:block; margin:0 auto; width:20%; height:auto;">
<?php

date_default_timezone_set('Asia/Kuala_Lumpur');
$current_time = date('Y-m-d H:i:s');

$html = ob_get_contents();
ob_end_clean();



$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
?>