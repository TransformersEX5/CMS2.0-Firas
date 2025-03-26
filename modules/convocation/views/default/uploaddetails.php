<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

?>

<?php

$_csrf = Yii::$app->request->getCsrfToken();

// $script = <<< JS



// JS;
// $this->registerJs($script);

?>

<div class="col-12"><?php $form = ActiveForm::begin([
    // 'id' => 'AId',
    // 'enableAjaxValidation' => true,
    // 'enableClientValidation' => true],[
    'options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="card-body">
        <div class="row">

            <h4 class="mb-3">UPLOAD DETAILS</h4>

            <div class="col-md-12 mb-3">
                <h6>Please make sure to follow the following instructions when uploading the pictures.</h6>


                <ol type="i">
                    <li><label>Please upload only an appropriate image.</label></li>
                    <li><label>Only .png and .jpg file formats are acceptable.</label></li>
                    <li><label>Maximum number of images per upload: 20</label></li>
                    <li><label>Recommended resolution for the images is 1920x1080.</label></li>
                </ol>

                <label>Upload here</label>

                <?= $form->field($model, 'fileToUpload[]')->fileInput(['multiple' => true])->label(false); ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <?= Html::submitButton('Upload', ['class' => 'btn btn-primary']); ?>
                <!-- <button type="submit" class="btn btn-primary">Upload</button> -->
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>