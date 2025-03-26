<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblstudentdocument".
 *
 * @property int $StudDocId
 * @property int|null $StudentId
 * @property int|null $ApplicationId
 * @property string|null $StudNRICPassportNo
 * @property int|null $DocId
 * @property string $Description
 * @property int|null $StatusId 1-Active
 * @property string $TransactionDate
 * @property int $UserId
 * @property int|null $Downloads
 * @property int|null $IcmsId
 */
class Tblstudentdocument extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblstudentdocument';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['StudentId', 'ApplicationId', 'DocId', 'StatusId', 'UserId', 'Downloads', 'IcmsId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['UserId'], 'required'],
            [['StudNRICPassportNo'], 'string', 'max' => 15],
            [['Description'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'StudDocId' => Yii::t('app', 'Stud Doc ID'),
            'StudentId' => Yii::t('app', 'Student ID'),
            'ApplicationId' => Yii::t('app', 'Application ID'),
            'StudNRICPassportNo' => Yii::t('app', 'Stud Nric Passport No'),
            'DocId' => Yii::t('app', 'Doc ID'),
            'Description' => Yii::t('app', 'Description'),
            'StatusId' => Yii::t('app', 'Status ID'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
            'UserId' => Yii::t('app', 'User ID'),
            'Downloads' => Yii::t('app', 'Downloads'),
            'IcmsId' => Yii::t('app', 'Icms ID'),
        ];
    }
}
