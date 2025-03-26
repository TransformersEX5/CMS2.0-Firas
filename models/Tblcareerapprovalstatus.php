<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblcareerapprovalstatus".
 *
 * @property int $CareerApprovalStatusId
 * @property int $CareerId
 * @property int $CareerApprovalSetupId
 * @property int $CurrentStatusId 1 = current. 0 = previous status
 * @property int $UserId
 * @property string|null $Remarks
 * @property string $TransactionDate
 */
class Tblcareerapprovalstatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblcareerapprovalstatus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CareerId', 'CareerApprovalSetupId', 'UserId'], 'required'],
            [['CareerId', 'CareerApprovalSetupId', 'CurrentStatusId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['Remarks'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CareerApprovalStatusId' => 'Career Approval Status ID',
            'CareerId' => 'Career ID',
            'CareerApprovalSetupId' => 'Action',
            'CurrentStatusId' => 'Current Status ID',
            'UserId' => 'User ID',
            'Remarks' => 'Remarks',
            'TransactionDate' => 'Transaction Date',
        ];
    }
}
