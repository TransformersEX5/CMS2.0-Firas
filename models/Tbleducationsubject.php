<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbleducationsubject".
 *
 * @property int $EduSubjId
 * @property string $EduSubject
 * @property int $UserId
 */
class Tbleducationsubject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbleducationsubject';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['EduSubject', 'UserId'], 'required'],
            [['UserId'], 'integer'],
            [['EduSubject'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'EduSubjId' => Yii::t('app', 'Edu Subj ID'),
            'EduSubject' => Yii::t('app', 'Edu Subject'),
            'UserId' => Yii::t('app', 'User ID'),
        ];
    }
}
