<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use app\models\tbluser;
use app\modules\safety\models\tblsafetyincharge;

?>

<?php

$module = '/' . Yii::$app->controller->module->id;

$SafetyId = Yii::$app->request->get('safetyId');
$_csrf = Yii::$app->request->getCsrfToken();


$urlGetStaffSummary = Url::base() . $module . '/default/getstaffsummary';
$urlAssign = Url::base() . $module . '/default/assignstaff';
$urlRemove = Url::base() . $module . '/default/removestaff';

$refreshTable = Url::base() . $module . '/default/refreshtable';

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
                    url: '$urlRemove?SafetyId='+SafetyId+'&UserId='+UserId,
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        SafetyId: SafetyId,
                        UserId: UserId, 
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
                                    $.ajax({
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
            }
        });
    });

    $('#btnSubmit').click(function()
    {
        if($('#UserId').val() != '')
        {
            event.preventDefault();

            var SafetyId = '$SafetyId';
            var form = $('#SafetyInchargeId');
            var formData = new FormData(form[0]);

            desc = 'Are you sure assign the staff?';
            desc2 = 'You have successfully assign the staff!'

            Swal.fire({title:desc,icon:"warning",showCancelButton:!0,confirmButtonColor:"#34c38f",cancelButtonColor:"#f46a6a",confirmButtonText:"Confirm"})
            .then(function(t) 
            {
                if (t.isConfirmed) {
                    $.ajax({
                        url: '$urlAssign?SafetyId='+SafetyId,
                        type: 'POST',
                        dataType: 'json',
                        data: formData,
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
                                        $.ajax({
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
                } else {

                }
            });
        }
        else
        {
            alert('Please select a staff!');
        }

    });
});
JS;
$this->registerJs($script);


?>

<div class="col-12"><?php $form = ActiveForm::begin(['id' => 'SafetyInchargeId']); ?>
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
                    ArrayHelper::map(
                        tbluser::find()
                            ->select(['tbluser.UserId', 'FullName', 'tbluser.DepartmentId', 'DepartmentDesc'])
                            ->innerJoin('tbldepartment', 'tbldepartment.DepartmentId = tbluser.DepartmentId')
                            ->where([
                                'tbluser.StatusId' => 1,
                                'tbluser.DepartmentId' => 37,
                            ])
                            ->andWhere([
                                'NOT IN', 'tbluser.UserId', tblsafetyincharge::find()
                                    ->select('tblsafetyincharge.UserId')
                                    ->where(['tblsafetyincharge.SafetyId' => $SafetyId])
                            ])
                            ->orderBy(['FullName' => SORT_ASC])
                            ->asArray()
                            ->all(),
                        'UserId',
                        'FullName'
                    ),
                    [
                        'id' => 'UserId',
                        'prompt' => 'Please Select',
                        'class' => 'form-control',
                    ]
                );
                ?>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btnSubmit" class="btn btn-primary">Assign</button>
            </div>
        </div>
    </div><?php ActiveForm::end(); ?>
</div>