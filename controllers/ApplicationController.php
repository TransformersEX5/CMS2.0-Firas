<?php

namespace app\controllers;

use Yii;
use app\models\Tblapplication;
use app\models\Tbladdress;
use app\models\Tbldocument;
use app\models\Tblprogramregister;
use app\models\Tblstudeducation;
use app\models\Tblstudedusubj;
use app\models\Tblstudentdocument;
use app\models\Tblstudworkexprience;
use yii\web\Response;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;
use yii\web\UploadedFile;

/**
 * ApplicationController implements the CRUD actions for Tblapplication model.
 */
class ApplicationController extends Controller
{
    public $layout = 'lexapurple_layouts';

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionApplicationlist()
    {
        $model = new Tblapplication();

        $output = [];
        $output['data'] = '';

        $data = $model->getApplicationlist();
        $output['data'] = $data;

        if (count($output) > 0) {
            return json_encode($output);
        } else {
            return json_encode($output);
        }
    }

    public function actionNewapply()
    {
        $ApplicationId = Yii::$app->request->get('ApplicationId');
        $model = Tblapplication::findOne(base64_decode($ApplicationId));
        return $this->render('newapply', [
            'model' => $model,
        ]);
    }

    /**
     * Lists all Tblapplication models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $message = "index action of the ExampleController";
        $message2 = "index action of the ExampleController";

        $model = Tblapplication::findOne(27941);
        //  $model = new Tblapplication;
        // $profile = $model->getProfile();

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Tblapplication model.
     * @param int $ApplicationId Application ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ApplicationId)
    {
        $ApplicationId = Yii::$app->request->get('ApplicationId');
        $model = Tblapplication::findOne(base64_decode($ApplicationId));
        $address = Tbladdress::findOne(base64_decode($ApplicationId));
        $programregister = Tblprogramregister::findOne(base64_decode($ApplicationId));

        $message = "xxxxxxxxxxxxxxxxxxxxxxxxxx";

        return $this->render('view', [
            'model' => $model, 'address' => $address, 'programregister' => $programregister,
        ]);
    }

    /**
     * Creates a new Tblapplication model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $id = base64_decode(Yii::$app->request->get('id', 0));
        $address = Tbladdress::findOne($id);
        $programregister = Tblprogramregister::find()->where(['ApplicationId' => $id])->one();
        $modelEducation = Tblstudeducation::findOne($id);
        $StudWorkingInfo = new Tblstudworkexprience();

        if($id == NULL)
        {
            $model = new Tblapplication();
        }

        else
        {
            $model = Tblapplication::findOne($id);
        }
        
        if(empty($address))
        {
            $address = new Tbladdress();
        }
        
        if(empty($programregister))
        {
            $programregister = new Tblprogramregister();
        }

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if (Yii::$app->request->isAjax && $address->load(Yii::$app->request->post())) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($address);
        }

        if (Yii::$app->request->isAjax && $programregister->load(Yii::$app->request->post())) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($programregister);
        }

        if ($model->load(Yii::$app->request->post())) 
        {
            if($id == NULL)
            {
                $model->AppNo = Yii::$app->common->getApplicationNo();
            }

            if ($model->save()) {
                return $this->redirect(['create', 'id' => base64_encode($model->ApplicationId), 'tab' => 'v-pills-Address']);
            }

            else
            {
                die(print_r($model->getErrors()));
            }
        }

        if ($address->load(Yii::$app->request->post())) 
        {
            $address->AddressId = 0;
            $address->ApplicationId = $model->ApplicationId;

            if ($address->validate() && $address->save()) {
                return $this->redirect(['create', 'id' => base64_encode($model->ApplicationId), 'tab' => 'v-pills-Qualification']);
            }

            else
            {
                return print_r($address->getErrors());
            }
        }

        if ($programregister->load(Yii::$app->request->post())) 
        {
            $programregister->ApplicationId = $model->ApplicationId;
            $programregister->UserId = Yii::$app->user->identity->UserId;

            if ($programregister->validate() && $programregister->save()) {
                return $this->redirect(['create', 'id' => base64_encode($model->ApplicationId), 'tab' => 'v-pills-english']);
            }

            else
            {
                return print_r($programregister->getErrors());
            }
        } 

        else if (Yii::$app->request->isAjax) 
        {
            return $this->renderAjax('personaldetail', [
                'model' => $model
            ]);
        } 
        else 
        {            
            return $this->render('create', [
                'model' => $model, 'address' => $address, 'programregister' => $programregister, 
                'StudWorkingInfo' => $StudWorkingInfo, 'modelEducation' => $modelEducation
            ]);
        }
    }

    public function actionAddqualification()
    {
        $id = base64_decode(Yii::$app->request->get('id', 0));
        $StudEducId = Yii::$app->request->get('studeducid', 0);

        if($StudEducId != NULL)
        {
            $model = Tblstudeducation::findOne($StudEducId);
        }

        else
        {
            $model = new Tblstudeducation();
        }

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) 
        {
            $model->ApplicationId = $id;

            if ($model->save())  
            {
                return $this->redirect(['create', 'id' => base64_encode($model->ApplicationId), 'tab' => 'v-pills-Qualification']);
            }
        }

        else
        {
            return $this->renderAjax('addqualification', ['model' => $model]);
        }
    }

    public function actionAddqualificationsubj()
    {
        $StudEducId = Yii::$app->request->get('studeducid', 0);
        $ApplicationId = Yii::$app->request->get('applicationid', 0);
        $StudEduSubjId = Yii::$app->request->get('studedusubjid', 0);

        if($StudEduSubjId != NULL)
        {
            $model = Tblstudedusubj::findOne($StudEduSubjId);
        }

        else
        {
            $model = new Tblstudedusubj();
        }

        if ($model->load(Yii::$app->request->post())) 
        {
            $model->StudEducId = $StudEducId;
            $model->UserId = Yii::$app->user->identity->UserId;

            if ($model->save()) 
            {
                return $this->redirect(['create', 'id' => $ApplicationId, 'tab' => 'v-pills-Qualification']);
            }
        }

        return $this->renderAjax('addqualificationsubj', ['model' => $model]);
    }

    public function actionNewdocument()
    {
        $ApplicationId = Yii::$app->request->get('id', 0);

        $model = new Tbldocument();
        // $model->scenario = 'fileUpload';
        $model2 = new Tblstudentdocument();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) 
        {
            $file = UploadedFile::getInstance($model, 'file_name');
            $model->DocTypeId = $_POST['Tbldocument']['DocTypeId'];

            if(!empty($file))
            {
                $folder = 'uploads/';
                $file_name = preg_replace('/[^\p{L}0-9_.-]/u', '', str_replace(' ', '_', $file->name));
                $model->file_name = $file_name;
                $model->file_size = $file->size;
                $model->file_type = $file->type;
                $path = $folder . $model->file_name;
            }

            if ($model->save()) 
            {
                $file->saveAs($path);

                $model2->ApplicationId = base64_decode($ApplicationId);
                $model2->DocId = $model->DocId;
                $model2->Description = '-';
                $model2->StatusId = 1;
                $model2->UserId = Yii::$app->user->identity->UserId;

                if ($model2->save()) 
                {
                    return $this->redirect(['create', 'id' => $ApplicationId, 'tab' => 'v-pills-Document']);
                }
            }
        }

        return $this->renderAjax('newdocument', ['model' => $model]);
    }

    public function actionStudeduclist()
    {
        $id = base64_decode(Yii::$app->request->get('id', 0));

        $sql = "SELECT
		tbleducation.EducCode,
		tbleducation.EducName,
		tblstudeducation.StudEducId,
		tblstudeducation.ExamTypeId,
		tblstudeducation.ExamName,
		tblstudeducation.ExamYear,
		tblstudeducation.ExamSchool,
		tblstudeducation.ExamResult,
		tblstudeducation.ExamRemarks,
		tblstudeducation.SchoolAddress
		FROM
		tblstudeducation
		INNER JOIN tbleducation ON tblstudeducation.ExamTypeId = tbleducation.EducLevelId
        WHERE ApplicationId = $id";

        $data = Yii::$app->db->createCommand($sql)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['data' => $data];
    }

    public function actionStudeducsubjlist()
    {
        $id = Yii::$app->request->get('id', 0);

        $sql = "SELECT EduSubject, StudEduSubjId, Result FROM tblstudedusubj
        INNER JOIN tbleducationsubject ON tbleducationsubject.EduSubjId = tblstudedusubj.EduSubjId
        INNER JOIN tblstudeducation ON tblstudeducation.StudEducId = tblstudedusubj.StudEducId
        WHERE tblstudedusubj.StudEducId = $id";

        $data = Yii::$app->db->createCommand($sql)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['data' => $data];
    }

    public function actionStuddocumentlist()
    {
        $id = base64_decode(Yii::$app->request->get('id', 0));

        $sql = "SELECT tbldocument.DocId, DocType, file_name, FullName, tbldocument.TransactionDate
        FROM tbldocument
        INNER JOIN tbldocumenttype ON tbldocumenttype.DocTypeId = tbldocument.DocTypeId
        INNER JOIN tblstudentdocument ON tblstudentdocument.DocId = tbldocument.DocId
        INNER JOIN tbluser ON tbluser.UserId = tblstudentdocument.UserId
        WHERE ApplicationId = $id";

        $data = Yii::$app->db->createCommand($sql)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['data' => $data];
    }

    public function actionViewdocument()
    {    
        $filename = base64_decode(Yii::$app->request->get('fn', 0));
        $file = 'uploads/' . $filename;
    
        if (file_exists($file)) 
        {
            $fileExtension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $allowedExtensions = ['pdf', 'png', 'jpg', 'jpeg'];
    
            if (in_array($fileExtension, $allowedExtensions)) 
            {
                if ($fileExtension === 'pdf') 
                {
                    $contentType = 'application/pdf';
                } 
                else if ($fileExtension === 'png') 
                {
                    $contentType = 'image/png';
                } 
                else if ($fileExtension === 'jpg' || $fileExtension === 'jpeg') 
                {
                    $contentType = 'image/jpeg';
                } 
                else 
                {
                    $contentType = 'application/octet-stream';
                }
    
                header('Content-Description: File Transfer');
                header('Content-Type: ' . $contentType);
                header('Content-Disposition: inline; filename="' . basename($file));
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));
                ob_clean();
                flush();
                return readfile($file);
            } 
            else 
            {
                throw new NotFoundHttpException('The requested file could not be found.');
            }
        } 
        else 
        {
            throw new NotFoundHttpException('The requested file could not be found.');
        }
    }

    /**
     * Updates an existing Tblapplication model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ApplicationId Application ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ApplicationId)
    {
        //$ApplicationId= base64_decode($ApplicationId);

        $model = $this->findModel(base64_decode($ApplicationId));

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ApplicationId' => $model->ApplicationId]);
        }

        //$ApplicationId = Yii::$app->request->get('ApplicationId');
        $address = Tbladdress::findOne(base64_decode($ApplicationId));
        $programregister =  Tblprogramregister::findOne(base64_decode($ApplicationId));

        return $this->render('update', [
            'model' => $model, 'address' => $address, 'programregister' => $programregister
        ]);
    }

    /**
     * Deletes an existing Tblapplication model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $ApplicationId Application ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ApplicationId)
    {
        $this->findModel($ApplicationId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tblapplication model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ApplicationId Application ID
     * @return Tblapplication the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ApplicationId)
    {
        if (($model = Tblapplication::findOne(['ApplicationId' => $ApplicationId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function beforeAction($action)
    {
        if (!isset(Yii::$app->user->identity->UserId)) {
            return Yii::$app->response->redirect(['site/login'])->send();
        }

        return parent::beforeAction($action);
    }
}
