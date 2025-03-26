<?php

use app\models\Tblapplication;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$backindex = '/application';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');
?>

<?php

//    foreach($profile as $profile){

//     $StudName         = $profile['StudName'];
//     $StudEmailAddress = $profile['EmailAddress'];
//     $StudMobileNo     = $profile['MobileNo'];
//     $NationalityName  = $profile['NationalityId'];

//    }

//    echo $StudName;
// echo $message;
// echo print_r($profile);
?>

<?php $form = ActiveForm::begin(); ?>


<div class="row">
    <div class="col-lg-8">

        <div class="mb-3">
            <label class="form-label" for="formrow-password-input">Company Name</label>
            <input type="password" class="form-control" id="formrow-password-input" placeholder="Company Name">
        </div>


        <div class="mb-3">
            <label class="form-label" for="formrow-firstname-input">Company Address</label>
            <input type="text" class="form-control" id="formrow-firstname-input" placeholder="Company  Address">
        </div>

        <div class="mb-3">
            <label class="form-label" for="formrow-firstname-input">Position</label>
            <input type="text" class="form-control" id="formrow-firstname-input" placeholder="Position">
        </div>

        <div class="col-md-4">
            <label class="form-label" for="formrow-password-input">From Year</label>
            <input type="password" class="form-control" id="formrow-password-input" placeholder="From Year">
        </div>

        <div class="col-md-4">
            <div class="mb-3">
                <label class="form-label" for="formrow-email-input">Until Year</label>
                <input type="email" class="form-control" id="formrow-email-input" placeholder="Until Year">
            </div>
        </div>

        <div class="col-md-8 mt-2">
        </div>

        <div class="mt-2">
            <button type="submit" class="btn btn-primary w-md">Submit</button>
        </div>

    </div>
</div>

<?php ActiveForm::end(); ?>