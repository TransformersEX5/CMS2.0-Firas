<?php


namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;


class TrainingComponent extends Component
{




    public function getTrainingCategory()
    {

        $TypeAuth = Yii::$app->db->createCommand(' 
        SELECT tbltrainingcategory.TrainingCategoryId,
        tbltrainingcategory.TrainingCategory
        from tbltrainingcategory
        ORDER BY tbltrainingcategory.TrainingCategory ')

            ->queryAll();

        $result = ArrayHelper::map($TypeAuth, 'TrainingCategoryId', 'TrainingCategory');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }


    /*
      function getTrainingGroup
      Academic or Non Academic
    */

    public function getTrainingGroup()
    {

        $TypeAuth = Yii::$app->db->createCommand(' SELECT
    tbltraininggroup.TrainingGroupId,
    tbltraininggroup.TrainingGroup,
    tbltraininggroup.TransactionDate
    from tbltraininggroup ')

            ->queryAll();

        $result = ArrayHelper::map($TypeAuth, 'TrainingGroupId', 'TrainingGroup');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }



    public function getTrainingProvider()
    {

        $TypeAuth = Yii::$app->db->createCommand(' SELECT
        tbltrainingprovider.TrainingProviderId,
        tbltrainingprovider.TrainingName,
        tbltrainingprovider.TrainingAddress,
        tbltrainingprovider.TrainingHpno,
        tbltrainingprovider.TrainingEmailAddress,
        tbltrainingprovider.TrainingCategory,
        tbltrainingprovider.TrainingProviderStatusId,
        tbltrainingprovider.Remarks,
        tbltrainingprovider.TransactionDate,
        tbltrainingprovider.UserId
        from tbltrainingprovider  ORDER BY tbltrainingprovider.TrainingName ')

            ->queryAll();

        $result = ArrayHelper::map($TypeAuth, 'TrainingProviderId', 'TrainingName');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }



    public function getTrainingRequestStatus()
    {

        $TypeAuth = Yii::$app->db->createCommand(' SELECT
        tbltrainingstatus.TrainingStatusId,
        tbltrainingstatus.TrainingStatus
        from tbltrainingstatus ')

            ->queryAll();

        $result = ArrayHelper::map($TypeAuth, 'TrainingStatusId', 'TrainingStatus');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }




    public function getTrainingProviderStatus()
    {

        $TypeAuth = Yii::$app->db->createCommand(' SELECT
        tbltrainingproviderstatus.TrainingProviderStatusId,
        tbltrainingproviderstatus.TrainingProviderStatus
        from tbltrainingproviderstatus
         ')

            ->queryAll();

        $result = ArrayHelper::map($TypeAuth, 'TrainingProviderStatusId', 'TrainingProviderStatus');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }



    public function getTrainingClaimHRDF()
    {

        $TypeAuth = Yii::$app->db->createCommand(' SELECT
        tbltrainingclaim.TrainingClaimId,
        tbltrainingclaim.TrainingClaim
        from tbltrainingclaim ')

            ->queryAll();

        $result = ArrayHelper::map($TypeAuth, 'TrainingClaimId', 'TrainingClaim');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }


    public function getTrainingVenue()
    {

        $TypeAuth = Yii::$app->db->createCommand('   SELECT
        tbltrainingvenue.TrainingVenueId,
        tbltrainingvenue.TrainingVenue
        from tbltrainingvenue ')

            ->queryAll();

        $result = ArrayHelper::map($TypeAuth, 'TrainingVenueId', 'TrainingVenue');
        if ($result)
            return $result;
        else
            return ["null" => "Sorry, No Data"];
        return $result;
    }


  


    /*=====================END ================================================*/
}
