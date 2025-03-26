<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>

<script>
    function openNewLink(url) {

        var fn = $('#fn').val();

        if (fn == 0) {
            return alert('Select a document');
        }

        window.open(url + btoa(fn), '_blank');
    }
</script>

<?php

$id = Yii::$app->request->get('id', 0);
$baseUrl = Url::base();
$urlstudedulist = Url::base() . '/application/studeduclist?id=' . $id;
$urlstudedusubjlist = Url::base() . '/application/studeducsubjlist?id=';
$urladdsubj = Url::base() . '/application/addqualificationsubj?studeducid=';
$urleditquali = Url::base() . '/application/addqualification?id=' . $id;
$urlstuddocumentlist = Url::base() . '/application/studdocumentlist?id=' . $id;

$script = <<< JS

$( document ).ready(function()
{
    getTblstuddocuments();

    $('#tblstudeducation').dataTable().empty();			    
    var table = $('#tblstudeducation').DataTable({

        lengthChange:false,
        processing: true,
        deferRender:true,
        searching:false,
        responsive:true,						
        destroy:true,
        paging:false,
        processing:false,

        ajax:
        { 
            url: '$urlstudedulist',
            type: 'GET',
        },
    
        "columns": 
        [
            // {"data":"StudEducId","width": '0.1%'},
            {
                "data": "StudEducId", "width": '0.1%',
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },			
            {"data":"EducCode","width": '0.5%'},
            {"data":"ExamName","width": '1%'},		
            {"data":"ExamYear","width": '0.1%'},		
            {"data":"ExamSchool","width": '0.1%'},		
            {"data":"ExamResult","width": '0.1%'},
        ],

        "columnDefs":
        [
            {
                "className": "text-center", "targets": [0, 1, 3, 5]
            }
        ]
    });

    $('#tblstudeducation tbody').on('click', 'tr', function() {
			
		var table = $('#tblstudeducation').DataTable();
  
		if ($(this).hasClass('row_selected1')) 
        {
			$(this).removeClass('row_selected1');
        }

        else 
        {
			table.$('tr.row_selected1').removeClass('row_selected1');
			$(this).addClass('row_selected1');
		}

		var d = table.row(this).data();
		var y = d['StudEducId'];
	
		$('#StudEducId').val(y);
        getTblstudeducationsubj();
	});


});

function getTblstudeducationsubj() 
{
    $('#tblstudeducationsubj').dataTable().empty();

    var table = $('#tblstudeducationsubj').DataTable({
    
        lengthChange:false,
        processing: true,
        deferRender:true,
        searching:false,
        responsive:true,						
        destroy:true,
        paging:false,
        processing:false,
    
        ajax: 
        { 
            url: '$urlstudedusubjlist' + $('#StudEducId').val(),
            type: 'GET',
        },
    
        "columns": 
        [
            // {"data":"StudEduSubjId","width": '0.1%'},
            {
                "data": "StudEduSubjId", "width": '0.1%',
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },		
            {"data":"EduSubject","width": '10%'},	
            {"data":"Result","width": '0.5%'},
        ],
    
        "columnDefs":
        [
            {
                "className": "text-center", "targets": [0, 2]
            }
        ]
    });

    $('#tblstudeducationsubj tbody').on('click', 'tr', function() {
			
            var table = $('#tblstudeducationsubj').DataTable();
      
            if ($(this).hasClass('row_selected1')) 
            {
                $(this).removeClass('row_selected1');
            }
    
            else 
            {
                table.$('tr.row_selected1').removeClass('row_selected1');
                $(this).addClass('row_selected1');
            }
    
            var d = table.row(this).data();
            var y = d['StudEduSubjId'];
        
            $('#StudEduSubjId').val(y);
        });
}

function getTblstuddocuments() 
{
    $('#tblstuddoc').dataTable().empty();

    var table = $('#tblstuddoc').DataTable({
    
        lengthChange:false,
        processing: true,
        deferRender:true,
        searching:false,
        responsive:true,						
        destroy:true,
        paging:false,
        processing:false,
    
        ajax: 
        { 
            url: '$urlstuddocumentlist',
            type: 'GET',
        },
    
        "columns": 
        [
            // {"data":"StudEduSubjId","width": '0.1%'},
            {
                "data": "DocId", "width": '0.1%',
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },		
            {"data":"DocType","width": '0.1%'},	
            {"data":"file_name","width": '1%'},
            {"data":"FullName","width": '1%'},
            {"data":"TransactionDate","width": '0.1%'}
        ],
    
        "columnDefs":
        [
            {
                "className": "text-center", "targets": [0, 4]
            }
        ]
    });

    $('#tblstuddoc tbody').on('click', 'tr', function() 
    {
        var table = $('#tblstuddoc').DataTable();
    
        if ($(this).hasClass('row_selected1')) 
        {
            $(this).removeClass('row_selected1');
        }

        else 
        {
            table.$('tr.row_selected1').removeClass('row_selected1');
            $(this).addClass('row_selected1');
        }

        var d = table.row(this).data();
        var y = d['file_name'];
    
        $('#fn').val(y);
    });
}

$(document).on('click', '.showModal', function()
{
    var content = $(this).attr('value');
    var headerTitle = $(this).attr('title');
    var id = $(this).attr('id');

    if(id == 'btnAddSubject')
    {
        var StudEducId = $('#StudEducId').val();

        if(StudEducId == 0)
        {
           return alert('Select a qualification first');
        }

        content = '$urladdsubj' + StudEducId + '&applicationid=$id';
    }

    else if(id == 'btnEditSubject')
    {
        var StudEduSubjId = $('#StudEduSubjId').val();
        var StudEducId = $('#StudEducId').val();

        if(StudEduSubjId == 0)
        {
            return alert('Select a subject first');
        }

        content = '$urladdsubj' + StudEducId + '&applicationid=$id&studedusubjid=' + StudEduSubjId;
    }

    else if (id == 'btnEditQuali')
    {
        var StudEducId = $('#StudEducId').val();

        if(StudEducId == 0)
        {
           return alert('Select a qualification first');
        }

        content = '$urleditquali&studeducid=' + StudEducId;
    }

    $('#modal-lg').modal('show');
    $('#modal-lg').find('#modalContent-lg').load(content);
    document.getElementById('modalHeader-lg').innerHTML = '<h5>' + headerTitle + '</h5>';
});

$("a").click(function(event)
{
    var userId = '$id';
    var tabName = event.target.id;
    var TabName = tabName.slice(0, -4);

    window.history.pushState('', '', '$baseUrl/application/create?id='+userId+'&tab='+TabName);
});

JS;
$this->registerJs($script);

?>

<?php
$tab = '';
if (isset($_GET["tab"])) {
    $tab = $_GET['tab'];
}

if (!empty($tab)) {
    $this->registerJs("$('a[href=\"#" . $tab . "\"]').tab('show');", yii\web\View::POS_READY);
} else {
    $this->registerJs("$('a[href=\"#v-pills-home\"]').tab('show');", yii\web\View::POS_READY);
}

?>

<div class="col-12">
    <!-- Left sidebar -->
    <div class="email-leftbar card">
        <div class="d-grid">
            <a href="#" class="btn btn-danger rounded btn-custom waves-effect waves-light">Back</a>
        </div>

        <div class="nav flex-column nav-pills me-2 mt-2 mp-2 text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-Personal-tab" data-bs-toggle="pill" href="#v-pills-Personal" role="tab" aria-controls="v-pills-Personal" aria-selected="true">Personal Detail</a>
            <a class="nav-link" id="v-pills-Address-tab" data-bs-toggle="pill" href="#v-pills-Address" role="tab" aria-controls="v-pills-Address" aria-selected="false">Address</a>
            <a class="nav-link" id="v-pills-Qualification-tab" data-bs-toggle="pill" href="#v-pills-Qualification" role="tab" aria-controls="v-pills-Qualification" aria-selected="false">Qualification</a>
            <a class="nav-link" id="v-pills-Programmes-tab" data-bs-toggle="pill" href="#v-pills-Programmes" role="tab" aria-controls="v-pills-Programmes" aria-selected="false">Programmes/Course</a>
            <a class="nav-link" id="v-pills-english-tab" data-bs-toggle="pill" href="#v-pills-english" role="tab" aria-controls="v-pills-english" aria-selected="false">English Language Proficiency</a>
            <a class="nav-link" id="v-pills-financial-tab" data-bs-toggle="pill" href="#v-pills-financial" role="tab" aria-controls="v-pills-financial" aria-selected="false">Financial</a>
            <a class="nav-link" id="v-pills-Accomodation-tab" data-bs-toggle="pill" href="#v-pills-Accomodation" role="tab" aria-controls="v-pills-Accomodation" aria-selected="false">Accomodation</a>
            <a class="nav-link" id="v-pills-WorkInfo-tab" data-bs-toggle="pill" href="#v-pills-WorkInfo" role="tab" aria-controls="v-pills-WorkInfo" aria-selected="false">Working Info</a>
            <a class="nav-link" id="v-pills-Document-tab" data-bs-toggle="pill" href="#v-pills-Document" role="tab" aria-controls="v-pills-Document" aria-selected="false">Documents</a>
        </div>

        <!-- <div class="nav flex-column nav-pills me-2  mt-2 mp-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="nav-link active" id="v-pills-Personal-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Personal" type="button" role="tab" aria-controls="v-pills-Personal" aria-selected="true">Personal Detail</button>

            <button class="nav-link mt-1" id="v-pills-Address-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Address" type="button" role="tab" aria-controls="v-pills-Address" aria-selected="false">Address</button>

            <button class="nav-link mt-1 " id="v-pills-Qualification-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Qualification" type="button" role="tab" aria-controls="v-pills-Qualification" aria-selected="false">Qualification</button>

            <button class="nav-link mt-1" id="v-pills-Programmes-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Programmes" type="button" role="tab" aria-controls="v-pills-Programmes" aria-selected="false">Programmes/Course</button>

            <button class="nav-link mt-1" id="v-pills-english-tab" data-bs-toggle="pill" data-bs-target="#v-pills-english" type="button" role="tab" aria-controls="v-pills-english" aria-selected="false">English Language Proficiency</button>

            <button class="nav-link mt-1" id="v-pills-financial-tab" data-bs-toggle="pill" data-bs-target="#v-pills-financial" type="button" role="tab" aria-controls="v-pills-financial" aria-selected="false">Financial</button>

            <button class="nav-link mt-1" id="v-pills-Accomodation-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Accomodation" type="button" role="tab" aria-controls="v-pills-Accomodation" aria-selected="false">Accomodation</button>

            <button class="nav-link mt-1" id="v-pills-WorkInfo-tab" data-bs-toggle="pill" data-bs-target="#v-pills-WorkInfo" type="button" role="tab" aria-controls="v-pills-WorkInfo" aria-selected="false">Working Info</button>

            <button class="nav-link mt-1" id="v-pills-Document-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Document" type="button" role="tab" aria-controls="v-pills-Document" aria-selected="false">Documents</button>
        </div> -->

    </div>
    <!-- End Left sidebar -->

    <!-- Right Sidebar -->
    <div class="email-rightbar mb-3">

        <div class="card">
            <div class="card-body">
                <div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-Personal" role="tabpanel" aria-labelledby="v-pills-Personal-tab"><?= $this->render('personaldetail', ['model' => $model]) ?></div>

                        <div class="tab-pane fade" id="v-pills-Address" role="tabpanel" aria-labelledby="v-pills-Address-tab"><?= $this->render('address', ['model' => $model, 'address' => $address]) ?></div>

                        <div class="tab-pane fade" id="v-pills-Qualification" role="tabpanel" aria-labelledby="v-pills-Qualification-tab"><?= $this->render('qualification', ['model' => $model]) ?></div>

                        <div class="tab-pane fade" id="v-pills-Programmes" role="tabpanel" aria-labelledby="v-pills-Programmes-tab"><?= $this->render('programregister', ['model' => $model, 'programregister' => $programregister]) ?></div>

                        <div class="tab-pane fade" id="v-pills-english" role="tabpanel" aria-labelledby="v-pills-english-tab">...english</div>

                        <div class="tab-pane fade" id="v-pills-financial" role="tabpanel" aria-labelledby="v-pills-financial-tab"><?= $this->render('financial', ['model' => $model]) ?></div>

                        <div class="tab-pane fade" id="v-pills-Accomodation" role="tabpanel" aria-labelledby="v-pills-Accomodation-tab">...Accomodation</div>

                        <div class="tab-pane fade" id="v-pills-WorkInfo" role="tabpanel" aria-labelledby="v-pills-WorkInfo-tab"><?= $this->render('workinginfo', ['StudWorkingInfo' => $StudWorkingInfo]) ?></div>

                        <div class="tab-pane fade" id="v-pills-Document" role="tabpanel" aria-labelledby="v-pills-Document-tab"><?= $this->render('document', ['model' => $model]) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>