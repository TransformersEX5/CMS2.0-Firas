<?php

use app\models\tblrmcinformation;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\ActionColumn;
use yii\grid\GridView;

?>
<style>
    table#cmstable1 tbody td div {

        word-wrap: break-word;
    }
</style>
<div class="tblrmc-index">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex text-white bg-primary">
                    <h4 class="card-title mb-0 flex-grow-1  ">
                        Research Information
                    </h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                        <button id="New" class="btn btn-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#researchModal"> New <i class="icon-file"></i></button>
                            
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                 <div class="modal fade" id="researchModal" tabindex="-1" aria-labelledby="researchModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="researchModalLabel">New Research Information</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="cluster" class="form-label">Cluster of Research:</label>
                                        <select class="form-control" id="cluster" name="cluster" required>
                                            <option value="">Select Cluster</option>
                                            <option value="Educational Technology & Digital Learning">Educational Technology & Digital Learning</option>
                                            <option value="Curriculum & Pedagogy Innovation">Curriculum & Pedagogy Innovation</option>
                                            <option value="STEM Education & Science Literacy">STEM Education & Science Literacy</option>
                                            <option value="Language & Literacy Studies">Language & Literacy Studies</option>
                                            <option value="Inclusive & Special Education">Inclusive & Special Education</option>
                                            <option value="Higher Education & Leadership">Higher Education & Leadership</option>
                                            <option value="Educational Psychology & Student Well-being">Educational Psychology & Student Well-being</option>
                                            <option value="Sociology of Education & Equity">Sociology of Education & Equity</option>
                                            <option value="TVET (Technical & Vocational Education & Training)">TVET (Technical & Vocational Education & Training)</option>
                                            <option value="Sustainable Education & Environmental Learning">Sustainable Education & Environmental Learning</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="field" class="form-label">Field of Research:</label>
                                        <input type="text" class="form-control" id="field" name="field" required>
                                    </div>
                                    
                                    <div class="mb-3 row align-items-center">
                                        <label for="duration" class="col-auto col-form-label">Duration of Research:</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="duration" name="duration" required>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="start-date" class="form-label">Start Date:</label>
                                            <input type="date" class="form-control" id="start-date" name="start-date" required>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="end-date" class="form-label">End Date:</label>
                                            <input type="date" class="form-control" id="end-date" name="end-date" required>
                                        </div>
                                    </div>
                    
                                    <div class="mb-3">
                                        <label for="location" class="form-label">Location of Research:</label>
                                        <input type="text" class="form-control" id="location" name="location" required>
                                    </div>  
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>  
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Cluster of Research:</label>
                        </div>
                        <div class="col-md-6">
                            <label>Field of Research:</label>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <label>Duration of Research:</label>
                        </div>
                        <div class="col-md-6">
                            <label>Start Date:</label>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <label>End Date:</label>
                        </div>
                        <div class="col-md-6">
                            <label>Location of Research:</label>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>