<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use app\models\tbluser;
?>

<?php

$module = '/' . Yii::$app->controller->module->id;

$SafetyId = Yii::$app->request->get('safetyId');
$_csrf = Yii::$app->request->getCsrfToken();


$urlGetStaffSummary = Url::base() . $module . '/default/getstaffsummary';
$urlRemove = Url::base() . $module . '/default/removestaff';

$script = <<<JS

$(document).ready(function() {
    $(document).on('click', '.remove', function () {
        var UserId = $(this).attr('value');
        var SafetyId = '$SafetyId';

        desc = 'Are you sure to remove the staff?';
        desc2 = 'You have successfully remove the staff!'

        Swal.fire({title:desc,icon:"warning",showCancelButton:!0,confirmButtonColor:"#34c38f",cancelButtonColor:"#f46a6a",confirmButtonText:"Confirm"})
        .then(function(t) 
        {
            if (t.isConfirmed) {
                $.ajax({
                    url: '$urlRemove',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        UserId: UserId, 
                        SafetyId: SafetyId 
                    },
                    contentType: false,
                    processData: false,
                    success: function (response) 
                    {
                        if(response.success)
                        {
                            t.value&&Swal.fire({title:desc2,icon:"success",confirmButtonColor:"#34c38f",confirmButtonText:"Confirm"})
                            .then(function(t) 
                            { 
                                if (t.value)
                                {
                                    // window.close();
                                    // btnClose.click();
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
            }
        });

    });

    $('#btnSubmit').click(function()
    {});


});
JS;
$this->registerJs($script);


?>

<div class="col-12"><?php $form = ActiveForm::begin(['id' => 'SafetyId']); ?>
    <div class="card-body">
        <div class="row mb-3">
            <h5>Assigned Staff</h5>
            <div class="col-md-12">
                <div class="table-rep-plugin">
                    <div class="table-responsive">
                        <table id="table1" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $row) { ?>
                                    <tr>
                                        <td><?= $row['FullName']; ?></td>
                                        <td class="text-center"><button type="button" class="btn btn-danger btn-sm waves-effect waves-light remove" value="<?= $row['UserId']; ?>">Remove</button></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <h6>Staff In-charge:</h6>
                <?= Html::dropDownList(
                    'UserId',
                    null,
                    ArrayHelper::map(tbluser::find()
                        ->select(['tbluser.UserId', 'FullName', 'tbluser.DepartmentId', 'DepartmentDesc'])
                        ->innerJoin('tbldepartment', 'tbldepartment.DepartmentId = tbluser.DepartmentId')
                        ->where(['tbluser.StatusId' => 1, 'tbluser.DepartmentId' => [37]])
                        ->asArray()
                        ->all(), 'UserId', 'FullName'),
                    [
                        'prompt' => 'Please Select',
                        'class' => 'form-control'
                    ]
                );
                ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btnSubmit" class="btn btn-primary">Assign</button>
            </div>
        </div>
    </div> <?php ActiveForm::end(); ?>
</div>