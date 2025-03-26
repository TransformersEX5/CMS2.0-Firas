<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>

<style>
    .table-responsive,
    .dataTables_scrollBody {
        overflow: visible !important;
    }
</style>

<?php

$module = '/' . Yii::$app->controller->module->id;
$url = Url::base() . $module . '/default/getagentlist';
$urlDetails = Url::base() . $module . '/default/details';
$application = Url::base() . $module . '/default/sendemail';
$getapplication = Url::base() . $module . '/default/application';
$agreement = Url::base() . $module . '/default/generateagreement';

$_csrf = Yii::$app->request->getCsrfToken();

$script = <<< JS

var module = '$module';

$( document ).ready(function() {
    $('#search').click(function () {
        var searchbox = $('#searchbox').val();
        var statusId = $('#statusId').val();
        
        getAgent(searchbox,statusId); 
        
    });

    function getAgent(searchbox,statusId){
        var table = $('#cmstable1').DataTable({
            // lengthChange:false,			
            processing: true,
            deferRender:true,			
            // searching:true,
            responsive:true,			
            bFilter:false,
            destroy:true,			
            pageLength: 10,
            paging:true,	
            info: false,	
            scrollY: true,  
            autoWidth: true, 
            // dom: 'Bfrtip',                      
            ajax: { 
                url: '$url?searchbox='+searchbox+'&statusId='+statusId,
                type: 'GET',
                datatype: 'json',
            },
            "columns": [
                {
                    "data": "LLL", "width": '0.1%', class:"text-dark",
                    "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },	
            {"data":"FullName", "width": '43.9%', class:"text-dark"},		
            {"data":"UserNo", "width": '14.9%', class:"text-dark"},	
            {"data":"ICPassportNo", "width": '15.0%', class:"text-dark"},	
            {"data":"AgentApplicationStatus", "width": '15.0%', class:"text-dark"},	
            {"data":"Status", "width": '10.0%', class:"text-dark"},	
            {
                "data": "LLL","width": "0.1%",
                "render": function (data, type, row, meta) 
                {
                    var data = data.split(",");

                    if(data[1] == 1)
                    {
                        return '<div class="dropdown">'+
                        '<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Action</a>'+
                        '<ul class="dropdown-menu">'+
                        '<li><a class="dropdown-item editAgent" value='+ JSON.stringify(data[0]) +' href="#">Edit</a></li>'+
                        '<li><a class="dropdown-item viewAgent" value='+ JSON.stringify(data[0]) +' href="#">View</a></li>'+
                        '<li><button type="button" class="dropdown-item sendEmail" value='+ JSON.stringify(data[0]) +'>Send Email</button>'+
                        '<li><button type="button" class="dropdown-item printAgreement" value='+ JSON.stringify(data[0]) +'>Print Agreement</button>'+
                        '<li><button type="button" class="dropdown-item printLoR" value='+ JSON.stringify(data[0]) +'>Letter of Representation</button>'+
                        '<li><button type="button" class="dropdown-item printCoA" value='+ JSON.stringify(data[0]) +'>Certificate of Appointment</button>'+
                        '</ul>'+
                        '</div>';
                    }
                    else
                    {
                        return '<div class="dropdown">'+
                        '<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Action</a>'+
                        '<ul class="dropdown-menu">'+
                        '<li><a class="dropdown-item editAgent" value='+ JSON.stringify(data[0]) +' href="#">Edit</a></li>'+
                        '<li><a class="dropdown-item viewAgent" value='+ JSON.stringify(data[0]) +' href="#">View</a></li>'+
                        '<li><button type="button" class="dropdown-item sendEmail" value='+ JSON.stringify(data[0]) +'>Send Email</button>'+
                        '<li><button type="button" class="dropdown-item printAgreement" value='+ JSON.stringify(data[0]) +'>Print Agreement</button>'+
                        '</ul>'+
                        '</div>';
                    }
                }
            },														
            ]
        });
    }

    $(document).on('click', '.sendEmail', function() {
        var UserId = $(this).attr('value');

        desc = 'Do you want to send the application form to the agent?';
        desc2 = 'You have successfully send the application form to the agent!';

        Swal.fire({title:desc,icon:"warning",showCancelButton:!0,confirmButtonColor:"#34c38f",cancelButtonColor:"#f46a6a",confirmButtonText:"Confirm"})
            .then(function(t) 
            {
                if (t.value) {
                    $.ajax({
                        url: '$application',
                        type: 'POST',
                        dataType: "json",
                        data: 
                        {  
                            UserId : UserId,
                            _csrf : '$_csrf',
                        },
                        success: function(response) 
                        {
                            t.value&&Swal.fire({title:desc2,icon:"success",confirmButtonColor:"#34c38f",confirmButtonText:"Confirm"})
                        },
                        error: function(xhr, status, error) 
                        {
                            alert('Please contact the programmer for more details!');
                        }
                    });
                } 
            });
    });

    $(document).on('click', '.printAgreement', function() {
        var UserId = btoa($(this).attr('value'));

        $.ajax({
            url: '$agreement?UserId='+UserId,
            type: 'POST',
            dataType: "json",
            data: 
            {  
                UserId : UserId,
                _csrf : '$_csrf',
            },
            success: function(response) 
            {
                window.open('agreement?UserId='+UserId, '_blank');
            },
            error: function(xhr, status, error) 
            {
                alert('Please make sure the agent has already filled up the form!');
            }
        });
    });

    $(document).on('click', '.printLoR', function() {
        var UserId = btoa($(this).attr('value'));

        window.open('letterofrepresentation?UserId='+UserId, '_blank');
    });

    $(document).on('click', '.printCoA', function() {
        var UserId = btoa($(this).attr('value'));

        window.open('certificateofappointment?UserId='+UserId, '_blank');
    });

    $(document).on('click', '.addAgent', function() {
        var UserId = $(this).val();

        $('#AgentModalId').modal('show');

        AgentModal.innerText = 'ADD';
        $('#modalContent').load('$urlDetails?UserId='+UserId);
    });

    $(document).on('click', '.editAgent', function() {
        var UserId = $(this).attr('value');

        $('#AgentModalId').modal('show');

        AgentModal.innerText = 'UPDATE';
        $('#modalContent').load('$urlDetails?UserId='+UserId);
    });

    $(document).on('click', '.viewAgent', function() {
        var UserId = btoa($(this).attr('value'));

        window.open('$getapplication?UserId='+UserId+'&mode=view');
    });

    var modal = document.getElementById('AgentModalId');
    modal.addEventListener('hidden.bs.modal', function (e) {
        $('#cmstable1').DataTable().ajax.reload();
    });

});

JS;
$this->registerJs($script);

?>

<div class="col-12">
    <div class="card"><?php ActiveForm::begin(['id' => 'ItemId', 'options' => ['onsubmit' => 'return false;']]); ?>
        <div class="row">
            <div class="col-10">
                <h4 class="card-header mt-0 text-dark bg-white rounded">AGENT APPLICATION</h4>
            </div>
            <!-- <div class="col-2 mt-3">
                <button type="button" class="btn btn-primary waves-effect waves-light userManual">Download User Manual</button>
            </div> -->
        </div>
        <div class="card-body">

            <div class="text-end">
                <button type="button" class="btn btn-primary waves-effect waves-light mb-3 addAgent" data-bs-target="#AgentModalId" value="0">Add New Item</button>
                <!-- <a href="<?= Url::base() . $module . '/default/report' ?>" target="_blank" class="btn btn-primary waves-effect waves-light mb-3">Generate Report</a> -->
            </div>

            <div class="row">
                <div class="col-9 mb-2">
                    <?= Html::textInput('search', null, ['id' => 'searchbox', 'class' => 'form-control text-dark border-dark', 'placeholder' => 'Search by Name, Person In Charge or Status']) ?>
                </div>

                <div class="col-2 mb-2">
                    <?= Html::dropDownList('statusId', null, ['1' => 'Active', '2' => 'Inactive'], ['id' => 'statusId', 'prompt' => 'Select Status', 'class' => 'form-select text-dark border-dark']); ?>
                </div>

                <div class="col-1 mb-2">
                    <button type="submit" id="search" class="btn btn-primary waves-effect waves-light mb-3">Search</button>
                </div>
            </div>

            <div class="col-12">
                <div class="table-rep-plugin">
                    <div class="b-0">
                        <table id="cmstable1" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-dark">No.</th>
                                    <th class="text-dark">FullName</th>
                                    <th class="text-dark">UserNo.</th>
                                    <th class="text-dark">ICPassportNo</th>
                                    <th class="text-dark">Application Status</th>
                                    <th class="text-dark">Status</th>
                                    <th class="text-dark">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>



        <?php ActiveForm::end(); ?>
    </div>
</div>
</div>

<div class="col-12">
    <div class="modal fade" id="AgentModalId" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="AgentModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="AgentModal">REGISTER</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="modalContent" class="modal-body">

                </div>
            </div>
        </div>
    </div>
</div>