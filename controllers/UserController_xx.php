<?php

namespace app\controllers;

use Yii;
use app\models\tbluser;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;

/**
 * UserController implements the CRUD actions for tbluser model.
 */
class UserController extends Controller
{

    public $modelClass = 'app\models\Tbluser';

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


    public function actionUserlist()
    {
        $model = new Tbluser();

        $output = [];
        $output['data'] = '';

        $data = $model->getUserlist();
        $output['data'] = $data;

        if (count($output) > 0) {
            return json_encode($output);
        } else {
            return json_encode($output);
        }
    }

    /**
     * Lists all tbluser models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => tbluser::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'UserId' => SORT_DESC,
                    'MarketingTeamId' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single tbluser model.
     * @param int $UserId User ID
     * @param int $MarketingTeamId Marketing Team ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($UserId)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($UserId),
        ]);
    }

    /**
     * Creates a new tbluser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new tbluser();


        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {

            $data = Yii::$app->request->post();

            $FullName = $data['Tbluser']['FullName'];
            // $ProgramName = $data['Tbldepartment']['DepartmentId'];
            // $ProgramType = $data['Tbldepartment']['DepartmentId'];
            //   $ProgramStatus = $data['Tblprogram']['ProgramStatus'];

            // $model->UserId = Yii::$app->user->identity->UserId;


            if ($model->save(true)) {
                // Save the form data to the database, send an email, etc.
                //return ['success' => true];

                Yii::$app->session->setFlash('success', "Record " . $FullName . " successfully create.");
            } else {
                // return ['success' => false, 'errors' => $model->getErrors()];

                Yii::$app->session->setFlash('error', "Record not saved.");
            }
            // return $this->redirect(['index']);
            return $this->redirect(Yii::$app->homeUrl . 'user/index');
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing tbluser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $UserId User ID
     * @param int $MarketingTeamId Marketing Team ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($UserId)
    {
        $model = $this->findModel($UserId);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'UserId' => $model->UserId]);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing tbluser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $UserId User ID
     * @param int $MarketingTeamId Marketing Team ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($UserId)
    {
        $this->findModel($UserId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the tbluser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $UserId User ID
     * @param int $MarketingTeamId Marketing Team ID
     * @return tbluser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($UserId)
    {
        if (($model = tbluser::findOne(['UserId' => $UserId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}