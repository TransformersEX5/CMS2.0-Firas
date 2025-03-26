<?php

namespace app\modules\programfeejb\controllers;

use Yii;
use app\modules\programfeejb\models\Tblprogramfeecategorydetail;


use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;


//class ProgramfeecategorydetailController extends \yii\web\Controller
class ProgramfeecategorydetailController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }



    public function actionCreate()
    {
        // if (yii::$app->user->can('ProgramFee-Create')) {

  
        $success = false;
        $model = new Tblprogramfeecategorydetail();
        $data = Yii::$app->request->post();


        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }


        if (Yii::$app->request->post()) {
            $model->ProgFeeCatId    = $data['txtProgFeeCatId'];
            $model->SemesterNo      = $data['txtSemNo'];
            $model->FeeAmount       = $data['txtFeeAmount'];
            $model->FeeTypeId       = $data['txtFeeTypeId'];
            /// $model->ProgramId       = $data['ProgramId'];

            $model->UserId          = Yii::$app->user->identity->UserId;


            if ($model->save()) {
                $success = true;
            }

            if ($success == true) {
                // Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
                ///Yii::$app->session->setFlash('success', "Record  successfully Update.");
                $response = [
                    'status' => 1,
                    'message' => 'Record Successfully Update'
                ];

                // return json_encode(array('status' => 1, 'type' => 'success', 'message' => 'Contact created successfully.'));
                return json_encode($response);

            } else {
                // Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
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



    /**
     * Deletes an existing Tbltrainingattandance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $TrainingAttanId Training Attan ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {

        if ($this->request->isPost) {
            $data = Yii::$app->request->post();

            $ProgFeeCatDetailId = $data['ProgFeeCatDetailId'];

            $this->findModel($ProgFeeCatDetailId)->delete();
        }
    }


    /**
     * Finds the Tblprogramfeecategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ProgFeeCatId Prog Fee Cat ID
     * @return Tblprogramfeecategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ProgFeeCatDetailId)
    {
        if (($model = Tblprogramfeecategorydetail::findOne(['ProgFeeCatDetailId' => $ProgFeeCatDetailId])) !== null) {
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
