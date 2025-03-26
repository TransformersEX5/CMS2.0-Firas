<?php


namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;


class CreditControlComponent extends Component
{

    public function getDebtActionCategory()
    {

        $TypeAuth = Yii::$app->db->createCommand(' 
        SELECT
        tbldebtactioncategory.DebtActionCatId,
        tbldebtactioncategory.DebtActionCategory,
        tbldebtactioncategory.StatusId,
        tbldebtactioncategory.TransactionDate
        from tbldebtactioncategory ')
            ->queryAll();

        $result = ArrayHelper::map($TypeAuth, 'DebtActionCatId', 'DebtActionCategory');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }


    public function getDebtGroupList($id)
    {

        $TypeAuth = Yii::$app->db->createCommand(' 
        SELECT
        tbldebtgroup.DebtGroupId,
        tbldebtgroup.UserId,
        tbldebtgroup.DebtGroupName,
        tbldebtgroup.TransactionDate
        from tbldebtgroup
        where tbldebtgroup.UserId = ' . $id . '
        ORDER BY tbldebtgroup.DebtGroupName ')
            ->queryAll();

        $result = ArrayHelper::map($TypeAuth, 'DebtGroupId', 'DebtGroupName');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }



    public function getBlockAccessTypeList()
    {

        $TypeAuth = Yii::$app->db->createCommand(' 
        SELECT
        tblblockaccesstype.BlockAcessId,
        tblblockaccesstype.BlockAccessDesc,
        tblblockaccesstype.StatusId
        from tblblockaccesstype
        where tblblockaccesstype.StatusId = 1 ')
        ->queryAll();

        $result = ArrayHelper::map($TypeAuth, 'BlockAcessId', 'BlockAccessDesc');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }




    /*=====================END ================================================*/
}
