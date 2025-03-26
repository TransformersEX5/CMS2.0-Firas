<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>

<!-- <div class="tblapplication-form"> -->

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<?php

$id = Yii::$app->request->get('id', 0);
$baseUrl = Url::base();
$script = <<< JS

$("a").click(function(event)
{
    var userId = '$id';
    var tabName = event.target.id;
    var TabName = tabName.slice(0, -4);

    window.history.pushState('', '', '$baseUrl/application/create?id='+userId+'&tab='+TabName);
});

JS;
$this->registerJs($script);

?>

<?php
$tab = '';
if (isset($_GET["tab"])) {
    $tab = $_GET['tab'];
}

if (!empty($tab)) {
    $this->registerJs("$('a[href=\"#" . $tab . "\"]').tab('show');", yii\web\View::POS_READY);
} else {
    $this->registerJs("$('a[href=\"#v-pills-home\"]').tab('show');", yii\web\View::POS_READY);
}

?>

<div class="col-12">
    <!-- Left sidebar -->
    <div class="email-leftbar card">
        <div class="d-grid">
            <a href="#" class="btn btn-danger rounded btn-custom waves-effect waves-light">Back</a>
        </div>

        <div class="nav flex-column nav-pills me-2 mt-2 mp-2 text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-Personal-tab" data-bs-toggle="pill" href="#v-pills-Personal" role="tab" aria-controls="v-pills-Personal" aria-selected="true">Personal Detail</a>
            <a class="nav-link" id="v-pills-Address-tab" data-bs-toggle="pill" href="#v-pills-Address" role="tab" aria-controls="v-pills-Address" aria-selected="false">Address</a>
            <a class="nav-link" id="v-pills-Qualification-tab" data-bs-toggle="pill" href="#v-pills-Qualification" role="tab" aria-controls="v-pills-Qualification" aria-selected="false">Qualification</a>
            <a class="nav-link" id="v-pills-Programmes-tab" data-bs-toggle="pill" href="#v-pills-Programmes" role="tab" aria-controls="v-pills-Programmes" aria-selected="false">Programmes/Course</a>
            <a class="nav-link" id="v-pills-english-tab" data-bs-toggle="pill" href="#v-pills-english" role="tab" aria-controls="v-pills-english" aria-selected="false">English Language Proficiency</a>
            <a class="nav-link" id="v-pills-financial-tab" data-bs-toggle="pill" href="#v-pills-financial" role="tab" aria-controls="v-pills-financial" aria-selected="false">Financial</a>
            <a class="nav-link" id="v-pills-Accomodation-tab" data-bs-toggle="pill" href="#v-pills-Accomodation" role="tab" aria-controls="v-pills-Accomodation" aria-selected="false">Accomodation</a>
            <a class="nav-link" id="v-pills-WorkInfo-tab" data-bs-toggle="pill" href="#v-pills-WorkInfo" role="tab" aria-controls="v-pills-WorkInfo" aria-selected="false">Working Info</a>
            <a class="nav-link" id="v-pills-Document-tab" data-bs-toggle="pill" href="#v-pills-Document" role="tab" aria-controls="v-pills-Document" aria-selected="false">Documents</a>
        </div>

        <!-- <div class="nav flex-column nav-pills me-2  mt-2 mp-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="nav-link active" id="v-pills-Personal-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Personal" type="button" role="tab" aria-controls="v-pills-Personal" aria-selected="true">Personal Detail</button>

            <button class="nav-link mt-1" id="v-pills-Address-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Address" type="button" role="tab" aria-controls="v-pills-Address" aria-selected="false">Address</button>

            <button class="nav-link mt-1 " id="v-pills-Qualification-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Qualification" type="button" role="tab" aria-controls="v-pills-Qualification" aria-selected="false">Qualification</button>

            <button class="nav-link mt-1" id="v-pills-Programmes-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Programmes" type="button" role="tab" aria-controls="v-pills-Programmes" aria-selected="false">Programmes/Course</button>

            <button class="nav-link mt-1" id="v-pills-english-tab" data-bs-toggle="pill" data-bs-target="#v-pills-english" type="button" role="tab" aria-controls="v-pills-english" aria-selected="false">English Language Proficiency</button>

            <button class="nav-link mt-1" id="v-pills-financial-tab" data-bs-toggle="pill" data-bs-target="#v-pills-financial" type="button" role="tab" aria-controls="v-pills-financial" aria-selected="false">Financial</button>

            <button class="nav-link mt-1" id="v-pills-Accomodation-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Accomodation" type="button" role="tab" aria-controls="v-pills-Accomodation" aria-selected="false">Accomodation</button>

            <button class="nav-link mt-1" id="v-pills-WorkInfo-tab" data-bs-toggle="pill" data-bs-target="#v-pills-WorkInfo" type="button" role="tab" aria-controls="v-pills-WorkInfo" aria-selected="false">Working Info</button>

            <button class="nav-link mt-1" id="v-pills-Document-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Document" type="button" role="tab" aria-controls="v-pills-Document" aria-selected="false">Documents</button>
        </div> -->

    </div>
    <!-- End Left sidebar -->

    <!-- Right Sidebar -->
    <div class="email-rightbar mb-3">

        <div class="card">
            <div class="card-body">
                <div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-Personal" role="tabpanel" aria-labelledby="v-pills-Personal-tab"><?= $this->render('personaldetail', ['model' => $model]) ?></div>

                        <div class="tab-pane fade" id="v-pills-Address" role="tabpanel" aria-labelledby="v-pills-Address-tab"><?= $this->render('address', ['model' => $model, 'address' => $address]) ?></div>

                        <div class="tab-pane fade" id="v-pills-Qualification" role="tabpanel" aria-labelledby="v-pills-Qualification-tab"><?= $this->render('qualification', ['model' => $model]) ?></div>

                        <div class="tab-pane fade" id="v-pills-Programmes" role="tabpanel" aria-labelledby="v-pills-Programmes-tab"><?= $this->render('programregister', ['model' => $model, 'programregister' => $programregister]) ?></div>

                        <div class="tab-pane fade" id="v-pills-english" role="tabpanel" aria-labelledby="v-pills-english-tab">...english</div>

                        <div class="tab-pane fade" id="v-pills-financial" role="tabpanel" aria-labelledby="v-pills-financial-tab"><?= $this->render('financial', ['model' => $model]) ?></div>

                        <div class="tab-pane fade" id="v-pills-Accomodation" role="tabpanel" aria-labelledby="v-pills-Accomodation-tab">...Accomodation</div>

                        <div class="tab-pane fade" id="v-pills-WorkInfo" role="tabpanel" aria-labelledby="v-pills-WorkInfo-tab"><?= $this->render('workinginfo', ['StudWorkingInfo' => $StudWorkingInfo]) ?></div>

                        <div class="tab-pane fade" id="v-pills-Document" role="tabpanel" aria-labelledby="v-pills-Document-tab">...Document</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>