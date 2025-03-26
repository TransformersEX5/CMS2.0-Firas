<?php

namespace app\controllers;

use Yii;
use app\models\Tblprogramfeecategorydetail;

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
            $model->UserId          = Yii::$app->user->identity->UserId;


            if ($model->save(true)) {

                Yii::$app->session->setFlash('success', "Record successfully create.");

               // return $this->redirect(Yii::$app->homeUrl . '/index');
            } else {

                //print_r($model->getErrors());
                //  die();
                //return ['success' => false, 'errors' => $model->getErrors()];
                Yii::$app->session->setFlash('error', $model->getErrors());
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
