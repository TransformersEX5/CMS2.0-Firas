   <?php

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\Url;
    ?>
   <div class="row">

       <h2 class="card-title">Advisory and Profesional Services</h2>

       <br>

       <div class='col-12 .col-sm-12'>
           <div class="box-body">
               <table id="cmstable3" class="table table-bordered table-hover" width="100%" cellspacing="0">
                   <thead>
                       <tr>
                           <th style="text-align:center;">No.</th>
                           <th>Professional Services</th>
                           <th style="text-align:center;">Position</th>
                           <th>Duration</th>
                           <th style="text-align:center;">Actions</th>
                           <th style="text-align:center;">Certificate</th>
                       </tr>
                   </thead>

               </table>
           </div>
       </div>
   </div>

   <?php

    $getServices = Url::toRoute(['services/serviceslist']);

    $_csrf = Yii::$app->request->getCsrfToken();

    $script = <<<JS

    $(document).ready(function(){

        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            // Check if the table is initialized
            if ($.fn.DataTable.isDataTable('#cmstable3')) {
                $('#cmstable3').DataTable().columns.adjust().draw();
            }
        });

        var table = $('#cmstable3').DataTable({
            lengthChange:false,			processing: true,
            deferRender:true,			searching:true,
            responsive:true,				
            destroy:true,			pageLength: 10,
            paging:false,			scrollY: true,   
            // dom: 'Bfrtip',                      
            ajax:
            { 
                url: '$getServices',
                type: 'GET',        
                data:
                {
                    // txtSearch:$("#txtSearch").val(),
                }
            },
            "columns": [
            {
                "data": "ServiceName", class:"text-dark text-center",
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },	
            {"data":"ServiceName"},	
            {"data":"ServicePosition", class:"text-center"},	
            {"data":"Duration"},
            {"data": "UserServiceId", class:"text-center",
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