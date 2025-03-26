<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use app\models\tblbranch;

?>

<?php

$urlGetStud = Url::base() . '/admin/getstud?branch=';
$urlGetReturningStud = Url::base() . '/admin/getreturningstud';
$returningdetails = Url::base() . '/admin/returningdetails?branch=';
$returningdetails2 = Url::base() . '/admin/returningdetails?convoregId=';
$_csrf = Yii::$app->request->getCsrfToken();

$script = <<< JS

$(document).on('click', '.returnStud', function() {
    var branch = $('#branch').val();
    var programregId = $(this).val();

    ReturningDetailsModalTitle.innerText = 'REGISTER';
    
    $('#modalContent').load('$returningdetails'+branch+'&programregId='+programregId);
});

$(document).on('click', '.editRtnstud', function() {
    var convoregId = $(this).val();

    ReturningDetailsModalTitle.innerText = 'EDIT';
    
    $('#modalContent').load('$returningdetails2'+convoregId);
});

$('a[data-bs-toggle="tab"]').on( 'shown.bs.tab', function (e) {
        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
    } );

$( document ).ready(function() {

$('#searchStud').click(function () {

var branch = $('#branch').val();
var search = $('#search').val();

if(branch != '' && search != '')
{
    getStud(branch,search); 
}

});

function getStud(branch,search){

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
            url: '$urlGetStud'+branch+'&search='+search,
            type: 'GET',
            datatype: 'json',
        },
        "columns": [
            {
                "data": "StudNRICPassportNo", "width": '0.1%', class:"text-dark",
                "render": function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
                }
            },	
        {"data":"StudName", "width": '15.9%', class:"text-dark"},		
        {"data":"StudNRICPassportNo", "width": '65.0%', class:"text-dark"},	
        {"data":"StudentNo", "width": '65.0%', class:"text-dark"},	
        {
            "data": "ProgramRegId","width": "17.0%",
            "render": function (data, type, row, meta) 
            {
                return '<button type="button" class="btn btn-primary waves-effect waves-light returnStud" data-bs-toggle="modal" data-bs-target="#ReturningDetailsModal" value='+ JSON.stringify(data) +'>Register</button>'
            }
        },														
          ]
      });
    }

    var table = $('#datatable-returnstud').DataTable({
          
          // lengthChange:false,			
          processing: true,
          deferRender:true,			
          searching:true,
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
              url: '$urlGetReturningStud',
              type: 'GET',
              datatype: 'json',
          },
      
          "columns": [
              {
                      "data": "ConvoRegId", "width": '0.1%', class:"text-dark",
                      "render": function (data, type, row, meta) {
                          return meta.row + meta.settings._iDisplayStart + 1;
                      }
                  },	
              {"data":"StudName", class:"text-dark"},		
              {"data":"StudNRICPassportNo", class:"text-dark"},		
              {"data":"StudentNo", class:"text-dark"},		
              {"data":"ConvoAttend", class:"text-dark"},	
              {
                  "data": "ConvoRegId","width": "0.1%",
                  "render": function (data, type, row, meta) 
                  {
                      return '<button type="button" class="btn btn-primary waves-effect waves-light editRtnstud" data-bs-toggle="modal" data-bs-target="#ReturningDetailsModal" value='+ JSON.stringify(data) +'>Edit</button>'
                  }
              },														
          ]
      });
});

JS;
$this->registerJs($script);

?>

<div class="col-12">
    <div class="card"><?php ActiveForm::begin(['id' => 'StudentId', 'options' => ['onsubmit' => 'return false;']]); ?>
        <h4 class="card-header mt-0 text-dark bg-white rounded">RETURNING STUDENTS</h4>
        <div class="card-body">

            <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#register" role="tab">REGISTER</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#list" role="tab">LIST</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active p-3" id="register" role="tabpanel">
                    <div class="row">
                        <div class="col-md-2 mb-2">
                            <?= Html::dropDownList('branch', null, ArrayHelper::map(tblbranch::find()->where(['not', ['dbname' => null]])->asArray()->all(), 'BranchId', 'BranchName'), ['id' => 'branch', 'class' => 'form-select text-dark border-dark', 'prompt' => 'Select a branch', 'required' => 'required']); ?>
                        </div>

                        <div class="col-md-9 mb-2">
                            <?= Html::textInput('search', null, ['id' => 'search', 'class' => 'form-control text-dark border-dark', 'placeholder' => 'Search by Name, NRIC/Passport No. or Student No.', 'required' => 'required']) ?>
                        </div>

                        <div class="col-md-1 mb-2">
                            <button type="submit" id="searchStud" class="btn btn-primary waves-effect waves-light mb-3">Search</button>
                        </div>
                    </div>

                    <div class="table-rep-plugin">
                        <div class="b-0">
                            <table id="datatable-registration" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-dark">No.</th>
                                        <th class="text-dark">Name</th>
                                        <th class="text-dark">NRIC/Passport No.</th>
                                        <th class="text-dark">Student No.</th>
                                        <th class="text-dark">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane p-3" id="list" role="tabpanel">

                    <div class="col-12">
                        <div class="table-rep-plugin">
                            <div class="b-0">
                                <table id="datatable-returnstud" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-dark">No.</th>
                                            <th class="text-dark">Name</th>
                                            <th class="text-dark">NRIC/Passport No.</th>
                                            <th class="text-dark">Student No.</th>
                                            <th class="text-dark">Attendance</th>
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

<div class="modal fade" id="ReturningDetailsModal" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="ReturningDetailsModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="ReturningDetailsModalTitle">
                    EDIT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div id="modalContent" class="modal-body">

            </div>
        </div>
    </div>
</div>