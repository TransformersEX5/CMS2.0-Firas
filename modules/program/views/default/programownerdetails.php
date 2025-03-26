<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use app\models\tbluser;

?>

<?php

$mode = Yii::$app->request->get('view') ?? Yii::$app->request->get('edit');

$module = '/' . Yii::$app->controller->module->id;

$ProgramId = $model->ProgramId;

$urlUpdate = Url::base() . $module . '/default/update';
$_csrf = Yii::$app->request->getCsrfToken();

$script = <<< JS

$(document).ready(function () {

    $("#aId").submit(function(event) 
    {
        event.preventDefault();

        var formData = $('#aId').serializeArray();

        desc = 'Are you sure to update?';
        desc2 = 'You have successfully update the details!'

        
        Swal.fire({title:desc,icon:"warning",showCancelButton:!0,confirmButtonColor:"#34c38f",cancelButtonColor:"#f46a6a",confirmButtonText:"Confirm"})
            .then(function(t) 
            {
                if (t.value) {
                    $.ajax({
                        url: '$urlUpdate',
                        type: 'POST',
                        dataType: "json",
                        data: 
                        {
                            ProgramId : '$ProgramId',
                            _csrf : '$_csrf',
                            formData : JSON.stringify(formData)
                        },
                        success: function(response) 
                        {
                            t.value&&Swal.fire({title:desc2,icon:"success",confirmButtonColor:"#34c38f",confirmButtonText:"Confirm"})
                        },
                        error: function(xhr, status, error) 
                        {
                            alert('Please contact the programmer for more details!');
                        }
                    });
                } 
            });
    });

});

JS;
$this->registerJs($script);

?>

<div class="col-12"><?php $form = ActiveForm::begin(['Id' => 'aId']); ?>
    <div class="card-body mt-0">
        <div class="row">

            <div class="col-md-6 mb-2">

                <h6>Program Type</h6>
                <?= $data[0]['ProgramTypeName']; ?>
                <br><br>
                <h6>Program Code</h6>
                <?= $data[0]['ProgramCode']; ?>
                <br><br>
                <h6>Program Name</h6>
                <?= $data[0]['ProgramName']; ?>
                <br><br>
                <h6>Program Name 2</h6>
                <?= $data[0]['ProgramName2']; ?>

            </div>

            <div class="col-md-6 mb-2">

                <h6>Program Coordinator</h6>
                <?php if ($mode == 'View') {
                    echo $data[0]['HOPName'];
                    echo '<br>';
                } else {
                    echo $form->field($model, 'PCId')->dropDownList(
                        ArrayHelper::map(
                            tbluser::find()
                                ->select(['tbluser.UserId', 'FullName'])
                                ->innerJoin('tbldepartment', 'tbldepartment.DepartmentId = tbluser.DepartmentId')
                                ->where([
                                    'or',
                                    [
                                        'and',
                                        ['PositionId' => [89, 185, 291, 300, 343]],
                                        ['tbluser.StatusId' => 1],
                                    ],
                                    [
                                        'and',
                                        ['NOT LIKE', 'FullName', '-TBA'],
                                        ['NOT LIKE', 'FullName', 'SA-%'],
                                        ['tbldepartment.DeptCatId' => [1, 2]],
                                        ['WorkingStatusId' => [1, 3, 11, 14, 15]],
                                        ['tbluser.StatusId' => 1],
                                    ],
                                ])
                                ->orderBy(['FullName' => SORT_ASC])
                                ->asArray()
                                ->all(),
                            'UserId',
                            'FullName'
                        ),
                        ['prompt' => 'Please Select', 'class' => 'form-select text-dark border-dark statusDropdown', 'required' => 'required']
                    )->label(false);
                } ?>

                <br>

                <h6>Head of Program</h6>
                <?php if ($mode == 'View') {
                    echo $data[0]['PCName'];
                    echo '<br>';
                } else {
                    echo $form->field($model, 'HOPId')->dropDownList(
                        ArrayHelper::map(
                            tbluser::find()
                                ->select(['tbluser.UserId', 'tbluser.FullName'])
                                ->innerJoin('tbldepartment', 'tbldepartment.DepartmentId = tbluser.DepartmentId')
                                ->where(['NOT LIKE', 'FullName', '-TBA'])
                                ->andWhere(['NOT LIKE', 'FullName', 'SA-%'])
                                ->andWhere(['tbldepartment.DeptCatId' => [1, 2]])
                                ->andWhere(['WorkingStatusId' => [1, 3, 11, 14, 15]])
                                ->andWhere(['tbluser.StatusId' => 1])
                                ->orderBy(['FullName' => SORT_ASC])
                                ->asArray()
                                ->all(),
                            'UserId',
                            'FullName'
                        ),
                        ['prompt' => 'Please Select', 'class' => 'form-select text-dark border-dark statusDropdown', 'required' => 'required']
                    )->label(false);
                } ?>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <?php if ($mode == 'Edit') { ?><button type="submit" class="btn btn-primary">Update</button><?php } ?>
            </div>

        </div>
    </div> <?php ActiveForm::end(); ?>
</div>