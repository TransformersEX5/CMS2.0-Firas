<?php

namespace app\controllers;

use Yii;
use app\models\Tblprogram;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;

/**
 * ProgramController implements the CRUD actions for Tblprogram model.
 */
class ProgramController extends Controller
{
    public $modelClass = 'app\models\Tblprogram';

    //public $layout = 'adminlte_layouts';
    public $layout = 'lexapurple_layouts';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        unset($actions['view']);
        unset($actions['index']);
        return $actions;
    }

    public function actionProgramlist()
    {
        $model = new Tblprogram();

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

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tblprogram models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tblprogram::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tblprogram model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ProgramId)
    {
        if (yii::$app->user->can('Program-View')) {

            return $this->renderAjax('view', [
                'model' => $this->findModel($ProgramId),
            ]);
        } else {

            return "Sorry , your access is denied";
        }
    }

    /** https://stackoverflow.com/questions/45817000/yii2-load-modal-form-and-submit-data-via-ajax-without-redirecting-to-view
     * https://www.yiiframework.com/wiki/806/render-form-in-popup-via-ajax-create-and-update-with-ajax-validation-also-load-any-page-via-ajax-yii-2-0-2-3
     *
     * https://abahbara.com/submit-form-pada-modal-menggunakan-ajax-di-yii2/
     *
     * https://stackoverflow.com/questions/56629011/yii2-submit-modal-form-with-ajax
     *
     * https://www.yiiframework.com/wiki/659/open-bootstrap-modal-and-load-content-via-ajax
     * Creates a new Tblprogram model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {

        if (yii::$app->user->can('Program-Create')) {

            $model = new Tblprogram();

            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            if ($model->load(Yii::$app->request->post())) {

                $data = Yii::$app->request->post();

                $ProgramCode = $data['Tblprogram']['ProgramCode'];
                $ProgramName = $data['Tblprogram']['ProgramName'];
                $ProgramType = $data['Tblprogram']['ProgramType'];
                //   $ProgramStatus = $data['Tblprogram']['ProgramStatus'];

                // $model->UserId = Yii::$app->user->identity->UserId;


                if ($model->save(true)) {
                    // Save the form data to the database, send an email, etc.
                    //return ['success' => true];

                    Yii::$app->session->setFlash('success', "Record " . $ProgramCode . " successfully create.");
                } else {
                    // return ['success' => false, 'errors' => $model->getErrors()];

                    Yii::$app->session->setFlash('error', "Record not saved.");
                }
                // return $this->redirect(['index']);
                return $this->redirect(Yii::$app->homeUrl . 'program/index');
            }

            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        } else {

            return "Sorry , your access is denied";
        }
    }

    public function actionCreate_Orixx()
    {
        $model = new Tblprogram();

        $model->UserId = Yii::$app->user->id;
        if (
            Yii::$app->request->isAjax &&
            $model->load(Yii::$app->request->post())
        ) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash(
                'success',
                'New record ' . $model->ProgramCode . ' successfully saved.'
            );
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Tblprogram model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * https://stackoverflow.com/questions/35483136/dismiss-bootstrap-modal-without-page-refresh-when-contact-form-is-submitted
     * https://teamtreehouse.com/community/keep-a-modal-window-open-after-form-submission
     * https://stackoverflow.com/questions/1960240/jquery-ajax-submit-form
     * http://www.bsourcecode.com/2012/12/ftp-file-transfer-using-yii/
     *
     * model ajax 1
     * https://www.youtube.com/watch?v=aUAUsADp9ao
     * model ajax 2
     * https://www.youtube.com/watch?v=ZhblqEROLWo
     * http://yii-02.blogspot.com/?view=classic
     *
     *
     * VS Code
     * https://www.youtube.com/watch?v=ifTF3ags0XI
     *
     * onchange combobox ajax
     * https://www.youtube.com/watch?v=hZ-6huMYxBc
     *
     * https://www.autoscripts.net/yii2-back-to-previous-page-after-update/
     */

    public function actionUpdate($ProgramId)
    {


        if (yii::$app->user->can('Program-Update')) {


            $model = $this->findModel($ProgramId);

            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }


            if ($model->load(Yii::$app->request->post())) {
                $data = Yii::$app->request->post();

                $ProgramCode = $data['Tblprogram']['ProgramCode'];
                $ProgramName = $data['Tblprogram']['ProgramName'];
                $ProgramType = $data['Tblprogram']['ProgramType'];
                // $ProgramStatus = $data['Tblprogram']['ProgramStatus'];

                //  $model->UserId = Yii::$app->user->identity->UserId;

                if ($model->save(true)) {
                    Yii::$app->session->setFlash('success', "Record " . $ProgramCode . " successfully Update.");
                    // $respondata = [
                    //     'status' => true,
                    //     'message' => 'Data Saved '
                    // ];

                } else {
                    Yii::$app->session->setFlash('error', "Record not saved.");
                }
                // return $this->redirect(['index']);
                return $this->redirect(Yii::$app->homeUrl . 'program/index');
            }

            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        } else {

            return "Sorry , your access is denied";
        }
    }





    public function actionUpdate_xx($id)
    {
        $model = $this->findModel($id);
        $model->UserId = Yii::$app->user->id;

        if (
            Yii::$app->request->isAjax &&
            $model->load(Yii::$app->request->post())
        ) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            // $transaction = \Yii::$app->db->beginTransaction();

            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //$transaction->commit();

            //  return array('status' => 'success', 'type' => 'success', 'message' => 'Contact created successfully.');

            Yii::$app->session->setFlash(
                'success', 'Record ' . $model->ProgramCode . ' successfully updated.'
            );

            // return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tblprogram model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (yii::$app->user->can('Program-Delete')) {

            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        } else {

            return "Sorry , your access is denied";
        }
    }

    /**
     * Finds the Tblprogram model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tblprogram the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tblprogram::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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
