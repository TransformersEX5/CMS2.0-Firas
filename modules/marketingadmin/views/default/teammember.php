<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>

<?php

$module = '/' . Yii::$app->controller->module->id;

$url = Url::base() . $module . '/default/set';
$_csrf = Yii::$app->request->getCsrfToken();

?>

<h3><?= $data[0]['MarketingTeam']; ?></h3>
<br>

<div class="table-rep-plugin">
    <div class="table-responsive mb-0" data-pattern="priority-columns">
        <table id="teammemberlist" class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center" style="width:1%;">No.</th>
                    <th>Staff Name</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($data as $row) { ?>
                    <tr>
                        <td class="text-center"><?= $i; ?></td>
                        <td><?= $row['FullName']; ?></td>
                    </tr>
                <?php $i++;
                } ?>
            </tbody>
        </table>
    </div>
</div>