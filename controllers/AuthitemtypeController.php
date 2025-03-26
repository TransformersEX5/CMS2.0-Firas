<?php

namespace app\controllers;
use Yii;
use app\models\authitemtype;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthitemtypeController implements the CRUD actions for authitemtype model.
 */
class AuthitemtypeController extends Controller
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

    /**
     * Lists all authitemtype models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => authitemtype::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'auth_item_typeid' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single authitemtype model.
     * @param int $auth_item_typeid Auth Item Typeid
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($auth_item_typeid)
    {
        return $this->render('view', [
            'model' => $this->findModel($auth_item_typeid),
        ]);
    }

    /**
     * Creates a new authitemtype model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new authitemtype();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'auth_item_typeid' => $model->auth_item_typeid]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing authitemtype model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $auth_item_typeid Auth Item Typeid
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($auth_item_typeid)
    {
        $model = $this->findModel($auth_item_typeid);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'auth_item_typeid' => $model->auth_item_typeid]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing authitemtype model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $auth_item_typeid Auth Item Typeid
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($auth_item_typeid)
    {
        $this->findModel($auth_item_typeid)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the authitemtype model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $auth_item_typeid Auth Item Typeid
     * @return authitemtype the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($auth_item_typeid)
    {
        if (($model = authitemtype::findOne(['auth_item_typeid' => $auth_item_typeid])) !== null) {
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
