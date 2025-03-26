<?php

namespace app\models;

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
            'StudentId' => Yii::t('app', 'Student ID'),
            'AppNo' => Yii::t('app', 'App No'),
            'StudentNo' => Yii::t('app', 'Student No'),
            'CollegeCode' => Yii::t('app', 'College Code'),
            'StudNRICPassportNo' => Yii::t('app', 'Stud Nric Passport No'),
            'StudName' => Yii::t('app', 'Stud Name'),
            'StudGender' => Yii::t('app', 'Stud Gender'),
            'StudRaceId' => Yii::t('app', 'Stud Race ID'),
            'StudReligionId' => Yii::t('app', 'Stud Religion ID'),
            'StudDateOfBirth' => Yii::t('app', 'Stud Date Of Birth'),
            'StudNationalityId' => Yii::t('app', 'Stud Nationality ID'),
            'StudCorrAddress1' => Yii::t('app', 'Stud Corr Address1'),
            'StudCorrAddress2' => Yii::t('app', 'Stud Corr Address2'),
            'StudCorrCity' => Yii::t('app', 'Stud Corr City'),
            'StudCorrPostCode' => Yii::t('app', 'Stud Corr Post Code'),
            'StudCorrStateId' => Yii::t('app', 'Stud Corr State ID'),
            'StudCorrPhoneNo' => Yii::t('app', 'Stud Corr Phone No'),
            'StudMobileNo' => Yii::t('app', 'Stud Mobile No'),
            'StudEmail' => Yii::t('app', 'Stud Email'),
            'StudResidenceNo' => Yii::t('app', 'Stud Residence No'),
            'ParentEmail1' => Yii::t('app', 'Parent Email1'),
            'ParentEmail2' => Yii::t('app', 'Parent Email2'),
            'StudPinNo' => Yii::t('app', 'Stud Pin No'),
            'StudPassword' => Yii::t('app', 'Stud Password'),
            'StudPasswordCrypt' => Yii::t('app', 'Stud Password Crypt'),
            'user_password_code' => Yii::t('app', 'User Password Code'),
            'StudGuardName' => Yii::t('app', 'Stud Guard Name'),
            'StudGuardID' => Yii::t('app', 'Stud Guard ID'),
            'StudGuardNationalityId' => Yii::t('app', 'Stud Guard Nationality ID'),
            'StudGuardNRICPassportNo' => Yii::t('app', 'Stud Guard Nric Passport No'),
            'StudGuardRelationshipId' => Yii::t('app', 'Stud Guard Relationship ID'),
            'StudGuardHomeAddress1' => Yii::t('app', 'Stud Guard Home Address1'),
            'StudGuardHomeAddress2' => Yii::t('app', 'Stud Guard Home Address2'),
            'StudGuardHomeCity' => Yii::t('app', 'Stud Guard Home City'),
            'StudGuardHomeStateId' => Yii::t('app', 'Stud Guard Home State ID'),
            'StudGuardHomePostCode' => Yii::t('app', 'Stud Guard Home Post Code'),
            'StudGuardHomePhoneNo' => Yii::t('app', 'Stud Guard Home Phone No'),
            'StudGuardHandPhone' => Yii::t('app', 'Stud Guard Hand Phone'),
            'StudGuardAnnualIncome' => Yii::t('app', 'Stud Guard Annual Income'),
            'StudGuardOccupationId' => Yii::t('app', 'Stud Guard Occupation ID'),
            'StudPermHomeAddress1' => Yii::t('app', 'Stud Perm Home Address1'),
            'StudPermHomeAddress2' => Yii::t('app', 'Stud Perm Home Address2'),
            'StudPermHomeCity' => Yii::t('app', 'Stud Perm Home City'),
            'StudPermHomeStateId' => Yii::t('app', 'Stud Perm Home State ID'),
            'StudPermHomePostCode' => Yii::t('app', 'Stud Perm Home Post Code'),
            'StudPermHomePhoneNo' => Yii::t('app', 'Stud Perm Home Phone No'),
            'StudEmergName' => Yii::t('app', 'Stud Emerg Name'),
            'StudEmergRelationshipId' => Yii::t('app', 'Stud Emerg Relationship ID'),
            'StudEmergHomePhoneNo' => Yii::t('app', 'Stud Emerg Home Phone No'),
            'StudEmergHandPhone' => Yii::t('app', 'Stud Emerg Hand Phone'),
            'StudEmergOfficePhone' => Yii::t('app', 'Stud Emerg Office Phone'),
            'StudAccomodation' => Yii::t('app', 'Stud Accomodation'),
            'AccomodationRemarks' => Yii::t('app', 'Accomodation Remarks'),
            'StudBloodType' => Yii::t('app', 'Stud Blood Type'),
            'StudAlergy' => Yii::t('app', 'Stud Alergy'),
            'StudDisease' => Yii::t('app', 'Stud Disease'),
            'StudDisability' => Yii::t('app', 'Stud Disability'),
            'StudPhoto' => Yii::t('app', 'Stud Photo'),
            'StudPhotoAddress' => Yii::t('app', 'Stud Photo Address'),
            'StudRemarks' => Yii::t('app', 'Stud Remarks'),
            'DateRegister' => Yii::t('app', 'Date Register'),
            'TransactionUpdated' => Yii::t('app', 'Transaction Updated'),
            'UserId' => Yii::t('app', 'User ID'),
            'ResidencyId' => Yii::t('app', 'Residency ID'),
            'CreateSN' => Yii::t('app', 'Create Sn'),
            'StudPortal' => Yii::t('app', 'Stud Portal'),
            'OldStudentNo' => Yii::t('app', 'Old Student No'),
            'MaritalStatusId' => Yii::t('app', 'Marital Status ID'),
            'Spusername' => Yii::t('app', 'Spusername'),
            'DunId' => Yii::t('app', 'Dun ID'),
            'ParlimenId' => Yii::t('app', 'Parlimen ID'),
            'Sppassword' => Yii::t('app', 'Sppassword'),
            'FamilyIncome' => Yii::t('app', 'Family Income'),
        ];
    }

}
