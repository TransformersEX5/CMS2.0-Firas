<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblcareerapprovalsetup".
 *
 * @property int $CareerApprovalSetupId
 * @property int $LevelId
 * @property string $SetupDesc1 display when user selects dropdown
 * @property string $SetupDesc2 display for approval history
 * @property string $ApproverId
 * @property string $TransactionDate
 */
class Tblcareerapprovalsetup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblcareerapprovalsetup';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['LevelId', 'SetupDesc1', 'SetupDesc2', 'ApproverId'], 'required'],
            [['LevelId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['SetupDesc1', 'SetupDesc2', 'ApproverId'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CareerApprovalSetupId' => 'Career Approval Setup ID',
            'LevelId' => 'Level ID',
            'SetupDesc1' => 'Setup Desc1',
            'SetupDesc2' => 'Setup Desc2',
            'ApproverId' => 'Approver ID',
            'TransactionDate' => 'Transaction Date',
        ];
    }
}
