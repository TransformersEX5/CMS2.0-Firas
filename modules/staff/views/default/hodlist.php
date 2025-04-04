<?php

use app\models\tbluser;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'HoD List ');
$this->params['breadcrumbs'][] = $this->title;
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
                            <button id="View" class="viewAllstaff btn btn-success btn-sm" type="button"> View Staff <i
                                    class="icon-file"></i></button>
                            <button id="New" class="showModal_New btn btn-success btn-sm" type="button"> New <i
                                    class="icon-file"></i></button>
                            <button id="Edit" class="showModal_Update btn btn-success btn-sm" type="button">Edit <i
                                    class="icon-file"></i></button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-xl-10">
                            <div class="search-box">
                                <input type="text" class="form-control search" id="txtSearch"
                                    placeholder="Search for something...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="row g-3">
                                <div class="col-sm-12">
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
                                            <th>List of HoD</th>
                                            <th>Status</th>
                                            <th>Name</th>
                                            <th>Total No. of Staff</th>
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
    </div>
</div>

<?php
/**********************************************************************************/
$url = Url::toRoute(['/staff/default/gethod']);
$create = Url::toRoute(['/staff/default/hodnew']);

$report = Url::toRoute(['/staff/default/rptstaffbyhod']);
$report2 = Url::toRoute(['/staff/default/rptallstaff']);

$script = <<<JS

/**********************************************************************************/
$(document).ready(function () {
    function refreshDatatable()
    {
        var modal = document.getElementById('modal-xs');
            modal.addEventListener('hidden.bs.modal', function (e) {
                $('#cmstable1').DataTable().ajax.reload();
            });
    }

    $(document).on('click', '.viewStaffbyhod', function() {
        var report = '$report';
        var HodId = $(this).val();

        window.open(report+'/?HodId=' + btoa(HodId), '_blank', 'width=800,height=600,scrollbars=yes');
    });

    $(document).on('click', '.viewAllstaff', function() {
        var report2 = '$report2';
        var HodId = $(this).val();

        window.open(report2, '_blank', 'width=800,height=600,scrollbars=yes');
    });

    $(document).on('keypress',function(e) {
        if(e.which == 13) {
            $("#btn_search").trigger('click');
        }
    });

    $('#btn_search').click(function () {
        $('#select_id').html('');
        $('#select_data').html('');
        $('#cmstable1').dataTable().empty();
                    
        var table = $('#cmstable1').DataTable({
            lengthChange:false,			processing: true,
            deferRender:false,			searching:false,
            responsive:true,				
            destroy:true,			pageLength: 10,
            paging:true,			scrollY: true,   
            // dom: 'Bfrtip',                      
            ajax: { 
                url: '$url',
                type: 'GET',
                data: {
                        txtSearch:$("#txtSearch").val(),    
                    }
                },
            "columns": [
                {
                    "data": "HodId", "width": '0.1%', class:"text-dark text-center",
                    "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },	
                {"data":"HodDesc", "width": '10.0%', class:"text-dark"},	
                {"data":"Status", "width": '1.0%', class:"text-dark text-center"},			
                {"data":"FullName", "width": '10.0%', class:"text-dark"},	
                {"data":"TotalStaff", "width": '5.0%', class:"text-dark text-center"},			
                {
                    "data": "HodId","width": "1.0%", class:"text-dark text-center",
                    "render": function (data, type, row, meta) 
                    {
                        return '<button type="button" class="btn btn-primary btn-sm waves-effect waves-light viewStaffbyhod" value='+ JSON.stringify(data) +'>View Staff</button>'
                    }
                },			
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
        
            var x = d['HodDesc'];
            var y = d['HodId'];
        
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
				$("#modal-xs").modal("show");
                $("#modalContent-xs").html(response).modal();							
				document.getElementById('modalHeader-xs').innerHTML = '<h4>New HoD</h4>';    
				
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
      var hodId = document.getElementById('select_id').value;
      if(hodId != '')
      {
        var form = $(this);
        $.ajax({
	    	url: '$create?hodId='+hodId,
            type   : 'GET',
			data: {
                
                 },
                 success: function (response) 
            {                     
                $('#modal-xs').modal('show');
                $('#modalContent-xs').html(response).modal();							
				document.getElementById('modalHeader-xs').innerHTML = '<h4>Edit HoD</h4>';
            },
            error  : function (e) {

            }
        });
        return false;   
      }
      else
      {
        alert('Please select a HoD.');
        return false;  
      }
           
  });
 
  /**********************************************************************************/

/**********************************************************************************/

JS;
$this->registerJs($script);


?>