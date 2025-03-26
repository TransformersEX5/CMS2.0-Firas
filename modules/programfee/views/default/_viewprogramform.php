<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Tblprogramfeecategory $model */
/** @var yii\widgets\ActiveForm $form */

$backindex = "/programfeecategory";
$pageUrl = Yii::$app->controller->action->id;
// $id = Yii::$app->request->get('id');

?>

<?php

$script = <<<JS



JS;
$this->registerJs($script);


?>

<?php

$sql = "SELECT
tblprogram.ProgramId,
tblprogram.ProgramCode,
tblprogram.ProgramName,
tblprogram.ProgramCode3,
tblprogram.ProgramName3,
tblprogram.ProgramType,
tblprogram.ProgramStatus,
tblprogramtype.ProgramTypeName,
QQLocal.QProgFeeCode_Local,
QQLocal.ProgFeeCatId
FROM
tblprogram
INNER JOIN tblprogramtype ON tblprogram.ProgramType = tblprogramtype.ProgramTypeId
INNER JOIN
(
    SELECT
    tblprogramfee.ProgramId,
    tblprogramfee.FeeStructureId,
    tblprogramfee.ProgFeeCatId,
    tblprogram.ProgramCode,
    tblprogram.ProgramName,
    tblprogram.ProgramName3,
    tblintake.IntakeYrMo,
    tblresidency.Residency,
    tblfeestructure.FeeStructureName,
    tblprogramfeecategory.ProgFeeCode as QProgFeeCode_Local,
    tblprogramfeecategory.TotalPublishFee,
    tblprogramfeecategory.TotalPromoFee,
    tblprogramfeecategory.TotalSem
    FROM
    tblprogramfee
    INNER JOIN tblprogramfeecategory ON tblprogramfee.ProgFeeCatId = tblprogramfeecategory.ProgFeeCatId
    INNER JOIN tblprogram ON tblprogramfee.ProgramId = tblprogram.ProgramId
    INNER JOIN tblprogrambatch ON tblprogrambatch.ProgramIntId = tblprogramfee.ProgramIntId
    INNER JOIN tblintake ON tblprogrambatch.IntakeId = tblintake.IntakeId
    INNER JOIN tblresidency ON tblprogramfee.Residency = tblresidency.ResidencyId
    INNER JOIN tblfeestructure ON tblprogramfee.FeeStructureId = tblfeestructure.FeeStructureId
	WHERE tblprogramfee.ProgFeeCatId = $model->ProgFeeCatId
    GROUP BY  tblprogramfee.ProgramId
)QQLocal ON QQLocal.ProgramId = tblprogram.ProgramId
ORDER BY tblprogramtype.ProgramTypeName , tblprogram.ProgramCode";

$data = \Yii::$app->db->createCommand($sql)->queryAll();

?>

<div>
    <div>
        <h4>Program Fee Category <?= $data[0]['QProgFeeCode_Local']; ?></h4>
    </div>

    <br>

    <div>
        <table border=0 style="border-collapse: collapse;  width: 100%;  margin: 0.5em; padding: 0.5em;" class="table table-bordered">
            <tr style="text-align: center; border: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #04AA6D;">
                <th style="color: black; text-align: center;">No.</th>
                <th style="color: black; text-align: center;">Program Code</th>
                <th style="color: black; text-align: center;">Program Name</th>
                <th style="color: black; text-align: center;">Program Type</th>
                <th style="color: black; text-align: center;">Fee Code</th>
                <!-- <th style="color: black; text-align: center;">.:.</th> -->
            </tr>

            <?php
            $i = 1;
            foreach ($data as $row) {
            ?>
                <tr style=" text-align: center; border: 1px solid #ddd; border-bottom: 1px solid #ddd; ">
                    <td><?= $i; ?></td>
                    <td><?= $row['ProgramCode']; ?></td>
                    <td><?= $row['ProgramName']; ?></td>
                    <td><?= $row['ProgramTypeName']; ?></td>
                    <td><?= $row['QProgFeeCode_Local']; ?></td>
                </tr>
            <?php
                $i++;
            }
            ?>
        </table>
    </div>

    <br>

    <div class="modal-footer">
        <button id="btnClose" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>

</div>