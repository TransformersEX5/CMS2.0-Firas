<?php

namespace app\modules\rmc\controllers;

use Yii;
use yii\web\Response;
use app\models\Tblprogrampchop;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;

use app\models\tblrmc;
use app\models\tblrmcstatus;

/**
 * Default controller for the `rmc` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public $layout = '@app/views/layouts/lexapurple_layouts';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRmclist()
    {
        $txtSearch = $_GET['txtSearch'];
        $txtStatusId = $_GET['txtStatusId'];

        if ($txtSearch == '') {
            $txtSearch = '.*';
        }

        if ($txtStatusId == '') {
            $txtStatusId = '.*';
        }

        $stmt = "SELECT tblrmc.RMCId, tblrmc.RMCTitle, tblrmc.UserId, tblrmcstatus.Status, tblrmc.TransactionDate 
        FROM tblrmc 
        INNER JOIN tblrmcstatus ON tblrmcstatus.StatusId = tblrmc.StatusId 
		WHERE tblrmc.UserId = " . Yii::$app->user->identity->UserId . " AND tblrmc.RMCTitle REGEXP '$txtSearch' 
        AND tblrmc.StatusId REGEXP '$txtStatusId' 
		ORDER BY tblrmc.RMCId ASC";

        $data = Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }


    public function actionRmccreate()
    {
        $RMCId = Yii::$app->request->get('RMCId');

        if ($RMCId) {
            $model = tblrmc::findOne(['RMCId' => $RMCId]);
        } else {
            $model = new tblrmc();
        }

        return $this->renderAjax('create', ['model' => $model]);
    }

    public function actionCreate()
    {
        $RMCId = Yii::$app->request->post('RMCId');

        if ($RMCId) {
            $model = tblrmc::findOne(['RMCId' => $RMCId]);
        } else {
            $model = new tblrmc();
        }


        $data = Yii::$app->request->post('formData');
        $datadecoded = json_decode($data);
        $arrayData = array();
        $i = 0;

        foreach ($datadecoded as $fieldObject) {
            $arrayData[$i] = $fieldObject->value;
            $i++;
        }

        $model->RMCTitle = $arrayData[1];
        $model->StatusId = $arrayData[2];
        $model->UserId = Yii::$app->user->identity->UserId;

        $model->save();

        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['RMCId' => $model->RMCId];
    }

    public function actionDetails()
    {
        $UserId = '' . Yii::$app->user->identity->UserId;


        $RMCId = base64_decode(Yii::$app->request->get('RMCId'));

        if (!$RMCId) {
            throw new NotFoundHttpException('Invalid request: Research ID is missing.');
        }

        // Fetch main project details
        $stmt1 = "SELECT tblrmc.RMCTitle, tblrmc.UserId, tblrmcstatus.Status, tblrmc.TransactionDate
              FROM tblrmc 
              INNER JOIN tblrmcstatus ON tblrmcstatus.StatusId = tblrmc.StatusId 
              WHERE tblrmc.RMCId = :RMCId";

        $data1 = Yii::$app->db->createCommand($stmt1)
            ->bindValue(':RMCId', $RMCId)
            ->queryOne();

        if (!$data1) {
            throw new NotFoundHttpException('Research details not found.');
        }

        // Fetch updated research information
        $stmt2 = "SELECT tblrmcinformation.RMCInformationId, tblrmccluster.RMCCluster, 
                     tblrmcinformation.RMCInformationFieldOfResearch, 
                     tblrmcinformation.RMCInformationResearchDuration, 
                     tblrmcinformation.RMCInformationStartDate, 
                     tblrmcinformation.RMCInformationEndDate, 
                     tblrmcinformation.RMCInformationResearchLocation,
                     tblrmcinformation.RMCId  -- Include RMCId in response
              FROM tblrmcinformation
              INNER JOIN tblrmccluster ON tblrmccluster.RMCClusterId = tblrmcinformation.RMCClusterId
              WHERE tblrmcinformation.UserId = :UserId AND tblrmcinformation.RMCId = :RMCId";

        $data2 = Yii::$app->db->createCommand($stmt2)
            ->bindValue(':UserId', $UserId)
            ->bindValue(':RMCId', $RMCId)
            ->queryOne();


        $hasResearch = !empty($data2);

        $stmt3 = "SELECT tblrmcsummary.RMCSummaryId, 
                 tblrmcsummary.RMCSummaryBackground, 
                 tblrmcsummary.RMCSummaryResearchObjective, 
                 tblrmcsummary.RMCSummarySpecificObjective1, 
                 tblrmcsummary.RMCSummarySpecificObjective2, 
                 tblrmcsummary.RMCSummarySpecificObjective3,
                 tblrmcsummary.RMCSummaryReseachPublication, 
                 tblrmcsummary.RMCSummaryFinding, 
                 tblrmcsummary.RMCSummaryPotentialApplication, 
                 tblrmcsummary.RMCSummaryNoOfGraduate
          FROM tblrmcsummary
          WHERE tblrmcsummary.UserId = :UserId AND tblrmcsummary.RMCId = :RMCId";

        $data3 = Yii::$app->db->createCommand($stmt3)
            ->bindValue(':UserId', $UserId)
            ->bindValue(':RMCId', $RMCId)
            ->queryOne();

        $hasSummary = !empty($data3);

        // Fetch files
        $stmt4 = "SELECT tblrmcdocument.RMCDocumentId, tblrmcdocument.RMCDocument, tblrmcdocumenttype.RMCDocumentType 
                  FROM tblrmcdocument 
                  INNER JOIN tblrmcdocumenttype ON tblrmcdocumenttype.RMCDocumentTypeId = tblrmcdocument.RMCDocumentTypeId 
                  WHERE tblrmcdocument.RMCId = :RMCId";
        $files = Yii::$app->db->createCommand($stmt4)
            ->bindValue(':RMCId', $RMCId)
            ->queryAll();

        // Remove UserId from $data1 before passing to the view
        unset($data1['UserId']);

        return $this->render('details', [
            'data' => $data1,
            'research' => $data2 ?? [],
            'hasResearch' => $hasResearch,
            'summary' => $data3,
            'hasSummary' => $hasSummary,
            'files' => $files, // Pass files to the view
        ]);
    }
}




