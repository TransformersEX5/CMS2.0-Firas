<?php

namespace app\modules\convocation\models;

use Yii;

/**
 * This is the model class for table "tblstudent".
 *
 * @property int $StudentId
 * @property string|null $AppNo
 * @property string|null $StudentNo
 * @property int|null $CollegeCode
 * @property string|null $StudNRICPassportNo
 * @property string|null $StudName
 * @property int|null $StudGender
 * @property int|null $StudRaceId
 * @property int|null $StudReligionId
 * @property string|null $StudDateOfBirth
 * @property int|null $StudNationalityId
 * @property string|null $StudCorrAddress1
 * @property string|null $StudCorrAddress2
 * @property string|null $StudCorrCity
 * @property string|null $StudCorrPostCode
 * @property int|null $StudCorrStateId
 * @property string|null $StudCorrPhoneNo
 * @property string|null $StudMobileNo
 * @property string|null $StudEmail
 * @property string|null $StudResidenceNo
 * @property string|null $ParentEmail1
 * @property string|null $ParentEmail2
 * @property string|null $StudPinNo
 * @property string|null $StudPassword
 * @property string|null $StudPasswordCrypt
 * @property string|null $user_password_code
 * @property string|null $StudGuardName
 * @property string|null $StudGuardID
 * @property int|null $StudGuardNationalityId
 * @property string|null $StudGuardNRICPassportNo
 * @property int|null $StudGuardRelationshipId
 * @property string|null $StudGuardHomeAddress1
 * @property string|null $StudGuardHomeAddress2
 * @property string|null $StudGuardHomeCity
 * @property int|null $StudGuardHomeStateId
 * @property string|null $StudGuardHomePostCode
 * @property string|null $StudGuardHomePhoneNo
 * @property string|null $StudGuardHandPhone
 * @property int|null $StudGuardAnnualIncome
 * @property int|null $StudGuardOccupationId
 * @property string|null $StudPermHomeAddress1
 * @property string|null $StudPermHomeAddress2
 * @property string|null $StudPermHomeCity
 * @property int|null $StudPermHomeStateId
 * @property string|null $StudPermHomePostCode
 * @property string|null $StudPermHomePhoneNo
 * @property string|null $StudEmergName
 * @property int|null $StudEmergRelationshipId
 * @property string|null $StudEmergHomePhoneNo
 * @property string|null $StudEmergHandPhone
 * @property string|null $StudEmergOfficePhone
 * @property int|null $StudAccomodation
 * @property string|null $AccomodationRemarks
 * @property string|null $StudBloodType
 * @property string|null $StudAlergy
 * @property string|null $StudDisease
 * @property string|null $StudDisability
 * @property resource|null $StudPhoto
 * @property string|null $StudPhotoAddress
 * @property string|null $StudRemarks
 * @property string|null $DateRegister
 * @property string $TransactionUpdated
 * @property int|null $UserId
 * @property int|null $ResidencyId
 * @property int|null $CreateSN
 * @property int|null $StudPortal 1=Allow ; 0=not alllow
 * @property string|null $OldStudentNo
 * @property int|null $MaritalStatusId
 * @property string|null $Spusername
 * @property int|null $DunId
 * @property int|null $ParlimenId
 * @property string|null $Sppassword
 * @property float|null $FamilyIncome
 */
class Tblstudent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblstudent';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CollegeCode', 'StudGender', 'StudRaceId', 'StudReligionId', 'StudNationalityId', 'StudCorrStateId', 'StudGuardNationalityId', 'StudGuardRelationshipId', 'StudGuardHomeStateId', 'StudGuardAnnualIncome', 'StudGuardOccupationId', 'StudPermHomeStateId', 'StudEmergRelationshipId', 'StudAccomodation', 'UserId', 'ResidencyId', 'CreateSN', 'StudPortal', 'MaritalStatusId', 'DunId', 'ParlimenId'], 'integer'],
            [['StudDateOfBirth', 'DateRegister', 'TransactionUpdated'], 'safe'],
            [['StudPhoto', 'StudRemarks'], 'string'],
            [['FamilyIncome'], 'number'],
            [['AppNo', 'StudentNo'], 'string', 'max' => 16],
            [['StudNRICPassportNo', 'StudCorrPhoneNo', 'StudMobileNo', 'StudResidenceNo', 'StudGuardID', 'StudGuardNRICPassportNo', 'StudPermHomePhoneNo', 'StudEmergOfficePhone'], 'string', 'max' => 15],
            [['StudName'], 'string', 'max' => 150],
            [['StudCorrAddress1', 'StudCorrAddress2', 'StudPasswordCrypt', 'StudGuardHomeAddress1', 'StudGuardHomeAddress2', 'StudPermHomeAddress1', 'StudPermHomeAddress2', 'AccomodationRemarks', 'StudDisease', 'StudDisability', 'StudPhotoAddress', 'Spusername', 'Sppassword'], 'string', 'max' => 100],
            [['StudCorrCity', 'StudGuardHomeCity', 'StudPermHomeCity'], 'string', 'max' => 25],
            [['StudCorrPostCode', 'StudGuardHomePostCode', 'StudPermHomePostCode'], 'string', 'max' => 6],
            [['StudEmail'], 'string', 'max' => 40],
            [['ParentEmail1', 'ParentEmail2', 'StudAlergy', 'OldStudentNo'], 'string', 'max' => 50],
            [['StudPinNo'], 'string', 'max' => 8],
            [['StudPassword'], 'string', 'max' => 80],
            [['user_password_code'], 'string', 'max' => 30],
            [['StudGuardName', 'StudEmergName'], 'string', 'max' => 60],
            [['StudGuardHomePhoneNo', 'StudGuardHandPhone', 'StudEmergHomePhoneNo', 'StudEmergHandPhone'], 'string', 'max' => 20],
            [['StudBloodType'], 'string', 'max' => 2],
            [['StudNRICPassportNo'], 'unique'],
            [['StudentNo'], 'unique'],
            [['StudEmail'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'StudentId' => 'Student ID',
            'AppNo' => 'App No',
            'StudentNo' => 'Student No',
            'CollegeCode' => 'College Code',
            'StudNRICPassportNo' => 'Stud Nric Passport No',
            'StudName' => 'Stud Name',
            'StudGender' => 'Stud Gender',
            'StudRaceId' => 'Stud Race ID',
            'StudReligionId' => 'Stud Religion ID',
            'StudDateOfBirth' => 'Stud Date Of Birth',
            'StudNationalityId' => 'Stud Nationality ID',
            'StudCorrAddress1' => 'Stud Corr Address1',
            'StudCorrAddress2' => 'Stud Corr Address2',
            'StudCorrCity' => 'Stud Corr City',
            'StudCorrPostCode' => 'Stud Corr Post Code',
            'StudCorrStateId' => 'Stud Corr State ID',
            'StudCorrPhoneNo' => 'Stud Corr Phone No',
            'StudMobileNo' => 'Stud Mobile No',
            'StudEmail' => 'Stud Email',
            'StudResidenceNo' => 'Stud Residence No',
            'ParentEmail1' => 'Parent Email1',
            'ParentEmail2' => 'Parent Email2',
            'StudPinNo' => 'Stud Pin No',
            'StudPassword' => 'Stud Password',
            'StudPasswordCrypt' => 'Stud Password Crypt',
            'user_password_code' => 'User Password Code',
            'StudGuardName' => 'Stud Guard Name',
            'StudGuardID' => 'Stud Guard ID',
            'StudGuardNationalityId' => 'Stud Guard Nationality ID',
            'StudGuardNRICPassportNo' => 'Stud Guard Nric Passport No',
            'StudGuardRelationshipId' => 'Stud Guard Relationship ID',
            'StudGuardHomeAddress1' => 'Stud Guard Home Address1',
            'StudGuardHomeAddress2' => 'Stud Guard Home Address2',
            'StudGuardHomeCity' => 'Stud Guard Home City',
            'StudGuardHomeStateId' => 'Stud Guard Home State ID',
            'StudGuardHomePostCode' => 'Stud Guard Home Post Code',
            'StudGuardHomePhoneNo' => 'Stud Guard Home Phone No',
            'StudGuardHandPhone' => 'Stud Guard Hand Phone',
            'StudGuardAnnualIncome' => 'Stud Guard Annual Income',
            'StudGuardOccupationId' => 'Stud Guard Occupation ID',
            'StudPermHomeAddress1' => 'Stud Perm Home Address1',
            'StudPermHomeAddress2' => 'Stud Perm Home Address2',
            'StudPermHomeCity' => 'Stud Perm Home City',
            'StudPermHomeStateId' => 'Stud Perm Home State ID',
            'StudPermHomePostCode' => 'Stud Perm Home Post Code',
            'StudPermHomePhoneNo' => 'Stud Perm Home Phone No',
            'StudEmergName' => 'Stud Emerg Name',
            'StudEmergRelationshipId' => 'Stud Emerg Relationship ID',
            'StudEmergHomePhoneNo' => 'Stud Emerg Home Phone No',
            'StudEmergHandPhone' => 'Stud Emerg Hand Phone',
            'StudEmergOfficePhone' => 'Stud Emerg Office Phone',
            'StudAccomodation' => 'Stud Accomodation',
            'AccomodationRemarks' => 'Accomodation Remarks',
            'StudBloodType' => 'Stud Blood Type',
            'StudAlergy' => 'Stud Alergy',
            'StudDisease' => 'Stud Disease',
            'StudDisability' => 'Stud Disability',
            'StudPhoto' => 'Stud Photo',
            'StudPhotoAddress' => 'Stud Photo Address',
            'StudRemarks' => 'Stud Remarks',
            'DateRegister' => 'Date Register',
            'TransactionUpdated' => 'Transaction Updated',
            'UserId' => 'User ID',
            'ResidencyId' => 'Residency ID',
            'CreateSN' => 'Create Sn',
            'StudPortal' => 'Stud Portal',
            'OldStudentNo' => 'Old Student No',
            'MaritalStatusId' => 'Marital Status ID',
            'Spusername' => 'Spusername',
            'DunId' => 'Dun ID',
            'ParlimenId' => 'Parlimen ID',
            'Sppassword' => 'Sppassword',
            'FamilyIncome' => 'Family Income',
        ];
    }
}
