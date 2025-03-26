<?php

namespace app\modules\program\controllers;

// use Yii;
// use yii\web\Response;
// use yii\data\ActiveDataProvider;
// use yii\web\Controller;
// use yii\web\NotFoundHttpException;
// use yii\filters\VerbFilter;
// use yii\bootstrap5\ActiveForm;
// use yii\helpers\Url;

use Yii;
use yii\web\Response;
use app\models\Tblprogrampchop;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;

// use DateTime;
// use DateInterval;

use app\models\tbluser;
use app\models\tbllecturersubject;



/**
 * Default controller for the `program` module
 */
class DefaultController extends Controller
{
    public $modelClass = 'app\models\Tblprogrampchop';

    public $layout = '@app/views/layouts/lexapurple_layouts';

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionProgramlist()
    {
        $model = new Tblprogrampchop();

        $output = [];
        $output['data'] = '';

        $data = $model->getProgramvspcvshop();
        $output['data'] = $data;

        if (count($output) > 0) {
            return json_encode($output);
        } else {
            return json_encode($output);
        }
    }

    public function actionProgramowner()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tblprogrampchop::find(),
        ]);

        return $this->render('programowner', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionProgramownerdetails()
    {
        $ProgramId = Yii::$app->request->get('ProgramId');

        $sql = "SELECT tblprogram.ProgramId, tblprogramtype.ProgramTypeName, tblprogram.ProgramCode, tblprogram.ProgramName, 
        tblprogram.ProgramName2, COALESCE(HOPUser.FUllName, 'NULL') AS HOPName, COALESCE(PCUser.FullName, 'NULL') AS PCName, 
        CASE WHEN ProgramStatus = 1 THEN 'Active' ELSE 'Inactive' END AS ProgramStatus
        FROM tblprogram
        LEFT JOIN tbluser HOPUser ON HOPUser.UserId = tblprogram.HOPId
        LEFT JOIN tbluser PCUser ON PCUser.UserId = tblprogram.PCId
        INNER JOIN tblprogramtype ON tblprogramtype.ProgramTypeId = tblprogram.ProgramType
        WHERE tblprogram.ProgramId = $ProgramId";

        $data = Yii::$app->db->createCommand($sql)->queryAll();

        $model = Tblprogrampchop::find()->where(['ProgramId' => $ProgramId])->one();

        return $this->renderAjax('programownerdetails', ['model' => $model, 'data' => $data]);
    }

    public function actionUpdate()
    {
        $ProgramId = Yii::$app->request->post('ProgramId');

        $model = Tblprogrampchop::findOne(['ProgramId' => $ProgramId]);

        $data = Yii::$app->request->post('formData');
        $datadecoded = json_decode($data);
        $arrayData = array();
        $i = 0;

        foreach ($datadecoded as $fieldObject) {
            $arrayData[$i] = $fieldObject->value;
            $i++;
        }

        $model->PCId = $arrayData[1];
        $model->HOPId = $arrayData[2];

        $model->save();

        // if($model->save())
        // {

        // }
        // else
        // {
        //     die(print_r($model->getErrors()));
        // }

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['ProgramId' => $model->ProgramId];
    }















    public function actionSubjectexpert()
    {
        return $this->render('subjectexpert');
    }

    public function actionGetlecturerlist()
    {
        $txtSearch = Yii::$app->request->get('txtSearch');
        $cboStatus = Yii::$app->request->get('cboStatus');

        if ($txtSearch == '') {
            $txtSearch = '.*';
        }

        if ($cboStatus == '') {
            $cboStatus = '.*';
        }

        $stmt = "SELECT tbluser.UserId, tbluser.UserNo, tbluser.FullName, tbluser.StatusId, tbluser.DepartmentId, tbldepartment.DepartmentDesc, tblstatusai.Status, 
        tbldepartment.DeptCatId, NoOfSubj
        FROM
        tbluser
        INNER JOIN tbldepartment ON tbldepartment.DepartmentId = tbluser.DepartmentId
        INNER JOIN tblstatusai ON tbluser.StatusId = tblstatusai.StatusId
        INNER JOIN tbldepartmentcategory ON tbldepartment.DeptCatId = tbldepartmentcategory.DeptCatId
        LEFT JOIN (
        SELECT COUNT(tbllecturersubject.SubjLectId) AS NoOfSubj, tbllecturersubject.LecturerId
        FROM
        tbllecturersubject
        INNER JOIN tblsubject ON tblsubject.SubjectId = tbllecturersubject.SubjectId
        GROUP by tbllecturersubject.LecturerId
        )QLectSubj ON QLectSubj.LecturerId = tbluser.UserId
        WHERE tbldepartment.DeptCatId = 1 AND tbluser.StatusId REGEXP '$cboStatus' AND tbluser.FullName REGEXP '$txtSearch'
        ORDER BY tbluser.FullName";

        $data = Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }

    public function actionGetlecturersubject()
    {
        $UserId = Yii::$app->request->get('UserId');

        $stmt = "SELECT
        tbllecturersubject.SubjLectId,
        tbllecturersubject.SubjectId,
        tbllecturersubject.LecturerId,
        tblsubject.SubjectCode,
        tblsubject.SubjectName,
        tblsubject.SubjectCreditFT
        FROM
        tbllecturersubject
        INNER JOIN tblsubject ON tblsubject.SubjectId = tbllecturersubject.SubjectId
        WHERE tbllecturersubject.LecturerId = $UserId
        ORDER BY tblsubject.SubjectName";

        $data = Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }

    public function actionSubjectexpertnew()
    {
        $UserId = Yii::$app->request->get('UserId');

        $stmt = "SELECT tbluser.UserId, tbluser.UserNo, tbluser.FullName, tbldepartment.DepartmentDesc
        FROM tbluser
        INNER JOIN tbldepartment ON tbldepartment.DepartmentId = tbluser.DepartmentId
        WHERE tbluser.UserId = $UserId";

        $data = Yii::$app->db->createCommand($stmt)->queryAll();

        $stmt2 = "SELECT tblsubject.SubjectId, tblsubject.SubjectCode, tblsubject.SubjectName 
        FROM tblsubject 
        WHERE tblsubject.SubjectStatus = 1
        ORDER BY SubjectName ASC";

        $subject = Yii::$app->db->createCommand($stmt2)->queryAll();

        return $this->renderAjax('subjectexpertnew', ['data' => $data, 'subject' => $subject]);
    }

    public function actionGetsubject()
    {
        $txtSearchSubject = Yii::$app->request->get('txtSearchSubject');
        $UserId = Yii::$app->request->get('UserId');

        if ($txtSearchSubject == '') {
            $txtSearchSubject = '.*';
        }

        $stmt = "SELECT tblsubject.SubjectId, tblsubject.SubjectCode, tblsubject.SubjectName 
        FROM tblsubject 
        WHERE tblsubject.SubjectStatus = 1 AND (tblsubject.SubjectCode REGEXP '$txtSearchSubject' OR tblsubject.SubjectName REGEXP '$txtSearchSubject') 
        AND tblsubject.SubjectId NOT IN (
        SELECT tbllecturersubject.SubjectId 
        FROM tbllecturersubject 
        WHERE tbllecturersubject.LecturerId = $UserId)
        ORDER BY SubjectName ASC";

        // die($stmt);

        $data = Yii::$app->db->createCommand($stmt)->queryAll();

        foreach ($data as $row) {
            echo "<tr>
                    <td>{$row['SubjectCode']}</td>
                    <td>{$row['SubjectName']}</td>
                    <td class='text-center'>
                    <div class='form-check'>
<input class='form-check-input' type='checkbox' id='formCheck{$row['SubjectId']}' name='tbllecturersubject[SubjectId][]' value='{$row['SubjectId']}'><label for='formCheck{$row['SubjectId']}'></label>
                    </div>
                    </td>
                  </tr>";
        }
    }

    public function actionSubjectexpertdetail()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $data = Yii::$app->request->post('formData');
        $datadecoded = json_decode($data);
        $arrayData = array();
        $i = 0;

        foreach ($datadecoded as $fieldObject) {
            $arrayData[$i] = $fieldObject->value;
            $i++;
        }

        $UserId = Yii::$app->request->post('UserId');
        $selectedSubject = Yii::$app->request->post('SubjectId');

        foreach ($selectedSubject as $rows) {

            $model = new tbllecturersubject();

            $model->SubjectId = $rows;
            $model->LecturerId = $UserId;
            $model->UserId = Yii::$app->user->identity->UserId;
            $model->save();
        }
        return ['success' => true, 'SubjLectId' => $model->SubjLectId];
    }

    public function actionSubjectexpertremove()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $SubjLectId = Yii::$app->request->post('SubjLectId');

        $model = tbllecturersubject::findOne(['SubjLectId' => $SubjLectId]);

        if ($model->delete()) {
            return ['success' => true, 'SubjLectId' => $model->SubjLectId];
        } else {
            return ['success' => false, 'errors' => $model->errors];
        }
    }
}
