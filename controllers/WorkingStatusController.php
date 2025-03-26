<?php

namespace app\controllers;

use yii;
use app\models\Tblworkingstatus;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;

/**
 * WorkingStatusController implements the CRUD actions for Tblworkingstatus model.
 */
class WorkingStatusController extends Controller
{
    public $modelClass = 'app\models\Tblworkingstatus';

    //public $layout = 'adminlte_layouts';
    public $layout = 'lexapurple_layouts';
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }


    public function actionWorkingstatuslist()
    {
        $model = new Tblworkingstatus();

        $output = [];
        $output['data'] = '';

        $data = $model->getWorkingstatuslist();
        $output['data'] = $data;

        if (count($output) > 0) {
            return json_encode($output);
        } else {
            return json_encode($output);
        }
    }


    /**
     * Lists all Tblworkingstatus models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tblworkingstatus::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'WorkingStatusId' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }



    /**
     * Displays a single Tblworkingstatus model.
     * @param int $WorkingStatusId Working Status ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($Id)
    {

        if (yii::$app->user->can('WorkingStatus-View')) {

            return $this->renderAjax('view', [
                'model' => $this->findModel($Id),
            ]);
        } else {

            return "Sorry , your access is denied";
        }
    }

    /**
     * Creates a new Tblworkingstatus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {


        if (yii::$app->user->can('WorkingStatus-Create')) {


            $model = new Tblworkingstatus();

            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            if ($model->load(Yii::$app->request->post())) {

                $data = Yii::$app->request->post();

                // $ProgramCode = $data['Tbldepartment']['DepartmentId'];
                // $ProgramName = $data['Tbldepartment']['DepartmentId'];
                // $ProgramType = $data['Tbldepartment']['DepartmentId'];
                //   $ProgramStatus = $data['Tblprogram']['ProgramStatus'];

                // $model->UserId = Yii::$app->user->identity->UserId;


                if ($model->save(true)) {
                    // Save the form data to the database, send an email, etc.
                    //return ['success' => true];

                    Yii::$app->session->setFlash('success', "Record  successfully create.");
                } else {
                    // return ['success' => false, 'errors' => $model->getErrors()];

                    Yii::$app->session->setFlash('error', "Record not saved.");
                }
                // return $this->redirect(['index']);
                return $this->redirect(Yii::$app->homeUrl . 'working-status/index');
            }

            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        } else {

            return "Sorry , your access is denied";
        }
    }

    /**
     * Updates an existing Tblworkingstatus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $WorkingStatusId Working Status ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Id)
    {



        if (yii::$app->user->can('WorkingStatus-Update')) {


            $model = $this->findModel($Id);


            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }



            if ($model->load(Yii::$app->request->post())) {
                $data = Yii::$app->request->post();

                // $ProgramCode = $data['Tbldepartment']['ProgramCode'];
                // $ProgramName = $data['Tbldepartment']['ProgramName'];
                // $ProgramType = $data['Tbldepartment']['ProgramType'];
                // $ProgramStatus = $data['Tblprogram']['ProgramStatus'];

                //  $model->UserId = Yii::$app->user->identity->UserId;

                if ($model->save(true)) {
                    Yii::$app->session->setFlash('success', "Record  successfully Update.");
                    // $respondata = [
                    //     'status' => true,
                    //     'message' => 'Data Saved '
                    // ];

                } else {
                    Yii::$app->session->setFlash('error', "Record not saved.");
                }
                // return $this->redirect(['index']);
                return $this->redirect(Yii::$app->homeUrl . 'working-status/index');
            }

            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        } else {

            return "Sorry , your access is denied";
        }
    }

    /**
     * Deletes an existing Tblworkingstatus model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $WorkingStatusId Working Status ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Id)
    {

        if (yii::$app->user->can('WorkingStatus-Delete')) {


            $this->findModel($Id)->delete();

            return $this->redirect(['index']);
        } else {

            return "Sorry , your access is denied";
        }
    }

    /**
     * Finds the Tblworkingstatus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $WorkingStatusId Working Status ID
     * @return Tblworkingstatus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($WorkingStatusId)
    {
        if (($model = Tblworkingstatus::findOne(['WorkingStatusId' => $WorkingStatusId])) !== null) {
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
