<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;


/** @var yii\web\View $this */
/** @var app\models\Tbltraining $model */
/** @var yii\widgets\ActiveForm $form */

$backindex = '/training';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');
$Tid = Yii::$app->request->get('TrainingId');

?>

<!-- Include jQuery -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js?v=<?php echo date('YmdHis'); ?>"></script> -->

<!-- Include DataTables -->
<!-- <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js?v=<?php echo date('YmdHis'); ?>"></script> -->

<?= Html::csrfMetaTags() ?>
<style>
    .row_selected {
        background-color: rgba(50, 115, 220, 0.3) !important;
        z-index: 9999
    }


    table.dataTable td {
        font-size: 12px;
        font-family: Verdana, Arial, Helvetica, sans-serif;

    }

    .dataTables_filter {
        float: right !important;
    }
</style>

<div class="tbltraining-form">

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'options' => ['enctype' => 'multipart/form-data'],
        'id' => 'trainingattandance',
    ]); ?>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-4 mt-2">

                    </div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Participant</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#profile" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">Attendance</span>
                            </a>
                        </li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active p-1" id="home" role="tabpanel">
                            <p class="mb-0">

                            <div class="row">
                                <div class="col-xl-6 mt-1">
                                    <table id="lstStaffList" class="table table-bordered table-hover" width="100%" cellspacing="1">
                                        <thead>
                                            <tr>
                                                <th>Staff List</th>
                                                <th>.:.</th>
                                            </tr>
                                        </thead>
                                    </table>

                                </div>
                                <!-- <?= $model->TrainingId; ?> -->
                                <div class="col-xl-6 mt-2">
                                    <table id="lstPaticipantList" class="table table-bordered table-hover" width="100%" cellspacing="1">
                                        <thead>
                                            <tr>
                                                <th>No.</th>

                                                <th>Paticipant List</th>
                                                <th>.:.</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>


                            </div> <!-- end row -->



                            </p>
                        </div>
                        <div class="tab-pane p-3" id="profile" role="tabpanel">
                            <p class="mb-0">

                            <div class="row">
                                <div class="col-xl-2 mt-2">
                                    <!-- to show training duration -->
                                    <div id="listtrainingdaytime"></div>

                                    <br>

                                    <input type="hidden" id="TDId"></input>

                                    <div id="printAttendance" value="<?= $Tid; ?>" style="display:none;">
                                        <button type="button" class="btn btn-primary btn-sm attendanceReport">Print Report</button>
                                    </div>
                                </div>
                                <div class="col-xl-10 mt-2">
                                    <!-- <div id="list_training_paticipant_attandance"></div>-->


                                    <table id="list_training_paticipant_attandance" class="table table-bordered table-hover" width="100%" cellspacing="1">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Paticipant List</th>
                                                <th>.:.</th>
                                                <th>Evaluation Status</th>
                                            </tr>
                                        </thead>
                                    </table>


                                </div>


                            </div>

                            </p>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="form-group mt-1">


        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>


<?php
$TrainingId = $_GET['TrainingId'];
$stafflist = Url::toRoute(['/trainingpaticipant/trainingstafflist']);
$participantlist = Url::toRoute(['/trainingpaticipant/trainingparticipantlist']);
$RemovePaticipant = Url::toRoute(['/trainingpaticipant/delete']);
$InsertPaticipant = Url::toRoute(['/trainingpaticipant/create']);
$trainingdate = Url::toRoute(['/training/trainingdurationdatelist']);
$trainingattandancelist = Url::toRoute(['/trainingattandance/trainingattandancelist']);
$InsertPaticipantAttandance = Url::toRoute(['/trainingattandance/update']);
$rpt_training_attendance_detail = Url::toRoute(['/reportgallery/trainingattendancedetail?id=']);



$script = <<<JS

            $( document ).ready(function() {


            GetTrainingDurationDate();


            

        /* Get table value */
        function GetTrainingDurationDate(){

            $.ajax({           
            type: 'GET',
            url: '$trainingdate?TrainingId='+$TrainingId,
            // dataType: 'json',
            data: {
                                                
                    },
            success: function(data) {

                $('#listtrainingdaytime').html(data);                    
                
            }
            });

            }

            $(document).on('click', '.attendanceReport', function() {

                var id = $('#printAttendance').attr('value'); 
                var attendanceId = $('#TDId').attr('value'); 
                
                window.open('$rpt_training_attendance_detail'+id+'&attendanceId='+attendanceId, '_blank');

            });

        });


      

// $.noConflict();?
jQuery.noConflict();


// Clear the DataTable before refreshing it
$('#lstStaffList').DataTable().clear().draw();




jQuery(document).ready(function() {

    $("#lstStaffList").dataTable().fnDestroy();

    // $('#lstStaffList').DataTable().empty();
    var table1 = $('#lstStaffList').DataTable({
        
        select: true,
      lengthChange: false,
      processing: true,
      deferRender: true,
      //ordering: false,
      pageLength: 10,
      bSort: false,
	  searching:true,	
      responsive: true,
      destroy: true,
      paging: true,        
        ajax: { 
            url: '$stafflist',
            url :'$stafflist?txtTrainingId='+$TrainingId,      
            type: 'GET',
            
            data: {
              
                //txtTrainingId: $model->TrainingId,
                   
                }
        },
       

     "columns":[
            {
            "data": "FullName",
            "render": function (data, type, row) {
                return row.UserNo + ' - ' + row.FullName;
                }
            },            
            {"data":"UserId",
                "render": function ( data, type, row, meta ) { 
                    return ' <button type="button"  value="'+data+'" class="btn btn-success btn-sm Insert_Paticipant" >Add</button>';                    
                    }
            }           
        ]

    });

   


//    ********************************************************************************************************************************



// $('#lstPaticipantList').DataTable().empty();
    var table2 = $('#lstPaticipantList').DataTable({

        "createdRow": function(row, data, dataIndex) {
        // Set the sequential count in the first column
        $('td:eq(0)', row).html(dataIndex + 1);
      }
    ,


        select: true,
      lengthChange: false,
      processing: true,
      deferRender: true,
      //ordering: false,
      pageLength: 10,
      bSort: false,
	  searching:true,	
      responsive: true,
      destroy: true,
      paging: true,        
        ajax: { 
            url: '$participantlist',
            type: 'GET',
            data: {
                
                txtTrainingId: $model->TrainingId,   
                }
        },

        "columns":[
            {"data": "FullName","width": "5px"},	    
            {
            "data": "FullName",
            "render": function (data, type, row) {
                return row.UserNo + ' - ' + row.FullName;
                }
            },
            {"data": "ParticipantId2",
                "render": function ( data, type, row, meta ) { 
                    return ' <button type="button"  value="'+data+'" class="btn btn-danger btn-sm Remove_Paticipant" >Remove</button>';
                    }
            }
        ]

    });

  
   
//    ********************************************************************************************************************************


    $(document).off('click', '.DurationAttandance').on('click', '.DurationAttandance', function () {
        
        var TrainingDurationId = $(this).attr('value'); 
        
        
        if(TrainingDurationId != '')
        {
            $('#printAttendance').show();
            document.getElementById('TDId').value = TrainingDurationId;
        }

   
        // $.ajax({           
        //     type: 'GET',
        //     url: '$trainingattandancelist?TrainingDurationId='+TrainingDurationId,
        //     // dataType: 'json',
        //     data: {
                                                
        //             },
        //     success: function(data) {

        //        // $('#list_training_paticipant_attandance').html(data);                    
                
        //     }
        //     });

    


            

// $('#lstPaticipantList').DataTable().empty();
    var table23 = $('#list_training_paticipant_attandance').DataTable({

        "createdRow": function(row, data, dataIndex) {
        // Set the sequential count in the first column
        $('td:eq(0)', row).html(dataIndex + 1);
      }
    ,

        select: true,
      lengthChange: false,
      processing: true,
      deferRender: true,
      //ordering: false,
      pageLength: 10,
      bSort: false,
	  searching:true,	
      responsive: true,
      destroy: true,
      paging: true,        
        ajax: { 
            url: '$trainingattandancelist?TrainingDurationId='+TrainingDurationId,
            type: 'GET',
            data: {
                
               // txtTrainingId: $model->TrainingId,   
                }
        },

     "columns":[

            {"data": "FullName","width": "5px"},	    
            {
            "data": "FullName",
            "render": function (data, type, row) {
                return row.UserNo + ' - ' + row.FullName;
                }
            },   
            {"data": "AttandId",
             
                 "render": function ( data, type, row, meta ) { 

                // // var temp = data.split(';');      
                // var AttanId = data.split("-")[0];  
                // var TrainingAttanId = data.split("-")[1];  

               if(row.AttandId == 0) {                   
                    return '<button type="button"  value="'+row.TrainingAttanId+';' + row.AttandId+'" class="btn btn-danger btn-sm Take_Attandance">Not Attend</button>';                    
               }else if (row.AttandId == 1) {    
                    return '<button type="button"  value="'+row.TrainingAttanId+';' + row.AttandId+'"  class="btn btn-success btn-sm Take_Attandance">Attend</button>';
               }
            }     
         },
         {"data": "Eval", 
                "render": function ( data, type, row, meta ) { 
                    var temp = data.split(',');  
                    var eval = temp[0];
                    var userId = temp[1];
                    var trainingId = temp[2];

                    if(eval == 1)
                    {
                        return 'Submitted';
                    }
                    else
                    {
                        return 'Not Submit';
                    }
                }   
            },

        ]

    });



});

//    ** attand or not attand*********************************************************************************************************************


$(document).off('click', '.Take_Attandance').on('click', '.Take_Attandance', function () {
        
         var temp = $(this).attr('value'); 
         var TrainingAttanId = temp.split(';')[0];
         var AttandId = temp.split(';')[1];

        //  alert(temp);

         
       
         $.ajax({           
                type : 'POST',            
                url :'$InsertPaticipantAttandance?TrainingAttanId='+TrainingAttanId+'&AttandId='+AttandId,            
                data: {
                    _csrf: yii.getCsrfToken(),
                    //txtUserId: UserId,      
                   // txtTrainingId: TrainingId,     
                    },
                    success: function (response)  {                     
                   
                    //  alert("Attandance successfully update");

                        var table5 = $('#list_training_paticipant_attandance').DataTable();
                            table5.ajax.reload(null, false); 
                },
                error  : function (e) {
                         //console.log(e);
                }
            });
        return false;      

    


    });


//    ********************************************************************************************************************************



 $(document).off('click', '.Insert_Paticipant').on('click', '.Insert_Paticipant', function () {
    
           /// var form = $(this);
                          
            var UserId = $(this).attr('value'); 

            $.ajax({           
                type : 'POST',            
                url :'$InsertPaticipant?txtTrainingId='+$TrainingId,            
                data: {
                    _csrf: yii.getCsrfToken(),
                    txtUserId: UserId,      
                   // txtTrainingId: TrainingId,     
                    },
                    success: function (response)  {                     
                   
                     // alert("Data insert successfully");

                        var table5 = $('#lstPaticipantList').DataTable();
                            table5.ajax.reload(null, false); 

                        var table6 = $('#lstStaffList').DataTable();
                            table6.ajax.reload(null, false); 

              
                    
                },
                error  : function (e) {
                         console.log(e);
                }
            });
        return false;      

    

    });

//    ********************************************************************************************************************************


    $(document).off('click', '.Remove_Paticipant').on('click', '.Remove_Paticipant', function () {
             
                    var result = confirm("Are you sure want to delete this Paticipant?");

                    if (result) {
                        var form = $(this);
                        var ParticipantId2 = $(this).attr('value'); 
                        var temp = ParticipantId2.split(';');
                        var ParticipantId =temp[0];
                        var TrainingId =temp[1];
                        var UserId =temp[2];

                        

                        $.ajax({           
                            type : 'POST',            
                            url :'$RemovePaticipant',
                        
                            data: {
                                _csrf: yii.getCsrfToken(),
                                ParticipantId: ParticipantId,               
                                TrainingId: TrainingId,
                                UserId: UserId,

                                },
                                success: function (response)  {                     
                                
                                   // alert("Data remove successfully");

                                    var table7 = $('#lstPaticipantList').DataTable();
                                        table7.ajax.reload(null, false); 

                                    var table8 = $('#lstStaffList').DataTable();
                                        table8.ajax.reload(null, false); 


                                // $('#modal-lg').modal('show');
                                // $('#modalContent-lg').html(response).modal();							
                                // document.getElementById('modalHeader-lg').innerHTML = '<h4>Remove Role vs Permission</h4>';
                            },
                            error  : function (e) {
                                    // console.log(e);
                            }
                        });
                    return false;      
            } 
                

    });







 //    ********************************************************************************************************************************


});



// *********************************************************************************************************************************


JS;
$this->registerJs($script);
?>





<!-- https://bobbyhadz.com/blog/jquery-datatable-is-not-a-function -->
<!-- ✅ Load CSS file for DataTables  -->
<!-- <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css"
      integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    /> -->

<!-- ✅ load jQuery ✅ -->
<!-- <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script> -->

<!-- ✅ load DataTables ✅ -->
<!-- <script
      src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"
      integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script> -->