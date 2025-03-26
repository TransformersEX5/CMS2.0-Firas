   <?php

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\Url;
    ?>
   <div class="row">

       <h2 class="card-title">Academic Qualification</h2>

       <br>

       <div class='col-12 .col-sm-12'>
           <div class="box-body">
               <table id="cmstable9" class="table table-bordered table-hover" width="100%" cellspacing="0">
                   <thead>
                       <tr>
                           <th style="text-align:center;">No.</th>
                           <th>Research Project</th>
                           <th style="text-align:center;">Source</th>
                           <th>Total Grants (RM)</th>
                           <th style="text-align:center;">Grant Category</th>
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

    $getResearchGrants = Url::toRoute(['researchgrants/researchgrantslist']);

    $_csrf = Yii::$app->request->getCsrfToken();

    $script = <<<JS

    $(document).ready(function(){

        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            // Check if the table is initialized
            if ($.fn.DataTable.isDataTable('#cmstable9')) {
                $('#cmstable9').DataTable().columns.adjust().draw();
            }
        });

        var table = $('#cmstable9').DataTable({
            lengthChange:false,			processing: true,
            deferRender:true,			searching:true,
            responsive:true,				
            destroy:true,			pageLength: 10,
            paging:false,			scrollY: true,   
            // dom: 'Bfrtip',                      
            ajax:
            { 
                url: '$getResearchGrants',
                type: 'GET',        
                data:
                {
                    // txtSearch:$("#txtSearch").val(),
                }
            },
            "columns": [
            {
                "data": "ResearchProject", class:"text-dark text-center",
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },	
            {"data":"ResearchProject"},	
            {"data":"ResearchSource", class:"text-center"},	
            {"data":"TotalGrants"},
            {"data":"GrantCategory", class:"text-center"},
            {"data":"Duration", class:"text-center"},
            {"data": "ResearchGrantId", class:"text-center",
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