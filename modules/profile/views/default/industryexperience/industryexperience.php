<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<div class="row">

   <h2 class="card-title">Industry Experience</h2>

   <br>

   <div class='col-12 .col-sm-12'>
       <div class="box-body">
           <table id="cmstable4" class="table table-bordered table-hover" width="100%" cellspacing="0">
               <thead>
                   <tr>
                       <th style="text-align:center;">No.</th>
                       <th>Company Name</th>
                       <th style="text-align:center;">Position</th>
                       <th>Start Date</th>
                       <th style="text-align:center;">End Date</th>
                       <th style="text-align:center;">Duration</th>
                       <th style="text-align:center;">Actions</th>
                       <th style="text-align:center;">Certificate</th>
                   </tr>
               </thead>

           </table>
       </div>
   </div>
</div>


<?php

$getIndustryExp = Url::toRoute(['industryexperience/industryexperiencelist']);

$_csrf = Yii::$app->request->getCsrfToken();

$script = <<<JS

$(document).ready(function(){

    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        // Check if the table is initialized
        if ($.fn.DataTable.isDataTable('#cmstable4')) {
            $('#cmstable4').DataTable().columns.adjust().draw();
        }
    });

    var table = $('#cmstable4').DataTable({
        lengthChange:false,			processing: true,
        deferRender:true,			searching:true,
        responsive:true,				
        destroy:true,			pageLength: 10,
        paging:false,			scrollY: true,   
        // dom: 'Bfrtip',                      
        ajax:
        { 
            url: '$getIndustryExp',
            type: 'GET',        
            data:
            {
                // txtSearch:$("#txtSearch").val(),
            }
        },
        "columns": [
        {
            "data": "EmpCompanyName", class:"text-dark text-center",
            "render": function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },	
        {"data":"EmpCompanyName"},	
        {"data":"EmpPosition", class:"text-center"},	
        {"data":"EmpDateJoin"},
        {"data":"EmpDateEnd", class:"text-center"},
        {"data":"EmpDuration", class:"text-center"},
        {"data": "EmpCompanyId", class:"text-center",
            "render": function ( data, type, row, meta ) { 
                return '<div class="dropdown">'+
                    '<a class="btn btn-primary btn-sm waves-effect waves-light" onclick="alert(\'Edit\')">Edit</a><br><br>'+
                    '<a class="btn btn-danger btn-sm waves-effect waves-light" onclick="alert(\'Delete\')">Delete</a>'+
                '</div>';
            }
        },
        {"data": "UploadFileName", class:"text-center",
            "render": function ( data, type, row, meta ) { 
                return '<div class="dropdown">'+
                    '<a class="btn btn-primary btn-sm waves-effect waves-light" onclick="alert(\'Download\')">Download</a><br><br>'+
                    '<a class="btn btn-primary btn-sm waves-effect waves-light" onclick="alert(\'View\')">View</a>'+
                '</div>';
            }
        },	
        ],
    });

});

JS;
$this->registerJs($script);
?>