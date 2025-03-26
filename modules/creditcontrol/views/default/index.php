<?php

use app\models\tbluser;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\VarDumper;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Credit Control ');
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
                            <!-- <button id="New" class="showModal_New btn btn-success btn-sm" type="button"> New <i class="icon-file"></i></button> -->
                            <button id="CreateGroup" class="showModal_CreateGroup btn btn-success btn-sm" type="button">Group<i class="icon-file"></i></button>
                            <button id="View" class="showModal_Statement btn btn-success btn-sm" type="button"> Statement <i class="icon-file"></i></button>

                            <a class="btn btn-success btn-sm" href="<?= Url::toRoute(['/reportgallery/report?rpt=1_rpt_student_statement.php']) ?>" target="_blank"> Report Summary</a>

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
                                <input type="hidden" name="select_outs" id="select_outs" />
                                <input type="hidden" name="select_academicaging" id="select_academicaging" />
                                <input type="hidden" name="select_StatusName" id="select_StatusName" />
                                <input type="hidden" name="select_debtstudid" id="select_debtstudid" />
                                <input type="hidden" name="select_ownerid" id="select_ownerid" />
                                <input type="hidden" name="select_followupid" id="select_followupid" />
                            </div>
                        </div>
                    </div>

                    <button type="button" value='0.0-30' class="btn btn-success btn_OutsAmt">0-30</button>
                    <button type="button" value='31-60' class="btn btn-success btn_OutsAmt">31-60</button>
                    <button type="button" value='61-90' class="btn btn-success btn_OutsAmt">61-90</button>
                    <button type="button" value='91-100' class="btn btn-warning btn_OutsAmt">91-100</button>
                    <button type="button" value='101-150' class="btn btn-warning btn_OutsAmt">101-150</button>
                    <button type="button" value='151-200' class="btn btn-warning btn_OutsAmt">151-200</button>
                    <button type="button" value='201-300' class="btn btn-danger btn_OutsAmt">201-300</button>
                    <button type="button" value='301-600' class="btn btn-danger btn_OutsAmt">301-600</button>
                    <button type="button" value='601-10000000' class="btn btn-danger btn_OutsAmt">601-Above</button>
                    <button type="button" value='followup' class="btn btn-info btn_FollowUp">Follow-Up</button>

                    <?php
                    foreach ($btngroupmodel as $btngroupmodel) {
                        echo  '<button type="button" value="' . $btngroupmodel['DebtGroupId'] . '"class="btn btn-primary btn_DebtGroup me-1">' . $btngroupmodel['DebtGroupName'] . '</button>';
                    }

                    ?>



                    <!-- Datatable Start -->
                    <div class="row">
                        <div class='col-8 .col-sm-12 mb-2'>
                            <div class="row">
                                <div class='col-12 .col-sm-12 mb-2'>
                                    <div class="box-body">
                                        <table id="cmstable1" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>NRIC/Passport</th>
                                                    <th>Stud Status</th>
                                                    <th>Program</th>
                                                    <th>Outs</th>
                                                    <th>Aging</th>
                                                    <th>Group</th>
                                                    <th>.:.</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>


                                <div class='col-12 .col-sm-12 mb-2'>
                                    <div class="box-body">
                                        <div class="d-flex justify-content-sm-end mb-2">
                                            <button id="Followup" class="showModal_Followup btn btn-success btn-sm " type="button"> Follow-up/Action Taken </button>
                                        </div>
                                        <table id="cmstable2" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Follow Up</th>
                                                    <th>Action Remarks</th>
                                                    <th>Feedback Remarks</th>
                                                    <th>Remainder Remarks</th>
                                                    <th>Outs</th>
                                                    <th>Staff</th>
                                                    <th>Transaction</th>
                                                    <th>.:.</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class='col-4 .col-sm-12 mb-2'>
                            <div class="card">
                                <div class="card-body">
                                    <!-- <h4 class="card-title">Custom Tabs</h4>
                                    <p class="card-title-desc">Example of custom tabs</p> -->

                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                <span class="d-none d-sm-block">Profile</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                <span class="d-none d-sm-block">Statement</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab">
                                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                <span class="d-none d-sm-block">Messages</span>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#settings1" role="tab">
                                                <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                                <span class="d-none d-sm-block">Action</span>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#remainder1" role="tab">
                                                <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                                <span class="d-none d-sm-block">Remainder</span>
                                            </a>
                                        </li>

                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active p-3" id="home1" role="tabpanel">

                                            <p class="mb-0">
                                            <div id="Personaldetail">Profile</div>
                                            </p>

                                        </div>
                                        <div class="tab-pane p-3" id="profile1" role="tabpanel">
                                            <p class="mb-0">
                                            <div id="Statement">Statement</div>
                                            </p>
                                        </div>


                                        <div class="tab-pane p-3" id="messages1" role="tabpanel">

                                            <div class="row">
                                                <div class='col-8'>
                                                    <div>This messages can be seen by everyone</div>
                                                </div>
                                                <div class='col-4 d-flex justify-content-sm-end'>
                                                    <button type="button" value='0.0-30' class="showModal_Messages btn btn-sm btn-success btn_messages">Add Messages</button>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class='col-12'>
                                                    Remarks :<b>
                                                        <div id="stud_remarks"></div>
                                                    </b>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane p-3" id="settings1" role="tabpanel">
                                            <div class="row">
                                                <div class='col-12'>
                                                    <div>To Block and unblock student access </div><br>
                                                    1- Auto Block Access if Outstanding <br>
                                                    2- Unblock only for 7 days. <br>
                                                    3- All block/unblock transaction will be recorded.
                                                </div>
                                                <div class='col-4 d-flex justify-content-sm-end'>

                                                </div>
                                            </div>

                                            <div class="row m-3">
                                                <div class='col-8'>
                                                    Time Table and LMS : Block
                                                </div>

                                                <div class='col-4 d-flex justify-content-sm-end'>
                                                    <button type="button" value='0.0-30' class="showModal_TimeTable_Block btn btn-sm btn-success btn_messages">Action</button>
                                                </div>
                                            </div>
                                            <div class="row  m-3">
                                                <div class='col-12'>
                                                    Remarks :<b>
                                                        <div id="stud_remarks"></div>
                                                    </b>
                                                </div>
                                            </div>

                                            <div class="row m-3">
                                                <div class='col-8'>
                                                    Exam Dockat :Open
                                                </div>
                                                <div class='col-4 d-flex justify-content-sm-end'>
                                                    <button type="button" value='0.0-30' class="showModal_ExamDocket_Block btn btn-sm btn-success btn_messages">Action</button>
                                                </div>
                                            </div>
                                            <div class="row  m-3">
                                                <div class='col-12'>
                                                    Remarks :<b>
                                                        <div id="stud_remarks"></div>
                                                    </b>
                                                </div>
                                            </div>


                                            <div class="row m-3">
                                                <div class='col-8'>
                                                    Exam Result :Open
                                                </div>
                                                <div class='col-4 d-flex justify-content-sm-end'>
                                                    <button type="button" value='0.0-30' class="showModal_ExamResult_Block btn btn-sm btn-success btn_messages">Action</button>
                                                </div>
                                            </div>
                                            <div class="row  m-3">
                                                <div class='col-12'>
                                                    Remarks :<b>
                                                        <div id="stud_remarks"></div>
                                                    </b>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane p-3" id="remainder1" role="tabpanel">

                                            <div class="row">
                                                <div class='col-8'>
                                                    <div>This messages can be seen by everyone remainder1</div>
                                                </div>
                                                <div class='col-4 d-flex justify-content-sm-end'>
                                                    <button type="button" value='0.0-30' class="showModal_Messages btn btn-sm btn-success btn_messages">Add Messages</button>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class='col-12'>
                                                    Remarks :<b>
                                                        <div id="stud_remarks"></div>
                                                    </b>
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
    </div>
</div>




<?php
/**********************************************************************************/
$url = Url::toRoute(['/creditcontrol/default/creditcontrollist']);
$urlfollowuplist = Url::toRoute(['/creditcontrol/default/followuplist']);

$followup = Url::toRoute(['/creditcontrol/followup/followup']);
$followupview = Url::toRoute(['/creditcontrol/followup/followupview']);
$followupdelete = Url::toRoute(['/creditcontrol/followup/followupdelete']);

$program_reg_remarks = Url::toRoute(['/creditcontrol/default/programregremarks']);


$pickthis = Url::toRoute(['/creditcontrol/default/pickthis']);
$removefromgroup = Url::toRoute(['/creditcontrol/default/removefromgroup']);
$creategroup = Url::toRoute(['/creditcontrol/default/groupcreate']);

$messages = Url::toRoute(['/creditcontrol/default/messages']);

$timetable_block = Url::toRoute(['/creditcontrol/blockaccess/blockaccesstimetabletupdate']);
$examresult_block = Url::toRoute(['/creditcontrol/blockaccess/blockaccessexamresultupdate']);
$examdocket_block = Url::toRoute(['/creditcontrol/blockaccess/blockaccessexamdocketupdate']);


$update = Url::toRoute(['/user/update']);
$view = Url::toRoute(['/user/view']);
$permission = Url::toRoute(['/user/permission']);
$rpestsement = Url::toRoute(['/reportgallery/report']);

// outstanding tblprogramregister
// bank detail international only
// no china
$sendemail = Url::toRoute(['/creditcontrol/default/sendemail']);
$_csrf = Yii::$app->request->getCsrfToken();


$script = <<<JS

/**********************************************************************************/

$(document).ready(function(){    

refreshDatatable();
$('#Personaldetail').empty();
$('#stud_remarks').empty();

function refreshDatatable(){
    var modal = document.getElementById('modal-xs');
        modal.addEventListener('hidden.bs.modal', function (e) {
            $('#cmstable1').DataTable().ajax.reload();
        });
}


// var table5 = $('#list_training_paticipant_attandance').DataTable();
//                             table5.ajax.reload(null, false); 


$('#btn_search').click(function () {
      
      $('#Personaldetail').empty();
      $('#stud_remarks').empty();
	  $('#select_id').val('');
      $('#select_data').html('');     
			    
      getDatatable(0,0,0,0);
    
    });

    

    $(document).on('click', '.btn_DebtGroup', function () {
    
      $('#Personaldetail').empty();
      $('#stud_remarks').empty();
      $('#select_id').val('');
      $('#select_data').html('');     

      var temp1 = 0;
      var temp2 = 0;
      var temp3 = $(this).attr('value');
      var temp4 = 0; 
      getDatatable(temp1,temp2,temp3,temp4);

  });


    
$(document).on('click', '.btn_OutsAmt', function () {
      $('#Personaldetail').empty();
      $('#stud_remarks').empty();
      $('#select_id').val('');
      $('#select_data').html('');      

      var btnval = $(this).attr('value');     
      var temp  = btnval.split('-')
      var temp1 = temp[0];
      var temp2 = temp[1];
      var temp3 = 0;  
      var temp4 = 0; 
      
      getDatatable(temp1,temp2,temp3,temp4);

  });


$(document).on('click', '.btn_FollowUp', function () {
    
    $('#Personaldetail').empty();
    $('#stud_remarks').empty();
    $('#select_id').val('');
    $('#select_data').html('');    

    var temp1 = 0;
    var temp2 = 0;
    var temp3 = 0;
    var temp4 = 'followup';
    getDatatable(temp1,temp2,temp3,temp4);

});


  function getDatatable(temp1,temp2,temp3,temp4){

    $('#cmstable1').dataTable().empty();

		var table = $('#cmstable1').DataTable({
			lengthChange:false,			processing: true,
			deferRender:true,			searching:false,
			responsive:true,				
			destroy:true,			pageLength: 10,
			paging:true,			scrollY: true,   
			//dom: 'Bfrtip',                      
			ajax: { 
				url: '$url',
				type: 'GET',
				data: {
                    txtSearch:$("#txtSearch").val(),
                    txtStatusId:$("#txtStatusId").val(),
                    txttemp1:temp1,
                    txttemp2:temp2,                            
                    txttemp3:temp3,   
                    txttemp4:temp4,
					}
			},
		
			"columns": [				
                {"data":"StudName"},	
				{"data":"StudNRICPassportNo"},                           
                {"data":"StatusName"},	                
				{"data":"ProgramCode"},	                
                {"data": "AcademicOuts",
                "render": function ( data, type, row, meta ) { 
                    return ' <button type="button"  value="'+data+'" class="btn btn-primary btn-sm" >'+data+'</button>';
                    }
                },
                
                {"data":"AcademicAging"},
                // {"data":"DebtGroupName"},
                {"data": "DebtGroupName",
                "render": function ( data, type, row, meta ) { 
                    return ' <button type="button"  value="'+data+'" class="btn btn-danger btn-sm" >'+data+'</button>';
                    }
                },

                {"data": "StudName",
                 "render": function ( data, type, row, meta ) { 
                     return '<div class="dropdown btn btn-sm ">'+
                     '<a class="btn btn-sm  btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Action</a>'+
                     '<ul class="dropdown-menu">'+
                     '<li><a id="pickthis" class="dropdown-item showModal_PickThis" href="#pickthis">Pick/Assign Group</a></li>'+ 	                
                     '<li><a class="dropdown-item showModal_RemoveGroup" href="#removegroup">Remove Group</a></li>'+
                     '<li><a class="dropdown-item btn btn-danger sendEmail" value='+row.ProgramRegId+','+row.StudNationalityId+','+row.AcademicOuts+'>Send Email</a></li>'+                      
                     '</ul>'+
                     '</div>';
                     }
                },									
			
             
			],

            
            "columnDefs": [          
                {
                "targets": 6, // Assuming Salary column is at index 5
                "createdCell": function(td, cellData, rowData, row, col) {
                    $(td).css('color', 'blue');                    
                }
            }           

        ],


		});
			
						
	$('#cmstable1 tbody').on('click', 'tr', function() {
      //console.log(table.row(this).data());

			var table = $('#cmstable1').DataTable();
			//console.log(table.row(this).data());
  
			if ($(this).hasClass('row_selected1')) {
				$(this).removeClass('row_selected1');
			} else {
				table.$('tr.row_selected1').removeClass('row_selected1');
				$(this).addClass('row_selected1');
			}
        
		    var d = table.row(this).data();
			
            var x = d['StudName'];
			var y = d['ProgramRegId'];
            var z = d['AcademicOuts'];
            var w = d['AcademicAging'];
            var v = d['StatusName'];
            var i = d['DebtStudId'];
            var e = d['OwnerId'];            
            
	    	$('#select_data').html(x);
			$('#select_id').val(y);
            $('#select_outs').val(z);
            $('#select_academicaging').val(w);
            $('#select_StatusName').val(v);
            $('#select_debtstudid').val(i);
            $('#select_ownerid').val(e);            

            $('#Personaldetail').empty();
            $('#stud_remarks').empty();

            var content = "<table>"
                content += '<tr><td> Name : ' + d['StudName'] + '</td></tr> ';
                content += '<tr><td> Gender : ' + d['GenderName'] + '</td></tr> ';
                content += '<tr><td> E-mail : ' + d['StudEmail'] + '</td></tr> ';
                content += '<tr><td> HP NO : ' + d['StudMobileNo'] + '</td></tr>';         
                content += '<tr><td> Home Tel No : ' + d['StudCorrPhoneNo'] + '</td></tr> ';     
                content += '<tr><td> Guardian  Tel No : ' + d['StudGuardHomePhoneNo'] + '</td></tr>';  
                content += '<tr><td> Emergency Tel No 1: ' + d['StudEmergHandPhone'] + '</td></tr>';    
                content += '<tr><td> Emergency Tel No 2: ' + d['StudEmergOfficePhone'] + '</td></tr>';             
                content += '<tr><td>' + '<hr>' + '</td></tr> <br> ';

                content += '<tr><td> Program  : ' + d['ProgramName'] + '</td></tr> ';
                content += '<tr><td> ProgramType : ' + d['ProgramTypeName'] + '</td></tr>';
                content += '<tr><td> Status : ' + d['StatusName'] + '</td></tr>';       
                content += '<tr><td> <b>Sponsorship : ' + d['StudSponsorship'] + '</b></td></tr>';       

                     
                content += '<tr><td>' + '<hr>' + '</td></tr> ';
                content += '<tr><td> <h5>Last Date Paid : ' + d['LastPaidDate'] + '<h5></td></tr>';       
                content += '<tr><td> <h5>Last Paid Amount : ' + d['LastPaidAmount'] + '<h5></td></tr>'; 

                content += '<tr><td> <h5> Aging : ' + d['AcademicAging'] + ' days </h5> </td></tr> ';
                content += '<tr><td> <h5> Tuition  Fee Outs : ' + d['AcademicOuts'] + '</h5></td></tr> ';
                content += '<tr><td> <h5> Tuition  Fee Outs Prev Sem : ' + d['AcademicOutsPrevSem'] + '<h5></td></tr> ';
                content += '<tr><td> <h5> Assessment Fee : ' + d['AssesmentOuts'] + '<h5></td></tr> ';
                content += '<tr><td> <h5> Hostel Outs Fee : ' + d['HostelOuts'] + '<h5></td></tr> ';

                content += '<tr><td>' + '<hr>' + '</td></tr> ';
                content += '<tr><td> Marketing Name : ' + d['FullName'] + '-'+ d['MarketingStaffStatus'] + '</td></tr> ';
                content += '<tr><td> Team : ' + d['MarketingTeam'] + '</td></tr> ';
                
                if(d['MarketingStaffStatus']=='Active'){
                    content += '<tr><td> HandSetNo : ' + d['HandSetNo'] + '</td></tr> ';
                    content += '<tr><td> E-mail : ' + d['EmailAddress'] + '</td></tr> ';
                    // content += '<tr><td> Status : ' + d['MarketingStaffStatus'] + '</td></tr> ';
                    
                }
                content += '<tr><td>' + '<hr>' + '</td></tr> ';                       
                
                content += "</table>"

            $('#Personaldetail').append(content);


            var studmessages = d['Remarks'];            
                $('#stud_remarks').html(studmessages);

            getDatatableFollowup();

	});

        

  }

  /**************************************************************************************************************** */

  
  function getDatatableFollowup(){
    
   var table = $('#cmstable2').DataTable({
    order: [[6, 'desc']],
    lengthChange:false, processing: true,
    serverSide: true, deferRender:true, searching:false,
    responsive:true, destroy:true, pageLength: 12, paging:true,
    scrollY: true,   
    //dom: 'Bfrtip',                      
    ajax: { 
        url: '$urlfollowuplist?id='+$("#select_id").val(),
        type: 'GET',        
    },

    "columns": [				
        {"data":"DebtActionCategory"},	
        {"data":"ActionRemarks"},                           
        {"data":"FeedbackRemarks"},	                
        {"data":"RemainderRemarks"},	
        {"data":"OutsAmt"},	                   
        {"data":"ShortName"},		
        {"data":"TransactionDate"},    		
        {"data":"", title: 'Action', wrap: true,"defaultContent":'<div class="btn-group showModal_FollowupView"><button type="button" id="del-btn" value="0" class="btn btn-warning btn-sm" >View</button></div>'
            +" " +'<div class="btn-group showModal_FollowupDelete"> <button type="button" id="del-btn" value="0" class="btn btn-warning btn-sm" >Del</button></div>'
        },
    ],

});
    
                
$('#cmstable2 tbody').on('click', 'tr', function() {

    
//console.log(table.row(this).data());
    var table2 = $('#cmstable2').DataTable();
    //console.log(table.row(this).data());

    if ($(this).hasClass('row_selected2')) {
        $(this).removeClass('row_selected2');
    } else {
        table2.$('tr.row_selected2').removeClass('row_selected2');
        $(this).addClass('row_selected2');
    }

    var x = table2.row(this).data();
    
     var f = x['FollowupId'];
     $('#select_followupid').val(f);
    });

}


  

  /**********************************************************************************/
	$(document).on('click', '.showModal_Followup', function () {

        var selectid = $("#select_id").val();

        if(selectid==''){
            return alert("Please select any student to folluw-up");
        }


      var form = $(this);
      $.ajax({
	    	url: '$followup?id='+$("#select_id").val()+'&name='+$("#select_data").html()+'&studouts='+$("#select_outs").val()+'&selectacademicaging='+$("#select_academicaging").val()+'&selectStatusName='+$("#select_StatusName").val(),
            
            type   : 'GET',
			data: {
                // txtprogramregid: $("#select_id").val(),
                 },
             success: function (response) 
            {     
				$('#modal-xl').modal('show');
                $('#modalContent-xl').html(response).modal();							
				document.getElementById('modalHeader-xl').innerHTML = '<h4>Follow Up / Action Taken</h4>';
          
            },
            error  : function (e) {
				    console.log(e);
            }
        });
    return false;        
  });
  

  

  /**********************************************************************************/
	$(document).on('click', '.showModal_FollowupView', function () {
       

    var selectid = $("#select_followupid").val();
    
    if(selectid==''){
        return alert("Please select any student to folluw-up");
    }

    var form = $(this);
    $.ajax({
        url: '$followupview?followupid='+$("#select_followupid").val(),
        
        type   : 'GET',
        data: {
            // txtprogramregid: $("#select_id").val(),
            },
        success: function (response) 
        {     
            $('#modal-xl').modal('show');
            $('#modalContent-xl').html(response).modal();							
            document.getElementById('modalHeader-xl').innerHTML = '<h4>Follow Up / Action Taken</h4>';
    
        },
        error  : function (e) {
                console.log(e);
        }
    });
    return false;        
});




  /**********************************************************************************/
  $(document).on('click', '.showModal_FollowupDelete', function () {
       
       
       var selectid = $("#select_followupid").val();
       
       if(selectid==''){
           return alert("Please select any student to folluw-up");
       }
   

       var result = confirm("Are you sure want to delete this follow up?");

       if (result) {
                 var form = $(this);
                 $.ajax({           
                     type : 'POST',            
                     url: '$followupdelete?followupid='+$("#select_followupid").val()+'&id='+$("#select_id").val(),
                 
                     data: {
                         _csrf: yii.getCsrfToken(),
                        //  ParticipantId: ParticipantId,               
                        //  TrainingId: TrainingId,
                        //  UserId: UserId,

                         },
                         success: function (response)  {                     
                         
                          alert("Data remove successfully");
                          $('#cmstable1').DataTable().ajax.reload();
                          $('#cmstable2').DataTable().ajax.reload();

                     },
                     error  : function (e) {
                             // console.log(e);
                     }
                 });
             return false;      
     } 
         
   });


/**********************************************************************************/
 

$(document).on('click', '.showModal_PickThis', function () {
    
    var userid = $('#userid').val();   
    var select_ownerId = $('#select_ownerid').val(); 

                if(($('#select_outs').val()<=0 &&($('#select_ownerid').val()==0))){
                    alert("Sorry, Please pick student with outstading");
                    return false;
                }


                if( ($('#select_ownerid').val()>0) && ($('#select_ownerid').val()!=$('#userid').val()) ){
                    alert('Sorry , This student already been taken');
                    return false;
                }

                
                if( ($('#select_academicaging').val()<=90) && ($('#select_ownerid').val()==0 )) {

                      alert('Sorry, You can\'t pick account aging below then 90 days') ;

                } else {
                    
                    var form = $(this);

                $.ajax({
                        url: '$pickthis?id='+$("#select_id").val()+'&debtstudid='+$("#select_debtstudid").val(),
                        
                        type   : 'GET',
                        data: {
                            // txtprogramregid: $("#select_id").val(),
                            },
                        success: function (response) 
                        {     
                            $('#modal-xs').modal('show');
                            $('#modalContent-xs').html(response).modal();							
                            document.getElementById('modalHeader-xs').innerHTML = '<h4>Pick This </h4>';
                    
                        },
                        error  : function (e) {
                                console.log(e);
                        }
                    });
                return false;  
            
            
                }
   
   
   });


   

   $(document).off('click', '.showModal_RemoveGroup').on('click', '.showModal_RemoveGroup', function () {


    if( ($('#select_ownerid').val() >0) && ($('#select_ownerid').val() != $('#userid').val()) ){
        alert('Sorry , This student not belong to you ');
        return false;
    }

            
             var result = confirm("Are you sure want to remove this student from this group?");

             if (result) {
                 var form = $(this);
                 $.ajax({           
                     type : 'POST',            
                     url: '$removefromgroup?id='+$("#select_id").val()+'&debtstudid='+$("#select_debtstudid").val(),
                 
                     data: {
                         _csrf: yii.getCsrfToken(),
                        //  ParticipantId: ParticipantId,               
                        //  TrainingId: TrainingId,
                        //  UserId: UserId,

                         },
                         success: function (response)  {                     
                         
                          alert("Data remove successfully");
                          $('#cmstable1').DataTable().ajax.reload();
                          $('#cmstable2').DataTable().ajax.reload();

                     },
                     error  : function (e) {
                             // console.log(e);
                     }
                 });
             return false;      
     } 
         

});




  /**********************************************************************************/
  $(document).on('click', '.showModal_CreateGroup', function () {
      var form = $(this);
      $.ajax({
	    	url: '$creategroup',
            type   : 'GET',
			data: {
               // UserId: $("#select_id").val(),
                 },
             success: function (response) 
            {     
				$('#modal-md').modal('show');
                $('#modalContent-md').html(response).modal();							
				document.getElementById('modalHeader-md').innerHTML = '<h4>Create Group</h4>';
               // document.getElementById('modalHeader-xl').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';	
				//console.log(response);
            },
            error  : function (e) {
				  ///  console.log(e);
            }
        });
    return false;        
  });

  /**********************************************************************************/

  $(document).on('click', '.showModal_Messages', function () {

      var form = $(this);
      $.ajax({
	    	url: '$messages?prgid='+$("#select_id").val(),
            type   : 'GET',
			data: {
               // UserId: $("#select_id").val(),
                 },
             success: function (response) 
            {     
				$('#modal-md').modal('show');
                $('#modalContent-md').html(response).modal();							
				document.getElementById('modalHeader-md').innerHTML = '<h4>Create Remarks</h4>';
               // document.getElementById('modalHeader-xl').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';	
				//console.log(response);
            },
            error  : function (e) {
				  ///  console.log(e);
            }
        });
    return false;        
  });
  




/******examdocket_block****************************************************************************/

    $(document).on('click', '.showModal_ExamDocket_Block', function () {

var form = $(this);
$.ajax({
      url: '$examdocket_block?prgid='+$("#select_id").val()+'&oustding='+$("#select_outs").val(),
      type   : 'GET',
      data: {
         // UserId: $("#select_id").val(),
           },
       success: function (response) 
      {     
        if (response.accessDenied) 
        {
            alert('Access denied. You do not have permission to access this feature.');
        }
        else
        {
          $('#modal-md').modal('show');
          $('#modalContent-md').html(response).modal();							
          document.getElementById('modalHeader-md').innerHTML = '<h4>Block/Unblock Exam Dockate / LMS</h4>';
         // document.getElementById('modalHeader-xl').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';	
          //console.log(response);
        }
      },
      error  : function (e) {
            ///  console.log(e);
      }
  });
return false;        
});




/******timetable_block****************************************************************************/

$(document).on('click', '.showModal_TimeTable_Block', function () {

var form = $(this);
$.ajax({
      url: '$timetable_block?prgid='+$("#select_id").val()+'&oustding='+$("#select_outs").val(),
      type   : 'GET',
      data: {
         // UserId: $("#select_id").val(),
           },
       success: function (response) 
      {     
        if (response.accessDenied) 
        {
            alert('Access denied. You do not have permission to access this feature.');
        }
        else
        {
            $('#modal-md').modal('show');
            $('#modalContent-md').html(response).modal();							
            document.getElementById('modalHeader-md').innerHTML = '<h4>Block/Unblock Class Time Table / LMS</h4>';
            // document.getElementById('modalHeader-xl').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';	
            //console.log(response);
        }
      },
      error  : function (e) {
            ///  console.log(e);
      }
  });
return false;        
});



/******timetable_block****************************************************************************/

$(document).on('click', '.showModal_ExamResult_Block', function () {

var form = $(this);
$.ajax({
      url: '$examresult_block?prgid='+$("#select_id").val()+'&oustding='+$("#select_outs").val(),
      type   : 'GET',
      data: {
         // UserId: $("#select_id").val(),
           },
       success: function (response) 
      {     
        if (response.accessDenied) 
        {
            alert('Access denied. You do not have permission to access this feature.');
        }
        else
        {
          $('#modal-md').modal('show');
          $('#modalContent-md').html(response).modal();							
          document.getElementById('modalHeader-md').innerHTML = '<h4>Block/Unblock Exam Result / LMS</h4>';
         // document.getElementById('modalHeader-xl').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';	
          //console.log(response);
        }
      },
      error  : function (e) {
            ///  console.log(e);
      }
  });
return false;        
});




/**********************************************************************************/

$(document).on('click', '.showModal_Statement', function () {
    
    // $rpestsement = Url::toRoute(['/reportgallery/report?rpt=1_rpt_student_statement.php']);
    //url: '$removefromgroup?id='+$("#select_id").val()+'&debtstudid='+$("#select_debtstudid").val(),
    var rpt = "1_rpt_student_statement.php";
    var param1 = $("#select_id").val();
    
var url = "$rpestsement?rpt="+rpt+"&param1="+encodeURIComponent(param1); 

window.open(url, "_blank");
    // window.location.href = '$rpestsement';
    // window.open('$rpestsement?id='+ encodeURIComponent(param1), "_blank");
    // url: '$removefromgroup?id='+$("#select_id").val()+'&debtstudid='+$("#select_debtstudid").val(),
  
  });
  

/**********************************************************************************/


$(document).on('click', '.sendEmail', function() {
    var value = $(this).attr('value').split(','); 

    var ProgramRegId = value[0];
    var StudNationalityId = value[1];
    var Outstanding = value[2];

if(Outstanding >0){

    if(StudNationalityId != 7)
    {
            desc = 'Do you want to send the email to the student?';
            desc2 = 'You have successfully send the email to the student!';

            Swal.fire({title:desc,icon:"warning",showCancelButton:!0,confirmButtonColor:"#34c38f",cancelButtonColor:"#f46a6a",confirmButtonText:"Confirm"})
            .then(function(t) 
            {
                if (t.value) {
                    $.ajax({
                        url: '$sendemail',
                        type: 'POST',
                        dataType: "json",
                        data: 
                        {  
                            ProgramRegId : ProgramRegId,
                            _csrf : '$_csrf',
                        },
                        success: function(response) 
                        {
                            t.value&&Swal.fire({title:desc2,icon:"success",confirmButtonColor:"#34c38f",confirmButtonText:"Confirm"})
                        },
                        error: function(xhr, status, error) 
                        {
                            alert('Please contact the programmer for more details!');
                        }
                    });
                } 
            });
        } else {
        desc = 'Sorry! China student is not allowed!';
        Swal.fire({title:desc,icon:"warning",showConfirmButton:!1,showCancelButton:!0,confirmButtonColor:"#34c38f",cancelButtonColor:"#f46a6a",confirmButtonText:"Confirm"})
    }

} else {

        desc = 'Sorry! No Outstanding Amount!';
        Swal.fire({title:desc,icon:"warning",showConfirmButton:!1,showCancelButton:!0,confirmButtonColor:"#34c38f",cancelButtonColor:"#f46a6a",confirmButtonText:"Confirm"})
}

});

});

JS;
$this->registerJs($script);

?>