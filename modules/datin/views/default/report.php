<?php

use yii\helpers\Url;

?>

<link href="<?= Url::base() ?>/lexa-ajax/layouts/purpel/assets/css/app.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="<?= Url::base() ?>/lexa-ajax/layouts/purpel/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="<?= Url::base() ?>/lexa-ajax/layouts/purpel/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

<h1>DATIN'S PROPERTY REPORT</h1>

<div class="table-responsive">
    <table border="1" padding="1" class="table" style="width:50%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="width:5%;">No.</th>
                <th style="width:15%;">Type</th>
                <th style="width:55%;">Item</th>
                <th style="width:15%;">Due Date</th>
                <th style="width:10%;">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rowNo = 1;

            foreach ($data as $row) {
            ?>
                <tr>
                    <td scope="row" style="padding:1%; text-align:center;"><?= $rowNo; ?></th>
                    <td style="padding:1%;" ><?= $row['TypeName']; ?></td>
                    <td style="padding:1%;" ><?= $row['ItemName']; ?></td>
                    <td style="padding:1%; text-align:center;"><?= $row['DueDate']; ?></td>
                    <td style="padding:1%; text-align:center;"><?= $row['StatusName']; ?></td>
                </tr>
            <?php
                $rowNo++;
            }
            ?>
        </tbody>
    </table>
</div>


<script src="<?= Url::base() ?>/lexa-ajax/layouts/purpel/assets/libs/jquery/jquery.min.js"></script>
<script src="<?= Url::base() ?>/lexa-ajax/layouts/purpel/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= Url::base() ?>/lexa-ajax/layouts/purpel/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?= Url::base() ?>/lexa-ajax/layouts/purpel/assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?= Url::base() ?>/lexa-ajax/layouts/purpel/assets/libs/node-waves/waves.min.js"></script>
<script src="<?= Url::base() ?>/lexa-ajax/layouts/purpel/assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="<?= Url::base() ?>/lexa-ajax/layouts/purpel/assets/js/app.js"></script>