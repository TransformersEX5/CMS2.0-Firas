<?php

use app\models\Tbldocumenttype;
use app\models\Tbleducation;
use app\models\Tblstate;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$backindex = '/application';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id', 0);
?>

<?php $form = ActiveForm::begin([
    'id' => 'uploadDoc',
    // 'enableAjaxValidation' => true,
    // 'enableClientValidation' => false
], ['options' => ['enctype' => 'multipart/form-data']]); ?>

<div class="row">

    <div class="col-md-4">
        <?= $form->field($model, 'DocTypeId')->dropDownList(ArrayHelper::map(Tbldocumenttype::find()->where(['DocumentCategoryId' => 1])->asArray()->all(), 'DocTypeId', 'DocType'), ['prompt' => 'Please select a document type', 'class' => 'form-control'])->label(false)->error(false); ?>
    </div>

    <div class="col-md-8">
    </div>

    <div class="col-md-8">
    </div>

    <div class="col-md-4 mt-4">
        <?= $form->field($model, 'file_name')->fileInput(['class' => 'form-control'])->label(false)->error(false); ?>
    </div>

    <!-- <div class="error-summary"> -->
        <?= $form->errorSummary($model, ['class' => 'mt-3']) ?>
    <!-- </div> -->

</div>

<div class="row">
    <div class="col-md-12 mt-3">
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary w-md">Save</button>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>