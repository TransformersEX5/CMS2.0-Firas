<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbldebtoraction".
 *
 * @property int $FollowupId
 * @property int $ProgramRegId
 * @property int $DebtActionCatId
 * @property string|null $ActionRemarks
 * @property string|null $FeedbackRemarks
 * @property string|null $RemainderDate
 * @property string|null $RemainderRemarks
 * @property float|null $OutsAmt
 * @property int|null $CurrentStatusId
 * @property string|null $TransactionDate
 * @property int|null $UserId
 */
class Tbldebtoraction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbldebtoraction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ProgramRegId', 'DebtActionCatId'], 'required'],
            [['ProgramRegId', 'DebtActionCatId', 'CurrentStatusId', 'UserId'], 'integer'],
            [['RemainderDate', 'TransactionDate'], 'safe'],
            [['OutsAmt'], 'number'],
            [['ActionRemarks', 'FeedbackRemarks', 'RemainderRemarks'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'FollowupId' => Yii::t('app', 'Followup ID'),
            'ProgramRegId' => Yii::t('app', 'Program Reg ID'),
            'DebtActionCatId' => Yii::t('app', 'Debt Action Cat ID'),
            'ActionRemarks' => Yii::t('app', 'Action Remarks'),
            'FeedbackRemarks' => Yii::t('app', 'Feedback Remarks'),
            'RemainderDate' => Yii::t('app', 'Remainder Date'),
            'RemainderRemarks' => Yii::t('app', 'Remainder Remarks'),
            'OutsAmt' => Yii::t('app', 'Outs Amt'),
            'CurrentStatusId' => Yii::t('app', 'Current Status ID'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
            'UserId' => Yii::t('app', 'User ID'),
        ];
    }



    public function getFollowupList()
    {
        $condition = '';
        // $limit = '';
        // $UserId         = Yii::$app->user->identity->UserId;
        $ProgramRegId = $_GET['id'];


        // $txtStatusId    = $_GET['txtStatusId'];

        $stmt = 'SELECT
        tbldebtoraction.FollowupId,
        tbldebtoraction.ProgramRegId,
        tbldebtoraction.DebtActionCatId,
        tbldebtoraction.ActionRemarks,
        tbldebtoraction.FeedbackRemarks,
        tbldebtoraction.RemainderDate,
        tbldebtoraction.RemainderRemarks,
        tbldebtoraction.TransactionDate,
        tbldebtoraction.UserId,
        tbldebtactioncategory.DebtActionCategory,
        tbldebtoraction.OutsAmt,
        tbluser.ShortName
        FROM
        tbldebtoraction
        INNER JOIN tbldebtactioncategory ON tbldebtoraction.DebtActionCatId = tbldebtactioncategory.DebtActionCatId
        INNER JOIN tbluser ON tbldebtoraction.UserId = tbluser.UserId ';


        if (!empty($ProgramRegId)) {
            $condition .= " tbldebtoraction.ProgramRegId = $ProgramRegId  and ";
        }

        if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }

        $stmt .= $condition . ' ORDER BY tbldebtoraction.FollowupId Desc';

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }
}
