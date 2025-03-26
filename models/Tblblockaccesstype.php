<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblblockaccesstype".
 *
 * @property int $BlockAcessId
 * @property string $BlockAccessDesc
 * @property int $StatusId
 */
class Tblblockaccesstype extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblblockaccesstype';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['BlockAccessDesc'], 'required'],
            [['StatusId'], 'integer'],
            [['BlockAccessDesc'], 'string', 'max' => 35],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'BlockAcessId' => Yii::t('app', 'Block Acess ID'),
            'BlockAccessDesc' => Yii::t('app', 'Block Access Desc'),
            'StatusId' => Yii::t('app', 'Status ID'),
        ];
    }
}
