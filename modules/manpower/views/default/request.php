<?php
/* @var $this yii\web\View */

use app\models\Tblbranch;
use app\models\Tblcareerapprovalsetup;
use app\models\Tbldepartment;
use app\models\Tblposition;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;

?>


<div class="col-lg-6 col-md-6 col-sm-12">
    <div class="card">
        <div class="card-body">

            <div class="col-12">
                <h4 class="card-title">Manpower Requisition Form (MRF)</h4>
                <hr>
            </div>

            <?php $form = ActiveForm::begin(['id' => 'Career']); ?>

            <div class="row">

                <div class="col-md-12">
                    <h5 class="text-danger">Notes:</h5>
                    <ul>
                        <li>Please use 14 as font size.</li>
                        <li>Do not include company's decription/background as it is already embedded inside the career website.</li>
                    </ul>

                    <hr>

                    <div class='form-group'>

                        <?= $form->field($model, 'JobBrief')->widget(CKEditor::className(), [
                            'options' => ['rows' => 5],

                            'preset' => 'custom',
                            'clientOptions' => [
                                'removeButtons' => 'Document,PasteText,PasteFromWord,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,
                                                        TextField,Textarea,Select,Button,ImageButton,HiddenField,RemoveFormat,CreateDiv,Blockquote,ShowBlocks,
                                                        Iframe,InsertPre,PageBreak,Smiley,Flash,Table,Language,Templates,Print,Preview,DocProps,NewPage,Save,
                                                        Image,File,About,Link,Unlink,Anchor,Iframe,Image,',

                                'toolbarGroups' => [

                                    ['name' => 'document', 'groups' => ['mode', 'document', 'doctools']],
                                    ['name' => 'clipboard', 'groups' => ['clipboard', 'undo']],
                                    ['name' => 'basicstyles', 'groups' => ['basicstyles', 'colors']],
                                    ['name' => 'paragraph', 'groups' => ['list', 'indent', 'blocks', 'align', 'bidi']],
                                    ['name' => 'insert'],
                                    ['name' => 'styles'],
                                    ['name' => 'tools'],
                                ],
                            ]
                        ])
                        ?>

                    </div>

                    <div class='form-group'>

                        <?= $form->field($model, 'JdDetail')->widget(CKEditor::className(), [
                            'options' => ['rows' => 5],

                            'preset' => 'custom',
                            'clientOptions' => [
                                'removeButtons' => 'Document,PasteText,PasteFromWord,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,
                                                        TextField,Textarea,Select,Button,ImageButton,HiddenField,RemoveFormat,CreateDiv,Blockquote,ShowBlocks,
                                                        Iframe,InsertPre,PageBreak,Smiley,Flash,Table,Language,Templates,Print,Preview,DocProps,NewPage,Save,
                                                        Image,File,About,Link,Unlink,Anchor,Iframe,Image,',

                                'toolbarGroups' => [

                                    ['name' => 'document', 'groups' => ['mode', 'document', 'doctools']],
                                    ['name' => 'clipboard', 'groups' => ['clipboard', 'undo']],
                                    ['name' => 'basicstyles', 'groups' => ['basicstyles', 'colors']],
                                    ['name' => 'paragraph', 'groups' => ['list', 'indent', 'blocks', 'align', 'bidi']],
                                    ['name' => 'insert'],
                                    ['name' => 'styles'],
                                    ['name' => 'tools'],
                                ],
                            ]
                        ])
                        ?>
                    </div>

                    <div class='form-group'>

                        <?= $form->field($model, 'BasicQualification')->widget(CKEditor::className(), [
                            'options' => ['rows' => 5],

                            'preset' => 'custom',
                            'clientOptions' => [
                                'removeButtons' => 'Document,PasteText,PasteFromWord,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,
                                                    TextField,Textarea,Select,Button,ImageButton,HiddenField,RemoveFormat,CreateDiv,Blockquote,ShowBlocks,
                                                    Iframe,InsertPre,PageBreak,Smiley,Flash,Table,Language,Templates,Print,Preview,DocProps,NewPage,Save,
                                                    Image,File,About,Link,Unlink,Anchor,Iframe,Image,',

                                'toolbarGroups' => [

                                    ['name' => 'document', 'groups' => ['mode', 'document', 'doctools']],
                                    ['name' => 'clipboard', 'groups' => ['clipboard', 'undo']],
                                    ['name' => 'basicstyles', 'groups' => ['basicstyles', 'colors']],
                                    ['name' => 'paragraph', 'groups' => ['list', 'indent', 'blocks', 'align', 'bidi']],
                                    ['name' => 'insert'],
                                    ['name' => 'styles'],
                                    ['name' => 'tools'],
                                ],
                            ]
                        ])
                        ?>
                    </div>

                    <div class='form-group'>

                        <?= $form->field($model, 'Responsibilities')->widget(CKEditor::className(), [
                            'options' => ['rows' => 5],

                            'preset' => 'custom',
                            'clientOptions' => [
                                'removeButtons' => 'Document,PasteText,PasteFromWord,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,
                            TextField,Textarea,Select,Button,ImageButton,HiddenField,RemoveFormat,CreateDiv,Blockquote,ShowBlocks,
                            Iframe,InsertPre,PageBreak,Smiley,Flash,Table,Language,Templates,Print,Preview,DocProps,NewPage,Save,
                            Image,File,About,Link,Unlink,Anchor,Iframe,Image,',

                                'toolbarGroups' => [

                                    ['name' => 'document', 'groups' => ['mode', 'document', 'doctools']],
                                    ['name' => 'clipboard', 'groups' => ['clipboard', 'undo']],
                                    ['name' => 'basicstyles', 'groups' => ['basicstyles', 'colors']],
                                    ['name' => 'paragraph', 'groups' => ['list', 'indent', 'blocks', 'align', 'bidi']],
                                    ['name' => 'insert'],
                                    ['name' => 'styles'],
                                    ['name' => 'tools'],
                                ],
                            ]
                        ])
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-6 col-md-6 col-sm-12">
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">
                    <div class='form-group'>
                        <?= $form->field($model, 'PositionId')->dropDownList(ArrayHelper::map(Tblposition::find()->asArray()->orderBy('PositionName ASC')->all(), 'PositionId', 'PositionName'), ['prompt' => 'Select a position', 'class' => 'form-control rounded-pill', 'required' => 'required']) ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class='form-group'>
                        <?= $form->field($model, 'BranchId')->dropDownList(ArrayHelper::map(Tblbranch::findAll(['StateId' => 1]), 'BranchId', 'BranchName'), ['prompt' => 'Select a branch', 'class' => 'form-control rounded-pill', 'required' => 'required']) ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class='form-group'>
                        <?= $form->field($model, 'FacultyId')->dropDownList(ArrayHelper::map(Tbldepartment::find()->where(['StatusId' => [1]])->all(), 'DepartmentId', 'DepartmentDesc'), ['prompt' => 'Select an option', 'class' => 'form-control rounded-pill']) ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class='form-group'>
                        <?= $form->field($model, 'StartDate')->textInput(['type' => 'date', 'class' => 'form-control rounded-pill', 'required' => 'required']) ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class='form-group'>
                        <?= $form->field($model, 'EndDate')->textInput(['type' => 'date', 'class' => 'form-control rounded-pill', 'required' => 'required']) ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class='form-group'>
                        <?= $form->field($model, 'HeadcountId')->dropDownList([1 => 'Yes', 2 => 'No'], ['prompt' => 'Select an option', 'class' => 'form-control rounded-pill']) ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class='form-group'>
                        <?= $form->field($model, 'BudgettedId')->dropDownList([1 => 'Yes', 2 => 'No'], ['prompt' => 'Select an option', 'class' => 'form-control rounded-pill']) ?>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-5">
                            <div class='form-group'>
                                <?= $form->field($model, 'SalaryMin')->textInput(['class' => 'form-control rounded-pill']) ?>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="d-flex justify-content-center pt-4">
                                To
                            </div>
                        </div>
                        <div class="col-5">
                            <div class='form-group'>
                                <?= $form->field($model, 'SalaryMax')->textInput(['class' => 'form-control rounded-pill']) ?>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class='form-group'>
                                <?= $form->field($model, 'SalaryShow')->checkbox(['id' => 'switch1', 'switch' => 'none']) ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-3">
                    <div class='form-group'>
                        <label>Remarks</label>
                        <?= $form->field($model, 'Remarks')->textArea(['rows' => '2', 'class' => 'form-control'])->label(false) ?>
                    </div>
                    <hr>
                </div>

                <div class="col-md-12">
                    <div class="form-group">

                        <span class="text-danger">Caution!</span>

                        <ul>
                            <li class="text-danger">Please choose 'Draft/Pending' to keep the MRF in draft status.</li>
                            <li class="text-danger">Submitted MRF cannot be reversed/undone. Proceed with care.</li>
                        </ul>

                        <?= $form->field($model, 'StatusId', ['labelOptions' => ['class' => 'text-danger']])->dropDownList(ArrayHelper::map(Tblcareerapprovalsetup::findAll(['CareerApprovalSetupId' => [1, 2]]), 'CareerApprovalSetupId', 'SetupDesc1'), ['class' => 'form-control rounded-pill', 'required' => 'required', 'prompt' => 'Please select an action']) ?>
                        
                        <div class='d-flex justify-content-end'>
                            <span class="text-danger">Requested by,<br><i><?= Yii::$app->user->identity->FullName ?></i></span>
                        </div>

                    </div>
                </div>

                <div class="col-md-12">
                    <div class='form-group'>
                        <hr>
                        <div class='d-flex justify-content-end'>
                            <button type="submit" class="btn btn-md btn-primary">Submit</button>
                        </div>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

<?php if($CurrentStatus != 1 && $CurrentStatus != 0) { ?>

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="row">

            <div class="col-12">
                    <h4 class="card-title">Approval History</h4>
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

                                            <?php if ($i == $totalArray) { ?>
                                                <div class="d-flex justify-content-end">
                                                    <span class="badge bg-info">Current Status</span>
                                                </div>
                                            <?php } ?>

                                            <div class="d-inline">
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

<?php } ?>