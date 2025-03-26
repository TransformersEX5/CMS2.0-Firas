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
        font-size: 10pt;
        margin-top: 0px;
        text-align: justify;
    }

    .table {
        font-family: Arial;
        font-size: 10pt;
        color: #000;
        border-width: 1px;
        border-color: #666666;
        border-collapse: collapse;
    }

    .td-subject {
        font-family: Arial;
        font-size: 18pt;
        text-align: center;
        border: none;
    }

    .td-caption {
        font-family: Arial;
        font-size: 10pt;
        text-align: center;
        border: none;
    }

    .td-body {
        font-family: Arial;
        font-size: 12pt;
        text-align: justify;
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

        <tr>
            <td class="td-subject" colspan="2">&nbsp;</td>
        </tr>

        <tr>
            <td class="td-subject" colspan="2">&nbsp;</td>
        </tr>

        <tr>
            <td class="td-subject">LETTER OF REPRESENTATION</td>
        </tr>

        <tr>
            <td class="td-caption">(To be taken, read and construed as an essential part of the Student Recruitment Agreement [ref-Serial No.: EXT(IMO)/SO/<?= $result[0]['UserId']; ?>/<?= date("m"); ?>/<?= date("Y"); ?>].</td>
        </tr>

        <tr>
            <td class="td-subject" colspan="2">&nbsp;</td>
        </tr>

        <tr>
            <td class="td-body">This is to certify that <b><?= $result[0]['FullName']; ?></b> ( <?= $result[0]['ICPassportNo']; ?> ) is the Representative of City University, Malaysia in CHINA. Its main duties are to represent City University, Malaysia, in particular, to prospect the recognized Universities, Colleges, and Schools leading to meetings and negotiations for the Senior High School to Degree program, Diploma transfer to a Degree program, Master programs, Doctoral programs, and Cultural Exchange program collaborations and recruitment; and subsequently, to coordinate the relevant collaborated programs.</td>
        </tr>

        <tr>
            <td class="td-subject" colspan="2">&nbsp;</td>
        </tr>

        <tr>
            <td class="td-subject" colspan="2">&nbsp;</td>
        </tr>

        <tr>
            <td class="td-body">This Appointment is for a period of one (1) year effective from xx Month 2023 until xx Month 2023.</td>
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
            <td class="td-subject" colspan="2">&nbsp;</td>
        </tr>

        <tr>
            <td class="td-body"><b>SARA OSHAGHI</b></td>
        </tr>

        <tr>
            <td class="td-body">Director</td>
        </tr>

        <tr>
            <td class="td-body">Marketing & Business Development</td>
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
                <?php
                $imagePath = Yii::$app->request->baseUrl . '/image/city_u_footer.png';
                echo Html::img($imagePath, ['height' => '8%']);
                ?>
            </td>
        </tr>
    </table>
</body>


<img src="<?= Url::base() ?>/image/city_logo_white.png" style="display:block; margin:0 auto; width:20%; height:auto;">
<?php

date_default_timezone_set('Asia/Kuala_Lumpur');
$current_time = date('Y-m-d H:i:s');

// $mpdf->SetHTMLHeader('
// <table width="100%" border="0" style="vertical-align: bottom; font-family: cambria; font-size: 10pt; color:#000; border-collapse:collapse;"><tr>
// <td width="94%" class="bottom-border">SERIAL NO.: EXT (IMO)/SO/' . $result[0]['UserId'] . ')/' . date('m') . '/' . $year . '</td>
// <td width="6%" class="bottom-border left-border">' . $year . '</td>
// </tr>
// </table>

// ');



// $mpdf->SetHTMLFooter('
// <table width="100%"><tr>
// <td align="center"><src img="' . Url::base() . '/image/city_logo_white.png" style="display:block; margin:0 auto; width:20%; height:auto;"></td>                                   
// </tr></table>
// ');


$html = ob_get_contents();
ob_end_clean();



$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
?>