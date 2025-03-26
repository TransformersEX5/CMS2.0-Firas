<?php
namespace app\modules\programfeekk\models;
use Yii;

/**
 * This is the model class for table "tblprogramfeecategorystatus".
 *
 * @property int $ProgFeeCatStatusId
 * @property int|null $ProgFeeCatId
 * @property int|null $ApprovalStatusId
 * @property int|null $CurrentStatusId
 * @property string|null $ProgFeeCatRemarks
 * @property int $UserId
 * @property string $TransactionDate
 */
class Tblprogramfeecategorystatus extends \yii\db\ActiveRecord
{

    public static function getDb()
    {
        return Yii::$app->dbcitykk; // Use the secondary database connection
    }


    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblprogramfeecategorystatus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ProgFeeCatId', 'ApprovalStatusId', 'CurrentStatusId', 'UserId'], 'integer'],
            [['UserId'], 'required'],
            [['TransactionDate'], 'safe'],
            [['ProgFeeCatRemarks'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ProgFeeCatStatusId' => Yii::t('app', 'Prog Fee Cat Status ID'),
            'ProgFeeCatId' => Yii::t('app', 'Prog Fee Cat ID'),
            'ApprovalStatusId' => Yii::t('app', 'Approval Status ID'),
            'CurrentStatusId' => Yii::t('app', 'Current Status ID'),
            'ProgFeeCatRemarks' => Yii::t('app', 'Prog Fee Cat Remarks'),
            'UserId' => Yii::t('app', 'User ID'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
        ];
    }
}
