<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbltrainingattandance".
 *
 * @property int $TrainingAttanId
 * @property int $TrainingDurationId
 * @property int|null $UserId
 * @property int|null $AttandId 1=Attand;2=Not-Attnnd;3=Not-AttandWithResone
 * @property string|null $Remarks
 * @property string|null $TransactionDate
 */
class Tbltrainingattandance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbltrainingattandance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TrainingDurationId'], 'required'],
            [['TrainingDurationId', 'UserId', 'AttandId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['Remarks'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TrainingAttanId' => Yii::t('app', 'Training Attan ID'),
            'TrainingDurationId' => Yii::t('app', 'Training Duration ID'),
            'UserId' => Yii::t('app', 'User ID'),
            'AttandId' => Yii::t('app', 'Attand ID'),
            'Remarks' => Yii::t('app', 'Remarks'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
        ];
    }

    

    public function getTrainingAttandanceList()
    {
        // $condition = '';

        //$data = explode(";", $param);
 
        $txtTrainingDurationId = $_GET['TrainingDurationId'];

        $stmt = " SELECT
        tbltrainingattandance.TrainingAttanId,
        tbltrainingattandance.TrainingDurationId,
        tbltrainingattandance.TrainingId,
        tbltrainingattandance.UserId,
        tbltrainingattandance.AttandId,
         
        tbltrainingattandance.Remarks,
        tbluser.UserNo,
        tbluser.FullName,
		CONCAT((CASE WHEN qeval.TrainingEvalMarksId != '' THEN '1' ELSE '2' END), ',', tbluser.UserId, ',', TrainingId) AS Eval
        FROM
        tbltrainingattandance
        INNER JOIN tbluser ON tbltrainingattandance.UserId = tbluser.UserId
		LEFT JOIN 
		(
		SELECT TrainingEvalMarksId, tbltrainingevalmarks.UserId
		FROM tbltrainingevalmarks
		INNER JOIN tbltrainingattandance ON tbltrainingattandance.TrainingId = tbltrainingevalmarks.TrainingId
		WHERE TrainingDurationId = $txtTrainingDurationId
		)qeval ON qeval.UserId = tbltrainingattandance.UserId
        WHERE TrainingDurationId = $txtTrainingDurationId
		GROUP BY UserId ";

        // $condition = "tbltrainingduration.TrainingId = $txtTrainingId and ";




        // if ($condition != '') {
        //     $condition = ' where ' . substr($condition, 0, -4);
        // }

        // $stmt .= $condition ;

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }


    
  



}
