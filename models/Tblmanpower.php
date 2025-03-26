<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblmanpower".
 *
 * @property int $ManPowerId
 * @property int $PositionId
 * @property int $BranchId
 * @property int $DepartmentId
 * @property string|null $DateRequired
 * @property int|null $TotRequired
 * @property int|null $TypeRequestId ADDITIONAL/ REPLACEMENT POSITION
 * @property int|null $DueToRequest
 * @property string|null $Justification
 * @property int|null $EmploymentStatusId FULL-TIME /PART TIME /CONTRACT
 * @property int|null $DurationEmployment EMPLOYMENT DURATION IF PT OR CONTRACT
 * @property int|null $TotTeachHours HOURS TEACHING PER WEEK
 * @property string|null $SubjectName What subject to be teach
 * @property resource|null $Qualification
 * @property resource|null $Experience
 * @property resource|null $SpecificsSkills
 * @property resource|null $Responsibilities JD
 * @property string|null $Remarks for HR remarks..
 * @property int|null $CheckListCompletForm
 * @property int|null $CheckListOrgChart
 * @property int|null $CheckListJD
 * @property string $TransDate
 * @property int $UserId
 */
class Tblmanpower extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblmanpower';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['PositionId', 'BranchId', 'DepartmentId', 'UserId'], 'required'],
            [['PositionId', 'BranchId', 'DepartmentId', 'TotRequired', 'TypeRequestId', 'DueToRequest', 'EmploymentStatusId', 'DurationEmployment', 'TotTeachHours', 'CheckListCompletForm', 'CheckListOrgChart', 'CheckListJD', 'UserId'], 'integer'],
            [['DateRequired', 'TransDate'], 'safe'],
            [['Qualification', 'Experience', 'SpecificsSkills', 'Responsibilities', 'Remarks'], 'string'],
            [['Justification', 'SubjectName'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ManPowerId' => Yii::t('app', 'Man Power ID'),
            'PositionId' => Yii::t('app', 'Position ID'),
            'BranchId' => Yii::t('app', 'Branch ID'),
            'DepartmentId' => Yii::t('app', 'Department ID'),
            'DateRequired' => Yii::t('app', 'Date Required'),
            'TotRequired' => Yii::t('app', 'Tot Required'),
            'TypeRequestId' => Yii::t('app', 'Type Request ID'),
            'DueToRequest' => Yii::t('app', 'Due To Request'),
            'Justification' => Yii::t('app', 'Justification'),
            'EmploymentStatusId' => Yii::t('app', 'Employment Status ID'),
            'DurationEmployment' => Yii::t('app', 'Duration Employment'),
            'TotTeachHours' => Yii::t('app', 'Tot Teach Hours'),
            'SubjectName' => Yii::t('app', 'Subject Name'),
            'Qualification' => Yii::t('app', 'Qualification'),
            'Experience' => Yii::t('app', 'Experience'),
            'SpecificsSkills' => Yii::t('app', 'Specifics Skills'),
            'Responsibilities' => Yii::t('app', 'Responsibilities'),
            'Remarks' => Yii::t('app', 'Remarks'),
            'CheckListCompletForm' => Yii::t('app', 'Check List Complet Form'),
            'CheckListOrgChart' => Yii::t('app', 'Check List Org Chart'),
            'CheckListJD' => Yii::t('app', 'Check List Jd'),
            'TransDate' => Yii::t('app', 'Trans Date'),
            'UserId' => Yii::t('app', 'User ID'),
        ];
    }
}
