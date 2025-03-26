<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auth_assignment".
 *
 * @property int $authassigid
 * @property string $item_name
 * @property int $user_id
 * @property string $item_userid
 * @property int|null $created_at
 *
 * @property AuthItem $itemName
 */
class Authassignment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id', 'item_userid'], 'required'],
            [['user_id', 'created_at'], 'integer'],
            [['item_name', 'item_userid'], 'string', 'max' => 64],
            [['item_name', 'user_id'], 'unique', 'targetAttribute' => ['item_name', 'user_id']],
            [['item_userid'], 'unique'],
            [['item_name'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItem::class, 'targetAttribute' => ['item_name' => 'name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'assignmentid' => Yii::t('app', 'assignmentid'),
            'item_name' => Yii::t('app', 'Item Name'),
            'user_id' => Yii::t('app', 'User ID'),
            'item_userid' => Yii::t('app', 'Item Userid'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[ItemName]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItemName()
    {
        return $this->hasOne(AuthItem::class, ['name' => 'item_name']);
    }

    

    public function getAssingmentlist()
    {
        $condition = "";
        
        $txtuserId = $_GET['txtuserId'];
        
        $stmt = " SELECT 
        auth_assignment.assignmentid,
        auth_assignment.item_name,
        auth_assignment.user_id,
        auth_assignment.created_at
        from auth_assignment  ";
     

        if (!empty($txtuserId)) {
            $condition .= "  auth_assignment.user_id = $txtuserId and ";
        }

        
        if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }

        $stmt .= $condition . ' ORDER BY auth_assignment.item_name ';

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }

}
