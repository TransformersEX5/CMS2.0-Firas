<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbldebtgroup".
 *
 * @property int $DebtGroupId
 * @property int $UserId
 * @property string $DebtGroupName
 * @property string $TransactionDate
 */
class Tbldebtgroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbldebtgroup';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['DebtGroupName','UserId'], 'required'],
            [['UserId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['DebtGroupName'], 'string', 'max' => 25],
            [['DebtGroupName','UserId' ], 'unique', 'targetAttribute' => [ 'DebtGroupName','UserId'], 'message' => 'Debt Group Name has already been taken'],
            ['DebtGroupName', 'customValidationRule'],
        ];
    }

    public function customValidationRule($attribute)
    {        
        $maxRecords = 8;
        $recordCount = Tbldebtgroup::find()->where('UserId='.Yii::$app->user->identity->UserId)->count();
        if ($recordCount >=$maxRecords) {
            $this->addError($attribute, 'You cannot create more than ' . $maxRecords . ' group.');
        }
    }




    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'DebtGroupId' => Yii::t('app', 'Debt Group ID'),
            'UserId' => Yii::t('app', 'User ID'),
            'DebtGroupName' => Yii::t('app', 'Debt Group Name'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
        ];
    }


}
