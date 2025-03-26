<?php

namespace app\modules\hostel;

/**
 * hostel module definition class
 */
class Hostel extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\hostel\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        // $this->layout = 'lexapurple_layouts';
        parent::init();

        // custom initialization code goes here
    }
}
