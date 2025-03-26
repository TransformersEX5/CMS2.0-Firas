<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auth_item".
 *
 * @property string $name
 * @property int $type
 * @property string|null $description
 * @property int|null $SystemId
 * @property string|null $rule_name
 * @property string|null $data
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property AuthAssignment[] $authAssignments
 * @property AuthItemChild[] $authItemChildren
 * @property AuthItemChild[] $authItemChildren0
 * @property AuthItem[] $children
 * @property AuthItem[] $parents
 * @property AuthRule $ruleName
 */
class AuthItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type', 'SystemId', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64],
            [['name'], 'unique'],
            [['rule_name'], 'exist', 'skipOnError' => true, 'targetClass' => AuthRule::class, 'targetAttribute' => ['rule_name' => 'name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Group'),
            'description' => Yii::t('app', 'Description'),
            'SystemId' => Yii::t('app', 'System'),
            'rule_name' => Yii::t('app', 'Rule Name'),
            'data' => Yii::t('app', 'Data'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[AuthAssignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::class, ['item_name' => 'name']);
    }

    /**
     * Gets query for [[AuthItemChildren]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItemChildren()
    {
        return $this->hasMany(AuthItemChild::class, ['parent' => 'name']);
    }

    /**
     * Gets query for [[AuthItemChildren0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItemChildren0()
    {
        return $this->hasMany(AuthItemChild::class, ['child' => 'name']);
    }

    /**
     * Gets query for [[Children]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(AuthItem::class, ['name' => 'child'])->viaTable('auth_item_child', ['parent' => 'name']);
    }

    /**
     * Gets query for [[Parents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParents()
    {
        return $this->hasMany(AuthItem::class, ['name' => 'parent'])->viaTable('auth_item_child', ['child' => 'name']);
    }

    /**
     * Gets query for [[RuleName]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRuleName()
    {
        return $this->hasOne(AuthRule::class, ['name' => 'rule_name']);
    }



    

    public function getAuthitemlist()
    {
        $condition = '';

        //$data = explode(";", $param);
        

        $condition = "";
        $txtSearch      = $_GET['txtSearch'];
       // $txtStatusId    = $_GET['txtStatusId'];
        $txtAuthTypeId   = $_GET['txtAuthTypeId'];


        $stmt = " SELECT
        auth_item.`name`,
        auth_item.type,
        auth_item.description,
        auth_item.rule_name,
        auth_item.`data`,
        auth_item.created_at,
        auth_item.updated_at,
        auth_item_type.auth_item_desc,
        tblsystem.SystemName
        FROM
        auth_item
        INNER JOIN auth_item_type ON auth_item.type = auth_item_type.auth_item_typeid
        LEFT JOIN tblsystem ON auth_item.SystemId = tblsystem.SystemId ";

        if (!empty($txtSearch)) {
            $condition .= "concat(auth_item.`name`) like '%$txtSearch%' and ";
        }

        // if (!empty($txtStatusId)) {
        //     $condition .= "tbldepartment.StatusId = $txtStatusId and ";
        // }

         if (!empty($txtAuthTypeId)) {
             $condition .= " auth_item.type  = $txtAuthTypeId and ";
         }

        if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }

        $stmt .= $condition . 'ORDER BY auth_item.type , auth_item.`name` ';

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        
        return $data;
    }
}
