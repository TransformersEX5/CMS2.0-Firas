<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auth_item_type".
 *
 * @property int $auth_item_typeid
 * @property string $auth_item_desc 1- TYPE_ROLE ; 2-ACTION/PERMISSION
 */
class AuthItemType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_item_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['auth_item_typeid'], 'required'],
            [['auth_item_typeid'], 'integer'],
            [['auth_item_desc'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'auth_item_typeid' => Yii::t('app', 'Auth Item Typeid'),
            'auth_item_desc' => Yii::t('app', 'Auth Item Desc'),
        ];
    }
}
