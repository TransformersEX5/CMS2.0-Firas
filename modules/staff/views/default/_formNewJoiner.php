<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\modules\staff\models\tbluser $model */
/** @var yii\widgets\ActiveForm $form */
$backindex = '/staff';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');


?>

<?php
/**********************************************************************************/
$create = Url::toRoute(['/staffdetail/create']);





$script = <<<JS

$(document).on('click', '.showModal_StaffDetail_Create', function () {


      var form = $(this);
      $.ajax({
	    	url: '$create',
            type   : 'GET',
			data: {
              // DepartmentId: $("#select_id").val(),
              
                 },
             success: function (response) 
            { // console.log(response);
              //  toastr.success("",response.message); 
              // console.log(response.message);

          
        
				$("#modal-lg").modal("show");
                $("#modalContent-lg").html(response).modal();							
				document.getElementById('modalHeader-lg').innerHTML = '<h4>Create Department</h4>';    
        
				//console.log(response);
       

            },
            error  : function (e) {
				
               // console.log(e);
            }
        });
    return false;        
  });
 
 
 
  /**********************************************************************************/
  $(document).ready(function() {
        var modal = document.getElementById('modal-lg');
        modal.addEventListener('hidden.bs.modal', function (e) {
            $('#cmstable1').DataTable().ajax.reload();
        });
    });

  

JS;
$this->registerJs($script);

?>
<div class="tbluser-form">
<?php $form = ActiveForm::begin([
                    'id' => 'staff_new',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => true,
                    'options' => ['enctype' => 'multipart/form-data']
                ]); ?>


    <div id="toast-container" class="toast-top-right"></div>

    <div class="tbluser-index">

        <div class="row">
            <div class="col-lg-12">

               

                <!-- ******Start Staff Profile****************************************************************************************************************** -->

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex text-white bg-warning   ">
                            <h4 class="card-title mb-0 flex-grow-1">Staff Detail</h4>
                            <div class="flex-shrink-0">
                                <div class="form-check form-switch form-switch-right form-switch-md">
                                    <button id="New" class="showModal_StaffDetail_Create btn btn-secondary btn-sm" type="button"> New Staff<i class="icon-file"></i></button>
                                    <button id="Edit" class="showModal_StaffDetail_Edit btn btn-secondary btn-sm" type="button"> Edit Staff<i class="icon-file"></i></button>
                                    <button id="Print" class="showModal_StaffDetail_Print btn btn-secondary btn-sm" type="button"> Print <i class="icon-file"></i></button>
                                </div>
                            </div>

                        </div><!-- end card header -->


                        <div class="card-body">


                            <div class="row">
                                <div class="col col-lg-8 mt-2">
                                    Full Name : <?= $form->field($model, 'FullName')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3 mt-2">
                                    NIRC/Passport No :
                                    <?= $form->field($model, 'ICPassportNo')->textInput(['maxlength' => true]) ?>
                                </div>

                                <div class="col-3 mt-2">
                                    Nationality:
                                    <?= $form->field($model, 'NationalityId')->dropDownList(Yii::$app->common->getNationality(), [
                                        'prompt' => '-  Nationality   -',
                                        'class' => 'form-select mb-2',
                                        'id' => 'NationalityId'
                                    ]) ?>
                                </div>


                                <div class="col-3 mt-2">
                                    Gender :
                                    <?= $form->field($model, 'Gender')->dropDownList(Yii::$app->common->getGender(), [
                                        'prompt' => '-  Gender   -',
                                        'class' => 'form-select mb-2',
                                        'id' => 'GenderId'
                                    ]) ?>
                                </div>

                            </div>


                            <div class="row">

                                <div class="col-3 mt-2">
                                    User Dob:
                                    <div class="input-group" id="datepicker2">
                                        <?= $form->field($model, 'UserDOB')->textInput(['maxlength' => true, 'placeholder' => "dd-mm-yyyy", 'data-date-format' => "dd-mm-yyyy", 'data-provide' => "datepicker", 'data-date-autoclose' => "true", 'data-date-container' => "#datepicker2"]); ?>
                                        <!-- <span class="input-group-text"><i class="mdi mdi-calendar"></i></span> -->
                                    </div>
                                </div>

                                <div class="col-3 mt-2">
                                    Religion:
                                    <?= $form->field($model, 'ReligionId')->dropDownList(Yii::$app->common->getReligion(), [
                                        'prompt' => '-  Religion   -',
                                        'class' => 'form-select mb-2',
                                        'id' => 'ReligionId'
                                    ]) ?>
                                </div>

                                <div class="col-3 mt-2">
                                    Marital Status:
                                    <?= $form->field($model, 'MaritalStatusId')->dropDownList(Yii::$app->common->getMarital(), [
                                        'prompt' => '-  Marital Status   -',
                                        'class' => 'form-select mb-2',
                                        'id' => 'MaritalStatusId'
                                    ]) ?>
                                </div>

                                <div class="row">
                                    <div class="col-4 mt-2">
                                        CityU Email Address (@city.edu.my) :
                                        <?= $form->field($model, 'EmailAddress')->textInput(['maxlength' => true]) ?>
                                    </div>

                                    <div class="col-4 mt-2">
                                        Personal Email Address :
                                        <?= $form->field($model, 'PersonalEmail')->textInput(['maxlength' => true]) ?>
                                    </div>

                                    <div class="col-3 mt-2">
                                        Hand Set No :
                                        <?= $form->field($model, 'HandSetNo')->textInput(['maxlength' => true]) ?>
                                    </div>


                                </div>



                                <div class="col-4 mt-2">
                                    Location:
                                    <?= $form->field($model, 'BranchId')->dropDownList(Yii::$app->common->getBranchName(), [
                                        'prompt' => '-  Location    -',
                                        'class' => 'form-select mb-2',
                                        'id' => 'BranchId'
                                    ]) ?>
                                </div>


                                <!-- 
                                <div class="col-6 mt-2">
                                    <?= $form->field($model, 'Remarks')->textarea(['rows' => '3']) ?>

                                </div> -->



                            </div>
                        </div>
                    </div>
                </div>

                <!-- =====End Staff Profile========================================================================================================= -->



                <!-- *****Start Position******************************************************************************************************************* -->

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex text-white bg-warning   ">
                            <h4 class="card-title mb-0 flex-grow-1">Position</h4>
                            <div class="flex-shrink-0">
                                <div class="form-check form-switch form-switch-right form-switch-md">
                                    <button id="New" class="showModal_New btn btn-secondary btn-sm" type="button"> New Position <i class="icon-file"></i></button>
                                </div>
                            </div>
                        </div><!-- end card header -->

                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table align-middle table-centered table-vertical table-nowrap mb-1">

                                    <tbody>
                                        <tr>
                                            <td>#12354781</td>
                                            <td>
                                                <img src="assets/images/users/user-1.jpg" alt="user-image" class="avatar-xs me-2 rounded-circle" /> Riverston Glass Chair
                                            </td>
                                            <td><span class="badge rounded-pill bg-success">Delivered</span></td>
                                            <td>
                                                $185
                                            </td>
                                            <td>
                                                5/12/2016
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>#52140300</td>
                                            <td>
                                                <img src="assets/images/users/user-2.jpg" alt="user-image" class="avatar-xs me-2 rounded-circle" /> Shine Company Catalina
                                            </td>
                                            <td><span class="badge rounded-pill bg-success">Delivered</span></td>
                                            <td>
                                                $1,024
                                            </td>
                                            <td>
                                                5/12/2016
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>




                <!-- *****Date Join / Contract******************************************************************************************************************* -->

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex text-white bg-warning   ">
                            <h4 class="card-title mb-0 flex-grow-1">Date Join / Contract / Working Status</h4>
                            <div class="flex-shrink-0">
                                <div class="form-check form-switch form-switch-right form-switch-md">
                                    <button id="New" class="showModal_New btn btn-secondary btn-sm" type="button"> Date Join / Contract <i class="icon-file"></i></button>
                                </div>
                            </div>
                        </div><!-- end card header -->

                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table align-middle table-centered table-vertical table-nowrap mb-1">

                                    <tbody>
                                        <tr>
                                            <td>#12354781</td>
                                            <td>
                                                <img src="assets/images/users/user-1.jpg" alt="user-image" class="avatar-xs me-2 rounded-circle" /> Riverston Glass Chair
                                            </td>
                                            <td><span class="badge rounded-pill bg-success">Delivered</span></td>
                                            <td>
                                                $185
                                            </td>
                                            <td>
                                                5/12/2016
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>#52140300</td>
                                            <td>
                                                <img src="assets/images/users/user-2.jpg" alt="user-image" class="avatar-xs me-2 rounded-circle" /> Shine Company Catalina
                                            </td>
                                            <td><span class="badge rounded-pill bg-success">Delivered</span></td>
                                            <td>
                                                $1,024
                                            </td>
                                            <td>
                                                5/12/2016
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                            </td>
                                        </tr>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>




                <!-- *****Approval/HOD******************************************************************************************************************* -->

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex text-white bg-warning   ">
                            <h4 class="card-title mb-0 flex-grow-1">Approval/HOD</h4>
                            <div class="flex-shrink-0">
                                <div class="form-check form-switch form-switch-right form-switch-md">
                                    <button id="New" class="showModal_New btn btn-secondary btn-sm" type="button"> New Approval/HOD <i class="icon-file"></i></button>
                                </div>
                            </div>

                        </div><!-- end card header -->

                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table align-middle table-centered table-vertical table-nowrap mb-1">

                                    <tbody>
                                        <tr>
                                            <td>#12354781</td>
                                            <td>
                                                <img src="assets/images/users/user-1.jpg" alt="user-image" class="avatar-xs me-2 rounded-circle" /> Riverston Glass Chair
                                            </td>
                                            <td><span class="badge rounded-pill bg-success">Delivered</span></td>
                                            <td>
                                                $185
                                            </td>
                                            <td>
                                                5/12/2016
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>#52140300</td>
                                            <td>
                                                <img src="assets/images/users/user-2.jpg" alt="user-image" class="avatar-xs me-2 rounded-circle" /> Shine Company Catalina
                                            </td>
                                            <td><span class="badge rounded-pill bg-success">Delivered</span></td>
                                            <td>
                                                $1,024
                                            </td>
                                            <td>
                                                5/12/2016
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- *****Working days******************************************************************************************************************* -->

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex text-white bg-warning   ">
                            <h4 class="card-title mb-0 flex-grow-1"> Working days</h4>
                            <div class="flex-shrink-0">
                                <div class="form-check form-switch form-switch-right form-switch-md">
                                    <button id="New" class="showModal_New btn btn-secondary btn-sm" type="button"> Working Days <i class="icon-file"></i></button>
                                </div>
                            </div>
                        </div><!-- end card header -->

                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table align-middle table-centered table-vertical table-nowrap mb-1">

                                    <tbody>
                                        <tr>
                                            <td>#12354781</td>
                                            <td>
                                                <img src="assets/images/users/user-1.jpg" alt="user-image" class="avatar-xs me-2 rounded-circle" /> Riverston Glass Chair
                                            </td>
                                            <td><span class="badge rounded-pill bg-success">Delivered</span></td>
                                            <td>
                                                $185
                                            </td>
                                            <td>
                                                5/12/2016
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>#52140300</td>
                                            <td>
                                                <img src="assets/images/users/user-2.jpg" alt="user-image" class="avatar-xs me-2 rounded-circle" /> Shine Company Catalina
                                            </td>
                                            <td><span class="badge rounded-pill bg-success">Delivered</span></td>
                                            <td>
                                                $1,024
                                            </td>
                                            <td>
                                                5/12/2016
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                            </td>
                                        </tr>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- *****Document******************************************************************************************************************* -->

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex text-white bg-warning   ">
                            <h4 class="card-title mb-0 flex-grow-1"> Document</h4>
                            <div class="flex-shrink-0">
                                <div class="form-check form-switch form-switch-right form-switch-md">
                                    <button id="New" class="showModal_New btn btn-secondary btn-sm" type="button"> Upload Document <i class="icon-file"></i></button>
                                </div>
                            </div>
                        </div><!-- end card header -->

                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table align-middle table-centered table-vertical table-nowrap mb-1">

                                    <tbody>
                                        <tr>
                                            <td>#12354781</td>
                                            <td>
                                                <img src="assets/images/users/user-1.jpg" alt="user-image" class="avatar-xs me-2 rounded-circle" /> Riverston Glass Chair
                                            </td>
                                            <td><span class="badge rounded-pill bg-success">Delivered</span></td>
                                            <td>
                                                $185
                                            </td>
                                            <td>
                                                5/12/2016
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>#52140300</td>
                                            <td>
                                                <img src="assets/images/users/user-2.jpg" alt="user-image" class="avatar-xs me-2 rounded-circle" /> Shine Company Catalina
                                            </td>
                                            <td><span class="badge rounded-pill bg-success">Delivered</span></td>
                                            <td>
                                                $1,024
                                            </td>
                                            <td>
                                                5/12/2016
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                            </td>
                                        </tr>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- *****Remarks******************************************************************************************************************* -->

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex text-white bg-warning   ">
                            <h4 class="card-title mb-0 flex-grow-1"> Remarks</h4>
                            <div class="flex-shrink-0">
                                <div class="form-check form-switch form-switch-right form-switch-md">
                                    <button id="New" class="showModal_New btn btn-secondary btn-sm" type="button"> Add Remarks <i class="icon-file"></i></button>
                                </div>
                            </div>
                        </div><!-- end card header -->

                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table align-middle table-centered table-vertical table-nowrap mb-1">

                                    <tbody>
                                        <tr>
                                            <td>#12354781</td>
                                            <td>
                                                <img src="assets/images/users/user-1.jpg" alt="user-image" class="avatar-xs me-2 rounded-circle" /> Riverston Glass Chair
                                            </td>
                                            <td><span class="badge rounded-pill bg-success">Delivered</span></td>
                                            <td>
                                                $185
                                            </td>
                                            <td>
                                                5/12/2016
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>#52140300</td>
                                            <td>
                                                <img src="assets/images/users/user-2.jpg" alt="user-image" class="avatar-xs me-2 rounded-circle" /> Shine Company Catalina
                                            </td>
                                            <td><span class="badge rounded-pill bg-success">Delivered</span></td>
                                            <td>
                                                $1,024
                                            </td>
                                            <td>
                                                5/12/2016
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                            </td>
                                        </tr>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ======Approval/HOD End======================================================================================================== -->


            </div>


        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>

