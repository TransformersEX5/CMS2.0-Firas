<?php

use app\models\tblprogram;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\ActionColumn;
use yii\grid\GridView;

use app\models\tblrmcstatus;

$this->title = Yii::t('app', 'Research Management Centre');
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    table#cmstable1 tbody td div {

        word-wrap: break-word;
    }
</style>
<div class="tblrmc-index">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex text-white bg-primary">
                    <h4 class="card-title mb-0 flex-grow-1  ">
                        <?= $this->title ?>
                    </h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <button id="New" class="showModal_New btn btn-success btn-sm" type="button"> New Project<i
                                    class="icon-file"></i></button>
                            <button id="Edit" class="showModal_Update btn btn-success btn-sm" type="button"> Edit Title<i
                                    class="icon-file"></i></button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-xl-8">
                            <div class="search-box">
                                <input type="text" class="form-control search" id="txtSearch"
                                    placeholder="Search for Research Title...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div>
                                        <?= Html::dropDownList('StatusId', null, ArrayHelper::map(tblrmcstatus::find()->select(['StatusId', 'Status'])->asArray()->all(), 'StatusId', 'Status'), ['prompt' => 'Select Status', 'class' => 'form-select mb-3', 'id' => 'txtStatusId']); ?>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div>
                                        <button type="button" class="btn btn-primary w-100" id="btn_search"> <i
                                                class="ri-equalizer-fill me-2 align-bottom"></i>Filters</button>
                                    </div>
                                </div>
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
                    <div class="row">
                        <div class='col-12 .col-sm-12'>
                            <div class="box-body">
                                <table id="cmstable1" class="table table-bordered table-hover" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Project Title</th>
                                            <th>Status</th>
                                            <th>Transaction Date</th>
                                            <th>.:.</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        /**********************************************************************************/

        $module = '/' . Yii::$app->controller->module->id;
        $url = Url::base() . $module . '/default/rmclist';
        $create = Url::base() . $module . '/default/rmccreate';
        $_csrf = Yii::$app->request->getCsrfToken();

        $view = '';

        $script = <<<JS

/**********************************************************************************/

function refreshDatatable()
{
    var modal = document.getElementById('modal-lg');
        modal.addEventListener('hidden.bs.modal', function (e) {
            $('#cmstable1').DataTable().ajax.reload();
        });
}

function getRMClist()
{
	  $('#select_id').html('');
      $('#select_data').html('');
      $('#cmstable1').dataTable().empty();
			    
		var table = $('#cmstable1').DataTable({
			lengthChange:false,			processing: true,
			deferRender:true,			searching:false,
			responsive:true,			pageLength: 12,
			destroy:true,			    scrollY: true,  
			paging:true,			    
            autoWidth: true, 
			// dom: 'Bfrtip',                      
			ajax: { 
				url: '$url',
				type: 'GET',
				data: {
                    txtSearch:$("#txtSearch").val(),        
                    txtStatusId:$("#txtStatusId").val(),                     
					}
			},
		
			"columns": [
                {
                    "data": "RMCId", "width": '0.1%', class:"text-dark text-center",
                    "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },	
                {"data":"RMCTitle", "width": '82.9%', class:"text-dark"},
                {"data":"Status", "width": '3.0%', class:"text-dark text-center"},
                {"data":"TransactionDate", "width": '15.0%', class:"text-dark text-center"},
			    {"data": "RMCId", "width": '6%', class:"text-center",
                    "render": function ( data, type, row, meta ) { 
                        return '<button value='+JSON.stringify(data)+' class="btn btn-sm btn-secondary getDetails">Details</button>';
                    }
                },	
			]
		});

        $('#cmstable1 tbody').on('click', 'tr', function() {

			var table = $('#cmstable1').DataTable();
			console.log(table.row(this).data());

			if ($(this).hasClass('row_selected1')) {
				$(this).removeClass('row_selected1');
			} else {
				table.$('tr.row_selected1').removeClass('row_selected1');
				$(this).addClass('row_selected1');
			}
        
		    var d = table.row(this).data();
			
			var x = d['RMCTitle'];
			var y = d['RMCId'];
	
			$('#select_data').html(x);
			$('#select_id').val(y);
		
			});
  }


$(document).ready(function(){
    getRMClist();
    refreshDatatable();

$(document).ready(function() {
    $('#btn_search').trigger('click');
});


 $(document).on('keypress',function(e) {
    if(e.which == 13) {
		$("#btn_search").trigger('click');
    }
});

$('#btn_search').click(function () {
    getRMClist();
});

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
				document.getElementById('modalHeader-lg').innerHTML = '<h4>New Project</h4>';    
				
				console.log(response);
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
      var RMCId = $('#select_id').val();
      $.ajax({
	    	url: '$create?RMCId='+RMCId,
            type   : 'GET',
			data: {
                RMCId: RMCId,
                 },
             success: function (response) 
            {     
				$('#modal-lg').modal('show');
                $('#modalContent-lg').html(response).modal();							
				document.getElementById('modalHeader-lg').innerHTML = '<h4>Update Project</h4>';
            },
            error  : function (e) {
				    console.log(e);
            }
        });
    return false;        
  });
  /**********************************************************************************/

  $(document).on('click', '.getDetails', function() {
    var RMCId = $(this).val();

    window.location.href = 'details?RMCId='+btoa(RMCId);
    });
});
  
  /**********************************************************************************/


JS;
        $this->registerJs($script);


        ?>