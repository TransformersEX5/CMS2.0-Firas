<?php

use app\models\tblprogram;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Phone Directory');
$this->params['breadcrumbs'][] = $this->title;
?>

<div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex text-white bg-warning   ">
                    <h4 class="card-title mb-0 flex-grow-1">
                        <?= $this->title ?>
                    </h4>

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
                                <!-- <div class="col-sm-4">
                                    <div>
                                        <?= Html::dropDownList('StatusId', null, Yii::$app->common->getStatus(), [
                                            'prompt' => '- Status -',
                                            'class' => 'form-select mb-3',
                                            'id' => 'txtStatusId'
                                        ]) ?>
                                    </div>
                                </div> -->
                                <!--end col-->
                                <div class="col-sm-4">
                                    <div>
                                        <?= Html::dropDownList('DepartmentId', null, Yii::$app->common->getDepartment_NoVendor(), [
                                            'prompt' => '- Department -',
                                            'class' => 'form-select mb-3',
                                            'id' => 'txtDepartmentId'
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


                    <div class="form-group">

                        <h4>
                            <div id="data1"></div>
                        </h4>
                        <h4>
                            <div id="data2"></div>
                        </h4>
                        <h4>
                            <div id="data3"></div>
                        </h4>
                        <h4>
                            <div id="data4"></div>
                        </h4>
                        <h4>
                            <div id="data5"></div>
                        </h4>

                    </div>



                    <!-- Datatable Start -->
                    <div class="row">
                        <di class='col-12 .col-sm-12'>
                            <div class="box-body">
                                <table id="cmstable1" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Staff Name</th>
                                            <th>Email Address</th>
                                            <th>Department</th>
                                            <th>Tel No.</th>
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
$url = Url::toRoute(['/profile/directorylist']);

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
			responsive:true,				
			destroy:true,			pageLength: 12,
			paging:true,			scrollY: true,   
			// dom: 'Bfrtip',                      
			ajax: { 
				url: '$url',
				type: 'GET',
				data: {
                    txtSearch:$("#txtSearch").val(),
                    txtDepartmentId:$("#txtDepartmentId").val(),
                            
					}
			},
		
			"columns": [
				{"data":"FullName","width": '35 %'},
				{"data":"EmailAddress","width": '25%'},	
                {"data":"DepartmentDesc","width": '25%'},	                
				{"data":"HandSetNo","width": '15%'},	
									
			
		
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
			var v = d['FullName'];
			var w = d['PositionName'];
            var x = d['DepartmentDesc'];
            if(d['ExtensionNo'] == '')
            {
                var y = d['HandSetNo'];
            }
            else
            {
                var y = d['HandSetNo'] + ' ext ' + d['ExtensionNo'];
            }
            var z = d['EmailAddress'];
	
            $('#data1').html('Name: '+ v);
			$('#data2').html('Position: ' + w);
			$('#data3').html('Department: ' + x);
			$('#data4').html('Mobile No.: ' + y);
            $('#data5').html('Email: ' + z);
		
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

JS;
$this->registerJs($script);


?>