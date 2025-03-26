<?php

namespace app\modules\marketing\controllers;

use yii\web\Controller;

/**
 * Default controller for the `marketing` module
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
}
