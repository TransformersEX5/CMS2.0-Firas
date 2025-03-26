<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<div class="tblapplication-form">

<?php $form = ActiveForm::begin(); ?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

<!-- <div class="row"> -->
<div class="col-12">
    <!-- Left sidebar -->
    <div class="email-leftbar card">
        <div class="d-grid">
            <a href="#" class="btn btn-danger rounded btn-custom waves-effect waves-light">Application</a>
        </div>

        <div class="nav flex-column nav-pills me-2  mt-2 mp-5" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="nav-link active" id="v-pills-Personal-tab" data-bs-toggle="pill"
                data-bs-target="#v-pills-Personal" type="button" role="tab" aria-controls="v-pills-Personal"
                aria-selected="true">Personal Detail</button>

            <button class="nav-link  mt-2" id="v-pills-Address-tab" data-bs-toggle="pill"
                data-bs-target="#v-pills-Address" type="button" role="tab" aria-controls="v-pills-Address"
                aria-selected="false">Address</button>

            <button class="nav-link  mt-2 mp-5" id="v-pills-Qualification-tab" data-bs-toggle="pill"
                data-bs-target="#v-pills-Qualification" type="button" role="tab" aria-controls="v-pills-Qualification"
                aria-selected="false">Qualification</button>

            <button class="nav-link  mt-2 mp-4" id="v-pills-Programmes-tab" data-bs-toggle="pill"
                data-bs-target="#v-pills-Programmes" type="button" role="tab" aria-controls="v-pills-Programmes"
                aria-selected="false">Programmes/Cours</button>

            <button class="nav-link  mt-2" id="v-pills-english-tab" data-bs-toggle="pill"
                data-bs-target="#v-pills-english" type="button" role="tab" aria-controls="v-pills-english"
                aria-selected="false">English Language Proficiency</button>

            <button class="nav-link  mt-2" id="v-pills-financial-tab" data-bs-toggle="pill"
                data-bs-target="#v-pills-financial" type="button" role="tab" aria-controls="v-pills-financial"
                aria-selected="false">Financial</button>

            <button class="nav-link  mt-2" id="v-pills-Accomodation-tab" data-bs-toggle="pill"
                data-bs-target="#v-pills-Accomodation" type="button" role="tab" aria-controls="v-pills-Accomodation"
                aria-selected="false">Accomodation</button>

            <button class="nav-link  mt-2" id="v-pills-WorkInfo-tab" data-bs-toggle="pill"
                data-bs-target="#v-pills-WorkInfo" type="button" role="tab" aria-controls="v-pills-WorkInfo"
                aria-selected="false">Work Info</button>

       

            <button class="nav-link  mt-2" id="v-pills-Emergency-tab" data-bs-toggle="pill"
                data-bs-target="#v-pills-Emergency" type="button" role="tab" aria-controls="v-pills-Emergency"
                aria-selected="false">Emergency Contact</button>

            <button class="nav-link  mt-2" id="v-pills-Document-tab" data-bs-toggle="pill"
                data-bs-target="#v-pills-Document" type="button" role="tab" aria-controls="v-pills-Document"
                aria-selected="false">Document</button>

        </div>

    </div>
    <!-- End Left sidebar -->

    <!-- Right Sidebar -->
    <div class="email-rightbar mb-3">

        <div class="card">
            <div class="card-body">

                <div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-Personal" role="tabpanel"
                            aria-labelledby="v-pills-Personal-tab"><?php include "personaldetail.php" ?> </div>

                        <div class="tab-pane fade" id="v-pills-Address" role="tabpanel"
                            aria-labelledby="v-pills-Address-tab">...Address</div>

                        <div class="tab-pane fade" id="v-pills-Qualification" role="tabpanel"
                            aria-labelledby="v-pills-Qualification-tab"><?php include "qualification.php" ?></div>

                        <div class="tab-pane fade" id="v-pills-Programmes" role="tabpanel"
                            aria-labelledby="v-pills-Programmes-tab"><?php include "program.php" ?></div>

                        <div class="tab-pane fade" id="v-pills-english" role="tabpanel"
                            aria-labelledby="v-pills-english-tab">...english</div>

                        <div class="tab-pane fade" id="v-pills-financial" role="tabpanel"
                            aria-labelledby="v-pills-financial-tab">...financial</div>

                        <div class="tab-pane fade" id="v-pills-Accomodation" role="tabpanel"
                            aria-labelledby="v-pills-Accomodation-tab">...Accomodation</div>

                        <div class="tab-pane fade" id="v-pills-WorkInfo" role="tabpanel"
                            aria-labelledby="v-pills-WorkInfo-tab">...WorkInfo</div>

                      

                        <div class="tab-pane fade" id="v-pills-Emergency" role="tabpanel"
                            aria-labelledby="v-pills-Emergency-tab">...Emergency</div>

                        <div class="tab-pane fade" id="v-pills-Document" role="tabpanel"
                            aria-labelledby="v-pills-Document-tab">...Document</div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end Col-9 -->

</div>

<!-- </div> -->
</div>