<?php

/** @var yii\web\View $this */

$this->title = 'EFC';

use yii\helpers\Url;

?>

<?php

$module = '/' . Yii::$app->controller->module->id;

$url = Url::base() . $module . '/default/invitationletter';
$sendemail = Url::base() . $module . '/default/sendemail';

$_csrf = Yii::$app->request->getCsrfToken();

$script = <<<JS

$( document ).ready(function() {

    $(document).on('click', '.sendEmail', function() {
        var id = $(this).attr('value').split(','); 
        
        var ProgramRegId = id[0];
        var DataFrom = id[1];
        var StudName = id[2];
        var StudentNo = id[3];
        var StudEmail = id[4];
        var ProgramName = id[5];
        var ConvocationFee = id[6];


        desc = 'Do you want to send the invitation letter to the student?';
        desc2 = 'You have successfully send the invitation letter to the student!';

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
                            DataFrom : DataFrom,
                            StudName : StudName,
                            StudentNo : StudentNo,
                            StudEmail : StudEmail,
                            ProgramName : ProgramName,
                            ConvocationFee : ConvocationFee,
                            _csrf : '$_csrf',
                        },
                        success: function(response) 
                        {
                            t.value&&Swal.fire({title:desc2,icon:"success",confirmButtonColor:"#34c38f",confirmButtonText:"Confirm"})
                            $('#datatable-invitation').DataTable().ajax.reload();
                        },
                        error: function(xhr, status, error) 
                        {
                            alert('Please contact the programmer for more details!');
                        }
                    });
                } 
            });
    });



var table = $('#datatable-invitation').DataTable({
          
    // lengthChange:false,			
    processing: true,
    deferRender:false,			
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
        url: '$url',
        type: 'GET',
        datatype: 'json',
    },

    "columns": [
        {
                "data": "ProgramRegId", "width": '0.1%', class:"text-dark text-center",
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },	
        {"data":"DataFrom", class:"text-dark text-center"},		
        {"data":"StudName", class:"text-dark"},		
        {"data":"StudentRegister", class:"text-dark text-center"},	
        {"data":"ProgramCode", "width": '11.0%', class:"text-dark"},		
        {"data":"TotalOuts", "width": '1.0%', class:"text-dark text-center"},	
        {"data":"ConvocationFee", "width": '8.2%', class:"text-dark text-center"},	
        {"data":"TransactionDate", "width": '9.0%', class:"text-dark text-center"},		
        {
            "data": "ProgramRegId", "width": "0.1%",
            "render": function (data, type, row, meta) 
            {
                return '<button type="button" class="btn btn-primary waves-effect waves-light sendEmail" value='+ JSON.stringify(btoa(data)+','+btoa(row.DataFrom)+','+btoa(row.StudName)+','+btoa(row.StudentNo)+','+btoa(row.StudEmail)+','+btoa(row.ProgramName)+','+btoa(row.ConvocationFee)) +'>Send</button>'
            }
        },	
        {"data":"SendDate", "width": '12.0%', class:"text-dark text-center"},															
    ]
});

    
});



JS;
$this->registerJs($script);

?>

<div class="col-12">
    <div class="card">
        <h4 class="card-header mt-0 text-dark bg-white rounded">EFC LIST/INVITATION LETTER</h4>
        <div class="card-body">
            <div class="table-rep-plugin">
                <div class="b-0">
                    <table id="datatable-invitation" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-dark">No.</th>
                                <th class="text-dark">DataFrom</th>
                                <th class="text-dark">Name</th>
                                <th class="text-dark">Student No.</th>
                                <th class="text-dark">Program Code</th>
                                <th class="text-dark">Outs</th>
                                <th class="text-dark">Convo Fee</th>
                                <th class="text-dark">Status Date</th>
                                <th class="text-dark">Action</th>
                                <th class="text-dark">Send Date</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>