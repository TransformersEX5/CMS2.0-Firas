<?php
set_time_limit(600);
ini_set("memory_limit", "256M");

define('_MPDF_URI', '../');     // must be  a relative or absolute URI - not a file system path
define('_MPDF_PATH', '../');

$vendorPath = Yii::getAlias('@vendor');
require_once $vendorPath . '/autoload.php';
date_default_timezone_set('Asia/Kuala_Lumpur');
$current_time = date('Y-m-d H:i:s');

function get_server_datetime() {
    $date = "select CURRENT_TIMESTAMP as SvrDate";
    $data = \Yii::$app->db->createCommand($date)->queryAll();
    foreach ($data as $data) {
        echo $TodayDate = $data['SvrDate'];
    }
    return $TodayDate;
}


$mpdf = new \Mpdf\Mpdf();
$mpdf->ignore_invalid_utf8 = true;
ob_start();


$ProgramRegId = yii::$app->request->get('param1');

/****SetHTMLHeader********************************************************************************************************************************************* */

// $mpdf->SetHTMLHeader('<div style="text-align: left; font-family: tahoma; font-weight: bold; color:#000; font-size: 20pt;  ">List of Training 2023</div>');


/************************************************************************************************************************************************* */
$css = '
    body {
        margin: 0;
        padding: 0;
    }
    .content {
        width: 100%;
        height: 100%;
    }
';

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => 'A4',
    'orientation' => 'P', // Portrait orientation
]);




// $mpdf->SetDisplayMode('fullpage');

$i = 1;


/************************************************************************************************************************************************* */

// $mpdf->SetWatermarkText('etutorialspoint');
// $mpdf->showWatermarkText = true;
// $mpdf->watermarkTextAlpha = 0.1;
// Include the autoload.php file

/************************************************************************************************************************************************* */

$table = 'style=" border-collapse: collapse;  width: 100%;"';

$css_td_tr_col = 'style="  border: 1px solid #ddd; padding: 8px;  border-bottom: 1px solid #ddd; background-color: #04AA6D;  color: white;"';

$css_td_tr = 'style="  border: 1px solid black; padding: 8px;  border-bottom: 1px solid black; "';

$black = 'style="  border: 1px solid #000; background-color:#000; width="8";"';

?>

<style>
    body {
        font-family: Arial;
        font-size: 10pt;
        margin-top: 0px;
    }


    #tblfees {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #tblfees td,
    #tblfees th {
        border: 0.5px solid black;
        padding: 8px;
        font-size: 9pt;
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
        border-width: 0.5px;
        border-color: #666666;
        border-collapse: collapse;
    }

    .table th {
        border-width: 0.5px;
        padding: 8px;
        /* border-style: solid; */
        border-color: #666666;
        background-color: #dedede;
    }

    .table td {
        border-width: 0.5px;
        padding: 8px;
        /* border-style: solid; */
        border-color: #666666;
        background-color: #ffffff;
        /* text-align: center; */
    }

    td {
        vertical-align: top;
        text-align: justify;
    }

    .spacebar {
        line-height: 100%;
    }
</style>


<?php



/*******************************************************************************************************************************************/

// Create a command object
$tutionfee = Yii::$app->db->createCommand('CALL GetOutstanding_Student(:param1)');

// Bind parameters if necessary
$tutionfee->bindParam(':param1', $ProgramRegId, \PDO::PARAM_STR);

// Execute the stored procedure
$result = $tutionfee->queryAll(); // or queryOne() for a single row, execute() for no result


/*******************************************************************************************************************************************/


// Create a command object
$assessmentfee = Yii::$app->db->createCommand('CALL GetOutstanding_Assessment_byStudent(:param1)');

// Bind parameters if necessary
$assessmentfee->bindParam(':param1', $ProgramRegId, \PDO::PARAM_STR);

// Execute the stored procedure
$result = $assessmentfee->queryAll(); // or queryOne() for a single row, execute() for no result

/*******************************************************************************************************************************************/

function get_student_detail($ProgramRegId)
{

    $stud = "SELECT
tblprogramregister.ProgramRegId,
1 AS BranchId,
tblstudent.StudName,
tblstudent.StudNRICPassportNo,
tblprogram.ProgramCode,
tblintake.IntakeYrMo AS IntakeCode,
date_format(tblprogramregister.DateRegister,'%d-%m-%Y') AS DateRegister,
tblstudent.StudentNo,
tbl_fund.fundname,
get_studentregisterstatus.StatusName,
date_format(get_studentregisterstatus.TransactionDate,'%d-%m-%Y') AS StudDateStatus,
tblfeestructure.FeeStructureName,
Get_AgentName.AgentName,
tblprogramdiscountcategory.ProgDiscCategory
FROM
tblprogramregister
INNER JOIN tblstudent ON tblstudent.StudentId = tblprogramregister.StudentId
INNER JOIN tblprogram ON tblprogram.ProgramId = tblprogramregister.ProgramId
INNER JOIN tblintake ON tblintake.IntakeId = tblprogramregister.IntakeId
INNER JOIN tblfeestructure ON tblprogramregister.FeeStructureId = tblfeestructure.FeeStructureId
INNER JOIN get_studentregisterstatus ON get_studentregisterstatus.ProgramRegId = tblprogramregister.ProgramRegId
LEFT JOIN Get_AgentName ON tblprogramregister.ProgramRegId = Get_AgentName.ProgramRegId
LEFT JOIN tblprogramdiscountcategory ON tblprogramdiscountcategory.ProgDiscCategoryId = tblprogramregister.ProgDiscCategoryId
LEFT JOIN tbl_studentfund ON tblprogramregister.ProgramRegId = tbl_studentfund.ProgramRegId
LEFT JOIN tbl_fund ON tbl_studentfund.fundid = tbl_fund.fundid ";

    $condition = '';

    if (!empty($ProgramRegId)) {
        $condition .= " tbl_studentfund.CurrentStatus = 1 AND tblprogramregister.ProgramRegId = $ProgramRegId and ";
    }

    if ($condition != '') {
        $condition = ' where ' . substr($condition, 0, -4);
    }

    $stud .= $condition;

    $data = \Yii::$app->db->createCommand($stud)->queryAll();


    return $data;
}



function get_program_register_fee_detail($ProgramRegId)
{
    $fee = " SELECT tbl_fee.feeid,
    tbl_fee.ProgramRegId,
    date_format(tbl_fee.feedate,'%d/%m/%Y') AS feedate,
    case when tbl_fee.semesterno = 0 then '-' else tbl_fee.semesterno end as semesterno, 
    case when tbl_fee.intakeid = 0 then '-' else tbl_fee.intakeid end as intakeid,
    ROUND(tbl_fee.feeamount,2) AS feeamount,
    tbl_fee.description,
    tbl_feetype.feetypename, 
    tbl_feecategory.feecatname
    FROM tbl_fee
    INNER JOIN  tbl_feetype ON  tbl_fee.feetypeid = tbl_feetype.feetypeid
    INNER JOIN tbl_feecategory ON tbl_feetype.feecatid = tbl_feecategory.feecatid
    INNER JOIN tblprogramregister ON tbl_fee.ProgramRegId = tblprogramregister.ProgramRegId ";

    $condition = '';

    if (!empty($ProgramRegId)) {
        $condition .= "  tbl_feetype.feecatid =1 AND tblprogramregister.ProgramRegId = $ProgramRegId and ";
    }

    if ($condition != '') {
        $condition = ' where ' . substr($condition, 0, -4);
    }

    // $fee .= $condition . " ORDER BY tbl_fee.feedate,tbl_fee.semesterno,tbl_feetype.feetypeid,tbl_fee.feestatusid ";


    $fee .= $condition;

    $data = \Yii::$app->db->createCommand($fee)->queryAll();

    return $data;
}


function get_payment_detail($ProgramRegId)
{
    $payment = " 
    SELECT tbl_payment.paymentid,
    tbl_payment.ProgramRegId,
    date_format( tbl_payment.paymentdate,'%d/%m/%Y') AS paymentdate,
    case when tbl_payment.receiptno = '0' then '-' else tbl_payment.receiptno end as receiptno,
    tbl_feetype.feetypename,
    ROUND(tbl_payment.amountpaid,2) AS amountpaid,
    tbl_payment.paymentstatusid,
    tbl_payment.chequeno,
    tbl_paymentmode.paymentmode,

    case when tbl_payment.chequeno is not null then concat('Cheque No:',' ', tbl_payment.chequeno, '<br>', trim(tbl_payment.description)) else  trim(tbl_payment.description) end  AS description   

    FROM tbl_payment 
    LEFT OUTER JOIN tbl_paymentmode ON tbl_payment.paymentmodeid = tbl_paymentmode.paymentmodeid 
    INNER JOIN  tbl_feetype ON  tbl_payment.paymenttypeid = tbl_feetype.feetypeid
    INNER JOIN tbl_feecategory ON tbl_feetype.feecatid = tbl_feecategory.feecatid
    INNER JOIN tblprogramregister ON tbl_payment.ProgramRegId = tblprogramregister.ProgramRegId ";

    $condition = '';

    if (!empty($ProgramRegId)) {
        $condition .= "  (tbl_feetype.feecatid =1) AND tblprogramregister.ProgramRegId = $ProgramRegId and ";
    }

    if ($condition != '') {
        $condition = ' where ' . substr($condition, 0, -4);
    }

    $payment .= $condition . " ORDER BY tbl_payment.paymentdate,tbl_payment.paymentstatusid,tbl_payment.receiptno ";

    $data = \Yii::$app->db->createCommand($payment)->queryAll();

    return $data;
}


function get_student_promotion($ProgramRegId)
{


    $promo = "SELECT tblstudentpromotion.ProgramRegId,concat(tblpromotion.PromoTitle,'<br>',tblpromotion.PromoDesc) AS iPromo 
            FROM tblstudentpromotion 
            INNER JOIN tblpromotion ON tblstudentpromotion.PromoId = tblpromotion.PromoId ";

    $condition = '';

    if (!empty($ProgramRegId)) {
        $condition .= " tblstudentpromotion.ProgramRegId = $ProgramRegId and ";
    }

    if ($condition != '') {
        $condition = ' where ' . substr($condition, 0, -4);
    }

    $promo .= $condition . " ORDER BY tblstudentpromotion.ProgramRegId ";

    $data = \Yii::$app->db->createCommand($promo)->queryAll();

    return $data;
}



/***************************************************** */
$stud = get_student_detail($ProgramRegId);
foreach ($stud as $stud) {

    $StudentNo          = $stud['StudentNo'];
    $StudName           = $stud['StudName'];
    $StudNRICPassportNo = $stud['StudNRICPassportNo'];

    $ProgramCode        = $stud['ProgramCode'];
    $IntakeCode         = $stud['IntakeCode'];
    $DateRegister       = $stud['DateRegister'];
    $StatusName         = $stud['StatusName'];
    $StudDateStatus     = $stud['StudDateStatus'];

    $FundName           = $stud['fundname'];

    $FeeStructureName   = $stud['FeeStructureName'];
    $AgentName          = $stud['AgentName'];
    $ProgDiscCategory   = $stud['ProgDiscCategory'];
}


/***************************************************** */

$html = '';
$table1 = '';

?>



<!-- **Title on browser tab********************************************************************************************************************************************* -->
<?php
// Define the title for the browser tab
// $title = 'Training Report  - Tab';

// // // Add content to the PDF
// $html = '<!DOCTYPE html>
//            <html>
//                 <head>
//                     <title>' . $title . '</title>
//                 </head>
//         </html>';

// Set the title in mPDF



?>




<!-- ****Body - Start******************************************************************************************************************************************* -->

<body>
    <br><br>
    <table width="100%">
        <tbody>
            <tr>



                <td height="40"><img src= '<?php echo Yii::getAlias('@CityULogoimagePath').'/CityU_logo.jpg' ?>'  alt="Image"></td>
                <td align="left"><b>Statement of Accounts <?php get_server_datetime(); ?></b></td>
            </tr>
        </tbody>
    </table>

    <br></br>

    <table width="100%">

        <tr>

            <td>Student Name </td>
            <td colspan="5"><?php echo ': ' . $StudName; ?></td>
            <td></td>
            <td></td>

        </tr>
        <tr>
            <td>Student No </td>
            <td><?php echo ': ' . $StudentNo; ?></td>
            <td></td>
            <td></td>
            <td style="text-align:right;">Course Code</td>
            <td><?php echo ': ' . $ProgramCode; ?></td>

        </tr>
        <tr>
            <td>Date Register</td>
            <td><?php echo ': ' . $DateRegister; ?></td>
            <td></td>
            <td></td>
            <td style="text-align:right;">NIRC/Passport</td>
            <td><?php echo ': ' . $StudNRICPassportNo; ?></td>


        </tr>
        <tr>
            <td>Fee Category</td>
            <td><?php echo ': ' . $FeeStructureName; ?></td>
            <td></td>
            <td></td>
            <td style="text-align:right;">Sponsorship </td>
            <td><?php echo ': ' . $FundName; ?></td>


        </tr>
        <tr>

            <td>Agent</td>
            <td><?php echo ': ' . $AgentName; ?></td>
            <td></td>
            <td></td>


        </tr>


        <td style="text-align:right;">Status</td>
        <td><?php echo ': ' . $StatusName . ' - ' . $StudDateStatus; ?></td>
        <td></td>
        <td></td>


        </tr>

    </table>

    <p></p>

    <table width="100%" id="tblfees">
        <tr>
            <th colspan="6" style="text-align:left;">Section : Tuition Fees</th>

        </tr>
        <tr>
            <th colspan="6" style="text-align:left;">Billing</th>

        </tr>

        <tr>
            <th>Date</th>
            <th>Semester</th>
            <th>Intake</th>
            <th>Fee Type</th>
            <th>Description</th>
            <th>Amount(RM)</th>
        </tr>
        <?php
        $tblfee = '';
        $Qtotfeeamount = 0;

        $fees = get_program_register_fee_detail($ProgramRegId);

        foreach ($fees as $fees) {
            $Qtotfeeamount += $fees["feeamount"];
        ?>
            <tr>
                <td> <?php echo $fees['feedate']; ?> </td>
                <td style=text-align:center;> <?php echo $fees['semesterno']; ?> </td>
                <td> <?php echo $fees['intakeid']; ?> </td>
                <td> <?php echo $fees['feetypename']; ?> </td>
                <td> <?php echo $fees['description']; ?> </td>
                <td style=text-align:right;> <?php echo number_format($fees['feeamount'],2); ?> </td>
            </tr>
        <?php  } ?>

        <tr>
            <td style="text-align:right;" colspan="5"> Total Billing (A) : </td>
            <td style="text-align:right;"> <?php echo number_format($Qtotfeeamount, 2); ?> </td>

        </tr>


    </table>

    <!-- ****Payment*********************************************************************************************************************************************** -->

    <p></p>

    <table width="100%" id="tblfees">

        <tr>
            <th colspan="6" style="text-align:left;">Payment</th>

        </tr>

        <tr>
            <th>Date</th>
            <th>Receipt No</th>
            <!-- <th>Cheque no</th> -->
            <th>Fee Type</th>
            <th>Payment Mode</th>
            <th>Description</th>

            <th>Amount(RM)</th>
        </tr>
        <?php
        $tblfee = '';
        $Qtotpaidamount = 0;

        $paid = get_payment_detail($ProgramRegId);

        foreach ($paid as $paid) {
            $Qtotpaidamount += $paid["amountpaid"];
        ?>
            <tr>
                <td> <?php echo $paid['paymentdate']; ?> </td>
                <td style=text-align:center;> <?php echo $paid['receiptno']; ?> </td>
                <!-- <td> <?php echo $paid['chequeno']; ?> </td> -->
                <td> <?php echo $paid['feetypename']; ?> </td>
                <td> <?php echo $paid['paymentmode']; ?> </td>
                <td> <?php echo $paid['description']; ?> </td>
                <td style=text-align:right;> <?php echo number_format($paid['amountpaid'],2); ?> </td>
            </tr>
        <?php  } ?>

        <tr>
            <td style="text-align:right;" colspan="5"> Total Payment (B) : </td>
            <td style="text-align:right;"> <?php echo number_format($Qtotpaidamount, 2); ?> </td>

        </tr>

        <tr>
            <td style="text-align:right;" colspan="5"> Total Outstanding (A) - (B) :</td>
            <td style="text-align:right;"> <?php echo number_format($Qtotfeeamount - $Qtotpaidamount, 2); ?> </td>

        </tr>


    </table>

    <!-- ****Body - End*********************************************************************************************************************************************** -->


    <!-- ****Footer - Start******************************************************************************************************************************************* -->

    <?php

 

    $mpdf->SetHTMLFooter('
        <table width="100%" style="vertical-align: bottom; font-family: tahoma; font-size: 10pt; color:#000;">
        <tr>
            <td colspan ="10"><hr></td>
        </tr>

        <tr>
            <td width="33%">' . $current_time . '</td>
            <td width="33%" align="center"></td>
            <td width="33%" style="text-align: right;">{PAGENO}/{nbpg}</td>
         </tr>
      </table> ');


    $html = ob_get_contents();
    ob_end_clean();

    // $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
    // $mpdf->WriteHTML('<div class="content">' . $html . '</div>');
    $mpdf->WriteHTML($html);
    $mpdf->Output();
    exit;
    ?>


    <!-- ****Footer - End******************************************************************************************************************************************* -->