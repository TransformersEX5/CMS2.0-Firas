<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;

use yii\helpers\VarDumper;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Credit Control ');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Latest Collection</h4>
                <table id="cmstable1" class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Day</th>
                            <th>Month</th>
                            <th>Year</th>

                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Latest Orders</h4>

                <div class="table-responsive">
                    <table class="table align-middle table-centered table-vertical table-nowrap mb-1">

                        <tbody>
                            <tr>
                                <td>#12354781</td>
                                <td>
                                    <img src="assets/images/users/user-1.jpg" alt="user-image" class="avatar-xs me-2 rounded-circle" /> Riverston Glass Chair
                                </td>
                                <td><span class="badge rounded-pill bg-success">Delivered</span></td>
                                <td>
                                    $185
                                </td>
                                <td>
                                    5/12/2016
                                </td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                </td>
                            </tr>

                            <tr>
                                <td>#52140300</td>
                                <td>
                                    <img src="assets/images/users/user-2.jpg" alt="user-image" class="avatar-xs me-2 rounded-circle" /> Shine Company Catalina
                                </td>
                                <td><span class="badge rounded-pill bg-success">Delivered</span></td>
                                <td>
                                    $1,024
                                </td>
                                <td>
                                    5/12/2016
                                </td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                </td>
                            </tr>

                            <tr>
                                <td>#96254137</td>
                                <td>
                                    <img src="assets/images/users/user-3.jpg" alt="user-image" class="avatar-xs me-2 rounded-circle" /> Trex Outdoor Furniture Cape
                                </td>
                                <td><span class="badge rounded-pill bg-danger">Cancel</span></td>
                                <td>
                                    $657
                                </td>
                                <td>
                                    5/12/2016
                                </td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                </td>
                            </tr>

                            <tr>
                                <td>#12365474</td>
                                <td>
                                    <img src="assets/images/users/user-4.jpg" alt="user-image" class="avatar-xs me-2 rounded-circle" /> Oasis Bathroom Teak Corner
                                </td>
                                <td><span class="badge rounded-pill bg-warning">Shipped</span></td>
                                <td>
                                    $8451
                                </td>
                                <td>
                                    5/12/2016
                                </td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                </td>
                            </tr>

                            <tr>
                                <td>#85214796</td>
                                <td>
                                    <img src="assets/images/users/user-5.jpg" alt="user-image" class="avatar-xs me-2 rounded-circle" /> BeoPlay Speaker
                                </td>
                                <td><span class="badge rounded-pill bg-success">Delivered</span></td>
                                <td>
                                    $584
                                </td>
                                <td>
                                    5/12/2016
                                </td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#12354781</td>
                                <td>
                                    <img src="assets/images/users/user-6.jpg" alt="user-image" class="avatar-xs me-2 rounded-circle" /> Riverston Glass Chair
                                </td>
                                <td><span class="badge rounded-pill bg-success">Delivered</span></td>
                                <td>
                                    $185
                                </td>
                                <td>
                                    5/12/2016
                                </td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->





<?php

$url = Url::toRoute(['/creditcontrol/dashboard/collectionlist']);


$js = <<< JS


$(document).ready(function () {

    getDatatable();

    function getDatatable(){

$('#cmstable1').dataTable().empty();

    var table = $('#cmstable1').DataTable({
        lengthChange:false,			
        processing: true,
        serverSide: true,
        //responsive:true,				
        //deferRender:true,			
        destroy:true,			
        pageLength: 20,
        searching:false,
        paging:false,			
        //scrollY: true,   
        //dom: 'Bfrtip',                      
        ajax: { 
            url: '$url',
            type: 'GET',
            data: {   
                }
        },
    
        "columns": [				
            {"data":"FullName"},	
            {"data":"QToday"},                           
            {"data":"QMonth"},	                
            {"data":"QYear"},	                
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
            
        });

    

}




});

JS;
$this->registerJs($js);
?>