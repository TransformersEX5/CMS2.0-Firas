<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use app\modules\datin\models\tbldatinpropertytype;
use app\modules\datin\models\Tblstatusai;

?>

<?php

$module = '/' . Yii::$app->controller->module->id;

$urlGetDName = Url::base() . $module . '/default/getdname?dtype=';
$urlGetDType = Url::base() . $module . '/default/getdtype';
$urlItem = Url::base() . $module . '/default/details?itemId=';
$urlType = Url::base() . $module . '/default/type?typeId=';
$urlUserManual = Url::base() . $module . '/default/usermanual';
$_csrf = Yii::$app->request->getCsrfToken();

$script = <<< JS

$( document ).ready(function() {
    $('a[data-bs-toggle="tab"]').on( 'shown.bs.tab', function (e) {
        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
    } );

    $('#search').click(function () {
        
        var dtype = $('#dtype').val();
        var searchbox = $('#searchbox').val();
        var statusId = $('#statusId').val();
        
        getDName(dtype,searchbox,statusId); 
        
    });

    function getDName(dtype,searchbox,statusId){
        var table = $('#cmstable1').DataTable({
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
                url: '$urlGetDName'+dtype+'&searchbox='+searchbox+'&statusId='+statusId,
                type: 'GET',
                datatype: 'json',
            },
            "columns": [
                {
                    "data": "ItemId", "width": '0.1%', class:"text-dark",
                    "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },	
            {"data":"TypeName", "width": '39.9%', class:"text-dark"},		
            {"data":"ItemName", "width": '39.9%', class:"text-dark"},	
            {"data":"DueDate", "width": '10.0%', class:"text-dark"},	
            {"data":"Status", "width": '10.0%', class:"text-dark"},	
            {
                "data": "ItemId","width": "0.1%",
                "render": function (data, type, row, meta) 
                {
                    return '<button type="button" class="btn btn-primary waves-effect waves-light editDItem" data-bs-toggle="modal" data-bs-target="#DpropertyDetailsModalId" value='+ JSON.stringify(data) +'>Edit</button>';
                }
            },														
            ]
        });
    }

    var table2 = $('#cmstable2').DataTable({
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
            url: '$urlGetDType',
            type: 'GET',
            datatype: 'json',
        },
        "columns": [
            {
                "data": "TypeId", "width": '0.1%', class:"text-dark",
                "render": function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
                }
            },	
        {"data":"TypeName", "width": '39.9%', class:"text-dark"},		
        {
            "data": "TypeId","width": "0.1%",
            "render": function (data, type, row, meta) 
            {
                return '<button type="button" class="btn btn-primary waves-effect waves-light editDType" data-bs-toggle="modal" data-bs-target="#DpropertyDetailsModalId" value='+ JSON.stringify(data) +'>Edit</button>';
            }
        },														
        ]
    });
    
    $(document).on('click', '.addDItem', function() {
        var itemId = $(this).val();

        $('#DpropertyDetailsModalId').modal('show');

        DpropertyDetailsModal.innerText = 'ADD';
        $('#modalContent').load('$urlItem'+itemId);
    });

    $(document).on('click', '.editDItem', function() {
        var itemId = $(this).val();

        DpropertyDetailsModal.innerText = 'EDIT';
        $('#modalContent').load('$urlItem'+itemId);
    });

    $(document).on('click', '.addDType', function() {
        var typeId = $(this).val();
        $('#DpropertyDetailsModalId').modal('show');
        DpropertyDetailsModal.innerText = 'ADD';
        $('#modalContent').load('$urlType'+typeId);
    });

    $(document).on('click', '.editDType', function() {
        var typeId = $(this).val();

        DpropertyDetailsModal.innerText = 'EDIT';
        
        $('#modalContent').load('$urlType'+typeId);
    });

    $(document).on('click', '.userManual', function() {
        window.location.href = '$urlUserManual';
    });
});

JS;
$this->registerJs($script);

?>

<div class="col-12">
    <div class="card"><?php ActiveForm::begin(['id' => 'ItemId', 'options' => ['onsubmit' => 'return false;']]); ?>
        <div class="row">
            <div class="col-10">
                <h4 class="card-header mt-0 text-dark bg-white rounded">DATIN'S PROPERTY</h4>
            </div>
            <div class="col-2 mt-3">
                <button type="button" class="btn btn-primary waves-effect waves-light userManual">Download User Manual</button>
            </div>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#item" role="tab">ITEM</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#type" role="tab">TYPE</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active p-3" id="item" role="tabpanel">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary waves-effect waves-light mb-3 addDItem" data-bs-target="#DpropertyDetailsModalId" value="0">Add New Item</button>
                        <a href="<?= Url::base() . $module . '/default/report' ?>" target="_blank" class="btn btn-primary waves-effect waves-light mb-3">Generate Report</a>
                    </div>

                    <div class="row">
                        <div class="col-7 mb-2">
                            <?= Html::textInput('search', null, ['id' => 'searchbox', 'class' => 'form-control text-dark border-dark', 'placeholder' => 'Search by Name, Person In Charge or Status']) ?>
                        </div>

                        <div class="col-2 mb-2">
                            <?= Html::dropDownList('dtype', null, ArrayHelper::map(Tbldatinpropertytype::find()->orderBy(['TypeName' => SORT_ASC])->asArray()->all(), 'TypeId', 'TypeName'), ['id' => 'dtype', 'class' => 'form-select text-dark border-dark', 'prompt' => 'Select a category']); ?>
                        </div>

                        <div class="col-2 mb-2">
                            <?= Html::dropDownList('statusId', null, ['1' => 'Active', '2' => 'Inactive'], ['id' => 'statusId', 'prompt' => 'Select Status', 'class' => 'form-select text-dark border-dark']); ?>
                        </div>

                        <div class="col-1 mb-2">
                            <button type="submit" id="search" class="btn btn-primary waves-effect waves-light mb-3">Search</button>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="table-rep-plugin">
                            <div class="b-0">
                                <table id="cmstable1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-dark">No.</th>
                                            <th class="text-dark">Type</th>
                                            <th class="text-dark">Item</th>
                                            <th class="text-dark">Due Date</th>
                                            <th class="text-dark">Status</th>
                                            <th class="text-dark">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane p-3" id="type" role="tabpanel">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary waves-effect waves-light addDType" data-bs-target="#DpropertyDetailsModalId" value="0">Add New Type</button>
                    </div>

                    <div class="col-12">
                        <div class="table-rep-plugin">
                            <div class="b-0">
                                <table id="cmstable2" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-dark">No.</th>
                                            <th class="text-dark">Name</th>
                                            <th class="text-dark">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="modal fade" id="DpropertyDetailsModalId" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="DpropertyDetailsModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="DpropertyDetailsModal">REGISTER</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="modalContent" class="modal-body">

                </div>
            </div>
        </div>
    </div>
</div>