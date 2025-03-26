<?php

namespace app\controllers;

use Yii;
use app\models\Tbltrainingattandance;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;

/**
 * TrainingattandanceController implements the CRUD actions for Tbltrainingattandance model.
 */
class TrainingattandanceController extends Controller
{
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

    

    public function actionTrainingattandancelist()
    {
        $model = new Tbltrainingattandance();

        $output = [];
        $TrainingDurationId = $_GET['TrainingDurationId'];
        $data = $model->getTrainingAttandanceList($TrainingDurationId);
        $output['data'] = $data;
        // $tbl ='';
        // $tbl = "<p><table border=1 style='border-collapse: collapse;  width: 100%;' class='table table-bordered'>";
        // $tbl .= "<tr style='text-align: center; border: 1px solid #ddd; padding: 8px;  border-bottom: 1px solid #ddd; background-color: #04AA6D;  color: white;' >";
        // $tbl .= "<th>No</th>";
        // $tbl .= "<th>Staff Name</th>";
        // $tbl .= "<th width='150px'>.:.</th>";
        // $tbl .= "</tr>";
        // $i=1;
        // foreach ($data as $data) {            
        //     $tbl .= "<tr style=' text-align: left; border: 1px solid #ddd; padding: 8px;  border-bottom: 1px solid #ddd;'>";
        //     $tbl .= "<td>" . $i . "</td>";            
        //     $tbl .= "<td>" . $data['FullName'] . "</td>";
        //     if($data['AttandId']==0){
        //         $tbl .= "<td>" . "<button class='KeyinAttandance btn btn-warning btn-sm' type='button' value=".$data['AttandId'].">" .$data['AttandStatus']. "</button></td>";
        //     }   else {
        //         $tbl .= "<td>" . "<button class='KeyinAttandance btn btn-success btn-sm' type='button' value=".$data['AttandId'].">" .$data['AttandStatus']. "</button></td>";
        //     }
        //     $tbl .= "</tr>";
        //     $i++;            
        // }
        //   $tbl .= "</table>";

        if (count($output) > 0) {
            return json_encode($output);
        } else {
            return json_encode($output);
        }
    }


    /**
     * Lists all Tbltrainingattandance models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tbltrainingattandance::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'TrainingAttanId' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tbltrainingattandance model.
     * @param int $TrainingAttanId Training Attan ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($TrainingAttanId)
    {
        return $this->render('view', [
            'model' => $this->findModel($TrainingAttanId),
        ]);
    }

    /**
     * Creates a new Tbltrainingattandance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tbltrainingattandance();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'TrainingAttanId' => $model->TrainingAttanId]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tbltrainingattandance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $TrainingAttanId Training Attan ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($TrainingAttanId)
    {
        $model = $this->findModel($TrainingAttanId);
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if (Yii::$app->request->post()) {
            // $data = Yii::$app->request->post();
           if($_GET['AttandId']==0){
                $Attandance = 1;
            } else {
                $Attandance = 0;
           }
            $model->AttandId = $Attandance;
            $model->save();

        }
       
    }

    /**
     * Deletes an existing Tbltrainingattandance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $TrainingAttanId Training Attan ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($TrainingAttanId)
    {
        $this->findModel($TrainingAttanId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tbltrainingattandance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $TrainingAttanId Training Attan ID
     * @return Tbltrainingattandance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($TrainingAttanId)
    {
        if (($model = Tbltrainingattandance::findOne(['TrainingAttanId' => $TrainingAttanId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }



    
    public function beforeAction($action)
    {
        if (!isset(Yii::$app->user->identity->UserId))
        {
           //echo '<script>alert("login lah");</script>';
            return Yii::$app->response->redirect(['site/login'])->send();
        }
        return parent::beforeAction($action);    
    }

    
}
