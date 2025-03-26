<?php

namespace app\modules\convocation\models;

use Yii;

/**
 * This is the model class for table "tblconvocationregister".
 *
 * @property int $ConvoRegId
 * @property string|null $DataFrom
 * @property int|null $ProgramRegId
 * @property string|null $StudName
 * @property string|null $StudNRICPassportNo
 * @property string|null $StudentNo
 * @property string|null $StudPortalEmail Used to login, the same as email to login into student portal
 * @property string|null $StudEmail From tblalumnidetails
 * @property string|null $ContactNo From tblalumnidetails
 * @property string|null $CorrAddress1 From tblalumnidetails
 * @property string|null $CorrAddress2 From tblalumnidetails
 * @property string|null $CorrPostcode From tblalumnidetails
 * @property string|null $CorrCity From tblalumnidetails
 * @property int|null $CorrStateId From tblalumnidetails
 * @property string|null $CorrContact From tblalumnidetails
 * @property string|null $PermAddress1 From tblalumnidetails
 * @property string|null $PermAddress2 From tblalumnidetails
 * @property string|null $PermPostcode From tblalumnidetails
 * @property string|null $PermCity From tblalumnidetails
 * @property int|null $PermStateId From tblalumnidetails
 * @property string|null $PermContact From tblalumnidetails
 * @property int|null $StudGender 1 = Male, 2 = Female
 * @property int|null $ResidencyId 1 = Malaysian, 2 = International
 * @property int|null $StudRaceId
 * @property string|null $RaceName
 * @property int|null $StudNationalityId
 * @property string|null $NationalityName
 * @property string|null $StudPassword
 * @property int|null $StudentStatus
 * @property string|null $FacultyName
 * @property string|null $ProgramTypeName
 * @property string|null $ProgramCode
 * @property string|null $ProgramName
 * @property int|null $AlumniStatusId Fill In Alumni Form; 1 = Completed, 2 = Not Complete
 * @property string|null $Outstanding
 * @property int|null $ConvoAttend 1 = Attend, 2 = Not Attend
 * @property int|null $ConvoGuestNo
 * @property int|null $ConvoExtraGuestNo
 * @property float|null $ConvoExtraGuestCharge
 * @property int|null $RobeId
 * @property int|null $ConvoTracerStudy 1 = Submit, 2 = Not Submit
 * @property float|null $ConvoFeeCharge
 * @property float|null $ConvoTotalFee
 * @property float|null $ConvoAmountPaid
 * @property int|null $ConvoGraduateYear The Convocation Year, Not The Year The Convocation Being Held
 * @property int|null $ConvoRegisterStatusId 1 = Convo Registered, 2 = Convo Not Register
 * @property string|null $ConvoDateRegister
 * @property int|null $ConvoPaymentStatus 1 = Full Payment, 2 = No Payment, 3 = Not Full Payment
 * @property int|null $ConvoConfirmStatus Final Confirmation Status
 * @property int|null $ConvoReturningStudent 1 = Normal, 2 = Returning Student
 * @property string|null $TransactionDate
 */
class Tblconvocationregister extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblconvocationregister';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ProgramRegId', 'CorrStateId', 'PermStateId', 'StudGender', 'ResidencyId', 'StudRaceId', 'StudNationalityId', 'StudentStatus', 'AlumniStatusId', 'ConvoAttend', 'ConvoGuestNo', 'ConvoExtraGuestNo', 'RobeId', 'ConvoTracerStudy', 'ConvoGraduateYear', 'ConvoRegisterStatusId', 'ConvoPaymentStatus', 'ConvoConfirmStatus', 'ConvoReturningStudent'], 'integer'],
            [['ConvoExtraGuestCharge', 'ConvoFeeCharge', 'ConvoTotalFee', 'ConvoAmountPaid'], 'number'],
            [['ConvoDateRegister', 'TransactionDate'], 'safe'],
            [['DataFrom'], 'string', 'max' => 40],
            [['StudName', 'StudPortalEmail', 'StudEmail', 'CorrAddress1', 'CorrAddress2', 'CorrPostcode', 'CorrCity', 'CorrContact', 'PermAddress1', 'PermAddress2', 'PermPostcode', 'PermCity', 'PermContact', 'RaceName', 'NationalityName', 'FacultyName', 'ProgramTypeName', 'ProgramCode', 'ProgramName', 'Outstanding'], 'string', 'max' => 255],
            [['StudNRICPassportNo', 'StudentNo', 'ContactNo'], 'string', 'max' => 20],
            [['StudPassword'], 'string', 'max' => 80],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ConvoRegId' => 'Convo Reg ID',
            'DataFrom' => 'Data From',
            'ProgramRegId' => 'Program Reg ID',
            'StudName' => 'Stud Name',
            'StudNRICPassportNo' => 'Stud Nric Passport No',
            'StudentNo' => 'Student No.',
            'StudPortalEmail' => 'Stud Portal Email',
            'StudEmail' => 'Email',
            'ContactNo' => 'Contact No.',
            'CorrAddress1' => 'Address Line 1',
            'CorrAddress2' => 'Address Line 2',
            'CorrPostcode' => 'Postcode',
            'CorrCity' => 'City',
            'CorrStateId' => 'State',
            'CorrContact' => 'Contact No.',
            'PermAddress1' => 'Address Line 1',
            'PermAddress2' => 'Address Line 2',
            'PermPostcode' => 'Postcode',
            'PermCity' => 'City',
            'PermStateId' => 'State',
            'PermContact' => 'Contact No.',
            'StudGender' => 'Stud Gender',
            'ResidencyId' => 'Residency ID',
            'StudRaceId' => 'Stud Race ID',
            'RaceName' => 'Race Name',
            'StudNationalityId' => 'Stud Nationality ID',
            'NationalityName' => 'Nationality Name',
            'StudPassword' => 'Stud Password',
            'StudentStatus' => 'Student Status',
            'FacultyName' => 'Faculty Name',
            'ProgramTypeName' => 'Program Type Name',
            'ProgramCode' => 'Program Code',
            'ProgramName' => 'Program Name',
            'AlumniStatusId' => 'Alumni Status ID',
            'Outstanding' => 'Outstanding',
            'ConvoAttend' => 'Convo Attend',
            'ConvoGuestNo' => 'Convo Guest No',
            'ConvoExtraGuestNo' => 'Convo Extra Guest No',
            'ConvoExtraGuestCharge' => 'Convo Extra Guest Charge',
            'RobeId' => 'Robe ID',
            'ConvoTracerStudy' => 'Convo Tracer Study',
            'ConvoFeeCharge' => 'Convo Fee Charge',
            'ConvoTotalFee' => 'Convo Total Fee',
            'ConvoAmountPaid' => 'Convo Amount Paid',
            'ConvoGraduateYear' => 'Convo Graduate Year',
            'ConvoRegisterStatusId' => 'Convo Register Status ID',
            'ConvoDateRegister' => 'Convo Date Register',
            'ConvoPaymentStatus' => 'Convo Payment Status',
            'ConvoConfirmStatus' => 'Convo Confirm Status',
            'ConvoReturningStudent' => 'Convo Returning Student',
            'TransactionDate' => 'Transaction Date',
        ];
    }
}
