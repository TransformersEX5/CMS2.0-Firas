<?php

/** @var yii\web\View $this */

$this->title = 'Admin';

use yii\helpers\Url;

?>

<div class="col-12">
    <div class="card">
        <h4 class="card-header mt-0 text-dark bg-white rounded">UPDATE STUDENT DETAILS</h4>
        <div class="card-body">
            <!-- <button type="button" class="btn btn-primary waves-effect waves-light mb-3 addStudent" data-bs-toggle="modal" data-bs-target="#DetailsModal" value="0">Add Returning Student</button> -->
            <div class="table-rep-plugin">
                <div class="b-0">
                    <table id="datatable-registration" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-dark">No.</th>
                                <th class="text-dark">Name</th>
                                <th class="text-dark">NRIC/Passport No.</th>
                                <th class="text-dark">Student No.</th>
                                <th class="text-dark">Attendance</th>
                                <th class="text-dark">Robe Size</th>
                                <th class="text-dark">Year</th>
                                <th class="text-dark">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<?php

$url = Url::base() . '/admin/studentlist';
$studentdetails = Url::base() . '/admin/studentdetails';
$returning = Url::base() . '/admin/returning';

$script = <<<JS

$(document).on('click', '.addStudent', function() {
    var returnId = $(this).val();
    StudentModalTitle.innerText = 'ADD';
    
    $('#modalContent').load('$returning?returnId='+returnId);
});

$(document).on('click', '.editStudent', function() {
    var convoRegId = $(this).val();
    StudentModalTitle.innerText = 'EDIT';
    
    $('#modalContent').load('$studentdetails?convoRegId='+convoRegId);
});

$( document ).ready(function() {
var table = $('#datatable-registration').DataTable({
          
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
        url: '$url',
        type: 'GET',
        datatype: 'json',
    },

    "columns": [
        {
                "data": "ConvoRegId", "width": '0.1%', class:"text-dark",
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },	
        {"data":"StudName", class:"text-dark"},		
        {"data":"StudNRICPassportNo", class:"text-dark"},		
        {"data":"StudentNo", class:"text-dark"},	
        {"data":"ConvoAttend", class:"text-dark"},		
        {"data":"Robesize", class:"text-dark"},		
        {"data":"ConvoGraduateYear", class:"text-dark"},	
        {
            "data": "ConvoRegId","width": "0.1%",
            "render": function (data, type, row, meta) 
            {
                return '<button type="button" class="btn btn-primary waves-effect waves-light editStudent" data-bs-toggle="modal" data-bs-target="#DetailsModal" value='+ JSON.stringify(data) +'>Edit</button>'
            }
        },														
    ]
});
});

JS;
$this->registerJs($script);

?>

<div class="modal fade" id="DetailsModal" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="StudentModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="StudentModalTitle">
                    EDIT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div id="modalContent" class="modal-body">

            </div>
        </div>
    </div>
</div>