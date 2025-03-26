<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblhod".
 *
 * @property int $HodId
 * @property string $HodDesc
 * @property int $UserId
 * @property int $ClassRepApprovalId ClassRepApprovalId = Approval by PnRosnizah
 * @property int $StatusId
 * @property string $TransactionTime
 * @property int $StaffId
 */
class Tblhod extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblhod';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['HodDesc', 'UserId', 'ClassRepApprovalId', 'StatusId', 'StaffId'], 'required'],
            [['UserId', 'ClassRepApprovalId', 'StatusId', 'StaffId'], 'integer'],
            [['TransactionTime'], 'safe'],
            [['HodDesc'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'HodId' => 'Hod ID',
            'HodDesc' => 'Hod Desc',
            'UserId' => 'User ID',
            'ClassRepApprovalId' => 'Class Rep Approval ID',
            'StatusId' => 'Status ID',
            'TransactionTime' => 'Transaction Time',
            'StaffId' => 'Staff ID',
        ];
    }
}
