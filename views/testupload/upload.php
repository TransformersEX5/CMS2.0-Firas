<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = $model->id=1;

?>



<div class="tbldepartment-index">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex text-white bg-warning   ">
                    <h4 class="card-title mb-0 flex-grow-1">
                        <?= $this->title ?>
                    </h4>

                    
                </div><!-- end card header -->

                <div class="card-body">

                    <!-- Content here Start -->

                    

                    <div class="row">
                        <div class="col-md-6">
                            <?php 

                                    $form = ActiveForm::begin(
                                        ['options' => ['enctype' => 'multipart/form-data']]
                                    );
                                 


                                    echo $form->field($model, 'filename')->textInput(['maxlength' => true]) ;

                                    echo $form->field($model, 'eventImage')->fileInput();

                                    //echo $form->field($model, 'eventImage[]')->fileInput(['multiple' => true]) ;

                                    echo Html::submitButton('Upload', ['class' => 'btn btn-primary']);

                                    ActiveForm::end();
                                    ?>
                        </div>
                    </div>


                    
                </div>
            </div>
        </div>
    </div>
</div>


<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<!-- Include the Toastr JS file from CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>