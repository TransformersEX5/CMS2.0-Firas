<?php


use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Application');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblprogram-index">

  <div class="card">    
        <div class="card-body">
             <div class="row g-2">
                        <div class="col-xl-6">
                            <div class="search-box">
                                <input type="text" class="form-control search" id="txtSearch"
                                    placeholder="Search for customer, email, phone, status or something...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-xl-6">
                            <div class="row g-2">
                                <div class="col-sm-4">
                                    <div>
                                        <?= Html::dropDownList('ProgramId', null, Yii::$app->common->getProgram(), [
                                            'prompt' => '-Select Program-',
                                            'class' => 'form-select mb-2',
                                            'id' => 'txtProgram'
                                        ]) ?>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-sm-4">
                                    <div>
                                    <?= Html::dropDownList('StatusId', null, Yii::$app->common->getStatus(), [
                                            'prompt' => '-Select status-',
                                            'class' => 'form-select mb-2',
                                            'id' => 'txtStatusId'
                                        ]) ?>
                                    </div>
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

                    


                    <div class="col-xl-12">
                            <div class="row g-2">
                                <div class="col-sm-8">
                                    <div>
                                    <div id="select_data"></div>  <input type="hidden" name="select_id" id="select_id" />
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-sm-4">
                                <div class="row g-2">
                                    <div>
                                    <div class="form-group">
                            <div class="text-right">
                                <button id="New" class="showModal_New btn btn-success btn-sm" type="button"> New <i
                                        class="icon-file"></i></button>
                                <button id="Update" class="showModal_Update btn btn-success btn-sm" type="button">
                                    Update <i class="icon-file"></i></button>
                                <button id="View" class="showModal_View btn btn-success btn-sm" type="button"> View <i
                                        class="icon-file"></i></button>

                            </div></div>
                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                    

                    


                <!-- Datatable Start -->
                <div class="row">
                    <di class='col-12 .col-sm-12'>
                    <div class="row g-2">
                        <div class="box-body">
                            <table id="cmstable1" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>TelNo</th>
                                        <th>DateRegister</th>
                                        <th>Status</th>                                      
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        </div>
                    </div> <!-- Datatable End -->               
                </div>
            </div>
        </div>
    </div>
</div>

<?php
/**********************************************************************************/
$url = Url::toRoute(['/application/applicationlist']);
$create = Url::toRoute(['/application/create']);
$update = Url::toRoute(['/application/update']);
$view = Url::toRoute(['/application/view']);

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
			dom: 'Bfrtip',                      
			ajax: { 
				url: '$url',
				type: 'GET',
				data: {
                    txtSearch:$("#txtSearch").val(),
                    txtStatusId:$("#txtStatusId").val(),
                  //  txtProgramTypeId:$("#txtProgramTypeId").val(),
                            
					}
			},
		
			"columns": [
				{"data":"ApplicationId", "visible": false},
				{"data":"StudName","width": '38%'},	
				{"data":"DateRegister","width": '10%'},
                {"data":"StudNRICPassportNo","width": '10%'},	            
                // {"data": "ApplicationId",
                //     "render": function ( data, type, row, meta ) { 
                //         return '<button data-id="'+data+'" class="btn btn-info btn-sm" onclick="editThis(event)">Edit</button>'+
                //          '<button data-id="'+data+'" class="btn btn-info btn-sm" onclick="viewThis(event)">View</button>'   
                //     },
                // },

                

             ],
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
			var x = d['StudName'];
			var y = d['ApplicationId'];
	
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

$(document).on('click', '.showModal_New', function () {
      var form = $(this);
      $.ajax({
	    	url: '$create',
            type   : 'GET',
			data: {
                DepartmentId: $("#select_id").val(),
                 },
             success: function (response) 
            {     
				$("#modal-lg").modal("show");
                $("#modalContent-lg").html(response).modal();							
				document.getElementById('modalHeader-lg').innerHTML = '<h4>Create Department</h4>';    
				
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
                DepartmentId: $("#select_id").val(),
                 },
             success: function (response) 
            {     
				$('#modal-lg').modal('show');
                $('#modalContent-lg').html(response).modal();							
				document.getElementById('modalHeader-lg').innerHTML = '<h4>View Department</h4>';
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
                DepartmentId: $("#select_id").val(),
                 },
                 success: function (response) 
            {                     
                $('#modal-lg').modal('show');
                $('#modalContent-lg').html(response).modal();							
				document.getElementById('modalHeader-lg').innerHTML = '<h4>Edit Department</h4>';
            },
            error  : function (e) {
				   // console.log(e);
            }
        });
    return false;        
  });
 
  /**********************************************************************************/

  

JS;
$this->registerJs($script);


?>