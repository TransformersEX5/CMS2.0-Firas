<?php
set_time_limit(600);
ini_set("memory_limit", "256M");

define('_MPDF_URI', '../');
define('_MPDF_PATH', '../');

$vendorPath = Yii::getAlias('@vendor');
require_once $vendorPath . '/autoload.php';

$mpdf = new \Mpdf\Mpdf();


$mpdf->ignore_invalid_utf8 = true;
ob_start();

$mpdf->AddPageByArray([
    'orientation' => 'P', // 'P' for portrait, 'L' for landscape
    'sheet-size' => 'A3', // Replace 'A4' with the desired paper size
]);

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
    }

    td {
        vertical-align: top;
        text-align: justify;
    }

    .spacebar {
        line-height: 170%;
    }
</style>

<body>
    <br><br>
    <table width="100%" border="0">
        <tbody>
            <tr>
                <td align="left"><b>
                        <h3>Staff List Reporting To:</h3>
                    </b></td>
            </tr>
            <tr>
                <td><?= $data2[0]['HodDesc']; ?></td>
            </tr>
            <tr>
                <td><?= $data2[0]['FullName']; ?></td>
            </tr>
        </tbody>
    </table>

    <br></br>

    <table width="100%" class="spacebar table" border="1">
        <tr>
            <th>No</th>
            <th>Staff No.</th>
            <th>Staff IC/Passport</th>
            <th>Staff Name</th>
            <th>Department</th>
        </tr>

        <?php $i = 1;
        if (!empty($data)) {
            foreach ($data as $row) { ?>
                <tr>
                    <td align="center"><?= $i++; ?> </td>
                    <td align="center"><?= $row['UserNo']; ?> </td>
                    <td align="center"><?= $row['ICPassportNo']; ?> </td>
                    <td><?= $row['FullName']; ?> </td>
                    <td><?= $row['DepartmentDesc']; ?> </td>
                </tr>
            <?php }
        } else { ?>
            <tr>
                <td align="center" colspan="5">No data available.</td>
            </tr>
        <?php    } ?>


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


    <!-- ****Footer - End******************************************************************************************************************************************* -->