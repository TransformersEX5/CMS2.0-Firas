<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblrmccluster".
 *
 * @property int $RMCClusterId
 * @property string $RMCCluster
 * @property int $UserId
 * @property int $StatusId
 * @property string $TransactionDate
 */
class Tblrmccluster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblrmccluster';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['RMCCluster', 'UserId'], 'required'],
            [['UserId', 'StatusId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['RMCCluster'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'RMCClusterId' => Yii::t('app', 'Rmc Cluster ID'),
            'RMCCluster' => Yii::t('app', 'Rmc Cluster'),
            'UserId' => Yii::t('app', 'User ID'),
            'StatusId' => Yii::t('app', 'Status ID'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
        ];
    }
}
