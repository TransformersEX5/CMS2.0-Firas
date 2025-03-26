<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblstudedusubj".
 *
 * @property int $StudEduSubjId
 * @property int $StudEducId
 * @property int $EduSubjId
 * @property string $Result
 * @property int $UserId
 */
class Tblstudedusubj extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblstudedusubj';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['StudEducId', 'EduSubjId', 'Result', 'UserId'], 'required'],
            [['StudEducId', 'EduSubjId', 'UserId'], 'integer'],
            [['Result'], 'string', 'max' => 10],
            [['StudEducId', 'EduSubjId'], 'unique', 'targetAttribute' => ['StudEducId', 'EduSubjId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'StudEduSubjId' => Yii::t('app', 'Stud Edu Subj ID'),
            'StudEducId' => Yii::t('app', 'Stud Educ ID'),
            'EduSubjId' => Yii::t('app', 'Subject'),
            'Result' => Yii::t('app', 'Result'),
            'UserId' => Yii::t('app', 'User ID'),
        ];
    }
}
