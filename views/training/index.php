<?php

use app\models\tblprogram;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Training List');
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.table-responsive,
    .dataTables_scrollBody {
        overflow: visible !important;
    }</style>

<div class="tbldepartment-index">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex text-white bg-warning">
                    <h4 class="card-title mb-0 flex-grow-1">
                        <?= $this->title ?>
                    </h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <button id="New" class="showModal_New btn btn-success btn-sm" type="button"> New Training <i class="icon-file"></i></button>

                            <a class="btn btn-success btn-sm" href="<?= Url::toRoute(['/reportgallery/trainingreportsummary?id=1_rpt_training_summary.php']) ?>" target="_blank"> Report Summary</a>
                            <!-- <a href="<?= Url::toRoute(['/reportgallery/trainingreport?id=1_rpt_training_detail.php']) ?>"  target="_blank"> Report detail</a> -->
                            <!-- <button id="Edit" class="showModal_Update btn btn-success btn-sm" type="button">Edit <i
                                    class="icon-file"></i></button>
                            <button id="View" class="showModal_View btn btn-success btn-sm" type="button"> View <i
                                    class="icon-file"></i></button> -->
                                    <button class="showModal_Staff btn btn-success btn-sm" type="button">Staff Training Summary<i class="icon-file"></i></button>
                                    <button class="showModal_Year btn btn-success btn-sm" type="button">Staff Total Training Hours<i class="icon-file"></i></button>
                                    <button class="showModal_TrainingSummary btn btn-success btn-sm" type="button">Training Summary By Year<i class="icon-file"></i></button>

                        </div>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">

                    <!-- Content here Start -->

                    <div class="row g-3">
                        <div class="col-xl-6">
                            <div class="search-box">
                                <input type="text" class="form-control search" id="txtSearch" placeholder="Search for something...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-xl-6">
                            <div class="row g-3">
                                <div class="col-sm-4">
                                    <div>
                                        <?= Html::dropDownList('TrainingCategoryId', null, Yii::$app->training->getTrainingCategory(), [
                                            'prompt' => '- Training Category -',
                                            'class' => 'form-select mb-3',
                                            'id' => 'txtTrainingCategoryId'
                                        ]) ?>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-sm-4">
                                    <div>

                                        <?= Html::dropDownList('TrainingStatusId', null, Yii::$app->training->getTrainingRequestStatus(), [
                                            'prompt' => '- Training Status -',
                                            'class' => 'form-select mb-3',
                                            'id' => 'txtStatusId'
                                        ]) ?>

                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-sm-4">
                                    <div>
                                        <button type="button" class="btn btn-primary w-100" id="btn_search"> <i class="ri-equalizer-fill me-2 align-bottom"></i>Filters</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4>
                                    <div id="select_data"></div>
                                </h4>
                                <input type="hidden" name="select_id" id="select_id" />
                            </div>
                        </div>
                    </div>


                    <!-- Datatable Start -->
                    <div class="row">
                        <di class='col-12 .col-sm-12'>
                            <div class="box-body">
                                <table id="cmstable1" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>TrainingId</th>
                                            <th>Title</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <th>Tot Days</th>
                                            <th>Tot Hours</th>
                                            <th>Tot Join</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Request by</th>

                                            <!-- <th>.:.</th> -->
                                            <th>.:.</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                    </div> <!-- Datatable End -->
                </div>
            </div>
        </div>
    </div>
</div>



<?php
/**********************************************************************************/
$url = Url::toRoute(['/training/traininglist']);

$create = Url::toRoute(['/training/create']);
$update = Url::toRoute(['/training/update']);
$daytime = Url::toRoute(['/training/daytime']);

$Trainingattandance = Url::toRoute(['/training/trainingattandance']);

$view = Url::toRoute(['/training/view']);

$rpt_training_detail = Url::toRoute(['/reportgallery/trainingreportdetail']);

$year = Url::toRoute(['/training/year']);
$trainingsummary = Url::toRoute(['/training/trainingsummary']);
$staff = Url::toRoute(['/training/staff']);
$generateAttendance = Url::toRoute(['/training/generateattendance']);
$evaluation = Url::toRoute(['/training/sendemail']);
$generate = Url::toRoute(['/training/generatereport']);

$_csrf = Yii::$app->request->getCsrfToken();




$script = <<<JS

/**********************************************************************************/

$(document).ready(function(){

    $(document).on('click', '.generateAttendance', function() {
        var trainingId = btoa($(this).attr('value'));

        $.ajax({
            url: '$generateAttendance?TrainingId='+trainingId,
            type: 'POST',
            dataType: "json",
            data: 
            {  
                trainingId : trainingId,
                _csrf : '$_csrf',
            },
            success: function(response) 
            {
                window.open('trainingdetailreport?trainingId='+trainingId, '_blank');
            },
            error: function(xhr, status, error) 
            {
                alert('Please make sure the participants have answered the evaluation form!');
            }
        });
    });

    $(document).on('click', '.sendEmail', function() {
        var trainingId = $(this).attr('value');

        desc = 'Do you want to send the evaluation form to the participants?';
        desc2 = 'You have successfully send the evaluation form to the participants!';

        Swal.fire({title:desc,icon:"warning",showCancelButton:!0,confirmButtonColor:"#34c38f",cancelButtonColor:"#f46a6a",confirmButtonText:"Confirm"})
            .then(function(t) 
            {
                if (t.value) {
                    $.ajax({
                        url: '$evaluation',
                        type: 'POST',
                        dataType: "json",
                        data: 
                        {  
                            trainingId : trainingId,
                            _csrf : '$_csrf',
                        },
                        success: function(response) 
                        {
                            t.value&&Swal.fire({title:desc2,icon:"success",confirmButtonColor:"#34c38f",confirmButtonText:"Confirm"})
                        },
                        error: function(xhr, status, error) 
                        {
                            alert('Please contact the programmer for more details!');
                        }
                    });
                } 
            });
    });
});

$(document).on('click', '.generateReport', function() {
        var trainingId = btoa($(this).attr('value'));

        $.ajax({
            url: '$generate?TrainingId='+trainingId,
            type: 'POST',
            dataType: "json",
            data: 
            {  
                trainingId : trainingId,
                _csrf : '$_csrf',
            },
            success: function(response) 
            {
                window.open('report?trainingId='+trainingId, '_blank');
            },
            error: function(xhr, status, error) 
            {
                alert('Please make sure the participants have answered the evaluation form!');
            }
        });

        
    });

// $(document).ready(function(){
//    $("#myBtn").click(function(){
//       	// Passing option
//         $("#myToast").toast({
//             delay: 3000
//         }); 
      	
//       	// Show toast
//       	$("#myToast").toast("show");
//     }); 

//  });


// $(document).ready(function(){
//    $("#myBtn").click(function(){
//  $.toast({
//     heading: 'Information',
//     text: 'Loaders are enabled by default. Use `loader`, `loaderBg` to change the default behavior',
//     icon: 'info',
//     loader: true,        // Change it to false to disable loader
//     loaderBg: '#9EC600'  // To change the background
// })

//     }); 

//  });


 $(document).on('keypress',function(e) {
    if(e.which == 13) {
		$("#btn_search").trigger('click');
    }
});

//var txtParam = $("#txtSearch").val()+';'+$("#txtStatusId").val()+';'+$("#txtProgramTypeId").val();
     

$('#btn_search').click(function () {


	  $('#select_id').html('');
      $('#select_data').html('');
      $('#cmstable1').dataTable().empty();
			    
		var table = $('#cmstable1').DataTable({
			lengthChange:false,			processing: true,
			deferRender:true,			searching:false,
			responsive:true,				
			destroy:true,			pageLength: 12,
			paging:true,			scrollY: true,   
			// dom: 'Bfrtip',                      
			ajax: { 
				url: '$url',
				type: 'GET',
                
				data: {
                    txtSearch:$("#txtSearch").val(),
                    txtStatusId:$("#txtStatusId").val(),
                    txtTrainingCategoryId:$("#txtTrainingCategoryId").val(),
                            
					}
			},
		
			"columns": [
				{"data":"TrainingId", "visible": false},
				{"data":"TrainingTitle","width": '22%'},	
                {"data":"TrainingStart","width": '6%',className: "text-center" },
                {"data":"TrainingEnd","width": '6%',className: "text-center" },
            	{"data":"TotDays","width": '6%',className: "text-center" },
                {"data":"TotHours","width": '6%',className: "text-center" },                
                {"data":"TotStaff","width": '6%',className: "text-center" },   
                {"data":"TrainingCategory","width": '12%'},
                {"data":"TrainingStatus","width": '10%'},
                {"data":"FullName","width": '13%'},
				
            //     {"data": "TrainingId",
            //     "render": function ( data, type, row, meta ) { 
            //         return '<button type="button" id="del-btn" value="0" class="btn btn-warning btn-sm showModal_View">View</button>'+
            //                                                         " " +'<button type="button" id="del-btn" value="0" class="btn btn-warning btn-sm showModal_Update">Edit</button>'+
            //                                                         " " +'<button type="button" id="del-btn" value="0" class="btn btn-danger btn-sm showModal_Attandance">Attendance</button>'+
            //                                                         " " +'<button type="button" id="del-btn" value="0" class="btn btn-danger btn-sm showModal_DayTime">Day/time</button>'+
            //                                                         " " +'<a class="btn btn-danger btn-sm" href="$rpt_training_detail?id='+data+'" target="_blank">Report detail</a>'+
            //                                                         " " +'<a class="btn btn-danger btn-sm sendEmail" value='+data+'>Evaluation</a>';

            //         }
            // },

            {"data": "TrainingId",
                "render": function ( data, type, row, meta ) { 
                    return '<div class="dropdown">'+
                    '<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Action</a>'+
                    '<ul class="dropdown-menu">'+
                    '<li><a class="dropdown-item showModal_Update " href="#">Edit</a></li>'+
                    '<li><a class="dropdown-item showModal_Attandance " href="#">Attendance</a></li>'+
                    '<li><a class="dropdown-item showModal_DayTime" href="#">Day/time</a></li>'+
                    '<li><a class="dropdown-item " href="$rpt_training_detail?id='+data+'" target="_blank">Report Detail - PDF</a></li>'+
                    '<li><a class="dropdown-item btn btn-danger generateAttendance" value='+data+'>Report Detail - Excel</a></li>'+
		            '<li><a class="dropdown-item btn btn-danger sendEmail" value='+data+'>Evaluation</a></li>'+
                    '<li><a class="dropdown-item btn btn-danger generateReport" value='+data+'>Generate Report</a></li>'+
                    '</ul>'+
                    '</div>';
                    }
            },
		
			]
		});
			
						
	$('#cmstable1 tbody').on('click', 'tr', function() {
     // console.log(table.row(this).data());
			

			var table0 = $('#cmstable1').DataTable();
			//console.log(table.row(this).data());
  
			if ($(this).hasClass('row_selected1')) {
				$(this).removeClass('row_selected1');
			} else {
				table0.$('tr.row_selected1').removeClass('row_selected1');
				$(this).addClass('row_selected1');
			}
        
		    var d = table0.row(this).data();
			
			//var x = d['CategoryCode']+';'+d['CategoryCode']+';'+d['CategoryCode']+';'+d['CategoryCode'];

			var x = d['TrainingTitle'];
			var y = d['TrainingId'];
	
			$('#select_data').html(x);
			$('#select_id').val(y);
		
			});

  });


  /**********************************************************************************/



  $(document).off('click', '.showModal_ReportTrainingDetail').on('click', '.showModal_ReportTrainingDetail', function () {
    
    var TrainingId = $(this).attr('value'); 
                   
    var rptname = 'TrainingId';
    
        $.ajax({
            url: '$rpt_training_detail', // Adjust the URL as needed
            method: 'GET',
            //responseType: 'arraybuffer', // To handle binary response
            

            data: {
                    param:rptname,
                    
                    
					},


            success: function(response) {
           
            },
            error: function() {
                console.log('Error generating PDF.');
            }
        });
    });

  /**********************************************************************************/

  $(document).on('click', '.showModal_Year', function () {
      var form = $(this);
      $.ajax({
	    	url: '$year',
            type   : 'GET',
			data: {
              // DepartmentId: $("#select_id").val(),
                 },
             success: function (response) 
            {    // console.log(response);
              //  toastr.success("",response.message); 
      
             // console.log(response.message);

          
        
				$("#modal-xs").modal("show");
                $("#modalContent-xs").html(response).modal();							
				document.getElementById('modalHeader-xs').innerHTML = '<h4>Staff Training Total Hours</h4>';    
        
				//console.log(response);
       

            },
            error  : function (e) {
				
               // console.log(e);
            }
        });
    return false;        
  });

    /**********************************************************************************/

    $(document).on('click', '.showModal_TrainingSummary', function () {
      var form = $(this);
      $.ajax({
	    	url: '$trainingsummary',
            type   : 'GET',
			data: {
                 },
             success: function (response) 
            {    
				$("#modal-xs").modal("show");
                $("#modalContent-xs").html(response).modal();							
				document.getElementById('modalHeader-xs').innerHTML = '<h4>Training Summary By Year</h4>';    
            },
            error  : function (e) {
            }
        });
    return false;        
  });

    /**********************************************************************************/

    $(document).on('click', '.showModal_Staff', function () {
      var form = $(this);
      $.ajax({
	    	url: '$staff',
            type   : 'GET',
			data: {
              // DepartmentId: $("#select_id").val(),
                 },
             success: function (response) 
            {    // console.log(response);
              //  toastr.success("",response.message); 
      
             // console.log(response.message);

          
        
				$("#modal-xs").modal("show");
                $("#modalContent-xs").html(response).modal();							
				document.getElementById('modalHeader-xs').innerHTML = '<h4>Staff Training Summary</h4>';    
        
				//console.log(response);
       

            },
            error  : function (e) {
				
               // console.log(e);
            }
        });
    return false;        
  });

  /**********************************************************************************/

$(document).on('click', '.showModal_New', function () {
      var form = $(this);
      $.ajax({
	    	url: '$create',
            type   : 'GET',
			data: {
              // DepartmentId: $("#select_id").val(),
                 },
             success: function (response) 
            {    // console.log(response);
              //  toastr.success("",response.message); 
      
             // console.log(response.message);

          
        
				$("#modal-xl").modal("show");
                $("#modalContent-xl").html(response).modal();							
				document.getElementById('modalHeader-xl').innerHTML = '<h4>New Training Request</h4>';    
        
				//console.log(response);
       

            },
            error  : function (e) {
				
               // console.log(e);
            }
        });
    return false;        
  });
  /**********************************************************************************/
	$(document).on('click', '.showModal_View', function () {
      var form = $(this);
      $.ajax({
	    	url: '$view',
            type   : 'GET',
			data: {
                TrainingId: $("#select_id").val(),
                 },
             success: function (response) 
            {     
				$('#modal-xl').modal('show');
                $('#modalContent-xl').html(response).modal();							
				document.getElementById('modalHeader-xl').innerHTML = '<h4>View Training Provider</h4>';
               // document.getElementById('modalHeader-xl').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';	
				//console.log(response);
            },
            error  : function (e) {
				   // console.log(e);
            }
        });
    return false;        
  });


  /**********************************************************************************/


	$(document).on('click', '.showModal_Update', function () {
	
      var form = $(this);
      $.ajax({
	    	url: '$update',
            type   : 'GET',
			data: {
                TrainingId: $("#select_id").val(),
                 },
                 success: function (response) 
            {                     
                $('#modal-xl').modal('show');
                $('#modalContent-xl').html(response).modal();							
				document.getElementById('modalHeader-xl').innerHTML = '<h4>Edit Training Provider</h4>';
            },
            error  : function (e) {
				   // console.log(e);
            }
        });
    return false;        
  });

  
  /**********************************************************************************/

$(document).on('click', '.showModal_DayTime', function () {
	// $(document).on('click', '.showModal_DayTime', function () {
        // /$('#modalContent').empty();
    // var form = $(this);
    // $.ajax({
    //       url: '$daytime?TrainingId='+$("#select_id").val(),
    //       type   : 'GET',
    //       data: {
    //           //TrainingId: $("#select_id").val(),
    //            },
    //            success: function (response) 
    //       {                     
            //   $('#modalContent-xl').html(response).modal();
              $('#modalContent-xl').load('$daytime?TrainingId='+$("#select_id").val());														
              document.getElementById('modalHeader-xl').innerHTML = '<h4>Training Schedule</h4>';
              $('#modal-xl').modal('show');

              var table8 = $('#cmstable1').DataTable();
                  table8.ajax.reload(null, false); 


    //       },
    //       error  : function (e) {
    //              // console.log(e);
    //       }
    //   });
      
  //return false;        
});

/**********************************************************************************/
  
   $(document).on('click', '.showModal_Attandance', function () {
//   $(document).on('click', '.showModal_Attandance', function () {
    // /$('#modalContent').empty();
    // var form = $(this);
    // $.ajax({
    //       url: '$Trainingattandance?TrainingId='+$("#select_id").val(),
    //       type   : 'GET',
    //       data: {
    //          // TrainingId: $("#select_id").val(),
    //            },
    //            success: function (response) 
    //       {          
                // console.log($.fn.jquery);        
                // Clear the modal content before loading new content
                // $('#modalContent-xl').html('');

                // Set the response content to the modal body
                // $('#modalContent-xl').html(response);

                // Show the modal
                $('#modalContent-xl').load('$Trainingattandance?TrainingId='+$("#select_id").val());														

                // Set the modal header
                document.getElementById('modalHeader-xl').innerHTML = '<h4>Attendance</h4>';
                $('#modal-xl').modal('show');

    //       },
    //       error  : function (e) {
    //                   console.log('Error fetching data: ', error);
    //       }
    //   });

     
  //return false;        
});
 
  /**********************************************************************************/
//   $('#modal-xl').on("hidden.bs.modal", function(){
//     $("#modalContent-xl").html("");
// });
  

JS;
$this->registerJs($script);


?>