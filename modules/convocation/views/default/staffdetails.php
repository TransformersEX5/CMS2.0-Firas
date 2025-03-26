<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\db\Query;

use app\modules\convocation\models\tblconvocationrobe;
use app\modules\convocation\models\Tblconvocationstaffposition;
use app\modules\convocation\models\Tblstatusai;
use app\modules\convocation\models\Tbluser;

?>

<?php

$module = '/'.Yii::$app->controller->module->id;

$convostaffdetail = Url::base() . $module.'/default/convostaffdetail';
$getstaffdetails = Url::base() . $module.'/default/getstaffdetails';
$urlRedirect = Url::base() . $module.'/default/staff';
$_csrf = Yii::$app->request->getCsrfToken();

$posId = Yii::$app->request->get('posId');

$script = <<< JS

$('#tblconvocationstaffdetails-convouserid').change(function() {
    var userId = $('#tblconvocationstaffdetails-convouserid').val();
        if (userId !== '') {
            $.ajax({
                type: 'POST',
                url: '$getstaffdetails',
                data: { userId: userId },
                success: function(response) {

                    $('#tblconvocationstaffdetails-convostaffemail').val(response.EmailAddress);
                }
            });
        } else {
            $('#tblconvocationstaffdetails-convostaffemail').val('');
        }
    });

$(document).ready(function() 
{
    $("#ConvoStaffDetailsId").submit(function(event) 
    {
        event.preventDefault();

        var formData = $('#ConvoStaffDetailsId').serializeArray();
        var posId = '$posId';

        if (posId != '') 
        {
            desc = 'Are you sure to register?';
            desc2 = 'You have successfully register the staff!'
        }
        else
        {
            desc = 'Are you sure to update?';
            desc2 = 'You have successfully update the details!'
        }
        
        Swal.fire({ html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/wdqztrtx.json" trigger="loop" colors="primary:#ffcc00,secondary:#405189" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>'+desc+'</h4></div></div>', showCancelButton: !0, showConfirmButton: !0, cancelButtonClass: "btn btn-danger w-xs mb-1", confirmButtonClass: "btn btn-primary w-xs mb-1 me-2", cancelButtonText: "Cancel", confirmButtonText: "Confirm", buttonsStyling: !1, showCloseButton: 0
            }).then(function(t) 
            {
                if (t.value) {
                    $.ajax({
                        url: '$convostaffdetail',
                        type: 'POST',
                        dataType: "json",
                        data: 
                        {
                            staffId : '$staffId',
                            posId : '$posId',
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
                                    window.location.href = '$urlRedirect'; 
                                }
                            });
                        },
                        error: function(xhr, status, error) 
                        {
                            alert('a');
                        }
                    });
                } 
            });
    });
});

JS;
$this->registerJs($script);

?>

<div class="col-12"><?php $form = ActiveForm::begin(['id' => 'ConvoStaffDetailsId']); ?>
    <div class="card-body">
        <div class="row">

            <h4 class="mb-3">STAFF DETAILS</h4>

            <div class="col-md-4 mb-2">
                <h6>Name</h6>

                <?php

                if ($staffId == 0) {
                    $query = (new Query())
                        ->select(['tbluser.UserId', 'FullName'])
                        ->from('tbluser')
                        ->innerJoin('tbldepartment', 'tbluser.DepartmentId = tbldepartment.DepartmentId')
                        ->innerJoin('tbldepartmentcategory', 'tbldepartment.DeptCatId = tbldepartmentcategory.DeptCatId')
                        ->where([
                            'tbldepartment.DeptCatId' => [1, 2],
                            'tbluser.StatusId' => 1,
                        ])
                        ->andWhere(['NOT LIKE', 'FullName', '-TBA'])
                        ->andWhere(['NOT LIKE', 'FullName', 'SA-'])
                        ->andWhere(['NOT IN', 'tbluser.UserId', (new Query())
                            ->select('ConvoUserId')
                            ->from('tblconvocationstaffdetails')
                            ->where(['tblconvocationstaffdetails.ConvoStaffPositionId' => 1])
                        ])
                        ->orderBy(['FullName' => SORT_ASC]);

                    echo $form->field($model, 'ConvoUserId')->dropDownList(
                        ArrayHelper::map($query->all(), 'UserId', 'FullName'),
                        [
                            'prompt' => 'Please Select',
                            'class' => 'form-select text-dark border-dark',
                        ]
                    )->label(false);
                }
                else
                {
                    echo $data[0]['FullName'];
                }
                ?>

            </div>

            <div class="col-md-4 mb-2">
                <h6>Email</h6>
                <?= $form->field($model, 'ConvoStaffEmail')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
            </div>

            <div class="col-md-4 mb-2">
                <h6>Mobile No.</h6>
                <?= $form->field($model, 'ConvoStaffMobileNo')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>

            </div>

            <div class="col-md-4 mb-2">
                <h6>Position</h6>
                <?php if ($staffId == 0) {
                    echo $data->ConvoStaffPosition;
                } else {
                    echo $data[0]['ConvoStaffPosition'];
                } ?>
            </div>

            <div class="col-md-4 mb-4">
                <?= $form->field($model, 'StatusId')->dropDownList(ArrayHelper::map(Tblstatusai::find()->asArray()->all(), 'StatusId', 'Status'), ['prompt' => 'Please Select', 'class' => 'form-select text-dark border-dark', 'value' => 1]); ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><?php if(isset($posId)){ ?>Register New Staff<?php }else{ ?>Update<?php } ?></button>
            </div>

            <?php ActiveForm::end(); ?>
        </div>