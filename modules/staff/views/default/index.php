<?php

use app\models\tbluser;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Home');
$this->params['breadcrumbs'][] = $this->title;


?>
<div id="toast-container" class="toast-top-right"></div>

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
                           
                                </div>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">

                    <!-- Content here Start -->

                 

                        
                        
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4>
                                    <div id="select_data"></div>
                                </h4>
                                <input type="hidden" name="select_id" id="select_id" />
                            </div>
                        </div>
                    </div>

                  
                    <div class="row g-3">
                  
                    
                  <?php  

                       
                         //Yii::$app->request->baseUrl.'staff/sendemail';
                      ///   Yii::$app->getResponse()->redirect(['staff/sendemail'])->send();

                        //  Yii::$app->request->redirect(Yii::$app->request->baseUrl.'staff/sendemail');

                        // $location =  \Yii::getAlias('@saftyimg');

                        // $path = $location.'/image2.png'; 
                                  
                        // if($fp = fopen($path,"rb", 0)) //open file
                        // { 
                        //     $path = fread($fp,filesize($path)); //read file
                        //     fclose($fp); 
                        //     $path = chunk_split(base64_encode($path)); //encode image to base64
                        //    // $encode = '<img src="data:image/jpeg;base64,' . $path .'"  width="210"; height="280">'; 
                        //     $encode ='<img src="data:image/jpeg;base64,' . $path .'"  class="img-fluid" style="width:5%; height:5%;">';

                            
                        //    echo $encode; //show image

                            
                       

                        // }


                      


                        ?>
  
                    
            </div>
        </div>
    </div>
</div>
<?php

/**********************************************************************************/
$url = Url::toRoute(['sendemail']);


$script = <<<JS


	$(document).on('click', '.showModal_Email', function () {

      var form = $(this);
      
      $.ajax({
	    	url: '$url',
            type   : 'GET',
		
            error  : function (e) {
				   // console.log(e);
            }
         
        });
    return false;        
  });
 
  /**********************************************************************************/

  

JS;
$this->registerJs($script);


?>

