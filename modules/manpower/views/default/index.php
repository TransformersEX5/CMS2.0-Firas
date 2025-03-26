<?php

use yii\helpers\Url;

$_csrf = Yii::$app->request->getCsrfToken();
$baseURL = Url::base();
$urlDraft = $baseURL . '/manpower/default/getdraftlist';
$urlPendingapproval = $baseURL . '/manpower/default/getpendingapprovallist';
$urlRejected = $baseURL . '/manpower/default/getrejectedlist';
$urlActiverequests = $baseURL . '/manpower/default/getactiverequestslist';
$urlClosedrequests = $baseURL . '/manpower/default/getclosedrequestslist';
$urlCheckRequester = $baseURL . '/manpower/default/checkrequester';
$urlBtnEdit = $baseURL . '/manpower/default/request?id=';
$urlbtnView = $baseURL . '/manpower/default/view?id=';

$script = <<< JS

$( document ).ready(function()
{
    $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
    });

    getActiverequests();
    getDraft();
    getPendingapproval();
    getRejected();
    getClosedrequests();

    $('#tblactiverequests tbody').on('click', 'tr', function() {
        var table = $('#tblactiverequests').DataTable();
        var currentTable = table.row(this).data();

        if ($(this).hasClass('selected')) 
        {
            $(this).removeClass('selected');
            // $(this).removeClass('active');
            $('#SelectItem').val(null);
            $('#CareerApprovalSetupId').val(null);
        } 

        else 
        {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            // $(this).addClass('active');
            $('#SelectItem').val(currentTable['CareerId']);
            $('#CareerApprovalSetupId').val(currentTable['CareerStatusId']);
        }
    });

    $('#tblpendingapproval tbody').on('click', 'tr', function() {
        var table = $('#tblpendingapproval').DataTable();
        var currentTable = table.row(this).data();

        if ($(this).hasClass('selected')) 
        {
            $(this).removeClass('selected');
            // $(this).removeClass('active');
            $('#SelectItem').val(null);
            $('#CareerApprovalSetupId').val(null);
        } 

        else 
        {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            // $(this).addClass('active');
            $('#SelectItem').val(currentTable['CareerId']);
            $('#CareerApprovalSetupId').val(currentTable['CareerStatusId']);
        }
    });

    $('#tbldraft tbody').on('click', 'tr', function() {
        var table = $('#tbldraft').DataTable();
        var currentTable = table.row(this).data();

        if ($(this).hasClass('selected')) 
        {
            $(this).removeClass('selected');
            // $(this).removeClass('active');
            $('#SelectItem').val(null);
            $('#CareerApprovalSetupId').val(null);
        } 

        else 
        {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            // $(this).addClass('active');
            $('#SelectItem').val(currentTable['CareerId']);
            $('#CareerApprovalSetupId').val(currentTable['CareerStatusId']);
        }
    });

    $('#tblrejectedrequest tbody').on('click', 'tr', function() {
        var table = $('#tblrejectedrequest').DataTable();
        var currentTable = table.row(this).data();

        if ($(this).hasClass('selected')) 
        {
            $(this).removeClass('selected');
            // $(this).removeClass('active');
            $('#SelectItem').val(null);
            $('#CareerApprovalSetupId').val(null);
        } 

        else 
        {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            // $(this).addClass('active');
            $('#SelectItem').val(currentTable['CareerId']);
            $('#CareerApprovalSetupId').val(currentTable['CareerStatusId']);
        }
    });

    $('#tblclosedrequest tbody').on('click', 'tr', function() {
        var table = $('#tblclosedrequest').DataTable();
        var currentTable = table.row(this).data();

        if ($(this).hasClass('selected')) 
        {
            $(this).removeClass('selected');
            // $(this).removeClass('active');
            $('#SelectItem').val(null);
            $('#CareerApprovalSetupId').val(null);
        } 

        else 
        {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            // $(this).addClass('active');
            $('#SelectItem').val(currentTable['CareerId']);
            $('#CareerApprovalSetupId').val(currentTable['CareerStatusId']);
        }
    });
});

function dangerModal(message)
{
  document.getElementById('modalHeader-danger').innerHTML = '<h4>Error!</h4>';
  $("#modalContent-danger").html('<h5>'+message+'</h5>');
  $("#modal-danger").modal({
      keyboard: false,
      backdrop: 'static',
  });
  setTimeout(function closeModal() { $("#modal-danger").modal('hide'); } ,1200);
}

function largeModal(content,headerTitle)
{
  $('#modal-Large').find('#modalContent-Large').load(content);
  document.getElementById('modalHeader-Large').innerHTML = '<h4>' + headerTitle + '</h4>';
  $("#modal-Large").modal({
      keyboard: false,
      backdrop: 'static',
  });
}

$(document).on('click', '#btnEdit', function()
{
    let CareerId = $('#SelectItem').val();
    let CareerApprovalSetupId = parseInt($('#CareerApprovalSetupId').val());    
    var canEdit = [1, 5, 9, 13, 17];
    var permanentRejected = [6, 10, 14, 18];

    if(CareerId == 0)
    {
        // return alert('Please select a career to edit');

        return Swal.fire({ html: '<div class="mt-3"><div class="mt-4 pt-2 fs-15"><h4 class="text-danger">Oops!</h4><p class="text-muted mx-4 mb-0">Please select a request to edit</p></div></div>', allowOutsideClick: 1, showConfirmButton: !0, confirmButtonClass: "btn btn-danger w-xs mb-1 me-2", confirmButtonText: "Confirm", buttonsStyling: !1, showCloseButton: 0 });
    }

    if (!canEdit.includes(CareerApprovalSetupId))
    {
        var message;

        if(permanentRejected.includes(CareerApprovalSetupId))
        {
            message = 'This request has been permanently rejected and not editable.';
        }

        else if (CareerApprovalSetupId == 21)
        {
            message = 'This request has been closed and not editable.';
        }

        else
        {
            message = 'This request is currently in the process of being approved and not editable.';
        }
        
        return Swal.fire({ html: '<div class="mt-3"><div class="mt-4 pt-2 fs-15"><h4 class="text-danger">Oops!</h4><p class="text-muted mx-4 mb-0">'+message+'</p></div></div>', allowOutsideClick: 1, showConfirmButton: !0, confirmButtonClass: "btn btn-danger w-xs mb-1 me-2", confirmButtonText: "Confirm", buttonsStyling: !1, showCloseButton: 0 });
    }

    var urlbtnEdit = "$urlBtnEdit" + btoa(CareerId);

    $.ajax({
        url: '$urlCheckRequester',
        type: 'POST',
        dataType: 'json',
        data: 
        {
            _csrf: '$_csrf',
            CareerId: CareerId,
        },
        success: function (response) 
        {
            if(response.allow == 'Yes')
            {
                window.location.href = urlbtnEdit;
            }

            else
            {
                return Swal.fire({ html: '<div class="mt-3"><div class="mt-4 pt-2 fs-15"><h4 class="text-danger">Oops!</h4><p class="text-muted mx-4 mb-0">You are not allowed to edit this MRF request.</p></div></div>', allowOutsideClick: 1, showConfirmButton: !0, confirmButtonClass: "btn btn-danger w-xs mb-1 me-2", confirmButtonText: "Confirm", buttonsStyling: !1, showCloseButton: 0 });
            }
        }
    });
});

$(document).on('click', '#btnView', function()
{
    let CareerId = $('#SelectItem').val();

    if(CareerId == 0)
    {
        return Swal.fire({ html: '<div class="mt-3"><div class="mt-4 pt-2 fs-15"><h4 class="text-danger">Oops!</h4><p class="text-muted mx-4 mb-0">Please select a MRF request to view</p></div></div>', allowOutsideClick: 1, showConfirmButton: !0, confirmButtonClass: "btn btn-danger w-xs mb-1 me-2", confirmButtonText: "Confirm", buttonsStyling: !1, showCloseButton: 0 });
    }

    var urlbtnView = "$urlbtnView" + btoa(CareerId);

    window.location.href = urlbtnView;
});

$(document).on('click', '.nav-item', function()
{
  var tblactiverequests = $('#tblactiverequests').DataTable();
  var tblpendingapproval = $('#tblpendingapproval').DataTable();
  var tbldraft = $('#tbldraft').DataTable();
  var tblrejectedrequest = $('#tblrejectedrequest').DataTable();

  if(tblactiverequests.$('tr.selected').hasClass('selected'))
  {
    tblactiverequests.$('tr.selected').removeClass('selected');
  }

  if(tblactiverequests.$('tr.selected').hasClass('active'))
  {
    tblactiverequests.$('tr.selected').removeClass('active');
  }

  if(tblpendingapproval.$('tr.selected').hasClass('selected'))
  {
    tblpendingapproval.$('tr.selected').removeClass('selected');
  }

  if(tblpendingapproval.$('tr.selected').hasClass('active'))
  {
    tblpendingapproval.$('tr.selected').removeClass('active');
  }

  if(tbldraft.$('tr.selected').hasClass('selected'))
  {
    tbldraft.$('tr.selected').removeClass('selected');
  }

  if(tbldraft.$('tr.selected').hasClass('active'))
  {
    tbldraft.$('tr.selected').removeClass('active');
  }

  if(tblrejectedrequest.$('tr.selected').hasClass('selected'))
  {
    tblrejectedrequest.$('tr.selected').removeClass('selected');
  }

  if(tblrejectedrequest.$('tr.selected').hasClass('active'))
  {
    tblrejectedrequest.$('tr.selected').removeClass('active');
  }

  if(tblclosedrequest.$('tr.selected').hasClass('selected'))
  {
    tblclosedrequest.$('tr.selected').removeClass('selected');
  }

  if(tblclosedrequest.$('tr.selected').hasClass('active'))
  {
    tblclosedrequest.$('tr.selected').removeClass('active');
  }

  $('#SelectItem').val(null);
  $('#CareerApprovalSetupId').val(null);
});

$(document).on('click', '.loadModal', function()
{
  var dataValue = atob($(this).attr('value'));
  var dataTitle = $(this).attr('title');
  var dataId = $(this).attr('id');
  var ModuleSubId = 6;
  var CareerId = $('#SelectItem').val();

});

function getClosedrequests()
{
  $('#tblclosedrequest').DataTable({

    lengthChange:false,
    // lengthMenu: [10, 25, 50, 100],
    deferRender:true,
    searching:true,
    responsive:true,						
    destroy:true,
    pageLength: 10,
    paging:true,
    processing:false,
    bAutoWidth:false,
    select: true,	

    ajax: 
        {                               
            url: '$urlClosedrequests',
            type: 'GET',
        },

        "columns": 
        [
            {
                "data": "CareerId", "width": '0.1%', class:"text-dark",
                "render": function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
                }
            },	
            {"data": "PositionName","width":"3%"},
            {"data": "BranchName","width":"2%"},              
            {"data": "TransDate","width": "0.5%"},
            {"data": "EndDate","width": "0.5%"},
            {"data": "SetupDesc2","width": "0.5%"},
        ],
        "columnDefs":
        [
            {
                "className": "text-center", "targets": [0, 3, 4, 5]
            }
        ]
    });
}

function getActiverequests()
{
  $('#tblactiverequests').DataTable({

    lengthChange:false,
    // lengthMenu: [10, 25, 50, 100],
    deferRender:true,
    searching:true,
    responsive:true,						
    destroy:true,
    pageLength: 10,
    paging:true,
    processing:false,
    bAutoWidth:false,
    select: true,	

    ajax: 
        {                               
            url: '$urlActiverequests',
            type: 'GET',
        },

        "columns": 
        [
            {
                "data": "CareerId", "width": '0.1%', class:"text-dark",
                "render": function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
                }
            },	
            {"data": "PositionName","width":"3%"},
            {"data": "BranchName","width":"2%"},              
            {"data": "TransDate","width": "0.5%"},
            {"data": "EndDate","width": "0.5%"},
            {"data": "SetupDesc2","width": "0.5%"},
        ],
        "columnDefs":
        [
            {
                "className": "text-center", "targets": [0, 3, 4, 5]
            }
        ]
    });
}

function getDraft()
{
  $('#tbldraft').DataTable({

    lengthChange:false,
    deferRender:true,
    searching:true,
    responsive:true,						
    destroy:true,
    pageLength: 10,
    paging:true,
    processing:false,
    bAutoWidth:false,	
    select: true,	

    ajax: 
        {                               
            url: '$urlDraft',
            type: 'GET',
        },

        "columns": 
        [
            {
                "data": "CareerId", "width": '0.1%', class:"text-dark",
                "render": function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
                }
            },	
            {"data": "PositionName","width":"3%"},
            {"data": "BranchName","width":"2%"},              
            {"data": "TransDate","width": "0.5%"},
            {"data": "EndDate","width": "0.5%"},
            {"data": "SetupDesc2","width": "0.5%"},
        ],
        "columnDefs":
        [
            {
                "className": "text-center", "targets": [0, 3, 4, 5]
            }
        ]
    });
}

function getPendingapproval()
{
  $('#tblpendingapproval').DataTable({

    lengthChange:false,
    // lengthMenu: [10, 25, 50, 100],
    deferRender:true,
    searching:true,
    responsive:true,						
    destroy:true,
    pageLength: 10,
    paging:true,
    processing:false,
    bAutoWidth:false,
    select: true,	

    ajax: 
        {                               
            url: '$urlPendingapproval',
            type: 'GET',
        },

        "columns": 
        [
            {
                "data": "CareerId", "width": '0.1%', class:"text-dark",
                "render": function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
                }
            },	
            {"data": "PositionName","width":"3%"},
            {"data": "BranchName","width":"2%"},              
            {"data": "TransDate","width": "0.5%"},
            {"data": "EndDate","width": "0.5%"},
            {"data": "SetupDesc2","width": "0.5%"},
        ],
        "columnDefs":
        [
            {
                "className": "text-center", "targets": [0, 3, 4, 5]
            }
        ]
    });
}

function getRejected()
{
  $('#tblrejectedrequest').DataTable({

    lengthChange:false,
    // lengthMenu: [10, 25, 50, 100],
    deferRender:true,
    searching:true,
    responsive:true,						
    destroy:true,
    pageLength: 10,
    paging:true,
    processing:false,
    bAutoWidth:false,
    select: true,	

    ajax: 
        {                               
            url: '$urlRejected',
            type: 'GET',
        },

        "columns": 
        [
            {
                "data": "CareerId", "width": '0.1%', class:"text-dark",
                "render": function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
                }
            },	
            {"data": "PositionName","width":"3%"},
            {"data": "BranchName","width":"2%"},              
            {"data": "TransDate","width": "0.5%"},
            {"data": "EndDate","width": "0.5%"},
            {"data": "SetupDesc2","width": "0.5%"},
        ],
        "columnDefs":
        [
            {
                "className": "text-center", "targets": [0, 3, 4, 5]
            }
        ]
    });
}

JS;
$this->registerJs($script);

?>

<style>
table.dataTable tbody > tr.selected {
    background-color: #a2d0ff; /* Change to your desired background color */
}
</style>

<div class="col-12">

    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-lg-6 col-md-4 col-sm-2">
                    <h4 class="card-title">Manpower Requests</h4>
                    <input type="hidden" id="SelectItem" />
                    <input type="hidden" id="CareerApprovalSetupId" />
                    <!-- <p class="card-title-desc">List of manpower requests</p> -->
                </div>
                <div class="col-lg-6 col-md-8 col-sm-10">
                    <div class="d-flex justify-content-end">
                        <!-- <button id="View" class="btn btn-primary loadModal me-2" value="<?= base64_encode(Url::base() . '/career/view') ?>" title="View Job Vacancy"><i class="glyphicon glyphicon-zoom-in"></i> View</button> -->
                        <a class="btn btn-primary me-2" href="<?= Url::base() ?>/manpower/default/request"><i class="ion ion-md-person-add me-2"></i>Request Manpower</a>
                        <button id="btnView" class="btn btn-primary me-2"><i class="mdi mdi-magnify me-2"></i>View</button>
                        <button id="btnEdit" class="btn btn-primary"><i class="fas fa-user-edit me-2"></i>Edit</button>
                    </div>
                </div>
            </div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#activerequest" role="tab">
                        <!-- <span class="d-block d-sm-none"><i class="fas fa-home"></i></span> -->
                        <!-- <span class="d-none d-sm-block"> -->
                        Active
                        <!-- </span> -->
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#pendingapproval" role="tab">
                        <!-- <span class="d-block d-sm-none"><i class="far fa-user"></i></span> -->
                        Pending Approvals
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#closedrequest" role="tab">
                        <!-- <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span> -->
                        Closed
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#rejectedrequest" role="tab">
                        <!-- <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span> -->
                        Rejected
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#draftrequest" role="tab">
                        <!-- <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span> -->
                        Draft/Pending
                    </a>
                </li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane p-3 active" id="activerequest" role="tabpanel">
                    <div class="table-rep-plugin">
                        <div class="b-0">
                            <table id="tblactiverequests" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Position</th>
                                        <th>Branch</th>
                                        <th>Date Posted</th>
                                        <th>Expiry Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane p-3" id="pendingapproval" role="tabpanel">

                    <div class="table-rep-plugin">
                        <div class="b-0">
                            <table id="tblpendingapproval" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Position</th>
                                        <th>Branch</th>
                                        <th>Date Requested</th>
                                        <th>Expiry Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="tab-pane p-3" id="closedrequest" role="tabpanel">
                    <div class="table-rep-plugin">
                        <div class="b-0">
                            <table id="tblclosedrequest" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Position</th>
                                        <th>Branch</th>
                                        <th>Date Posted</th>
                                        <th>Expiry Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane p-3" id="rejectedrequest" role="tabpanel">

                    <div class="table-rep-plugin">
                        <div class="b-0">
                            <table id="tblrejectedrequest" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Position</th>
                                        <th>Branch</th>
                                        <th>Date Requested</th>
                                        <th>Expiry Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="tab-pane p-3" id="draftrequest" role="tabpanel">

                    <div class="table-rep-plugin">
                        <div class="b-0">
                            <table id="tbldraft" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Position</th>
                                        <th>Branch</th>
                                        <th>Date Created</th>
                                        <th>Expiry Date</th>
                                        <th>Status</th>
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