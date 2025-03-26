<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbleducation".
 *
 * @property int $EducLevelId
 * @property string $EducCode
 * @property string $EducName
 * @property string|null $KPT_EducationCode
 * @property string|null $Ifms_Code
 * @property string|null $EIPTSEducation
 * @property string|null $Ifms_Desc
 * @property int|null $LevelNo
 * @property string|null $ProgramTypeId
 */
class Tbleducation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbleducation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['EducCode', 'EducName'], 'required'],
            [['LevelNo'], 'integer'],
            [['EducCode'], 'string', 'max' => 35],
            [['EducName'], 'string', 'max' => 40],
            [['KPT_EducationCode', 'Ifms_Code'], 'string', 'max' => 3],
            [['EIPTSEducation'], 'string', 'max' => 255],
            [['Ifms_Desc'], 'string', 'max' => 30],
            [['ProgramTypeId'], 'string', 'max' => 11],
            [['EducCode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'EducLevelId' => Yii::t('app', 'Educ Level ID'),
            'EducCode' => Yii::t('app', 'Educ Code'),
            'EducName' => Yii::t('app', 'Educ Name'),
            'KPT_EducationCode' => Yii::t('app', 'Kpt Education Code'),
            'Ifms_Code' => Yii::t('app', 'Ifms Code'),
            'EIPTSEducation' => Yii::t('app', 'Eipts Education'),
            'Ifms_Desc' => Yii::t('app', 'Ifms Desc'),
            'LevelNo' => Yii::t('app', 'Level No'),
            'ProgramTypeId' => Yii::t('app', 'Program Type ID'),
        ];
    }
}
