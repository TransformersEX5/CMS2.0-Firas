<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbltrainingpaticipant".
 *
 * @property int $ParticipantId
 * @property int|null $TrainingId
 * @property int|null $UserId
 * @property string|null $TransactionDate
 */
class Tbltrainingpaticipant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbltrainingpaticipant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TrainingId', 'UserId'], 'integer'],
            [['TransactionDate'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ParticipantId' => Yii::t('app', 'Participant ID'),
            'TrainingId' => Yii::t('app', 'Training ID'),
            'UserId' => Yii::t('app', 'User ID'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
        ];
    }

    

    public function getTrainingstafflist()
    {
        $condition = '';
        $txtTrainingId = $_GET['txtTrainingId'];

        $stmt = " SELECT
        tbluser.UserId,
        tbluser.UserNo,
        trim(tbluser.FullName) AS FullName,
        tbluser.StatusId
        FROM
        tbluser
        INNER JOIN tbldepartment ON tbluser.DepartmentId = tbldepartment.DepartmentId
        INNER JOIN tbldepartmentcategory ON tbldepartment.DeptCatId = tbldepartmentcategory.DeptCatId
        where tbldepartment.DeptCatId in(1,2) and tbluser.UserId not in(33,226,198,34,35)
        and tbluser.FullName not like '%-TBA%'
        and tbluser.StatusId =1  and tbluser.userid not in(SELECT tbltrainingpaticipant.userid FROM tbltrainingpaticipant 
        where  tbltrainingpaticipant.TrainingId = $txtTrainingId ) ORDER BY trim(tbluser.FullName)  ";


        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }





    
    public function getTrainingparticipantlist()
    {
        $condition = '';
        $txtTrainingId = $_GET['txtTrainingId'];

        $stmt = " SELECT
        tbltrainingpaticipant.ParticipantId,
        tbltrainingpaticipant.TrainingId,
        tbltrainingpaticipant.UserId,
concat(tbltrainingpaticipant.ParticipantId,';',
        tbltrainingpaticipant.TrainingId,';',
        tbltrainingpaticipant.UserId) as ParticipantId2,

        tbltrainingpaticipant.TransactionDate,
        tbluser.UserNo,
        tbluser.FullName
        FROM
        tbltrainingpaticipant
        INNER JOIN tbluser ON tbltrainingpaticipant.UserId = tbluser.UserId  
        WHERE tbltrainingpaticipant.TrainingId = $txtTrainingId ORDER BY trim(tbluser.FullName) ";



        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }

}