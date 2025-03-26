<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblcareer".
 *
 * @property int $CareerId
 * @property int $PositionId
 * @property int|null $FacultyId
 * @property string|null $JdDetail
 * @property string|null $JobBrief
 * @property string|null $BasicQualification
 * @property string|null $Responsibilities
 * @property int|null $SalaryMin
 * @property int|null $SalaryMax
 * @property int|null $SalaryShow
 * @property int|null $WorkingStatusId
 * @property string|null $StartDate
 * @property string|null $EndDate
 * @property int|null $BranchId
 * @property int|null $StatusId
 * @property string|null $Remarks
 * @property string|null $TransDate
 * @property int|null $UserId
 * @property int|null $Sorting To sort job vacancies list in career page
 * @property int|null $InchargeId
 * @property int|null $HeadcountId
 * @property int|null $BudgettedId Budgetted request or not
 */
class Tblcareer extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'tblcareer';
    }

    public function rules()
    {
        return [
            [['PositionId'], 'required'],
            [['PositionId', 'FacultyId', 'SalaryMin', 'SalaryMax', 'SalaryShow', 'WorkingStatusId', 'BranchId', 'StatusId', 'UserId', 'Sorting', 'InchargeId', 'HeadcountId', 'BudgettedId'], 'integer'],
            [['JdDetail', 'BasicQualification', 'Responsibilities'], 'string'],
            [['StartDate', 'EndDate', 'TransDate'], 'safe'],
            [['JobBrief'], 'string', 'max' => 1000],
            [['Remarks'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'CareerId' => 'Career ID',
            'PositionId' => 'Position',
            'FacultyId' => 'Faculty/Department',
            'JdDetail' => 'Job Description',
            'JobBrief' => 'Job Brief',
            'BasicQualification' => 'Basic Qualification',
            'SalaryMin' => 'Minimum Salary (RM)',
            'SalaryMax' => 'Maximum Salary (RM)',
            'SalaryShow' => 'Do you want to display the salary range in the career website?',
            'WorkingStatusId' => 'Working Status ID',
            'StartDate' => 'Publish Date',
            'EndDate' => 'Expiry Date',
            'BranchId' => 'Branch',
            'StatusId' => 'Action',
            'Remarks' => 'Remarks',
            'TransDate' => 'Trans Date',
            'UserId' => 'User ID',
            'Sorting' => 'Sorting',
            'Responsibilities' => 'Responsibilities & Duties (To be included in LOA only)',
            'InchargeId' => 'Incharge',
            'HeadcountId' => 'Head Count',
            'BudgettedId' => 'Is this request budgetted?',
        ];
    }
}
