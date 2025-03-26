<?php

use app\models\tblprogram;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Programs Fees');
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
<?= Html::csrfMetaTags() ?>
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
                            <button id="New" class="showModal_New btn btn-success btn-sm" type="button"> New <i class="icon-file"></i></button>
                            <button id="Edit" class="showModal_Update btn btn-success btn-sm" type="button">Edit <i class="icon-file"></i></button>
                            <button id="View" class="showModal_View btn btn-success btn-sm" type="button"> View <i class="icon-file"></i></button>
                        </div>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-8">col-md-8
                            <div class="row g-1">
                                <div class="col-sm-3">

                                    <div class="search-box">
                                        <input type="text" class="form-control search" id="txtSearch" placeholder="Search for customer, email, phone, status or something...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>


                                </div>

                                <div class="col-sm-2">
                                    <div>
                                        <?= Html::dropDownList('ResidencyId', null, Yii::$app->common->getResidency(), [
                                            'prompt' => '- Fee Structure -',
                                            'class' => 'form-select mb-3',
                                            'id' => 'txtResidency'
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div>
                                        <?= Html::dropDownList('FeeStructure', null, Yii::$app->common->getFeeStructure(), [
                                            'prompt' => '- Fee Structure -',
                                            'class' => 'form-select mb-3',
                                            'id' => 'txtFeeStructure'
                                        ]) ?>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <?= Html::dropDownList('ProgramTypeId', null, Yii::$app->common->getProgramType(), [
                                        'prompt' => '- Program Type -',
                                        'class' => 'form-select mb-3',
                                        'id' => 'txtProgramTypeId'
                                    ]) ?>
                                </div>

                                <div class="col-sm-2">
                                    <div>
                                        <button type="button" class="btn btn-primary w-100" id="btn_search"> <i class="ri-equalizer-fill me-2 align-bottom"></i>Filters</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-8">
                                <h4>
                                    <div id="select_data"></div>
                                </h4>
                                <input type="hidden" name="select_id" id="select_id" />
                            </div>

                        </div>




                        <div class="col-md-8">
                            <div class="row">
                                <div class='col-10 col-sm-12'>
                                    <div class="box-body">
                                        <table id="cmstable1" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Programd</th>
                                                    <th>ProgramCode</th>
                                                    <th>Program leval</th>
                                                    <th>Fee Category</th>
                                                    <th>Residency</th>
                                                    <th>Duration</th>
                                                    <th>Title</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>


                        </div>



                        <div class="col-md-4">.col-md-4

                            <div class="col-12">

                                <div class="row">
                                    <div class="col-md-3"> <input type="text" class="form-control" id="txtSemNo" placeholder="sem no"></div>
                                    <div class="col-md-3"> <input type="text" class="form-control" id="txtFeeAmount" placeholder="fee amount"></div>
                                    <div class="col-md-3">
                                        <?= Html::dropDownList('FeeTypeId', null, Yii::$app->common->getFeeTypeForSetupList(), [
                                            'prompt' => '- 	Fee Type -',
                                            'class' => 'form-select mb-3',
                                            'id' => 'txtFeeTypeId'
                                        ]);?>

                                    </div>
                                    <div class="col-sm-2">
                                        <div>
                                            <button type="button" class="btn btn-primary w-60" id="btn_FeeSetup"> <i class="ri-equalizer-fill me-2 align-bottom"></i>Save</button>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div id="listProgramFeeDetail"></div>
                            </p>


                        </div>

                    </div>


                </div>

                <div class="card-body">








                    <!-- ==================================================================================================== -->





                </div>
            </div>





            <!-- ==================================================================================================== -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">



                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">Step 1 : Create Fee Group</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block">Step 2 : Set The Fee</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block">Step 3 : Fee Group vs Program</span>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#settings1" role="tab">
                                                <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                                <span class="d-none d-sm-block">Settings</span>
                                            </a>
                                        </li> -->
                            </ul>
                            <div class="col-xl-8">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active p-3" id="home1" role="tabpanel">
                                        <p class="mb-0">
                                        <div class="row">
                                            <div class='col-10 col-sm-12'>
                                                <div class="box-body">
                                                    <table id="cmstable1" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                                        <thead>
                                                            <tr>
                                                                <th>Programd</th>
                                                                <th>ProgramCode</th>
                                                                <th>Program leval</th>
                                                                <th>Fee Category</th>
                                                                <th>Residency</th>
                                                                <th>Duration</th>
                                                                <th>Title</th>
                                                                <th>Status</th>
                                                                <!-- <th>Status</th> -->
                                                                <!-- <th>Status</th> -->

                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        </p>
                                    </div>
                                </div>





                                <div class="tab-pane p-3" id="profile1" role="tabpanel">
                                    <p class="mb-0">
                                    <div class="col-4">

                                        <div class="row">
                                            <div class="col-3"> <input type="text" class="form-control" id="txtSemNo" placeholder="sem no"></div>
                                            <div class="col-3"> <input type="text" class="form-control" id="txtFeeAmount" placeholder="fee amount"></div>
                                            <div class="col-4">

                                                <?= Html::dropDownList('FeeTypeId', null, Yii::$app->common->getFeeTypeForSetupList(), [
                                                    'prompt' => '- 	Fee Type -',
                                                    'class' => 'form-select mb-3',
                                                    'id' => 'txtFeeTypeId'
                                                ]);


                                                ?>

                                            </div>
                                            <div class="col-sm-2">
                                                <div>
                                                    <button type="button" class="btn btn-primary w-60" id="btn_FeeSetup"> <i class="ri-equalizer-fill me-2 align-bottom"></i>Save</button>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div id="listProgramFeeDetail"></div>
                                    </p>
                                </div>
                                <div class="tab-pane p-3" id="messages1" role="tabpanel">
                                    <p class="mb-0">
                                        Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.
                                    </p>
                                </div>
                                <div class="tab-pane p-3" id="settings1" role="tabpanel">
                                    <p class="mb-0">
                                        Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- =============================================================================================================== -->

                <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h4>
                                    <div id="select_data"></div>
                                </h4>
                                <input type="hidden" name="select_id" id="select_id" />
                            </div>
                        </div>
                    </div> -->



                <!-- <div class="row">
                            <div class="col-8">
                                <h4>
                                    <div id="select_data"></div>
                                </h4>
                                <input type="hidden" name="select_id" id="select_id" />
                            </div>
                            <div class="col-4">

                                <div class="row">
                                    <div class="col-3"> <input type="text" class="form-control" id="txtSemNo" placeholder="sem no"></div>
                                    <div class="col-3"> <input type="text" class="form-control" id="txtFeeAmount" placeholder="fee amount"></div>
                                    <div class="col-4">

                                        <?= Html::dropDownList('FeeTypeId', null, Yii::$app->common->getFeeTypeForSetupList(), [
                                            'prompt' => '- 	Fee Type -',
                                            'class' => 'form-select mb-3',
                                            'id' => 'txtFeeTypeId'
                                        ]);


                                        ?>

                                    </div>
                                    <div class="col-sm-2">
                                        <div>
                                            <button type="button" class="btn btn-primary w-60" id="btn_FeeSetup"> <i class="ri-equalizer-fill me-2 align-bottom"></i>Save</button>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div> -->


                <!-- Datatable Start -->
                <!-- <div class="row">
                            <div class='col-8 col-sm-8'>
                                <div class="box-body">
                                    <table id="cmstable1" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Programd</th>

                                                <th>Program leval</th>
                                                <th>Fee Category</th>
                                                <th>Residency</th>
                                                <th>Duration</th>
                                                <th>Title</th>
                                                <th>Status</th>
                                                <th>Status</th>
                                                

                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>



                            <div class='col-4 col-sm-4'>



                                <div class="box-body">
                                    <div id="listProgramFeeDetail"></div>
                                </div>
                            </div>

                        </div>  -->
                <!-- Datatable End -->

            </div>

        </div>
    </div>

</div>




<?php
/**********************************************************************************/
$url = Url::toRoute(['/programfeecategory/programfeecategorylist']);
$urlfee = Url::toRoute(['/programfeecategory/programfeecategorydetaillist']);
$create = Url::toRoute(['/programfeecategory/create']);
$update = Url::toRoute(['/programfeecategory/update']);
$view = Url::toRoute(['/programfeecategory/view']);

$urlfee_save = Url::toRoute(['/programfeecategorydetail/create']);
$urlfee_remove = Url::toRoute(['/programfeecategorydetail/delete']);




$script = <<<JS

/**********************************************************************************/



 $(document).on('keypress',function(e) {
    if(e.which == 13) {
		$("#btn_search").trigger('click');
    }
});

//var txtParam = $("#txtSearch").val()+';'+$("#txtStatusId").val()+';'+$("#txtProgramTypeId").val();


$('#btn_FeeSetup').click(function () {

    $.ajax({           
            type: 'POST',
            url: '$urlfee_save',
            // dataType: 'json',
                data: {
                    _csrf: yii.getCsrfToken(),
                    txtSemNo:$("#txtSemNo").val(),     
                    txtFeeAmount:$("#txtFeeAmount").val(),          
                    txtFeeTypeId:$("#txtFeeTypeId").val(),  
                    txtProgFeeCatId:$("#select_id").val(),                        
                        },
                success: function(data) {

                  ///  $('#listProgramFeeDetail').html(data);
                        
                 getProgramFeeDetail();
                }
            });

});



$(document).off('click', '.ProgramFee_Delete').on('click', '.ProgramFee_Delete', function () {

    var ProgFeeCatDetailId = $(this).attr('value'); 

$.ajax({           
        type: 'POST',
        url: '$urlfee_remove',
        // dataType: 'json',
            data: {
                _csrf: yii.getCsrfToken(),
                ProgFeeCatDetailId:ProgFeeCatDetailId,     
                
                    },
            success: function(data) {

              ///  $('#listProgramFeeDetail').html(data);
                    
             getProgramFeeDetail();
            }
        });

});



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
            autoWidth: true, 
			//dom: 'Bfrtip',                      
			ajax: { 
				url: '$url',
				type: 'GET',
				data: {
                    txtSearch:$("#txtSearch").val(),
                    txtFeeStructure:$("#txtFeeStructure").val(),
                    txtProgramTypeId:$("#txtProgramTypeId").val(),
                    txtResidency:$("#txtResidency").val(),
                    
                            
					}
			},

            
		
			"columns": [
				{"data":"ProgFeeCatId", "visible": false},	
                {"data":"ProgramCode"},	                			
				{"data":"ProgramTypeName"},														
				{"data":"FeeStructureName"},
				{"data":"Residency"},
                {"data":"IntakeStart"},
                {"data":"ProgFeeCatTitle"},	
                // {"data":"ApprovalStatus"},
                
                {"data":"", title: 'Action', wrap: true,"defaultContent":'<div class="btn-group showModal_View"> <button type="button" id="del-btn" value="0" class="btn btn-warning btn-sm" >View</button></div>'
                                                         +" " +'<div class="btn-group showModal_Update"> <button type="button" id="del-btn" value="0" class="btn btn-warning btn-sm" >Edit</button></div>'},
      
                // {"data":"ProgramId", title: 'Action', wrap: true, "render": function (item) { 
                //     return '<div class="btn-group"> <button type="button" onclick="editMember(' + item.ProgramId + ')" value="0" class="btn btn-warning btn-sm" >View</button></div>' } },
		
			]
		});



	$('#cmstable1 tbody').on('click', 'tr', function() {
     // console.log(table.row(this).data());
			

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
			var x = d['ProgFeeCatTitle'];
			var y = d['ProgFeeCatId'];
	
			$('#select_data').html(x);
			$('#select_id').val(y);

            getProgramFeeDetail();
		
			});

            

  });



  /**********************************************************************************/


  
    /* Get table value */
    function getProgramFeeDetail(){

            $.ajax({           
            type: 'GET',
            url: '$urlfee',
            // dataType: 'json',
                data: {
                    ProgFeeCatDetailId:$("#select_id").val(),                                     
                        },
                success: function(data) {

                    $('#listProgramFeeDetail').html(data);
                        
                    
                }
            });

   }



  function getProgramFeeDetail_xxxxxxxx(){

  var table2 = $('#cmstable2123').DataTable({
          
          lengthChange:false,			processing: true,
          deferRender:true,			searching:false,
          responsive:true,				
          destroy:true,			pageLength: 12,
          paging:true,			scrollY: true,  
          autoWidth: true, 
          //dom: 'Bfrtip',                      
          ajax: { 
              url: '$urlfee',
              type: 'GET',
              data: {
                      ProgFeeCatDetailId:$("#select_id").val(),                
                    }
          },
      
          "columns": [                      
              {"data":"SemesterNo"},														
              {"data":"feetypename"},
              {"data":"FeeAmount"},
              {"data": "ProgFeeCatDetailId",
                "render": function ( data, type, row, meta ) { 
                    return ' <button type="button"  value="'+data+'" class="btn btn-danger btn-sm Remove_Paticipant" >Remove</button>';
                    }
            }
             
          ]
      });


    }


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
               // ProgramId: $("#select_id").val(),
                 },
             success: function (response) 
            {     
				$("#modal-lg").modal("show");
                $("#modalContent-lg").html(response).modal();							
				document.getElementById('modalHeader-lg').innerHTML = '<h4>New Group Program Fee </h4>';    
				
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
                ProgFeeCatId: $("#select_id").val(),
                 },
             success: function (response) 
            {     
				$('#modal-lg').modal('show');
                $('#modalContent-lg').html(response).modal();							
				document.getElementById('modalHeader-lg').innerHTML = '<h4>View Group Program Fee</h4>';
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
                ProgFeeCatId: $("#select_id").val(),
                 },
                 success: function (response) 
            {                     
                $('#modal-lg').modal('show');
                $('#modalContent-lg').html(response).modal();							
				document.getElementById('modalHeader-lg').innerHTML = '<h4>Edit Group Program Fee</h4>';
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