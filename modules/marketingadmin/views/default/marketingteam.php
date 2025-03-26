<?php

use app\models\tblprogram;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Set Marketing Team');
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

<div class="tblmarketingteam-index">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex text-white bg-warning">
                    <h4 class="card-title mb-0 flex-grow-1">
                        <?= $this->title ?>
                    </h4>
                    <div class="flex-shrink-0">
                        <!-- <div class="form-check form-switch form-switch-right form-switch-md">
                            <button id="New" class="showModal_New btn btn-success btn-sm" type="button">Upload Document<i class="icon-file"></i></button>
                        </div> -->
                    </div>
                </div>

                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-xl-6">
                            <div class="search-box">
                                <input type="text" class="form-control search" id="txtSearch" placeholder="Search for Marketing Team">
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
                                            <th>Marketing Team</th>
                                            <th>No. of Team Member(s)</th>
                                            <th>Team Target No.</th>
                                            <th>Status</th>
                                            <th>Action</th>
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

$marketingteamlist = Url::toRoute(['default/marketingteamlist']);
$setMT = Url::toRoute(['default/setmt']);
$teammember = Url::toRoute(['default/teammember']);

$_csrf = Yii::$app->request->getCsrfToken();

$script = <<<JS

/**********************************************************************************/

function getMarketingTeamlist()
{
    var table = $('#cmstable1').DataTable({
	    lengthChange:false,			processing: true,
    	deferRender:false,			searching:true,
	    responsive:true,				
    	destroy:true,			pageLength: 12,
	    paging:true,			scrollY: true,   
    	// dom: 'Bfrtip',                      
    	ajax:
        { 
		    url: '$marketingteamlist',
    		type: 'GET',        
	    	data:
            {
                txtSearch:$("#txtSearch").val(),
	    	}
    	},
	    	"columns": [
                {
                    "data": "MarketingTeamId", "width": '0.1%', class:"text-dark text-center",
                    "render": function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },	
	    		{"data":"MarketingTeam", "width": '30.9%'},	
                {"data":"CountNo","width": '12.0%', class:"text-center"},	
                {"data":"TeamTarget","width": '10.0%', class:"text-center"},		
                {"data":"Status","width": '5.0%', class:"text-center"},		
                {"data": "MarketingTeamId", "width": '0.1%',
                    "render": function ( data, type, row, meta ) { 
                        return '<div class="dropdown">'+
                        '<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Action</a>'+
                        '<ul class="dropdown-menu">'+
                        '<li><a class="dropdown-item teammember" value='+ JSON.stringify(data) +' href="#">Team Members</a></li>'+
                        '<li><a class="dropdown-item setMT" value='+ JSON.stringify(data) +' href="#">Edit</a></li>'+
                        // '<li><a class="dropdown-item delete" value='+ JSON.stringify(data) +' href="#">Delete</a></li>'+
                        '</ul>'+
                        '</div>';
                    }
                },
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
    getMarketingTeamlist();
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
        getMarketingTeamlist();
    });

    $(document).on('click', '.teammember', function () {
      var MarketingTeamId = $(this).attr('value'); 
      var form = $(this);
      $.ajax({
	    	url: '$teammember?MarketingTeamId='+MarketingTeamId,
            type   : 'GET',
			data: {
                 },
             success: function (response) 
            {
				$("#modal-lg").modal("show");
                $("#modalContent-lg").html(response).modal();							
				document.getElementById('modalHeader-lg').innerHTML = '<h4>Team Members</h4>';    
            },
            error  : function (e) {
            }
        });
    return false;        
  });

    $(document).on('click', '.setMT', function () {
      var MarketingTeamId = $(this).attr('value'); 
      var form = $(this);
      $.ajax({
	    	url: '$setMT?MarketingTeamId='+MarketingTeamId,
            type   : 'GET',
			data: {
                 },
             success: function (response) 
            {
				$("#modal-lg").modal("show");
                $("#modalContent-lg").html(response).modal();							
				document.getElementById('modalHeader-lg').innerHTML = '<h4>Set Marketing Team</h4>';    
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