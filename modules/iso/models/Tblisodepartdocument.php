<?php

namespace app\modules\iso\models;

use Yii;

/**
 * This is the model class for table "tblisodepartdocument".
 *
 * @property int $IsodepartdocId
 * @property int $IsoDepartId
 * @property int $IsoDocTypeId
 * @property int|null $FileCategoryId 1= Ori ; 2 = Copy
 * @property string $Description
 * @property string|null $log_filename
 * @property int|null $log_size
 * @property string|null $log_ip
 * @property string $log_date
 * @property string $link
 * @property int $FileStatusId
 * @property int $UserId
 */
class Tblisodepartdocument extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblisodepartdocument';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IsoDepartId', 'IsoDocTypeId', 'UserId'], 'required'],
            [['IsoDepartId', 'IsoDocTypeId', 'FileCategoryId', 'log_size', 'FileStatusId', 'UserId'], 'integer'],
            [['log_date'], 'safe'],
            [['Description'], 'string', 'max' => 100],
            [['log_filename'], 'string', 'max' => 128],
            [['log_ip'], 'string', 'max' => 24],
            [['link'], 'string', 'max' => 125],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IsodepartdocId' => 'Isodepartdoc ID',
            'IsoDepartId' => 'Iso Depart ID',
            'IsoDocTypeId' => 'Iso Doc Type ID',
            'FileCategoryId' => 'File Category ID',
            'Description' => 'Description',
            'log_filename' => 'Log Filename',
            'log_size' => 'Log Size',
            'log_ip' => 'Log Ip',
            'log_date' => 'Log Date',
            'link' => 'Link',
            'FileStatusId' => 'File Status ID',
            'UserId' => 'User ID',
        ];
    }
}
