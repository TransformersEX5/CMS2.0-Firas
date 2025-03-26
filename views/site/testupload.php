

<?php

use yii\widgets\ActiveForm;


$form = ActiveForm::begin(['id' => 'Test123'], ['options' => ['enctype' => 'multipart/form-data']]); ?>


<?= $form->field($model, 'imageFile')->fileInput()->label(false) ?>

<br>
<button type="submit" name="submit_save" class="btn waves-effect waves-light btn btn-success">Save</button>


<?php ActiveForm::end(); ?>