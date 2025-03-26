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

<h2>STAFF TOTAL TRAINING HOURS YEAR <?= $year; ?></h2>

Note : To Copy to Excel,<br>
Step 1 : Press CTRL + A and then press CTRL + C<br>
Step 2 : Open Excel Spreadsheet<br>
Step 3 : Right-click on the triangle above row 1, and click "Format Cells"<br>
Step 4 : Choose "Text" and proceed to click "OK"<br>
Step 5 : Next, right-click on cell A1, press M and then press Enter<br><br>


    <table border="1" width="100%">
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Position</th>
            <th>Department</th>
            <th>Total Training Hours</th>
        </tr>

        <?php
        $i = 1;
        foreach ($data as $row) {
        ?>
            <tr>
                <td class="justify"><?= $i; ?></td>
                <td class="padding-left"><?= $row['FullName']; ?></td>
                <td class="padding-left"><?= $row['PositionName']; ?></td>
                <td class="padding-left"><?= $row['DepartmentDesc']; ?></td>
                <td class="justify"><?= $row['TraningTotHours']; ?></td>
            </tr>
        <?php
        $i++;
        }
        ?>



    </table>


</body>

</html>