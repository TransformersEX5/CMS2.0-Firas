<?php


namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;


class FunctionComponent extends Component
{

    function getPosition($id)
    {
        $data = Yii::$app->db->createCommand("SELECT
        tblposition.PositionId,
        concat(tblpositiongrade.PositionGrade,'-',tblposition.PositionName) AS PositionName,
        tblposition.PositionGradeId,
        tblpositiongrade.PositionGrade
        FROM
        tblposition
        INNER JOIN tblpositiongrade ON tblposition.PositionGradeId = tblpositiongrade.PositionGradeId
         WHERE PositionId = :id", array("id" => $id))
            ->queryAll();
        return $data[0]['PositionName'];
    }
    

    
    function getStatusAI($id)
    {
        $data = Yii::$app->db->createCommand("SELECT * FROM tblstatusai WHERE StatusId = :id", array("id" => $id))
            ->queryAll();
        return $data[0]['Status'];
    }

    function getGender($id)
    {
        $data = Yii::$app->db->createCommand("SELECT * FROM tblgender WHERE genderid = :id", array("id" => $id))
            ->queryAll();
        return $data[0]['GenderName'];
    }


    function getMarital($id)
    {
        $data = Yii::$app->db->createCommand("SELECT * FROM tblmaritalstatus WHERE MaritalStatusId = :id", array("id" => $id))
            ->queryAll();
        return $data[0]['MaritalStatusName'];
    }


    function getWorkingStatus($id)
    {
        $data = Yii::$app->db->createCommand("SELECT * FROM tblworkingstatus WHERE WorkingStatusId = :id", array("id" => $id))
            ->queryAll();
        return $data[0]['WorkingStatusDesc'];
    }

    function getDepartment($id)
    {
        $data = Yii::$app->db->createCommand("SELECT * FROM tbldepartment WHERE DepartmentId = :id", array("id" => $id))
            ->queryAll();
        return $data[0]['DepartmentDesc'];
    }

    function getNationality($id)
    {
        $data = Yii::$app->db->createCommand("SELECT * FROM tblnationality WHERE NationalityId = :id", array("id" => $id))
            ->queryAll();
        return $data[0]['NationalityName'];
    }

    function getRace($id)
    {
        $data = Yii::$app->db->createCommand("SELECT * FROM tblrace WHERE RaceId = :id", array("id" => $id))
            ->queryAll();
        return $data[0]['RaceName'];
    }

    function getHod1($id)
    {
        $data = Yii::$app->db->createCommand(" SELECT  tblhod.HodId,tblhod.UserId,tbluser.FullName FROM tblhod
        INNER JOIN tbluser ON tblhod.UserId = tbluser.UserId  where  tblhod.HodId = :id", array("id" => $id))
            ->queryAll();
        if (empty($data)) {

            return $data = "-Nil-";
        } else {

            return $data[0]['FullName'];
        }
    }


    function getHod2($id)
    {
        $data = Yii::$app->db->createCommand(" SELECT  tblhod.HodId,tblhod.UserId,tbluser.FullName FROM tblhod
        INNER JOIN tbluser ON tblhod.UserId = tbluser.UserId  where  tblhod.HodId = :id", array("id" => $id))
            ->queryAll();

        if (empty($data)) {

            return $data = "-Nil-";
        } else {

            return $data[0]['FullName'];
        }
    }
}
