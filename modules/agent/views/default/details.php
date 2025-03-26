<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use app\models\tbldatinpropertytype;
use app\models\Tblstatusai;

?>

<?php

$module = '/' . Yii::$app->controller->module->id;

$urlRedirect = Url::base() . $module . '/default';
$urlDetailsupdate = Url::base() . $module . '/default/detailsupdate';
$_csrf = Yii::$app->request->getCsrfToken();

$UserId = Yii::$app->request->get('UserId');
$mode = Yii::$app->request->get('mode') ?? '';

$urlbase = Url::base().'/web/';

$script = <<< JS

$(document).ready(function () {

    $("#AgentId").submit(function(event) 
    {
        event.preventDefault();

        var formData = $('#AgentId').serializeArray();

        if(($UserId == 0))
        {
            desc = 'Are you sure to register?';
            desc2 = 'You have successfully register the details!'
        }
        else
        {
            desc = 'Are you sure to update?';
            desc2 = 'You have successfully update the details!'
        }
        
        Swal.fire({title:desc,icon:"warning",showCancelButton:!0,confirmButtonColor:"#34c38f",cancelButtonColor:"#f46a6a",confirmButtonText:"Confirm"})
            .then(function(t) 
            {
                if (t.value) {
                    $.ajax({
                        url: '$urlDetailsupdate',
                        type: 'POST',
                        dataType: "json",
                        data: 
                        {
                            UserId : '$UserId',
                            _csrf : '$_csrf',
                            formData : JSON.stringify(formData)
                        },
                        success: function(response) 
                        {
                            t.value&&Swal.fire({title:desc2,icon:"success",confirmButtonColor:"#34c38f",confirmButtonText:"Confirm"})
                            .then(function(t) 
                            {
                                btnClose.click();
                            });
                        },
                        error: function(xhr, status, error) 
                        {
                            alert('Please contact the programmer for more details!');
                        }
                    });
                } 
            });
    });

    $(document).on('click', '.downloadDoc', function() 
    {
        var urlbase = '$urlbase';
        var AgentDocName = urlbase+($(this).data('agentdocname'));
        var AgentDocNameArray = AgentDocName.split(',');

        var downloadLink = document.createElement('a');
        downloadLink.setAttribute('href', AgentDocNameArray[0]);
        downloadLink.setAttribute('download', AgentDocNameArray[1]);
        downloadLink.style.display = 'none';
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
    });

});

JS;
$this->registerJs($script);

?>

<div class="col-12"><?php $form = ActiveForm::begin(['id' => 'AgentId']); ?>
    <div class="card-body mt-0">
        <div class="row">

            <h4 class="mb-3">AGENT DETAILS</h4>

            <div class="col-md-6 mb-3">
                <h6>Registered Business Name</h6>
                <?php
                if ($mode == 'view') {
                    echo $model->FullName;
                } else {
                    echo $form->field($model, 'FullName')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false);
                }
                ?>
            </div>

            <?php

            if ($mode == 'view') {

            }
            ?>

            <div class="col-md-6 mb-3">
                <h6>Company Registration Number</h6>
                <?php
                if ($mode == 'view') {
                    echo $model->ICPassportNo;
                } else {
                    echo $form->field($model, 'ICPassportNo')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false);
                }
                ?>
            </div>

            <div class="col-md-6 mb-3">
                <h6>Business Email Address</h6>
                <?php
                if ($mode == 'view') {
                    echo $model->EmailAddress;
                } else {
                    echo $form->field($model, 'EmailAddress')->textInput(['class' => 'form-control text-dark border-dark', 'type' => 'email', 'required' => 'required'])->label(false);
                }
                ?>
            </div>
            
            <?php

            if ($mode == 'view') {

                ?>

                <?php

                $sql = "SELECT
                UserId, AgentDocName, SUBSTRING_INDEX(AgentDocName, '/', -1) AS DocName                    
                FROM tblagentdocument
                WHERE UserId = " . $UserId;

                $data = \Yii::$app->db->createCommand($sql)->queryAll();


                if (!empty($data)) {
                    $i = 1;
            ?>

                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="cmstable1" class="table  table-striped">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;">No.</th>
                                        <th>Document</th>
                                        <th style="text-align:center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $row) {
                                    ?>
                                        <tr>
                                            <td style="text-align:center;"><?= $i; ?></td>
                                            <td><?= $row['DocName']; ?></td>
                                            <td style="text-align:center;"><button type="button" class="btn btn-primary downloadDoc" data-agentdocname="<?= $row['AgentDocName'].','.$row['DocName']; ?>">Download</button></td>
                                        </tr>
                                    <?php
                                    $i++;    
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
            <?php
                }
                else
                {
                    die('2');
                }
            }
            ?>

            <div class="modal-footer">
                <button id="btnClose" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <?php if ($mode != 'view') { ?>
                    <button type="submit" class="btn btn-primary"><?php if ($UserId == 0) { ?>Register New Agent<?php } else { ?>Update<?php } ?></button>
                <?php } ?>
            </div>

        </div>
    </div> <?php ActiveForm::end(); ?>
</div>