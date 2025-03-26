<?php

namespace app\modules\creditcontrol\controllers;


use yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use app\models\Tblblockaccessstud;
use yii\web\View;
use app\models\Tblprogramregister;
use app\models\Tbldebtoraction;

use yii\bootstrap5\ActiveForm;
use yii\web\Response;
use yii\helpers\FileHelper;




/**
 * Default controller for the `creditcontrol` module
 */
class BlockaccessController extends Controller
{

    public $layout = '@app/views/layouts/lexapurple_layouts';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        return $this->render('index');
    }


    //1= Exam Docket
    public function actionBlockaccessexamdocketupdate()
    {
        if (Yii::$app->user->can('Group Debt Collection - Student Portal Block On Off')) {
            $model = new Tblblockaccessstud();

            $data = Yii::$app->request->post();


            if (Yii::$app->request->post()) {

                $check = Tblblockaccessstud::find()->where(['ProgramRegId' => yii::$app->request->get('prgid'), 'BlockAccessId' => 1])->all();

                if (!empty($check)) {
                    Tblblockaccessstud::updateAll(['CurrentStatusId' => 0], ['ProgramRegId' => yii::$app->request->get('prgid'), 'BlockAccessId' => 1]);
                }

                $model->ProgramRegId    =  yii::$app->request->get('prgid');
                $model->BlockAccessId   =  1; // Exam Docket            
                $model->BlockOnOff      = yii::$app->request->post('Tblblockaccessstud')['BlockOnOff'];
                $model->Remarks         = trim(yii::$app->request->post('Tblblockaccessstud')['Remarks']);
                $model->Outstanding     = yii::$app->request->get('oustding');
                $model->CurrentStatusId = 1;
                $model->UserId          = Yii::$app->user->identity->UserId;

                Yii::$app->response->format = Response::FORMAT_JSON;


                if ($model->save()) {
                    return ['success' => true];
                } else {
                    return $model->getErrors();
                }
            }

            return $this->renderAjax('block_examdocket', ['model' => $model]);
        } else {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['accessDenied' => true];
        }
    }




    //2= Time Table/LMS
    public function actionBlockaccesstimetabletupdate()
    {
        if (Yii::$app->user->can('Group Debt Collection - Student Portal Block On Off')) {
            $model = new Tblblockaccessstud();

            $data = Yii::$app->request->post();


            if (Yii::$app->request->post()) {

                $check = Tblblockaccessstud::find()->where(['ProgramRegId' => yii::$app->request->get('prgid'), 'BlockAccessId' => 2])->all();

                if (!empty($check)) {
                    Tblblockaccessstud::updateAll(['CurrentStatusId' => 0], ['ProgramRegId' => yii::$app->request->get('prgid'), 'BlockAccessId' => 2]);
                }

                $model->ProgramRegId    = yii::$app->request->get('prgid');
                $model->BlockAccessId   = 2; //Time Table/LMS
                $model->BlockOnOff      = yii::$app->request->post('Tblblockaccessstud')['BlockOnOff'];
                $model->Remarks         = trim(yii::$app->request->post('Tblblockaccessstud')['Remarks']);
                $model->Outstanding     = yii::$app->request->get('oustding');
                $model->CurrentStatusId = 1;
                $model->UserId          = Yii::$app->user->identity->UserId;

                Yii::$app->response->format = Response::FORMAT_JSON;


                if ($model->save()) {
                    return ['success' => true];
                } else {
                    return $model->getErrors();
                }
            }

            return $this->renderAjax('block_timetable', ['model' => $model]);
        } else {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['accessDenied' => true];
        }
    }





    //3= Exam Result
    public function actionBlockaccessexamresultupdate()
    {
        if (Yii::$app->user->can('Group Debt Collection - Student Portal Block On Off')) {
            $model = new Tblblockaccessstud();

            $data = Yii::$app->request->post();


            if (Yii::$app->request->post()) {

                $check = Tblblockaccessstud::find()->where(['ProgramRegId' => yii::$app->request->get('prgid'), 'BlockAccessId' => 3])->all();

                if (!empty($check)) {
                    Tblblockaccessstud::updateAll(['CurrentStatusId' => 0], ['ProgramRegId' => yii::$app->request->get('prgid'), 'BlockAccessId' => 3]);
                }

                $model->ProgramRegId    = yii::$app->request->get('prgid');
                $model->BlockAccessId   = 3; //3= Exam Result
                $model->BlockOnOff      = yii::$app->request->post('Tblblockaccessstud')['BlockOnOff'];
                $model->Remarks         = trim(yii::$app->request->post('Tblblockaccessstud')['Remarks']);
                $model->Outstanding     = yii::$app->request->get('oustding');
                $model->CurrentStatusId = 1;
                $model->UserId          = Yii::$app->user->identity->UserId;

                Yii::$app->response->format = Response::FORMAT_JSON;


                if ($model->save()) {
                    return ['success' => true];
                } else {
                    return $model->getErrors();
                }
            }

            return $this->renderAjax('block_resultonline', ['model' => $model]);
        } else {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['accessDenied' => true];
        }
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
