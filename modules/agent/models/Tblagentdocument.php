<?php

namespace app\modules\agent\models;

use Yii;

/**
 * This is the model class for table "tblagentdocument".
 *
 * @property int $AgentDocId
 * @property string $AgentDocName
 * @property int $UserId
 * @property string $TransactionDate
 */
class Tblagentdocument extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblagentdocument';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['AgentDocName', 'UserId'], 'required'],
            [['UserId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['AgentDocName'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AgentDocId' => 'Agent Doc ID',
            'AgentDocName' => 'Agent Doc Name',
            'UserId' => 'User ID',
            'TransactionDate' => 'Transaction Date',
        ];
    }
}
