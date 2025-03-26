<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblstudeducation".
 *
 * @property int $StudEducId
 * @property int $ApplicationId
 * @property int $ExamTypeId
 * @property string $ExamName
 * @property string $ExamYear
 * @property string $ExamSchool
 * @property string|null $SchoolAddress
 * @property int $SchoolStateId
 * @property string $ExamResult
 * @property string $ExamRemarks
 * @property string|null $DateCert date on certificated
 * @property string|null $TransactionDate
 */
class Tblstudeducation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblstudeducation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ApplicationId', 'ExamTypeId', 'ExamName', 'ExamYear', 'ExamSchool', 'SchoolStateId', 'ExamResult', 'ExamRemarks'], 'required'],
            [['ApplicationId', 'ExamTypeId', 'SchoolStateId'], 'integer'],
            [['ExamRemarks'], 'string'],
            [['DateCert', 'TransactionDate'], 'safe'],
            [['ExamName'], 'string', 'max' => 100],
            [['ExamYear'], 'string', 'max' => 4],
            [['ExamSchool'], 'string', 'max' => 250],
            [['SchoolAddress'], 'string', 'max' => 150],
            [['ExamResult'], 'string', 'max' => 10],
            [['ApplicationId', 'ExamTypeId', 'ExamYear'], 'unique', 'targetAttribute' => ['ApplicationId', 'ExamTypeId', 'ExamYear']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'StudEducId' => Yii::t('app', 'Stud Educ ID'),
            'ApplicationId' => Yii::t('app', 'Application ID'),
            'ExamTypeId' => Yii::t('app', 'Code'),
            'ExamName' => Yii::t('app', 'Name'),
            'ExamYear' => Yii::t('app', 'Year Obtained'),
            'ExamSchool' => Yii::t('app', 'School/Institution Name'),
            'SchoolAddress' => Yii::t('app', 'School/Institution Address'),
            'SchoolStateId' => Yii::t('app', 'State'),
            'ExamResult' => Yii::t('app', 'Result/Grade'),
            'ExamRemarks' => Yii::t('app', 'Remarks'),
            'DateCert' => Yii::t('app', 'Date Received'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
        ];
    }
}
