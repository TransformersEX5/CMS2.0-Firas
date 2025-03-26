<?php

namespace app\modules\room\controllers;

use Yii;
use yii\web\Controller;
use app\models\TblRoom;
use yii\web\View;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;
use yii\helpers\URL;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

/**
 * Default controller for the `room` module
 */
class DefaultController extends Controller
{

    public $layout = '@app/views/layouts/lexapurple_layouts';
    /**
     * Renders the index view for the module
     * @return string
     */

    public function actionRoomlist()
    {
        $model2 = new TblRoom();

        $output1 = [];
        $output1['data'] = '';

        $data3 = $model2->getRoomList();
        $output1['data'] = $data3;

        if (count($output1) > 0) {
            return json_encode($output1);
        } else {
            return json_encode($output1);
        }
    }



    public function actionIndex()
    {
        return $this->render('index');
    }



    public function actionCreate()
    {
        // if (yii::$app->user->can('Room-Create')) {

            $model = new Tblroom;
            $success = false;


            if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
                $model->UserId = Yii::$app->user->identity->UserId;
                Yii::$app->response->format = Response::FORMAT_JSON;

                if ($model->save()) {
                    $success = true;
                }

                if ($success == true) {

                    $response = [
                        'status' => 1,
                        'message' => 'Room Successfully Create'
                    ];

                    return $response;
                } else {

                    // $response = [
                    //     'status' => 2,
                    //     'message' => $model->getErrors(),
                    // ];
                    return $model->getErrors();
                }
            }


            return $this->renderAjax('create', ['model' => $model]);
        // } else {

        //     return "Sorry , your access is denied";
        // }
    }




    public function actionView($RoomId)
    {

        if (yii::$app->user->can('Room-View')) {

            return $this->renderAjax('view', [
                'model' => $this->findModel($RoomId),
            ]);
        } else {

            return "Sorry , your access is denied";
        }
    }


    public function actionUpdate($RoomId)
    {

        if (yii::$app->user->can('Room-Edit')) {

            $model = Tblroom::findOne($RoomId);
            $success = false;

            if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {

                Yii::$app->response->format = Response::FORMAT_JSON;

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

                    return $model->getErrors();
                }
            }

            return $this->renderAjax('update', [
                'model' => $this->findModel($RoomId),
            ]);
        } else {

            return "Sorry , your access is denied";
        }
    }



    /**
     * Finds the Tblprogramfeecategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ProgFeeCatId Prog Fee Cat ID
     * @return Tblprogramfeecategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($RoomId)
    {
        if (($model = TblRoom::findOne(['RoomId' => $RoomId])) !== null) {
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
