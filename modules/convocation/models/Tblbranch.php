<?php

namespace app\modules\convocation\models;


use Yii;

/**
 * This is the model class for table "tblbranch".
 *
 * @property int $BranchId
 * @property string $CollegeCode
 * @property string $StudentCode
 * @property string $CollegeName
 * @property string $BranchName
 * @property string|null $DbName
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
            [['CollegeCode', 'StudentCode', 'CollegeName', 'BranchName', 'StateId', 'CurrentCenter', 'TransactionDate'], 'required'],
            [['StateId', 'CountryId', 'StatusId', 'UserId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['CollegeCode', 'StudentCode'], 'string', 'max' => 2],
            [['CollegeName', 'DbName', 'DomainName', 'Address1', 'Address2', 'PhoneNo', 'FaxNo', 'Email'], 'string', 'max' => 50],
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
            'BranchId' => 'Branch ID',
            'CollegeCode' => 'College Code',
            'StudentCode' => 'Student Code',
            'CollegeName' => 'College Name',
            'BranchName' => 'Branch Name',
            'DbName' => 'Db Name',
            'DomainName' => 'Domain Name',
            'Address1' => 'Address1',
            'Address2' => 'Address2',
            'CityName' => 'City Name',
            'PostCode' => 'Post Code',
            'StateId' => 'State ID',
            'CountryId' => 'Country ID',
            'BranchNameForLOA' => 'Branch Name For Loa',
            'PhoneNo' => 'Phone No',
            'FaxNo' => 'Fax No',
            'Email' => 'Email',
            'BranchLogo' => 'Branch Logo',
            'StatusId' => 'Status ID',
            'BranchRemarks' => 'Branch Remarks',
            'SystemAdmin' => 'System Admin',
            'CurrentCenter' => 'Current Center',
            'TransactionDate' => 'Transaction Date',
            'UserId' => 'User ID',
        ];
    }
}
