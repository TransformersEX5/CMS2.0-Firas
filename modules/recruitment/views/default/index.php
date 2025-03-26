<?php

use yii\helpers\Url;

$_csrf = Yii::$app->request->getCsrfToken();
$baseURL = Url::base();
$urlDraft = $baseURL . '/recruitment/default/getdraftlist';
$urlPendingapproval = $baseURL . '/recruitment/default/getpendingapprovallist';
$urlAllrequests = $baseURL . '/recruitment/default/getallrequestslist';
$urlRejected = $baseURL . '/recruitment/default/getrejectedlist';
$urlActiverequests = $baseURL . '/recruitment/default/getactiverequestslist';
$urlClosedrequests = $baseURL . '/recruitment/default/getclosedrequestslist';
$urlCheckApprover = $baseURL . '/recruitment/default/checkapprover';
$urlbtnApprove = $baseURL . '/recruitment/default/approval?id=';
$urlbtnView = $baseURL . '/recruitment/default/view?id=';

$script = <<< JS

$( document ).ready(function()
{
    $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
    });

    getPendingapproval();
    getAllrequests();
    getRejected();
    getActiverequests();
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

    $('#tblallrequests tbody').on('click', 'tr', function() {
        var table = $('#tblallrequests').DataTable();
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

$(document).on('click', '#btnApprove', function()
{
    let CareerId = $('#SelectItem').val();
    let CareerApprovalSetupId = parseInt($('#CareerApprovalSetupId').val());    
    var canApprove = [3, 7, 9, 11, 15, 19];
    var permanentRejected = [6, 10, 14, 18];

    if(CareerId == 0)
    {
        return Swal.fire({ html: '<div class="mt-3"><div class="mt-4 pt-2 fs-15"><h4 class="text-danger">Oops!</h4><p class="text-muted mx-4 mb-0">Please select a MRF request to process</p></div></div>', allowOutsideClick: 1, showConfirmButton: !0, confirmButtonClass: "btn btn-danger w-xs mb-1 me-2", confirmButtonText: "Confirm", buttonsStyling: !1, showCloseButton: 0 });
    }

    if (!canApprove.includes(CareerApprovalSetupId))
    {
        var message;

        if(permanentRejected.includes(CareerApprovalSetupId))
        {
            message = 'This request has been permanently rejected.';
        }

        else if (CareerApprovalSetupId == 21)
        {
            message = 'This request is closed.';
        }

        return Swal.fire({ html: '<div class="mt-3"><div class="mt-4 pt-2 fs-15"><h4 class="text-danger">Oops!</h4><p class="text-muted mx-4 mb-0">'+message+'</p></div></div>', allowOutsideClick: 1, showConfirmButton: !0, confirmButtonClass: "btn btn-danger w-xs mb-1 me-2", confirmButtonText: "Confirm", buttonsStyling: !1, showCloseButton: 0 });    
    }

    var urlbtnApprove = "$urlbtnApprove" + btoa(CareerId);

    $.ajax({
        url: '$urlCheckApprover',
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
                window.location.href = urlbtnApprove;
            }

            else
            {
                return Swal.fire({ html: '<div class="mt-3"><div class="mt-4 pt-2 fs-15"><h4 class="text-danger">Oops!</h4><p class="text-muted mx-4 mb-0">You are not allowed to process this MRF request.</p></div></div>', allowOutsideClick: 1, showConfirmButton: !0, confirmButtonClass: "btn btn-danger w-xs mb-1 me-2", confirmButtonText: "Confirm", buttonsStyling: !1, showCloseButton: 0 });
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
  var tblallrequests = $('#tblallrequests').DataTable();
  var tblclosedrequest = $('#tblclosedrequest').DataTable();

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

  if(tblallrequests.$('tr.selected').hasClass('selected'))
  {
    tblallrequests.$('tr.selected').removeClass('selected');
  }

  if(tblallrequests.$('tr.selected').hasClass('active'))
  {
    tblallrequests.$('tr.selected').removeClass('active');
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

function getAllrequests()
{
  $('#tblallrequests').DataTable({

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
            url: '$urlAllrequests',
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
            {"data": "PositionName","width":"2%"},
            {"data": "BranchName","width":"0.7%"},              
            {"data": "TransDate","width": "3%"},
            {"data": "EndDate","width": "1%"},
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
                <div class="col-lg-8 col-md-6 col-sm-4">
                    <h4 class="card-title">Manpower Requests</h4>
                    <input type="hidden" id="SelectItem" />
                    <input type="hidden" id="CareerApprovalSetupId" />
                    <!-- <p class="card-title-desc">List of manpower requests</p> -->
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="d-flex justify-content-end">
                        <button id="btnView" class="btn btn-primary me-2"><i class="mdi mdi-magnify me-2"></i>View</button>
                        <button id="btnApprove" class="btn btn-primary"><i class="fas fa-user-edit me-2"></i>Approval</button>
                    </div>
                </div>
            </div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#allrequests" role="tab">
                        <!-- <span class="d-block d-sm-none"><i class="far fa-user"></i></span> -->
                        All requests
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#pendingapproval" role="tab">
                        <!-- <span class="d-block d-sm-none"><i class="far fa-user"></i></span> -->
                        Pending Approvals
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#activerequest" role="tab">
                        <!-- <span class="d-block d-sm-none"><i class="fas fa-home"></i></span> -->
                        <!-- <span class="d-none d-sm-block"> -->
                        Active
                        <!-- </span> -->
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
            </ul>

            <div class="tab-content">

                <div class="tab-pane p-3" id="allrequests" role="tabpanel">
                    <div class="table-rep-plugin">
                        <div class="b-0">
                            <table id="tblallrequests" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Position</th>
                                        <th>Branch</th>
                                        <th>Request Information</th>
                                        <th>Expiry Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane active p-3" id="pendingapproval" role="tabpanel">
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

                <div class="tab-pane p-3" id="activerequest" role="tabpanel">
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

            </div>

        </div>
    </div>
</div>