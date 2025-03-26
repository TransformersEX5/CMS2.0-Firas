<?php

use app\models\tblprogram;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Application EMGS');
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .dropdown {
        position: static;
        z-index: 10;
    }

    .dropdown-menu {
        position: static;
        z-index: 10;
    }

    .dropdown-item {
        z-index: 10;
    }
</style>

<div class="tblapplicatiomemgs-index">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex text-white bg-warning">
                    <h4 class="card-title mb-0 flex-grow-1">
                        <?= $this->title ?>
                    </h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <button id="New" class="showModal_New btn btn-success btn-sm" type="button">Upload Excel<i class="icon-file"></i></button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-xl-6">
                            <div class="search-box">
                                <input type="text" class="form-control search" id="txtSearch" placeholder="Search for Applicant Fullname or Travel Doc No.">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row g-3">
                                <div class="col-sm-4">
                                    <div>
                                        <button type="button" class="btn btn-primary w-100" id="btn_search"> <i class="ri-equalizer-fill me-2 align-bottom"></i>Filters</button>
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

                    <!-- Datatable Start -->
                    <div class="row">
                        <div class='col-12 .col-sm-12'>
                            <div class="box-body">
                                <table id="cmstable1" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Application ID</th>
                                            <th>Application Received Date</th>
                                            <th>Applicant Fullname</th>
                                            <th>Nationality</th>
                                            <th>Travel Doc No.</th>
                                            <th>Passport Issuing Country</th>
                                            <th>Course Name</th>
                                            <th>Current Status</th>
                                            <th>Student Pass Expiry Date</th>
                                            <th>Updated At</th>
                                            <th>Date Upload</th>
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
// $url = Url::toRoute(['/training/traininglist']);

// $create = Url::toRoute(['default/create']);
// $download = Url::toRoute(['default/download']);
// $delete = Url::toRoute(['default/delete']);

// $rpt_training_detail = Url::toRoute(['/reportgallery/trainingreportdetail']);

// $evaluation = Url::toRoute(['/training/sendemail']);


$getemgs = Url::toRoute(['default/emgslist']);
$upload = Url::toRoute(['default/upload']);

$_csrf = Yii::$app->request->getCsrfToken();




$script = <<<JS

/**********************************************************************************/

function getEMGSlist()
{
    var table = $('#cmstable1').DataTable({
	    lengthChange:false,			processing: true,
    	deferRender:true,			searching:true,
	    responsive:true,				
    	destroy:true,			pageLength: 12,
	    paging:true,			scrollY: true,   
    	// dom: 'Bfrtip',                      
    	ajax:
        { 
		    url: '$getemgs',
    		type: 'GET',        
	    	data:
            {
                txtSearch:$("#txtSearch").val(),
	    	}
    	},
	    	"columns": [
                {
                    "data": "ApplicationEMGSId", "width": '0.1%', class:"text-dark text-center",
                    "render": function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },	
                {"data":"ApplicationId","width": '6%', class:"text-center"},	
	    		{"data":"ApplicationReceivedDate", "width": '33.9%'},	
                {"data":"ApplicantFullName", "width": '31.0%'},
                {"data":"Nationality","width": '15%', class:"text-center"},	
                {"data":"StudNRICPassportNo","width": '6%', class:"text-center"},	
	    		{"data":"PassportIssuingCountry", "width": '33.9%'},	
                {"data":"CourseName", "width": '31.0%'},
                {"data":"EMGSStatus","width": '15%', class:"text-center"},		
                {"data":"StudentPassExpiryDate", "width": '31.0%'},
                {"data":"UpdatedAt","width": '15%', class:"text-center"},	
                {"data":"TransactionDate","width": '15%', class:"text-center"},	
	    		]
		    });
}

function refreshDatatable()
{
    var modal = document.getElementById('modal-lg');
        modal.addEventListener('hidden.bs.modal', function (e) {
            $('#cmstable1').DataTable().ajax.reload();
        });
}

$(document).ready(function(){
    getEMGSlist();
    refreshDatatable();

    $(document).on('keypress',function(e)
    {
        if(e.which == 13)
        {
		    $("#btn_search").trigger('click');
        }
    });

    $('#btn_search').click(function ()
    {
        getEMGSlist();
    });

    $(document).on('click', '.showModal_New', function () {
      var form = $(this);
      $.ajax({
	    	url: '$upload',
            type   : 'GET',
			data: {
                 },
             success: function (response) 
            {
				$("#modal-lg").modal("show");
                $("#modalContent-lg").html(response).modal();							
				document.getElementById('modalHeader-lg').innerHTML = '<h4>Upload Excel File</h4>';    
            },
            error  : function (e) {
            }
        });
    return false;        
  });
});

JS;
$this->registerJs($script);


?>