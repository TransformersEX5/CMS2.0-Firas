<?php

$year = Yii::$app->request->get('year');

?>

<html>

<style>
    table {
        font-family: Arial;
        font-size: 10pt;
        color: #000;
        border-width: 1px;
        border-color: #666666;
        border-collapse: collapse;
    }

    .padding-left {
        padding-left: 0.2%;
    }

    .justify {
        text-align: center;
    }
</style>

<body>

    <h2>STAFF TRAINING SUMMARY YEAR <?= $year; ?></h2>

    Note : To Copy to Excel,<br>
    Step 1 : Press CTRL + A and then press CTRL + C<br>
    Step 2 : Open Excel Spreadsheet<br>
    Step 3 : Right-click on the triangle above row 1, and click "Format Cells"<br>
    Step 4 : Choose "Text" and proceed to click "OK"<br>
    Step 5 : Next, right-click on cell A1, press M and then press Enter<br><br>

    <table border="1" width="100%">
        <tr style="background-color:#77DD77;">
            <th style="width:1%; padding:5px; text-align: center;">No.</th>
            <th style="width:2%; padding:5px; text-align: center;">Staff ID.</th>
            <th style="width:10%; padding:5px;">Employee</th>
            <th style="width:5%; padding:5px;">Position</th>
            <th style="width:5%; padding:5px;">Department</th>
            <th style="width:10%; padding:5px;">Course/Training Name</th>
            <th style="width:1%; padding:5px; text-align: center;">Training Date</th>
            <th style="width:10%; padding:5px;">Training Provider</th>
            <th style="width:1%; padding:5px; text-align: center;">Training Hours</th>
        </tr>
        <?php $i = 1; foreach ($data as $row) { ?>
            <tr>
                <td style="padding:5px; text-align: center;"><?= $i; ?></td>
                <td style="padding:5px; text-align: center;"><?= $row['UserNo']; ?></td>
                <td style="padding:5px;"><?= $row['FullName']; ?></td>
                <td style="padding:5px;"><?= $row['PositionName']; ?></td>
                <td style="padding:5px;"><?= $row['DepartmentDesc']; ?></td>
                <td style="padding:5px;"><?= $row['TrainingTitle']; ?></td>
                <td style="padding:5px; text-align: center;"><?= $row['TrainingDate']; ?></td>
                <td style="padding:5px;"><?= $row['TrainerName']; ?></td>
                <td style="padding:5px; text-align: center;"><?= $row['TraningTotHours']; ?></td>
            </tr>
        <?php $i++; } ?>
    </table>
</body>

</html>