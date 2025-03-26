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

$urlGetSafetyList = Url::base() . $module . '/default/getsafetylist';
$urlHazard = Url::base() . $module . '/default/hazarddetails?safetyId=';
$encode64 = Url::base() . $module . '/default/encode64?id=';

$_csrf = Yii::$app->request->getCsrfToken();

$script = <<< JS


$(document).ready(function() {
    var table = $('#cmstable1').DataTable({
        // lengthChange:false,			
        processing: true,
        deferRender:true,			
        searching:true,
        responsive:true,			
        bFilter:false,
        destroy:true,			
        pageLength: 25,
        paging:true,	
        info: false,	
        scrollY: true,  
        autoWidth: true, 
        // dom: 'Bfrtip',                      
        ajax: { 
            url: '$urlGetSafetyList',
            type: 'POST',
            datatype: 'json',
            data: 
            {
                _csrf : '$_csrf'
            },
        },
        "columns": [
            {
                "data": "UserId", "width": '0.1%', class: "text-dark text-center",
                "render": function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
                }
            },	
            {
                "data": "file_name",
                "width": "0.1%",
                "render": function(data, type, row, meta) {
                    var imagePath = '$encode64'+btoa(data);

                    var imageHtml = '<img src="'+imagePath+'" class="img-fluid" style="width:50px; height:50px;">';
                    return imageHtml;
                }
            },
        {"data":"SafetyDesc", "width": '40.0%', class:"text-dark"},		
        {"data":"FullName", "width": '40.0%', class:"text-dark"},		
        {"data":"Status", "width": '0.1%', class:"text-dark text-center"},		
        {"data":"TransactionDate", "width": '14.0%', class:"text-dark text-center"},													
        ]
    });

    var table = $('#cmstable1').DataTable()
    $('#cmstable1 tbody').on('click', 'tr', function() {
        if ($(this).hasClass('row_selected')) {
            $(this).removeClass('row_selected');
        } else {
            table.$('tr.row_selected').removeClass('row_selected');
            $(this).addClass('row_selected');
        }

        var tabledata = table.row(this).data();
        $('#select_id').val(tabledata['SafetyId']);
        $('#safetyadminid').val(tabledata['SafetyAdminId']);
        $('#UserId').val(tabledata['UserId']);
        $('#SafetyStatusId').val(tabledata['SafetyStatusId']);

        $(".editSafety").val($('#select_id').val());
        $(".viewSafety").val($('#select_id').val());
        $(".deleteSafety").val($('#select_id').val());
    });

    $(document).on('click', '.newSafety', function() {
        var safetyId = $(this).val();
        $('#SafetyModalId').modal('show');
        SafetyModal.innerText = 'NEW HAZARD REPORT';
        $('#modalContent').load('$urlHazard'+safetyId);
    });

    $(document).on('click', '.editSafety', function() {
        var typeId = $(this).val();
        $('#SafetyModalId').modal('show');
        SafetyModal.innerText = typeId;
        $('#modalContent').load('$urlHazard'+safetyId);
    });

    $(document).on('click', '.viewSafety', function() {
        var typeId = $(this).val();
        $('#SafetyModalId').modal('show');
        SafetyModal.innerText = 'VIEW';
    });

    $(document).on('click', '.deleteSafety', function() {
        var typeId = $(this).val();
        $('#SafetyModalId').modal('show');
        SafetyModal.innerText = 'DELETE';  
    });

  });

JS;
$this->registerJs($script);

?>

<style>
    .row_selected {
        background-color: rgba(50, 115, 220, 0.3) !important;
        z-index: 9999
    }
</style>

<div class="col-12">
    <div class="card"><?php ActiveForm::begin(['id' => 'SafetyId', 'options' => ['onsubmit' => 'return false;']]); ?>
        <div class="row">
            <div class="col-8">
                <h4 class="card-header text-dark bg-white rounded">HAZARD REPORTING</h4>
            </div>
            <div class="col-4">
                <div class="d-flex justify-content-end mt-3">
                    <div class="me-3">
                        <button type="button" class="btn btn-primary waves-effect waves-light newSafety" data-bs-target="#SafetyModalId" value="0">New</button>
                    </div>
                    <div class="me-3">
                        <button type="button" class="btn btn-primary waves-effect waves-light editSafety" data-bs-target="#SafetyModalId" value="0">Edit</button>
                    </div>
                    <div class="me-3">
                        <button type="button" class="btn btn-primary waves-effect waves-light viewSafety" data-bs-target="#SafetyModalId" value="0">View</button>
                    </div>
                    <div class="me-3">
                        <button type="button" class="btn btn-primary waves-effect waves-light deleteSafety" data-bs-target="#SafetyModalId" value="0">Delete</button>
                    </div>
                </div>
            </div>
            <input type="hidden" name="select_id" id="select_id" />
            <input type="hidden" name="safetyadminid" id="safetyadminid" />
            <input type="hidden" name="UserId" id="UserId" />
            <input type="hidden" name="SafetyStatusId" id="SafetyStatusId" />
        </div>
        <div class="card-body">
            <div class="col-12">
                <div class="table-rep-plugin">
                    <div class="b-0">
                        <table id="cmstable1" class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Photo</th>
                                    <th>Description</th>
                                    <th>Requested By</th>
                                    <th>Status</th>
                                    <th>Transaction Date</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div><?php ActiveForm::end(); ?>
    </div>
</div>

<div class="col-12">
    <div class="modal fade" id="SafetyModalId" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="SafetyModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="SafetyModal">REGISTER</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="modalContent" class="modal-body">

                </div>
            </div>
        </div>
    </div>
</div>