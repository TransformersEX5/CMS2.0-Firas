<?php

namespace app\modules\staffportal\controllers;

use Yii;
use yii\web\Controller;

/**
 * Default controller for the `Staffportal` module
 */
class LecturerController extends Controller
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


    public function actionAssignment()
    {
        return $this->render('assignment');
    }

    public function actionExam()
    {
        return $this->render('exam');
    }

    
    public function actionTimetable()
    {
        return $this->render('timetable');
    }

    public function actionReport()
    {
        return $this->render('report');
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

