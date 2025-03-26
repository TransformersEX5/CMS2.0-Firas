<?php

namespace app\controllers;


use Yii;
use app\models\Tblprogramfeecategory;
use app\models\Tblprogramfeecategorydetail;
use app\models\Tblprogramfeecategorystatus;


use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;


class ProgramfeecategoryController extends \yii\web\Controller
{
    public $layout = 'lexapurple_layouts';



    
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



    public function actionProgramfeecategorydetaillist()
    {
        $model = new Tblprogramfeecategorydetail();

        $output = [];
        $output['data'] = '';

        $data = $model->getProgramfeecategorydetaillist();
        $output['data'] = $data;
        $Gtotal = 0; 
        $tbl = '';
     
        $tbl .= "<table border=1 style='border-collapse: collapse;  width: 100%;  margin: 0.5em; padding: 0.5em; table table-bordered>";
        $tbl .= "<tr style='text-align: center; border: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #04AA6D; ' >";
        $tbl .= "<th style='color: black'; >Sem No</th>";
        $tbl .= "<th style='color: black'; >Fee Amt</th>";
        $tbl .= "<th style='color: black'; >Fee Type</th>";
        $tbl .= "<th style='color: black'; >.:.</th>";
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
            $Gtotal=$Gtotal+$data['FeeAmount'];

         

        }

        $tbl .= "<tr style=' text-align: center; border: 1px solid #ddd; border-bottom: 1px solid #ddd; '>";            
        $tbl .= "<td> <strong>Total :</strong> </td>";
        $tbl .= "<td> <strong>" .  $Gtotal . " </strong></td>";
        $tbl .= "<td></td>";
        
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
        $feedetail = new Tblprogramfeecategorydetail();

        return $this->render('index',['feedetail' => $feedetail]);
    }


    public function actionView($ProgFeeCatId)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($ProgFeeCatId),
        ]);
    }



    public function actionCreate()
    {


       // if (yii::$app->user->can('ProgramFee-Create')) {

            $model = new Tblprogramfeecategory();
            $history = new tblprogramfeecategorystatus();

            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            if ($model->load(Yii::$app->request->post())) {

                $model->UserId = Yii::$app->user->identity->UserId;

                if ($model->save(true)) {
                            
                    $command = \Yii::$app->db->createCommand('UPDATE tblprogramfeecategorystatus SET CurrentStatusId = 0  WHERE ProgFeeCatId = ' . $model->ProgFeeCatId);
                    $command->execute();


                    /* for tblprogramfeecategorystatus History */

                    $history->ProgFeeCatId = $model->ProgFeeCatId;
                    $history->ApprovalStatusId = 40;
                    $history->CurrentStatusId = 1;
                    $history->UserId = Yii::$app->user->identity->UserId;
                    $history->save(true);

                    Yii::$app->session->setFlash('success', "Record successfully create.");

                    return $this->redirect(Yii::$app->homeUrl . '/programfeecategory/index');

                } else {

                    $model->getErrors();

                    //return ['success' => false, 'errors' => $model->getErrors()];

                    //Yii::$app->session->setFlash('error', $model->getErrors());
                }
               
                
            }

            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        // } else {

        //     return "Sorry , your access is denied";
        // }
    }



    public function actionUpdate($ProgFeeCatId)
    {


    // if (yii::$app->user->can('ProgramFee-Create')) {
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

                return $this->redirect(Yii::$app->homeUrl . '/programfeecategory/index');

            } else {

                print_r($model->getErrors());
                die();

                //return ['success' => false, 'errors' => $model->getErrors()];

                //Yii::$app->session->setFlash('error', $model->getErrors());
            }
           
            
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
