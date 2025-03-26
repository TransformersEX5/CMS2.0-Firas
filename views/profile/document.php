<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\Tbltrainingduration;

/** @var yii\web\View $this */
/** @var app\models\Tbltraining $model */
/** @var yii\widgets\ActiveForm $form */

$backindex = '/training';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');

?>


<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>






<div class="row">
    <div class="col-sm-10"></div>
    <div class="col-sm-2 align-items-end">
        <button class="btn btn-primary" id="NewUpload" name="NewUpload">Upload</button>
        
    </div>
</div>


<div class="row pt-2">

    <table>
        <tr>
            <th>No</th>
            <th>Document</th>
            <th>Date</th>
            <th>Upload By</th>
            <th>.:.</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Maria Anders</td>
            <td>Alfreds Futterkiste</td>
            <td>Germany</td>
            <td>Germany</td>
        </tr>

    </table>

</div>


<?php

$profile_upload = Url::toRoute(['/profile/upload']);

$createxxw = Url::toRoute(['/document/uploadhr']);

$script = <<<JS


$(document).off('click', '#NewUpload').on('click', '#NewUpload', function () {

    
    
    var form = $(this);
      $.ajax({
	    	url: '$createxxw',
            type   : 'GET',
			
             success: function (response) 
            {           
				$("#modal-md").modal("show");
                $("#modalContent-md").html(response).modal();							
				document.getElementById('modalHeader-md').innerHTML = '<h4>Upload Documentxxxxxxxxxa</h4>';    
        
				console.log(response);
       

            },
            error  : function (e) {
				
               // console.log(e);
            }
        });
    return false;        
  });




       
$('#staffdocument').on('beforeSubmit', function (e) {

            e.preventDefault();           

            var formData = new FormData($(this)[0]);

            $.ajax({
                url: '$profile_upload', // Replace with the actual URL of your upload action
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    response = JSON.parse(response);
                    if (response.success) {
                        alert(response.message);
                    } else {
                        alert('Error: ' + response.message);
                    }
                }
            });

            return false;
   });





JS;
$this->registerJs($script);
?>