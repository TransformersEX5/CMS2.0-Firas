<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblsystem".
 *
 * @property int $SystemId
 * @property string $SystemName
 * @property string $SystemDescription
 * @property string|null $URL
 * @property string $IpCheck
 * @property int $Public 2=public
 * @property int $StatusId
 * @property string|null $SystemMsg
 * @property int $UserId
 * @property string $TransactionDate
 */
class Tblsystem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblsystem';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SystemName', 'SystemDescription', 'UserId'], 'required'],
            [['Public', 'StatusId', 'UserId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['SystemName'], 'string', 'max' => 100],
            [['SystemDescription'], 'string', 'max' => 200],
            [['URL'], 'string', 'max' => 300],
            [['IpCheck'], 'string', 'max' => 1],
            [['SystemMsg'], 'string', 'max' => 400],
            [['SystemName'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SystemId' => Yii::t('app', 'System ID'),
            'SystemName' => Yii::t('app', 'System Name'),
            'SystemDescription' => Yii::t('app', 'System Description'),
            'URL' => Yii::t('app', 'Url'),
            'IpCheck' => Yii::t('app', 'Ip Check'),
            'Public' => Yii::t('app', 'Public'),
            'StatusId' => Yii::t('app', 'Status ID'),
            'SystemMsg' => Yii::t('app', 'System Msg'),
            'UserId' => Yii::t('app', 'User ID'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
        ];
    }



    public function getModuleList()
    {
        $condition = '';

        $UserId=Yii::$app->user->identity->UserId ??0;
    
        $stmt = " SELECT
        auth_item.SystemId,
        tblsystem.SystemIcon,
        tblsystem.SystemName,
        tblsystem.SystemQ,
        auth_assignment.user_id
        FROM
        auth_item
        INNER JOIN auth_item_child ON auth_item.`name` = auth_item_child.child
        INNER JOIN tblsystem ON auth_item.SystemId = tblsystem.SystemId
        INNER JOIN auth_assignment ON auth_item_child.parent = auth_assignment.item_name 
        where 
        auth_assignment.user_id = $UserId and auth_item.SystemId != 50 
        GROUP BY auth_item.SystemId  
        UNION ALL
        SELECT
        tblsystem.SystemId,
           tblsystem.SystemIcon,
        tblsystem.SystemName,
        tblsystem.SystemQ ,
        0 as UserId
        FROM
                tblsystem
        where tblsystem.SystemId = 60 
        ORDER BY FIELD(SystemName, 'Staff Portal') desc ";

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }


    public function getDatinpropertyuser()
    {
        $stmt = "SELECT
        auth_item.SystemId,
        tblsystem.SystemIcon,
        tblsystem.SystemName,
        tblsystem.SystemQ,
        auth_assignment.user_id
        FROM
        auth_item
        INNER JOIN auth_item_child ON auth_item.`name` = auth_item_child.child
        INNER JOIN tblsystem ON auth_item.SystemId = tblsystem.SystemId
        INNER JOIN auth_assignment ON auth_item_child.parent = auth_assignment.item_name
		WHERE auth_assignment.user_id = ".Yii::$app->user->identity->UserId." AND auth_item.SystemId = 50
		GROUP BY auth_item.SystemId  ORDER BY tblsystem.SystemQ, auth_item.SystemId";

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }
}
