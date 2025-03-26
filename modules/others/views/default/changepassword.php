<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\base\Security;

use app\models\tbluser;
use app\modules\marketingadmin\models\Tblmarketingteam;

$this->title = Yii::t('app', 'Change Password');
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.min.js"></script>

<?php

$UserId = $model->UserId;
$UserPassword = $model->UserPassword;

$module = '/' . Yii::$app->controller->module->id;

$updatepassword = Url::base() . $module . '/default/updatepassword';
$_csrf = Yii::$app->request->getCsrfToken();

$script = <<< JS

$(document).ready(function () {

    $('#newPassword').on('input', function() {
        var newPassword = $(this).val();
        if (newPassword.length < 6) {
            $('#minpasswordError').show();
        } else {
            $('#minpasswordError').hide();
        }
    });

    $('#renewPassword').on('input', function() {
        var newPassword = $('#newPassword').val();
        var renewPassword = $(this).val();
        if (newPassword !== renewPassword) {
            $('#passwordError').show();
        } else {
            $('#passwordError').hide();
        }
    });

    $('#btnSubmit').click(function()
    {
        event.preventDefault();

        var UserPassword = '$UserPassword';
        var currentPassword = $('#currentPassword').val();

        if(md5(currentPassword) == UserPassword)
        {
            if ($('#newPassword').val().length >= 6)
            {
                if($('#newPassword').val() == $('#renewPassword').val())
                {
                    var form = $('#ChangePasswordId');
                    var formData = new FormData(form[0]);

                    desc = 'Are you sure to change the password?';
                    desc2 = 'You have successfully changed your password!'

                    Swal.fire({title:desc,icon:"warning",showCancelButton:!0,confirmButtonColor:"#34c38f",cancelButtonColor:"#f46a6a",confirmButtonText:"Confirm"})
                    .then(function(t) 
                    {
                        $.ajax({
                            url: '$updatepassword',
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
                }
                else
                {
                    desc = 'The passwords entered do not match. Please try again.';

                    Swal.fire({title:desc,icon:"error",showConfirmButton:!1,showCancelButton:!0,cancelButtonColor:"#f46a6a",cancelButtonText:"Close"})
                }
            }
            else
            {
                desc = 'New password must be at least 6 characters long.';

                Swal.fire({title:desc,icon:"error",showConfirmButton:!1,showCancelButton:!0,cancelButtonColor:"#f46a6a",cancelButtonText:"Close"})
            }
        }
        else
        {
            desc = 'Your current password is incorrect. Please try again.';

            Swal.fire({title:desc,icon:"error",showConfirmButton:!1,showCancelButton:!0,cancelButtonColor:"#f46a6a",cancelButtonText:"Close"})
        }
    });
});

JS;
$this->registerJs($script);

?>

<div class="tbluser-index">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex text-white bg-warning">
                    <h4 class="card-title mb-0 flex-grow-1">
                        <?= $this->title ?>
                    </h4>
                </div>
                <?php $form = ActiveForm::begin(['Id' => 'ChangePasswordId']); ?>
                <div class="card-body">
                    <div class='col-3 mb-3'>
                        <h6>Current Password</h6>
                        <?php
                        echo Html::passwordInput('currentPassword', '', [
                            'id' => 'currentPassword',  // ID added here
                            'class' => 'form-control text-dark border-dark',
                            'required' => true,
                            'placeholder' => 'Enter current password'
                        ]);
                        ?>
                    </div>
                    <div class='col-3 mb-3'>
                        <h6>New Password</h6>
                        <?php
                        echo Html::passwordInput('newPassword', '', [
                            'id' => 'newPassword',
                            'class' => 'form-control text-dark border-dark',
                            'required' => true,
                            'placeholder' => 'Enter new password',
                            'minlength' => 6
                        ]);
                        ?>
                        <div id="minpasswordError" class="text-danger" style="display: none;">Password must be at least 6 characters long.</div>
                    </div>
                    <div class='col-3 mb-3'>
                        <h6>Re-enter New Password</h6>
                        <?php
                        echo Html::passwordInput('renewPassword', '', [
                            'id' => 'renewPassword',
                            'class' => 'form-control text-dark border-dark',
                            'required' => true,
                            'placeholder' => 'Re-enter new password',
                            'minlength' => 6
                        ]);
                        ?>
                        <div id="passwordError" class="text-danger" style="display: none;">Passwords do not match!</div>
                    </div>
                    <div class="modal-footer">
                        <button id="btnSubmit" type="submit" class="btn btn-primary">Update</button>
                    </div>

                </div> <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>