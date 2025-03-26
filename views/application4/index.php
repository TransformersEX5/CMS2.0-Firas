<?php

use app\models\tblprogram;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Application');
$this->params['breadcrumbs'][] = $this->title;
?>
<style>

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
                            <button id="onClickCreate" class="showModalNew btn btn-success btn-sm" type="button">New Application<i class="icon-file"></i></button>
                        </div>
                    </div>
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
                                            <th>AppId</th>
                                            <th>App No</th>
                                            <th>Nirc/passport</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>.:.</th>
                                            <!-- <th>Status</th> -->

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
$url    = Url::toRoute(['/application/applicationlist']);
$create = Url::toRoute(['/application/create']);
$update = Url::toRoute(['/application/update']);
$view   = Url::toRoute(['/application/view']);

$script = <<<JS

/***for KeyPress / enter***/
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
          
			lengthChange:false,			
            processing: true,
			deferRender:true,			
            searching:false,
			responsive:true,				
			destroy:true,			
            pageLength: 12,
			paging:true,			
            scrollY: true,  
            autoWidth: true, 
			//dom: 'Bfrtip',                      
			ajax: { 
				url: '$url',
				type: 'GET',
				data: {
                    txtSearch:$("#txtSearch").val(),
                    txtStatusId:$("#txtStatusId").val(),
                    txtProgramTypeId:$("#txtProgramTypeId").val(),
                            
					}
			},
		
            // "columnDefs": [
            //     {"className": "td-text-center editable-cost", targets: 2},
            //     {"className": "td-text-center", targets: "_all"},
            //     {"width"    : "250px", targets: [1, 2]},
            // ],

       

			"columns": [
				{"data":"ApplicationId", "visible": false},
				{"data":"AppNo"},
                {"data":"NRICPassportNo"},		
                {"data":"StudName"},	
    			{"data":"ApplicationId"},
                              

                {"data":"", title: '.:.', wrap: true,"defaultContent":
                              '<div class="btn-group showModal_Viewxxxxx"> <button type="button" id="onClickView"  value="0" class="btn btn-success btn-sm " >View</button></div>'+
                         " " +'<div class="btn-group showModal_Updatexxx"> <button type="button" id="onClickUpdate"  value="0" class="btn btn-success btn-sm " >Edit</button></div>'},
			],
            
            
		});


	$('#cmstable1 tbody').on('click', 'tr', function() {
     // console.log(table.row(this).data());
			

			var table = $('#cmstable1').DataTable();
			// console.log(table.row(this).data());    
  
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
  
/***************************************https://metamug.com/docs/examples/file-upload-ajax*******************************************/

/** To create new application **/
$(document).on('click', '.showModalNew', function()
{
    $('#modal-lg').modal('show');
    $('#modalContent-lg').load("$create");							
	document.getElementById('modalHeader-lg').innerHTML = '<h4>New Application</h4>';
});

/***for Create***/
// $(document).on('click', '#onClickCreate', function () {
//      window.location.href = "$create";
// });


/***for Update***/
$(document).on('click touchstart', '#onClickUpdate', function () {
    window.location.href ="$update?ApplicationId="+ btoa($("#select_id").val());
    //if use below code..error on mobile..can't click
    //  var table = $('#cmstable1').DataTable();
    //  var data = table.row( $(this).parents('tr') ).data();
    //  window.location.href = "$update"+'?ApplicationId=' + window.btoa(data['ApplicationId']);  
});

/***for View***/
$(document).on('click touchstart', '#onClickView', function () {
    window.location.href ="$view?ApplicationId="+ btoa($("#select_id").val());
    //if use below code..error on mobile..can't click
    //   var table = $('#cmstable1').DataTable();
    //   var data = table.row( $(this).parents('tr') ).data();
    //   window.location.href = "$view"+'?ApplicationId=' + window.btoa(data['ApplicationId']);  
});

// Javascript sample
// function onClickUpdate() {
// if ($("#select_id").val() == 0) {
//     alert("Select an application first");
// } else {
//     window.location.href = "<?= Url::toRoute(['/application/update']) ?>?ApplicationId=" + btoa($("#select_id").val());
// }
// }

JS;

$this->registerJs($script);

?>