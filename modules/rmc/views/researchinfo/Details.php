<?php

use app\models\tblprogram;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\ActionColumn;
use yii\grid\GridView;

use app\models\tblrmcstatus;
use app\models\tblrmcinformation;

$this->title = Yii::t('app', 'Project Details');
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
                            <!-- <button id="New" class="showModal_New btn btn-success btn-sm" type="button"> New <i
                                    class="icon-file"></i></button> -->
                            <!-- <button id="Edit" class="showModal_Update btn btn-success btn-sm" type="button"> Edit Title<i
                                    class="icon-file"></i></button> -->
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row col-xl-12"><label>Project Title: <?= $data['RMCTitle'];; ?></label></div>
                    <div class="row col-xl-12"><label>Status: <?= $data['Status'];; ?></label></div>
                </div>
            </div>

            <div class="card">
                <div class="card-header align-items-center d-flex text-white bg-primary">
                    <h4 class="card-title mb-0 flex-grow-1  ">
                        Project Leader & Team Members
                    </h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <button id="New" class="showModal_NewMember btn btn-success btn-sm" type="button"> New <i
                                    class="icon-file"></i></button>
                            <!-- <button id="Edit" class="showModal_Update btn btn-success btn-sm" type="button"> Edit Title<i
                                    class="icon-file"></i></button> -->
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class='col-12 .col-sm-12'>
                            <div class="box-body">
                                <table id="cmstableMember" class="table table-bordered table-hover" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>No. MyKad/Passport No./Matric No.</th>
                                            <th>Department/Faculty/School</th>
                                            <th>Academic Qualification/Designation/Field of Study</th>
                                            <th>Staff/Student</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header align-items-center d-flex text-white bg-primary">
                    <h4 class="card-title mb-0 flex-grow-1  ">
                        Research Information
                    </h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                        <button id="New" class="btn btn-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#researchModal"> New 2<i class="icon-file"></i></button>
                            
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                 <div class="modal fade" id="researchModal" tabindex="-1" aria-labelledby="researchModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="researchModalLabel">New Research Information</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="cluster" class="form-label">Cluster of Research:</label>
                                        <select class="form-control" id="cluster" name="cluster" required>
                                            <option value="">Select Cluster</option>
                                            <option value="Educational Technology & Digital Learning">Educational Technology & Digital Learning</option>
                                            <option value="Curriculum & Pedagogy Innovation">Curriculum & Pedagogy Innovation</option>
                                            <option value="STEM Education & Science Literacy">STEM Education & Science Literacy</option>
                                            <option value="Language & Literacy Studies">Language & Literacy Studies</option>
                                            <option value="Inclusive & Special Education">Inclusive & Special Education</option>
                                            <option value="Higher Education & Leadership">Higher Education & Leadership</option>
                                            <option value="Educational Psychology & Student Well-being">Educational Psychology & Student Well-being</option>
                                            <option value="Sociology of Education & Equity">Sociology of Education & Equity</option>
                                            <option value="TVET (Technical & Vocational Education & Training)">TVET (Technical & Vocational Education & Training)</option>
                                            <option value="Sustainable Education & Environmental Learning">Sustainable Education & Environmental Learning</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="field" class="form-label">Field of Research:</label>
                                        <input type="text" class="form-control" id="field" name="field" required>
                                    </div>
                                    
                                    <div class="mb-3 row align-items-center">
                                        <label for="duration" class="col-auto col-form-label">Duration of Research:</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="duration" name="duration" required>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="start-date" class="form-label">Start Date:</label>
                                            <input type="date" class="form-control" id="start-date" name="start-date" required>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="end-date" class="form-label">End Date:</label>
                                            <input type="date" class="form-control" id="end-date" name="end-date" required>
                                        </div>
                                    </div>
                    
                                    <div class="mb-3">
                                        <label for="location" class="form-label">Location of Research:</label>
                                        <input type="text" class="form-control" id="location" name="location" required>
                                    </div>  
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>  
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Cluster of Research:</label>
                        </div>
                        <div class="col-md-6">
                            <label>Field of Research:</label>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <label>Duration of Research:</label>
                        </div>
                        <div class="col-md-6">
                            <label>Start Date:</label>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <label>End Date:</label>
                        </div>
                        <div class="col-md-6">
                            <label>Location of Research:</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header align-items-center d-flex text-white bg-primary">
                    <h4 class="card-title mb-0 flex-grow-1  ">
                        Executive Summary
                    </h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <!-- <button id="New" class="showModal_New btn btn-success btn-sm" type="button"> New Project<i
                                    class="icon-file"></i></button>
                            <button id="Edit" class="showModal_Update btn btn-success btn-sm" type="button"> Edit Title<i
                                    class="icon-file"></i></button> -->
                        </div>
                    </div>
                </div>

                <div class="card-body">
                        
                </div>
            </div>

            <div class="card">
                <div class="card-header align-items-center d-flex text-white bg-primary">
                    <h4 class="card-title mb-0 flex-grow-1  ">
                        Budget
                    </h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <!-- <button id="New" class="showModal_New btn btn-success btn-sm" type="button"> New Project<i
                                    class="icon-file"></i></button>
                            <button id="Edit" class="showModal_Update btn btn-success btn-sm" type="button"> Edit Title<i
                                    class="icon-file"></i></button> -->
                        </div>
                    </div>
                </div>

                <div class="card-body">

                </div>
            </div>
        </div>

        <?php
        /**********************************************************************************/

        $RMCId = Yii::$app->request->get('RMCId');
        $module = '/' . Yii::$app->controller->module->id;
        // $url = Url::base() . $module . '/default/rmclist';
        $newmember = Url::base() . $module . '/member/newmember';
        $getmemberlist = Url::base() . $module . '/member/getmemberlist';
        $_csrf = Yii::$app->request->getCsrfToken();

        // $view = '';

        $script = <<<JS

/**********************************************************************************/

function getMemberlist()
{
    $('#cmstableMember').dataTable().empty();
			    
	var table = $('#cmstableMember').DataTable({
	lengthChange:false,			processing: true,
	deferRender:true,			searching:false,
	responsive:true,			pageLength: 12,
	destroy:true,			    scrollY: true,  
	paging:true,			    
    autoWidth: true, 
	// dom: 'Bfrtip',                      
	ajax: { 
		url: '$getmemberlist',
		type: 'GET',
		data: {
            // txtSearch:$("#txtSearch").val(),        
            // txtStatusId:$("#txtStatusId").val(),                     
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

    // $('#cmstable1 tbody').on('click', 'tr', function() {

	// 	var table = $('#cmstable1').DataTable();
	// 	console.log(table.row(this).data());

	// 	if ($(this).hasClass('row_selected1')) {
	// 		$(this).removeClass('row_selected1');
	// 	} else {
	// 		table.$('tr.row_selected1').removeClass('row_selected1');
	// 		$(this).addClass('row_selected1');
	// 	}
        
	// 	var d = table.row(this).data();
			
	// 	var x = d['RMCTitle'];
	// 	var y = d['RMCId'];
	
	// 	$('#select_data').html(x);
	// 	$('#select_id').val(y);
		
	// });
}

$(document).on('click', '.showModal_NewMember', function () {
    var form = $(this);
    var RMCId = '$RMCId';

      $.ajax({
	    	url: '$newmember?RMCId='+RMCId,
            type   : 'GET',
			data: {
                // ProgramId: $("#select_id").val(),
                 },
             success: function (response) 
            {     
				$("#modal-lg").modal("show");
                $("#modalContent-lg").html(response).modal();							
				document.getElementById('modalHeader-lg').innerHTML = '<h4>New Member</h4>';    
				
				console.log(response);
            },
            error  : function (e) {
				    console.log(e);
            }
        });
    return false;        
  });


JS;
        $this->registerJs($script);


        ?>