<?php

use app\models\AuthAssignment;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$backindex = '/application';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');

?>


<?php

$form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    //'enableClientValidation' => false,
    'options' => ['enctype' => 'multipart/form-data']
]); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="mt-2">

            <input type="hidden" name="user_id" id="user_id" value=' <?php echo $model->UserId; ?>' />

            <!-- <div class="row">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="formrow-userid-input">UserId</label><br>
                                                            <?php echo $model->UserId; ?>
                                                        </div>
                                                    </div> end col -->


            <div class="row">
                <div class="mb-3">
                    <label class="form-label" for="formrow-firstname-input">Staff name</label><br>
                    <?php echo $model->FullName; ?>
                </div>
            </div> <!-- end col -->


            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label" for="formrow-email-input">Position</label><br>
                        <?php echo Yii::$app->function->getPosition($model->PositionId); ?>
                    </div>
                </div> <!-- end col -->

                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label" for="formrow-password-input">Status</label> <br>
                        <?php echo Yii::$app->function->getWorkingStatus($model->WorkingStatusId); ?>
                    </div>
                </div> <!-- end col -->

                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label" for="formrow-password-input">Department</label> <br>
                        <?php echo Yii::$app->function->getDepartment($model->DepartmentId); ?>
                    </div>
                </div> <!-- end col -->

            </div> <!-- end row -->




        </div>
    </div> <!-- end col -->


    <input type="hidden" name="select_id" id="select_id" />

</div>

<!-- ============================= -->


<div class="row g-3">
    <div class="col-xl-6">
        <div class="search-box">
            <?= $form->field($model2, 'item_name')->dropDownList(Yii::$app->common->getAuthRole2($model->UserId), [
                'prompt' => '- Permission -',
                'class' => 'form-select mb-2'
            ])->label(false) ?>
        </div>
    </div>
    <!--end col-->
    <div class="col-xl-6">
        <div class="row g-3">

            <div class="col-sm-4">
                <div>
                    <button type="submit" class="btn btn-primary w-100" id="Createpermission"> <i class="ri-equalizer-fill me-2 align-bottom"></i>Submit</button>
                </div>
            </div>
            <!--end col-->
        </div>
    </div>
</div>




<?php ActiveForm::end(); ?>

<!-- <button type="button" class="btn btn-primary w-100" id="btn_search"> <i
                                                class="ri-equalizer-fill me-2 align-bottom"></i>Filters</button>
                                             -->

<!-- Datatable Start -->
<table id="cmstable2" class="table table-bordered table-hover" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>AuthId</th>
            <th>Role/Group </th>
            <th>Action</th>

        </tr>
    </thead>
</table>

<!-- <div class="row">
    <di class='col-12 .col-sm-12'>
        <div class="box-body">
            <div id="lstPermission">

                <table class="table table-bordered">
                    <thead>
                        <tr style="background-color: #1d539d; color: #fff;">
                            <th style="width:5%">#</th>
                            <th>Code</th>
                            <th>Course</th>

                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       /// <?php
                            //$i = 1;
                            //foreach ($permission as $permission) {
                            //
                            ?>
                            <tr>
                                <th scope="row"><?php //echo $i; 
                                                ?></th>
                                <td><?php //echo $permission['item_name'] 
                                    ?></td>
                                <td><?php //echo $permission['item_name'] 
                                    ?></td>


                            </tr>
                        <?php //$i++;  } 
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
</div>
</div> -->
<!-- Datatable End -->


</div> <!-- end col -->


<?php


$url        = Url::toRoute(['/authassignment/assingmentlist']);
$permission = Url::toRoute(['/user/permission']);
$delete     = Url::toRoute(['/authassignment/delete']);
$csrfToken = Yii::$app->request->csrfToken;

$script = <<<JS

/**********************************************************************************/

$(document).ready(function(){

        // $('#cmstable2').dataTable().empty();
			    
        $.noConflict();
		var table = $('#cmstable2').DataTable({
			lengthChange:false,			
            processing: true,
			deferRender:true,			
            searching:false,
			// responsive:true,				
			destroy:true,			
            pageLength: 12,
			paging:true,			
            scrollY: true,   
			//dom: 'Bfrtip',                      
			ajax: { 
				url: '$url',
				type: 'GET',
				data: {
                    txtuserId:$("#user_id").val(),
					}
			},
		
			"columns": [
				{"data":"assignmentid", "visible": false},
                {"data":"item_name"},	

                {"data": "assignmentid",
                "render": function ( data, type, row, meta ) { 
                    return ' <button type="button"  value="'+data+'" class="btn btn-danger btn-sm showModal_Delete" >Remove</button>';
                    }
            }


                //{"data":"authassigid", title: 'Action', wrap: true,"defaultContent":'<div class="btn-group showModal_Delete"> <button type="button" id="del-btn" value="0" class="btn btn-danger btn-sm" >Remove</button></div>'},
      							
      			
		
			]
		});
			
      
  });
  


  $('#cmstable2 tbody').on('click', 'tr', function() {
      console.log(table.row(this).data());
			
			var table = $('#cmstable2').DataTable();
			console.log(table.row(this).data());
  
			if ($(this).hasClass('row_selected1')) {
				$(this).removeClass('row_selected1');
			} else {
				table.$('tr.row_selected1').removeClass('row_selected1');
				$(this).addClass('row_selected1');
			}
        
		    var d = table.row(this).data();
			
			
			var x = d['item_name'];
            var y = d['assignmentid'];
			
			$('#select_data').html(x);
			$('#select_id').val(y);

            
		
			});

  
  /**********************************************************************************/


  $(document).on('click', '.showModal_Delete', function () {
  
    var assignmentid = $(this).attr('value');
    
    

var result = confirm("Are you sure want to delete?");

if (result) {

        $.ajax({
            url: '$delete',
            type   : 'POST',            
            data: {
               _csrf: '$csrfToken',
                assignmentid: assignmentid             
                },
                success: function (response)  {                     
                
                    alert("Data deleted successfully");

                    // var table5 = $('#cmstable2').DataTable();
                    //     table5.ajax.reload(null, false); 

         
            },
            error  : function (e) {
                    // console.log(e);
            }
        });
    return false;      
}  

});


  
JS;
$this->registerJs($script);
?>




<!-- <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  -->


<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style src="lexa-ajax/layouts/purpel/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"></style>
<style src="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"></style>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script> -->