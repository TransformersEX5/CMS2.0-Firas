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

    <h2>STAFF TRAINING SUMMARY</h2>

    Note : To Copy to Excel,<br>
    Step 1 : Press CTRL + A and then press CTRL + C<br>
    Step 2 : Open Excel Spreadsheet<br>
    Step 3 : Right-click on the triangle above row 1, and click "Format Cells"<br>
    Step 4 : Choose "Text" and proceed to click "OK"<br>
    Step 5 : Next, right-click on cell A1, press M and then press Enter<br><br>

    <?php

    $year = 0;
    $staff = 0;

    foreach ($data as $row) {
        $rowyear = date('Y', strtotime($row['TrainingDate']));
        if ($year != $rowyear) { ?>
            <h3><?= 'Year ' . $rowyear; ?></h3>

            <?php
            foreach ($data as $row2) {
                $i = 1;
                if ($rowyear == date('Y', strtotime($row2['TrainingDate']))) {
                    if ($staff != $row2['FullName']) {
            ?>

                        <h3><?= $row2['UserNo'] . ' - ' . $row2['FullName'] . ' - ' . $row2['PositionName'] . ' - ' . $row2['DepartmentDesc']; ?></h3>

                        <table border="1" width="100%">
                            <tr style="background-color:#77DD77;">
                                <th style="width:3%; padding:1%;">No.</th>
                                <th style="width:50%; padding:1%;">Course/Training Name</th>
                                <th style="width:7%; padding:1%;">Training Date</th>
                                <th style="width:30%; padding:1%;">Training Provider</th>
                                <th style="width:8%; padding:1%;">Training Hours</th>
                            </tr>
                            <?php
                            foreach ($data as $row3) {
                                if ($row2['FullName'] == $row3['FullName'] && $rowyear == date('Y', strtotime($row3['TrainingDate']))) {

                            ?>
                                    <tr>
                                        <td class="justify" style="padding:1%;"><?= $i; ?></td>
                                        <td class="padding-left" style="padding:1%;"><?= $row3['TrainingTitle']; ?></td>
                                        <td class="justify" style="padding:1%;"><?= $row3['TrainingDate']; ?></td>
                                        <td class="padding-left" style="padding:1%;"><?= $row3['TrainerName']; ?></td>
                                        <td class="justify" style="padding:1%;"><?= $row3['TraningTotHours']; ?></td>
                                    </tr>
                            <?php $i++;
                                }
                            }
                            ?>
                        </table>
                        <br>
            <?php
                    }
                }
                $staff = $row2['FullName'];
            }
            ?>
    <?php }
        $year = $rowyear;
    }
    ?>

</body>

</html>