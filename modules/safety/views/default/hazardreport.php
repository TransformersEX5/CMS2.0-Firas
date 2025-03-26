<?php

use app\models\tblprogram;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Hazard Report List');
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

<div class="tbluploaddocument-index">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex text-white bg-warning">
                    <h4 class="card-title mb-0 flex-grow-1">
                        <?= $this->title ?>
                    </h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <button id="New" class="showModal_New btn btn-success btn-sm" type="button" value="0">New Hazard<i class="icon-file"></i></button>
                            <button id="Assign" class="assign btn btn-success btn-sm" type="button">Assignation<i class="icon-file"></i></button>
                            <button id="Pick" class="pick btn btn-success btn-sm" type="button">Pick Hazard<i class="icon-file"></i></button>
                            <button id="Follow" class="followup btn btn-success btn-sm" type="button">Follow-Up<i class="icon-file"></i></button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row g-3 mb-3">
                        <div class="col-xl-6">
                            <div class="search-box">
                                <input type="text" class="form-control search" id="txtSearch" placeholder="Search for something...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row g-3">
                                <div class="col-sm-4">
                                    <div>
                                        <button type="button" class="btn btn-primary w-100" id="btn_search"> <i class="ri-equalizer-fill me-2 align-bottom"></i>Filters</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                            <h4>
                                    <div name="select_data" id="select_data"></div>
                                </h4>
                                <input type="hidden" name="select_incharge" id="select_incharge" />
                                <input type="hidden" name="select_id" id="select_id" />
                            </div>
                        </div>
                    </div>

                    <!-- Datatable Start -->
                    <div class="row mb-4">
                        <div class='col-12 .col-sm-12'>
                            <div class="box-body">
                                <table id="cmstable1" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Photo</th>
                                            <th>Description</th>
                                            <th>Requested By</th>
                                            <th>In-charge</th>
                                            <th>Status</th>
                                            <th>Last Updated</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                    <h4>Staff Summary</h4>

                    <!-- Datatable Start -->
                    <div class="row">
                        <div class="row g-3 mb-3">
                            <div class="col-xl-6">
                                <div class="search-box">
                                    <input type="text" class="form-control search" id="txtYear" placeholder="Search For Year" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="row g-3">
                                    <div class="col-sm-4">
                                        <div>
                                            <button type="button" class="btn btn-primary w-100" id="btn_Yearsearch"> <i class="ri-equalizer-fill me-2 align-bottom"></i>Filters</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class='col-12 .col-sm-12'>
                            <div class="box-body">
                                <table id="cmstable2" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>FullName</th>
                                            <th>New</th>
                                            <th>On-going</th>
                                            <th>Completed</th>
                                            <th>Pending</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
/**********************************************************************************/

$module = '/' . Yii::$app->controller->module->id;
$UserId = Yii::$app->user->identity->UserId;

$urlGetSafetyList = Url::base() . $module . '/default/getsafetylist';
$urlGetStaffSummary = Url::base() . $module . '/default/getstaffsummary';

$create = Url::base() . $module . '/default/create?safetyId=';
$view = Url::base() . $module . '/default/view?safetyId=';
$delete = Url::base() . $module . '/default/remove?safetyId=';

$assign = Url::base() . $module . '/default/assign?safetyId=';
$pickup = Url::base() . $module . '/default/pickup?safetyId=';
$followup = Url::base() . $module . '/default/followup?safetyId=';

$encode64 = Url::base() . $module . '/default/encode64?id=';
// $src = Url::base() . '/image/image/uploads/';
$canEdit = '1';
$canDelete = '1';
$canPickup = '1';
$canFollowup = '1';

$_csrf = Yii::$app->request->getCsrfToken();

$script = <<<JS

/**********************************************************************************/

$(document).ready(function() {
    getHazardReportList();
    getStaffSummary();
    refreshDatatable();

    $('#txtSearch').on('keypress',function(e) {
        if(e.which == 13) {
            $("#btn_search").trigger('click');
        }
    });


    $('#txtYear').on('keypress',function(e) {
        if(e.which == 13) {
            $("#btn_Yearsearch").trigger('click');
        }
    });

    $('#btn_search').click(function ()
    {
        $('#select_id').html('');
        $('#select_data').html('');
        
        getHazardReportList();
    });

    function getHazardReportList(){
        var table = $('#cmstable1').DataTable({
            // lengthChange:false,			
            processing: true,
            deferRender:true,			
            searching:true,
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
                url: '$urlGetSafetyList',
                type: 'POST',
                datatype: 'json',
                data: 
                {
                    txtSearch:$("#txtSearch").val(),
                    _csrf : '$_csrf'
                },
            },
            "columns": [
                {
                    "data": "SafetyId", "width": '0.1%', class: "text-dark text-center",
                    "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },	
                {
                    "data": "file_name",
                    "width": "0.1%",
                    "class": "text-center",
                    "render": function(data, type, row, meta) {
                        var imagePath = '$encode64'+btoa(data);

                        var imageHtml = '<img src="'+imagePath+'" class="img-fluid view" value='+JSON.stringify(row.SafetyId)+' style="width:50px; height:50px;">';
                        return imageHtml;
                    }
                },
            {"data":"SafetyDesc", "width": '27.0%', class:"text-dark"},		
            {"data":"FullName", "width": '27.0%', class:"text-dark"},		
            // {"data":"Incharge", "width": '26.0%', class:"text-dark"},	
            {
                "data": "Incharge",
                "width": '26.0%',
                "class": "text-dark",
                "render": function(data, type, row) {
                    var inchargeName = row.Incharge.split(';');
                    if(inchargeName[0] == 0)
                    {
                        inchargeName[0] = 'NO STAFF ASSIGNED';
                    }
                    return inchargeName[0];
                }
            },
            {"data":"Status", "width": '0.1%', class:"text-dark text-center"},		
            {"data":"TransactionDate", "width": '14.0%', class:"text-dark text-center"},	
            {"data": "SafetyId", "width": '6%',
                        "render": function ( data, type, row, meta ) { 

                            return '<i class="mdi mdi-file-document-edit-outline edit" style="font-size: 24px;" value='+ JSON.stringify(data+','+row.UserId+','+row.Incharges) +'></i>'+
                             '<i class="mdi mdi-information-outline view" style="font-size: 24px;" value='+ JSON.stringify(data) +'></i>'+
                             '<i class="mdi mdi-delete-alert delete" style="font-size: 24px;" value='+ JSON.stringify(data+','+row.UserId+','+row.Incharges) +'></i>';


                            // return '<div class="dropdown">'+
                            // '<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Action</a>'+
                            // '<ul class="dropdown-menu">'+
                            // '<li><a class="dropdown-item edit" value='+ JSON.stringify(data+','+row.UserId+','+row.Incharges) +' href="#">Edit</a></li>'+
                            // '<li><a class="dropdown-item view" value='+ JSON.stringify(data) +' href="#">View</a></li>'+
                            // '<li><a class="dropdown-item delete" value='+ JSON.stringify(data) +' href="#">Delete</a></li>'+
                            // // '<li><a class="dropdown-item download" value='+ JSON.stringify(data) +' href="#">Download</a></li>'+
                            // // '<li><a class="dropdown-item delete" value='+ JSON.stringify(data) +' href="#">Delete</a></li>'+
                            // '</ul>'+
                            // '</div>';
                        }
                    },												
            ]
        });
    }

    /**********************************************************************************/

    $('#btn_Yearsearch').click(function ()
    {        
        getStaffSummary();
    });

    function getStaffSummary(){
        var table = $('#cmstable2').DataTable({
            // lengthChange:false,			
            processing: true,
            deferRender:true,			
            searching:false,
            responsive:true,			
            bFilter:false,
            destroy:true,			
            // pageLength: 10,
            paging:false,	
            info: false,	
            scrollY: true,  
            autoWidth: true, 
            // dom: 'Bfrtip',                      
            ajax: { 
                url: '$urlGetStaffSummary',
                type: 'POST',
                datatype: 'json',
                data: 
                {
                    txtYear:$("#txtYear").val(),
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
                {"data":"FullName", "width": '27.0%', class:"text-dark"},	
                {"data":"New", "width": '0.1%', class:"text-dark text-center"},	
                {"data":"On-going", "width": '1.4%', class:"text-dark text-center"},	
                {"data":"Completed", "width": '0.1%', class:"text-dark text-center"},	
                {"data":"Pending", "width": '0.1%', class:"text-dark text-center"},										
            ]
        });
    }

  /**********************************************************************************/

	$('#cmstable1 tbody').on('click', 'tr', function() {
			var table1 = $('#cmstable1').DataTable();
			if ($(this).hasClass('row_selected1')) {
				$(this).removeClass('row_selected1');
			} else {
				table1.$('tr.row_selected1').removeClass('row_selected1');
				$(this).addClass('row_selected1');
			}
        
		    var d = table1.row(this).data();
			
			var x = d['Incharge'];
            var x = x.split(';');
            var incharge = x[2];
            if(x[0] == 0)
            {
                x[0] = 'NO STAFF ASSIGNED';
            }
            var x = 'Person In-charge: ' + x[0];
			var y = d['SafetyId'];
	
			$('#select_data').html(x);
            $('#select_incharge').val(incharge);
			$('#select_id').val(y);
		
			});

  /**********************************************************************************/

    function refreshDatatable()
    {
        var modal = document.getElementById('modal-lg');
        modal.addEventListener('hidden.bs.modal', function (e) {
            $('#cmstable1').DataTable().ajax.reload();
            $('#cmstable2').DataTable().ajax.reload();

            $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
        });
    }

  /**********************************************************************************/

    $(document).on('click', '.showModal_New', function () {
        var safetyId = $(this).attr('value');
        var form = $(this);
        $.ajax({
                url: '$create'+safetyId,
                type   : 'POST',
                data: {
                    _csrf : '$_csrf'
                    },
                success: function (response) 
                {
                    $("#modal-lg").modal("show");
                    $("#modalContent-lg").html(response).modal();							
                    document.getElementById('modalHeader-lg').innerHTML = '<h4>New Hazard Report</h4>';    
                },
                error  : function (e) {
                }
            });
        return false;        
    });

    /**********************************************************************************/

  $(document).on('click', '.edit', function () {
    var canEdit = '$canEdit';

    if(canEdit == 1){
        var id = $(this).attr('value').split(','); 

        if(id[1] == '$UserId')
        {
            if(id[2] == 0)
            {
                var safetyId = id[0];
                var form = $(this);
                $.ajax({
                    url: '$create'+safetyId,
                    type   : 'POST',
                    data: {
                        _csrf : '$_csrf'
                        },
                    success: function (response) 
                    {
                        $("#modal-lg").modal("show");
                        $("#modalContent-lg").html(response).modal();							
                        document.getElementById('modalHeader-lg').innerHTML = '<h4>Edit Hazard Report</h4>';    
                    },
                    error  : function (e) {
                    }
                });
                return false;  
            }
            else
            {
                alert('You can no longer edit this hazard report!');
            }
        }
        else
        {
            alert('You can only edit your own hazard report!');
        }
    }
    else
    {
        alert('Sorry , your access is denied');
    }
    });

    /**********************************************************************************/

    $(document).on('click', '.view', function () {

        var safetyId = $(this).attr('value');
        var form = $(this);
        $.ajax({
                url: '$view'+safetyId,
                type   : 'POST',
                data: {
                    _csrf : '$_csrf'
                    },
                success: function (response) 
                {
                    $("#modal-xl").modal("show");
                    $("#modalContent-xl").html(response).modal();							
                    document.getElementById('modalHeader-xl').innerHTML = '<h4>View Hazard Report</h4>';    
                },
                error  : function (e) {
                }
            });
        return false;     
    });

    /**********************************************************************************/

    $(document).on('click', '.assign', function () {
        var safetyId = $('#select_id').attr('value');
        if(safetyId != null)
        {
            var form = $(this);
            $.ajax({
                    url: '$assign'+safetyId,
                    type   : 'POST',
                    data: {
                        _csrf : '$_csrf'
                        },
                    success: function (response) 
                    {
                        $("#modal-lg").modal("show");
                        $("#modalContent-lg").html(response).modal();							
                        document.getElementById('modalHeader-lg').innerHTML = '<h4>Assign Staff Hazard</h4>';    
                    },
                    error  : function (e) {
                    }
                });
            return false;     
        }
        else
        {
            alert('Please select a hazard to assign staff!');
        }
    });

    /**********************************************************************************/

    $(document).on('click', '.delete', function () {

    var safetyId = $(this).attr('value');
    var canDelete = '$canDelete';

    if(canDelete == 1){
        var id = $(this).attr('value').split(','); 

        if(id[1] == '$UserId')
        {
            if(id[2] == 0)
            {
                desc = 'Are you sure to delete?';
                desc2 = 'You have successfully deleted the hazard!'

                Swal.fire({title:desc,icon:"warning",showCancelButton:!0,confirmButtonColor:"#34c38f",cancelButtonColor:"#f46a6a",confirmButtonText:"Confirm"})
                .then(function(t) 
                {
                    if (t.isConfirmed) {
                    $.ajax({
                        url: '$delete'+safetyId,
                        type: 'GET',
                        dataType: 'json',
                        data: { },
                        contentType: false,
                        processData: false,
                        success: function (response) 
                        {
                            if(response.success)
                            {
                                t.value&&Swal.fire({title:desc2,icon:"success",confirmButtonColor:"#34c38f",confirmButtonText:"Confirm"})
                                .then(function(t) 
                                { 
                                    if (t.value)
                                    {
                                        $('#cmstable1').DataTable().ajax.reload();
                                        window.close();
                                        btnClose.click();
                                    }
                                });
                            }
                            else
                            {
                                alert('Delete Failed!');
                            }
                        },
                        error: function () 
                        {

                        }
                    });
                    } else {

                    }
                });  
                }
            else
            {
                alert('You can no longer delete this hazard report!');
            }
        }
        else
        {
            alert('You can only delete your own hazard report!');
        }
    }
    else
    {
        alert('Sorry , your access is denied');
    }
        return false;     
    });

    /**********************************************************************************/

    $(document).on('click', '.pick', function () {
        var canPickup = '$canPickup';
        if(canPickup == 1){
            var safetyId = $('#select_id').attr('value');
            if(safetyId != null)
            {
                if($('#select_incharge').attr('value') == 0)
                {
                    desc = 'Are you sure to pick up this hazard?';
                    desc2 = 'You have successfully pick up the hazard!'

                    Swal.fire({title:desc,icon:"warning",showCancelButton:!0,confirmButtonColor:"#34c38f",cancelButtonColor:"#f46a6a",confirmButtonText:"Confirm"})
                    .then(function(t) 
                    {
                        if (t.isConfirmed) {
                        $.ajax({
                            url: '$pickup'+safetyId,
                            type: 'GET',
                            dataType: 'json',
                            data: { },
                            contentType: false,
                            processData: false,
                            success: function (response) 
                            {
                                if(response.success)
                                {
                                    t.value&&Swal.fire({title:desc2,icon:"success",confirmButtonColor:"#34c38f",confirmButtonText:"Confirm"})
                                    .then(function(t) 
                                    { 
                                        if (t.value)
                                        {
                                            $('#cmstable1').DataTable().ajax.reload();
                                            window.close();
                                            btnClose.click();
                                        }
                                    });
                                }
                                else
                                {
                                    alert('Pick UP Failed!');
                                }
                            },
                            error: function () 
                            {

                            }
                        });
                        }
                    });     
                }
                else
                {
                    alert('This hazard has been picked by other staff!');
                }
            }
            else
            {
                alert('Please select a hazard to pickup the hazard!');
            }
        }
        else
        {
            alert('Sorry , your access is denied');
        }
    });

    $(document).on('click', '.followup', function () {
        var canFollowup = '$canFollowup';
        if(canFollowup == 1)
        {
            var safetyId = $('#select_id').attr('value');
            if(safetyId != null)
            {
                var UserId = '$UserId';
                if($('#select_incharge').attr('value') == 0)
                {
                    alert('Please pick up the hazard before following up!');
                    return false;  
                }

                if($('#select_incharge').attr('value') == UserId)
                {
                    var form = $(this);
                    $.ajax({
                            url: '$followup'+safetyId,
                            type   : 'POST',
                            data: {
                                _csrf : '$_csrf'
                                },
                            success: function (response) 
                            {
                                $("#modal-xl").modal("show");
                                $("#modalContent-xl").html(response).modal();							
                                document.getElementById('modalHeader-xl').innerHTML = '<h4>Follow-Up Hazard Report</h4>';    
                            },
                            error  : function (e) {
                            }
                        });
                    return false;  
                }
                else
                {
                    alert('You can only follow-up hazard that you have picked!');
                }
            }
            else
            {
                alert('Please select a hazard to pickup the hazard!');
            }
        }
        else
        {
            alert('Sorry , your access is denied');
        }

    });
  });

JS;
$this->registerJs($script);


?>