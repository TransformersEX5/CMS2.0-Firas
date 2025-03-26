<?php

$year = Yii::$app->request->get('year');

?>

<html>

<style>
    table {
        font-family: Arial;
        font-size: 12pt;
        color: #000;
        border-width: 1px;
        border-color: #666666;
        border-collapse: collapse;
    }

    .padding-left {
        padding-left: 0.2%;
    }

    .center {
        text-align: center;

    }
</style>

<body>

    <h2>STAFF TRAINING SUMMARY - <?= $data2[0]['FullName'] ?? '';?></h2>

    Note : To Copy to Excel,<br>
    Step 1 : Press CTRL + A and then press CTRL + C<br>
    Step 2 : Open Excel Spreadsheet<br>
    Step 3 : Right-click on the triangle above row 1, and click "Format Cells"<br>
    Step 4 : Choose "Text" and proceed to click "OK"<br>
    Step 5 : Next, right-click on cell A1, press M and then press Enter<br><br><br><br>

    <?php
    $year = 0;
    foreach ($data as $row) {
        $rowyear = date('Y', strtotime($row['TrainingDate']));

        if ($year != $rowyear) {
    ?>
            <h3><?= $rowyear; ?></h3>
            <table border="1" width="70%" style="margin-bottom: 1%">
                <tr>
                    <th>No.</th>
                    <th>Training Title</th>
                    <th>Training Date</th>
                    <th>Training Hours</th>
                </tr>

                <?php
                $i = 1;
                foreach ($data as $row2) {
                    if ($rowyear == date('Y', strtotime($row2['TrainingDate']))) {
                ?>
                        <tr>
                            <td class="center" width="4%"><?= $i; ?></td>
                            <td class="padding-left" width="70%"><?= $row2['TrainingTitle']; ?></td>
                            <td class="padding-left center" width="13%"><?= $row2['TrainingDate']; ?></td>
                            <td class="padding-left center" width="13%"><?= $row2['TraningTotHours']; ?></td>
                        </tr>

            <?php
                        $i++;
                    }
                }
            }
            ?>
            </table>
        <?php
        $year = $rowyear;
    } ?>


</body>

</html>