   <?php

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\Url;
    ?>
   <div class="row">

       <h2 class="card-title">Conference/Seminar/Training/Workshop</h2>

       <br>

       <div class='col-12 .col-sm-12'>
           <div class="box-body">
               <table id="cmstable10" class="table table-bordered table-hover" width="100%" cellspacing="0">
                   <thead>
                       <tr>
                           <th style="text-align:center;">No.</th>
                           <th>Activities</th>
                           <th style="text-align:center;">Category</th>
                           <th>Year</th>
                           <th style="text-align:center;">Start Date</th>
                           <th style="text-align:center;">End Date</th>
                           <th style="text-align:center;">Actions</th>
                           <th style="text-align:center;">Certificate</th>
                       </tr>
                   </thead>

               </table>
           </div>
       </div>
   </div>


   <?php

    $getConference = Url::toRoute(['conference/conferencelist']);

    $_csrf = Yii::$app->request->getCsrfToken();

    $script = <<<JS

    $(document).ready(function(){

        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            // Check if the table is initialized
            if ($.fn.DataTable.isDataTable('#cmstable10')) {
                $('#cmstable10').DataTable().columns.adjust().draw();
            }
        });

        var table = $('#cmstable10').DataTable({
            lengthChange:false,			processing: true,
            deferRender:true,			searching:true,
            responsive:true,				
            destroy:true,			pageLength: 10,
            paging:false,			scrollY: true,   
            // dom: 'Bfrtip',                      
            ajax:
            { 
                url: '$getConference',
                type: 'GET',        
                data:
                {
                    // txtSearch:$("#txtSearch").val(),
                }
            },
            "columns": [
            {
                "data": "ActivityName", class:"text-dark text-center",
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },	
            {"data":"ActivityName"},	
            {"data":"LevelTypeDesc", class:"text-center"},	
            {"data":"ActivityYear"},
            {"data":"ActivityStartDate", class:"text-center"},
            {"data":"ActivityEndDate", class:"text-center"},
            {"data": "ActivityId", class:"text-center",
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