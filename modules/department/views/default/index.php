<?php

use app\models\tblprogram;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap5\Modal;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Departments');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="tbldepartment-index">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex text-white bg-primary ">
                    <h4 class="card-title mb-0 flex-grow-1">
                        <?= $this->title ?>
                    </h4>
<?php echo $_SERVER['REQUEST_URI']; ?>
                    <div class="flex-shrink-0">

                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <button id="New" class="showModal_New btn btn-success btn-sm" type="button"> New <i class="icon-file"></i></button>
                            <button id="Edit" class="showModal_Update btn btn-success btn-sm" type="button">Edit <i class="icon-file"></i></button>
                            <button id="View" class="showModal_View btn btn-success btn-sm" type="button"> View <i class="icon-file"></i></button>
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
                                        <?= Html::dropDownList('StatusId', null, Yii::$app->common->getStatus(), [
                                            'prompt' => '- Status -',
                                            'class' => 'form-select mb-3',
                                            'id' => 'txtStatusId'
                                        ]) ?>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-sm-4">
                                    <div>
                                        <?= Html::dropDownList('DeptCatId', null, Yii::$app->common->getDepartmentcategory(), [
                                            'prompt' => '- Category -',
                                            'class' => 'form-select mb-3',
                                            'id' => 'txtDeptCatId'
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
                                            <th>DepartmentId</th>
                                            <th>Department</th>
                                            <th>Category</th>
                                            <th>Status</th>
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


<div class="m-4">
    <!-- <button type="button" class="btn btn-primary" id="myBtn">Show Toast</button> -->

    <div class="toast" id="myToast">
        <div class="toast-header">
            <strong class="me-auto"><i class="bi-gift-fill"></i> We miss you!</strong>
            <small>10 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
        </div>
        <div class="toast-body">
            It's been a long time since you visited us. We've something special for you. <a href="#">Click here!</a>
        </div>
    </div>
</div>

<?php
/**********************************************************************************/
$url = Url::toRoute(['/department/default/departmentlist']);
$create = Url::toRoute(['/department/default/create']);
$update = Url::toRoute(['/department/default/update']);
$view = Url::toRoute(['/department/default/view']);

$script = <<<JS


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
                    txtDeptCatId:$("#txtDeptCatId").val(),
                            
					}
			},
		
			"columns": [
				{"data":"DepartmentId", "visible": false},
				{"data":"DepartmentDesc","width": '38%'},	
                {"data":"DeptCatDesc","width": '38%'},	                
				{"data":"Status","width": '10%'},	
                {"data":"", title: 'Action', wrap: true,"defaultContent":'<div class="btn-group showModal_View"> <button type="button" id="del-btn" value="0" class="btn btn-warning btn-sm" >View</button></div>'+" " +'<div class="btn-group showModal_Update"> <button type="button" id="del-btn" value="0" class="btn btn-warning btn-sm" >Edit</button></div>'},
      													
			
		
			]
		});
			
						
	$('#cmstable1 tbody').on('click', 'tr', function() {
     // console.log(table.row(this).data());
			getButtonEnable();

			var table = $('#cmstable1').DataTable();
			//console.log(table.row(this).data());
  
			if ($(this).hasClass('row_selected1')) {
				$(this).removeClass('row_selected1');
			} else {
				table.$('tr.row_selected1').removeClass('row_selected1');
				$(this).addClass('row_selected1');
			}
        
		               	var d = table.row(this).data();
			
			//var x = d['CategoryCode']+';'+d['CategoryCode']+';'+d['CategoryCode']+';'+d['CategoryCode'];
			var x = d['DepartmentDesc'];
			var y = d['DepartmentId'];
	
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
              // DepartmentId: $("#select_id").val(),
                 },
             success: function (response) 
            {    // console.log(response);
              //  toastr.success("",response.message); 
      
             // console.log(response.message);

          
        
				$("#modal-lg").modal("show");
                $("#modalContent-lg").html(response).modal();							
				document.getElementById('modalHeader-lg').innerHTML = '<h4>Create Department</h4>';    
        
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
  $(document).ready(function() {
        var modal = document.getElementById('modal-lg');
        modal.addEventListener('hidden.bs.modal', function (e) {
            $('#cmstable1').DataTable().ajax.reload();
        });
    });

  

JS;
$this->registerJs($script);


?>