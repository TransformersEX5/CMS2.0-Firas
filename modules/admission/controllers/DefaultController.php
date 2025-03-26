<?php

namespace app\modules\admission\controllers;

use yii\web\Controller;
use yii\helpers\Url;
use app\models\Tblprogramregister;
use app\models\Tblsubjectregister;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;
use yii\web\Response; // important lines

/**
 * Default controller for the `admission` module
 */
class DefaultController extends Controller
{
    Public $layout = '@app/views/layouts/lexapurple_layouts';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    
    public function actionProgramregisterlist()
    {
        $model2 = new Tblprogramregister();

        $output1 = [];
        $output1['data'] = '';

        $data3 = $model2->getProgramRegisterList();
        $output1['data'] = $data3;

        if (count($output1) > 0) {
            return json_encode($output1);
        } else {
            return json_encode($output1);
        }
    }



    
    public function actionSubjectregisterlist()
    {
        $model2 = new Tblsubjectregister();

        $output1 = [];
        $output1['data'] = '';

        $data3 = $model2->getSubjectRegisterList();
        $output1['data'] = $data3;

        if (count($output1) > 0) {
            return json_encode($output1);
        } else {
            return json_encode($output1);
        }
    }

}
