<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblworkingstatus".
 *
 * @property int $WorkingStatusId
 * @property string $WorkingStatusDesc
 * @property string|null $WorkingRemarks
 * @property int $UserId
 * @property string $TransactionDate
 * @property int|null $ShowId
 */
class Tblworkingstatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblworkingstatus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['WorkingStatusDesc', 'UserId'], 'required'],
            [['UserId', 'ShowId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['WorkingStatusDesc'], 'string', 'max' => 30],
            [['WorkingRemarks'], 'string', 'max' => 255],
            [['WorkingStatusDesc'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'WorkingStatusId' => Yii::t('app', 'Working Status ID'),
            'WorkingStatusDesc' => Yii::t('app', 'Working Status Desc'),
            'WorkingRemarks' => Yii::t('app', 'Working Remarks'),
            'UserId' => Yii::t('app', 'User ID'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
            'ShowId' => Yii::t('app', 'Show ID'),
        ];
    }


    public function getWorkingstatuslist()
    {
        $condition = '';

        //$data = explode(";", $param);
        

        $condition = "";
        // $txtSearch      = $_GET['txtSearch'];
        // $txtStatusId    = $_GET['txtStatusId'];
        // $txtDeptCatId   = $_GET['txtDeptCatId'];


        $stmt = " SELECT
        tblworkingstatus.WorkingStatusId,
        tblworkingstatus.WorkingStatusDesc,
        
        tblworkingstatus.WorkingRemarks,
        tblworkingstatus.UserId,
        tblworkingstatus.TransactionDate,
        tblworkingstatus.ShowId
        from tblworkingstatus ";

        // if (!empty($txtSearch)) {
        //     $condition .= "concat(tbldepartment.DepartmentDesc) like '%$txtSearch%' and ";
        // }

        // if (!empty($txtStatusId)) {
        //     $condition .= "tbldepartment.StatusId = $txtStatusId and ";
        // }

        //  if (!empty($txtDeptCatId)) {
        //      $condition .= "  tbldepartment.DeptCatId  = $txtDeptCatId and ";
        //  }

        // if ($condition != '') {
        //     $condition = ' where ' . substr($condition, 0, -4);
        // }

        // $stmt .= $condition . ' ORDER BY   tbldepartment.DepartmentDesc ';

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }
}

