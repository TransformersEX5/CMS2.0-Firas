<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblcalendarbranch".
 *
 * @property int $PKBranchId
 * @property int $BranchId
 * @property string $lDate
 * @property int $HolidayId
 * @property string|null $Remarks
 * @property int $UserId
 * @property string $TransactionDate
 */
class Tblcalendarbranch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblcalendarbranch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['BranchId', 'HolidayId', 'UserId'], 'integer'],
            [['lDate', 'UserId'], 'required'],
            [['lDate', 'TransactionDate'], 'safe'],
            [['Remarks'], 'string', 'max' => 100],
            [['BranchId', 'lDate'], 'unique', 'targetAttribute' => ['BranchId', 'lDate']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'PKBranchId' => 'Pk Branch ID',
            'BranchId' => 'Branch ID',
            'lDate' => 'L Date',
            'HolidayId' => 'Holiday ID',
            'Remarks' => 'Remarks',
            'UserId' => 'User ID',
            'TransactionDate' => 'Transaction Date',
        ];
    }
}
