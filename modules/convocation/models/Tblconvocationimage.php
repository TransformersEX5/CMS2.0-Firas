<?php

namespace app\modules\convocation\models;

use Yii;

/**
 * This is the model class for table "tblconvocationimage".
 *
 * @property int $ConvoImageId
 * @property string|null $ConvoImageName
 * @property string|null $ConvoYear
 */
class Tblconvocationimage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblconvocationimage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ConvoImageName', 'ConvoYear'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ConvoImageId' => 'Convo Image ID',
            'ConvoImageName' => 'Convo Image Name',
            'ConvoYear' => 'Convo Year',
        ];
    }
}
