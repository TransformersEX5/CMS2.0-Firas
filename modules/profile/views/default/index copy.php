<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Tbltraining $model */
/** @var yii\widgets\ActiveForm $form */



?>
<?php

$this->title = Yii::t('app', 'Profile');
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .dropdown {
        position: static;
        z-index: 10;

    }

    .dropdown-menu {
        position: static;

        z-index: 10;

    }

    .dropdown-item {

        z-index: 10;

    }
</style>

<!-- *********************************************************************************************************************************** -->


<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/lexa-ajax/layouts/purpel/calendar.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 May 2023 13:39:13 GMT -->


<body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="colored"> -->



    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->



    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">

                    <div class="mx-auto">

                        <?php
                        if (Yii::$app->user->identity->Gender == 1) {
                            echo Html::img('@web/image/men.png', ['alt' => '#',  'class' => 'rounded-circle img-fluid mt-4 mt-sm-0 align-middle',]);
                        } else {
                            echo Html::img('@web/image/girl.png', ['alt' => '#',  'class' => 'rounded-circle img-fluid mt-4 mt-sm-0 align-middle',]);
                        }
                        ?>

                        <h4 class="card-title mt-2 mb-lg-0 mt-3"><?= $data[0]['FullName'] ?></h4>

                    </div>

                    <div class=" mt-3">
                        <label class="form-label">Staff Id : </label>
                        <?= $data[0]['UserNo'] ?>
                    </div>

                    <div class=" mt-1">
                        <label class="form-label">Email : </label>
                        <?= $data[0]['EmailAddress'] ?>
                    </div>

                    <div class="mt-1">
                        <label class="form-label">Position : </label>
                        <?= Yii::$app->function->getPosition($data[0]['PositionId']); ?>
                    </div>

                    <div class="mt-1">
                        <label class="form-label">Date Join : </label>
                        <?= $data[0]['DateJoin'] ?>
                    </div>

                    <div class="mt-1">
                        <label class="form-label">Department : </label>
                        <?= Yii::$app->function->getDepartment($data[0]['DepartmentId']); ?>
                    </div>

                    <div class="mt-1">
                        <label class="form-label">Working Status : </label>
                        <?= Yii::$app->function->getWorkingStatus($data[0]['WorkingStatusId']); ?>
                    </div>


                    <div class="mt-1">
                        <label class="form-label">Approval 1 : </label>
                        <?= Yii::$app->function->getHod1($data[0]['Hod1']); ?>
                    </div>

                    <div class="mt-1">
                        <label class="form-label">Approval 2 : </label>
                        <?= Yii::$app->function->getHod2($data[0]['Hod2']); ?>
                    </div>


                    <div class="mt-3">
                        <h5 class="font-size-14 mb-3">Profile :</h5>

                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Academic Qualification</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Profesional Qualification</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Advisory and Profesional Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Industry Experience</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Teaching Experience</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Teaching Permit</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Academic Staff Award & Recognition</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Postgraduate (Research) Supervision</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Research Grants</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Conference/Seminar/Training/Workshop</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Publications</a>
                            </li>


                        </ul>


                    </div>
                </div>
            </div>
        </div> <!-- end col-->


        <!-- ===Tab=================================================================================================== -->


        <div class="col-xl-9">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title"><?= $data[0]['FullName'] ?></h4>
                    <p class="card-title-desc"> <?= Yii::$app->function->getPosition($data[0]['PositionId']); ?><br> <?= $data[0]['UserNo'] ?></p>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Profile</span>
                            </a>
                        </li>



                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#family" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">Family</span>
                            </a>
                        </li>




                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#settings1" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                <span class="d-none d-sm-block">Asset/Equipment </span>
                            </a>
                        </li>



                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#training" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                <span class="d-none d-sm-block">Training & Certification
                                </span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">Document</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#settings1" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                <span class="d-none d-sm-block">Settings</span>
                            </a>
                        </li>


                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active p-3" id="home1" role="tabpanel">
                            <p class="mb-0">



                                <?php include "personaldetail.php"; ?>

                                <!-- Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui. -->
                            </p>
                        </div>

                        <div class="tab-pane p-3" id="family" role="tabpanel">
                            <p class="mb-0">

                                <?php include "family.php";  ?>
                            </p>
                        </div>



                        <div class="tab-pane p-3" id="training" role="tabpanel">
                            <p class="mb-0">
                                <?php include "trainingcertification.php";  ?>
                            </p>
                        </div>

                        <div class="tab-pane p-3" id="messages1" role="tabpanel">
                            <p class="mb-0">
                            <div class="text-center mt-4">
                                <?php include "document.php" ?>
                            </div>
                            Document
                            </p>
                        </div>
                        <div class="tab-pane p-3" id="settings1" role="tabpanel">
                            <div class="text-center mt-4">
                                <?php include "logfile.php" ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>




        <!-- end row -->
    </div>

    <!-- Add New Event MODAL -->
    <!-- Add New Event MODAL -->
    <div class="modal fade" id="event-modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-3 px-4 border-bottom-0">
                    <h5 class="modal-title" id="modal-title">Event</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>

                </div>
                <div class="modal-body p-4">
                    <form class="needs-validation" name="event-form" id="form-event" novalidate>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Event Name</label>
                                    <input class="form-control" placeholder="Insert Event Name" type="text" name="title" id="event-title" required value="" />
                                    <div class="invalid-feedback">Please provide a valid event name</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <select class="form-control custom-select" name="category" id="event-category">
                                        <option selected> --Select-- </option>
                                        <option value="bg-danger">Danger</option>
                                        <option value="bg-success">Success</option>
                                        <option value="bg-primary">Primary</option>
                                        <option value="bg-info">Info</option>
                                        <option value="bg-dark">Dark</option>
                                        <option value="bg-warning">Warning</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a valid event category</div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <button type="button" class="btn btn-danger" id="btn-delete-event">Delete</button>
                            </div>
                            <div class="col-6 text-end">
                                <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="btn-save-event">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!-- end modal-content-->
        </div> <!-- end modal dialog-->
    </div>

</body>

<!-- Mirrored from themesdesign.in/lexa-ajax/layouts/purpel/calendar.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 May 2023 13:39:16 GMT -->

</html>