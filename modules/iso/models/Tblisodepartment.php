<?php

namespace app\modules\iso\models;

use Yii;

/**
 * This is the model class for table "tblisodepartment".
 *
 * @property int $IsoDepartId
 * @property string|null $IsoDepartDecc
 * @property string|null $IsoDepartRemarks
 * @property int|null $SortNo
 * @property int|null $StatusId
 * @property string|null $Category
 */
class Tblisodepartment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblisodepartment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SortNo', 'StatusId'], 'integer'],
            [['IsoDepartDecc', 'IsoDepartRemarks'], 'string', 'max' => 100],
            [['Category'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IsoDepartId' => 'Iso Depart ID',
            'IsoDepartDecc' => 'Iso Depart Decc',
            'IsoDepartRemarks' => 'Iso Depart Remarks',
            'SortNo' => 'Sort No',
            'StatusId' => 'Status ID',
            'Category' => 'Category',
        ];
    }
}
