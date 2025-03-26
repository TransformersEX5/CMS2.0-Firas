<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var \yii\web\View $this view component instance */
/** @var \yii\mail\MessageInterface $message the message being composed */
/** @var string $content main view render result */

?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<style>
    .image-container {
        display: flex;
        justify-content: center;
        /* Centers content horizontally */
    }
</style>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />

</head>

<body>
    <div style="text-align:center;">
        <img src="cid:city_logo_white" class="img-fluid" style="width:30%; height:30%; margin-left: auto; margin-right: auto;" alt="city.edu.my">
    </div>
    <br><br>
    <?php $this->beginBody() ?>

    <?= $content ?>

    <?php $this->endBody() ?>
    <br><br>
    <div style="text-align:center;">
        <img src="cid:invitation_footer" class="img-fluid text-center" style="width:50%; height:50%; margin-left: auto; margin-right: auto;" alt="city.edu.my">
    </div>
</body>

</html>
<?php $this->endPage() ?>