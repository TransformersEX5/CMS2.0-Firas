<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblconvocationstaffdetails".
 *
 * @property int $ConvoStaffDetailsId
 * @property int|null $ConvoUserId
 * @property string|null $ConvoStaffName
 * @property string|null $ConvoStaffEmail
 * @property string|null $ConvoStaffMobileNo
 * @property int|null $ConvoStaffPositionId
 * @property int|null $StatusId 1 = Active, 2 = Not Active
 * @property string|null $TransactionDate
 */
class Tblconvocationstaffdetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblconvocationstaffdetails';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ConvoUserId', 'ConvoStaffPositionId', 'StatusId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['ConvoStaffName', 'ConvoStaffEmail'], 'string', 'max' => 255],
            [['ConvoStaffMobileNo'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ConvoStaffDetailsId' => 'Convo Staff Details ID',
            'ConvoUserId' => 'Convo User ID',
            'ConvoStaffName' => 'Convo Staff Name',
            'ConvoStaffEmail' => 'Convo Staff Email',
            'ConvoStaffMobileNo' => 'Convo Staff Mobile No',
            'ConvoStaffPositionId' => 'Convo Staff Position ID',
            'StatusId' => 'Status ID',
            'TransactionDate' => 'Transaction Date',
        ];
    }
}
