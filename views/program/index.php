<?php

use app\models\tblprogram;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Programs');
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    /* .dataTables tbody>tr>td {
        white-space: nowrap;
    } */


    table#cmstable1 tbody td div {
        /* width: 60px;
        height: 22px; */
        /* overflow: hidden; */
        word-wrap: break-word;
    }
</style>
<div class="tblprogram-index">


    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header align-items-center d-flex text-white bg-primary">
                    <h4 class="card-title mb-0 flex-grow-1  ">
                        <?= $this->title ?>
                    </h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <button id="New" class="showModal_New btn btn-success btn-sm" type="button"> New <i
                                    class="icon-file"></i></button>
                            <button id="Edit" class="showModal_Update btn btn-success btn-sm" type="button">Edit <i
                                    class="icon-file"></i></button>
                            <button id="View" class="showModal_View btn btn-success btn-sm" type="button"> View <i
                                    class="icon-file"></i></button>
                        </div>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-xl-6">
                            <div class="search-box">
                                <input type="text" class="form-control search" id="txtSearch"
                                    placeholder="Search for customer, email, phone, status or something...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-xl-6">
                            <div class="row g-3">
                                <div class="col-sm-4">
                                    <div>
                                        <?= Html::dropDownList('StatusId', null, Yii::$app->common->getStatus(), [
                                            'prompt' => '- Status -',
                                            'class' => 'form-select mb-3',
                                            'id' => 'txtStatusId'
                                        ]) ?>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-sm-4">
                                    <?= Html::dropDownList('ProgramTypeId', null, Yii::$app->common->getProgramType(), [
                                        'prompt' => '- Program Type -',
                                        'class' => 'form-select mb-3',
                                        'id' => 'txtProgramTypeId'
                                    ]) ?>
                                </div>
                                <!--end col-->

                                <div class="col-sm-4">
                                    <div>
                                        <button type="button" class="btn btn-primary w-100" id="btn_search"> <i
                                                class="ri-equalizer-fill me-2 align-bottom"></i>Filters</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
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
                                <table id="cmstable1" class="table table-bordered table-hover" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Programd</th>
                                            <th>Program Code</th>
                                            <th>Program Name</th>
                                            <th>Program Type</th>
                                            <th>Status</th>
                                            <th>Status</th>
                                            <!-- <th>Status</th> -->

                                        </tr>
                                    </thead>
                                </table>
                            </div>
                    </div> <!-- Datatable End -->
                </div>
            </div>
        </div>

        <?php
        /**********************************************************************************/
        $url = Url::toRoute(['/program/programlist']);
        $create = Url::toRoute(['/program/create']);
        $update = Url::toRoute(['/program/update']);
        $view = Url::toRoute(['/program/view']);

        $script = <<<JS

/**********************************************************************************/
getButtonDisable();




 $(document).on('keypress',function(e) {
    if(e.which == 13) {
		$("#btn_search").trigger('click');
    }
});

//var txtParam = $("#txtSearch").val()+';'+$("#txtStatusId").val()+';'+$("#txtProgramTypeId").val();
     

$('#btn_search').click(function () {

	getButtonDisable();
	  $('#select_id').html('');
      $('#select_data').html('');
      $('#cmstable1').dataTable().empty();
			    
		var table = $('#cmstable1').DataTable({
          
			lengthChange:false,			processing: true,
			deferRender:true,			searching:false,
			responsive:true,				
			destroy:true,			pageLength: 12,
			paging:true,			scrollY: true,  
            autoWidth: true, 
			dom: 'Bfrtip',                      
			ajax: { 
				url: '$url',
				type: 'GET',
				data: {
                    txtSearch:$("#txtSearch").val(),
                    txtStatusId:$("#txtStatusId").val(),
                    txtProgramTypeId:$("#txtProgramTypeId").val(),
                            
					}
			},
		
			"columns": [
				{"data":"ProgramId", "visible": false},
				{"data":"ProgramCode"},	
				{"data":"ProgramName"},														
				{"data":"ProgramType"},
				{"data":"Status"},
                {"data":"", title: 'Action', wrap: true,"defaultContent":'<div class="btn-group showModal_View"> <button type="button" id="del-btn" value="0" class="btn btn-warning btn-sm" >View</button></div>'+" " +'<div class="btn-group showModal_Update"> <button type="button" id="del-btn" value="0" class="btn btn-warning btn-sm" >Edit</button></div>'},
      
      


                

                // {"data":"ProgramId", title: 'Action', wrap: true, "render": function (item) { 
                //     return '<div class="btn-group"> <button type="button" onclick="editMember(' + item.ProgramId + ')" value="0" class="btn btn-warning btn-sm" >View</button></div>' } },
		
			]
		});



	$('#cmstable1 tbody').on('click', 'tr', function() {
     // console.log(table.row(this).data());
			getButtonEnable();

			var table = $('#cmstable1').DataTable();
			console.log(table.row(this).data());

 
    
  
			if ($(this).hasClass('row_selected1')) {
				$(this).removeClass('row_selected1');
			} else {
				table.$('tr.row_selected1').removeClass('row_selected1');
				$(this).addClass('row_selected1');
			}
        
		               	var d = table.row(this).data();
			
			//var x = d['CategoryCode']+';'+d['CategoryCode']+';'+d['CategoryCode']+';'+d['CategoryCode'];
			var x = d['ProgramName'];
			var y = d['ProgramId'];
	
			$('#select_data').html(x);
			$('#select_id').val(y);
		
			});

  });


  /**********************************************************************************/

  function getButtonDisable() {
			$("#update").attr("disabled", true);
			$("#view").attr("disabled", true);
		};
    
    function getButtonEnable() {
			$("#update").attr("disabled", false);
			$("#view").attr("disabled", false);
		};
  /**********************************************************************************/

  //https://makitweb.com/add-edit-delete-button-in-yajra-datatables-laravel/


//   $(document).on('click', '.showModalButtonxx2', function () {
	  
//          var url = '/feetype/update/2';
//         $.ajax({
//             type: 'GET',
//             url: url,
//             success: function (output) {
// 				$('#modal').modal('show')
//                 $('#modalContent').html(output).modal('show');//now its working
// 				document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';		
//             },
//             error: function(output){
//             alert("fail");
//             }
//         });
//     });

/*************************************************************************************/

$(document).on('click', '.showModal_New', function () {
      var form = $(this);
      $.ajax({
	    	url: '$create',
            type   : 'GET',
			data: {
                ProgramId: $("#select_id").val(),
                 },
             success: function (response) 
            {     
				$("#modal-lg").modal("show");
                $("#modalContent-lg").html(response).modal();							
				document.getElementById('modalHeader-lg').innerHTML = '<h4>New Program</h4>';    
				
				console.log(response);
            },
            error  : function (e) {
				    console.log(e);
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
                ProgramId: $("#select_id").val(),
                 },
             success: function (response) 
            {     
				$('#modal-lg').modal('show');
                $('#modalContent-lg').html(response).modal();							
				document.getElementById('modalHeader-lg').innerHTML = '<h4>View Program</h4>';
               // document.getElementById('modalHeader-xl').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';	
				//console.log(response);
            },
            error  : function (e) {
				    console.log(e);
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
                ProgramId: $("#select_id").val(),
                 },
                 success: function (response) 
            {                     
                $('#modal-lg').modal('show');
                $('#modalContent-lg').html(response).modal();							
				document.getElementById('modalHeader-lg').innerHTML = '<h4>View Program</h4>';
            },
            error  : function (e) {
				   // console.log(e);
            }
        });
    return false;        
  });
    /**********************************************************************************/

    $(document).on('click', '.showModal_Subject', function () {
      var form = $(this);
      $.ajax({
	    	url: '/program/update',
            type   : 'GET',
			data: {
                 id: $("#select_id").val(),
                 },
             success: function (response) 
            {     
				$('#modal-lg').modal('show');
                $('#modalContent-lg').html(response).modal();							
				document.getElementById('modalHeader-lg').innerHTML = '<h4>Update Program</h4>';              
				//console.log(response);
            },
            error  : function (e) {
				    console.log(e);
            }
        });
    return false;        
  });
   
  
  /***************************************https://metamug.com/docs/examples/file-upload-ajax*******************************************/


JS;
        $this->registerJs($script);


        ?>