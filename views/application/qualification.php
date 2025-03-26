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

    <h5>Qualifications</h5>
    <hr>

    <input type="hidden" name="StudEducId" id="StudEducId" />

    <div class="col-md-12 mb-2">
        <div class="d-flex justify-content-end">
            <button value="<?= Url::base() . '/application/addqualification?id=' . base64_encode($model->ApplicationId) ?>" title="Add Qualification" type="button" class="showModal btn btn-sm btn-primary rounded-pill me-2">Add</button>
            <button id="btnEditQuali" title="Edit Qualification" type="button" class="showModal btn btn-sm btn-primary rounded-pill">Edit</button>
        </div>
    </div>

    <table id="tblstudeducation" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="15%" class="text-center">Type</th>
                <th width="30%">Examination</th>
                <th width="5%" class="text-center">Year</th>
                <th width="35%">School/Institution</th>
                <th width="10%" class="text-center">Result</th>
            </tr>
        </thead>
    </table>

</div>

<div class="col-md-12 mt-5">

    <h5>Subjects</h5>
    <hr>
    <input type="hidden" name="StudEduSubjId" id="StudEduSubjId" />

    <div class="col-md-12 mb-2">
        <div class="d-flex justify-content-end">
            <button id="btnAddSubject" title="Add Subject" type="button" class="showModal btn btn-sm btn-primary rounded-pill me-2">Add</button>
            <button id="btnEditSubject" title="Edit Subject" type="button" class="showModal btn btn-sm btn-primary rounded-pill">Edit</button>
        </div>
    </div>

    <table id="tblstudeducationsubj" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th width="1%" class="text-center">No</th>
                <th width="80%" class="text-center">Name</th>
                <th width="19%" class="text-center">Result</th>
            </tr>
        </thead>
    </table>

</div>