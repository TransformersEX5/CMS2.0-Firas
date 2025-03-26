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

<div class="tbluser-index">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex text-white bg-primary">
                    <h4 class="card-title mb-0 flex-grow-1">
                        <?= $this->title ?>
                    </h4>
                </div>

                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-xl-6">
                            <div class="search-box">
                                <input type="text" class="form-control search" id="txtSearch" placeholder="Search for something...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row g-3">
                                <div class="col-sm-4">
                                    <?= Html::dropDownList('DepartmentId', null, Yii::$app->common->getDepartment_NoVendor(), [
                                        'prompt' => '- Department -',
                                        'class' => 'form-select mb-3',
                                        'id' => 'txtDepartmentId'
                                    ]) ?>
                                </div>

                                <div class="col-sm-4">
                                    <button type="button" class="btn btn-primary w-100" id="btn_search"> <i class="ri-equalizer-fill me-2 align-bottom"></i>Filters</button>
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

                    <div class="form-group">
                        <h4>
                            <div id="data1"></div>
                            <div id="data2"></div>
                            <div id="data3"></div>
                            <div id="data4"></div>
                            <div id="data5"></div>
                        </h4>
                    </div>

                    <!-- Datatable Start -->
                    <div class="row">
                        <div class='col-12 .col-sm-12'>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
/**********************************************************************************/
$getPhoneDirectory = Url::toRoute(['default/phonedirectorylist']);

$_csrf = Yii::$app->request->getCsrfToken();

$script = <<<JS

/**********************************************************************************/

function getHoP()
{
    var table = $('#cmstable1').DataTable({
	    lengthChange:false,			processing: true,
    	deferRender:true,			searching:false,
	    responsive:true,				
    	destroy:true,			pageLength: 15,
	    paging:true,			scrollY: true,   
    	// dom: 'Bfrtip',                      
    	ajax:
        { 
		    url: '$getPhoneDirectory',
    		type: 'GET',        
	    	data:
            {
                txtSearch:$("#txtSearch").val(),
                txtDepartmentId:$("#txtDepartmentId").val(),
            }
    	},
	    	"columns": [
                {"data":"FullName","width": '35.0%'},	
	    		{"data":"EmailAddress", "width": '25.0%'},	
                {"data":"DepartmentDesc", "width": '25.0%'},	
                {"data":"HandSetNo","width": '15.0%', class:"text-center"},	
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
    getHoP();
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
        getHoP();
    });

    $('#cmstable1 tbody').on('click', 'tr', function() {
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

JS;
$this->registerJs($script);


?>