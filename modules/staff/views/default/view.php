<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\staff\models\tbluser $model */

$this->title = $model->UserId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblusers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tbluser-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'UserId' => $model->UserId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'UserId' => $model->UserId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'UserId',
            'UserNo',
            'UserNo2',
            'FullName',
            'ICPassportNo',
            'EmailAddress:email',
            'NationalityId',
            'UserDOB',
            'DOBAlert',
            'HandSetNo',
            'FaxNo',
            'OffLettPosition',
            'PositionId',
            'BranchId',
            'StatusId',
            'WorkingStatusId',
            'DateJoin',
            'DateConfirm',
            'DateLast',
            'ContractStart',
            'ContractEnd',
            'RaceId',
            'ReligionId',
            'Gender',
            'MaritalStatusId',
            'DepartmentId',
            'Remarks',
            'UserName',
            'UserPassword',
            'UserPasswordCrypt',
            'user_password_code',
            'ActivateCode',
            'UserImage',
            'TypeUser',
            'Hod1',
            'Hod2',
            'StaffLevelId',
            'CmsAccess',
            'DCollegeCode',
            'ChangePassword',
            'TransactionDate',
            'ExtensionNo',
            'MarketingTeamId',
            'MarketingSubTeamId',
            'ThumbPrint',
            'hrcms',
            'keyinId',
            'TargetNo',
            'ProfileConform',
            'ProfileConformDate',
            'ExtProbationStart',
            'ExtProbationEnd',
            'DueDay',
            'MonthWork',
            'Evaluation',
        ],
    ]) ?>

</div>
