   <?php
   use yii\helpers\Html;
   use yii\widgets\ActiveForm;
   use yii\helpers\Url;
   ?>
   <div class="row">
       <div class="col-sm-12">
           <h2 class="card-title">Spouse Information <i class="fas fa-plus form-check form-switch form-switch-right form-switch-md ms-2 update_spouse" title=" To Add Spouse Information"></i></h2>
       </div>

       <br>

   </div>

   <hr>

   <div class="row">

       <div class="col-sm-12">
           <h2 class="card-title">Children Information <i class="fas fa-plus form-check form-switch form-switch-right form-switch-md ms-2 update_children" title=" To Add Children Information"></i></h2>
       </div>

       <br>

   </div>


   
<?php
// $TrainingId = $_GET['TrainingId'];
// $stafflist = Url::toRoute(['/trainingpaticipant/trainingstafflist']);

$spouse = Url::toRoute(['/profile/family/spouse']);
$children = Url::toRoute(['/profile/family/children ']);

$script = <<<JS


$(document).on('click', '.update_spouse', function () {	
    var form = $(this);
    $.ajax({
          url: '$spouse ',
          type   : 'GET',
          data: {
              // DepartmentId: $("#select_id").val(),
               },
               success: function (response) 
          {                     
              $('#modal-lg').modal('show');
              $('#modalContent-lg').html(response).modal();							
              document.getElementById('modalHeader-lg').innerHTML = '<h4>Spouse</h4>';
          },
          error  : function (e) {
                 // console.log(e);
          }
      });
  return false;        
});


$(document).on('click', '.update_children', function () {	
    var form = $(this);
    $.ajax({
          url: '$children ',
          type   : 'GET',
          data: {
              // DepartmentId: $("#select_id").val(),
               },
               success: function (response) 
          {                     
              $('#modal-lg').modal('show');
              $('#modalContent-lg').html(response).modal();							
              document.getElementById('modalHeader-lg').innerHTML = '<h4>Children</h4>';
          },
          error  : function (e) {
                 // console.log(e);
          }
      });
  return false;        
});

JS;
$this->registerJs($script);
?>

