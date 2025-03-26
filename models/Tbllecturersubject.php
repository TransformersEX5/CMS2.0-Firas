<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbllecturersubject".
 *
 * @property int $SubjLectId
 * @property int $SubjectId
 * @property int $LecturerId
 * @property string $TransactionDate
 * @property int $UserId
 */
class Tbllecturersubject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbllecturersubject';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SubjectId', 'LecturerId', 'UserId'], 'required'],
            [['SubjectId', 'LecturerId', 'UserId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['SubjectId', 'LecturerId'], 'unique', 'targetAttribute' => ['SubjectId', 'LecturerId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SubjLectId' => 'Subj Lect ID',
            'SubjectId' => 'Subject ID',
            'LecturerId' => 'Lecturer ID',
            'TransactionDate' => 'Transaction Date',
            'UserId' => 'User ID',
        ];
    }
}
