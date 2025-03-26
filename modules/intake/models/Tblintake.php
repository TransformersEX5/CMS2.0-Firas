<?php

namespace app\modules\intake\models;

use Yii;

/**
 * This is the model class for table "tblintake".
 *
 * @property int $IntakeId
 * @property int $IntakeYrMo
 * @property int $IntakeStatus
 * @property int $IntakeTypeId
 * @property int $MajorIntakeId
 * @property string $TransactionDate
 * @property int|null $UserId
 */
class Tblintake extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblintake';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IntakeYrMo', 'IntakeStatus', 'IntakeTypeId', 'MajorIntakeId', 'TransactionDate'], 'required'],
            [['IntakeYrMo', 'IntakeStatus', 'IntakeTypeId', 'MajorIntakeId', 'UserId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['IntakeYrMo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IntakeId' => Yii::t('app', 'Intake ID'),
            'IntakeYrMo' => Yii::t('app', 'Intake Yr Mo'),
            'IntakeStatus' => Yii::t('app', 'Intake Status'),
            'IntakeTypeId' => Yii::t('app', 'Intake Type ID'),
            'MajorIntakeId' => Yii::t('app', 'Major Intake ID'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
            'UserId' => Yii::t('app', 'User ID'),
        ];
    }


    public function getIntakelist()
    {
        $condition = '';

        //$data = explode(";", $param);

        $condition = "";
        $txtSearch = $_GET['txtSearch'];
        $txtStatusId = $_GET['txtStatusId'];
      //  $txtProgramTypeId = $_GET['txtProgramTypeId'];


        $stmt = " SELECT
        tblintake.IntakeId,
        tblintake.IntakeYrMo,
        tblintake.IntakeStatus,
        tblintake.IntakeTypeId,
        tblintake.MajorIntakeId,
        tblintake.TransactionDate,
        tblintake.UserId
        from tblintake ";

        if (!empty($txtSearch)) {
            $condition .= "concat(IntakeStatus,IntakeYrMo) like '%$txtSearch%' and ";
        }

        if (!empty($txtStatusId)) {
            $condition .= "tblintake.IntakeStatus,
            = $txtStatusId and ";
        }

        // if (!empty($txtProgramTypeId)) {
        //     $condition .= "  tblprogram.ProgramType  = $txtProgramTypeId and ";
        // }

        if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }

        $stmt .= $condition . ' ORDER BY tblintake.IntakeYrMo desc ';

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }


}
