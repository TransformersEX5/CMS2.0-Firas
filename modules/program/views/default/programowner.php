<?php

use app\models\tblprogram;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Program VS Program Coordinator & Head of Program');
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

    .table-responsive,
    .dataTables_scrollBody {
        overflow: visible !important;
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
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-xl-6">
                            <div class="search-box">
                                <input type="text" class="form-control search" id="txtSearch" placeholder="Search for customer, email, phone, status or something...">
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
                                        <button type="button" class="btn btn-primary w-100" id="btn_search"> <i class="ri-equalizer-fill me-2 align-bottom"></i>Filters</button>
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
                                <table id="cmstable1" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Program Name</th>
                                            <th>Type</th>
                                            <th>PC</th>
                                            <th>HOP</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
        $url = Url::toRoute(['/program/default/programlist']);
        $view = Url::toRoute(['/program/default/programownerdetails']);

        $script = <<<JS

/**********************************************************************************/
getButtonDisable();




 $(document).on('keypress',function(e) {
    if(e.which == 13) {
		$("#btn_search").trigger('click');
    }
});
     

$('#btn_search').click(function () {

	getButtonDisable();
	  $('#select_id').html('');
      $('#select_data').html('');
      $('#cmstable1').dataTable().empty();
			    
		var table = $('#cmstable1').DataTable({
          
			lengthChange:false,			processing: true,
			deferRender:true,			searching:false,
			responsive:true,		    ordering:false,
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
				// {"data":"ProgramId", "visible": false},
				{"data":"ProgramCode", "width":"12.00%"},	
				{"data":"ProgramName", "width":"30.00%"},		
                {"data":"ProgramTypeName", "width":"12.00%"},													
				{"data":"PCName", "width":"20.00%"},
                {"data":"HOPName", "width":"20.00%"},
				{"data":"Status", "width":"0.01%"},
                {"data":"", title: 'Action', wrap: true,"defaultContent":
                    
                    // '<div class="btn-group showModal_View"> <button type="button" id="viewBtn" value="0" class="btn btn-warning btn-sm" >View</button></div>'+" " +
                    // '<div class="btn-group showModal_Update"> <button type="button" id="editBtn" value="0" class="btn btn-warning btn-sm" >Edit</button></div>'
                    
                    '<div class="dropdown">'+
                    '<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Action</a>'+
                    '<ul class="dropdown-menu">'+
                    '<li><a id="viewBtn" class="dropdown-item showModal_View" href="#">View</a></li>'+
                    '<li><a id="editBtn" class="dropdown-item showModal_Update" href="#">Edit</a></li>'+
                    '</ul>'+
                    '</div>'
                },

                
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

  /**********************************************************************************/

    $(document).ready(function() {
        var modal = document.getElementById('modal-lg');
        modal.addEventListener('hidden.bs.modal', function (e) {
            $('#cmstable1').DataTable().ajax.reload();
        });
    });


	$(document).on('click', '.showModal_View', function () {
      var form = $(this);
      var view = $("#viewBtn").html();
      $.ajax({
	    	url: '$view',
            type   : 'GET',
			data: {
                ProgramId: $("#select_id").val(),
                view: view,
                 },
             success: function (response) 
            {     
				$('#modal-lg').modal('show');
                $('#modalContent-lg').html(response).modal();							
				document.getElementById('modalHeader-lg').innerHTML = '<h4>Program VS Program Coordinator & Head of Program</h4>';
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
      var edit = $("#editBtn").html();
      $.ajax({
	    	url: '$view',
            type   : 'GET',
			data: {
                ProgramId: $("#select_id").val(),
                edit: edit,
                 },
                 success: function (response) 
            {                     
                $('#modal-lg').modal('show');
                $('#modalContent-lg').html(response).modal();							
				document.getElementById('modalHeader-lg').innerHTML = '<h4>Program VS Program Coordinator & Head of Program</h4>';
            },
            error  : function (e) {
				   // console.log(e);
            }
        });
    return false;        
  });   
  
  /***************************************https://metamug.com/docs/examples/file-upload-ajax*******************************************/


JS;
        $this->registerJs($script);


        ?>