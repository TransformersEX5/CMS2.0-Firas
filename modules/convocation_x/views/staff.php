<?php

/** @var yii\web\View $this */

$this->title = 'Admin';

use yii\helpers\Url;

?>

<?php

$url = Url::base() . '/admin/stafflist?posId=';
$staffdetails = Url::base() . '/admin/staffdetails';

$script = <<<JS

$( document ).ready(function() {

$('a[data-bs-toggle="tab"]').on( 'shown.bs.tab', function (e) {
        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
    } );

$(document).on('click', '.poStatus', function() {

    var posId = $(this).attr('value');

    $('#posHidden').val(posId);

});

$(document).on('click', '.addStaff', function() {
    var staffId = $(this).val();

    var posId = $('#posHidden').val();

    StaffModalTitle.innerText = 'ADD';

    $('#modalContent').load('$staffdetails?staffId='+staffId+'&posId='+posId);
});

$(document).on('click', '.editStaff', function() {
    var staffId = $(this).val();
    StaffModalTitle.innerText = 'EDIT';

    $('#modalContent').load('$staffdetails?staffId='+staffId);
});

var table = $('#datatable-studstatus').DataTable({
    
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
        url: '$url'+1,
        type: 'GET',
        datatype: 'json',
    },

    "columns": [
        {
                "data": "ConvoStaffDetailsId", "width": '5.0%', class:"text-dark",
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },	
        {"data":"FullName", "width": '45.0%', class:"text-dark"},		
        {"data":"ConvoStaffEmail", "width": '10.0%', class:"text-dark"},		
        {"data":"ConvoStaffMobileNo", "width": '25.0%', class:"text-dark"},	
        {"data":"StatusName", "width": '10.0%', class:"text-dark"},		
        {
            "data": "ConvoStaffDetailsId","width": "5.0%",
            "render": function (data, type, row, meta) 
            {
                return '<button type="button" class="btn btn-primary waves-effect waves-light editStaff" data-bs-toggle="modal" data-bs-target="#DetailsModal" value='+ JSON.stringify(data) +'>Edit</button>'
            }
        },
    ]
});

var table = $('#datatable-feepayment').DataTable({
    
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
        url: '$url'+2,
        type: 'GET',
        datatype: 'json',
    },

    "columns": [
        {
                "data": "ConvoStaffDetailsId", "width": '5.0%', class:"text-dark",
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },	
        {"data":"FullName", "width": '45.0%', class:"text-dark"},		
        {"data":"ConvoStaffEmail", "width": '10.0%', class:"text-dark"},		
        {"data":"ConvoStaffMobileNo", "width": '25.0%', class:"text-dark"},	
        {"data":"StatusName", "width": '10.0%', class:"text-dark"},		
        {
            "data": "ConvoStaffDetailsId","width": "5.0%",
            "render": function (data, type, row, meta) 
            {
                return '<button type="button" class="btn btn-primary waves-effect waves-light editStaff" data-bs-toggle="modal" data-bs-target="#DetailsModal" value='+ JSON.stringify(data) +'>Edit</button>'
            }
        },
    ]
});

var table = $('#datatable-traceralumni').DataTable({
    
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
        url: '$url'+3,
        type: 'GET',
        datatype: 'json',
    },

    "columns": [
        {
                "data": "ConvoStaffDetailsId", "width": '5.0%', class:"text-dark",
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },	
        {"data":"FullName", "width": '45.0%', class:"text-dark"},		
        {"data":"ConvoStaffEmail", "width": '10.0%', class:"text-dark"},		
        {"data":"ConvoStaffMobileNo", "width": '25.0%', class:"text-dark"},	
        {"data":"StatusName", "width": '10.0%', class:"text-dark"},		
        {
            "data": "ConvoStaffDetailsId","width": "5.0%",
            "render": function (data, type, row, meta) 
            {
                return '<button type="button" class="btn btn-primary waves-effect waves-light editStaff" data-bs-toggle="modal" data-bs-target="#DetailsModal" value='+ JSON.stringify(data) +'>Edit</button>'
            }
        },
    ]
});

var table = $('#datatable-other').DataTable({
    
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
        url: '$url'+4,
        type: 'GET',
        datatype: 'json',
    },

    "columns": [
        {
                "data": "ConvoStaffDetailsId", "width": '5.0%', class:"text-dark",
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },	
        {"data":"FullName", "width": '45.0%', class:"text-dark"},		
        {"data":"ConvoStaffEmail", "width": '10.0%', class:"text-dark"},		
        {"data":"ConvoStaffMobileNo", "width": '25.0%', class:"text-dark"},	
        {"data":"StatusName", "width": '10.0%', class:"text-dark"},		
        {
            "data": "ConvoStaffDetailsId","width": "5.0%",
            "render": function (data, type, row, meta) 
            {
                return '<button type="button" class="btn btn-primary waves-effect waves-light editStaff" data-bs-toggle="modal" data-bs-target="#DetailsModal" value='+ JSON.stringify(data) +'>Edit</button>'
            }
        },
    ]
});
});

JS;
$this->registerJs($script);

?>

<div class="col-12">
    <div class="card">
        <h4 class="card-header mt-0 text-dark bg-white rounded">ADD/UPDATE STAFF DETAILS</h4>
        <div class="card-body">
            <input id="posHidden" type="hidden" value="1"></input>
            <button type="button" class="btn btn-primary waves-effect waves-light mb-3 addStaff" data-bs-toggle="modal" data-bs-target="#DetailsModal" value="0">Add New</button>
            <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active poStatus" data-bs-toggle="tab" href="#studstatus" role="tab" value='1'>STUDENT STATUS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link poStatus" data-bs-toggle="tab" href="#feepayment" role="tab" value='2'>FEES & PAYMENT ISSUE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link poStatus" data-bs-toggle="tab" href="#traceralumni" role="tab" value='3'>TRACER STUDY & ALUMNI MATTERS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link poStatus" data-bs-toggle="tab" href="#other" role="tab" value='4'>OTHER CONVOCATION MATTERS</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active p-3" id="studstatus" role="tabpanel">
                    <div class="table-rep-plugin">
                        <div class="b-0">
                            <table id="datatable-studstatus" class="table table-striped dttable">
                                <thead>
                                    <tr>
                                        <th class="text-dark">No.</th>
                                        <th class="text-dark">Name</th>
                                        <th class="text-dark">Email</th>
                                        <th class="text-dark">Mobile No.</th>
                                        <th class="text-dark">Status</th>
                                        <th class="text-dark">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane p-3" id="feepayment" role="tabpanel">
                    <div class="table-rep-plugin">
                        <div class="b-0">
                            <table id="datatable-feepayment" class="table table-striped dttable">
                                <thead>
                                    <tr>
                                        <th class="text-dark">No.</th>
                                        <th class="text-dark">Name</th>
                                        <th class="text-dark">Email</th>
                                        <th class="text-dark">Mobile No.</th>
                                        <th class="text-dark">Status</th>
                                        <th class="text-dark">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane p-3" id="traceralumni" role="tabpanel">
                    <div class="table-rep-plugin">
                        <div class="b-0">
                            <table id="datatable-traceralumni" class="table table-striped dttable">
                                <thead>
                                    <tr>
                                        <th class="text-dark">No.</th>
                                        <th class="text-dark">Name</th>
                                        <th class="text-dark">Email</th>
                                        <th class="text-dark">Mobile No.</th>
                                        <th class="text-dark">Status</th>
                                        <th class="text-dark">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane p-3" id="other" role="tabpanel">
                    <div class="table-rep-plugin">
                        <div class="b-0">
                            <table id="datatable-other" class="table table-striped dttable">
                                <thead>
                                    <tr>
                                        <th class="text-dark">No.</th>
                                        <th class="text-dark">Name</th>
                                        <th class="text-dark">Email</th>
                                        <th class="text-dark">Mobile No.</th>
                                        <th class="text-dark">Status</th>
                                        <th class="text-dark">Action</th>
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

<div class="modal fade" id="DetailsModal" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="StaffModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="StaffModalTitle">
                    EDIT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div id="modalContent" class="modal-body">

            </div>
        </div>
    </div>
</div>