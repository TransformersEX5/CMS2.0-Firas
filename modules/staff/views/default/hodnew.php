<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var yii\widgets\ActiveForm $form */

use app\models\tblstatusai;
use app\models\tbluser;

$backindex = '/staff';
$pageUrl = Yii::$app->controller->action->id;

?>

<?php

$HodId = $model->HodId ?? 0;

$url = Url::toRoute(['/staff/default/hoddetail']);

$_csrf = Yii::$app->request->getCsrfToken();

$js = <<< JS

$(document).ready(function () {
    $("#hod").submit(function(event) {
        event.preventDefault();

        var formData = $('#hod').serializeArray();

        if($HodId == 0) {
            desc = 'Are you sure to add a new HoD?';
            desc2 = 'You have successfully added a new HoD!';
        } else {
            desc = 'Are you sure to update?';
            desc2 = 'You have successfully updated the HoD!';
        }
        
        Swal.fire({title: desc, icon: "warning", showCancelButton: true, confirmButtonColor: "#34c38f", cancelButtonColor: "#f46a6a", confirmButtonText: "Confirm"
        }).then(function(t) {
            if (t.value) {
                $.ajax({
                    url: '$url',
                    type: 'POST',
                    dataType: "json",
                    data: {
                        HodId: '$HodId',
                        _csrf: '$_csrf',
                        formData: JSON.stringify(formData)
                    },
                    success: function(response) {
                        if(response.success) {
                            Swal.fire({title: desc2, icon: "success", confirmButtonColor: "#34c38f", confirmButtonText: "Confirm"
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
<div class="tbluser-form">


    <?php $form = ActiveForm::begin([
        'id' => 'hod'
    ]); ?>


    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-12 mb-2">
                    <h6>HoD Name</h6>
                    <?= $form->field($model, 'HodDesc')->textInput(['maxlength' => true, 'class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-2">
                    <h6>Staff Name</h6>
                    <?= $form->field($model, 'UserId')->dropDownList(ArrayHelper::map(tbluser::find()->where(['StatusId' => 1])->andWhere(['!=', 'WorkingStatusId', 3])->andWhere(new \yii\db\Expression("FullName NOT LIKE '%SA-%'"))->andWhere(new \yii\db\Expression("FullName NOT LIKE '%-TBA%'"))->orderBy(['FullName' => SORT_ASC])->all(), 'UserId', 'FullName'), ['prompt' => 'Select Staff Name', 'class' => 'form-select text-dark border-dark', 'required' => 'required'])->label(false); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-2">
                    <h6>Status</h6>
                    <?= $form->field($model, 'StatusId')->dropDownList(ArrayHelper::map(tblstatusai::find()->asArray()->all(), 'StatusId', 'Status'), ['prompt' => 'Select Status', 'class' => 'form-select text-dark border-dark', 'required' => 'required'])->label(false); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"><?php if (!isset($model->HodId)) { ?>Add New HoD<?php } else { ?>Update<?php } ?></button>
    </div>

    <?php ActiveForm::end(); ?>

</div>