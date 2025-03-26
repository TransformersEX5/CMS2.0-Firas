<?php

namespace app\modules\datin\models;

use Yii;

/**
 * This is the model class for table "tbldatinpropertytype".
 *
 * @property int $TypeId
 * @property string $TypeName
 * @property int $UserId
 * @property string $TransactionDate
 */
class Tbldatinpropertytype extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbldatinpropertytype';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TypeName', 'UserId'], 'required'],
            [['UserId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['TypeName'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TypeId' => 'Type ID',
            'TypeName' => 'Type Name',
            'UserId' => 'User ID',
            'TransactionDate' => 'Transaction Date',
        ];
    }
}
