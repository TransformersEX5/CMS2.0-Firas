<?php

/** @var yii\web\View $this */

$this->title = 'Admin';

use yii\helpers\Url;

?>

<?php

$module = '/' . Yii::$app->controller->module->id;

$url = Url::base() . $module . '/default/efcstudentlist';

$_csrf = Yii::$app->request->getCsrfToken();

$script = <<<JS

$( document ).ready(function() {

    var table = $('#datatable-efcstudent').DataTable({
            
        // lengthChange:false,			
        processing: true,
        deferRender:false,			
        // searching:true,
        responsive:true,			
        bFilter:false,
        destroy:true,			
        pageLength: 3,
        paging:true,	
        info: false,	
        scrollY: true,  
        autoWidth: true, 
        dom: 'Bfrtip',                      
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
            {"data":"StudNRICPassportNo", class:"text-dark"},		
            {"data":"StudentNo", class:"text-dark text-center"},
            {"data":"NationalityName", class:"text-dark text-center"},	
            {"data":"FacultyCode", class:"text-dark text-center"},		
            {"data":"FacultyName", class:"text-dark text-center"},		
            {"data":"ProgramCode", "width": '11.0%', class:"text-dark"},	
            {"data":"ProgramCode2", "width": '11.0%', class:"text-dark"},	
            {"data":"ProgramName", class:"text-dark text-center"},	
            {"data":"Robesize", "width": '1.0%', class:"text-dark text-center"},	
            {"data":"TotalOuts", "width": '1.0%', class:"text-dark text-center"},	
            {"data":"ConvocationFee", "width": '8.2%', class:"text-dark text-center"},	
            {"data":"TransactionDate", "width": '8.2%', class:"text-dark text-center"},	
            {"data":"ConvocationRegisterStatus", "width": '9.0%', class:"text-dark text-center"},																	
        ],
        buttons: [
        'copy', 'excel'
    ],

    });
});



JS;
$this->registerJs($script);

?>

<style>
    th {
        text-align: center;
        color: red;
    }

    td {
        text-align: center;
    }
</style>

<div class="col-12">
    <div class="card">
        <h4 class="card-header mt-0 text-dark bg-white rounded">Dashboard</h4>
        <div class="card-body">

        <div class="table-rep-plugin">
                <div class="b-0">
                    <table id="datatable-efcstudent" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-dark">No.</th>
                                <th class="text-dark">DataFrom</th>
                                <th class="text-dark">Student Name</th>
                                <th class="text-dark">NRICPassportNo</th>
                                <th class="text-dark">Student No.</th>
                                <th class="text-dark">Nationality</th>
                                <th class="text-dark">Faculty Code</th>
                                <th class="text-dark">Faculty</th>
                                <th class="text-dark">Program Code</th>
                                <th class="text-dark">Program Code 2</th>
                                <th class="text-dark">Program Name</th>
                                <th class="text-dark">Robe Size</th>
                                <th class="text-dark">Outs</th>
                                <th class="text-dark">Convo Fee</th>
                                <th class="text-dark">Status Date</th>
                                <th class="text-dark">Register Status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div>
                <h5>Convocation Registration Summary (Attend Students Only)</h5>
            </div>
            <div class="table-rep-plugin">
                <div class="table-responsive mb-0">
                    <table border="0" id="tech-companies-1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="background-color: #A7DCA5;" rowspan="2" class="align-middle text-dark">Number of Registration</th>
                                <th style="background-color: #A7DCA5;" colspan="2" class="text-dark">Confirm Seat</th>
                                <th style="background-color: #A7DCA5;" colspan="2" class="text-dark">Tracer Study</th>
                                <th style="background-color: #A7DCA5;" colspan="2" class="text-dark">Fee</th>
                                <th style="background-color: #A7DCA5;" colspan="2" class="text-dark">Residency</th>
                            </tr>
                            <tr>
                                <th style="background-color: #A7DCA5;" class="text-dark">Confirm</th>
                                <th style="background-color: #A7DCA5;" class="text-dark">Not Confirm</th>
                                <th style="background-color: #A7DCA5;" class="text-dark">Submit</th>
                                <th style="background-color: #A7DCA5;" class="text-dark">Not Submit</th>
                                <th style="background-color: #A7DCA5;" class="text-dark">Paid</th>
                                <th style="background-color: #A7DCA5;" class="text-dark">Unpaid</th>
                                <th style="background-color: #A7DCA5;" class="text-dark">Local</th>
                                <th style="background-color: #A7DCA5;" class="text-dark">International</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $row) { ?>
                                <tr>
                                    <td class="text-dark"><?= $row['TotalRegistration']; ?></td>
                                    <td class="text-dark"><?= $row['ConfirmSeat']; ?></td>
                                    <td class="text-dark"><?= $row['NotConfirmSeat']; ?></td>
                                    <td class="text-dark"><?= $row['TracerSubmit']; ?></td>
                                    <td class="text-dark"><?= $row['TracerNotSubmit']; ?></td>
                                    <td class="text-dark"><?= $row['FeePaid']; ?></td>
                                    <td class="text-dark"><?= $row['FeeUnpaid']; ?></td>
                                    <td class="text-dark"><?= $row['ResidencyLocal']; ?></td>
                                    <td class="text-dark"><?= $row['ResidencyInternational']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <br>

            <div>
                <h5>Convocation Registration Summary (All EFC + Returning Students)</h5>
            </div>
            <div class="table-rep-plugin">
                <div class="table-responsive mb-0">
                    <table border="0" id="tech-companies-1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="background-color: #A7DCA5;" rowspan="2" class="align-middle text-dark">Number of EFC Students</th>
                                <th style="background-color: #A7DCA5;" colspan="2" class="text-dark">Confirm Seat</th>
                                <th style="background-color: #A7DCA5;" colspan="2" class="text-dark">Tracer Study</th>
                                <th style="background-color: #A7DCA5;" colspan="2" class="text-dark">Fee</th>
                                <th style="background-color: #A7DCA5;" colspan="2" class="text-dark">Residency</th>
                            </tr>
                            <tr>
                                <th style="background-color: #A7DCA5;" class="text-dark">Confirm</th>
                                <th style="background-color: #A7DCA5;" class="text-dark">Not Confirm</th>
                                <th style="background-color: #A7DCA5;" class="text-dark">Submit</th>
                                <th style="background-color: #A7DCA5;" class="text-dark">Not Submit</th>
                                <th style="background-color: #A7DCA5;" class="text-dark">Paid</th>
                                <th style="background-color: #A7DCA5;" class="text-dark">Unpaid</th>
                                <th style="background-color: #A7DCA5;" class="text-dark">Local</th>
                                <th style="background-color: #A7DCA5;" class="text-dark">International</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data2 as $row2) { ?>
                                <tr>
                                    <td class="text-dark"><?= $row2['AllRegistration']; ?></td>
                                    <td class="text-dark"><?= $row2['ConfirmSeat']; ?></td>
                                    <td class="text-dark"><?= $row2['NotConfirmSeat']; ?></td>
                                    <td class="text-dark"><?= $row2['TracerSubmit']; ?></td>
                                    <td class="text-dark"><?= $row2['TracerNotSubmit']; ?></td>
                                    <td class="text-dark"><?= $row2['FeePaid']; ?></td>
                                    <td class="text-dark"><?= $row2['FeeUnpaid']; ?></td>
                                    <td class="text-dark"><?= $row2['ResidencyLocal']; ?></td>
                                    <td class="text-dark"><?= $row2['ResidencyInternational']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-6">
                    <div>
                        <h5>Convocation Nationality Summary (All EFC + Returning Students)</h5>
                    </div>
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0">
                            <table border="0" id="tech-companies-1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="background-color: #A7DCA5;" class="text-dark">Nationality</th>
                                        <th style="background-color: #A7DCA5;" class="text-dark">Number of Students</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data3 as $row3) { ?>
                                        <tr>
                                            <td class="text-dark"><?= $row3['Nationality']; ?></td>
                                            <td class="text-dark"><?= $row3['NumberOfStudents']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <br>

                <div class="col-6">
                    <div>
                        <h5>Convocation Program Type Summary (All EFC + Returning Students)</h5>
                    </div>

                    <div class="accordion" id="accordionExample">
                        <?php
                        $i = 0;
                        foreach ($data4 as $row4) { ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading<?= $i; ?>">
                                    <button class="accordion-button collapsed text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $i; ?>" aria-expanded="true" aria-controls="collapse<?= $i; ?>">
                                        <?= $row4['ProgramTypeName'] . '  (' . $row4['NumberOfStudents'] . ')' ?>
                                    </button>
                                </h2>
                                <div id="collapse<?= $i; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $i; ?>" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="table-rep-plugin">
                                            <div class="table-responsive mb-0">
                                                <table border="0" id="tech-companies-1" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th style="background-color: #A7DCA5;" class="text-dark">Faculty</th>
                                                            <th style="background-color: #A7DCA5;" class="text-dark">Number of Students</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($data5 as $row5) {
                                                            if ($row5['ProgramTypeName'] == $row4['ProgramTypeName']) {
                                                        ?>
                                                                <tr>
                                                                    <td class="text-dark"><?= $row5['FacultyName']; ?></td>
                                                                    <td class="text-dark"><?= $row5['NumberOfStudents']; ?></td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php $i++;
                        } ?>
                    </div>
                    <!-- <div class="table-rep-plugin">
                        <div class="table-responsive mb-0">
                            <table border="0" id="tech-companies-1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="background-color: #A7DCA5;" class="text-dark">Program Type</th>
                                        <th style="background-color: #A7DCA5;" class="text-dark">Number of Students</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data4 as $row4) { ?>
                                        <tr>
                                            <td class="text-dark"><?= $row4['ProgramTypeName']; ?></td>
                                            <td class="text-dark"><?= $row4['NumberOfStudents']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php

$module = '/' . Yii::$app->controller->module->id;

$script = <<<JS

JS;
$this->registerJs($script);

?>