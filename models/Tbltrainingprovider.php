<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbltrainingprovider".
 *
 * @property int $TrainingProviderId
 * @property string|null $TrainingCompanyName
 * @property string $TrainingContactName
 * @property string|null $TrainingAddress
 * @property string|null $TrainingHpno
 * @property string|null $TrainingEmailAddress Individu / Company
 * @property int|null $TrainingProviderCategoryId Company Or individu
 * @property int|null $TrainingProviderStatusId Good /Not Good / Black List / Mahal
 * @property int|null $StatusId
 * @property string|null $TrainingTag
 * @property string|null $Remarks
 * @property string|null $TransactionDate CURRENT_TIMESTAMP
 * @property int|null $UserId
 */
class Tbltrainingprovider extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbltrainingprovider';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            
            [['TrainingContactName', 'StatusId','TrainingHpno','TrainingEmailAddress','TrainingCompanyName','TrainingContactName'], 'required'],
            [['TrainingProviderCategoryId', 'TrainingProviderStatusId', 'StatusId', 'UserId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['TrainingCompanyName', 'TrainingContactName', 'TrainingAddress', 'Remarks'], 'string', 'max' => 300],
            [['TrainingHpno', 'TrainingTag'], 'string', 'max' => 100],
            [['TrainingEmailAddress'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TrainingProviderId' => Yii::t('app', 'Training Provider ID'),
            'TrainingCompanyName' => Yii::t('app', 'Training Company Name'),
            'TrainingContactName' => Yii::t('app', 'Training Contact Name'),
            'TrainingAddress' => Yii::t('app', 'Training Address'),
            'TrainingHpno' => Yii::t('app', 'Training Hpno'),
            'TrainingEmailAddress' => Yii::t('app', 'Training Email Address'),
            'TrainingProviderCategoryId' => Yii::t('app', 'Training Provider Category ID'),
            'TrainingProviderStatusId' => Yii::t('app', 'Training Provider Status ID'),
            'StatusId' => Yii::t('app', 'Status ID'),
            'TrainingTag' => Yii::t('app', 'Training Tag'),
            'Remarks' => Yii::t('app', 'Remarks'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
            'UserId' => Yii::t('app', 'User ID'),
        ];
    }

    public function getTrainingproviderlist()
    {
        $condition = '';

        //$data = explode(";", $param);
        

        $condition = "";
        $txtSearch      = $_GET['txtSearch'];
        $txtStatusId    = $_GET['txtStatusId'];
        // $txtDeptCatId   = $_GET['txtDeptCatId'];


        $stmt = " SELECT
        tbltrainingprovider.TrainingProviderId,
        tbltrainingprovider.TrainingCompanyName,
        tbltrainingprovider.TrainingContactName,
        tbltrainingprovider.TrainingAddress,
        tbltrainingprovider.TrainingHpno,
        tbltrainingprovider.TrainingEmailAddress,
        tbltrainingprovider.TrainingProviderCategoryId,
        tbltrainingprovider.TrainingProviderStatusId,
        tbltrainingprovider.TrainingTag,
        tbltrainingprovider.Remarks,
        tbltrainingprovider.TransactionDate,
        tbltrainingprovider.UserId,
        tbltrainingproviderstatus.TrainingProviderStatus,
        tblstatusai.`Status`,
        tbltrainingprovider.StatusId
        FROM
        tbltrainingprovider
        INNER JOIN tbltrainingproviderstatus ON tbltrainingprovider.TrainingProviderStatusId = tbltrainingproviderstatus.TrainingProviderStatusId
        INNER JOIN tblstatusai ON tbltrainingprovider.StatusId = tblstatusai.StatusId ";

        if (!empty($txtSearch)) {
            $condition .= "concat(tbltrainingprovider.TrainingCompanyName,tbltrainingprovider.TrainingContactName, tbltrainingprovider.TrainingTag) like '%$txtSearch%' and ";
        }

        if (!empty($txtStatusId)) {
            $condition .= "tbltrainingprovider.TrainingProviderStatusId = $txtStatusId and ";
        }

        //  if (!empty($txtDeptCatId)) {
        //      $condition .= "  tbldepartment.DeptCatId  = $txtDeptCatId and ";
        //  }

        if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }

        $stmt .= $condition . ' ORDER BY  tbltrainingprovider.TrainingCompanyName ';

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }
}
