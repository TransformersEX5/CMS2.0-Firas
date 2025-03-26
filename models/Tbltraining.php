<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbltraining".
 *
 * @property int $TrainingId
 * @property string $TrainingTitle
 * @property string $TrainingObjective
 * @property string|null $TrainingVenue
 * @property int|null $TrainerId
 * @property string|null $TrainerName
 * @property string|null $TrainerHpNo
 * @property int $RequestId UserId
 * @property string|null $Remarks
 * @property int|null $TrainingCategoryId Soft Skill/technical/safty/leadership
 * @property int|null $TrainingClaimId HRDF Claim - Yes/No
 * @property int|null $TrainingVenueId In-house / Public
 * @property int|null $TrainingGroupId Academic/Non academic
 * @property string|null $TransactionDate
 */
class Tbltraining extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbltraining';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TrainingTitle', 'TrainingObjective', 'RequestId'], 'required'],
            [['TrainingObjective'], 'string'],
            [['TrainerId', 'RequestId', 'TrainingCategoryId', 'TrainingClaimId', 'TrainingVenueId', 'TrainingGroupId'], 'integer'],
            [['TrainingCost'], 'number'],
            [['TransactionDate'], 'safe'],
            [['TrainingTitle', 'TrainingVenue', 'Remarks'], 'string', 'max' => 300],
            [['TrainerName', 'TrainerHpNo'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TrainingId' => Yii::t('app', 'Training ID'),
            'TrainingTitle' => Yii::t('app', 'Training Title'),
            'TrainingObjective' => Yii::t('app', 'Training Objective'),
            'TrainingVenue' => Yii::t('app', 'Training Venue'),
            'TrainerId' => Yii::t('app', 'Trainer ID'),
            'TrainerName' => Yii::t('app', 'Trainer Name'),
            'TrainerHpNo' => Yii::t('app', 'Trainer Hp No'),
            'TrainingCost' => Yii::t('app', 'Training Cost (RM)'),
            'RequestId' => Yii::t('app', 'Request ID'),
            'Remarks' => Yii::t('app', 'Remarks'),
            'TrainingCategoryId' => Yii::t('app', 'Training Category ID'),
            'TrainingClaimId' => Yii::t('app', 'Training Claim ID'),
            'TrainingVenueId' => Yii::t('app', 'Training Venue ID'),
            'TrainingGroupId' => Yii::t('app', 'Training Group ID'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
        ];
    }




    public function getTrainingtimetablelist()
    {
        $condition = '';

        //$data = explode(";", $param);
 

        $condition = "";

        $txtTrainingId = $_GET['TrainingId'];

  

        $stmt = " SELECT
        tbltrainingduration.TrainingDurationId,
        tbltrainingduration.TrainingId,
        date_format(tbltrainingduration.TrainingDate,'%d-%m-%Y') as TrainingDate,
        tbltrainingduration.TrainingTimeStart,
        tbltrainingduration.TrainingTimeEnd,
        tbltrainingduration.TraningTotHours,
        tbltrainingduration.Remarks,
        tbltrainingduration.TransactionDate,
        tbltrainingduration.UserId
        from tbltrainingduration ";

        $condition = "tbltrainingduration.TrainingId = $txtTrainingId and ";




        if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }

        $stmt .= $condition . ' ORDER BY tbltrainingduration.TrainingDate';

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }





    public function getTraininglist()
    {
        $condition = '';

        //$data = explode(";", $param);


        $condition = "";
        $txtSearch = $_GET['txtSearch'];
        $txtStatusId = $_GET['txtStatusId'];
        $txtTrainingCategoryId = $_GET['txtTrainingCategoryId'];


        $stmt = " SELECT
        tbltraining.TrainingId,
        tbltraining.TrainingTitle,
        tbltraining.TrainingObjective,
        tbltraining.TrainingVenue,
        tbltraining.TrainerId,
        tbltraining.RequestId,
        tbltraining.Remarks,
        tbltraining.TrainingCategoryId,
        tbltraining.TrainingClaimId,
        tbltraining.TrainingVenueId,
        tbltraining.TrainingGroupId,
        QTraningDuration.TrainingStart,
        QTraningDuration.TrainingEnd,
        QTraningDuration.TotHours,
        QTraningDuration.TotDays,
        tbluser.FullName,
        tbltrainingcategory.TrainingCategory,
        QTrainingStatus.TrainingStatus ,
        QTrainingStatus.TrainingStatusId,
		COALESCE(QTotAttan.TotStaff,0) as TotStaff
        FROM
        tbltraining
        INNER JOIN tbluser ON tbltraining.RequestId = tbluser.UserId
        INNER JOIN tbltrainingcategory ON tbltraining.TrainingCategoryId = tbltrainingcategory.TrainingCategoryId
        
        LEFT JOIN (SELECT
        tbltrainingduration.TrainingDurationId,
        tbltrainingduration.TrainingId,
        min(tbltrainingduration.TrainingDate) as TrainingStart,
        max(tbltrainingduration.TrainingDate) as TrainingEnd,
        Sum(tbltrainingduration.TraningTotHours) as TotHours,
        count(tbltrainingduration.TrainingDate) as TotDays
        from tbltrainingduration
        GROUP BY tbltrainingduration.TrainingId) AS QTraningDuration ON QTraningDuration.TrainingId = tbltraining.TrainingId
  
        
        Left join (SELECT
        tbltrainingstatushistory.TrainingId,
        tbltrainingstatushistory.Remarks,
        tbltrainingstatushistory.TransactionDate,
        tbltrainingstatus.TrainingStatus,
        tbltrainingstatushistory.TrainingStatusId
        FROM
        tbltrainingstatushistory
        INNER JOIN tbltrainingstatus ON tbltrainingstatushistory.TrainingStatusId = tbltrainingstatus.TrainingStatusId
        where tbltrainingstatushistory.CurrentStatusId = 1
        )QTrainingStatus on QTrainingStatus.TrainingId = tbltraining.TrainingId

        Left join (SELECT
        tbltrainingattandance.TrainingId,
        count(DISTINCT tbltrainingattandance.UserId) as TotStaff
        from tbltrainingattandance
        GROUP BY tbltrainingattandance.TrainingId)QTotAttan on  QTotAttan.TrainingId = tbltraining.TrainingId ";



        if (!empty($txtSearch)) {
            $condition .= "concat(tbltraining.TrainingTitle,QTraningDuration.TrainingStart) like '%$txtSearch%' and ";
        }

        if (!empty($txtStatusId)) {
            $condition .= " QTrainingStatus.TrainingStatusId = $txtStatusId and ";
        }

        if (!empty($txtTrainingCategoryId)) {
            $condition .= " tbltraining.TrainingCategoryId  = $txtTrainingCategoryId and ";
        }

        if (empty($txtSearch) && empty($txtStatusId) && empty($txtTrainingCategoryId)) {

            $condition .= " QTrainingStatus.TrainingStatusId = 1 and ";
        }


        if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }

        $stmt .= $condition . ' Group By tbltraining.TrainingId ORDER BY  tbltraining.TrainingTitle ';

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }
}