<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\modules\staff\models\tbluser $model */
/** @var yii\widgets\ActiveForm $form */

use app\models\tblleaveholiday;
use app\models\tblbranch;


$backindex = '/staff';
$pageUrl = Yii::$app->controller->action->id;

$stmt = "SELECT DATE_FORMAT(lDate, '%Y') AS lDate 
FROM tblcalendarbranch 
GROUP BY DATE_FORMAT(lDate, '%Y')";
$data = Yii::$app->db->createCommand($stmt)->queryAll();

?>

<?php

$PKBranchId = $model->PKBranchId ?? 0;

$url = Url::toRoute(['/staff/default/publicholidaydetail']);

$_csrf = Yii::$app->request->getCsrfToken();

$js = <<< JS

$(document).ready(function () {
    $("#publicholiday").submit(function(event) {
        event.preventDefault();

        var formData = $('#publicholiday').serializeArray();

        var BranchId = [];
        
        $("input[name='tblcalendarbranch[BranchId][]']:checked").each(function() {
            BranchId.push($(this).val());
        });

        if($PKBranchId == 0) {
            desc = 'Are you sure to add a new public holiday?';
            desc2 = 'You have successfully added a new public holiday!';
        } else {
            desc = 'Are you sure to update?';
            desc2 = 'You have successfully updated the public holiday!';
        }
        
        Swal.fire({title: desc, icon: "warning", showCancelButton: true, confirmButtonColor: "#34c38f", cancelButtonColor: "#f46a6a", confirmButtonText: "Confirm"
        }).then(function(t) {
            if (t.value) {
                $.ajax({
                    url: "$url", 
                    type: "POST",
                    dataType: "json",
                    data: {
                        PKBranchId: "$PKBranchId", 
                        BranchId: BranchId,
                        _csrf: "$_csrf", 
                        formData: JSON.stringify(formData)
                    },
                    success: function(response) {
                        if (response.success) {

                            message = '';

                            if (response.skippedBranches && response.skippedBranches.length > 0) {
                                message += "The following branch(s) were skipped because a public holiday is already assigned to the selected date:<br><br> " + response.skippedBranches.join("<br>");
                                icon = 'warning';
                            }
                            else
                            {
                                message = "Data saved successfully!";
                                icon = 'success';
                            }
                            
                            Swal.fire({
                                title: message,
                                icon: icon,
                                confirmButtonColor: "#34c38f",
                                confirmButtonText: "Confirm"
                            }).then(function(t) {

                            });
                        } else {
                            alert('Error: ' + JSON.stringify(response.errors));
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Please contact the programmer for more details!');
                    }
                });

            } 
        });
    });
});

JS;
$this->registerJs($js);

?>

<?php

$value = '';
if (!empty($model->lDate)) {
    $value = date('Y-m-d', strtotime($model->lDate));
}


?>

<div class="tbluser-form">

    <?php $form = ActiveForm::begin([
        'id' => 'publicholiday'
    ]); ?>

    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-3 mb-2">
                    <h6>Date</h6>
                    <?php if ($PKBranchId == 0) { ?>
                        <?= $form->field($model, 'lDate')->textInput(['value' => $value, 'class' => 'form-control text-dark border-dark', 'type' => 'date', 'required' => 'required'])->label(false) ?>
                    <?php } else { ?>
                        <?= date('d-m-Y', strtotime($model->lDate)); ?>
                    <?php } ?>
                </div>
            </div>

            <div class="row">
                <div class="col-6 mb-2">
                    <h6>Holiday</h6>
                    <?= $form->field($model, 'HolidayId')->dropDownList(ArrayHelper::map(tblleaveholiday::find()->orderBy(['Holiday' => SORT_ASC])->asArray()->all(), 'HolidayId', 'Holiday'), ['prompt' => 'Select Holiday', 'class' => 'form-select text-dark border-dark', 'required' => 'required'])->label(false); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mb-2">
                    <h6>Branch</h6>
                    <?php if ($PKBranchId == 0) { ?>
                        <div class="row">
                            <?php foreach ($checkboxItems as $rows) { ?>
                                <div class="col-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="formCheck<?= $rows['BranchId'] ?>" name="tblcalendarbranch[BranchId][]" value="<?= $rows['BranchId'] ?>"><label for="formCheck<?= $rows['BranchId'] ?>"><?= $rows['BranchName'] ?></label>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } else {
                        $sql = "SELECT tblbranch.BranchId, tblbranch.BranchName 
                        FROM tblbranch 
                        WHERE BranchId = $model->BranchId";

                        $data = Yii::$app->db->createCommand($sql)->queryAll();

                        echo $data[0]['BranchName'];
                    } ?>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mb-2">
                    <h6>Remarks</h6>
                    <?= $form->field($model, 'Remarks')->textarea(['maxlength' => true, 'class' => 'form-control text-dark border-dark', 'rows' => 3])->label(false) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"><?php if (!isset($model->PKBranchId)) { ?>Add New Holiday<?php } else { ?>Update<?php } ?></button>
    </div>

    <?php ActiveForm::end(); ?>

</div>