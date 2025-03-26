<?php

namespace app\modules\datin\models;

use Yii;

/**
 * This is the model class for table "tbldatinproperty".
 *
 * @property int $ItemId
 * @property string $ItemName
 * @property string|null $DueDate
 * @property string $PersonInCharge
 * @property string|null $Remarks
 * @property int $StatusId
 * @property string|null $InactiveRemarks
 * @property int $TypeId
 * @property int $UserId
 * @property string $TransactionDate
 */
class Tbldatinproperty extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbldatinproperty';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ItemName', 'PersonInCharge', 'StatusId', 'TypeId', 'UserId'], 'required'],
            [['DueDate', 'TransactionDate'], 'safe'],
            [['StatusId', 'TypeId', 'UserId'], 'integer'],
            [['ItemName', 'PersonInCharge', 'Remarks', 'InactiveRemarks'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ItemId' => 'Item ID',
            'ItemName' => 'Item Name',
            'DueDate' => 'Due Date',
            'PersonInCharge' => 'Person In Charge',
            'Remarks' => 'Remarks',
            'StatusId' => 'Status ID',
            'InactiveRemarks' => 'Inactive Remarks',
            'TypeId' => 'Type ID',
            'UserId' => 'User ID',
            'TransactionDate' => 'Transaction Date',
        ];
    }
}
