<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Tblprogramfeecategory $model */
/** @var yii\widgets\ActiveForm $form */

$backindex = "/programfeecategory";
$pageUrl = Yii::$app->controller->action->id;
// $id = Yii::$app->request->get('id');

?>
<!-- $.ajax({
                            url: '$refreshTable?safetyId='+SafetyId, // Replace with the actual backend endpoint
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                            // Clear existing table rows
                            $('#table1 tbody').empty();
                            $.each(data, function(index, item) {
                                $('#table1 tbody').append('<tr><td>' + item.FullName + '</td><td class="text-center"><button type="button" class="btn btn-danger btn-sm waves-effect waves-light remove" value="' + item.UserId + '">Remove</button></td></tr>');
                                });
                            },
                            error: function(error) {
                                console.error('Error loading table data: ', error);
                            }
                        }); -->

<?php

$ProgFeeCatId = $model->ProgFeeCatId;

$url = Url::toRoute(['/programfee/default/refreshfee?ProgramRegId=']);
$refreshTable = Url::toRoute(['/programfee/default/refreshtable?ProgFeeCatId=']);

$script = <<<JS

$(document).on('click', '.refreshFee', function () {
    var ProgramRegId = $(this).val();

    $.ajax({
        url: '$url'+ProgramRegId,
        type: 'GET',
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (response) 
        {
            if(response.success)
            {
                Swal.fire({title:"Success!",icon:"success",confirmButtonColor:"#34c38f",confirmButtonText:"Confirm"})
                .then(function(t) 
                { 
                    if (t.value)
                    {
                        var ProgFeeCatId = '$ProgFeeCatId';
                        $.ajax({
                            url: '$refreshTable'+ProgFeeCatId, // Replace with the actual backend endpoint
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                            // Clear existing table rows
                            $('#table1 tbody').empty();
                            $.each(data, function(index, item) {
                                $('#table1 tbody').append('<tr style="text-align: center; border: 1px solid #ddd; border-bottom: 1px solid #ddd;">'+
                                '<td>' + (index + 1) + '</td>'+
                                '<td>' + item.StudentNo + '</td>'+
                                '<td>' + item.StudName + '</td>'+
                                '<td>' + item.StudNRICPassportNo + '</td>'+
                                '<td>' + item.ProgramCode + '</td>'+
                                '<td>' + item.FeeIntake + '</td>'+
                                '<td>' + item.ProgFeeCode + '</td>'+
                                '<td>' + item.StatusName + '</td>'+
                                '<td><button type="button" class="btn btn-success waves-effect waves-light refreshFee" value=' + item.ProgramRegId + '>Refresh</button></td>'+
                                '</tr>');
                            });
                            },
                            error: function(error) {
                                console.error('Error loading table data: ', error);
                            }
                        });
                    }
                });
            }
            else
            {
            }
        },
        error: function () 
        {

        }
    });
});

JS;
$this->registerJs($script);


?>

<?php

$sql = "SELECT
tblstudent.StudentNo,
tblstudent.StudName,
tblstudent.StudNRICPassportNo,
tblprogram.ProgramCode,
tblintake.IntakeYrMo AS FeeIntake,
tblprogramfeecategory.ProgFeeCode,
tblprogramregister.ProgFeeCatId,
get_studentregisterstatus.ProgramRegId,
get_studentregisterstatus.StatusName
FROM
tblprogramregister
INNER JOIN tblprogram ON tblprogram.ProgramId = tblprogramregister.ProgramId
INNER JOIN tblprogramfeecategory ON tblprogramregister.ProgFeeCatId = tblprogramfeecategory.ProgFeeCatId
INNER JOIN tblstudent ON tblprogramregister.StudentId = tblstudent.StudentId
INNER JOIN tblintake ON tblprogramregister.FeeIntakeId = tblintake.IntakeId
INNER JOIN get_studentregisterstatus ON get_studentregisterstatus.ProgramRegId = tblprogramregister.ProgramRegId
WHERE  tblprogramregister.ProgFeeCatId  = $model->ProgFeeCatId
ORDER BY tblprogram.ProgramCode, tblintake.IntakeYrMo,get_studentregisterstatus.StatusName,tblstudent.StudName";

$data = \Yii::$app->db->createCommand($sql)->queryAll();

?>

<div>
    <div>
        <h4>Student Category <?php if (!empty($data)) {
                                    echo $data[0]['ProgFeeCode'];
                                } ?></h4>
    </div>

    <br>

    <div>
        <table border=0 id="table1" style="border-collapse: collapse;  width: 100%;  margin: 0.5em; padding: 0.5em;" class="table table-bordered">
            <thead>
                <tr style="text-align: center; border: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #04AA6D;">
                    <th style="color: black; text-align: center;">No.</th>
                    <th style="color: black; text-align: center;">Student No.</th>
                    <th style="color: black; text-align: center;">Student Name</th>
                    <th style="color: black; text-align: center;">NRIC/Passport No.</th>
                    <th style="color: black; text-align: center;">Program Code</th>
                    <th style="color: black; text-align: center;">Fee Intake</th>
                    <th style="color: black; text-align: center;">Fee Code</th>
                    <th style="color: black; text-align: center;">Status</th>
                    <th style="color: black; text-align: center;">.:.</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($data as $row) {
                ?>
                    <tr style=" text-align: center; border: 1px solid #ddd; border-bottom: 1px solid #ddd; ">
                        <td><?= $i; ?></td>
                        <td><?= $row['StudentNo']; ?></td>
                        <td><?= $row['StudName']; ?></td>
                        <td><?= $row['StudNRICPassportNo']; ?></td>
                        <td><?= $row['ProgramCode']; ?></td>
                        <td><?= $row['FeeIntake']; ?></td>
                        <td><?= $row['ProgFeeCode']; ?></td>
                        <td><?= $row['StatusName']; ?></td>
                        <td><button type="button" class="btn btn-success waves-effect waves-light refreshFee" value="<?= $row['ProgramRegId']; ?>">Refresh</button></td>
                    </tr>
                <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <br>

    <div class="modal-footer">
        <button id="btnClose" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>

</div>