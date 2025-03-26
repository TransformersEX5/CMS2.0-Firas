<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblstudworkexprience".
 *
 * @property int $WorkExprienceId
 * @property string $StudNIRCPassport
 * @property string $WorkCompany
 * @property string $WorkPosition
 * @property int $WorkFromYear
 * @property int $WorkToYear
 */
class Tblstudworkexprience extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblstudworkexprience';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['StudNIRCPassport', 'WorkCompany', 'WorkPosition', 'WorkFromYear', 'WorkToYear'], 'required'],
            [['WorkFromYear', 'WorkToYear'], 'integer'],
            [['StudNIRCPassport'], 'string', 'max' => 16],
            [['WorkCompany'], 'string', 'max' => 80],
            [['WorkPosition'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'WorkExprienceId' => Yii::t('app', 'Work Exprience ID'),
            'StudNIRCPassport' => Yii::t('app', 'Stud Nirc Passport'),
            'WorkCompany' => Yii::t('app', 'Work Company'),
            'WorkPosition' => Yii::t('app', 'Work Position'),
            'WorkFromYear' => Yii::t('app', 'Work From Year'),
            'WorkToYear' => Yii::t('app', 'Work To Year'),
        ];
    }
}
