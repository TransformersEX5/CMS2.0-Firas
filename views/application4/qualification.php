<?php

use app\models\Tblapplication;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$backindex = '/application';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');
?>

<?php

?>
<table id="tblstudeducation" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th>No</th>
            <th>Type</th>
            <th>Examination</th>
            <th>Year</th>
            <th>School/Institution</th>
            <th>Result</th>
        </tr>
    </thead>
</table>

<?php

$urlcolorlist = Url::base() . '/application/studedulist';

$script = <<< JS

$( document ).ready(function()
{
    $('#tblstudeducation').dataTable().empty();			    
    var table = $('#tblstudeducation').DataTable({

        lengthChange:false,
        processing: true,
        deferRender:true,
        searching:true,
        responsive:true,						
        destroy:true,
        pageLength: 5,
        paging:true,
        processing:false,

        ajax: 
        { 
            url: '$urlcolorlist',
            type: 'GET',
            // data: ''
        },
    
        "columns": 
        [
            {"data":"ColorId","width": '0.1%'},		
            {"data":"ColorDesc","width": '5%'},              
        ],

        "columnDefs":
        [
            {
                "className": "dt-center", "targets": [0, 2]
            }
        ]
    });
});

$(document).on('click', '.showModal', function()
{
    var content = $(this).attr('value');
    var headerTitle = $(this).attr('title');

    $('#modal-Large').find('#modalContent-Large').load(content);
    document.getElementById('modalHeader-Large').innerHTML = '<h5>' + headerTitle + '</h5>';
});

JS;
$this->registerJs($script);

?>