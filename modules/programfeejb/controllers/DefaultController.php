<?php

namespace app\modules\programfeejb\controllers;


use Yii;
use app\modules\programfeejb\models\Tblprogramfeecategory;
use app\modules\programfeejb\models\Tblprogramfeecategorydetail;
use app\modules\programfeejb\models\Tblprogramfeecategorystatus;
use app\modules\programfeejb\models\Tblprogramfee;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;
use yii\helpers\URL;
use yii\web\ForbiddenHttpException;

/**
 * Default controller for the `programfee` module
 */
class DefaultController extends Controller
{

    public $layout = '@app/views/layouts/lexapurple_layouts';

    public function actionGet_combobox_programfeegroup()
    {
        // Fetch items based on the provided category ID
        $model2 = new Tblprogramfeecategory();

        $output1 = [];
        $output1['data'] = '';

        $data3 = $model2->get_combobox_programfeegroup();
        //$output1['data'] = $data3;

        $data = [];
        foreach ($data3 as $item) {
            $data[] = ['id' => $item['ProgFeeCatId'], 'name' => $item['ProgFeeCode2']];
        }



        // Return items as JSON
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }



    public function actionFeegroupvsprogramlist()
    {
        $model2 = new Tblprogramfeecategory();

        $output1 = [];
        $output1['data'] = '';

        $data3 = $model2->getFeeGroupvsProgramList();
        $output1['data'] = $data3;

        if (count($output1) > 0) {
            return json_encode($output1);
        } else {
            return json_encode($output1);
        }
    }



    public function actionGet_combobox_programfeegroup_xx()
    {

        $model2 = new Tblprogramfeecategory();

        $output1 = [];
        $output1['data'] = '';

        $data3 = $model2->get_combobox_programfeegroup();
        $output1['data'] = $data3;

        if (count($output1) > 0) {
            return json_encode($output1);
        } else {
            return json_encode($output1);
        }
    }


    public function actionFeestructure()
    {
        $model2 = new Tblprogramfeecategory();

        $output1 = [];
        $output1['data'] = '';

        $data3 = $model2->getFeeStructure();
        $output1['data'] = $data3;

        if (count($output1) > 0) {
            return json_encode($output1);
        } else {
            return json_encode($output1);
        }
    }




    public function actionProgramlist()
    {
        $model = new Tblprogramfeecategory();

        $output = [];
        $output['data'] = '';

        $data = $model->getProgramlist();
        $output['data'] = $data;

        if (count($output) > 0) {
            return json_encode($output);
        } else {
            return json_encode($output);
        }
    }


    public function actionProgramfeecategorylist()
    {
        $model = new Tblprogramfeecategory();

        $output = [];
        $output['data'] = '';

        $data = $model->getProgramfeecategorylist();
        $output['data'] = $data;

        if (count($output) > 0) {
            return json_encode($output);
        } else {
            return json_encode($output);
        }
    }



    public function actionProgramintakelist($txtprogramid)
    {
        $model = new Tblprogramfeecategory();

        $output = [];
        $output['data'] = '';


        $data = $model->getProgramintake();
        $output['data'] = $data;

        // if (count($output) > 0) {
        //     return json_encode($output);
        // } else {
        //     return json_encode($output);
        // }
        $tbl = "";


        $tbl .= "<table style='width:100%'> ";
        $tbl .= "<th style='color: black; text-align: right';>
                 <div class='d-flex justify-content-end align-items-baseline'> <div class='form-check checkbox-xl'>
                 <input class='form-check-input myfeeintake' type='checkbox'  id=ProgramIntIdAll '  data-toggle='tooltip' title='Check/Uncheck All'> </div></div> </th>";
        $tbl .= "<th style='color: black; text-align: left';> Batch/Intake </th>";
        $tbl .= "<th style='color: black; text-align: left';> Fee Group </th>";
        $tbl .= "<th style='color: black; text-align: left';> User </th>";

        $tbl .= "<th style='color: black; text-align: left';> <button type='button' class='btn btn-primary w-100' id='btn_setfeegroup'> <i class='ri-equalizer-fill me-2 align-bottom'></i>Set Fee Group</button> </th>";


        $i = 1;


        foreach ($data as $data) {

            $ProgramIntId = $data['ProgramIntId'];
            $ProgFeeCatId = $data['ProgFeeCatId'];
            $ProgramFeeId = $data['ProgramFeeId'];

            // Find the position of the first '->'
            $arrowPosition = strpos($data['ProgFeeCode2'], '->');

            // Extract the substring before the first '->'
            $beforeArrow = substr($data['ProgFeeCode2'], 0, $arrowPosition);

            // Make the substring bold and concatenate it with the rest of the string
            $formattedText = '<strong>' . $beforeArrow . '</strong>' . substr($data['ProgFeeCode2'], $arrowPosition);

            $tbl .= "<tr class='rowClick' style=' text-align: left; border: 0px solid #ddd; border-bottom: 0px solid #ddd;  height: 40px; 'value='$ProgFeeCatId'>";

            if (empty($ProgFeeCatId)) {
                $tbl .= "<td>" . '<div class="d-flex justify-content-end align-items-baseline"> <div class="form-check checkbox-xl">
                <input class="form-check-input myfeeintake " type="checkbox"  value =' . $ProgramIntId . ' id=ProgramIntId ">                                 
                               </div></div>' . "</td>";
            } else {
                $tbl .= "<div>";
                // $tbl .= '<td> <a href="#" onclick="Delete_StudentFile();"> <i class="mdi mdi-close-thick"></i> </a> </td>';
                $tbl .= '<td> <div class="d-flex justify-content-end align-items-baseline"> <button  id="removefeegroup" value =' . $ProgramFeeId . ' class="btn btn-success btn-xs" type="button"> X <i  class="icon-file"></i></button>';
                $tbl .= "</div></div>";
            }

            $tbl .= "<td>" . $data['IntakeYrMo'] . "</td>";
            $tbl .= "<td><a href='#' value='" . $beforeArrow . "' class='scrollTop' style='color:blue;'>" . $beforeArrow . "</a>" . substr($data['ProgFeeCode2'], $arrowPosition) . "</td>";
            $tbl .= "<td>" . $data['ShortName'] . "</td>";

            $i++;
        }
        $tbl .= "<td></td>";

        $tbl .= "</table> ";

        //     $tbl .= "<script>
        //     function handleTableRowClick(row) {
        //         alert('Row clicked!'); // You can customize this alert message
        //     }
        // </script>";


        return $tbl;
    }


    public function actionSaveprogramfee()
    {

        $data = Yii::$app->request->post();
        $success = false;

        $ProgramIntId   = $data['ProgramIntId'];
        $ProgramId      = $data['ProgramId'];
        $ResidencyId    = $data['ResidencyId'];
        $FeeStructureId = $data['FeeStructureId'];
        $ProgramTypeId  = $data['ProgramTypeId'];
        $cbo_programfee  = $data['cbo_programfee'];





        if ($_POST) {


            $temp = explode(',', $ProgramIntId);

            foreach ($temp as $temp1) {
                $model = new Tblprogramfee();
                $model->ProgramIntId    = $temp1;
                $model->ProgramId       = $ProgramId;
                $model->Residency       = $ResidencyId;
                $model->SessionId       = 1;
                $model->FeeStructureId  = $FeeStructureId;
                $model->ProgFeeCatId    = $cbo_programfee;
                $model->FeeStructureId  = $FeeStructureId;

                $model->UserId          = Yii::$app->user->identity->UserId;

                if ($model->save()) {
                    $success = true;
                }
            }


            if ($success == true) {
                ///Yii::$app->session->setFlash('success', "Record  successfully Update.");
                $response = [
                    'status' => 1,
                    'message' => 'Record Successfully Update'
                ];

                // return json_encode(array('status' => 1, 'type' => 'success', 'message' => 'Contact created successfully.'));
                return json_encode($response);
            } else {
                //Yii::$app->session->setFlash('error', "Record not saved.");
                $response = [
                    'status' => 2,
                    'message' => 'Sorry , Record Not Saved'
                ];

                return json_encode($response);

                // return $model->getErrors();
            }
        }
    }


    public function actionProgramfeecategorydetaillist()
    {
        $model = new Tblprogramfeecategorydetail();

        $output = [];
        $output['data'] = '';

        $data = $model->getProgramfeecategorydetaillist();
        $output['data'] = $data;
        $Gtotal = 0;
        $tbl = '';

        $tbl .= "<table border=0 style='border-collapse: collapse;  width: 85%;  margin: 0.5em; padding: 0.5em; table table-bordered>";
        $tbl .= "<tr style='text-align: center; border: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #04AA6D; ' >";
        $tbl .= "<th style='color: black; text-align: center';>Sem No</th>";
        $tbl .= "<th style='color: black; text-align: center';>Fee Amt</th>";
        $tbl .= "<th style='color: black; text-align: center';>Fee Type</th>";
        $tbl .= "<th style='color: black; text-align: center';>.:.</th>";
        // $tbl .= "<th width='150px'>.:.</th>";
        $tbl .= "</tr>";
        $i = 1;

        foreach ($data as $data) {

            $tbl .= "<tr style=' text-align: center; border: 1px solid #ddd; border-bottom: 1px solid #ddd; '>";
            $tbl .= "<td>" . $data['SemesterNo'] . "</td>";
            $tbl .= "<td>" . $data['FeeAmount'] . "</td>";
            $tbl .= "<td>" . $data['feetypename'] . "</td>";
            $tbl .= "<td>" . "<button id='ProgramFee_Delete' class='btn btn-secondary btn-sm waves-effect ProgramFee_Delete' type='button'  value=" . $data['ProgFeeCatDetailId'] . "> Delete <i class='icon-file'></i></button></td>";
            $tbl .= "</tr>";
            $i++;
            $Gtotal = $Gtotal + $data['FeeAmount'];
        }

        $tbl .= "<tr style=' text-align: center; border: 1px solid #ddd; border-bottom: 1px solid #ddd; '>";
        $tbl .= "<td> <strong>Total :</strong> </td>";
        $tbl .= "<td> <strong>" .  $Gtotal . " </strong></td>";
        $tbl .= "<td></td>";

        // $tbl .= "<td>" . "<button id='DeleteDuration' class='DayTime_Delete btn btn-sm btn-danger DurationDelete' type='button'  value=" . $data['ProgFeeCatDetailId'] . "> Delete <i class='icon-file'></i></button></td>";
        $tbl .= "</tr>";


        if (count($output) > 0) {
            return $tbl;
        } else {
            return json_encode($output);
        }
    }




    public function actionProgramfeecategorylisthistory()
    {
        $model = new Tblprogramfeecategory();

        $output = [];
        $output['data'] = '';

        $data = $model->getProgramfeecategorylisthistory();
        $output['data'] = $data;
        $Gtotal = 0;
        $tbl = '';

        $tbl .= "<table border=0 style='border-collapse: collapse;  width: 85%;  margin: 0.5em; padding: 0.5em; table table-bordered>";
        $tbl .= "<tr style='text-align: center; border: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #04AA6D; ' >";
        $tbl .= "<th style='color: black;text-align: center';  >Status</th>";
        $tbl .= "<th style='color: black ; text-align: center'; >Transaction</th>";
        $tbl .= "<th style='color: black ; text-align: center'; >User</th>";
        $tbl .= "<th style='color: black ; text-align: center'; >.:.</th>";
        // $tbl .= "<th width='150px'>.:.</th>";
        $tbl .= "</tr>";
        $i = 1;

        foreach ($data as $data) {

            $tbl .= "<tr style=' text-align: center; border: 1px solid #ddd; border-bottom: 1px solid #ddd; '>";
            $tbl .= "<td>" . $data['ApprovalStatus'] . "</td>";
            $tbl .= "<td>" . $data['TransactionDate'] . "</td>";
            $tbl .= "<td>" . $data['FullName'] . "</td>";
            // $tbl .= "<td>" . "<button id='ProgramFee_Delete' class='btn btn-secondary btn-sm waves-effect ProgramFee_Delete' type='button'  value=" . $data['ProgFeeCatDetailId'] . "> Delete <i class='icon-file'></i></button></td>";
            $tbl .= "</tr>";
            $i++;
            // $Gtotal=$Gtotal+$data['FeeAmount'];



        }

        // $tbl .= "<tr style=' text-align: center; border: 1px solid #ddd; border-bottom: 1px solid #ddd; '>";            
        // $tbl .= "<td> <strong>Total :</strong> </td>";
        // $tbl .= "<td> <strong>" .  $Gtotal . " </strong></td>";
        // $tbl .= "<td></td>";

        // $tbl .= "<td>" . "<button id='DeleteDuration' class='DayTime_Delete btn btn-sm btn-danger DurationDelete' type='button'  value=" . $data['ProgFeeCatDetailId'] . "> Delete <i class='icon-file'></i></button></td>";
        $tbl .= "</tr>";


        $tbl .= "</table>";



        if (count($output) > 0) {
            return $tbl;
        } else {
            return json_encode($output);
        }
    }



    public function actionIndex()
    {

        if (yii::$app->user->can('ProgramFee-Index')) {
            $feedetail = new Tblprogramfeecategorydetail();

            return $this->render('index', ['feedetail' => $feedetail]);
        } else {

            $js = <<<JS
              toastr.error('Sorry. You do not have permission to access this feature', 'Access denied');
        JS;

            $this->getView()->registerJs($js, View::POS_READY);

            throw new ForbiddenHttpException(Yii::t('app', 'Access denied. You do not have permission to access this feature.'));
            //return $this->render('index');
        }
    }



    public function actionSetfeegroupprogram()
    {
        $model = new Tblprogramfeecategory();
        return $this->renderAjax('programvsfees', [
            'model' => $model,
        ]);
    }



    public function actionRemovefeegroupprogram($ProgramIntId)
    {


        $model = Tblprogramfee::findOne($ProgramIntId);


        if ($model->delete()) {

            $response = [
                'status' => 1,
                'message' => 'Record Successfully Delete'
            ];
        } else {

            $response = [
                'status' => 2,
                'message' => 'Sorry , Unsuccessfully Delete'
            ];
        }

        return json_encode($response);
    }



    public function actionView($ProgFeeCatId)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($ProgFeeCatId),
        ]);
    }

    public function actionViewprogram($ProgFeeCatId)
    {
        return $this->renderAjax('viewprogram', [
            'model' => $this->findModel($ProgFeeCatId),
        ]);
    }

    public function actionViewstudent($ProgFeeCatId)
    {
        return $this->renderAjax('viewstudent', [
            'model' => $this->findModel($ProgFeeCatId),
        ]);
    }



    public function actionCreate()
    {
        if (yii::$app->user->can('ProgramFee-Create')) {

            $model = new Tblprogramfeecategory();
            $data = Yii::$app->request->post();


            // Yii::$app->session->setFlash('success', "Record successfully create.".$data['ProgramId']);


            $history = new tblprogramfeecategorystatus();

            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }


            if (Yii::$app->request->post()) {

                $str = $data['ProgFeePackageText'];
                $LastCode =  explode('-', $str);

                $ResidencyId = $data['Tblprogramfeecategory']['ResidencyId'];

                if ($ResidencyId == 1) {
                    $FirtsCode = 'L';
                } else {
                    $FirtsCode = 'I';
                }
                $next_no = $model->ProgFeeCatId + 1;
            }
            // $model->ProgramId = $data['ProgramId'];

            if ($model->load(Yii::$app->request->post())) {


                $model->ProgFeeCode = '123';
                $model->UserId = Yii::$app->user->identity->UserId;


                if ($model->save(true)) {

                    $command = \Yii::$app->dbcityjb->createCommand('UPDATE tblprogramfeecategorystatus SET CurrentStatusId = 0  WHERE ProgFeeCatId = ' . $model->ProgFeeCatId);
                    $command->execute();


                    /* for tblprogramfeecategorystatus History */

                    $history->ProgFeeCatId = $model->ProgFeeCatId;
                    $history->ApprovalStatusId = 40;
                    $history->CurrentStatusId = 1;
                    $history->UserId = Yii::$app->user->identity->UserId;
                    $history->save(true);

                    $new_Id = $model->ProgFeeCatId;
                    $new_code = $FirtsCode . '-' . $new_Id . '-' . $LastCode[0];

                    // echo("FirtsCode:".$FirtsCode);
                    // echo("<br>new_Id: ".$new_Id);
                    // echo("<br>LastCode :".$LastCode[0]);
                    // echo("<br>new_code :".$new_code);
                    // echo ("<br>ProgFeeCatId :".$model->ProgFeeCatId);
                    // die();

                    $command = \Yii::$app->dbcityjb->createCommand(' UPDATE tblprogramfeecategory SET ProgFeeCode = "' . $new_code . '" WHERE ProgFeeCatId = ' . $model->ProgFeeCatId);
                    $command->execute();


                    Yii::$app->session->setFlash('success', "Record successfully create.");

                    return $this->redirect(Yii::$app->homeUrl . 'programfeejb');
                } else {

                    $model->getErrors();

                    //return ['success' => false, 'errors' => $model->getErrors()];

                    //Yii::$app->session->setFlash('error', $model->getErrors());
                }
            }

            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        } else {

            return "Sorry , your access is denied";
        }
    }


    public function actionProgramvsfees()
    {
        return $this->renderAjax('programvsfees');
    }

    public function actionUpdate($ProgFeeCatId)
    {

        if (Yii::$app->user->can('ProgramFee-Edit')) {
            $model = $this->findModel($ProgFeeCatId);


            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            if ($model->load(Yii::$app->request->post())) {

                //$data = Yii::$app->request->post();
                //$RequestId = $data['Tbltraining']['RequestId'];

                $model->UserId = Yii::$app->user->identity->UserId;


                if ($model->save(true)) {




                    // /* for Training Status History */
                    // $model->TrainingId = $model->TrainingId;
                    // $model->TrainingStatusId = 1;
                    // $history->Remarks = "";
                    // $history->CurrentStatusId = 1;
                    // $history->UserId = Yii::$app->user->identity->UserId;
                    // $history->save(true);

                    Yii::$app->session->setFlash('success', "Record successfully create.");

                    return $this->redirect(Url::base() . '/programfeejb/default/index');
                } else {

                    print_r($model->getErrors());
                    die();

                    //return ['success' => false, 'errors' => $model->getErrors()];

                    //Yii::$app->session->setFlash('error', $model->getErrors());
                }
            }
        } else {

            return "Sorry , your access is denied";
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
        // } else {

        //     return "Sorry , your access is denied";
        // }

    }




    /**
     * Finds the Tblprogramfeecategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ProgFeeCatId Prog Fee Cat ID
     * @return Tblprogramfeecategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ProgFeeCatId)
    {
        if (($model = Tblprogramfeecategory::findOne(['ProgFeeCatId' => $ProgFeeCatId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }



    public function beforeAction($action)
    {
        if (!isset(Yii::$app->user->identity->UserId)) {
            //echo '<script>alert("login lah");</script>';
            return Yii::$app->response->redirect(['site/login'])->send();
        }
        return parent::beforeAction($action);
    }
}
