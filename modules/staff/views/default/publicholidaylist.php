<?php

use app\models\tbluser;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\ActionColumn;
use yii\grid\GridView;

use app\models\tblbranch;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Public Holiday List');
$this->params['breadcrumbs'][] = $this->title;

$stmt = "SELECT DATE_FORMAT(lDate, '%Y') AS lDate 
FROM tblcalendarbranch 
GROUP BY DATE_FORMAT(lDate, '%Y')";
$data = Yii::$app->db->createCommand($stmt)->queryAll();

?>

<div class="tbluser-index">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex text-white bg-warning   ">
                    <h4 class="card-title mb-0 flex-grow-1">
                        <?= $this->title ?>
                    </h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <button id="New" class="showModal_New btn btn-success btn-sm" type="button"> New <i
                                    class="icon-file"></i></button>
                            <button id="Edit" class="showModal_Update btn btn-success btn-sm" type="button">Edit <i
                                    class="icon-file"></i></button>
                            <button id="Edit" class="showModal_Remove btn btn-success btn-sm" type="button">Delete <i
                                    class="icon-file"></i></button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-xl-6">
                            <div class="search-box">
                                <input type="text" class="form-control search" id="txtSearch"
                                    placeholder="Search for something...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row g-3">
                                <div class="col-sm-5">
                                    <div>
                                        <?= Html::dropDownList('cboBranch', null, ArrayHelper::map(tblbranch::find()->where(['BranchId' => [1, 4, 5]])->asArray()->all(), 'BranchId', 'BranchName'), ['id' => 'cboBranch', 'class' => 'form-select', 'prompt' => 'Select Branch']); ?>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div>
                                        <?= Html::dropDownList('cboYear', null,  ArrayHelper::map($data, 'lDate', 'lDate'), ['id' => 'cboYear', 'class' => 'form-select', 'prompt' => 'Select Year']); ?>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div>
                                        <button type="button" class="btn btn-primary w-100" id="btn_search"> <i
                                                class="ri-equalizer-fill me-2 align-bottom"></i>Filters</button>
                                    </div>
                                </div>
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

                    <div class="row">
                        <div class='col-12 .col-sm-12'>
                            <div class="box-body">
                                <table id="cmstable1" class="table table-bordered table-hover" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Branch</th>
                                            <th>Date</th>
                                            <th>Holiday</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
/**********************************************************************************/
$url = Url::toRoute(['/staff/default/getpublicholiday']);
$create = Url::toRoute(['/staff/default/publicholidaynew']);
$remove = Url::toRoute(['/staff/default/publicholidayremove']);

$_csrf = Yii::$app->request->getCsrfToken();

$script = <<<JS

/**********************************************************************************/
$(document).ready(function () {
    function refreshDatatable()
    {
        var modal = document.getElementById('modal-lg');
            modal.addEventListener('hidden.bs.modal', function (e) {
                $('#cmstable1').DataTable().ajax.reload();
            });
    }

    $(document).on('keypress',function(e) {
        if(e.which == 13) {
            $("#btn_search").trigger('click');
        }
    });

    $('#btn_search').click(function () {
        var cboYear = document.getElementById('cboYear').value;
        var cboBranch = document.getElementById('cboBranch').value;

        $('#select_id').html('');
        $('#select_data').html('');
        $('#cmstable1').dataTable().empty();
                        
        var table = $('#cmstable1').DataTable({
            lengthChange:false,			processing: true,
            deferRender:false,			searching:false,
            responsive:true,				
            destroy:true,			pageLength: 30,
            paging:true,			scrollY: true,   
            // dom: 'Bfrtip',                      
            ajax: { 
                url: '$url',
                type: 'GET',
                data: {
                        txtSearch:$("#txtSearch").val(),  
                        cboYear:cboYear,  
                        cboBranch:cboBranch,
                    }
                },
            "columns": [
                {
                    "data": "PKBranchId", "width": '0.1%', class:"text-center text-dark",
                    "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },	
                {"data":"BranchName", "width": '10.0%', class:"text-dark"},	
                {"data":"lDate", "width": '10.0%', class:"text-dark"},			
                {"data":"Holiday", "width": '10.0%', class:"text-dark"},									
                {"data":"Remarks", "width": '10.0%', class:"text-dark"},		
            ]
        });

        $('#cmstable1 tbody').on('click', 'tr', function() {
			var table = $('#cmstable1').DataTable();
			if ($(this).hasClass('row_selected1')) {
				$(this).removeClass('row_selected1');
			} else {
				table.$('tr.row_selected1').removeClass('row_selected1');
				$(this).addClass('row_selected1');
			}

		    var d = table.row(this).data();
		
			var x = d['Holiday'];
			var y = d['PKBranchId'];
	
			$('#select_data').html(x);
			$('#select_id').val(y);
		});
        refreshDatatable();
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

                 },
             success: function (response) 
            {     
				$("#modal-lg").modal("show");
                $("#modalContent-lg").html(response).modal();							
				document.getElementById('modalHeader-lg').innerHTML = '<h4>New Public Holiday</h4>';    
				
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
      var PKBranchId = document.getElementById('select_id').value;
      if(PKBranchId != '')
      {
        var form = $(this);
        $.ajax({
	    	url: '$create?PKBranchId='+PKBranchId,
            type   : 'GET',
			data: {
                
                 },
                 success: function (response) 
            {                     
                $('#modal-lg').modal('show');
                $('#modalContent-lg').html(response).modal();							
				document.getElementById('modalHeader-lg').innerHTML = '<h4>Edit Position</h4>';
            },
            error  : function (e) {

            }
        });
        return false;   
      }
      else
      {
        alert('Please select a public holiday.');
        return false;  
      }
           
  });

    /**********************************************************************************/

	$(document).on('click', '.showModal_Remove', function () {
      var PKBranchId = document.getElementById('select_id').value;
      if(PKBranchId != '')
      {

        desc = 'Are you sure to delete the public holiday?';
        desc2 = 'You have successfully deleted the public holiday!';

        Swal.fire({title: desc, icon: "warning", showCancelButton: true, confirmButtonColor: "#34c38f", cancelButtonColor: "#f46a6a", confirmButtonText: "Confirm"
        }).then(function(t) {
            if (t.value) {
                $.ajax({
                    url: '$remove',
                    type: 'POST',
                    dataType: "json",
                    data: {
                        PKBranchId: PKBranchId,
                        _csrf: '$_csrf'
                    },
                    success: function(response) {
                        if(response.success) {
                            Swal.fire({title: desc2, icon: "success", confirmButtonColor: "#34c38f", confirmButtonText: "Confirm"
                            }).then(function(t) {
                                $('#cmstable1').DataTable().ajax.reload();
                            });
                        } else {
                            alert('Error: ' + JSON.stringify(response.errors));
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Please contact the programmer for more details!');
                    }
                });
            } 
        });
      }
      else
      {
        alert('Please select a public holiday.');
        return false;  
      }
           
  });
 
  /**********************************************************************************/

/**********************************************************************************/

JS;
$this->registerJs($script);


?>