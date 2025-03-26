<?php

namespace app\modules\convocation\models;

use Yii;

/**
 * This is the model class for table "tblconvocationdetails".
 *
 * @property int $ConvoDetailsId
 * @property string|null $ConvoPortalOpen
 * @property string|null $ConvoDate
 * @property string|null $ConvoVenue
 * @property string|null $ConvoTimeStart
 * @property string|null $ConvoTimeEnd
 * @property string|null $ConvoEmail
 * @property string|null $ConvoTelNo
 * @property float|null $ConvoFee
 * @property float|null $MaxGuests
 * @property string|null $ConvoYear
 * @property string|null $BriefDate
 * @property string|null $BriefTimeStart
 * @property string|null $BriefTimeEnd
 * @property string|null $BriefVenue
 * @property string|null $RehearsalTime
 * @property string|null $RehearsalVenue
 * @property float|null $RobeDeposit
 * @property float|null $RobeNonReturnFee
 * @property string|null $ConvoTracerDateStart
 * @property string|null $ConvoTracerDateEnd
 * @property string|null $ConvoMOHE MOHE URL (For tracer study)
 * @property int|null $ConvoStatus 1 = Active, 2 = Not Active
 * @property string|null $TransactionDate
 */
class Tblconvocationdetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblconvocationdetails';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ConvoPortalOpen', 'ConvoDate', 'ConvoTimeStart', 'ConvoTimeEnd', 'BriefDate', 'BriefTimeStart', 'BriefTimeEnd', 'RehearsalTime', 'ConvoTracerDateStart', 'ConvoTracerDateEnd', 'TransactionDate'], 'safe'],
            [['ConvoFee', 'MaxGuests', 'RobeDeposit', 'RobeNonReturnFee'], 'number'],
            [['ConvoStatus'], 'integer'],
            [['ConvoVenue', 'ConvoEmail', 'ConvoTelNo', 'ConvoYear', 'BriefVenue', 'RehearsalVenue', 'ConvoMOHE'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ConvoDetailsId' => 'Convo Details ID',
            'ConvoPortalOpen' => 'Convocation Portal Open Date',
            'ConvoDate' => 'Date',
            'ConvoVenue' => 'Venue',
            'ConvoTimeStart' => 'Time Start',
            'ConvoTimeEnd' => 'Time End',
            'ConvoEmail' => 'Email',
            'ConvoTelNo' => 'General Line',
            'ConvoFee' => 'Registration Fee (RM)',
            'MaxGuests' => 'Maximum Number of Guests',
            'ConvoYear' => 'Year',
            'BriefDate' => 'Date',
            'BriefTimeStart' => 'Time Start',
            'BriefTimeEnd' => 'Time End',
            'BriefVenue' => 'Venue',
            'RehearsalTime' => 'Time',
            'RehearsalVenue' => 'Venue',
            'RobeDeposit' => 'Robe Deposit (RM)',
            'RobeNonReturnFee' => 'Robe Non-Return Fee (RM)',
            'ConvoTracerDateStart' => 'Date Start',
            'ConvoTracerDateEnd' => 'Date End',
            'ConvoMOHE' => 'MOHE URL',
            'ConvoStatus' => 'Status',
            'TransactionDate' => 'Transaction Date',
        ];
    }
}
