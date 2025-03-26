<?php

/** @var yii\web\View $this */

$this->title = 'Admin';

use yii\helpers\Url;

?>

<div class="col-12">
    <div class="card">
        <h4 class="card-header mt-0 text-dark bg-white rounded">ADD/UPDATE CONVOCATION DETAILS</h4>
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary waves-effect waves-light mb-3 addConvo" data-bs-toggle="modal" data-bs-target="#DetailsModal" value="0">Add New</button>
            </div>
            <div class="table-rep-plugin">
                <div class="b-0">
                    <table id="cmstable1" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-dark">No.</th>
                                <th class="text-dark">Year</th>
                                <th class="text-dark">Date</th>
                                <th class="text-dark">Time</th>
                                <th class="text-dark">Venue</th>
                                <th class="text-dark">Email</th>
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

<?php

$module = '/' . Yii::$app->controller->module->id;

$url = Url::base() . $module . '/default/convocationlist';
$details = Url::base() . $module . '/default/details';

$script = <<<JS

$(document).on('click', '.addConvo', function() {
    var convoId = $(this).val();
    DetailsModalTitle.innerText = 'ADD';
    
    $('#modalContent').load('$details?convoId='+convoId);
});

$(document).on('click', '.editConvo', function() {
    var convoId = $(this).val();
    DetailsModalTitle.innerText = 'EDIT';

    $('#modalContent').load('$details?convoId='+convoId);
});

$( document ).ready(function() {
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
        url: '$url',
        type: 'GET',
        datatype: 'json',
    },

    "columns": [
        {
                "data": "ConvoDetailsId", "width": '0.1%', class:"text-dark",
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },	
        {"data":"ConvoYear", class:"text-dark"},		
        {"data":"ConvoDate", class:"text-dark"},		
        {"data":"ConvoTime", class:"text-dark"},		
        {"data":"ConvoVenue", class:"text-dark"},	
        {"data":"ConvoEmail", class:"text-dark"},		
        {"data":"ConvoStatus", class:"text-dark"},	
        {
            "data": "ConvoDetailsId","width": "0.1%",
            "render": function (data, type, row, meta) 
            {
                return '<button type="button" class="btn btn-primary btn-sm waves-effect waves-light editConvo" data-bs-toggle="modal" data-bs-target="#DetailsModal" value='+ JSON.stringify(data) +'>Edit</button>'
            }
        },														
    ]
});
});

JS;
$this->registerJs($script);

?>

<div class="col-12">
    <div class="modal fade" id="DetailsModal" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="DetailsModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="DetailsModalTitle">
                        EDIT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div id="modalContent" class="modal-body">

                </div>
            </div>
        </div>
    </div>
</div>