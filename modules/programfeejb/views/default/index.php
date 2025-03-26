<?php

use app\models\tblprogram;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'A : Fees Group Setup');
$this->params['breadcrumbs'][] = $this->title;
?>



<style>
    /* Datatable..droupdown menu  */
    .table-responsive,
    .dataTables_scrollBody {
        overflow: visible !important;
    }


    .checkbox-lg .form-check-input {
        top: .8rem;
        scale: 1.4;
        margin-right: 0.7rem;
    }

    .checkbox-lg .form-check-label {
        padding-top: 13px;
    }

    .checkbox-xl .form-check-input {
        /* top: 1.2rem; */
        scale: 2.3;
        margin-right: 0.8rem;
    }

    /* .checkbox-xl .form-check-label {
        padding-top: 19px;
    } */

    table#cmstable1 tbody td div {
        /* width: 60px;
        height: 22px; */
        /* overflow: hidden; */
        word-wrap: break-word;
    }
</style>
<?= Html::csrfMetaTags() ?>
<div class="tblprogram-index">


    <div class="row">
        <div class="col-lg-12">
            <div class="card">

            <div class="card-header align-items-center text-white bg-primary">
                    <h4 class="card-title mb-0 flex-grow-1  ">
                        <div class="d-flex justify-content-between">
                            <div> <?= $this->title ?></div>
                            <div class="d-flex justify-content-center"> Progrem Fee - JB</div>
                            <button id="New" class="showModal_New btn btn-success btn-sm" type="button"> New Fee Group <i class="icon-file"></i></button>
                        </div>
                    </h4>
                </div><!-- end card header -->

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row g-1">
                                <div class="col-md-3 col-sm-4">
                                    <div class="search-box">
                                        <input type="text" class="form-control search" id="txtSearch" placeholder="Search for Prog Fee Code, Fees, Residency, status or something...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>

                                <div class="col-sm-1">
                                    <?= Html::dropDownList('ResidencyId', null, Yii::$app->common->getResidency(), [
                                        'prompt' => '- Residency -',
                                        'class' => 'form-select mb-3',
                                        'id' => 'txtResidency'
                                    ]) ?>
                                </div>


                                <div class="col-sm-1">
                                    <?= Html::dropDownList('TermTypeId', null, Yii::$app->common->getTermType(), [
                                        'prompt' => '- Term Type -',
                                        'class' => 'form-select mb-3',
                                        'id' => 'txtTermTypeId'
                                    ]) ?>
                                </div>

                                <div class="col-sm-1">
                                    <?= Html::dropDownList('StatusId', null, Yii::$app->common->getStatus(), [
                                        'prompt' => '- Status -',
                                        'class' => 'form-select mb-3',
                                        'id' => 'txtStatusId'
                                    ]) ?>


                                </div>

                                <div class="col-sm-2">
                                    <?= Html::dropDownList('ProgramTypeId', null, Yii::$app->common->getProgramType(), [
                                        'prompt' => '- Program Type -',
                                        'class' => 'form-select mb-3',
                                        'id' => 'txtProgramTypeId'
                                    ]) ?>


                                </div>

                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-primary w-100" id="btn_search"> <i class="ri-equalizer-fill me-2 align-bottom"></i>Filters</button>
                                </div>

                                <!-- <div class="col-sm-2">

                                    <button id="New" class="showModal_ProgvsFees btn btn-success btn-sm" type="button"> Program vs Fees <i class="icon-file"></i></button>

                                </div> -->
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-10">
                                <h4>
                                    <h5>
                                        <div id="select_data"></div>
                                    </h5>
                                </h4>
                                <input type="hidden" name="select_id" id="select_id" />
                                <input type="hidden" name="select_progid" id="select_progid" />
                                <input type="hidden" name="select_progtype" id="select_progtype" />

                            </div>
                        </div>


                        <div class="col-md-8">
                            <div class="row">
                                <div class='col-10 col-sm-12'>
                                    <div class="box-body">
                                        <table id="cmstable1" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>

                                                    <th>Fees Code </th>
                                                    <th>Fees Category</th>
                                                    <th>Package</th>
                                                    <th>Residency</th>
                                                    <th>Total Sem</th>
                                                    <th>Publish Fee</th>
                                                    <th>Promo Fee</th>
                                                    <th>Term</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>


                        </div>



                        <div class="col-md-4"> Step 2 : Fee Detail

                            <div class="col-12">

                                <div class="row">
                                    <div class="col-md-3"> <input type="text" class="form-control" id="txtSemNo" placeholder="sem no"></div>
                                    <div class="col-md-3"> <input type="text" class="form-control" id="txtFeeAmount" placeholder="fee amount"></div>
                                    <div class="col-md-3">
                                        <?= Html::dropDownList('FeeTypeId', null, Yii::$app->common->getFeeTypeForSetupList(), [
                                            'prompt' => '- 	Fee Type -',
                                            'class' => 'form-select mb-3',
                                            'id' => 'txtFeeTypeId'
                                        ]); ?>

                                    </div>
                                    <div class="col-sm-2">
                                        <div>
                                            <button type="button" class="btn btn-primary w-60" id="btn_FeeSetup"> <i class="ri-equalizer-fill me-2 align-bottom"></i>Save</button>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div id="listProgramFeeDetail"></div>
                            <p></p>

                            Step 3 :Request Approval

                            <p></p>

                            <!-- Step 4 :History -->
                            <!-- <div id="listProgramFeeDetailHistory"></div> -->


                        </div>

                    </div>


                </div>

            </div>

        </div>

    </div>





    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header align-items-center d-flex text-white bg-primary">
                    <h4 class="card-title mb-0 flex-grow-1  ">
                        <?= 'B : Program vs Fees' ?>
                    </h4>
                    <!-- <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <button id="New" class="showModal_New btn btn-success btn-sm" type="button"> New <i class="icon-file"></i></button>
                            <button id="Edit" class="showModal_Update btn btn-success btn-sm" type="button">Edit <i class="icon-file"></i></button>
                            <button id="View" class="showModal_View btn btn-success btn-sm" type="button"> View <i class="icon-file"></i></button>
                        </div>
                    </div> -->
                </div><!-- end card header -->

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">

                            <div class="row">
                                <div class='col-3 col-sm-3'>
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control search" id="txtSearchprogcode" placeholder="Search for program code..">
                                        </div>

                                        <div class="col-3 col-sm-3">
                                            <button type="button" class="btn btn-primary w-100" id="btn_searchprogram"> <i class="ri-equalizer-fill me-1 align-bottom"></i>Filters</button>
                                        </div>

                                    </div>


                                    <div class="box-body mt-2">
                                        <table id="cmstable2" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th> Program</th>
                                                    <th> Local</th>
                                                    <th> Int</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>


                                <div class="col-9">

                                    <div class="row">
                                        <div class="col-xl-12">
                                            <!-- <div class="card"> -->
                                            <div class="card-body">

                                                <h4>

                                                    <h5>
                                                        <div id="select_data_program"></div>
                                                    </h5>
                                                    <input type="hidden" name="select_data_program_id" id="select_data_program_id" />
                                                    <input type="hidden" name="select_residencyid" id="select_residencyid" />
                                                    <input type="hidden" name="select_feestructureid" id="select_feestructureid" />
                                                    <input type="hidden" name="select_ProgramIntId" id="select_ProgramIntId" />
                                                    <input type="hidden" name="select_ProgramTypeId" id="select_ProgramTypeId" />

                                                </h4>


                                                <div class="accordion" id="accordionExample">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingOne">
                                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                <div id="title_local"></div>
                                                            </button>
                                                        </h2>

                                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row">

                                                                    <div class="col-xl-4">

                                                                        <table id="cmstable-local" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Fee Category</th>
                                                                                </tr>
                                                                            </thead>
                                                                        </table>
                                                                    </div>


                                                                    <div class="col-xl-8">
                                                                        <div id='listProgramintake_local'> </div>
                                                                    </div>


                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingTwo">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                <div id="title_international"></div>
                                                            </button>
                                                        </h2>

                                                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">

                                                                <div class="row">
                                                                    <div class="col-xl-4">

                                                                        <table id="cmstable-international" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Fee Category</th>
                                                                                </tr>
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                    <div class="col-xl-8">
                                                                        <div id='listProgramintake_international'> </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>


                                            </div>
                                            <!-- </div> -->
                                        </div>
                                    </div>



                                </div>
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
$url = Url::toRoute(['/programfeejb/default/programfeecategorylist']);
$urlfee = Url::toRoute(['/programfeejb/default/programfeecategorydetaillist']);
$urlfeehistory = Url::toRoute(['/programfeejb/default/programfeecategorylisthistory']);
$create = Url::toRoute(['/programfeejb/default/create']);
$update = Url::toRoute(['/programfeejb/default/update']);
$view = Url::toRoute(['/programfeejb/default/view']);
$viewprogram = Url::toRoute(['/programfeejb/default/viewprogram']);
$viewstudent = Url::toRoute(['/programfeejb/default/viewstudent']);

$urlfee_save = Url::toRoute(['/programfeejb/programfeecategorydetail/create']);
$urlfee_remove = Url::toRoute(['/programfeejb/programfeecategorydetail/delete']);

$programvsfees = Url::toRoute(['/programfeejb/default/programvsfees']);

$view = Url::toRoute(['/programfeejb/default/view']);

$urlprogram = Url::toRoute(['/programfeejb/default/programlist']);

$urlprogramintake = Url::toRoute(['/programfeejb/default/programintakelist']);

$urlfeestructure = Url::toRoute(['/programfeejb/default/feestructure']);

$setfeegroupvsprogram = Url::toRoute(['/programfeejb/default/setfeegroupprogram']);

$removefeegroupvsprogram = Url::toRoute(['/programfeejb/default/removefeegroupprogram']);



$canFeeDetailSave = Yii::$app->user->can('ProgramFee-FeeDetail-Save');
$canFeeDetailDelete = Yii::$app->user->can('ProgramFee-FeeDetail-Delete');
$canProgramvsFeeSelect = Yii::$app->user->can('ProgramFee-ProgramvsFee-Select');
$canProgramvsFeeSetFeeGroup = Yii::$app->user->can('ProgramFee-ProgramvsFee-SetFeeGroup');



$script = <<<JS

/**********************************************************************************/

$(document).on('click', '#ProgramIntIdAll', function () {
    // Check all checkboxes when the "check all" checkbox is clicked

     
        $('input:checkbox').prop('checked', $(this).prop('checked'));
    });



$(document).on('click', '#removefeegroup', function () {

        var canProgramvsFeeSelect = '$canProgramvsFeeSelect';

        if(canProgramvsFeeSelect){

        var confirmDelete = confirm('Are you sure you want to delete this item?');

        if (confirmDelete) {

                event.preventDefault(); // stopping submitting
                var form = $('#programfees'); //form id
                $.ajax({
                    url: '$removefeegroupvsprogram',
                    type   : 'GET',   
                    dataType: 'json',
                    cache: false,     
                    data:{
                        // form:form.serialize(),         
                        ProgramIntId:this.value,
                        
                    } ,
                    
                    beforeSend: function() { },

                    success: function (response) {
                    
                    
                        // console.log(response.message);
                        if (response.status==1) {                     
                            //console.log(response.message);
                        toastr.options.timeOut = 1000; // 1.5s 
                        toastr.options = {
                            "closeButton": true,
                            "newestOnTop": true,
                            "preventDuplicates": true,               
                        }

                        toastr.success(response.message,"success"); 
                        //toastr.success("I do not think that means what you think it means.", "makan ");
                        $('#closeButton').click();

                        } else {
                            $.each(response, function (field, errors) {
                                var hasErrorSpan = $('.field-tbldepartment-' + field.toLowerCase());
                                var errorSpan = $(':input[name="tbldepartment[' + field + ']"]').closest('.form-group').find('.help-block');
                                errorSpan.text(errors.join(' '));
                                hasErrorSpan.addClass('has-error');
                                });

                        }

                        // if (response.status==2) {    
                        //     toastr.warning(response.message,"Error");      
                        


                                
                        //     //alert('Error creating resource: ' + response.data);
                        // }
                    },
                    complete: function() { },

                    error: function () {
                    // toastr.error("There may a error on uploading. Try again later","Error");    

                        
                    }
                });

                //to refresh intake 
                getProgramIntake_local();
                getProgramIntake_international();
                return false;
        }
    }else
    {
        alert('Sorry , your access is denied');
    }

});









$(document).on('click', '#btn_setfeegroup_xxx', function () {
                // Array to store checkbox values
                
                var checkboxValues = [];
                // Loop through checkboxes with class "myCheckbox"
                $(".myfeeintake").each(function(){
                    // Push the value of each checkbox to the array
                   if ($(this).is(":checked")) {
                        checkboxValues.push(this.value);
                   }
                });

                alert(checkboxValues);
                
            });


            $(document).on('click', '#closeButton', function () {

                getProgramIntake_local();
                getProgramIntake_international();
            });


            


$(document).on('click', '#btn_setfeegroup', function () {
 
    var canProgramvsFeeSetFeeGroup = '$canProgramvsFeeSetFeeGroup';

    if(canProgramvsFeeSetFeeGroup){
    
     var checkboxValues = [];
        // Loop through checkboxes with class "myCheckbox"
        $(".myfeeintake").each(function(){
            // Push the value of each checkbox to the array
            if ($(this).is(":checked")) {
                checkboxValues.push(this.value);
            }
        });

        $("#select_ProgramIntId").val(checkboxValues);       


   var form = $(this);
   $.ajax({
         url: '$setfeegroupvsprogram',
         type   : 'GET',
         data: {
            ProgramId: $("#select_data_program_id").val(),
            ResidencyId: $("#select_residencyid").val(),
            ProgramIntId:$("#select_ProgramIntId").val(),
            FeeStructureId:  $("#select_feestructureid").val(), 
            ProgramTypeId:  $("#select_ProgramTypeId").val(), 
             
         },
          success: function (response) 
         {     
             $("#modal-lg").modal("show");
             $("#modalContent-lg").html(response).modal();							
             document.getElementById('modalHeader-lg').innerHTML = '<h4>New Group Program Fee </h4>';    
             
             console.log(response);


            
         },
         error  : function (e) {
                 console.log(e);
         },

         complete: function() { 

          },


     });
  
 return false;     
    }else
    {
        alert('Sorry , your access is denied');
    }  

});



$('#txtSearch').on('keypress',function(e) {
    if(e.which == 13) {
		$("#btn_search").trigger('click');
    }
});


$('#txtSearchprogcode').on('keypress',function(e) {
    if(e.which == 13) {
		$("#btn_searchprogram").trigger('click');
    }
});




function getProgramFeeStructure_local(){

     $('#cmstable-local').dataTable().empty();
      
      var table5 = $('#cmstable-local').DataTable({
          
          lengthChange:false, processing: true,
          deferRender:true,	ordering:false,
          searching:false, destroy:true, //pageLength: 25,
          paging:false,         
          ajax: { 
              url: '$urlfeestructure?residency='+1+'&programid='+$("#select_data_program_id").val(),    
               
              type: 'GET',
            //   data: {
            //     txtprogramid:$("#select_data_program_id").val(),
            //       }
                },
                
      
          "columns": [
              {"data":"FeeStructureName",
                'render': function(data, type, row) {
                    if (row.IntakeFeeId2>0) {                                              
                        return row.FeeStructureName +'<i class="ms-2 fas fa-check fa-lg" style="color: green;"></i>';
                    } else {
                        return row.FeeStructureName;
                    }
                }
            },

                                           
              
          ]
      });


      $('#cmstable-local tbody').on('click', 'tr', function() {
    // console.log(table.row(this).data());

    var table = $('#cmstable-local').DataTable();
      console.log(table.row(this).data());


      if ($(this).hasClass('row_selected5')) {
          $(this).removeClass('row_selected5');
      } else {
          table.$('tr.row_selected5').removeClass('row_selected5');
          $(this).addClass('row_selected5');
      }
      var d = table.row(this).data();
      var y = d['FeeStructureId'];

      $('#select_residencyid').val(1);
      $('#select_feestructureid').val(y);
      getProgramIntake_local();
      });

     

}




function getProgramFeeStructure_international(){

$('#cmstable-international').dataTable().empty();
 
 var table5 = $('#cmstable-international').DataTable({
     
     lengthChange:false, processing: true,
     deferRender:true,	ordering:false,
     searching:false, destroy:true, //pageLength: 25,
     paging:false,
    //scrollY: true,// responsive:true,
     ajax: { 
         url: '$urlfeestructure?residency='+2+'&programid='+$("#select_data_program_id").val(),  
          
         type: 'GET',
       //   data: {
       //     txtprogramid:$("#select_data_program_id").val(),
       //       }
           },
           
 
           "columns": [
              {"data":"FeeStructureName",
                'render': function(data, type, row) {
                    if (row.IntakeFeeId2>0) {                                              
                        return row.FeeStructureName +'<i class="ms-2 fas fa-check fa-lg" style="color: green;"></i>';
                    } else {
                        return row.FeeStructureName;
                    }
                }
            },
                      
         
     ]
 });


    $('#cmstable-international tbody').on('click', 'tr', function() {
        // console.log(table.row(this).data());
        var table = $('#cmstable-international').DataTable();
        console.log(table.row(this).data());

        if ($(this).hasClass('row_selected6')) {
            $(this).removeClass('row_selected6');
        } else {
            table.$('tr.row_selected6').removeClass('row_selected6');
            $(this).addClass('row_selected6');
        }
        var d = table.row(this).data();
        var y = d['FeeStructureId'];
        
        $('#select_residencyid').val(2);
        $('#select_feestructureid').val(y);
        getProgramIntake_international();

        });

    
}


//*Program vs Fees****************************************************************************** */

$('#title_local').click(function () {

    $("#listProgramintake_local").empty();
    $("#listProgramintake_international").empty();

});

$('#title_international').click(function () {

$("#listProgramintake_local").empty();
$("#listProgramintake_international").empty();

});

$('#btn_searchprogram').click(function () {

$('#cmstable2').dataTable().empty();
          
  var table = $('#cmstable2').DataTable({
      
      lengthChange:false, processing: true,
      deferRender:true,	ordering:false,
      searching:false, destroy:true,pageLength: 25,
     // paging:true,//scrollY: true,// responsive:true,
      ajax: { 
          url: '$urlprogram',
          type: 'GET',
          data: {
             txtSearchprogcode:$("#txtSearchprogcode").val(),
              }
            },

   
  
      "columns": [
          {"data":"programcode"},
          
          {"data":"localfee",
          'render': function(data) {
                    if (data == 1) {                        
                        return '<div style="text-align: center;"><i class="fas fa-check fa-lg" style="color: green;"></i></div>';
                    } else {
                        return '<div style="text-align: center;"><i class="fas fa-times fa-lg" style="color: red;"></i></div>';
                    }
                }
            },
         

        {"data":"intfee",
                'render': function(data) {
                            if (data == 1) {                                
                                return '<div style="text-align: center;"><i class="fas fa-check fa-lg" style="color: green;"></i></div>';
                            } else {                                
                                return '<div style="text-align: center;"><i class="fas fa-times fa-lg" style="color: red;"></i></div>';                                
                            }
                        }
                    },
        ]
  });

  

$('#cmstable2 tbody').on('click', 'tr', function() {
// console.log(table.row(this).data());

var table = $('#cmstable2').DataTable();
      console.log(table.row(this).data());


      if ($(this).hasClass('row_selected2')) {
          $(this).removeClass('row_selected2');
      } else {
          table.$('tr.row_selected2').removeClass('row_selected2');
          $(this).addClass('row_selected2');
      }
  
        var d = table.row(this).data();
      
      //var x = d['CategoryCode']+';'+d['CategoryCode']+';'+d['CategoryCode']+';'+d['CategoryCode'];
      
      var x = '&emsp;'+d['ProgCodeName'];
      var y = d['ProgramId'];
      var z = d['ProgramType'];

      
      
      $('#select_data_program').html(x);
      $('#select_data_program_id').val(y);
      $('#select_ProgramTypeId').val(z);

      $('#title_local').html("Local Fees : "+x);
      $('#title_international').html("International Fees : "+x);

   
      $("#listProgramintake_local").empty();
      $("#listProgramintake_international").empty();
        
        
    //    getProgramIntakeFees();
       getProgramFeeStructure_local();
       getProgramFeeStructure_international();


    
     

      });

    });


//**Program Intake ***************************************************************************** */

function getProgramIntake_local(){
     
    
    $("#listProgramintake_local").empty();

    $.ajax({           
        type: 'GET',
        url: '$urlprogramintake',
        // dataType: 'json',
            data: {
                
                txtfeestructureid:$("#select_feestructureid").val(),    
                txtresidencyid:$("#select_residencyid").val(),    
                txtprogramid:$("#select_data_program_id").val(),    
                  
                    },
            success: function(data) {

                $('#listProgramintake_local').html(data);
                    
                
            }
    });

    
    
}



function getProgramIntake_international(){
    
    
    $("#listProgramintake").empty();

    $.ajax({           
        type: 'GET',
        url: '$urlprogramintake',
        // dataType: 'json',
            data: {
                txtfeestructureid:$("#select_feestructureid").val(),   
                txtresidencyid:$("#select_residencyid").val(),                                       
                txtprogramid:$("#select_data_program_id").val(),      
                    },
            success: function(data) {

                $('#listProgramintake_international').html(data);
                    
                
            }
    });

    
    
}


//******************************************************************************* */

$('#btn_FeeSetup').click(function () {
    

    var canFeeDetailSave = '$canFeeDetailSave';

    if(canFeeDetailSave){
        $.ajax({           
                type: 'POST',
                url: '$urlfee_save',
                // dataType: 'json',
                    data: {
                        _csrf: yii.getCsrfToken(),
                        txtSemNo:$("#txtSemNo").val(),     
                        txtFeeAmount:$("#txtFeeAmount").val(),          
                        txtFeeTypeId:$("#txtFeeTypeId").val(),  
                        txtProgFeeCatId:$("#select_id").val(),                        
                            },

                    beforeSend: function() { },


                    success: function(response) {

                       
                        // console.log(response.message);
                        if (response.status==1) {                     
                            
                            toastr.options.timeOut = 1000; // 1.5s 
                            toastr.options = {
                            "closeButton": true,
                            "newestOnTop": true,
                            "preventDuplicates": true,               
                            }

                            toastr.success(response.message,"Success"); 
                            // $('#closeButton').click();
                        } else {
                            toastr.warning(response.message,"Success"); 
                            // $('#closeButton').click();

                            }

                            getProgramFeeDetail();

                       
                    },
                    complete: function() {
                       
                    },
                    error: function () {
                        // toastr.error("There may a error on uploading. Try again later","Error");    

                     }
                });
            }else
            {
                alert('Sorry , your access is denied');
            }
    });



$(document).off('click', '.ProgramFee_Delete').on('click', '.ProgramFee_Delete', function () {

    var canFeeDetailDelete = '$canFeeDetailDelete';

    if(canFeeDetailDelete){

    var ProgFeeCatDetailId = $(this).attr('value'); 

$.ajax({           
        type: 'POST',
        url: '$urlfee_remove',
        // dataType: 'json',
            data: {
                _csrf: yii.getCsrfToken(),
                ProgFeeCatDetailId:ProgFeeCatDetailId,     
                
                    },
            success: function(data) {

              ///  $('#listProgramFeeDetail').html(data);
                    
             getProgramFeeDetail();
            }
        });
    }else
    {
        alert('Sorry , your access is denied');
    }
});



$('#btn_search').click(function () {

	
	  $('#select_id').html('');
      $('#select_data').html('');
      $('#cmstable1').dataTable().empty();
			    
		var table = $('#cmstable1').DataTable({
            
            lengthChange:false,			processing: true,
			deferRender:true,	
            ordering:false,
            		searching:false,
			// responsive:true,				
			destroy:true,			pageLength: 12,
			paging:true,			scrollY: true,  
            // autoWidth: true, 
			//dom: 'Bfrtip',                      
			ajax: { 
				url: '$url',
				type: 'GET',
				data: {
                    txtSearch:$("#txtSearch").val(),
                    txtTermTypeId:$("#txtTermTypeId").val(),
                    txtStatusId:$("#txtStatusId").val(),
                    txtResidency:$("#txtResidency").val(),
                    txtProgramTypeId:$("#txtProgramTypeId").val(),
                            
					}
			},
           
		
			"columns": [
                {"data":"ProgFeeCode"},
                {"data":"ProgFeeCatTitle"},	                            			
				{"data":"ProgFeePackage"},														
				{"data":"Residency"},
				{"data":"TotalSem"},                
                {"data":"TotalPublishFee"},
                {"data":"TotalPromoFee"},               
                {"data":"TermType"},
                {"data":"Status"},

                {"data": "",
                 "render": function ( data, type, row, meta ) { 
                     return '<div class="dropdown">'+
                     '<a class="btn btn-sm  btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Action</a>'+
                     '<ul class="dropdown-menu">'+
 	                 '<li><a class="dropdown-item showModal_View" href="#">View</a></li>'+
                     '<li><a class="dropdown-item showModal_Update " href="#">Edit</a></li>'+
                     '<li><a class="dropdown-item showModal_Program " href="#">Program</a></li>'+
                     '<li><a class="dropdown-item showModal_Student" href="#">Student</a></li>'+
                     '</ul>'+
                     '</div>';
                     }
             },
                
			]
		});



	$('#cmstable1 tbody').on('click', 'tr', function() {
     // console.log(table.row(this).data());
			

			var table = $('#cmstable1').DataTable();
			console.log(table.row(this).data());
   
  
			if ($(this).hasClass('row_selected1')) {
				$(this).removeClass('row_selected1');
			} else {
				table.$('tr.row_selected1').removeClass('row_selected1');
				$(this).addClass('row_selected1');
			}
        
		               	var d = table.row(this).data();
			
			//var x = d['CategoryCode']+';'+d['CategoryCode']+';'+d['CategoryCode']+';'+d['CategoryCode'];
            var w = d['ProgramTypeId'];	
			var x = d['ProgFeeCatTitle'];
			var y = d['ProgFeeCatId'];
            var z = d['ProgramId'];
          
			$('#select_data').html(x);
			$('#select_id').val(y);
            $('#select_progid').val(z);
            $('#select_progtype').val(w);
            

            getProgramFeeDetail();
            getProgramFeeDetailHistory();
		
			});

            

  });



  /**********************************************************************************/


  
    /* Get table value */
    function getProgramFeeDetail(){

            $.ajax({           
            type: 'GET',
            url: '$urlfee',
            // dataType: 'json',
                data: {
                    ProgFeeCatDetailId:$("#select_id").val(),                                     
                        },
                success: function(data) {

                    $('#listProgramFeeDetail').html(data);
                        
                    
                }
            });

   }

   
  /**********************************************************************************/


  
    /* Get table value */
    function getProgramFeeDetailHistory(){

        $.ajax({           
        type: 'GET',
        url: '$urlfeehistory',
        // dataType: 'json',
            data: {
                ProgFeeCatId:$("#select_id").val(),                                     
                    },
            success: function(data) {

                $('#listProgramFeeDetailHistory').html(data);
                    
                
            }
    });

}

   


  //https://makitweb.com/add-edit-delete-button-in-yajra-datatables-laravel/


//   $(document).on('click', '.showModalButtonxx2', function () {
	  
//          var url = '/feetype/update/2';
//         $.ajax({
//             type: 'GET',
//             url: url,
//             success: function (output) {
// 				$('#modal').modal('show')
//                 $('#modalContent').html(output).modal('show');//now its working
// 				document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';		
//             },
//             error: function(output){
//             alert("fail");
//             }
//         });
//     });


/****btn_FeeSetup*********************************************************************************/

$(document).on('click', '.btn_FeeSetup', function () {
 

 //  alert($("#select_progid").val());

   var form = $(this);
   $.ajax({
         url: '$create',
         type   : 'GET',
         data: {
             // ProgramId: $("#select_progid").val(),
             // ProgramTypeId: $("#select_progtype").val(),
             
              },
          success: function (response) 
         {     
             $("#modal-lg").modal("show");
             $("#modalContent-lg").html(response).modal();							
             document.getElementById('modalHeader-lg').innerHTML = '<h4>New Group Program Fee </h4>';    
             
             console.log(response);
         },
         error  : function (e) {
                 console.log(e);
         }
     });
 return false;        
});




/***showModal_ProgvsFees**********************************************************************************/

$(document).on('click', '.showModal_ProgvsFees', function () {
    alert ("on Click");
   var form = $(this);
   $.ajax({
         url: '$programvsfees',
         type   : 'GET',
         data: {},
          success: function (response) 
         {     
             $("#modal-xl").modal("show");
             $("#modalContent-xl").html(response).modal();							
             document.getElementById('modalHeader-xl').innerHTML = '<h4> Program vs Fees </h4>';    
             
            // console.log(response);
         },
         error  : function (e) {
                 console.log(e);
         }
     });
 return false;        
});



/*************************************************************************************/

$(document).on('click', '.showModal_New', function () {
 

    //  alert($("#select_progid").val());

      var form = $(this);
      $.ajax({
	    	url: '$create',
            type   : 'GET',
			data: {
                // ProgramId: $("#select_progid").val(),
                // ProgramTypeId: $("#select_progtype").val(),
                
                 },
             success: function (response) 
            {     
				$("#modal-lg").modal("show");
                $("#modalContent-lg").html(response).modal();							
				document.getElementById('modalHeader-lg').innerHTML = '<h4>New Group Program Fee </h4>';    
				
				console.log(response);
            },
            error  : function (e) {
				    console.log(e);
            }
        });
    return false;        
  });


  /**********************************************************************************/
	$(document).on('click', '.showModal_View', function () {
      var form = $(this);
      $.ajax({
	    	url: '$view',
            type   : 'GET',
			data: {
                ProgFeeCatId: $("#select_id").val(),
                 },
             success: function (response) 
            {     
				$('#modal-lg').modal('show');
                $('#modalContent-lg').html(response).modal();							
				document.getElementById('modalHeader-lg').innerHTML = '<h4>View Group Program Fee</h4>';
               // document.getElementById('modalHeader-xl').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';	
				//console.log(response);
            },
            error  : function (e) {
				    console.log(e);
            }
        });
    return false;        
  });


  
  /**********************************************************************************/


	$(document).on('click', '.showModal_Program', function () {
	
    // alert('Program--->Inprogress');  

    var form = $(this);
      $.ajax({
	    	url: '$viewprogram',
            type   : 'GET',
			data: {
                ProgFeeCatId: $("#select_id").val(),
                 },
             success: function (response) 
            {     
				$('#modal-xl').modal('show');
                $('#modalContent-xl').html(response).modal();							
				document.getElementById('modalHeader-xl').innerHTML = '<h4>Program</h4>';
               // document.getElementById('modalHeader-xl').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';	
				//console.log(response);
            },
            error  : function (e) {
				    console.log(e);
            }
        });
    return false;   
 });
  
  /**********************************************************************************/

    $(document).on('click', '.showModal_Student', function () {
        
    // alert('Student-->Inprogress');  

    var form = $(this);
      $.ajax({
	    	url: '$viewstudent',
            type   : 'GET',
			data: {
                ProgFeeCatId: $("#select_id").val(),
                 },
             success: function (response) 
            {     
				$('#modal-xl').modal('show');
                $('#modalContent-xl').html(response).modal();							
				document.getElementById('modalHeader-xl').innerHTML = '<h4>Student</h4>';
               // document.getElementById('modalHeader-xl').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';	
				//console.log(response);
            },
            error  : function (e) {
				    console.log(e);
            }
        });
    return false;  

    });
 
  /**********************************************************************************/


	$(document).on('click', '.showModal_Update', function () {
	
      var form = $(this);
      $.ajax({
	    	url: '$update',
            type   : 'GET',
			data: {
                ProgFeeCatId: $("#select_id").val(),
                 },
                 success: function (response) 
            {                     
                $('#modal-lg').modal('show');
                $('#modalContent-lg').html(response).modal();							
				document.getElementById('modalHeader-lg').innerHTML = '<h4>Edit Group Program Fee</h4>';
            },
            error  : function (e) {
				   // console.log(e);
            }
        });
    return false;        
  });


	$(document).on('click', '.rowClick', function () {
	
        $('#select_id').val($(this).attr('value'));
        getProgramFeeDetail();
    });


    $(document).on('click', '.scrollTop', function () {
        document.getElementById('txtSearch').value = $(this).attr('value');
        $('#btn_search').click();
        event.preventDefault();
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE, and Opera

    });

  /***************************************https://metamug.com/docs/examples/file-upload-ajax*******************************************/


JS;
$this->registerJs($script);


?>