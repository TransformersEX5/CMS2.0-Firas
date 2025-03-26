<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Tblapplication $model */

$this->title = $model->ApplicationId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblapplications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tblapplication-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'ApplicationId' => $model->ApplicationId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'ApplicationId' => $model->ApplicationId], [
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
            'ApplicationId',
            'AppNo',
            'BranchId',
            'StudNRICPassportNo',
            'StudName',
            'StudGenderId',
            'StudNationalityId',
            'ResidencyId',
            'StudRaceId',
            'MaritalStatusId',
            'StudReligionId',
            'StudDateOfBirth',
            'StudCorrAddress1',
            'StudCorrAddress2',
            'StudCorrCity',
            'StudCorrPostCode',
            'StudCorrStateId',
            'StudCorrPhoneNo',
            'StudMobileNo',
            'StudResidenceNo',
            'StudEmailAddress:email',
            'ParentEmail1:email',
            'ParentEmail2:email',
            'StudGuardName',
            'StudGuardNationalityId',
            'StudGuardNRICPassportNo',
            'StudGuardRelationshipId',
            'StudGuardHomeAddress1',
            'StudGuardHomeAddress2',
            'StudGuardHomeCity',
            'StudGuardHomeStateId',
            'StudGuardHomePostCode',
            'StudGuardHomePhoneNo',
            'StudGuardHandPhone',
            'StudGuardAnnualIncome',
            'StudGuardOccupationId',
            'StudPermHomeAddress1',
            'StudPermHomeAddress2',
            'StudPermHomeCity',
            'StudPermHomeStateId',
            'StudPermHomePostCode',
            'StudPermHomePhoneNo',
            'StudEmergName',
            'StudEmergRelationshipId',
            'StudEmergHomePhoneNo',
            'StudEmergHandPhone',
            'StudEmergOfficePhone',
            'StudAccomodation',
            'AccomodationRemarks',
            'StudBloodType',
            'StudAlergy',
            'StudDisease',
            'StudDisability',
            'StudRemarks:ntext',
            'DateRegister',
            'TransactionUpdated',
            'MarketingId',
            'AgentId',
            'ProgramId1',
            'ProgramId2',
            'ProgramId3',
            'ProgramId4',
            'StudyCenterId',
            'PromoId',
            'LeedsSourceId',
        ],
    ]) ?>

</div>
