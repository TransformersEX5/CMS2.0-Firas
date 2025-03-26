<?php

use app\models\tbluser;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\ActionColumn;
use yii\grid\GridView;

use app\models\tblstatusai;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Lecturer VS Subject');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="subjectexpert-index">
    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header align-items-center d-flex text-white bg-warning   ">
                    <h4 class="card-title mb-0 flex-grow-1">
                        <?= $this->title ?>
                    </h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <!-- <button id="View" class="viewAllstaff btn btn-success btn-sm" type="button"> View Staff <i
                                    class="icon-file"></i></button> -->
                            <button id="New" class="showModal_New btn btn-success btn-sm" type="button">Subject Expert<i
                                    class="icon-file"></i></button>
                            <!-- <button id="Edit" class="showModal_Update btn btn-success btn-sm" type="button">Edit <i
                                    class="icon-file"></i></button> -->
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-xl-8">
                            <div class="search-box">
                                <input type="text" class="form-control search" id="txtSearch"
                                    placeholder="Search for something...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="row g-3">
                                <div class="col-sm-7">
                                    <div>
                                        <?= Html::dropDownList('cboStatus', null, ArrayHelper::map(tblstatusai::find()->all(), 'StatusId', 'Status'), ['id' => 'cboStatus', 'class' => 'form-select', 'prompt' => 'Select Status']); ?>
                                    </div>
                                </div>
                                <div class="col-sm-5">
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
                                            <th width="1%">No.</th>
                                            <th width="1%">Code</th>
                                            <th>Lecturer Name</th>
                                            <th width="1%">Status</th>
                                            <th>School</th>
                                            <th width="1%">No of Subject(s)</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card">
                <div class="card-header align-items-center d-flex text-white bg-warning   ">
                    <h4 class="card-title mb-0 flex-grow-1">
                        Lecturer's Subject(s)
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4>
                                    <div id="select_data2"></div>
                                </h4>
                                <input type="hidden" name="select_id2" id="select_id2" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class='col-12 .col-sm-12'>
                            <div class="box-body">
                                <table id="cmstable2" class="table table-bordered table-hover" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Subject Code</th>
                                            <th>Subject Name</th>
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
$url = Url::toRoute(['/program/default/getlecturerlist']);
$url2 = Url::toRoute(['/program/default/getlecturersubject']);
$create = Url::toRoute(['/program/default/subjectexpertnew']);
$remove = Url::toRoute(['/program/default/subjectexpertremove']);

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

        var modal = document.getElementById('modal-lg');
            modal.addEventListener('hidden.bs.modal', function (e) {
                $('#cmstable2').DataTable().ajax.reload();
            });
    }

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
                    "data": "UserId", "width": '0.1%', class:"text-dark text-center",
                    "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },	
                {"data":"UserNo", "width": '0.1%', class:"text-dark text-center"},	
                {"data":"FullName", "width": '30.0%', class:"text-dark"},			
                {"data":"Status", "width": '0.1%', class:"text-dark text-center"},	
                {"data":"DepartmentDesc", "width": '30.0%', class:"text-dark"},			
                {"data":"NoOfSubj", "width": '0.1%', class:"text-dark"},			
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
        
        var x = d['FullName'];
        var y = d['UserId'];
        
        $('#select_data').html(x);
        $('#select_id').val(y);

        var data = table.row(this).data();
        var UserId = data.UserId;

        var table = $('#cmstable2').DataTable({
            lengthChange:false,			processing: true,
            deferRender:false,			searching:true,
            responsive:true,			ordering: false,
            destroy:true,			pageLength: 10,
            paging:true,			scrollY: true,   
            // dom: 'Bfrtip',                      
            ajax: { 
                url: '$url2',
                type: 'GET',
                data: {
                    UserId:UserId,    
                    }
                },
            "columns": [
                {"data":"SubjectCode", "width": '7.5%', class:"text-dark text-center"},	
                {"data":"SubjectName", "width": '30.0%', class:"text-dark"},		
                {
                    "data": "SubjLectId",
                    "width": '0.1%',
                    "class": "text-center",
                    "render": function(data, type, row) {
                        return '<button type="button" class="btn btn-primary waves-effect waves-light btn-sm removeSubject" value="' + row.SubjLectId + '">Remove</button>';
                    }
                }
            ]
        });
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
      var UserId = document.getElementById('select_id').value;

      if(UserId != '')
      {
        var form = $(this);
        $.ajax({
	    	url: '$create?UserId='+UserId,
            type   : 'GET',
			data: {
                
                 },
                 success: function (response) 
            {                     
                $('#modal-lg').modal('show');
                $('#modalContent-lg').html(response).modal();							
				document.getElementById('modalHeader-lg').innerHTML = '<h4>Lecturer Vs Subject Expert</h4>';
            },
            error  : function (e) {

            }
        });
        return false;   
      }
      else
      {
        alert('Please select a staff.');
        return false;  
      }
           
  });

  /**********************************************************************************/

  $(document).on('click', '.removeSubject', function () {
    var SubjLectId = $(this).val();

    desc = 'Are you sure to remove the subject?';
    desc2 = 'You have successfully remove the subject!';

    Swal.fire({title: desc, icon: "warning", showCancelButton: true, confirmButtonColor: "#34c38f", cancelButtonColor: "#f46a6a", confirmButtonText: "Confirm"
    }).then(function(t) {
        if (t.value) {
            $.ajax({
                url: '$remove',
                type: 'POST',
                dataType: "json",
                data: {
                    SubjLectId: SubjLectId,
                    _csrf: '$_csrf'
                },
                success: function(response) {
                    if(response.success) {
                        Swal.fire({title: desc2, icon: "success", confirmButtonColor: "#34c38f", confirmButtonText: "Confirm"
                        }).then(function(t) {
                            $('#cmstable2').DataTable().ajax.reload();
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
  });
 
  /**********************************************************************************/


/**********************************************************************************/

JS;
$this->registerJs($script);


?>







<!-- <div>
    <button type="button" class="btn btn-primary w-100" id="btn_search"> <i
            class="ri-equalizer-fill me-2 align-bottom"></i>Filters</button>
</div> -->