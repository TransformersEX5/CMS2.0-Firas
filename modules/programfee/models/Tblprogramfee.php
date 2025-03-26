<?php

namespace app\modules\programfee\models;

use Yii;

/**
 * This is the model class for table "tblprogramfee".
 *
 * @property int $ProgramFeeId
 * @property int $ProgramIntId
 * @property int $ProgramId
 * @property int $IntakeStart
 * @property int $IntakeEnd
 * @property int $SemesterNo
 * @property int $FeeTypeId
 * @property float $FeeAmount
 * @property int $FeeYearId
 * @property string|null $FeeDesc
 * @property int $Residency
 * @property int $SessionId
 * @property int|null $FeeStructureId
 * @property int|null $ProgFeeCatId
 * @property string $TransactionDate
 * @property string $TransactionUpdated
 * @property int $UserId
 */
class Tblprogramfee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblprogramfee';
    }

    /**
     * {@inheritdoc}
     */

    //  ProgramIntId, FeeTypeId, Residency, SessionId, FeeYearId, FeeStructureId, SemesterNo
    public function rules()
    {
        return [
            // [['ProgramIntId', 'ProgramId', 'IntakeStart', 'IntakeEnd', 'FeeTypeId', 'FeeAmount', 'Residency', 'TransactionUpdated', 'UserId'], 'required'],
            [['ProgFeeCatId', 'ProgramId', 'Residency', 'UserId'], 'required'],
            
            [['ProgramIntId', 'ProgramId', 'IntakeStart', 'IntakeEnd', 'SemesterNo', 'FeeTypeId', 'FeeYearId', 'Residency', 'SessionId', 'FeeStructureId', 'ProgFeeCatId', 'UserId'], 'integer'],
            [['FeeAmount'], 'number'],
            [['TransactionDate', 'TransactionUpdated'], 'safe'],
            [['FeeDesc'], 'string', 'max' => 25],
            // [['ProgramIntId', 'FeeTypeId', 'Residency', 'SessionId', 'FeeYearId', 'FeeStructureId', 'SemesterNo'], 'unique', 'targetAttribute' => ['ProgramIntId', 'FeeTypeId', 'Residency', 'SessionId', 'FeeYearId', 'FeeStructureId', 'SemesterNo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ProgramFeeId' => 'Program Fee ID',
            'ProgramIntId' => 'Program Int ID',
            'ProgramId' => 'Program ID',
            'IntakeStart' => 'Intake Start',
            'IntakeEnd' => 'Intake End',
            'SemesterNo' => 'Semester No',
            'FeeTypeId' => 'Fee Type ID',
            'FeeAmount' => 'Fee Amount',
            'FeeYearId' => 'Fee Year ID',
            'FeeDesc' => 'Fee Desc',
            'Residency' => 'Residency',
            'SessionId' => 'Session ID',
            'FeeStructureId' => 'Fee Structure ID',
            'ProgFeeCatId' => 'Prog Fee Cat ID',
            'TransactionDate' => 'Transaction Date',
            'TransactionUpdated' => 'Transaction Updated',
            'UserId' => 'User ID',
        ];
    }
}
