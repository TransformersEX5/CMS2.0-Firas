<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblprogramregisterremarks".
 *
 * @property int $ProgRegRmkId
 * @property int $ProgramRegId
 * @property string $ProgRegRemarks
 * @property int $UserId
 * @property string $TransDate
 */
class Tblprogramregisterremarks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblprogramregisterremarks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ProgramRegId', 'ProgRegRemarks', 'UserId'], 'required'],
            [['ProgramRegId', 'UserId'], 'integer'],
            [['ProgRegRemarks'], 'string'],
            [['TransDate'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ProgRegRmkId' => Yii::t('app', 'Prog Reg Rmk ID'),
            'ProgramRegId' => Yii::t('app', 'Program Reg ID'),
            'ProgRegRemarks' => Yii::t('app', 'Prog Reg Remarks'),
            'UserId' => Yii::t('app', 'User ID'),
            'TransDate' => Yii::t('app', 'Trans Date'),
        ];
    }
}
