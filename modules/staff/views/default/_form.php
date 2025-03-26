<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\staff\models\tbluser $model */
/** @var yii\widgets\ActiveForm $form */
$backindex = '/staff';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');


?>
<div class="tbluser-form">


    <?php $form = ActiveForm::begin([
        'id' => 'staff',
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>


    <div class="row">
        <div class="col-xl-12">
            <!-- <div class="card"> -->
            <!-- <div class="card-body"> -->
            <!-- 
                    <h4 class="card-title">Custom Tabs</h4>
                    <p class="card-title-desc">Example of custom tabs</p> -->

            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                        <span class="d-none d-sm-block">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#workinfo" role="tab">
                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                        <span class="d-none d-sm-block">Work Info</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab">
                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                        <span class="d-none d-sm-block">Remarks</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#settings1" role="tab">
                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                        <span class="d-none d-sm-block">Document</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#settings1" role="tab">
                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                        <span class="d-none d-sm-block">Asset</span>
                    </a>
                </li>

            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active p-3" id="home1" role="tabpanel">
                    <p class="mb-0">


                    <div class="row">
                        <div class="col-6 mt-2">
                            <?= $form->field($model, 'FullName')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 mt-2">
                            <?= $form->field($model, 'ICPassportNo')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-3 mt-2">
                            <div class="input-group" id="datepicker2">
                                <?= $form->field($model, 'UserDOB')->textInput(['maxlength' => true, 'placeholder' => "dd-mm-yyyy", 'data-date-format' => "dd-mm-yyyy", 'data-provide' => "datepicker", 'data-date-autoclose' => "true", 'data-date-container' => "#datepicker2"]); ?>
                                <!-- <span class="input-group-text"><i class="mdi mdi-calendar"></i></span> -->
                            </div>
                        </div>

                        <div class="col-3 mt-2">
                            <?= $form->field($model, 'Gender')->dropDownList(Yii::$app->common->getGender(), [
                                'prompt' => '-  Gender   -',
                                'class' => 'form-select mb-2',
                                'id' => 'GenderId'
                            ]) ?>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-3 mt-2">
                            <?= $form->field($model, 'NationalityId')->dropDownList(Yii::$app->common->getNationality(), [
                                'prompt' => '-  Nationality   -',
                                'class' => 'form-select mb-2',
                                'id' => 'NationalityId'
                            ]) ?>
                        </div>

                        <div class="col-3 mt-2">
                            <?= $form->field($model, 'ReligionId')->dropDownList(Yii::$app->common->getReligion(), [
                                'prompt' => '-  Religion   -',
                                'class' => 'form-select mb-2',
                                'id' => 'ReligionId'
                            ]) ?>
                        </div>

                        <div class="col-3 mt-2">
                            <?= $form->field($model, 'MaritalStatusId')->dropDownList(Yii::$app->common->getMarital(), [
                                'prompt' => '-  Marital Status   -',
                                'class' => 'form-select mb-2',
                                'id' => 'MaritalStatusId'
                            ]) ?>
                        </div>



                    </div>



                    <hr>
                    <strong> Contact Info</strong> <br>

                    <div class="row">
                        <div class="col-4 mt-2">
                            <?= $form->field($model, 'EmailAddress')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-4 mt-2">
                            <?= $form->field($model, 'PersonalEmail')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-3 mt-2">
                            <?= $form->field($model, 'HandSetNo')->textInput(['maxlength' => true]) ?>
                        </div>


                    </div>



                    <div class="col-4 mt-2">
                        <?= $form->field($model, 'BranchId')->dropDownList(Yii::$app->common->getBranchName(), [
                            'prompt' => '-  Location    -',
                            'class' => 'form-select mb-2',
                            'id' => 'BranchId'
                        ]) ?>
                    </div>



                    <div class="col-6 mt-2">
                        <?= $form->field($model, 'Remarks')->textarea(['rows' => '3']) ?>

                    </div>




                </div>




                <div class="tab-pane p-3" id="workinfo" role="tabpanel">
                    <p class="mb-0">
                        <style>
                            table {
                                font-family: arial, sans-serif;
                                border-collapse: collapse;
                                width: 100%;
                            }

                            td,
                            th {
                                border: 1px solid #dddddd;
                                text-align: left;
                                padding: 8px;
                            }

                            tr:nth-child(even) {
                                background-color: #dddddd;
                            }
                        </style>

                    <table>
                        <tr>
                            <th>Company</th>
                            <th>Contact</th>
                            <th>Country</th>
                            <th>Country</th>
                            <th>Country</th>
                            <th>Country</th>

                        </tr>
                        <tr>
                            <td>Alfreds Futterkiste</td>
                            <td>Maria Anders</td>
                            <td>Germany</td>
                            <td>Germany</td>
                            <td>Germany</td>
                            <td>Germany</td>
                        </tr>
                        <tr>
                            <td>Centro comercial Moctezuma</td>
                            <td>Francisco Chang</td>
                            <td>Mexico</td>
                            <td>Germany</td>
                            <td>Germany</td>

                        </tr>
                        <tr>
                            <td>Ernst Handel</td>
                            <td>Roland Mendel</td>
                            <td>Austria</td>
                            <td>Germany</td>
                            <td>Germany</td>
                            <td>Germany</td>
                        </tr>
                        <tr>
                            <td>Island Trading</td>
                            <td>Helen Bennett</td>
                            <td>UK</td>
                            <td>UK</td>
                            <td>UK</td>
                        </tr>
                        <tr>
                            <td>Laughing Bacchus Winecellars</td>
                            <td>Yoshi Tannamuri</td>
                            <td>Canada</td>
                            <td>UK</td>
                            <td>UK</td>
                            <td>UK</td>
                        </tr>
                        <tr>
                            <td>Magazzini Alimentari Riuniti</td>
                            <td>Giovanni Rovelli</td>
                            <td>Italy</td>
                            <td>UK</td>
                            <td>UK</td>
                            <td>UK</td>
                        </tr>
                    </table>

                    </p>



                </div>



                <div class="tab-pane p-3" id="messages1" role="tabpanel">
                    <p class="mb-0">





                    </p>
                </div>
                <div class="tab-pane p-3" id="settings1" role="tabpanel">
                    <p class="mb-0">
                        Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.
                    </p>
                </div>
            </div>

            <!-- </div> -->
            <!-- </div> -->
        </div>
    </div>

    <div class="form-group mt-3">

        <?php
        if ($pageUrl == 'view') {
            //echo Html::a(' Close ', [$backindex], ['class' => 'btn btn-warning col-md-2 col-sm-3 col-xs-3 ']);
            echo Html::button('Close', ['id' => 'closeButton', 'class' => 'btn btn-warning', 'data-bs-dismiss' => 'modal']);
        } else {
            // echo Html::a(' Cancel ', [$backindex], ['class' => 'btn btn-warning col-md-2 col-sm-3 col-xs-3 ']);
            echo Html::button('Close', ['id' => 'closeButton', 'class' => 'btn btn-warning', 'data-bs-dismiss' => 'modal']);
            echo '&nbsp';
            echo Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']);
        }

        ?>
    </div>
    </p>


    <?php ActiveForm::end(); ?>

</div>




<?php


$js = <<< JS


 $(document).ready(function () {

$('#btnApply1').click(function(){

    alert("create1");

});


$('#btnApply2').click(function(){

alert("create2");

});




$('#btnApply').click(function()



    {

        alert("create");


        var form = $('#group-create');
        var formData = new FormData(form[0]);
    
        // $('#btnApply').button('loading');
        

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) 
            {
                if(response.success)
                {
                    toastr.success('Your group has been successfully created');

                //close modal after success
                   $('#closeButton').click();
                }

                else
                {
                    $('.help-block').text('');
                    $('.has-error').removeClass('has-error');
                    
                    $.each(response, function (field, errors) {
                     //   alert(field+errors);

                        var hasErrorSpan = $('.field-tbldebtgroup-' + field.toLowerCase());
                        var errorSpan = $(':input[name="Tbldebtgroup[' + field + ']"]').closest('.form-group').find('.help-block');
                        errorSpan.text(errors.join(' '));
                        hasErrorSpan.addClass('has-error');
                    });
                }
            },
            error: function () 
            {
                //alert('hehe');
               /// window.location.reload();
            }
        });

    });
});

JS;
$this->registerJs($js);

?>