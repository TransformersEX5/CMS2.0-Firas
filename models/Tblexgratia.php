<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblexgratia".
 *
 * @property int $Id
 * @property string|null $Branch
 * @property int $ProgramRegId
 * @property string|null $UserNo
 * @property string|null $P1
 * @property string|null $P2
 */
class Tblexgratia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblexgratia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ProgramRegId'], 'integer'],
            [['P1', 'P2'], 'safe'],
            [['Branch'], 'string', 'max' => 180],
            [['UserNo'], 'string', 'max' => 10],
            [['Branch', 'ProgramRegId','P1'], 'unique', 'targetAttribute' => ['Branch', 'ProgramRegId','P1']],
            [['Branch', 'ProgramRegId','P2'], 'unique', 'targetAttribute' => ['Branch', 'ProgramRegId','P2']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('app', 'ID'),
            'Branch' => Yii::t('app', 'Branch'),
            'ProgramRegId' => Yii::t('app', 'Program Reg ID'),
            'UserNo' => Yii::t('app', 'User No'),
            'P1' => Yii::t('app', 'P1'),
            'P2' => Yii::t('app', 'P2'),
        ];
    }
}
