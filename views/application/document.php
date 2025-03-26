<?php

use app\models\Tblapplication;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<div class="col-md-12">
    <h5><?= $model->StudName ?>
        <div class="text-end">
            <?= $model->AppNo ?? '' ?><br><?= $model->ApplicationId ?? '' ?>
        </div>
    </h5>
</div>

<div class="col-md-12 mt-2">

    <h5>Documents</h5>
    <hr>

    <input type="hidden" name="fn" id="fn" />

    <div class="col-md-12 mb-2">
        <div class="d-flex justify-content-end">
            <button value="<?= Url::base() . '/application/newdocument?id=' . base64_encode($model->ApplicationId) ?>" title="Upload Document" type="button" class="showModal btn btn-sm btn-primary rounded-pill me-2">Upload</button>
            <button onclick="openNewLink('<?= Url::base() . '/application/viewdocument?fn=' ?>')" type="button" class="btn btn-sm btn-primary rounded-pill me-2">View</button>
            <button onclick="openNewLink('<?= Url::base() . '/application/deletedocument?fn=' ?>')" type="button" class="btn btn-sm btn-danger rounded-pill">Delete</button>
        </div>
    </div>

    <div class="table-responsive">
        <table id="tblstuddoc" class="table table-striped table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Type</th>
                    <th>Name</th>
                    <th>Uploaded By</th>
                    <th>Uploaded At</th>
                </tr>
            </thead>
        </table>
    </div>
</div>