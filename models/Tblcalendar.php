<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblcalendar".
 *
 * @property int $PKId
 * @property string|null $lDate
 * @property int|null $lDateStr
 * @property string|null $Days
 * @property int|null $DayId
 * @property string $Months
 * @property int $PublicHoliday 0=No;1=Yes
 * @property int|null $HolidayId
 * @property int $DayOfWeek
 * @property string|null $Remarks
 * @property string|null $WorkingHours
 * @property string|null $NormalWorkingHours
 * @property int|null $ReligionId
 * @property int|null $WeekOfMonth
 */
class Tblcalendar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblcalendar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lDate'], 'safe'],
            [['lDateStr', 'DayId', 'PublicHoliday', 'HolidayId', 'DayOfWeek', 'ReligionId', 'WeekOfMonth'], 'integer'],
            [['Months', 'DayOfWeek'], 'required'],
            [['Days'], 'string', 'max' => 50],
            [['Months'], 'string', 'max' => 10],
            [['Remarks', 'NormalWorkingHours'], 'string', 'max' => 100],
            [['WorkingHours'], 'string', 'max' => 5],
            [['lDate'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'PKId' => 'Pk ID',
            'lDate' => 'L Date',
            'lDateStr' => 'L Date Str',
            'Days' => 'Days',
            'DayId' => 'Day ID',
            'Months' => 'Months',
            'PublicHoliday' => 'Public Holiday',
            'HolidayId' => 'Holiday ID',
            'DayOfWeek' => 'Day Of Week',
            'Remarks' => 'Remarks',
            'WorkingHours' => 'Working Hours',
            'NormalWorkingHours' => 'Normal Working Hours',
            'ReligionId' => 'Religion ID',
            'WeekOfMonth' => 'Week Of Month',
        ];
    }
}
