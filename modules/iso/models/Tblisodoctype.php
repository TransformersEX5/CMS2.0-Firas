<?php

namespace app\modules\iso\models;

use Yii;

/**
 * This is the model class for table "tblisodoctype".
 *
 * @property int $IsoDocTypeId
 * @property string|null $IsoDocDescription
 * @property string|null $IsoDocRemarks
 * @property string|null $Category
 * @property string|null $TransactionDate
 */
class Tblisodoctype extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblisodoctype';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TransactionDate'], 'safe'],
            [['IsoDocDescription', 'IsoDocRemarks'], 'string', 'max' => 100],
            [['Category'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IsoDocTypeId' => 'Iso Doc Type ID',
            'IsoDocDescription' => 'Iso Doc Description',
            'IsoDocRemarks' => 'Iso Doc Remarks',
            'Category' => 'Category',
            'TransactionDate' => 'Transaction Date',
        ];
    }
}
