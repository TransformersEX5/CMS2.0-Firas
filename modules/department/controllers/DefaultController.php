<?php

namespace app\modules\department\controllers;

use Yii;
use yii\web\Controller;
use app\models\TblDepartment;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;
use yii\web\Response; // important lines

/**
 * Default controller for the `department` module
 */
class DefaultController extends Controller
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



    public function actionDepartmentlist()
    {
        $model2 = new TblDepartment();

        $output1 = [];
        $output1['data'] = '';

        $data3 = $model2->getDepartmentlist();
        $output1['data'] = $data3;

        if (count($output1) > 0) {
            return json_encode($output1);
        } else {
            return json_encode($output1);
        }
    }



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

    /**
     * Displays a single Tbldepartment model.
     * @param int $DepartmentId Department ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($DepartmentId)
    {

        if (yii::$app->user->can('Department-View')) {

            return $this->renderAjax('view', [
                'model' => $this->findModel($DepartmentId),
            ]);
        } else {


            return "Sorry , your access is denied";
        }
    }


    /**
     * Creates a new Tbldepartment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {


        if (yii::$app->user->can('Department-Create')) {

            $model = new Tbldepartment();
            $success = false;


            if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;

                $data = Yii::$app->request->post();
                $model->DepartmentDesc = $data['Tbldepartment']['DepartmentDesc'];
                $model->StatusId = $data['Tbldepartment']['StatusId'];
                $model->DeptCatId = $data['Tbldepartment']['DeptCatId'];
                $model->HODUserId = $data['Tbldepartment']['HODUserId'];
                $model->Department_iso = $data['Tbldepartment']['Department_iso'];
                $model->UserId = Yii::$app->user->identity->UserId;

                if ($model->save()) {
                    $success = true;
                }

                if ($success == true) {

                    $response = [
                        'status' => 1,
                        'message' => 'Department Successfully Create'
                    ];

                    return $response;
                } else {

                    // $response = [
                    //     'status' => 2,
                    //     'message' => $model->getErrors(),
                    // ];
                    return $model->getErrors();
                }

                // return $this->redirect(['index']);
                // return $this->redirect(Yii::$app->homeUrl . 'department/index');


            }



            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        } else {


            //Yii::$app->session->setFlash('danger', "erro message");
            // throw new \yii\web\HttpException(404, 'The requested Item could not be found.');

            return "Sorry , your access is denied";

            //  echo '<script>  alert("xxx");              
            //         $("#modal-lg").modal("hide");
            //     </script>';


            //throw new ForbiddenHttpException("tak boleh");
        }
    }


    public function actionUpdate($DepartmentId)
    {



        if (yii::$app->user->can('Department-Update')) {

            $model = $this->findModel($DepartmentId);

            // if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {

                Yii::$app->response->format = Response::FORMAT_JSON;
                $data = Yii::$app->request->post();

                $model->DepartmentDesc = $data['Tbldepartment']['DepartmentDesc'];
                $model->StatusId = $data['Tbldepartment']['StatusId'];
                $model->DeptCatId = $data['Tbldepartment']['DeptCatId'];
                $model->HODUserId = $data['Tbldepartment']['HODUserId'];
                $model->Department_iso = $data['Tbldepartment']['Department_iso'];
                $model->UserId = Yii::$app->user->identity->UserId;


                if ($model->save()) {
                    $success = true;
                }

                if ($success == true) {

                    $response = [
                        'status' => 1,
                        'message' => 'Room Successfully Update'
                    ];

                    return $response;
                } else {

                    // $response = [
                    //     'status' => 2,
                    //     'message' => $model->getErrors(),
                    // ];
                    return $model->getErrors();
                }
                // return $this->redirect(['index']);
                //return $this->redirect(Yii::$app->homeUrl . 'department/index');
            } else {

                return $this->renderAjax('update', [
                    'model' => $model,
                ]);
            }
        } else {

            $response = [
                'status' => 3,
                'message' => 'Sorry , Your Access Is Denied'
            ];
            return json_encode($response);

            //Yii::$app->session->setFlash('danger', "erro message");
            // throw new \yii\web\HttpException(404, 'The requested Item could not be found.');

            // return "Sorry , your access is denied";

            //  echo '<script>  alert("xxx");              
            //         $("#modal-lg").modal("hide");
            //     </script>';

            //throw new ForbiddenHttpException("tak boleh");
        }
    }



    /**
     * Updates an existing Tbldepartment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $DepartmentId Department ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdat_ori($DepartmentId)
    {


        if (yii::$app->user->can('Department-Update')) {

            $model = $this->findModel($DepartmentId);

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
                    Yii::$app->session->setFlash('success', "Record successfully Update.");
                    // $respondata = [
                    //     'status' => true,
                    //     'message' => 'Data Saved '
                    // ];

                } else {
                    Yii::$app->session->setFlash('error', "Record not saved.");
                }
                // return $this->redirect(['index']);
                return $this->redirect(Yii::$app->homeUrl . 'department/index');
            }

            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        } else {


            //Yii::$app->session->setFlash('danger', "erro message");
            // throw new \yii\web\HttpException(404, 'The requested Item could not be found.');

            return "Sorry , your access is denied";

            //  echo '<script>  alert("xxx");              
            //         $("#modal-lg").modal("hide");
            //     </script>';


            //throw new ForbiddenHttpException("tak boleh");
        }
    }


    /**
     * Deletes an existing Tbldepartment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $DepartmentId Department ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($DepartmentId)
    {
        $this->findModel($DepartmentId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tbldepartment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $DepartmentId Department ID
     * @return Tbldepartment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($DepartmentId)
    {
        if (($model = Tbldepartment::findOne(['DepartmentId' => $DepartmentId])) !== null) {
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
