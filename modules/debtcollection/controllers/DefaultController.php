<?php

namespace app\modules\debtcollection\controllers;

use yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\bootstrap5\Toast;
use yii\bootstrap5\Widget;
use yii\web\View;

/**
 * Default controller for the `debt` module
 */
class DefaultController extends Controller
{

    public $layout ='@app/views/layouts/lexapurple_layouts';

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {  
        
       // return $this->render('index');

     //   if (yii::$app->user->can('Debt-index')) {

            return $this->render('index');

        // } else {
              
        //       $js = <<<JS
        //             toastr.error('Sorry. You do not have permission to access this feature', 'Access denied');
        //       JS;
              
        //       $this->getView()->registerJs($js, View::POS_READY);

        //       throw new ForbiddenHttpException(Yii::t('app', 'Access denied. You do not have permission to access this feature.'));
        //     //return $this->render('index');
        // }             
    }


    // public function actionDebtlist()
    // {        
       

    //         return $this->render('debtlist');

        // } else {
              
        //       $js = <<<JS
        //             toastr.error('Sorry. You do not have permission to access this feature', 'Access denied');
        //       JS;
              
        //       $this->getView()->registerJs($js, View::POS_READY);

        //       throw new ForbiddenHttpException(Yii::t('app', 'Access denied. You do not have permission to access this feature.'));
        //     //return $this->render('index');
        // }             
    // }

    
    
    public function beforeAction($action)
    {
        if (!isset(Yii::$app->user->identity->UserId)) {
            //echo '<script>alert("login lah");</script>';
            return Yii::$app->response->redirect(['site/login'])->send();
        }



        return parent::beforeAction($action);
    }
}
