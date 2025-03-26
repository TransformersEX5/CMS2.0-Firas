<?php

namespace app\modules\convocation\models;

use Yii;

/**
 * This is the model class for table "tblefcinvitation".
 *
 * @property int $InvitationId
 * @property string $DataFrom
 * @property int $ProgramRegId
 * @property int $CurrentStatusId
 * @property int $UserId
 * @property string $TransactionDate
 */
class Tblefcinvitation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblefcinvitation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['DataFrom', 'ProgramRegId'], 'required'],
            [['ProgramRegId'], 'integer'],
            [['CurrentStatusId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['UserId'], 'integer'],
            [['DataFrom'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'InvitationId' => 'Invitation ID',
            'DataFrom' => 'Data From',
            'ProgramRegId' => 'Program Reg ID',
            'CurrentStatusId' => 'Current Status ID',
            'UserId' => 'User ID',
            'TransactionDate' => 'Transaction Date',
        ];
    }
}
