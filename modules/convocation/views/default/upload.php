<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\modules\convocation\models\tblconvocationdetails;

?>

<?php

$module = '/' . Yii::$app->controller->module->id;

// $url = Url::base() . '/admin/convocationlist';
$url = Url::base() . $module . '/default/yearlist?year=';
$uploaddetails = Url::base() . $module . '/default/uploaddetails';
$image = Url::base() . $module . '/default/image';
$deleteImage = Url::base() . $module . '/default/deleteimage';
$_csrf = Yii::$app->request->getCsrfToken();

$script = <<<JS

$(document).on('click', '.addGallery', function() {
    var folderId = $('#fileuploadform-filetoupload').val();
    if(folderId == '')
    {
        folderId = 0;
        alert('Please Select Year');
    }
    else
    {
        $('#GalleryModal').modal('show');
    }
    GalleryModalTitle.innerText = 'ADD';
    $('#modalContent').load('$uploaddetails?folderId='+folderId);
});

$(document).on('click', '.viewGallery', function() {
    var imageId = $(this).val();
    GalleryModalTitle.innerText = 'VIEW';
    
    $('#modalContent').load('$image?imageId='+imageId);
});

$( document ).ready(function() {

    $('#fileuploadform-filetoupload').change(function () {
    var year = $(this).val();
    if(year == '')
    {
        year = 0;
    }
   
    getYear(year); 

});

$(document).on('click', '.deleteGallery', function() {
    var imageId = $(this).val();
    
    Swal.fire({ html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/wdqztrtx.json" trigger="loop" colors="primary:#ffcc00,secondary:#405189" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Are you sure to delete?</h4></div></div>', showCancelButton: !0, showConfirmButton: !0, cancelButtonClass: "btn btn-danger w-xs mb-1", confirmButtonClass: "btn btn-primary w-xs mb-1 me-2", cancelButtonText: "Cancel", confirmButtonText: "Confirm", buttonsStyling: !1, showCloseButton: 0
            }).then(function(t) 
            {
                if (t.value) {
                    $.ajax({
                        url: '$deleteImage',
                        type: 'POST',
                        dataType: "json",
                        data: 
                        {
                            imageId : imageId,
                            _csrf : '$_csrf'                        },
                        success: function(response) 
                        {
                            Swal.fire({ html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>You have successfully delete the image!</h4></div></div>', allowOutsideClick: !1, showConfirmButton: !0, confirmButtonClass: "btn btn-primary w-xs mb-1 me-2", confirmButtonText: "Confirm", buttonsStyling: !1 })
                            .then(function(t) 
                            { 
                                var table = $('#datatable-registration').DataTable();
                                table.ajax.reload();
                            });
                        },
                        error: function(xhr, status, error) 
                        {

                        }
                    });
                } 
            });
});
    
function getYear(year){

    var table = $('#datatable-registration').DataTable({
        // lengthChange:false,			
        processing: true,
        deferRender:true,			
        // searching:true,
        responsive:true,			
        bFilter:false,
        destroy:true,			
        pageLength: 25,
        paging:true,	
        info: false,	
        scrollY: true,  
        autoWidth: true, 
        // dom: 'Bfrtip',                      
        ajax: { 
            url: '$url'+year,
            type: 'GET',
            datatype: 'json',
        },
        "columns": [
            {
                "data": "ConvoImageId", "width": '0.1%', class:"text-dark",
                "render": function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
                }
            },	
        {"data":"ConvoYear", "width": '15.9%', class:"text-dark"},		
        {"data":"ConvoImageName", "width": '65.0%', class:"text-dark"},	
        {
            "data": "ConvoImageId","width": "17.0%",
            "render": function (data, type, row, meta) 
            {

                return  '<div class="btn-group me-1 mt-2">'+
                        '<button type="button" class="btn btn-primary dropdown-toggle"'+
                        'data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action'+
                        '<i class="mdi mdi-chevron-down"></i></button>'+
                        '<div class="dropdown-menu">'+
                        '<button type="button" class="btn dropdown-item viewGallery" data-bs-toggle="modal" data-bs-target="#GalleryModal" value='+ JSON.stringify(data) +'>View</button>'+
                        '<div class="dropdown-divider"></div>'+
                        '<button type="button" class="btn dropdown-item deleteGallery" value='+ JSON.stringify(data) +'>Delete</button>'+
                        '</div>'+
                        '</div>'
            }
        },														
          ]
      });
    }
});

JS;
$this->registerJs($script);

?>

<div class="col-12">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="card text-dark">
        <h4 class="card-header mt-0 bg-white rounded">ADD/UPDATE GALLERY</h4>
        <div class="card-body">
            <div class="col-md-12 mb-4">
                <h6>Convocation Year:</h6>
                <div class="d-flex">
                    <div class="flex-grow-1 me-3">
                        <?= $form->field($model, 'fileToUpload')->dropDownList(ArrayHelper::map(tblconvocationdetails::find()->asArray()->all(), 'ConvoYear', 'ConvoYear'), ['prompt' => 'Please Select', 'class' => 'form-select text-dark border-dark', 'required' => 'required'])->label(false); ?>
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary waves-effect waves-light mb-3 addGallery" data-bs-target="#GalleryModal" value="0">Add New</button>
                    </div>
                </div>

                <div class="table-rep-plugin">
                    <div class="b-0">
                        <table id="datatable-registration" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-dark">No.</th>
                                    <th class="text-dark">Convocation Year</th>
                                    <th class="text-dark">Image</th>
                                    <th class="text-dark">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<div class="col-12">
    <div class="modal fade" id="GalleryModal" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="GalleryModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="GalleryModalTitle">
                        ADD</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div id="modalContent" class="modal-body">

                </div>
            </div>
        </div>
    </div>
</div>