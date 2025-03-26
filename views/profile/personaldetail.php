<div class="row">

    <h2 class="card-title">Personal Detail</h2>
    <p class="card-title-desc">This info only can be update by HR department.</p>

    <br>


    <div class="col-4">
        <div class="mt-1">
            <label class="form-label">Position : </label>
            <?= Yii::$app->function->getPosition($data[0]['PositionId']); ?>
        </div>
    </div>
    <div class="col-4">
        <div class="mt-1">
            <label class="form-label">NRIC / Passport : </label>
            <?= $data[0]['ICPassportNo'] ?>
        </div>
    </div>
    <div class="col-4">
        <div class="mt-1">
            <label class="form-label">Status : </label>
            <?= Yii::$app->function->getStatusAI($data[0]['StatusId']); ?>
        </div>
    </div>

</div>


<div class="row">


    <div class="col-4">
        <div class="mt-1">
            <label class="form-label">Working Status : </label>
            <?= Yii::$app->function->getWorkingStatus($data[0]['WorkingStatusId']); ?>
        </div>
    </div>



    <div class="col-4">
        <div class="mt-1">
            <label class="form-label">Department : </label>
            <?= Yii::$app->function->getDepartment($data[0]['DepartmentId']); ?>
        </div>
    </div>
</div>


<hr>

<div class="row">
    <div class="col-4">
        <div class="mt-1">
            <label class="form-label">Nationality : </label>
            <?= Yii::$app->function->getNationality($data[0]['NationalityId']); ?>
        </div>
    </div>

    <div class="col-4">
        <div class="mt-1">
            <label class="form-label">Race : </label>
            <?= Yii::$app->function->getRace($data[0]['RaceId']); ?>
        </div>
    </div>

    <div class="col-4">
        <div class="mt-1">

        </div>
    </div>

</div>


<div class="row">
    <div class="col-4">
        <div class="mt-1">
            <label class="form-label">Gender : </label>
            <?= Yii::$app->function->getGender($data[0]['Gender']); ?>
        </div>
    </div>

    <div class="col-4">
        <div class="mt-1">
            <label class="form-label">D.O.B : </label>
            <?= $data[0]['UserDOB'] ?>
        </div>
    </div>

    <div class="col-4">
        <div class="mt-1">

        </div>
    </div>

</div>


<div class="row">
    <div class="col-4">
        <div class="mt-1">
            <label class="form-label">Marital Status : </label>
            <?= Yii::$app->function->getMarital($data[0]['MaritalStatusId']); ?>
        </div>
    </div>

    <div class="col-4">
        <div class="mt-1">
            <!-- <label class="form-label">Hand Set No: </label>
            <?= $data[0]['HandSetNo'] ?> -->
        </div>
    </div>

    <div class="col-4">
        <div class="mt-1">

        </div>
    </div>

</div>

<hr>

<div class="row">
    <div class="col-4">
        <div class="mt-1">
            <label class="form-label">Hand Set No: </label>
            <?= $data[0]['HandSetNo'] ?>
        </div>
    </div>

    <div class="col-4">
        <div class="mt-1">
            <label class="form-label">Email Address: </label>
            <?= $data[0]['EmailAddress'] ?>
        </div>
    </div>

</div>


<hr>


<div class="row">
    <div class="col-sm-12"> <h2 class="card-title">Professional Experience <i class="fas fa-plus form-check form-switch form-switch-right form-switch-md ms-2" title=" To Add Professional Experience "></i></h2> </div>
    
    <p class="card-title-desc">Add professional experience to your profile to showcase your working history and experiences</p>
    <br>
    
</div>

<hr>

<div class="row">

<div class="col-sm-12"> <h2 class="card-title">Education  <i class="fas fa-plus form-check form-switch form-switch-right form-switch-md ms-2 update_education" title=" To Add Education "></i></h2> </div>

<p class="card-title-desc">Add education background to your profile. It can be information on your high school and university</p>
    <br>

</div>
<?php
// $TrainingId = $_GET['TrainingId'];
// $stafflist = Url::toRoute(['/trainingpaticipant/trainingstafflist']);

$script = <<<JS

$(document).off('click', '.update_education').on('click', '.update_education', function () {
        
    alert("xx");
   


 });


JS;
$this->registerJs($script);
?>

