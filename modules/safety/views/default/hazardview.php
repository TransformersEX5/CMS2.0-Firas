<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use app\modules\datin\models\tblsafety;
// use app\models\Tblstatusai;

?>

<?php

$module = '/' . Yii::$app->controller->module->id;


$urlSubmit = Url::base() . $module . '/default/hazarddetails';
$_csrf = Yii::$app->request->getCsrfToken();

$script = <<< JS

$(document).ready(function() 
{

});


JS;
$this->registerJs($script);

?>

<div class="col-12">
    <div class="card-body mt-0">
        <div class="row">
            <div class="col-6">
                <div id="hazardImage" class="carousel slide mb-4" data-bs-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php $i = 0;
                        foreach ($model as $files) { ?>
                            <li data-bs-target="#hazardImage" data-bs-slide-to="<?= $i ?>" <?php if ($i == 0) { ?>class="active"><?php } ?></li>
                        <?php $i++;
                        } ?>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <?php $i = 0;
                        $location =  \Yii::getAlias('@docsafety');
                        foreach ($model as $files) {

                            if (file_exists($imagePath = $location . '/' . $files->file_name)) {
                                $imageContents = file_get_contents($imagePath);

                                $base64Image = base64_encode($imageContents);
                                $imageType = pathinfo($imagePath, PATHINFO_EXTENSION);
                                $imgSrc = 'data:image/' . $imageType . ';base64,' . $base64Image;
                            } else {
                                $imgSrc = '';
                            }
                        ?>
                            <div class="carousel-item <?php if ($i == 0) { ?>active<?php } ?>">
                                <div class="d-flex justify-content-center">
                                    <img class="d-block img-fluid popup" style="width:300px; height:300px;" src="<?= $imgSrc ?>">
                                </div>
                            </div>
                        <?php $i++;
                        }

                        ?>
                    </div>
                    <?php if (count($model) > 1) { ?>
                        <a class="carousel-control-prev" href="#hazardImage" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon rounded-pill" style="background-color:black;" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#hazardImage" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon rounded-pill" style="background-color:black;" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    <?php } ?>
                </div>
            </div>
            <div class="col-6">
                <div class="col-md-12 mb-4 form-group">
                    <h6>Description</h6>
                    <?= $data[0]['SafetyDesc']; ?>
                </div>

                <div class="col-md-12 mb-4 form-group">
                    <h6>Location</h6>
                    <?= $data[0]['SafetyLocation']; ?>
                </div>

                <div class="col-md-12 mb-4 form-group">
                    <h6>Reported By</h6>
                    <?= $data[0]['ReportedBy']; ?>
                </div>

                <div class="col-md-12 mb-4 form-group">
                    <h6>In-charge(s)</h6>
                    <?= $data[0]['StaffAssigned']; ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class='col-12 .col-sm-12'>
                <h3>Progress Status</h3>
                <div class="box-body">
                    <table id="cmstable1" class="table table-bordered table-hover" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:1%;">No.</th>
                                <th class="text-center" style="width:1%;">Date/Time</th>
                                <th class="text-center">Remarks</th>
                                <th class="text-center" style="width:1%;">Status</th>
                                <th class="text-center" style="width:1%;">Photo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            $location =  \Yii::getAlias('@docsafety');
                            foreach ($data2 as $row) {
                                if (!empty($row['file_name'])) {
                                    if (file_exists($imagePath = $location . '/' . $row['file_name'])) {
                                        $imageContents = file_get_contents($imagePath);

                                        $base64Image = base64_encode($imageContents);
                                        $imageType = pathinfo($imagePath, PATHINFO_EXTENSION);
                                        $imgSrc = 'data:image/' . $imageType . ';base64,' . $base64Image;
                                    } else {
                                        $imgSrc = '';
                                    }
                                }
                            ?>
                                <tr>
                                    <td class="text-center"><?= $i; ?></td>
                                    <td class="text-center"><?= $row['TransactionDate']; ?></td>
                                    <td><?= $row['SafetyRemarks']; ?></td>
                                    <td class="text-center"><?= $row['SafetyStatusDesc']; ?></td>
                                    <td class="text-center"><?php if (!empty($row['file_name'])) { ?><img class="d-block img-fluid popup" style="width:50px; height:50px;" src="<?= $imgSrc ?>"><?php } ?></td>
                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>

<?php

$url = Url::base() . $module . '/default/gethazardhistory';
$encode64 = Url::base() . $module . '/default/encode64?id=';

$_csrf = Yii::$app->request->getCsrfToken();

$script = <<<JS

$(document).ready(function() {
    $(document).on('click', '.popup', function () {
        var img = $(this).attr('src');
        var desc = '<img class="d-block img-fluid" style="width:500px; height:500px;" src="'+img+'">';

        Swal.fire({title:desc,showConfirmButton:0,showCancelButton:!0,width:'800px',confirmButtonColor:"#34c38f",cancelButtonColor:"#f46a6a", cancelButtonText:"Close"})
    });
});


JS;
$this->registerJs($script);

?>