<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbldepartment".
 *
 * @property int $DepartmentId
 * @property int $DeptCatId
 * @property string $DepartmentDesc
 * @property int $StatusId
 * @property int|null $HODUserId
 * @property int $UserId
 * @property string $TransactionDate
 * @property int|null $ShowId
 * @property string|null $Department_iso
 */
class Tbldepartment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbldepartment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['DeptCatId', 'StatusId', 'HODUserId', 'UserId', 'ShowId'], 'integer'],
            [['DepartmentDesc', 'StatusId', 'UserId','DeptCatId'], 'required'],
            [['TransactionDate'], 'safe'],
            [['DepartmentDesc', 'Department_iso'], 'string', 'max' => 100],
            [['DepartmentDesc','Department_iso'], 'unique'],
            [['DepartmentDesc','Department_iso'], 'trim'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'DepartmentId' => Yii::t('app', 'Department ID'),
            'DeptCatId' => Yii::t('app', 'Category'),
            'DepartmentDesc' => Yii::t('app', 'Department Name'),
            'StatusId' => Yii::t('app', 'Status'),
            'HODUserId' => Yii::t('app', 'Hod User'),
            'UserId' => Yii::t('app', 'User ID'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
            'ShowId' => Yii::t('app', 'Show ID'),
            'Department_iso' => Yii::t('app', 'Department Code'),
        ];
    }
    

    public function getDepartmentlist()
    {
        $condition = '';

        //$data = explode(";", $param);
        

        $condition = "";
        $txtSearch      = $_GET['txtSearch'];
        $txtStatusId    = $_GET['txtStatusId'];
        $txtDeptCatId   = $_GET['txtDeptCatId'];


        $stmt = " SELECT
        tbldepartment.DepartmentId,
        tbldepartment.DeptCatId,
        tbldepartment.DepartmentDesc,
        tbldepartment.HODUserId,
        tbldepartment.UserId,
        tbldepartment.TransactionDate,
        tbldepartment.ShowId,
        tbldepartment.Department_iso,
        tblstatusai.`Status`,
        tbldepartment.StatusId,
        tbldepartmentcategory.DeptCatDesc
        FROM
        tbldepartment
        INNER JOIN tblstatusai ON tbldepartment.StatusId = tblstatusai.StatusId
        INNER JOIN tbldepartmentcategory ON tbldepartment.DeptCatId = tbldepartmentcategory.DeptCatId ";

        if (!empty($txtSearch)) {
            $condition .= "concat(tbldepartment.DepartmentDesc) like '%$txtSearch%' and ";
        }

        if (!empty($txtStatusId)) {
            $condition .= "tbldepartment.StatusId = $txtStatusId and ";
        }

         if (!empty($txtDeptCatId)) {
             $condition .= "  tbldepartment.DeptCatId  = $txtDeptCatId and ";
         }

        if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }

        $stmt .= $condition . ' ORDER BY   tbldepartment.DepartmentDesc ';

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }
}