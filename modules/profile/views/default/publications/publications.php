   <?php

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\Url;
    ?>
   <div class="row">

       <h2 class="card-title">Academic Qualification</h2>

       <br>

       <!-- <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
           <thead>
               <tr>
                   <th>No.</th>
                   <th>University</th>
                   <th>Level</th>
                   <th>Program</th>
                   <th>CGPA</th>
                   <th>Year Complete</th>
                   <th>Actions</th>
                   <th>Certificate</th>
               </tr>
           </thead>

           <tbody>
               <tr>
                   <td>Tiger Nixon</td>
                   <td>System Architect</td>
                   <td>Edinburgh</td>
                   <td>61</td>
                   <td>2011/04/25</td>
                   <td>$320,800</td>
                   <td>$320,800</td>
                   <td>$320,800</td>
               </tr>
           </tbody>
       </table> -->

       <div class='col-12 .col-sm-12'>
           <div class="box-body">
               <table id="cmstable1" class="table table-bordered table-hover" width="100%" cellspacing="0">
                   <thead>
                       <tr>
                           <th style="text-align:center;">No.</th>
                           <th>University</th>
                           <th style="text-align:center;">Level</th>
                           <th>Program</th>
                           <th style="text-align:center;">CGPA</th>
                           <th style="text-align:center;">Year Complete</th>
                           <th style="text-align:center;">Actions</th>
                           <th style="text-align:center;">Certificate</th>
                       </tr>
                   </thead>

               </table>
           </div>
       </div>
   </div>


   <?php

    $spouse = Url::toRoute(['/profile/family/spouse']);
    $children = Url::toRoute(['/profile/family/children ']);

    $create = Url::toRoute(['default/create']);
    $edit = Url::toRoute(['default/edit']);
    $download = Url::toRoute(['default/download']);
    $delete = Url::toRoute(['default/delete']);


    $UserId = 3213;
    $getAcaQuali = Url::toRoute(['academicqualification/academicqualificationlist']);

    $_csrf = Yii::$app->request->getCsrfToken();

    $script = <<<JS





    $(document).ready(function(){

        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            // Check if the table is initialized
            if ($.fn.DataTable.isDataTable('#cmstable1')) {
                $('#cmstable1').DataTable().columns.adjust().draw();
            }
        });

        var table = $('#cmstable1').DataTable({
            lengthChange:false,			processing: true,
            deferRender:true,			searching:true,
            responsive:true,				
            destroy:true,			pageLength: 10,
            paging:false,			scrollY: true,   
            // dom: 'Bfrtip',                      
            ajax:
            { 
                url: '$getAcaQuali',
                type: 'GET',        
                data:
                {
                    // txtSearch:$("#txtSearch").val(),
                }
            },
            "columns": [
            {
                "data": "EduUniName", class:"text-dark text-center",
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },	
            {"data":"EduUniName"},	
            {"data":"EducCode", class:"text-center"},	
            {"data":"EduCourse"},
            {"data":"EduCgpa", class:"text-center"},
            {"data":"EduYearComplete", class:"text-center"},
            // {"data": "EducationId", class:"text-center",
            //     "render": function ( data, type, row, meta ) { 
            //         return '<div class="dropdown">'+
            //         '<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Action</a>'+
            //         '<ul class="dropdown-menu">'+
            //         '<li><a class="dropdown-item edit" value='+ JSON.stringify(data+','+row.StatusId) +' href="#">Change Status</a></li>'+
            //         '<li><a class="dropdown-item download" value='+ JSON.stringify(data) +' href="#">Download</a></li>'+
            //         '<li><a class="dropdown-item delete" value='+ JSON.stringify(data) +' href="#">Delete</a></li>'+
            //         '</ul>'+
            //         '</div>';
            //     }
            // },
            {"data": "EducationId", class:"text-center",
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
            // {
            //     "data": "EducationId","width": "0.2%",
            //     "render": function (data, type, row, meta) 
            //     {
            //         var buttons = '';
            //         buttons += '<div class="dropdown">';
            //         buttons += '<button class="dropbtn rounded-pill btn-sm">Actions</button>';
            //         buttons += '<div class="dropdown-content">';
            //         buttons += '<a class="showModalButton" title="Edit Academic Qualification" value="'+btoa('myprofile/educationadd?userid='+$UserId+'&id='+data)+'">Edit</a>';
            //         buttons += '<a class="showModalButton" title="Delete Academic Qualification" value="'+btoa('myprofile/deleterow?mode=educationadd&id='+data)+'">Delete</a>';
            //         buttons += '</div>';
            //         buttons += '</div>';

            //         // return buttons;
            //         return "<button class='rounded-pill showModalButton btn btn-info' type='button' title='Edit Academic Qualification' value="+btoa("myprofile/educationadd?userid="+$UserId+"&id="+data)+">Edit</button><br><br>"+
            //          "<button type='button' class='rounded-pill showModalButton btn btn-danger' title='Delete Academic Qualification' value="+btoa("myprofile/deleterow?mode=educationadd&id="+data)+">Delete</button>"
            //     }
            // },

            // {
            //     "data": "UploadFileName","width": "0.1%",
            //     "render": function (data, type, row, meta) 
            //     {
            //         return '<button type="button" class="btn btn-info rounded-pill" onclick=DownloadButton(' + JSON.stringify(btoa(data)) + ')>Download</button> <br><br>' + '<button type="button" class="btn btn-info rounded-pill" onclick=ViewButton(' + JSON.stringify(btoa(data)) + ')>View</button>'
            //     }
            // }		
            ],
        });

    });

    JS;
    $this->registerJs($script);
    ?>