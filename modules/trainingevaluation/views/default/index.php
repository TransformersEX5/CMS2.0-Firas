<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>

<?php

$userId = base64_decode(Yii::$app->request->get('userId'));
$trainingId = base64_decode(Yii::$app->request->get('trainingId'));



$module = '/' . Yii::$app->controller->module->id;

$url = Url::base() . $module . '/default';
$urlEvaluation = Url::base() . $module . '/default/evaluation';

$_csrf = Yii::$app->request->getCsrfToken();

$script = <<<JS

let currentDate = $currentDate;
let expiredDate = $expiredDate;
let userId = $model3;

if (currentDate > expiredDate || userId != 0)
{
    if(currentDate > expiredDate)
    {
        desc = 'Sorry. This evaluation form has already expired!';
    }
    else
    {
        desc = 'Sorry. You have already submitted this evaluation form. Thank you for your time. Have a nice day!';
    }
    
    Swal.fire({ html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>'+desc+'</h4></div></div>', allowOutsideClick: !1, showConfirmButton: !0, confirmButtonClass: "btn btn-primary w-xs mb-1 me-2", confirmButtonText: "Confirm", buttonsStyling: !1 })
    .then(function(t) 
    { 
        if (t.value)
        {
            self.close();
        }
    });
}

$(document).ready(function() 
{
    $("#EvalId").submit(function(event) 
    {
        event.preventDefault();

        desc = 'Are you sure to submit?';
        desc2 = 'Submitted! Thank you for your time. Have a nice day!'

        var remarks = $("#trainingRemarks").val();


        var formData = [];
        $('#eval input[type="radio"]').each(function(index, element) {
            if ($(element).prop('checked')) {
                formData.push({
                    name: $(element).attr('name'),
                    value: $(element).val()
                });
            }
        });

        formData.push({
            name: 'TrainingEvalRemarks',
            value: remarks
        });

        
        Swal.fire({ html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/wdqztrtx.json" trigger="loop" colors="primary:#ffcc00,secondary:#405189" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>'+desc+'</h4></div></div>', showCancelButton: !0, showConfirmButton: !0, cancelButtonClass: "btn btn-danger w-xs mb-1", confirmButtonClass: "btn btn-primary w-xs mb-1 me-2", cancelButtonText: "Cancel", confirmButtonText: "Confirm", buttonsStyling: !1, showCloseButton: 0
            }).then(function(t) 
            {
                if (t.value) {
                    $.ajax({
                        url: '$urlEvaluation?',
                        type: 'POST',
                        dataType: "json",
                        data: 
                        {
                            userId : '$userId',
                            trainingId : '$trainingId',
                            _csrf : '$_csrf',
                            formData : JSON.stringify(formData)
                        },
                        success: function(response) 
                        {
                            Swal.fire({ html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>'+desc2+'</h4></div></div>', allowOutsideClick: !1, showConfirmButton: !0, confirmButtonClass: "btn btn-primary w-xs mb-1 me-2", confirmButtonText: "Confirm", buttonsStyling: !1 })
                            .then(function(t) 
                            { 
                                if (t.value)
                                {
                                    window.close();
                                }
                            });
                        },
                        error: function(xhr, status, error) 
                        {
                            alert('Please make sure there is only one active status!');
                        }
                    });
                } 
            });
    });
});
JS;
$this->registerJs($script);

?>

<div class="col-12">
    <div class="card"><?php $form = ActiveForm::begin(['id' => 'EvalId', 'options' => ['onsubmit' => 'return false;']]); ?>
        <div class="card-body">
            <div class="col-12 mb-3">

                <h3>Training Programme Evaluation/Feedback</h3>
                <h5>Please respond to each of the following questions, they are intended to allow us to improve specifics of the workshop. Take your time to provide us with the most accurate assessment of your experience.</h5>

                <br>

                <div class="table-rep-plugin">
                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                        <table id="eval" class="table table-bordered border-dark">
                            <thead style="background-color: lightblue; text-align:center; vertical-align:middle;">
                                <tr>
                                    <th colspan="7">[1 - Strongly Disagree] [2 - Disagree] [3 - Neutral] [4 - Agree] [5 - Strongly Agree]</th>
                                </tr>
                                <tr>
                                    <th style="width:1%">No.</th>
                                    <th style="width:24%">Question</th>
                                    <th style="width:1%">1</th>
                                    <th style="width:1%">2</th>
                                    <th style="width:1%">3</th>
                                    <th style="width:1%">4</th>
                                    <th style="width:1%">5</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $x = 1;
                                foreach ($model as $row) { ?>
                                    <tr>
                                        <td style="text-align:center;"><?= $x ?></td>
                                        <td><?= $row['Question']; ?></td>
                                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                                            <td style="text-align:center;"><?= $form->field($row, 'Question[' . $row['QuestionNo'] . ']')->radio(['value' => $i, 'label' => false])->label(false); ?></td>
                                        <?php } ?>



                                        <!-- <td style="text-align:center;"><input class="form-check-input" type="radio" name="evalMark<?= $row['QuestionNo']; ?>" id="evalMark1" value="<?= $row['Mark1']; ?>"></td>
                                        <td style="text-align:center;"><input class="form-check-input" type="radio" name="evalMark<?= $row['QuestionNo']; ?>" id="evalMark2" value="<?= $row['Mark2']; ?>"></td>
                                        <td style="text-align:center;"><input class="form-check-input" type="radio" name="evalMark<?= $row['QuestionNo']; ?>" id="evalMark3" value="<?= $row['Mark3']; ?>"></td>
                                        <td style="text-align:center;"><input class="form-check-input" type="radio" name="evalMark<?= $row['QuestionNo']; ?>" id="evalMark4" value="<?= $row['Mark4']; ?>"></td>
                                        <td style="text-align:center;"><input class="form-check-input" type="radio" name="evalMark<?= $row['QuestionNo']; ?>" id="evalMark5" value="<?= $row['Mark5']; ?>"></td> -->
                                    </tr>
                                <?php $x++;
                                } ?>


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <div class="col-md-12 mb-3">
                <h6>Comments/Suggestion (if any)</h6>
                <?= $form->field($model2, 'TrainingEvalRemarks')->textarea(['id' => 'trainingRemarks', 'rows' => 3, 'class' => 'form-control text-dark border-dark'])->label(false); ?>
            </div>

            <div class="row">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </div><?php ActiveForm::end(); ?>
    </div>
</div>



<!-- <div>
    <div class="form-check">

    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="formRadios" id="formRadios2">
    </div>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="formRadios" id="formRadios3">
    </div>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="formRadios" id="formRadios4">
    </div>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="formRadios" id="formRadios5">
    </div>
</div> -->