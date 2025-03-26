<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

// use app\modules\datin\models\tbldatinpropertytype;
// use app\modules\datin\models\Tblstatusai;

?>

<?php

$module = '/' . Yii::$app->controller->module->id;

// $urlGetIsoDocument = Url::base() . $module . '/default/getIsodocument(1)';
$urlDocDownload = Url::base() . $module . '/default/documentdownload';
$urlDocView = Url::base() . $module . '/default/documentview';

$script = <<< JS

    $(document).ready(function() {

        $(document).on('click', '.docDownload', function() {
            var filename = btoa($(this).data('filename'));
            var link = btoa($(this).data('link'));

            window.location.href = '$urlDocDownload?link='+link+'&filename='+filename;
        });

        $(document).on('click', '.docView', function() {
           
            var filename = btoa($(this).data('filename'));
            var link = btoa($(this).data('link'));

            window.open('$urlDocView?link='+link+'&filename='+filename, '_blank');
        })

    });

    JS;
$this->registerJs($script);

?>

<div class="col-12">
    <div class="card"><?php ActiveForm::begin(['id' => 'IsoId', 'options' => ['onsubmit' => 'return false;']]); ?>
        <div class="col-12">
            <h4 class="card-header text-dark bg-white rounded">ISO SOP/POLICIES</h4>
            <h6 class="card-header text-dark bg-white rounded">ISO 9001 is a standard that sets out the requirements for a quality management system. It helps businesses and organizations to be more efficient and improve customer satisfaction.</h6>
        </div>
        <div class="card-body">
            <div class="accordion" id="accordionIso">
                <?php
                $x = 0;
                $y = 1;
                foreach ($model as $row) { ?>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading<?= $y; ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $y; ?>" aria-expanded="false" aria-controls="collapse<?= $y; ?>">
                                <?= $y; ?> - <?= $model[$x]->IsoDepartDecc; ?>
                            </button>
                        </h2>
                        <div id="collapse<?= $y; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $y; ?>" data-bs-parent="#accordionIso">
                            <div class="accordion-body">

                                <?php

                                $sql = "SELECT
                                QQ.IsodepartdocId,
                                tblisodoctype.IsoDocTypeId,
                                tblisodoctype.IsoDocDescription,
                                QQ.IsoDepartId,
                                COALESCE(QQ.log_filename,'') as log_filename,
                                QQ.link
                                FROM
                                tblisodoctype
                                LEFT JOIN (SELECT
                                tblisodepartdocument.IsodepartdocId,
                                tblisodepartdocument.IsoDepartId,
                                tblisodepartdocument.IsoDocTypeId,
                                tblisodepartdocument.FileCategoryId,
                                tblisodepartdocument.Description,
                                tblisodepartdocument.log_filename,
                                tblisodepartdocument.log_size,
                                tblisodepartdocument.log_ip,
                                tblisodepartdocument.log_date,
                                tblisodepartdocument.link,
                                tblisodepartdocument.FileStatusId,
                                tblisodepartdocument.UserId
                                FROM tblisodepartdocument 
                                WHERE tblisodepartdocument.IsoDepartId = " . $model[$x]->IsoDepartId . " AND tblisodepartdocument.FileCategoryId = 2
                                )QQ ON QQ.IsoDocTypeId = tblisodoctype.IsoDocTypeId
                                ORDER BY tblisodoctype.IsoDocTypeId";

                                $data = Yii::$app->db->createCommand($sql)->queryAll();

                                ?>

                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                                        <table id="tblisodocument" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="20%">Category</th>
                                                    <th width="60%">Document</th>
                                                    <th width="20%" colspan="2" style="text-align:center;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($data as $row) { ?>
                                                    <tr>
                                                        <td><?= $row['IsoDocDescription']; ?></td>
                                                        <td><?= $row['log_filename']; ?></td>
                                                        <?php if ($row['IsoDocDescription'] != '' && $row['log_filename'] != '') { ?>
                                                            <td style="text-align:right;"><button type="button" class="btn btn-primary waves-effect waves-light docView" data-filename="<?= $row['log_filename']; ?>" data-link="<?= $row['link']; ?>">View</button></td>
                                                            <td style="text-align:left;"><button type="button" class="btn btn-primary waves-effect waves-light docDownload" data-filename="<?= $row['log_filename']; ?>" data-link="<?= $row['link']; ?>">Download</button></td>
                                                        <?php } else { ?>
                                                            <td></td>
                                                            <td></td>
                                                        <?php } ?>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                    $x++;
                    $y++;
                } ?>
            </div>
        </div><?php ActiveForm::end(); ?>
    </div>
</div>