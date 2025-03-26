<?php

namespace app\modules\marketingadmin\models;

use Yii;

/**
 * This is the model class for table "tblsalary".
 *
 * @property int $SalaryId
 * @property string|null $SalaryCode
 * @property string|null $SalaryRange RM1850-RM3000
 */
class Tblsalary extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblsalary';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SalaryCode'], 'string', 'max' => 2],
            [['SalaryRange'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SalaryId' => 'Salary ID',
            'SalaryCode' => 'Salary Code',
            'SalaryRange' => 'Salary Range',
        ];
    }
}
