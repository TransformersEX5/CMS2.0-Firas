<?php

namespace app\modules\marketingadmin\models;

use Yii;

/**
 * This is the model class for table "tblmarketingteam".
 *
 * @property int $MarketingTeamId
 * @property string|null $MarketingTeam
 * @property string|null $Description
 * @property int|null $TeamTarget
 * @property int|null $StatusId
 * @property string|null $EmailTo
 * @property int|null $TeamNo
 * @property string|null $Grouping
 * @property string|null $ManagerName
 * @property string|null $ManagerPostition
 */
class Tblmarketingteam extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblmarketingteam';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TeamTarget', 'StatusId', 'TeamNo'], 'integer'],
            [['MarketingTeam', 'Grouping'], 'string', 'max' => 50],
            [['Description'], 'string', 'max' => 255],
            [['EmailTo'], 'string', 'max' => 25],
            [['ManagerName', 'ManagerPostition'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'MarketingTeamId' => 'Marketing Team ID',
            'MarketingTeam' => 'Marketing Team',
            'Description' => 'Description',
            'TeamTarget' => 'Team Target',
            'StatusId' => 'Status ID',
            'EmailTo' => 'Email To',
            'TeamNo' => 'Team No',
            'Grouping' => 'Grouping',
            'ManagerName' => 'Manager Name',
            'ManagerPostition' => 'Manager Postition',
        ];
    }
}
