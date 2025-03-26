<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\Models\AuthItem $model */
/** @var yii\widgets\ActiveForm $form */
// $backindex = '/auth-item';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');

?>

<?php $form = ActiveForm::begin([
    'id' => 'claim_p2',
    //'enableAjaxValidation' => true,
]); ?>


<div class="form-group mb-3">

    <?= $form->field($model, 'P2')->textInput(['id' => 'p2', 'placeholder' => "example 202401"]) ?>

</div>


<div class="form-group mt-3">

    <?php

    echo Html::button('Close', ['id' => 'closeButton', 'class' => 'btn btn-warning me-2', 'data-bs-dismiss' => 'modal']);
    echo Html::Button('View Report', ['class' => 'showModal_Statement_P2  btn btn-success', 'id' => 'btnApply']);

    ?>

</div>




<?php ActiveForm::end(); ?>



<?php
$rpestsement = Url::toRoute(['/reportgallery/report']);

$js = <<< JS



$(document).on('click', '.showModal_Statement_P2', function () {
    
    
    var rpt = "3_rpt_marketing_p2.php";
    var param1 = $("#p2").val();
    
var url = "$rpestsement?rpt="+rpt+"&param1="+encodeURIComponent(param1); 

window.open(url, "_blank");
  
  
  });



JS;
$this->registerJs($js);

?>