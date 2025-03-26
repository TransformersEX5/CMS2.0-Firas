<?php

namespace app\modules\trainingevaluation\controllers;

use Yii;
use yii\web\Response;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

use DateTime;
use DateInterval;

use app\modules\trainingevaluation\models\tbltrainingevalquestion;
use app\modules\trainingevaluation\models\tbltrainingevalmarks;
use app\modules\trainingevaluation\models\tbltrainingevalremarks;

/**
 * Default controller for the `trainingevaluation` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public $layout = '@app/views/layouts/loginlayout';

    public function actionIndex()
    {
        $userId = base64_decode(Yii::$app->request->get('userId'));
        $trainingId = base64_decode(Yii::$app->request->get('trainingId'));
        $date = base64_decode(Yii::$app->request->get('date'));

        $dateTime = DateTime::createFromFormat('Ymd', $date);
        $dateTime->add(new DateInterval('P5D'));
        $expiredDate = $dateTime->format('Ymd');

        $currentDate = date('Ymd');
        // $expiredDate = '20231114';

        $model = tbltrainingevalquestion::find()->where(['StatusId' => 1])->all();

        $model2 = new tbltrainingevalremarks();

        $model3 = tbltrainingevalmarks::find()->where(['UserId' => $userId, 'TrainingId' => $trainingId])->One()->UserId ?? 0;

        return $this->render('index', ['model' => $model, 'model2' => $model2, 'model3' => $model3, 'currentDate' => $currentDate, 'expiredDate' => $expiredDate]);
    }

    public function actionEvaluation()
    {
        $userId = Yii::$app->request->post('userId');
        $trainingId = Yii::$app->request->post('trainingId');

        $data = Yii::$app->request->post('formData');
        $datadecoded = json_decode($data);

        foreach ($datadecoded as $datadecodeds) {
            $name = $datadecodeds->name;
            $value = $datadecodeds->value;
            // $name = $datadecodeds['name'];
            // $value = $datadecodeds['value'];
            if (preg_match('/\[([0-9]+)\]/', $name, $matches)) {
                $number = $matches[1];
            }

            if (str_contains($name, 'Question')) {
                $model = new tbltrainingevalmarks();

                $model->TrainingEvalQuestionId = $number;

                if ($value == 1) {
                    $model->Mark1 = $value;
                } else if ($value == 2) {
                    $model->Mark2 = $value;
                } else if ($value == 3) {
                    $model->Mark3 = $value;
                } else if ($value == 4) {
                    $model->Mark4 = $value;
                } else if ($value == 5) {
                    $model->Mark5 = $value;
                }
            } else {
                $model = new tbltrainingevalremarks();
                $model->TrainingEvalRemarks = $value;
            }

            $model->TrainingId = $trainingId;
            $model->UserId = $userId;
            $model->save();
        }

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['TrainingId' => $model->TrainingId];
    }
}
