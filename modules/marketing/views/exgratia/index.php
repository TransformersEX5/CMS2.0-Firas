<?php

use app\models\tbluser;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\VarDumper;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Ex-gratia');
$this->params['breadcrumbs'][] = $this->title;
?>


<style>
    /* Datatable..droupdown menu  */
    .table-responsive,
    .dataTables_scrollBody {
        overflow: visible !important;
    }
</style>
<div class="tbluser-index">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex text-white bg-warning   ">
                    <h4 class="card-title mb-0 flex-grow-1">
                        <?= $this->title ?>
                    </h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <button id="showModal_Report_P1" class="showModal_Report_P1 btn btn-success btn-sm" type="button"> Ex gratia - P1 <i class="icon-file"></i></button>
                            <button id="showModal_Report_P2" class="showModal_Report_P2 btn btn-success btn-sm" type="button"> Ex gratia - P2 <i class="icon-file"></i></button>
                            <!-- // <a class="btn btn-success btn-sm" href="<?= Url::toRoute(['/reportgallery/report?rpt=2_rpt_marketing_p1.php']) ?>" target="_blank"> Report Summary</a> -->
                            <!-- <button id="CreateGroup" class="showModal_CreateGroup btn btn-success btn-sm" type="button">Group<i class="icon-file"></i></button> -->
                            <!-- <button id="View" class="showModal_Statement btn btn-success btn-sm" type="button"> Statement <i class="icon-file"></i></button> -->

                            <!-- <a class="btn btn-success btn-sm" href="<?= Url::toRoute(['/reportgallery/report?rpt=1_rpt_student_statement.php']) ?>" target="_blank"> Report Summary</a> -->

                            <!-- <button id="Permission" class="showModal_Permission btn btn-success btn-sm" type="button"> Follow-up <i class="icon-file"></i></button> -->
                        </div>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">

                    <!-- Content here Start -->

                    <div class="row g-3">
                        <div class="col-xl-6">
                            <div class="search-box">
                                <input type="text" class="form-control search" id="txtSearch" placeholder="Search for name / NIRC /Passport...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <!--end col-->

                        <div class="col-xl-6">
                            <div class="row g-3">
                                <div class="col-sm-4">
                                    <div>
                                        <?= Html::dropDownList('StatusId', null, Yii::$app->common->getStudentstatus(), [
                                            'prompt' => '- Status -',
                                            'class' => 'form-select mb-3',
                                            'id' => 'txtStatusId'
                                        ]) ?>
                                    </div>
                                </div>
                                <!--end col-->
                                <!-- <div class="col-sm-4">
                                    <div>
                                        <?= Html::dropDownList('DeptCatId', null, Yii::$app->common->getDepartmentcategory(), [
                                            'prompt' => '- Category -',
                                            'class' => 'form-select mb-3',
                                            'id' => 'txtDeptCatId'
                                        ]) ?>

                                    </div>
                                </div> -->
                                <!--end col-->

                                <div class="col-sm-4">
                                    <div>
                                        <button type="button" class="btn btn-primary w-100" id="btn_search"> <i class="ri-equalizer-fill me-2 align-bottom"></i>Filters</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4>
                                    <div id="select_data"></div>
                                </h4>
                                <input type="hidden" name="userid" id="userid" value=<?php echo Yii::$app->user->identity->UserId ?> />
                                <input type="hidden" name="select_id" id="select_id" />
                                <input type="hidden" name="programregid" id="programregid" />
                                <input type="hidden" name="qfrom" id="qfrom" />
                                <input type="hidden" name="userno" id="userno" /> 


                            </div>
                        </div>
                    </div>

                    <!-- Datatable Start -->
                    <div class="row">
                        <div class='col-12 .col-sm-12 mb-2'>
                            <div class="row">
                                <div class='col-12 .col-sm-12 mb-2'>
                                    <div class="box-body">
                                        <table id="cmstable1" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Stud No</th>
                                                    <th>Stud No</th>
                                                    <th>Name </th>
                                                    <th>Program</th>
                                                    <th>Application <br> Fee / Paid</th>
                                                    <th>Regstartion <br> Fee / Paid</th>
                                                    <th>Status</th>
                                                    <th>P1-Claim</th>
                                                    <th>Sem One <br> Fee / Paid</th>
                                                    <th>P2-Claim</th>
                                                    <th>SBS</th>
                                                    <th>Agent</th>
                                                    <th>Marketing</th>


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
    </div>




    <?php


    $urlexgratia_sp = Url::toRoute(['/marketing/exgratia/getclaimexgratiap1list_sp']);

    $urlexgratia = Url::toRoute(['/marketing/exgratia/getclaimexgratiap1list']);

    $urlclaim_p1 = Url::toRoute(['/marketing/exgratia/getclaimexgratiap1']);

    $urlclaim_p2 = Url::toRoute(['/marketing/exgratia/getclaimexgratiap2']);


    $rpt_param_p1 = Url::toRoute(['/marketing/exgratia/rpt_param_p1']);
    
    $rpt_param_p2 = Url::toRoute(['/marketing/exgratia/rpt_param_p2']);

    $script = <<<JS


$('#btn_search').click(function () {

    
	
$('#select_id').html('');
$('#select_data').html('');
$('#cmstable1').dataTable().empty();
          
  var table = $('#cmstable1').DataTable({

      lengthChange:false,processing: true,
      deferRender:true,searching:true,
      responsive:true,				
      destroy:true,pageLength: 25,
      paging:true,scrollY: true,   
      // dom: 'Bfrtip',                      
      ajax: { 
          url: '$urlexgratia',
          type: 'GET',
          data: {
              txtSearch:$("#txtSearch").val(),
                      
              }
      },
  
      "columns": [
        
          {"data":"QFrom" },
          {"data":"StudentNo" ,"width": '6%'},
          {"data":"StudName"},	
          {"data":"ProgramCode" ,"width": '6%'},
          {"data":"ApplyFeePaid"},	              
          {"data":"RegistFeePaid"},
          {"data":"StatusName" ,"width": '6%', className: "text-center"},
        //   {"data":"CanClaimP1"},
          
          {"data": "CanClaimP1",
                "render": function ( data, type, row, meta ) { 
                    if(data=='Claim P1'){
                       return ' <button type="button"  value="'+data+'" class="btn btn-primary btn-sm showModal_Claim_P1" >'+data+'</button>';
                    }else{
                        return data;
                    }                    
                }
          },          
          
          {"data":"SemOnePaid"},	
          {"data": "CanClaimP2",
                "render": function ( data, type, row, meta ) { 
                    if(data=='Claim P2'){
                      return ' <button type="button"  value="'+data+'" class="btn btn-primary btn-sm showModal_Claim_P2" >'+data+'</button>';
                    }else{
                        return data;
                    }                    
                }
          },
          {"data":"SBS"},
          {"data":"Agents"},
          
          
          {"data":"FullName"},
          
      ]
  });
      
                  
$('#cmstable1 tbody').on('click', 'tr', function() {
// console.log(table.row(this).data());		

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
      var x = d['StudName'];
      var y = d['StudentId'];
      var z = d['ProgramRegId'];
      var qfrom = d['QFrom'];
      var userno = d['UserNo'];

      $('#select_data').html(x);
      $('#select_id').val(y);
      $('#programregid').val(z);
      $('#qfrom').val(qfrom);
      $('#userno').val(userno);

      
  
      });

});





$(document).on('click', '.showModal_Report_P1', function () {
    
    var form = $(this);
      $.ajax({
	    	url: '$rpt_param_p1',
            type   : 'GET',
			data: {
               // UserId: $("#select_id").val(),
                 },
             success: function (response) 
            {     
				$('#modal-md').modal('show');
                $('#modalContent-md').html(response).modal();							
				document.getElementById('modalHeader-md').innerHTML = '<h4>Ex gratia - P1</h4>';
               // document.getElementById('modalHeader-xl').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';	
				//console.log(response);
            },
            error  : function (e) {
				  ///  console.log(e);
            }
        });
    return false;        

    });

$(document).on('click', '.showModal_Report_P2', function () {
    
    var form = $(this);
      $.ajax({
	    	url: '$rpt_param_p2',
            type   : 'GET',
			data: {
               // UserId: $("#select_id").val(),
                 },
             success: function (response) 
            {     
				$('#modal-md').modal('show');
                $('#modalContent-md').html(response).modal();							
				document.getElementById('modalHeader-md').innerHTML = '<h4>Ex gratia - P2</h4>';
               // document.getElementById('modalHeader-xl').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';	
				//console.log(response);
            },
            error  : function (e) {
				  ///  console.log(e);
            }
        });
    return false;        

    });


$(document).on('click', '.showModal_Claim_P1', function () {
    

   var form = $(this);

                $.ajax({
                        url: '$urlclaim_p1?id='+$("#programregid").val()+'&qfrom='+$("#qfrom").val()+'&userno='+$("#userno").val(),                        
                        type   : 'POST',
                        dataType: 'json',
                        data: {
                         _csrf: yii.getCsrfToken(),
                           },
                       success: function (response)  {                     
                         
                         alert("successfully");
                         $('#cmstable1').DataTable().ajax.reload();                        
                    
                        },
                        error  : function (e) {
                                console.log(e);
                        }
                    });
                return false;  
            
   });





   $(document).on('click', '.showModal_Claim_P2', function () {
    

    var form = $(this);
 
                 $.ajax({
                    url: '$urlclaim_p2?id='+$("#programregid").val()+'&qfrom='+$("#qfrom").val()+'&userno='+$("#userno").val(),                              
                         type   : 'POST',
                         dataType: 'json',
                         data: {
                          _csrf: yii.getCsrfToken(),
                            },
                        success: function (response)  {                     
                          
                          alert("successfully");
                          $('#cmstable1').DataTable().ajax.reload();                        
                     
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