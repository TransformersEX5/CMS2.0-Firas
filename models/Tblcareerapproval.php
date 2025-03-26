<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblcareerapproval".
 *
 * @property int $CareerApprovalStatusId
 * @property int $CareerId
 * @property int $CareerStatusId Refer tblcareerstatus
 * @property int $CurrentStatusId 1 = current. 0 = previous status
 * @property int $UserId
 * @property string $TransactionDate
 */
class Tblcareerapproval extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblcareerapproval';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CareerId', 'CareerStatusId', 'UserId'], 'required'],
            [['CareerId', 'CareerStatusId', 'CurrentStatusId', 'UserId'], 'integer'],
            [['TransactionDate'], 'safe'],
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
            'CareerStatusId' => 'Career Status ID',
            'CurrentStatusId' => 'Current Status ID',
            'UserId' => 'User ID',
            'TransactionDate' => 'Transaction Date',
        ];
    }
}
