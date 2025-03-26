<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblroom".
 *
 * @property int $RoomId
 * @property string $RoomCode
 * @property string $RoomName
 * @property int $RoomTypeId
 * @property string $Blok
 * @property int $RoomCapacity
 * @property int $ExamCapacity
 * @property int $RoomStatus 0=Close ,1=Open
 * @property int $LocationId Branch Name
 * @property int $StudentGroupId
 * @property string $TransactionDate
 * @property int|null $UserId
 */
class Tblroom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblroom';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['RoomCode', 'RoomName', 'RoomTypeId', 'RoomCapacity', 'ExamCapacity','RoomStatus'], 'required'],
            [['RoomTypeId', 'RoomCapacity', 'ExamCapacity', 'RoomStatus', 'LocationId', 'StudentGroupId', 'UserId'], 'integer'],
            [['TransactionDate'], 'safe'],
            [['RoomCode'], 'string', 'max' => 35],
            [['RoomName'], 'string', 'max' => 50],
            [['Blok'], 'string', 'max' => 2],
            [['RoomCode', 'RoomName'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'RoomId' => Yii::t('app', 'Room ID'),
            'RoomCode' => Yii::t('app', 'Room Code'),
            'RoomName' => Yii::t('app', 'Room Name'),
            'RoomTypeId' => Yii::t('app', 'Room Type'),
            'Blok' => Yii::t('app', 'Blok'),
            'RoomCapacity' => Yii::t('app', 'Room Capacity'),
            'ExamCapacity' => Yii::t('app', 'Exam Capacity'),
            'RoomStatus' => Yii::t('app', 'Room Status'),
            'LocationId' => Yii::t('app', 'Location'),
            'StudentGroupId' => Yii::t('app', 'Student Group ID'),
            'TransactionDate' => Yii::t('app', 'Transaction Date'),
            'UserId' => Yii::t('app', 'User ID'),
        ];
    }

    public function getRoomList()
    {
        $condition = '';

        //$data = explode(";", $param);

        $condition = "";
        $txtSearch = $_GET['txtSearch'];
        $txtStatusId = $_GET['txtStatusId'];
        $txtRoomTypeId = $_GET['txtRoomTypeId'];

        $stmt = " SELECT
        tblroom.RoomId,
        tblroom.RoomCode,
        tblroom.RoomName,
        tblroom.RoomTypeId,
        tblroom.Blok,
        tblroom.RoomCapacity,
        tblroom.ExamCapacity,
        tblroom.RoomStatus,
        tblroom.LocationId,
        tblroom.StudentGroupId,
        tblroom.TransactionDate,
        tblroom.UserId,
        tblstatusai.`Status`,
        tblroomtype.RoomType
        FROM
        tblroom
        INNER JOIN tblstatusai ON tblroom.RoomStatus = tblstatusai.StatusId
        INNER JOIN tblroomtype ON tblroom.RoomTypeId = tblroomtype.RoomTypeId ";

        if (!empty($txtSearch)) {
            $condition .= "tblroom.RoomCode like '%$txtSearch%' and ";
        }
        if (!empty($txtStatusId)) {
            $condition .= "tblstatusai.StatusId = $txtStatusId and ";
        }
        if (!empty($txtRoomTypeId)) {
            $condition .= "  tblroomtype.RoomTypeId  = $txtRoomTypeId and ";
        }
        if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }
        $stmt .= $condition . ' ORDER BY tblroom.RoomCode ';
        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }
}