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


//$TrainingTitle = $result[0]['TrainingTitle'];

//$result = $conn->query($select);
// foreach ($result as $result) {
//     $TrainingTitle =  $result['TrainingTitle'];
//     $TrainingObjective =  $result['TrainingObjective'];
// }


// function  getPaticipant($TrainingId)
// {

//     $paticipant = " SELECT
//     tbltrainingattandance.TrainingId,
//     tbluser.UserNo,
//     tbluser.FullName,
//     tbldepartment.DepartmentDesc
//     FROM
//     tbltrainingattandance
//     INNER JOIN tbluser ON tbltrainingattandance.UserId = tbluser.UserId
//     INNER JOIN tbldepartment ON tbluser.DepartmentId = tbldepartment.DepartmentId
//     where  tbltrainingattandance.TrainingId = $TrainingId
//     GROUP BY tbltrainingattandance.TrainingId,  tbltrainingattandance.UserId
//     ORDER BY tbluser.FullName ";

//     $result = \Yii::$app->db->createCommand($paticipant)->queryAll();

//     return $result;
// }





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

    .td-frontpage {
        font-family: Arial;
        font-size: 14pt;
        text-align: center;
        border: none;
    }

    .td-frontpageright {
        font-family: Arial;
        font-size: 14pt;
        text-align: right;
        width: 50%;
        border: none;
    }

    .td-frontpageleft {
        font-family: Arial;
        font-size: 14pt;
        text-align: left;
        width: 50%;
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
    <!-- <table width="100%" border="0">
        <tbody>
            <tr>
                <td align="left"><b>Training Detail</b></td>
            </tr>
        </tbody>
    </table> -->
    <?php
    //  foreach ($result as $result) {

    //     $TrainingTitle      = $result['TrainingTitle'];
    //     $TrainingObjective  =  $result['TrainingObjective'];
    //     $TrainingVenue      =  $result['TrainingVenue'];
    //     $TrainingStart      =  $result['TrainingStart'];
    //     $TrainingEnd        =  $result['TrainingEnd'];
    //     $TotDays            =  $result['TotDays'];
    //     $TotHours           =  $result['TotHours'];
    //     $TotStaff           =  $result['TotStaff'];
    //     $TrainingCategory   =  $result['TrainingCategory'];
    //     $TrainingClaim      =  $result['TrainingClaim'];
    //     $TrainingStatus     =  $result['TrainingStatus'];
    //     $TrainingGroup      =  $result['TrainingGroup'];
    //     $TransactionDate      =  $result['TransactionDate'];

    //     $Remarks            =  $result['Remarks'];


    // } 
    ?>

    <br></br>

    <table width="100%" class="spacebar table" border="1" style="border-collapse:collapse;">
        <tr>
            <td>
                <table width="100%" class="spacebar table" border="1" style="border-collapse:collapse;">
                    <tr>
                        <td class="td-frontpage" colspan="2">DATED <?= $dayNumber; ?><sup><?= $ordinalIndicator; ?></sup> THIS DAY OF <?= $month . ' ' . $year; ?></td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2">Between</td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2"><b>EYE KNOWLEDGE SDN BHD</b></td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2"><b>(Company No: 1299755-A)</b></td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2">and</td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2"><b><?= $result[0]['FullName']; ?></b></td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="td-frontpageright"><b>Contact Person:</b></td>
                        <td class="td-frontpageleft"><b><?= $result[0]['AgentPIC']; ?></b></td>
                    </tr>

                    <tr>
                        <td class="td-frontpageright"><b>Contact No:</b></td>
                        <td class="td-frontpageleft"><b><?= $result[0]['HandSetNo']; ?></b></td>
                    </tr>

                    <tr>
                        <td class="td-frontpageright"><b>Co. Registration No.:</b></td>
                        <td class="td-frontpageleft"><b><?= $result[0]['ICPassportNo']; ?></b></td>
                    </tr>

                    <tr>
                        <td class="td-frontpageright"><b>Email:</b></td>
                        <td class="td-frontpageleft"><b><?= $result[0]['EmailAddress']; ?></b></td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2">
                            <hr>
                            </hr>
                        </td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2"><b>STUDENT RECRUITMENT AGREEMENT YEAR <?= $year; ?></b></td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2">
                            <hr>
                            </hr>
                        </td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="td-frontpage" colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td colspan="2" style="text-align:right; font-size:9px; border:none;">1st Revision: <?= date('d/m/Y'); ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <pagebreak>

        <br>

        <b>STUDENT RECRUITMENT AGREEMENT</b>
        <br><br>
        <b>BETWEEN</b>
        <br><br>
        <b>EYE KNOWLEDGE SDN BHD</b> (Company No: 1299755-A) (hereinafter referred to as “<b>EYE</b>”) a company incorporated in Malaysia and having its business address in Menara CITY U, No. 8, Jalan 51A/223, 46100 Petaling Jaya, Selangor Darul Ehsan, Malaysia, of <b>ONE PART</b>.
        <br><br>
        <b>AND</b>
        <br><br>
        <b><?= $result[0]['FullName']; ?></b> (hereinafter referred to as “<b>The Agent</b>”), an agent having its correspondence address <?= $result[0]['AgentBusinessAddress']; ?>, whose principal business is recruiting students to education institutions overseas, of the <b>OTHER PART</b>.
        <br><br>

        <table width="100%" class="spacebar table" border="0" style="border-collapse:collapse;">
            <tr>
                <th style="text-align: left;" colspan="2">RECITALS</th>
            </tr>
            <tr>
                <td class="vertical-top">A.</td>
                <td class="justify">EYE is a company specializing in recruiting students for universities and colleges and EYE has the rights to recruit and/or to appoint any agency or company to recruit students on its behalf subject to the terms and conditions as stipulated by EYE from time to time.</td>
            </tr>

            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>

            <tr>
                <td class="vertical-top">B.</td>
                <td class="justify">The Agent is desirous to be a marketing agent on non-exclusive basis for EYE to recruit students for the benefit of universities or colleges as determined by EYE at its absolute discretion.</td>
            </tr>

            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>

            <tr>
                <td class="vertical-top">C.</td>
                <td class="justify">EYE is desirous to appoint The Agent as <b>EYE</b> Preferred (“Main”) <b>MARKETING AGENT</b> in students’ recruitment for universities and/or colleges as instructed and notified by EYE from time to time, subject to the following terms and conditions of this Agreement: -</td>
            </tr>
        </table>

        <br>

        <table width="100%" class="spacebar table" border="0" style="border-collapse:collapse;">
            <tr>
                <th style="text-align: left;" colspan="2">OPERATIVE PART</th>
            </tr>
            <tr>
                <td class="vertical-top">1.0</td>
                <td class="justify"><b>Commencement and Terms of Agreement</b></td>
            </tr>

            <tr>
                <td class="vertical-top">1.1</td>
                <td class="justify">This Agreement will commence from the <b>???</b> and remain in force for a period of <b>ONE (1) Year</b>, unless renewed or terminated by either party giving the other party of not less than <b>SIX (6) months</b> period of written notice prior to expiring at the end of the initial period of one year. For the purposes of this agreement, <b>ONE</b> year shall mean continuous calendar year immediately from the effective commencement date of this Agreement.</td>
            </tr>

            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>

            <tr>
                <td class="vertical-top">1.2</td>
                <td class="justify">Upon termination of this Agreement and at the written request of EYE, The Agent shall forthwith cease carrying on all business in relation to this Agreement AND within seven (7) days from the date of notice to terminate and return all promotion and other materials provided by EYE under this Agreement.</td>
            </tr>

            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>

            <tr>
                <td class="vertical-top">1.3</td>
                <td class="justify">1.3 Both parties agree that students whose applications are being processed at the time of termination of this Agreement will continue to be supported until the process has been successfully concluded.</td>
            </tr>

            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>

            <tr>
                <td class="vertical-top">1.4</td>
                <td class="justify">1.4 This Agreement may be reviewed no later than <b>SIX (6) months</b> prior to expiry of the Agreement and may be renewed subject to mutual agreement between the parties.</td>
            </tr>
        </table>

        <pagebreak>

            <table width="100%" class="spacebar table" border="0" style="border-collapse:collapse;">
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>

                <tr>
                    <td class="vertical-top">2.0</td>
                    <td class="justify"><b>The Agent’s Responsibilities</b><br>The Agent shall:</td>
                </tr>

                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>

                <tr>
                    <td class="vertical-top">2.1</td>
                    <td class="justify">Actively promote universities and/or colleges as instructed and notified by EYE and the Agent shall recruit suitably qualified students across the broad range of courses offered by said university’s and/or colleges as instructed and notified by EYE, provided always and on condition that the courses are approved by the relevant Malaysian authorities to accept students.</td>
                </tr>

                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>

                <tr>
                    <td class="vertical-top">2.2</td>
                    <td class="justify">Attend to inquiries from prospective students by providing true and accurate information about the courses available at universities and/or colleges as instructed by EYE from time to time and where appropriate, provide counseling to prospective students about the courses and relevant admission criteria for the universities and/or colleges as instructed by EYE.</td>
                </tr>

                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>

                <tr>
                    <td class="vertical-top">2.3</td>
                    <td class="justify">Assist students to comply with formal requirements involved in applying for admission to the relevant courses, processing of application forms, forwarding completed applications to EYE.</td>
                </tr>

                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>

                <tr>
                    <td class="vertical-top">2.4</td>
                    <td class="justify">Ensure that its actions pursuant to this Agreement are conducted in a professional and ethical business-like manner. The Agent irrevocably agrees not to undertake any activity that may adversely affect the reputation, integrity or goodwill of EYE or the associated university’s and/or colleges as instructed and notified by EYE in any manner whatsoever and having regard to the best interest or EYE and the international students or which may damage the good name or reputation of EYE or any person or body employed by or acting on behalf or EYE.</td>
                </tr>

                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>

                <tr>
                    <td class="vertical-top">2.5</td>
                    <td class="justify">Use EYE’s trademarks, trade names and service marks for the purpose of this Agreement (hereinafter referred to as “<b>the Trademarks</b>”) subject to EYE’s prior written consent, on a non-exclusive basis in the Territory only for the duration of this Student Recruitment Agreement and solely for display or advertising purposes in connection with the selling and distributing of the Products in accordance with this Student Recruitment Agreement.</td>
                </tr>

                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>

                <tr>
                    <td class="vertical-top">2.6</td>
                    <td class="justify">Not at any time do or permit any act to be done which may in any way impair the rights of EYE in the Trademarks.</td>
                </tr>

                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>

                <tr>
                    <td class="vertical-top">2.7</td>
                    <td class="justify">Administer and co-ordinate applications for the admissions submitted by prospective students.</td>
                </tr>

                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>

                <tr>
                    <td class="vertical-top">2.8</td>
                    <td class="justify">To comply with the regulations and rules as set up by EYE in accordance with Ministry of Higher Education of Malaysia, Malaysia Qualification Agency and the Government of Malaysia.</td>
                </tr>

                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>

                <tr>
                    <td class="vertical-top">2.9</td>
                    <td class="justify">Furnish EYE with true and accurate reports on the progress and performance of the marketing and recruiting services (total student number recruited) in the Territory every 6 (six) months duration.</td>
                </tr>

            </table>

            <pagebreak>

                <table width="100%" class="spacebar table" border="0" style="border-collapse:collapse;">
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="vertical-top">2.10</td>
                        <td class="justify">Market and recruit students strictly in accordance with the terms and conditions of this Agreement in the territory (hereinafter referred to as “Territory”) as described below:</td>
                    </tr>

                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td style="text-align:center;" colspan="2"><b>(a)</b> Non-exclusive Territory in ??? <b>(Schedule A and Schedule B)</b></td>
                    </tr>

                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="vertical-top">3.0</td>
                        <td class="justify"><b>EYE’s Responsibilities and Rights</b><br>EYE shall:</td>
                    </tr>

                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="vertical-top">3.1</td>
                        <td class="justify"><b>Provide accurate course</b> information, payment <b>policies</b>, promotional materials, information brochures and other relevant documentation of the universities and/or colleges to The Agent for use in accordance with the terms of this Agreement.</td>
                    </tr>

                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="vertical-top">3.2</td>
                        <td class="justify">Provide regular communication with The Agent via Newsletter or through any other means regarding the EYE policies and initiatives being or to be implemented at any time.</td>
                    </tr>

                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="vertical-top">3.3</td>
                        <td class="justify">Arrange for the transportation in picking up the students from the Airport upon their arrival at KLIA/LCCT.</td>
                    </tr>

                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="vertical-top">3.4</td>
                        <td class="justify">Facilitate and service the needs of the students and monitor the learning progress and the well being of the students in accordance with the universities and/or colleges’ operating rules, practices and procedures.</td>
                    </tr>

                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="vertical-top">3.5</td>
                        <td class="justify">Process applications and queries from students in an efficient and timely manner and promptly notify The Agent of the acceptance or rejection of applications referred to EYE by The Agent.</td>
                    </tr>

                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="vertical-top">3.6</td>
                        <td class="justify">Shall support in any of The Agent’s marketing activities either in terms of financial or manpower support provided this has been agreed by EYE in writing at The Agent’s requests and subject to EYE reserving all its rights and obligations to participate or otherwise. All proposals for marketing activities must be submitted by the Agent to EYE within fourteen (14) workings for approval.</td>
                    </tr>

                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="vertical-top">4.0</td>
                        <td class="justify"><b>Financial Arrangement.</b></td>
                    </tr>

                    <tr>
                        <td class="vertical-top">4.1</td>
                        <td class="justify">The financial arrangements between the parties shall be transparent and associated universities as instructed and notified by EYE. fee(s) set out in <b>Schedule A & Schedule B</b>. EYE shall be entitled to amend such fee(s) annually by written notice to The Agent.</td>
                    </tr>
                </table>

                <pagebreak>

                    <table width="100%" class="spacebar table" border="0" style="border-collapse:collapse;">
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>

                        <tr>
                            <td class="vertical-top">5.0</td>
                            <td class="justify"><b>Notice</b></td>
                        </tr>

                        <tr>
                            <td class="vertical-top">5.1</td>
                            <td class="justify">Any notice or other communication to be given hereunder shall be sent to the registered office of the parties hereto by registered airmail, by facsimile or e-mail.<br>The notices shall be deemed to be delivered when sent if transmitted by facsimile (receipt confirmed) during normal business hours of the recipient or if posted by fourteen (14) days after the date upon the registration receipt provided by the relevant postal authority or confirmation by telephone contact between senior officers of the parties concerned.</td>
                        </tr>

                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>

                        <tr>
                            <td class="vertical-top">6.0</td>
                            <td class="justify"><b>Miscellaneous</b></td>
                        </tr>

                        <tr>
                            <td class="vertical-top">6.1</td>
                            <td class="justify">Nothing in this Agreement shall be constructed as granting or conferring on The Agent any rights by way of license or otherwise whether expressed or implied, with respect to any material provided by EYE under this Agreement.</td>
                        </tr>

                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>

                        <tr>
                            <td class="vertical-top">6.2</td>
                            <td class="justify">The Agent shall not assign, or support to agree to assign this Agreement or all or any rights hereunder without the prior written approval of EYE.</td>
                        </tr>

                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>

                        <tr>
                            <td class="vertical-top">6.3</td>
                            <td class="justify">The Agent has no power to pledge the credit of EYE, nor purport to enter into any contract on behalf of EYE. The relationship between The Agent and EYE shall not be construed to be that of employer and employee, nor a partnership, joint venture or agency of any kind, and both parties agree not to engage in any conduct which would allow a third party to assert that the relationship of the parties was that of employer and employee, or a partnership, joint venture or agency of any kind.</td>
                        </tr>

                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>

                        <tr>
                            <td class="vertical-top">6.4</td>
                            <td class="justify">EYE shall continue to appoint any other person, firm or company as EYE’s representative in the Territory assigned to The Agent for the promotion and introduction of students to EYE on a non-exclusive basis.</td>
                        </tr>

                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>

                        <tr>
                            <td class="vertical-top">6.5</td>
                            <td class="justify">Any dispute or difference between the parties resulting from the Agreement that cannot be resolved by consultation between the parties shall be referred to a mutually acceptable independent mediator.</td>
                        </tr>

                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>

                        <tr>
                            <td class="vertical-top">6.6</td>
                            <td class="justify">This Agreement shall be governed by, and construed in accordance with, the laws of Malaysia and any laws which may be applicable to EYE and the parties:-</td>
                        </tr>

                        <tr>
                            <td>
                            </td>
                            <td>
                                <table width="100%" class="spacebar table" border="0" style="border-collapse:collapse;">
                                    <tr>
                                        <td class="vertical-top">(a)</td>
                                        <td class="justify">irrevocably submit to the exclusive jurisdictions of the Courts of Malaysia;</td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td class="vertical-top">(b)</td>
                                        <td class="justify">waive any objection on the grounds of venue or forum of convenience or any similar grounds; and</td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td class="vertical-top">(c)</td>
                                        <td class="justify">consent to service of legal process in respect of any matter arising out of this Agreement by forwarding a copy of such legal process by prepaid registered post to their last known address or in any other manner permitted by the relevant law.</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>

                    <pagebreak>

                        <table width="100%" class="spacebar table" border="0" style="border-collapse:collapse;">
                            <tr>
                                <td colspan="2">&nbsp;</td>
                            </tr>

                            <tr>
                                <td class="vertical-top">6.7</td>
                                <td class="justify">EYE reserves all rights and privileges to amend alter and change the terms and conditions of this Agreement from time to time. Any additions, changes or modifications to this Agreement shall be communicated in writing to the Agent.</td>
                            </tr>

                            <tr>
                                <td colspan="2">&nbsp;</td>
                            </tr>

                            <tr>
                                <td class="vertical-top">6.8</td>
                                <td class="justify">EYE reserves all rights and privileges to amend alter and change the terms and conditions of this Agreement from time to time. Any additions, changes or modifications to this Agreement shall be communicated in writing to the Agent.</td>
                            </tr>

                            <tr>
                                <td colspan="2">&nbsp;</td>
                            </tr>

                            <tr>
                                <td class="vertical-top">6.9</td>
                                <td class="justify">The Agent shall be solely liable for failure to abide by the rules and regulations of all relevant authorities and Immigration Department of countries concerned in this Agreement in carrying out recruitment of students to study in Malaysia.</td>
                            </tr>

                            <tr>
                                <td colspan="2">&nbsp;</td>
                            </tr>

                            <tr>
                                <td class="vertical-top">6.10</td>
                                <td class="justify">The Agent shall indemnify and agrees to keep indemnified EYE from and against any and all expense, loss, damage or liability (whether criminal or civil) suffered and legal or other fees incurred by EYE resulting from any breach of this Agreement or any wrongful or negligent act or omission and commission by the Agent.</td>
                            </tr>

                            <tr>
                                <td colspan="2">&nbsp;</td>
                            </tr>

                            <tr>
                                <td class="vertical-top">6.11</td>
                                <td class="justify">Time wherever mentioned is the essence of this Agreement.</td>
                            </tr>

                            <tr>
                                <td colspan="2">&nbsp;</td>
                            </tr>

                            <tr>
                                <td class="vertical-top">6.12</td>
                                <td class="justify">The Agent hereby agrees to indemnify the universities and/or colleges which have recruited or intend to recruit students from The Agent against any claims, costs, damages, fines or penalty (if any) which may be brought suffered or levied against EYE or The Agent as a result of EYE or the Agent’s non-compliance with any of the provisions of the Agreement or laws relating to this Agreement.</td>
                            </tr>

                            <tr>
                                <td colspan="2">&nbsp;</td>
                            </tr>

                            <tr>
                                <td class="vertical-top">7.0</td>
                                <td class="justify"><b>Termination</b></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td class="justify">The Agreement shall be terminable on <b>FOURTEEN (14) days’</b> notice in the event of material breach or insolvency, and shall also terminate in the event that the Agent loses its credibility, business and academic ethics, or failures to meet the academic standards, rules and regulations of the authorities and laws of the country.</td>
                            </tr>

                            <tr>
                                <td colspan="2">&nbsp;</td>
                            </tr>

                            <tr>
                                <td class="vertical-top">8.0</td>
                                <td class="justify"><b>Arbitration</b></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td class="justify">However, any disputes or disagreements arising from the interpretations of this Agreement, which affects the flow or operations of this Agreement, which in the opinion of either Party – becomes unreasonable or is inequitable, the Parties hereby agree to resolve the issue amicably, in the first instance. If the subsequent negotiation failed, the Parties hereby agree to appoint a reputable Arbitrator that is acceptable to both Parties to resolve the disagreements or disputes with arbitration costs divided equally between Parties.</td>
                            </tr>

                            <tr>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                        </table>

                        <pagebreak>

                            <table width="100%" class="spacebar table" border="0" style="border-collapse:collapse;">
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td class="vertical-top">9.0</td>
                                    <td class="justify"><b>Confidentiality</b></td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td class="justify">Each party hereto undertakes to treat all information relating to the business of the other as confidential except in so far as may be necessary for the performance of any obligations of this Agreement or to the extend that such information is generally available to the public or is required to be disclosed by any fiscal authority or by legal process. Both EYE and the Agent agree that this obligation shall continue in force not withstanding the termination of this Agreement for any reason.</td>
                                </tr>

                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td class="vertical-top">10.0</td>
                                    <td class="justify"><b>Costs</b></td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td class="justify">Each party shall respectively bear their own legal or other professional costs incidental to the preparation and completion of this Agreement. The stamp duties payable in respect of this Agreement shall be borne and paid by the Agent.</td>
                                </tr>

                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td class="vertical-top">11.0</td>
                                    <td class="justify"><b>Mutual Trust & Goodwill</b></td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td class="justify">This Agreement shall not be reassigned, transferred or disposed of all or part of its interests without the prior written consent of the other Parties, which the other Parties will have an absolute discretion to grant their consent.<br><br>That in accordance with good faith and mutual trust, any difficulty which arises that is detrimental to one or all Parties concerned after the signing of this Agreement, the Parties hereby declare that the Agreement shall operate between them with fairness and without detriment to either one of them. In the event of inequitable hardships to either Party contrary to the spirit of the Agreement arising, the Parties shall immediately negotiate in good will and with best endeavors to remove such causes of inequity or hardships.</td>
                                </tr>

                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td class="vertical-top">12.0</td>
                                    <td class="justify"><b>Successors</b></td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td class="justify">This Agreement shall be binding upon the respective heirs, personal representatives and successors-in –title of the Agent and the University.</td>
                                </tr>

                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td class="center" colspan="2"><i>(The rest of the page has been intentionally left blank)</i></td>
                                </tr>
                            </table>

                            <pagebreak>

                                <br>

                                <b>IN WITNESS WHEREOF</b> the parties hereto have hereunto set their hands the day and year first above written.<br><br>

                                <br><br><br><br>

                                <table width="100%" class="spacebar table" border="0" style="border-collapse:collapse;">
                                    <tr>
                                        <td width="60%">Signed by</td>
                                        <td width="40%">)</td>
                                    </tr>

                                    <tr>
                                        <td>for and on behalf of</td>
                                        <td>)</td>
                                    </tr>

                                    <tr>
                                        <td><b>EYE KNOWLEDGE SDN BHD</b></td>
                                        <td>)</td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>)</td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>)_____________________________________</td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>Name:</td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>NRIC No.:</td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td>In the presence of: -</td>
                                        <td>_____________________________________</td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>Name of Witness:</td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>NRIC No.:</td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td>Signed by</td>
                                        <td>)</td>
                                    </tr>

                                    <tr>
                                        <td>for and on behalf of</td>
                                        <td>)</td>
                                    </tr>

                                    <tr>
                                        <td><b><?= $result[0]['FullName']; ?></b></td>
                                        <td>)</td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>)_____________________________________</td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>Name:</td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>Passport/NRIC No.:</td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td>In the presence of: -</td>
                                        <td>_____________________________________</td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>Name of Witness:</td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>Passport/NRIC No.:</td>
                                    </tr>
                                </table>

                                <pagebreak>

                                    <br>
                                    <div style="font-size:12px;" class="center"><b><u>SCHEDULE A</u></b></div>
                                    <br>
                                    <div style="font-size:12px;" class="center"><i>(To be taken, read and construed as an essential part of this Agreement)</i></div>
                                    <br><br>

                                    <table width="100%" class="spacebar table" border="0" style="border-collapse:collapse;">
                                        <tr>
                                            <td class="vertical-top"><b>1.0</b></td>
                                            <td colspan="4" class="justify"><b>Preamble</b></td>
                                        </tr>

                                        <tr>
                                            <td colspan="4">&nbsp;</td>
                                        </tr>

                                        <tr>
                                            <td class="vertical-top">1.1</td>
                                            <td colspan="3" class="justify">This <b>SCHEDULE A</b> shall form and be read as part of the Agreement (between the AGENT and EYE). It relates to the recruitment of students for programs offered by EYE, which would assist in meeting the objective of the co-operative and strategic alliance, founded on the Agreement.</td>
                                        </tr>

                                        <tr>
                                            <td colspan="4">&nbsp;</td>
                                        </tr>

                                        <tr>
                                            <td class="vertical-top"><b>2.0</b></td>
                                            <td colspan="3" class="justify"><b>Referral Fee for International students recruited (Within ??? or from Origin countries):</b></td>
                                        </tr>

                                        <tr>
                                            <td colspan="4">&nbsp;</td>
                                        </tr>

                                        <tr>
                                            <td></td>
                                            <td colspan="3" class="justify">For the calendar year of <b><?= $year; ?></b>, students successfully recruited by the AGENT and accepted by EYE, the referral fee shall be as follows: -</td>
                                        </tr>

                                        <tr>
                                            <td colspan="4">&nbsp;</td>
                                        </tr>

                                        <tr>
                                            <td></td>
                                            <td colspan="3">
                                                <table width="100%" border="1" style="border-collapse:collapse;">
                                                    <tr>
                                                        <td class="center"><b>No.</b></td>
                                                        <td class="center"><b>Programmes</b></td>
                                                        <td class="center"><b>Commission (RM)</b></td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center"><b>1.</b></td>
                                                        <td><b>FOUNDATION</b></td>
                                                        <td class="center"><b>RM 5,000.00</b></td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center"><b>2.</b></td>
                                                        <td><b>DIPLOMA</b></td>
                                                        <td class="center"><b>RM 5,000.00</b></td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center"><b>3.</b></td>
                                                        <td><b>BACHELORS</b></td>
                                                        <td class="center"><b>RM 10,000.00</b></td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center"><b>4.</b></td>
                                                        <td><b>MASTERS</b></td>
                                                        <td class="center"><b>RM 12,000.00</b></td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center"><b>5.</b></td>
                                                        <td><b>DOCTORATE</b></td>
                                                        <td class="center"><b>RM 12,000.00</b></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="4">&nbsp;</td>
                                        </tr>

                                        <tr>
                                            <td class="vertical-top"><b>3.0</b></td>
                                            <td colspan="3" class="justify"><b>Payment Term</b></td>
                                        </tr>

                                        <tr>
                                            <td colspan="4">&nbsp;</td>
                                        </tr>

                                        <tr>
                                            <td></td>
                                            <td class="vertical-top">3.1</td>
                                            <td colspan="2" class="justify">The payment of the said <b>FULL</b> commission shall be paid upon <b>ONE YEAR TUITION FEES</b> that paid by the students.</td>
                                        </tr>

                                        <tr>
                                            <td colspan="4">&nbsp;</td>
                                        </tr>

                                        <tr>
                                            <td class="vertical-top"><b>4.0</b></td>
                                            <td colspan="3" class="justify"><b>Condition of Payment</b></td>
                                        </tr>

                                        <tr>
                                            <td></td>
                                            <td class="vertical-top">4.1</td>
                                            <td colspan="2" class="justify">Subject to the other provisions of this clause, each student provided, the student/s: -</td>
                                        </tr>

                                        <tr>
                                            <td colspan="2"></td>
                                            <td class="vertical-top">a)</td>
                                            <td class="justify">Is/are directly recruited by the agent;</td>
                                        </tr>

                                        <tr>
                                            <td colspan="2"></td>
                                            <td class="vertical-top">b)</td>
                                            <td class="justify">Is/are enrolled in a course;</td>
                                        </tr>

                                        <tr>
                                            <td colspan="2"></td>
                                            <td class="vertical-top">c)</td>
                                            <td class="justify">Has/have paid the course fees (as determined in the fee schedule) as directed by EYE as outlined in Article 4.3 below;</td>
                                        </tr>

                                        <tr>
                                            <td colspan="2"></td>
                                            <td class="vertical-top">d)</td>
                                            <td class="justify">Has/have commenced the course he/they have registered for; and</td>
                                        </tr>

                                        <tr>
                                            <td colspan="2"></td>
                                            <td class="vertical-top">e)</td>
                                            <td class="justify">Has/have not been refunded the full course fee paid subsequent to commencing the Course. (i.e has/have not withdrawn from the course within the 2 weeks from the commencement date).</td>
                                        </tr>

                                        <tr>
                                            <td colspan="4">&nbsp;</td>
                                        </tr>

                                        <tr>
                                            <td></td>
                                            <td class="vertical-top">4.2</td>
                                            <td colspan="2" class="justify">An agent is regarded as having recruited a student under this agreement if the Agent submits the student’s application for enrolment and the application also bears the Agent’s name;</td>
                                        </tr>

                                    </table>

                                    <pagebreak>

                                        <table width="100%" class="spacebar table" border="0" style="border-collapse:collapse;">
                                            <tr>
                                                <td colspan="2">&nbsp;</td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td class="vertical-top">4.3</td>
                                                <td colspan="2" class="justify">No Agent’s commission is payable unless the Agent has submitted an invoice in a form approved by EYE, which includes the student’s name, student’s ID number, the course undertaken by the student, commencement date and total payment made to the associated university’s as instructed and notified by EYE;</td>
                                            </tr>

                                            <tr>
                                                <td colspan="4">&nbsp;</td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td class="vertical-top">4.4</td>
                                                <td colspan="2" class="justify">For each individual student enrolled at EYE, following recommendation by the Agent, EYE shall pay the Agent an agreed fee based on the Article 2.0 of this SCHEDULE A above, fourteen (14) working days after the student has enrolled at the associated university’s and/or colleges as instructed and notified by EYE; and with due regard to Article 3.0 and 4.0 above</td>
                                            </tr>

                                            <tr>
                                                <td colspan="4">&nbsp;</td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td class="vertical-top">4.5</td>
                                                <td colspan="2" class="justify">EYE agrees to refund the tuition fee and any other fee received from the Agent (less administration fee and in accordance with the EYE Refund policy) if the student is refused the final visa application by the authorities concerned;</td>
                                            </tr>

                                            <tr>
                                                <td colspan="4">&nbsp;</td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td class="vertical-top">4.6</td>
                                                <td colspan="2" class="justify">4.6 EYE reserves the right to refuse a student’s application if there is/are justifiable reason/s to do so at the sole discretion of EYE.</td>
                                            </tr>

                                            <tr>
                                                <td colspan="4">&nbsp;</td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td class="vertical-top">4.7</td>
                                                <td colspan="2" class="justify">EYE will not pay commission: -</td>
                                            </tr>

                                            <tr>
                                                <td colspan="2"></td>
                                                <td class="vertical-top">a)</td>
                                                <td class="justify">If agent does not indicate on the Application Form that they represent the student;</td>
                                            </tr>

                                            <tr>
                                                <td colspan="2"></td>
                                                <td class="vertical-top">b)</td>
                                                <td class="justify">If the student/s withdraw/s from his/their course of study within the official refund period; OR</td>
                                            </tr>

                                            <tr>
                                                <td colspan="2"></td>
                                                <td class="vertical-top">c)</td>
                                                <td class="justify">If the student/s has/have already submitted an application form to EYE or the student/s applies/apply to enroll directly to EYE.</td>
                                            </tr>

                                            <tr>
                                                <td colspan="4">&nbsp;</td>
                                            </tr>

                                            <tr>
                                                <td class="vertical-top"><b>5.0</b></td>
                                                <td colspan="3" class="justify"><b>Costs</b></td>
                                            </tr>

                                            <tr>
                                                <td colspan="4">&nbsp;</td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td colspan="3" class="justify">The solicitors’ fees, stamp duty and such other disbursements payable (if applicable) for the preparation of this Agreement should be borne and paid by the AGENT.</td>
                                            </tr>

                                            <tr>
                                                <td colspan="4">&nbsp;</td>
                                            </tr>

                                            <tr>
                                                <td class="center" colspan="4"><i>(The rest of the page has been intentionally left blank)</i></td>
                                            </tr>


                                        </table>

                                        <pagebreak>

                                            <br>
                                            <div style="font-size:12px;" class="center"><b><u>SCHEDULE B</u></b></div>
                                            <br>
                                            <div style="font-size:12px;" class="center"><i>(To be taken, read and construed as an essential part of this Agreement)</i></div>
                                            <br><br>

                                            <table width="100%" class="spacebar table" border="0" style="border-collapse:collapse;">
                                                <tr>
                                                    <td class="vertical-top"><b>5.0</b></td>
                                                    <td colspan="4" class="justify"><b>Preamble</b></td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4">&nbsp;</td>
                                                </tr>

                                                <tr>
                                                    <td class="vertical-top">5.1</td>
                                                    <td colspan="3" class="justify">This <b>SCHEDULE B</b> shall form and be read as part of the Agreement (between the AGENT and EYE). It relates to the recruitment of students for programs offered by EYE, which would assist in meeting the objective of the co-operative and strategic alliance, founded on the Agreement.</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4">&nbsp;</td>
                                                </tr>

                                                <tr>
                                                    <td class="vertical-top"><b>6.0</b></td>
                                                    <td colspan="4" class="justify"><b>Referral Fee for International students recruited (Within ??? or from Origin countries):</b></td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4">&nbsp;</td>
                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td colspan="3" class="justify">For the calendar year of <b><?= $year; ?></b>, students successfully recruited by the AGENT and accepted by EYE, the referral fee shall be as follows: -</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4">&nbsp;</td>
                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td colspan="3">
                                                        <table width="100%" border="1" style="border-collapse:collapse;">
                                                            <tr>
                                                                <td class="center"><b>No.</b></td>
                                                                <td class="center"><b>Programmes</b></td>
                                                                <td class="center"><b>Commission (RM)</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="center"><b>1.</b></td>
                                                                <td><b>CLC 3 months</b></td>
                                                                <td class="center"><b>RM 500.00</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="center"><b>2.</b></td>
                                                                <td><b>CLC 6 months</b></td>
                                                                <td class="center"><b>RM 1,000.00</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="center"><b>3.</b></td>
                                                                <td><b>CLC 9 months</b></td>
                                                                <td class="center"><b>RM 1,500.00</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="center"><b>4.</b></td>
                                                                <td><b>CLC 12 months</b></td>
                                                                <td class="center"><b>RM 3,000.00</b></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4">&nbsp;</td>
                                                </tr>

                                                <tr>
                                                    <td class="vertical-top"><b>7.0</b></td>
                                                    <td colspan="4" class="justify"><b>Payment Term</b></td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4">&nbsp;</td>
                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td class="vertical-top">7.1</td>
                                                    <td colspan="2" class="justify">The payment of the said <b>FULL</b> commission shall be paid upon <b>ONE YEAR TUITION FEES</b> that paid by the students.</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4">&nbsp;</td>
                                                </tr>

                                                <tr>
                                                    <td class="vertical-top"><b>8.0</b></td>
                                                    <td colspan="4" class="justify"><b>Condition of Payment</b></td>
                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td class="vertical-top">4.1</td>
                                                    <td colspan="2" class="justify">Subject to the other provisions of this clause, each student provided, the student/s: -</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td class="vertical-top">f)</td>
                                                    <td class="justify">Is/are directly recruited by the agent;</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td class="vertical-top">g)</td>
                                                    <td class="justify">Is/are enrolled in a course;</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td class="vertical-top">h)</td>
                                                    <td class="justify">Has/have paid the course fees (as determined in the fee schedule) as directed by EYE as outlined in Article 4.3 below;</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td class="vertical-top">i)</td>
                                                    <td class="justify">Has/have commenced the course he/they have registered for; and</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td class="vertical-top">j)</td>
                                                    <td class="justify">Has/have not been refunded the full course fee paid subsequent to commencing the Course. (i.e has/have not withdrawn from the course within the 2 weeks from the commencement date).</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4">&nbsp;</td>
                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td class="vertical-top">4.2</td>
                                                    <td colspan="2" class="justify">An agent is regarded as having recruited a student under this agreement if the Agent submits the student’s application for enrolment and the application also bears the Agent’s name;</td>
                                                </tr>

                                            </table>

                                            <pagebreak>

                                                <table width="100%" class="spacebar table" border="0" style="border-collapse:collapse;">

                                                    <tr>
                                                        <td colspan="4">&nbsp;</td>
                                                    </tr>

                                                    <tr>
                                                        <td></td>
                                                        <td class="vertical-top">4.8</td>
                                                        <td colspan="2" class="justify">No Agent’s commission is payable unless the Agent has submitted an invoice in a form approved by EYE, which includes the student’s name, student’s ID number, the course undertaken by the student, commencement date and total payment made to the associated university’s as instructed and notified by EYE;</td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="4">&nbsp;</td>
                                                    </tr>

                                                    <tr>
                                                        <td></td>
                                                        <td class="vertical-top">4.9</td>
                                                        <td colspan="2" class="justify">For each individual student enrolled at EYE, following recommendation by the Agent, EYE shall pay the Agent an agreed fee based on the Article 2.0 of this SCHEDULE A above, fourteen (14) working days after the student has enrolled at the associated university’s and/or colleges as instructed and notified by EYE; and with due regard to Article 3.0 and 4.0 above</td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="4">&nbsp;</td>
                                                    </tr>

                                                    <tr>
                                                        <td></td>
                                                        <td class="vertical-top">4.10</td>
                                                        <td colspan="2" class="justify">EYE agrees to refund the tuition fee and any other fee received from the Agent (less administration fee and in accordance with the EYE Refund policy) if the student is refused the final visa application by the authorities concerned;</td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="4">&nbsp;</td>
                                                    </tr>

                                                    <tr>
                                                        <td></td>
                                                        <td class="vertical-top">4.11</td>
                                                        <td colspan="2" class="justify">EYE reserves the right to refuse a student’s application if there is/are justifiable reason/s to do so at the sole discretion of EYE.</td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="4">&nbsp;</td>
                                                    </tr>

                                                    <tr>
                                                        <td></td>
                                                        <td class="vertical-top">4.12</td>
                                                        <td colspan="2" class="justify">EYE will not pay commission: -</td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="2"></td>
                                                        <td class="vertical-top">d)</td>
                                                        <td class="justify">If agent does not indicate on the Application Form that they represent the student;</td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="2"></td>
                                                        <td class="vertical-top">e)</td>
                                                        <td class="justify">If the student/s withdraw/s from his/their course of study within the official refund period; OR</td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="2"></td>
                                                        <td class="vertical-top">f)</td>
                                                        <td class="justify">If the student/s has/have already submitted an application form to EYE or the student/s applies/apply to enroll directly to EYE.</td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="4">&nbsp;</td>
                                                    </tr>

                                                    <tr>
                                                        <td class="vertical-top"><b>5.0</b></td>
                                                        <td colspan="4" class="justify"><b>Costs</b></td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="4">&nbsp;</td>
                                                    </tr>

                                                    <tr>
                                                        <td></td>
                                                        <td colspan="3" class="justify">The solicitors’ fees, stamp duty and such other disbursements payable (if applicable) for the preparation of this Agreement should be borne and paid by the AGENT.</td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="4">&nbsp;</td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center" colspan="4"><i>(The rest of the page has been intentionally left blank)</i></td>
                                                    </tr>
                                                </table>

                                                <?php

                                                date_default_timezone_set('Asia/Kuala_Lumpur');
                                                $current_time = date('Y-m-d H:i:s');

                                                $mpdf->SetHTMLHeader('

                                                <table width="100%" border="0" style="vertical-align: bottom; font-family: cambria; font-size: 10pt; color:#000; border-collapse:collapse;"><tr>
                                                <td width="94%" class="bottom-border">SERIAL NO.: EXT (IMO)/SO/' . $result[0]['UserId'] . ')/' . date('m') . '/' . $year . '</td>
                                                <td width="6%" class="bottom-border left-border">' . $year . '</td>
                                                </tr>

                                                </table>

                                                ');

                                                $mpdf->SetHTMLFooter('

                                                    <table width="100%"><tr>
                                                    <td width="33%"></td>
                                                    
                                                    <td width="33%" align="center" style="vertical-align: bottom; font-family: arial; font-size: 10pt; color:#000;">{PAGENO}</td>
                                                    <td width="33%" style="text-align: right; style="vertical-align: bottom; font-family: arial; font-size: 9pt; color:#000;"">1st Revision: ' . date('d/m/Y') . '</td>
                                                    </tr></table>

                                                    ');


                                                $html = ob_get_contents();
                                                ob_end_clean();



                                                $mpdf->WriteHTML($html);
                                                $mpdf->Output();
                                                exit;
                                                ?>