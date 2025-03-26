<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbldocumenttype".
 *
 * @property int $DocTypeId
 * @property string|null $DocType
 * @property string|null $DocDesc
 * @property string|null $DocExtension
 * @property int|null $DocumentCategoryId
 * @property string|null $DepartAllowId Depart to Allow view
 * @property int|null $StatusId
 */
class Tbldocumenttype extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbldocumenttype';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['DocumentCategoryId', 'StatusId'], 'integer'],
            [['DocType'], 'string', 'max' => 100],
            [['DocDesc'], 'string', 'max' => 150],
            [['DocExtension'], 'string', 'max' => 50],
            [['DepartAllowId'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'DocTypeId' => Yii::t('app', 'Doc Type ID'),
            'DocType' => Yii::t('app', 'Doc Type'),
            'DocDesc' => Yii::t('app', 'Doc Desc'),
            'DocExtension' => Yii::t('app', 'Doc Extension'),
            'DocumentCategoryId' => Yii::t('app', 'Document Category ID'),
            'DepartAllowId' => Yii::t('app', 'Depart Allow ID'),
            'StatusId' => Yii::t('app', 'Status ID'),
        ];
    }
}
