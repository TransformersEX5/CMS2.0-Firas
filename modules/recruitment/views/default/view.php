<?php

use app\models\Tblbranch;
use app\models\Tbldepartment;
use app\models\Tblposition;
use app\models\Tbluser;

?>

<div class="col-12">
    <div class="card">
        <div class="card-header bg-primary rounded">
            <h3 class="card-title text-white">Manpower Requisition Form</h3>
        </div>
    </div>
</div>

<div class="col-lg-7 col-md-7 col-sm-12">
    <div class="card">
        <div class="card-body">

            <div class="row">

                <div class="col-12">
                    <div class="text-end">
                        Current status : <strong><i><?= $StatusDesc ?></i></strong><br>
                        Requested by : <strong><i><?= Tbluser::findOne(['UserId' => $model->UserId])->FullName; ?></i></strong>
                    </div>
                </div>

                <div class="col-12">
                    <hr>
                    <h5>Job Brief</h5>
                </div>

                <div class="col-12">
                    <?= $model->JobBrief; ?>
                </div>

                <div class="col-12 mt-4">
                    <h5>Job Description</h5>
                </div>

                <div class="col-12 mt-4">
                    <?= $model->JdDetail; ?>
                </div>

                <div class="col-12 mt-4">
                    <h5>Basic Qualification</h5>
                </div>

                <div class="col-12">
                    <?= $model->BasicQualification; ?>
                </div>

                <div class="col-12 mt-4">
                    <h5>Responsibilities & Duties (To be included in LOA only)</h5>
                </div>

                <div class="col-12">
                    <?= $model->Responsibilities; ?>
                </div>
                                    
                
            </div>
        </div>
    </div>
</div>

<div class="col-lg-5 col-md-5 col-sm-12">
    <div class="card">
        <div class="card-body">

            <div class="row">

                <div class="col-12">
                    <h4 class="card-title">General Information</h4>
                </div>

                <hr>

                <div class="col-6">
                    Position :
                </div>
                <div class="col-6">
                    <strong><?= Tblposition::findOne(['PositionId' => $model->PositionId])->PositionName; ?></strong>
                </div>

                <div class="col-6 mt-2">
                    Branch :
                </div>
                <div class="col-6">
                    <strong><?= Tblbranch::findOne(['BranchId' => $model->BranchId])->BranchName; ?></strong>
                </div>

                <div class="col-6 mt-2">
                    Faculty/Department :
                </div>
                <div class="col-6">
                    <strong><?= Tbldepartment::findOne(['DepartmentId' => $model->FacultyId])->DepartmentDesc; ?></strong>
                </div>

                <div class="col-6 mt-2">
                    Publish Date :
                </div>
                <div class="col-6">
                    <strong><?= $model->StartDate; ?></strong>
                </div>

                <div class="col-6 mt-2">
                    Expiry Date :
                </div>
                <div class="col-6">
                    <strong><?= $model->EndDate; ?></strong>
                </div>

                <div class="col-6 mt-2">
                    Salary range :
                </div>
                <div class="col-6">
                    <strong>RM <?= $model->SalaryMin; ?></strong> - <strong>RM <?= $model->SalaryMax; ?></strong>
                </div>

                <div class="col-12 mt-3">
                    Remarks :
                </div>
                <div class="col-12">
                    <strong><?= $model->Remarks; ?></strong>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-12">
                    <h4 class="card-title">MRF Process History</h4>
                    <hr>

                    <div class="table-rep-plugin">
                        <table id="tbldraft" class="table table-bordered w-100">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th width="60%">Status</th>
                                    <th width="35%">Remarks</th>
                                    <!-- <th class="text-center" width="20%">Transaction Date</th> -->
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $i = 1;
                                $totalArray = count($ApprovalHistory);

                                foreach ($ApprovalHistory as $ApprovalHistory) { ?>
                                    <tr>
                                        <td class="text-center"><?= $i ?></td>

                                        <td>
                                            <?php if ($i == 1) { ?>
                                                <span class="badge bg-info mb-2">Current Status</span>
                                            <?php } ?>

                                            <div class="d-absolute">
                                                <?= $ApprovalHistory['StatusDetails'] ?>
                                            </div>
                                        </td>

                                        <td><?= $ApprovalHistory['Remarks'] ?></td>
                                    </tr>
                                <?php $i++;
                                } ?>

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

