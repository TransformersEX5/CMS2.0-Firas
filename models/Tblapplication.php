<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblapplication".
 *
 * @property int $ApplicationId
 * @property string|null $AppNo
 * @property int|null $BranchId
 * @property string|null $NRICPassportNo
 * @property string|null $StudName
 * @property int|null $GenderId
 * @property int|null $NationalityId
 * @property int|null $ResidencyId
 * @property int|null $RaceId
 * @property int|null $MaritalId
 * @property int|null $ReligionId
 * @property string|null $DateOfBirth
 * @property int|null $MarketingId Any staff can be marketing
 * @property int|null $AgentId
 * @property int|null $PromoId If any promotion
 * @property int|null $LeedsSourceId Leeds Source
 * @property string|null $Remarks
 * @property string|null $TransactionDate
 * @property string|null $TransactionUpdated
 */
class Tblapplication extends \yii\db\ActiveRecord
{
    // public $verifyCode;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblapplication';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['BranchId', 'GenderId', 'NationalityId', 'ResidencyId', 'RaceId', 'MaritalId', 'ReligionId', 'MarketingId', 'AgentId', 'PromoId', 'LeedsSourceId'], 'integer'],
            [['DateOfBirth', 'TransactionDate', 'TransactionUpdated'], 'safe'],
            [['AppNo'], 'string', 'max' => 16],
            [['NRICPassportNo'], 'string', 'max' => 15],
            [['StudName'], 'string', 'max' => 200],
            [['Remarks'], 'string', 'max' => 300],
            [['NRICPassportNo', 'EmailAddress'], 'unique'],
            [['StudName', 'NRICPassportNo', 'LeedsSourceId', 'GenderId', 'RaceId', 'DateOfBirth', 'NationalityId', 'ReligionId', 'LeedsSourceId', 'EmailAddress', 'MobileNo'], 'required'],
            // ['verifyCode', 'captcha'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ApplicationId' => Yii::t('app', 'Application No'),
            'AppNo' => Yii::t('app', 'App No'),
            'BranchId' => Yii::t('app', 'Branch'),
            'NRICPassportNo' => Yii::t('app', 'NRIC/Passport'),
            'StudName' => Yii::t('app', 'Full Name'),
            'GenderId' => Yii::t('app', 'Gender'),
            'NationalityId' => Yii::t('app', 'Nationality '),
            'ResidencyId' => Yii::t('app', 'Residency'),
            'RaceId' => Yii::t('app', 'Race'),
            'MaritalId' => Yii::t('app', 'Marital'),
            'EmailAddress' => Yii::t('app', 'Email Address'),
            'MobileNo' => Yii::t('app', 'Mobile No.'),

            'ReligionId' => Yii::t('app', 'Religion'),
            'DateOfBirth' => Yii::t('app', 'Date Of Birth'),
            'MarketingId' => Yii::t('app', 'Marketing'),
            'AgentId' => Yii::t('app', 'Agent'),
            'PromoId' => Yii::t('app', 'Promo'),
            'LeedsSourceId' => Yii::t('app', 'Leeds Source'),
            'Remarks' => Yii::t('app', 'Remarks'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
            'TransactionUpdated' => Yii::t('app', 'Transaction Updated'),
            // 'verifyCode' => Yii::t('app', 'Verification Code'),
        ];
    }

    public function getApplicationlist()
    {
        $condition = '';

        //$data = explode(";", $param);

        $condition = "";
        $txtSearch = $_GET['txtSearch'];
        $txtStatusId = $_GET['txtStatusId'];
        //  $txtProgramTypeId = $_GET['txtProgramTypeId'];


        $stmt = " SELECT
        tblapplication.ApplicationId,
        tblapplication.AppNo,
        tblapplication.BranchId,
        tblapplication.NRICPassportNo,
        tblapplication.StudName,
        tblapplication.GenderId,
        tblapplication.NationalityId,
        tblapplication.ResidencyId,
        tblapplication.RaceId,
        tblapplication.MaritalId,
        tblapplication.ReligionId,
        tblapplication.DateOfBirth,
        tblapplication.MarketingId,
        tblapplication.AgentId,
        tblapplication.PromoId,       
        tblapplication.EmailAddress,
        tblapplication.MobileNo,        
        tblapplication.LeedsSourceId,
        tblapplication.Remarks,
        tblapplication.TransactionDate,
        tblapplication.TransactionUpdated
        from tblapplication        
        INNER JOIN tblnationality ON tblapplication.NationalityId = tblnationality.NationalityId ";

        if (!empty($txtSearch)) {
            $condition .= "concat(tblapplication.StudName) like '%$txtSearch%' and ";
        }

        // if (!empty($txtStatusId)) {
        //     $condition .= "tbldepartment.StatusId = $txtStatusId and ";
        // }

        // if (!empty($txtProgramTypeId)) {
        //     $condition .= "  tblprogram.ProgramType  = $txtProgramTypeId and ";
        // }

        if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }

        $stmt .= $condition . ' ORDER BY tblapplication.ApplicationId desc limit 10 ';

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }
}
