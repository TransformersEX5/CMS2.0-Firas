<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var yii\widgets\ActiveForm $form */

use app\models\tblstatusai;
use app\models\tbluser;

$backindex = '/program';
$pageUrl = Yii::$app->controller->action->id;

?>

<?php

$UserId = $data[0]['UserId'];

$url = Url::toRoute(['/program/default/getsubject']);
$url2 = Url::toRoute(['/program/default/subjectexpertdetail']);

$_csrf = Yii::$app->request->getCsrfToken();

$js = <<< JS

$(document).ready(function () {
    $("#subjectprogram").submit(function(event) {
        event.preventDefault();

        var formData = $('#subjectprogram').serializeArray();

        var SubjectId = [];
        
        $("input[name='tbllecturersubject[SubjectId][]']:checked").each(function() {
            SubjectId.push($(this).val());
        });

        desc = 'Are you sure to add subject(s) to the staff?';
        desc2 = 'You have successfully added subject(s) to the staff!';
        
        Swal.fire({title: desc, icon: "warning", showCancelButton: true, confirmButtonColor: "#34c38f", cancelButtonColor: "#f46a6a", confirmButtonText: "Confirm"
        }).then(function(t) {
            if (t.value) {
                $.ajax({
                    url: "$url2", 
                    type: "POST",
                    dataType: "json",
                    data: {
                        UserId: '$UserId',
                        SubjectId: SubjectId,
                        _csrf: "$_csrf", 
                        formData: JSON.stringify(formData)
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title:desc2,
                                icon: "success",
                                confirmButtonColor: "#34c38f",
                                confirmButtonText: "Confirm"
                            }).then(function(t) {

                            });
                        } else {
                            alert('Error: ' + JSON.stringify(response.errors));
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Please contact the programmer for more details!');
                    }
                });

            } 
        });
    });
});

$(document).on('click', '#btnSearch', function() {
    var txtSearchSubject = $('#txtSearchSubject').val();
    var UserId = '$UserId';

    $('#bodySubject').empty();

    $.ajax({
        url: '$url',
        type: 'GET',
        data: { 
            txtSearchSubject: txtSearchSubject,
            UserId: UserId
        },
        success: function(response) {
            $('#bodySubject').html(response);
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", error);
        }
    });
});

JS;
$this->registerJs($js);

?>
<div class="tbluser-form">

    <?php $form = ActiveForm::begin([
        'id' => 'subjectprogram'
    ]); ?>

    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-6 mb-2">
                    <h6>Staff Code</h6>
                    <?= $data[0]['UserNo']; ?>
                </div>
                <div class="col-6 mb-2">
                    <h6>Lecturer Name</h6>
                    <?= $data[0]['FullName']; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-8 mb-4">
                    <h6>School</h6>
                    <?= $data[0]['DepartmentDesc']; ?>
                </div>
                <div class="col-2 mb-4 d-flex align-items-center justify-content-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                <div class="col-2 mb-4 d-flex align-items-center">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-1 mb-2 d-flex align-items-center">Subject</div>
                <div class="col-sm-9 mb-2">
                    <div class="search-box">
                        <input type="text" class="form-control search" id="txtSearchSubject" placeholder="Search for something...">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>
                <div class="col-sm-2 mb-2">
                    <div>
                        <button type="button" class="btn btn-primary w-100" id="btnSearch">
                            <i class="ri-equalizer-fill me-2 align-bottom"></i>Filters
                        </button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class='col-sm-12'>
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="tech-companies-1" class="table table-striped table-bordered" style="border-collapse: collapse; table-layout: fixed;">
                                <thead>
                                    <tr>
                                        <th width="16%">Subject Code</th>
                                        <th width="79%">Subject Name</th>
                                        <th class="text-center" width="5%">.:.</th>
                                    </tr>
                                </thead>
                                <tbody id="bodySubject">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>

    <?php ActiveForm::end(); ?>

</div>