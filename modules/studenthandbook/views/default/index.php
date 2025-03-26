<?php

// use Yii;
use app\models\tblprogram;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Student Handbook List');
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

<div class="tbluploaddocument-index">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex text-white bg-warning">
                    <h4 class="card-title mb-0 flex-grow-1">
                        <?= $this->title ?>
                    </h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <button id="New" class="showModal_New btn btn-success btn-sm" type="button">Upload Document<i class="icon-file"></i></button>
                        </div>
                    </div>
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

                    <br>

                    <div><i>Please note that only documents with an active status will be displayed to the users.</i></div>

                    <!-- Datatable Start -->
                    <div class="row">
                        <div class='col-12 .col-sm-12'>
                            <div class="box-body">
                                <table id="cmstable1" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Year</th>
                                            <th>Document Title</th>
                                            <th>Uploaded By</th>
                                            <th>Remarks</th>
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

$create = Url::toRoute(['default/create']);
$edit = Url::toRoute(['default/edit']);
$download = Url::toRoute(['default/download']);
$delete = Url::toRoute(['default/delete']);

$getdocument = Url::toRoute(['default/documentlist']);

$_csrf = Yii::$app->request->getCsrfToken();

$canDelete = Yii::$app->user->can('Student-Handbook-Delete');
$canEdit = Yii::$app->user->can('Student-Handbook-Edit');

$script = <<<JS

/**********************************************************************************/

function getDocumentlist()
{
    var table = $('#cmstable1').DataTable({
	    lengthChange:false,			processing: true,
    	deferRender:true,			searching:false,
	    responsive:true,				
    	destroy:true,			pageLength: 12,
	    paging:true,			scrollY: true,   
    	// dom: 'Bfrtip',                      
    	ajax:
        { 
		    url: '$getdocument',
    		type: 'GET',        
	    	data:
            {
                txtSearch:$("#txtSearch").val(),
	    	}
    	},
	    	"columns": [
                {
                    "data": "UploadDocumentId", "width": '0.1%', class:"text-dark text-center",
                    "render": function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },	
                {"data":"Year","width": '6%', class:"text-center"},	
	    		{"data":"UploadDocumentTitle", "width": '25.9%'},	
                {"data":"UploadBy", "width": '23.0%'},
                {"data":"Remarks", "width": '25.0%'},
                {"data":"Status","width": '6%', class:"text-center"},	
			    {"data": "UploadDocumentId", "width": '6%',
                    "render": function ( data, type, row, meta ) { 
                        return '<div class="dropdown">'+
                        '<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Action</a>'+
                        '<ul class="dropdown-menu">'+
                        '<li><a class="dropdown-item edit" value='+ JSON.stringify(data+','+row.StatusId) +' href="#">Change Status</a></li>'+
                        '<li><a class="dropdown-item download" value='+ JSON.stringify(data) +' href="#">Download</a></li>'+
                        '<li><a class="dropdown-item delete" value='+ JSON.stringify(data) +' href="#">Delete</a></li>'+
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
    getDocumentlist();
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
        getDocumentlist();
    });

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
				document.getElementById('modalHeader-lg').innerHTML = '<h4>Upload Document</h4>';    
            },
            error  : function (e) {
            }
        });
    return false;        
  });

  /**********************************************************************************/

  $(document).on('click', '.download', function() {
        var form = $(this).attr('value'); 
        window.location.href = '$download?id='+form;
    });

  /**********************************************************************************/
  
  $(document).on('click', '.delete', function () {

    var canDelete = '$canDelete';

    if(canDelete){

      var id = $(this).attr('value'); 

      desc = 'Are you sure to delete?';
      desc2 = 'You have successfully deleted the document!'

      Swal.fire({title:desc,icon:"warning",showCancelButton:!0,confirmButtonColor:"#34c38f",cancelButtonColor:"#f46a6a",confirmButtonText:"Confirm"})
      .then(function(t) 
      {
        if (t.isConfirmed) {
          $.ajax({
              url: '$delete?id='+id,
              type: 'GET',
              dataType: 'json',
              data: { },
              contentType: false,
              processData: false,
              success: function (response) 
              {
                  if(response.success)
                  {
                      t.value&&Swal.fire({title:desc2,icon:"success",confirmButtonColor:"#34c38f",confirmButtonText:"Confirm"})
                      .then(function(t) 
                      { 
                          if (t.value)
                          {
                            $('#cmstable1').DataTable().ajax.reload();
                              window.close();
                              btnClose.click();
                          }
                      });
                  }
                  else
                  {
                      alert('Delete Failed!');
                  }
              },
              error: function () 
              {

              }
          });
        } else {

        }
      });  
    }else
    {
        alert('Sorry , your access is denied');
    }
  });

  $(document).on('click', '.edit', function () {

  var canEdit = '$canEdit';

  if(canEdit){

    var id = $(this).attr('value').split(','); 

    if(id[1] == 1)
    {
        desc = 'Are you sure to change the status to inactive?';
        desc2 = "You have successfully changed the document's status to inactive!";
    }
    else
    {
        desc = 'Are you sure to change the status to active?';
        desc2 = "You have successfully changed the document's status to active!";
    }

    Swal.fire({title:desc,icon:"warning",showCancelButton:!0,confirmButtonColor:"#34c38f",cancelButtonColor:"#f46a6a",confirmButtonText:"Confirm"})
    .then(function(t) 
    {
      if (t.isConfirmed) {
        $.ajax({
            url: '$edit?id='+id,
            type: 'GET',
            dataType: 'json',
            data: { },
            contentType: false,
            processData: false,
            success: function (response) 
            {
                if(response.success)
                {
                    t.value&&Swal.fire({title:desc2,icon:"success",confirmButtonColor:"#34c38f",confirmButtonText:"Confirm"})
                    .then(function(t) 
                    { 
                        if (t.value)
                        {
                          $('#cmstable1').DataTable().ajax.reload();
                            window.close();
                            btnClose.click();
                        }
                    });
                }
                else
                {
                    alert('Delete Failed!');
                }
            },
            error: function () 
            {

            }
        });
      } else {

      }
    });  
  }else
  {
      alert('Sorry , your access is denied');
  }
});
});
JS;
$this->registerJs($script);


?>