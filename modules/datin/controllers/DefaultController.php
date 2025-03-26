<?php

namespace app\modules\datin\controllers;

use Yii;
use yii\web\Response;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

use app\modules\datin\models\tbldatinpropertytype;
use app\modules\datin\models\tbldatinproperty;

/**
 * Default controller for the `datinproperty` module
 */
class DefaultController extends Controller
{
    public $layout = '@app/views/layouts/lexapurple_layouts';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGetdname()
    {
        $dtype = Yii::$app->request->get('dtype');
        $searchbox = Yii::$app->request->get('searchbox');
        $statusId = Yii::$app->request->get('statusId');

        if ($dtype == '') {
            $dtype = '.*';
        }

        if ($searchbox == '') {
            $searchbox = '.*';
        }

        if ($statusId == '') {
            $statusId = '.*';
        }

        $stmt = "SELECT tbldatinproperty.ItemId, tbldatinpropertytype.TypeName, tbldatinproperty.ItemName, tbldatinproperty.DueDate, 
        tbldatinproperty.PersonInCharge, tblstatusai.Status
        FROM tbldatinproperty
        INNER JOIN tbldatinpropertytype ON tbldatinpropertytype.TypeId = tbldatinproperty.TypeId
        INNER JOIN tblstatusai ON tblstatusai.StatusId = tbldatinproperty.StatusId
        WHERE tbldatinproperty.TypeId REGEXP '$dtype' AND (tbldatinproperty.ItemName REGEXP '$searchbox' OR tbldatinproperty.PersonInCharge REGEXP '$searchbox' OR 
        tblstatusai.Status REGEXP '$searchbox') AND tbldatinproperty.StatusId REGEXP '$statusId'
        ORDER BY tbldatinproperty.StatusId ASC, tbldatinproperty.DueDate DESC, tbldatinproperty.ItemName ASC";

        $data = Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }

    public function actionDetails()
    {
        $itemId = Yii::$app->request->get('itemId');

        if ($itemId == 0) {
            if (Yii::$app->user->can('Datin Property-Create')) {
                $model = new tbldatinproperty();
            } else {
                return "Sorry , your access is denied";
            }
        } else {
            // if (Yii::$app->user->can('Datin Property-Edit')) {
            $model = tbldatinproperty::find()->where(['ItemId' => $itemId])->one();
            // } else {
            //     return "Sorry , your access is denied";
            // }
        }

        return $this->renderAjax('details', ['model' => $model]);
    }

    public function actionItemdetails()
    {
        $itemId = Yii::$app->request->post('itemId');
        if ($itemId == 0) {
            $model = new tbldatinproperty();
        } else {
            $model = tbldatinproperty::findOne(['ItemId' => $itemId]);
        }

        $data = Yii::$app->request->post('formData');
        $datadecoded = json_decode($data);
        $arrayData = array();
        $i = 0;

        foreach ($datadecoded as $fieldObject) {
            $arrayData[$i] = $fieldObject->value;
            $i++;
        }

        $model->TypeId = $arrayData[1];
        $model->ItemName = $arrayData[2];
        $model->DueDate = $arrayData[3];
        $model->StatusId = $arrayData[4];
        $model->PersonInCharge = $arrayData[5];
        $model->Remarks = $arrayData[6];
        if ($arrayData[4] == 2) {
            $model->InactiveRemarks = $arrayData[7];
        }

        if ($itemId == 0) {
            $model->UserId = Yii::$app->user->identity->UserId;
        }

        $model->save();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['ItemId' => $model->ItemId];
    }

    public function actionType()
    {
        $typeId = Yii::$app->request->get('typeId');

        if ($typeId == 0) {
            if (Yii::$app->user->can('Datin Property-Create')) {
                $model = new tbldatinpropertytype();
            } else {
                return "Sorry , your access is denied";
            }
        } else {
            // if (Yii::$app->user->can('Datin Property-Edit')) {
            $model = tbldatinpropertytype::find()->where(['TypeId' => $typeId])->one();
            // } else {
            // return "Sorry , your access is denied";
            // }
        }
        return $this->renderAjax('type', ['model' => $model]);
    }

    public function actionGetdtype()
    {
        $stmt = "SELECT TypeId, TypeName
        FROM tbldatinpropertytype
        ORDER BY TypeName";

        $data = Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }

    public function actionTypedetails()
    {
        $typeId = Yii::$app->request->post('typeId');
        if ($typeId == 0) {
            $model = new tbldatinpropertytype();
        } else {
            $model = tbldatinpropertytype::findOne(['TypeId' => $typeId]);
        }

        $data = Yii::$app->request->post('formData');
        $datadecoded = json_decode($data);
        $arrayData = array();
        $i = 0;

        foreach ($datadecoded as $fieldObject) {
            $arrayData[$i] = $fieldObject->value;
            $i++;
        }

        $model->TypeName = $arrayData[1];
        if ($typeId == 0) {
            $model->UserId = Yii::$app->user->identity->UserId;
        }

        $checkDuplicate = tbldatinpropertytype::findOne(['TypeName' => $arrayData[1]]);

        if (!empty($checkDuplicate) && ($typeId == 0 || $model->TypeId != $checkDuplicate->TypeId)) {
            die('Already Exist!');
        }

        $model->save();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['TypeId' => $model->TypeId];
    }

    public function actionReport()
    {
        $sql = "SELECT 
        tbldatinpropertytype.TypeName, tbldatinproperty.ItemName, tbldatinproperty.DueDate, 
        CASE WHEN tbldatinproperty.StatusId = 1 THEN 'Active' ELSE 'Inactive' END AS StatusName
        FROM tbldatinproperty
        INNER JOIN tbldatinpropertytype ON tbldatinproperty.TypeId = tbldatinpropertytype.TypeId
        ORDER BY tbldatinproperty.StatusId ASC, tbldatinproperty.DueDate DESC, tbldatinpropertytype.TypeName";

        $data = Yii::$app->db->createCommand($sql)->queryAll();

        return $this->renderPartial('report', ['data' => $data]);
    }

    public function actionUsermanual()
    {
        $filePath = 'uploads/DATIN PROPERTY USER MANUAL.docx';
        $fileName = 'DATIN PROPERTY USER MANUAL.docx';

        if (file_exists($filePath)) {
            Yii::$app->response->sendFile($filePath, $fileName, ['inline' => false]);
        } else {
            Yii::$app->session->setFlash('error', 'File not found.');
            return $this->redirect(['index']);
        }
    }
}
