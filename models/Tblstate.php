<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblstate".
 *
 * @property int $StateId
 * @property string $StateName
 * @property string $Ifms_Code
 * @property int|null $KptConvo_State
 * @property string $TransactionDate
 * @property int|null $UserId
 */
class Tblstate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblstate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['StateName', 'Ifms_Code', 'TransactionDate'], 'required'],
            [['KptConvo_State', 'UserId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['StateName', 'Ifms_Code'], 'string', 'max' => 50],
            [['StateName'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'StateId' => Yii::t('app', 'State ID'),
            'StateName' => Yii::t('app', 'State Name'),
            'Ifms_Code' => Yii::t('app', 'Ifms Code'),
            'KptConvo_State' => Yii::t('app', 'Kpt Convo State'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
            'UserId' => Yii::t('app', 'User ID'),
        ];
    }
}
