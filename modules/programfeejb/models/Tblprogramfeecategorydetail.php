<?php

namespace app\modules\programfeejb\models;

use Yii;

/**
 * This is the model class for table "tblprogramfeecategorydetail".
 *
 * @property int $ProgFeeCatDetailId
 * @property int|null $ProgFeeCatId
 * @property int|null $SemesterNo
 * @property int|null $FeeTypeId
 * @property float|null $FeeAmount
 * @property int|null $UserId
 * @property string|null $TransactionDate
 */
class Tblprogramfeecategorydetail extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        return Yii::$app->dbcityjb; // Use the secondary database connection
    }

    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblprogramfeecategorydetail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ProgFeeCatId', 'SemesterNo', 'FeeTypeId', 'UserId'], 'integer'],
            [['FeeAmount'], 'number'],
            [['TransactionDate'], 'safe'],
            [['ProgFeeCatId', 'SemesterNo', 'FeeTypeId'], 'unique', 'targetAttribute' => ['ProgFeeCatId', 'SemesterNo', 'FeeTypeId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ProgFeeCatDetailId' => Yii::t('app', 'Prog Fee Cat Detail ID'),
            'ProgFeeCatId' => Yii::t('app', 'Prog Fee Cat ID'),
            'SemesterNo' => Yii::t('app', 'Semester No'),
            'FeeTypeId' => Yii::t('app', 'Fee Type'),
            'FeeAmount' => Yii::t('app', 'Fee Amount (RM)'),
            'UserId' => Yii::t('app', 'User Id'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
        ];
    }


    
    
    public function getProgramfeecategorydetaillist()
    {
        $condition = '';

        //$data = explode(";", $param);

        $condition = "";
        
        $ProgFeeCatDetailId = $_GET['ProgFeeCatDetailId'];
      
        $stmt = " SELECT
        tblprogramfeecategorydetail.ProgFeeCatDetailId,
        tblprogramfeecategorydetail.ProgFeeCatId,
        tblprogramfeecategorydetail.SemesterNo,
        tblprogramfeecategorydetail.FeeTypeId,
        tblprogramfeecategorydetail.FeeAmount,
        tblprogramfeecategorydetail.UserId,
        tblprogramfeecategorydetail.TransactionDate,
        tbl_feetype.feetypename
        FROM
        tblprogramfeecategorydetail
        INNER JOIN tbl_feetype ON tblprogramfeecategorydetail.FeeTypeId = tbl_feetype.feetypeid ";

        
        if (!empty($ProgFeeCatDetailId)) {
            $condition .= "tblprogramfeecategorydetail.ProgFeeCatId = $ProgFeeCatDetailId and ";
        }


        if (empty($ProgFeeCatDetailId)) {
            $condition .= "tblprogramfeecategorydetail.ProgFeeCatId = 0 and ";
        }


       if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }

        $stmt .= $condition ;
        // $stmt .= $condition . ' ORDER BY tblprogramfeecategorydetail.SemesterNo, tbl_feetype.feetypename ';

        $data = \Yii::$app->dbcityjb->createCommand($stmt)->queryAll();

        return $data;
    }

}
