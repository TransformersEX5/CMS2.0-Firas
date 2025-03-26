<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblcareerstatus".
 *
 * @property int $CareerStatusId
 * @property string|null $CareerStatusDesc
 * @property int|null $CareerStatusCategory
 */
class Tblcareerstatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblcareerstatus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CareerStatusCategory'], 'integer'],
            [['CareerStatusDesc'], 'string', 'max' => 35],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CareerStatusId' => 'Career Status ID',
            'CareerStatusDesc' => 'Career Status Desc',
            'CareerStatusCategory' => 'Career Status Category',
        ];
    }
}
