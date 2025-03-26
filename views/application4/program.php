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
//     $StudEmailAddress = $profile['StudEmailAddress'];
//     $StudMobileNo     = $profile['StudMobileNo'];
//     $NationalityName  = $profile['StudNationalityId'];
 
//    }

//    echo $StudName;
// echo $message;
// echo print_r($profile);
?>

<?php $form = ActiveForm::begin(); ?>

<div class="col-md-4">
        <?= $form->field($model, 'NationalityId')->dropDownList(Yii::$app->common->getNationality(), [
            'prompt' => '- Nationality -',
            'class' => 'form-select mb-2'
        ]) ?>

    </div>

<div class="col-md-4">
        <?= $form->field($model, 'NationalityId')->dropDownList(Yii::$app->common->getNationality(), [
            'prompt' => '- Nationality -',
            'class' => 'form-select mb-2'
        ]) ?>

    </div>

<div class="col-md-4">
        <?= $form->field($model, 'NationalityId')->dropDownList(Yii::$app->common->getNationality(), [
            'prompt' => '- Nationality -',
            'class' => 'form-select mb-2'
        ]) ?>

    </div>


<div class="col-md-4">
        <?= $form->field($model, 'NationalityId')->dropDownList(Yii::$app->common->getNationality(), [
            'prompt' => '- Nationality -',
            'class' => 'form-select mb-2'
        ]) ?>

    </div>
<?php ActiveForm::end(); ?>
