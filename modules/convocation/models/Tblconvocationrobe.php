<?php

namespace app\modules\convocation\models;

use Yii;

/**
 * This is the model class for table "tblconvocationrobe".
 *
 * @property int $RobeId
 * @property string|null $Robesize
 * @property int|null $StatusId
 */
class Tblconvocationrobe extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblconvocationrobe';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['StatusId'], 'integer'],
            [['Robesize'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'RobeId' => 'Robe ID',
            'Robesize' => 'Robesize',
            'StatusId' => 'Status ID',
        ];
    }
}
