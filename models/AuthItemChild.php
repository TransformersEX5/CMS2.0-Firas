<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auth_item_child".
 *
 * @property string $parent
 * @property string $child
 *
 * @property AuthItem $child0
 * @property AuthItem $parent0
 */
class AuthItemChild extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_item_child';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent', 'child'], 'required'],
            [['parent', 'child'], 'string', 'max' => 64],
            [['parent', 'child'], 'unique', 'targetAttribute' => ['parent', 'child']],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItem::class, 'targetAttribute' => ['parent' => 'name']],
            [['child'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItem::class, 'targetAttribute' => ['child' => 'name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'parent' => Yii::t('app', 'User Role '),
            'child' => Yii::t('app', 'Role Permission Access'),
        ];
    }

    /**
     * Gets query for [[Child0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChild0()
    {
        return $this->hasOne(AuthItem::class, ['name' => 'child']);
    }

    /**
     * Gets query for [[Parent0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(AuthItem::class, ['name' => 'parent']);
    }


    

    public function getAuthitemchildlist()
    {
        $condition = '';

        //$data = explode(";", $param);
        

        $condition = "";
        $txtSearch      = $_GET['txtSearch'];
       // $txtStatusId    = $_GET['txtStatusId'];
       // $txtDeptCatId   = $_GET['txtDeptCatId'];


        $stmt = " SELECT
        auth_item_child.parent,
        auth_item_child.child
        from auth_item_child ";

        if (!empty($txtSearch)) {
            $condition .= "concat(auth_item_child.parent,auth_item_child.child) like '%$txtSearch%' and ";
        }

        // if (!empty($txtStatusId)) {
        //     $condition .= "tbldepartment.StatusId = $txtStatusId and ";
        // }

        //  if (!empty($txtDeptCatId)) {
        //      $condition .= "  tbldepartment.DeptCatId  = $txtDeptCatId and ";
        //  }

        if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }

        $stmt .= $condition . ' ORDER BY   auth_item_child.parent ';

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }
}