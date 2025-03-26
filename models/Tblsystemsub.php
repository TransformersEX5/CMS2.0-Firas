<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblsystemsub".
 *
 * @property int $SysSubId
 * @property int $SystemId
 * @property string $SubMenu
 * @property string $SubURL
 * @property int $StatusId 1=Active
 */
class Tblsystemsub extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblsystemsub';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SystemId', 'SubMenu', 'SubURL'], 'required'],
            [['SystemId', 'StatusId'], 'integer'],
            [['SubMenu'], 'string', 'max' => 20],
            [['SubURL'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SysSubId' => Yii::t('app', 'Sys Sub ID'),
            'SystemId' => Yii::t('app', 'System ID'),
            'SubMenu' => Yii::t('app', 'Sub Menu'),
            'SubURL' => Yii::t('app', 'Sub Url'),
            'StatusId' => Yii::t('app', 'Status ID'),
        ];
    }



    

    public function getSubModuleList($SystemId)
    {
        $condition = '';

        // $SystemId=$_GET['SystemId'];
    
        $stmt = " SELECT
        tblsystemsub.SysSubId,
        tblsystemsub.SystemId,
        
        tblsystemsub.SubMenu,
        tblsystemsub.SubURL,
        tblsystemsub.SubMenuQ,
        tblsystemsub.StatusId
        from tblsystemsub";    
        
        $condition .= " tblsystemsub.StatusId = 1 and ";

        if (!empty($SystemId)) {
            $condition .= "  tblsystemsub.SystemId = $SystemId and ";
        }

        if ($condition != '') {
            $condition = ' where ' . substr($condition, 0, -4);
        }

        $stmt .= $condition . ' ORDER BY tblsystemsub.SubMenuQ,tblsystemsub.SubMenu ';

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        return $data;
    }
}

