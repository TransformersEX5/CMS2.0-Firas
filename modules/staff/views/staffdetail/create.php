
<div class="row">
                                <div class="col col-lg-8 mt-2">
                                    Full Name : <?= $form->field($model, 'FullName')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3 mt-2">
                                    NIRC/Passport No :
                                    <?= $form->field($model, 'ICPassportNo')->textInput(['maxlength' => true]) ?>
                                </div>

                                <div class="col-3 mt-2">
                                    Nationality:
                                    <?= $form->field($model, 'NationalityId')->dropDownList(Yii::$app->common->getNationality(), [
                                        'prompt' => '-  Nationality   -',
                                        'class' => 'form-select mb-2',
                                        'id' => 'NationalityId'
                                    ]) ?>
                                </div>


                                <div class="col-3 mt-2">
                                    Gender :
                                    <?= $form->field($model, 'Gender')->dropDownList(Yii::$app->common->getGender(), [
                                        'prompt' => '-  Gender   -',
                                        'class' => 'form-select mb-2',
                                        'id' => 'GenderId'
                                    ]) ?>
                                </div>

                            </div>


                            <div class="row">

                                <div class="col-3 mt-2">
                                    User Dob:
                                    <div class="input-group" id="datepicker2">
                                        <?= $form->field($model, 'UserDOB')->textInput(['maxlength' => true, 'placeholder' => "dd-mm-yyyy", 'data-date-format' => "dd-mm-yyyy", 'data-provide' => "datepicker", 'data-date-autoclose' => "true", 'data-date-container' => "#datepicker2"]); ?>
                                        <!-- <span class="input-group-text"><i class="mdi mdi-calendar"></i></span> -->
                                    </div>
                                </div>

                                <div class="col-3 mt-2">
                                    Religion:
                                    <?= $form->field($model, 'ReligionId')->dropDownList(Yii::$app->common->getReligion(), [
                                        'prompt' => '-  Religion   -',
                                        'class' => 'form-select mb-2',
                                        'id' => 'ReligionId'
                                    ]) ?>
                                </div>

                                <div class="col-3 mt-2">
                                    Marital Status:
                                    <?= $form->field($model, 'MaritalStatusId')->dropDownList(Yii::$app->common->getMarital(), [
                                        'prompt' => '-  Marital Status   -',
                                        'class' => 'form-select mb-2',
                                        'id' => 'MaritalStatusId'
                                    ]) ?>
                                </div>

                                <div class="row">
                                    <div class="col-4 mt-2">
                                        CityU Email Address (@city.edu.my) :
                                        <?= $form->field($model, 'EmailAddress')->textInput(['maxlength' => true]) ?>
                                    </div>

                                    <div class="col-4 mt-2">
                                        Personal Email Address :
                                        <?= $form->field($model, 'PersonalEmail')->textInput(['maxlength' => true]) ?>
                                    </div>

                                    <div class="col-3 mt-2">
                                        Hand Set No :
                                        <?= $form->field($model, 'HandSetNo')->textInput(['maxlength' => true]) ?>
                                    </div>


                                </div>



                                <div class="col-4 mt-2">
                                    Location:
                                    <?= $form->field($model, 'BranchId')->dropDownList(Yii::$app->common->getBranchName(), [
                                        'prompt' => '-  Location    -',
                                        'class' => 'form-select mb-2',
                                        'id' => 'BranchId'
                                    ]) ?>
                                </div>


                                <!-- 
                                <div class="col-6 mt-2">
                                    <?= $form->field($model, 'Remarks')->textarea(['rows' => '3']) ?>

                                </div> -->

