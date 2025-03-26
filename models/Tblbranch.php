<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblbranch".
 *
 * @property int $BranchId
 * @property string $CollegeCode
 * @property string $CollegeName
 * @property string $BranchName
 * @property string|null $DomainName
 * @property string|null $Address1
 * @property string|null $Address2
 * @property string|null $CityName
 * @property string|null $PostCode
 * @property int $StateId
 * @property int|null $CountryId
 * @property string|null $BranchNameForLOA
 * @property string|null $PhoneNo
 * @property string|null $FaxNo
 * @property string|null $Email
 * @property string|null $BranchLogo
 * @property int $StatusId
 * @property string|null $BranchRemarks
 * @property string|null $SystemAdmin
 * @property string $CurrentCenter
 * @property string $TransactionDate
 * @property int|null $UserId
 */
class Tblbranch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblbranch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CollegeCode', 'CollegeName', 'BranchName', 'StateId', 'CurrentCenter', 'TransactionDate'], 'required'],
            [['StateId', 'CountryId', 'StatusId', 'UserId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['CollegeCode'], 'string', 'max' => 2],
            [['CollegeName', 'DomainName', 'Address1', 'Address2', 'PhoneNo', 'FaxNo', 'Email'], 'string', 'max' => 50],
            [['BranchName'], 'string', 'max' => 100],
            [['CityName'], 'string', 'max' => 35],
            [['PostCode'], 'string', 'max' => 5],
            [['BranchNameForLOA'], 'string', 'max' => 250],
            [['BranchLogo', 'BranchRemarks', 'SystemAdmin'], 'string', 'max' => 255],
            [['CurrentCenter'], 'string', 'max' => 1],
            [['CollegeCode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'BranchId' => Yii::t('app', 'Branch ID'),
            'CollegeCode' => Yii::t('app', 'College Code'),
            'CollegeName' => Yii::t('app', 'College Name'),
            'BranchName' => Yii::t('app', 'Branch Name'),
            'DomainName' => Yii::t('app', 'Domain Name'),
            'Address1' => Yii::t('app', 'Address1'),
            'Address2' => Yii::t('app', 'Address2'),
            'CityName' => Yii::t('app', 'City Name'),
            'PostCode' => Yii::t('app', 'Post Code'),
            'StateId' => Yii::t('app', 'State ID'),
            'CountryId' => Yii::t('app', 'Country ID'),
            'BranchNameForLOA' => Yii::t('app', 'Branch Name For Loa'),
            'PhoneNo' => Yii::t('app', 'Phone No'),
            'FaxNo' => Yii::t('app', 'Fax No'),
            'Email' => Yii::t('app', 'Email'),
            'BranchLogo' => Yii::t('app', 'Branch Logo'),
            'StatusId' => Yii::t('app', 'Status ID'),
            'BranchRemarks' => Yii::t('app', 'Branch Remarks'),
            'SystemAdmin' => Yii::t('app', 'System Admin'),
            'CurrentCenter' => Yii::t('app', 'Current Center'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
            'UserId' => Yii::t('app', 'User ID'),
        ];
    }
}
