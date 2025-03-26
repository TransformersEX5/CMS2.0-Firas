<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\UploadedFile;

use app\models\Tblconvocationdetails;
use app\models\Tblconvocationregister;
use app\models\Tblconvocationimage;

use app\models\FileUploadForm;
use app\models\Tblconvocationstaffdetails;
use app\models\Tblconvocationstaffposition;
use app\models\Tblstudent;
use app\models\Tblbranch;
use app\models\Tbluser;
use yii\helpers\FileHelper;
use yii\bootstrap5\ActiveForm;


class AdminController extends \yii\web\Controller
{
    public $layout = 'mainlayout';

    function getConvodetails()
    {
        $model = Tblconvocationdetails::find()->where(['ConvoStatus' => 1])->one();

        if (empty($model)) {
            $model = Tblconvocationdetails::find()
                ->orderBy(['ConvoYear' => SORT_DESC])
                ->one();
        }

        return $model;
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDetails($convoId)
    {
        $dataConvo = $this->getConvodetails();

        if ($convoId == 0) {
            $model = new Tblconvocationdetails();
        } else {
            $model = Tblconvocationdetails::findOne(['ConvoDetailsId' => $convoId]);
        }

        return $this->renderAjax('details', ['model' => $model, 'convoId' => $convoId, 'dataConvo' => $dataConvo]);
    }

    public function actionStudent()
    {
        return $this->render('student');
    }

    public function actionReturning()
    {
        return $this->render('returning');
    }

    public function actionReturningdetails()
    {
        $mode = 'new';
        $branch = Yii::$app->request->get('branch') ?? 0;
        $programregId = Yii::$app->request->get('programregId') ?? 0;
        $convoregId = Yii::$app->request->get('convoregId');

        $dataConvo = $this->getConvodetails();
        // die($mode);
        if ($convoregId != '') {

            $model = Tblconvocationregister::find()->where(['ConvoRegId' => $convoregId])->one();

            $a = "SELECT tblconvocationregister.StudName, tblconvocationregister.StudNRICPassportNo, tblconvocationregister.StudentNo, 
            tblconvocationregister.ProgramCode, tblconvocationregister.ProgramName, tblstudentstatus.StatusName, 
            tblconvocationregister.ConvoGraduateYear, 
            CASE WHEN tblconvocationregister.AlumniStatusId = 1 THEN 'Registered' ELSE 'Not Registered' END AS AlumniStatus, 
            CASE WHEN tblconvocationregister.ConvoTracerStudy = 1 THEN 'Submitted' ELSE 'Not Submit' END AS TracerStudy, 
            tblconvocationregister.ConvoAttend, tblconvocationregister.Remarks 
            FROM tblconvocationregister
            INNER JOIN tblstudentstatus ON tblstudentstatus.StatusId = tblconvocationregister.StudentStatus
            WHERE ConvoRegId = $convoregId";

            $data = \Yii::$app->db->createCommand($a)->queryAll();
            $mode = 'update';
        } else {

            $stmt = "SELECT tblprogramregister.ProgramRegId, tblstudent.StudName, tblstudent.StudNRICPassportNo, tblstudent.StudentNo, 
            tblstudent.StudEmail AS StudPortalEmail, tblstudent.StudGender, tblstudent.ResidencyId, tblstudent.StudRaceId, tblrace.RaceName, 
            tblstudent.StudNationalityId, tblnationality.NationalityName, tblstudent.StudPassword, tblprogramregstatus.StudentStatus, 
            tblfaculty.FacultyName, tblprogramtype.ProgramTypeName, tblprogram.ProgramCode2 AS ProgramCode, tblprogram.ProgramName2 AS ProgramName, 
            CASE WHEN qtracer.ProgramRegId IS NOT NULL THEN 'Submitted' ELSE 'Not Submit' END AS TracerStudy, tblstudentstatus.StatusName,
            CASE WHEN qcombine.NRICPassportNo = tblstudent.StudNRICPassportNo THEN 'Registered' ELSE 'Not Registered' END AS AlumniStatus
            FROM tblstudent
            INNER JOIN tblprogramregister ON tblprogramregister.StudentId = tblstudent.StudentId
            INNER JOIN tblrace ON tblrace.RaceId = tblstudent.StudRaceId
            INNER JOIN tblnationality ON tblnationality.NationalityId = tblstudent.StudNationalityId
            INNER JOIN tblprogramregstatus ON tblprogramregstatus.ProgramRegId = tblprogramregister.ProgramRegId
            INNER JOIN tblstudentstatus ON tblstudentstatus.StatusId = tblprogramregstatus.StudentStatus
            INNER JOIN tblprogram ON tblprogram.ProgramId = tblprogramregister.ProgramId
            INNER JOIN tblfaculty ON tblfaculty.FacultyId = tblprogram.FacultyId
            INNER JOIN tblprogramtype ON tblprogramtype.ProgramTypeId = tblprogram.ProgramType
            LEFT JOIN 
            (
                SELECT ProgramRegId
                FROM tbltracerstudy
                WHERE ProgramRegId = '$programregId'
            )qtracer ON qtracer.ProgramRegId = tblprogramregister.ProgramRegId
            LEFT JOIN
	    	(
		    	SELECT tblalumnidetails.NRICPassportNo
                FROM tblalumnidetails
                INNER JOIN tblalumnistatus ON tblalumnistatus.NRICPassportNo = tblalumnidetails.NRICPassportNo
                INNER JOIN
                (
                    SELECT NRICPassportNo
                    FROM  
                    (
                        SELECT NRICPassportNo
                        FROM tblalumniworking
                        WHERE Status = 1
                        UNION
                        SELECT NRICPassportNo
                        FROM tblalumninotworking
                        WHERE AlumniStatus = 1
                        UNION
                        SELECT NRICPassportNo
                        FROM tblalumnifurstudy
                        WHERE AlumniStatus = 1
                    )AS combined
                )AS combineddata ON combineddata.NRICPassportNo = tblalumnidetails.NRICPassportNo
                WHERE tblalumnistatus.currentstatus = 1
    		)qcombine ON qcombine.NRICPassportNo = tblstudent.StudNRICPassportNo
            WHERE tblprogramregister.ProgramRegId = '$programregId' AND tblprogramregstatus.CurrentStatus = 1";

            switch ($branch) {
                case 2:
                    $dataFrom = 'odlcitysys';
                    $data = Yii::$app->dbodlcitysys->createCommand($stmt)->queryAll();
                    break;
                case 4:
                    $dataFrom = 'citykk';
                    $data = Yii::$app->dbcitykk->createCommand($stmt)->queryAll();
                    break;
                case 5:
                    $dataFrom = 'cityjb';
                    $data = Yii::$app->dbcityjb->createCommand($stmt)->queryAll();
                    break;
                case 8:
                    $dataFrom = 'clcsys';
                    $data = Yii::$app->dbclcsys->createCommand($stmt)->queryAll();
                    break;
                case 9:
                    $dataFrom = 'academy';
                    $data = Yii::$app->dbacademy->createCommand($stmt)->queryAll();
                    break;
                case 10:
                    $dataFrom = 'acesys';
                    $data = Yii::$app->dbacesys->createCommand($stmt)->queryAll();
                    break;
                case 14:
                    $dataFrom = 'citycoll';
                    $data = Yii::$app->dbcitycoll->createCommand($stmt)->queryAll();
                    break;
                default:
                    $dataFrom = 'citysys';
                    $data = Yii::$app->db->createCommand($stmt)->queryAll();
                    break;
            }
            $model = new Tblconvocationregister();
        }

        if (Yii::$app->request->get('check')) {

            Yii::$app->response->format = Response::FORMAT_JSON;

            if (($mode == 'new')) {
                $model = new Tblconvocationregister();
            }

            $data2 = Yii::$app->request->get('formData');
            $datadecoded = json_decode($data2);
            $arrayData = array();
            $i = 0;

            foreach ($datadecoded as $fieldObject) {
                $arrayData[$i] = $fieldObject->value;
                $i++;
            }

            if ($mode == 'new') {
                $sqlAlumni = "SELECT Email, ContactNo, CorrAddress1, CorrAddress2, CorrPoscode, CorrCity, CorrStateId, CorrContact, PermAddress1, 
                PermAddress2, PermPoscode, PermCity, PermStateId, PermContact 
                FROM tblalumnidetails
                INNER JOIN tblalumnistatus ON tblalumnistatus.NRICPassportNo = tblalumnidetails.NRICPassportNo
                INNER JOIN
                (
                    SELECT NRICPassportNo
                    FROM 
                    (
                        SELECT NRICPassportNo
                        FROM tblalumniworking
                        WHERE NRICPassportNo = '" . $data[0]['StudNRICPassportNo'] . "' AND Status = 1
                        UNION
                        SELECT NRICPassportNo
                        FROM tblalumninotworking
                        WHERE NRICPassportNo = '" . $data[0]['StudNRICPassportNo'] . "' AND AlumniStatus = 1
                        UNION
                        SELECT NRICPassportNo
                        FROM tblalumnifurstudy
                        WHERE NRICPassportNo = '" . $data[0]['StudNRICPassportNo'] . "' AND AlumniStatus = 1
                        )AS combined
                    )AS combineddata ON combineddata.NRICPassportNo = tblalumnidetails.NRICPassportNo
                WHERE tblalumnidetails.NRICPassportNo = '" . $data[0]['StudNRICPassportNo'] . "' AND tblalumnistatus.currentstatus = 1";

                $dataAlumni = \Yii::$app->db->createCommand($sqlAlumni)->queryAll();

                if (!empty($dataAlumni)) {
                    $model->StudEmail = $dataAlumni[0]['Email'];
                    $model->ContactNo = $dataAlumni[0]['ContactNo'];
                    $model->CorrAddress1 = $dataAlumni[0]['CorrAddress1'];
                    $model->CorrAddress2 = $dataAlumni[0]['CorrAddress2'];
                    $model->CorrPostcode = $dataAlumni[0]['CorrPoscode'];
                    $model->CorrCity = $dataAlumni[0]['CorrCity'];
                    $model->CorrStateId = $dataAlumni[0]['CorrStateId'];
                    $model->CorrContact = $dataAlumni[0]['CorrContact'];
                    $model->PermAddress1 = $dataAlumni[0]['PermAddress1'];
                    $model->PermAddress2 = $dataAlumni[0]['PermAddress2'];
                    $model->PermPostcode = $dataAlumni[0]['PermPoscode'];
                    $model->PermCity = $dataAlumni[0]['PermCity'];
                    $model->PermStateId = $dataAlumni[0]['PermStateId'];
                    $model->PermContact = $dataAlumni[0]['PermContact'];
                    $model->AlumniStatusId = 1;
                }
            }

            $model->DataFrom = ($mode == 'new') ? $dataFrom : $model->DataFrom;
            $model->ProgramRegId = ($mode == 'new') ? Yii::$app->request->get('programregId') : $model->ProgramRegId;
            $model->StudName = ($mode == 'new') ? $data[0]['StudName'] : $model->StudName;
            $model->StudNRICPassportNo = ($mode == 'new') ? $data[0]['StudNRICPassportNo'] : $model->StudNRICPassportNo;
            $model->StudentNo = ($mode == 'new') ? $data[0]['StudentNo'] : $model->StudentNo;
            $model->StudPortalEmail = ($mode == 'new') ? $data[0]['StudPortalEmail'] : $model->StudPortalEmail;
            $model->StudGender = ($mode == 'new') ? $data[0]['StudGender'] : $model->StudGender;
            $model->ResidencyId = ($mode == 'new') ? $data[0]['ResidencyId'] : $model->ResidencyId;
            $model->StudRaceId = ($mode == 'new') ? $data[0]['StudRaceId'] : $model->StudRaceId;
            $model->RaceName = ($mode == 'new') ? $data[0]['RaceName'] : $model->RaceName;
            $model->StudNationalityId = ($mode == 'new') ? $data[0]['StudNationalityId'] : $model->StudNationalityId;
            $model->NationalityName = ($mode == 'new') ? $data[0]['NationalityName'] : $model->NationalityName;
            $model->StudPassword = ($mode == 'new') ? $data[0]['StudPassword'] : $model->StudPassword;
            $model->StudentStatus = ($mode == 'new') ? $data[0]['StudentStatus'] : $model->StudentStatus;
            $model->FacultyName = ($mode == 'new') ? $data[0]['FacultyName'] : $model->FacultyName;
            $model->ProgramTypeName = ($mode == 'new') ? $data[0]['ProgramTypeName'] : $model->ProgramTypeName;
            $model->ProgramCode = ($mode == 'new') ? $data[0]['ProgramCode'] : $model->ProgramCode;
            $model->ProgramName = ($mode == 'new') ? $data[0]['ProgramName'] : $model->ProgramName;
            $model->ConvoAttend = $arrayData[1];
            $model->ConvoGraduateYear = ($mode == 'new') ? $dataConvo->ConvoYear : $model->ConvoGraduateYear;
            $model->ConvoReturningStudent = ($mode == 'new') ? 2 : $model->ConvoReturningStudent;
            $model->Remarks = $arrayData[2];

            $model->save();

            return ['ProgramRegId' => $model->ProgramRegId];
        }

        return $this->renderAjax('returningdetails', ['model' => $model, 'data' => $data, 'dataConvo' => $dataConvo]);
    }

    public function actionStudentdetails($convoRegId)
    {
        $dataConvo = $this->getConvodetails();

        $model = Tblconvocationregister::findOne(['ConvoRegId' => $convoRegId]);

        return $this->renderAjax('studentdetails', ['model' => $model, 'convoRegId' => $convoRegId, 'dataConvo' => $dataConvo]);
    }

    public function actionUpload()
    {
        $model = new FileUploadForm();

        return $this->render('upload', ['model' => $model]);
    }

    public function actionUploaddetails($folderId)
    {
        $model = new FileUploadForm();

        if (Yii::$app->request->isPost) {
            $model->fileToUpload = UploadedFile::getInstances($model, 'fileToUpload');

            $uploadPath = Yii::getAlias('images/gallery/' . $folderId);
            if (!is_dir($uploadPath)) {
                FileHelper::createDirectory($uploadPath);
            }

            // if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            //     Yii::$app->response->format = Response::FORMAT_JSON;
            //     return ActiveForm::validate($model);
            // }

            if ($model->upload($uploadPath)) {

                foreach ($model->fileToUpload as $file) {
                    $modelData = new Tblconvocationimage();
                    $modelData->ConvoImageName = $uploadPath . '/' . $file->baseName . '.' . $file->extension;
                    $modelData->ConvoYear = $folderId;
                    $modelData->save();
                }

                $model = new FileUploadForm();
                return $this->redirect('upload');
            }
            // else
            // {
            //     $model->getErrors();
            // }
        }

        return $this->renderAjax('uploaddetails', ['model' => $model]);
    }

    public function actionImage($imageId)
    {
        $model = Tblconvocationimage::findOne(['ConvoImageId' => $imageId]);

        return $this->renderAjax('image', ['model' => $model]);
    }

    public function actionStaff()
    {
        return $this->render('staff');
    }

    public function actionConvocationlist()
    {
        $stmt = "SELECT ConvoDetailsId, DATE_FORMAT(ConvoDate, '%d/%m/%Y') AS ConvoDate, 
        CONCAT(DATE_FORMAT(ConvoTimeStart, '%h:%i %p'), ' - ' , DATE_FORMAT(ConvoTimeEnd, '%h:%i %p')) AS ConvoTime, ConvoVenue, ConvoYear, 
        ConvoEmail, CASE WHEN ConvoStatus = 1 THEN 'Active' ELSE 'Inactive' END AS ConvoStatus
        FROM tblconvocationdetails
        ORDER BY ConvoYear DESC";

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }

    public function actionConvocationdetails()
    {
        $dataConvo = $this->getConvodetails();

        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->request->post('convoId') == 0) {
            $model = new Tblconvocationdetails();
        } else {
            $model = Tblconvocationdetails::findOne(['ConvoDetailsId' => Yii::$app->request->post('convoId')]);
        }

        $data = Yii::$app->request->post('formData');
        $datadecoded = json_decode($data);
        $arrayData = array();
        $i = 0;

        foreach ($datadecoded as $fieldObject) {
            $arrayData[$i] = $fieldObject->value;
            $i++;
        }

        $model->ConvoYear = $arrayData[1];
        $model->ConvoTelNo = $arrayData[2];
        $model->ConvoEmail = $arrayData[3];
        $model->ConvoDate = $arrayData[4];
        $model->ConvoVenue = $arrayData[5];
        $model->ConvoTimeStart = $arrayData[6];
        $model->ConvoTimeEnd = $arrayData[7];
        $model->ConvoFee = $arrayData[8];
        $model->RobeDeposit = $arrayData[9];
        $model->RobeNonReturnFee = $arrayData[10];
        $model->MaxGuests = $arrayData[11];
        $model->ExtraGuestCharge = $arrayData[12];
        $model->ConvoPortalOpen = $arrayData[13];
        $model->ConvoStatus = $arrayData[14];
        $model->BriefDate = $arrayData[15];
        $model->BriefVenue = $arrayData[16];
        $model->BriefTimeStart = $arrayData[17];
        $model->BriefTimeEnd = $arrayData[18];
        $model->RehearsalTime = $arrayData[19];
        $model->RehearsalVenue = $arrayData[20];
        $model->ConvoTracerDateStart = $arrayData[21];
        $model->ConvoTracerDateEnd = $arrayData[22];
        $model->ConvoMOHE = $arrayData[23];

        if ($dataConvo->ConvoStatus == 1) {
            if ($dataConvo->ConvoDetailsId == $model->ConvoDetailsId || $model->ConvoDetailsId == 0 && $arrayData[14] == 2) {
                $model->save();
            } else {
                if ($arrayData[14] == 2) {
                    $model->save();
                } else {
                    die();
                }
            }
        } else {
            $model->save();
        }

        return ['ConvoDetailsId' => $model->ConvoDetailsId];
    }

    public function actionStudentlist()
    {
        $dataConvo = $this->getConvodetails();

        $stmt = "SELECT ConvoRegId, StudName, CASE WHEN ConvoAttend = 1 THEN 'Attend' ELSE 'Not Attend' END AS ConvoAttend, StudNRICPassportNo, 
        StudentNo, CASE WHEN ConvoTracerStudy = 1 THEN 'Submit' ELSE 'Not Submit' END AS ConvoTracerStudy, Robesize, ConvoGraduateYear
        FROM tblconvocationregister
		INNER JOIN tblconvocationrobe ON tblconvocationrobe.RobeId = tblconvocationregister.RobeId
        WHERE ConvoGraduateYear = " . $dataConvo->ConvoYear;

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }

    public function actionStuddetails()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = Tblconvocationregister::findOne(['ConvoRegId' => Yii::$app->request->post('convoRegId')]);

        $data = Yii::$app->request->post('formData');
        $datadecoded = json_decode($data);
        $arrayData = array();
        $i = 0;

        foreach ($datadecoded as $fieldObject) {
            $arrayData[$i] = $fieldObject->value;
            $i++;
        }

        $model->ConvoAttend = $arrayData[1];
        $model->RobeId = $arrayData[2];

        $model->save();

        return ['ConvoRegId' => $model->ConvoRegId];
    }

    public function actionYearlist()
    {
        $year = Yii::$app->request->get('year');

        $stmt = "SELECT
        * 
        FROM tblconvocationimage
        WHERE ConvoYear = " . $year;

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }

    public function actionDeleteimage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = Tblconvocationimage::findOne(['ConvoImageId' => Yii::$app->request->post('imageId')]);

        if (unlink($model->ConvoImageName)) {
            $stmt = "DELETE FROM tblconvocationimage WHERE ConvoImageId = " . Yii::$app->request->post('imageId');

            $data = \Yii::$app->db->createCommand($stmt)->queryAll();
        }
        return true;
    }

    public function actionStafflist()
    {
        $stmt = "SELECT ConvoStaffDetailsId, tbluser.FullName, ConvoStaffEmail, ConvoStaffMobileNo, 
        CASE WHEN tblconvocationstaffdetails.StatusId = 1 THEN 'Active' ELSE 'Inactive' END AS StatusName
        FROM tblconvocationstaffdetails
        INNER JOIN tbluser ON tbluser.UserId = tblconvocationstaffdetails.ConvoUserId
		WHERE tblconvocationstaffdetails.ConvoStaffPositionId = ".Yii::$app->request->get('posId')."
        ORDER BY FullName";

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }

    public function actionStaffdetails()
    {
        $staffId = Yii::$app->request->get('staffId');

        if ($staffId == 0) {
            $model = new Tblconvocationstaffdetails();

            $data = Tblconvocationstaffposition::findOne(['ConvoStaffPositionId' => Yii::$app->request->get('posId')]);
        } else {
            $model = Tblconvocationstaffdetails::findOne(['ConvoStaffDetailsId' => $staffId]);

            $stmt = "SELECT tbluser.FullName, tblconvocationstaffposition.ConvoStaffPosition
            FROM tblconvocationstaffdetails
            INNER JOIN tbluser ON tbluser.UserId = tblconvocationstaffdetails.ConvoUserId
            INNER JOIN tblconvocationstaffposition ON tblconvocationstaffposition.ConvoStaffPositionId = tblconvocationstaffdetails.ConvoStaffPositionId
            WHERE ConvoStaffDetailsId = $staffId";

            $data = Yii::$app->db->createCommand($stmt)->queryAll();
        }
        return $this->renderAjax('staffdetails', ['model' => $model, 'staffId' => $staffId, 'data' => $data]);
    }

    public function actionGetstud()
    {

        $search = Yii::$app->request->get('search');
        $branch = Yii::$app->request->get('branch');

        $stmt = "SELECT tblprogramregister.ProgramRegId, tblstudent.StudName, tblstudent.StudentNo, tblstudent.StudNRICPassportNo
        FROM tblstudent
        INNER JOIN tblprogramregister ON tblprogramregister.StudentId = tblstudent.StudentId
        INNER JOIN tblprogramregstatus ON tblprogramregstatus.ProgramRegId = tblprogramregister.ProgramRegId
        WHERE tblprogramregstatus.StudentStatus = 12 AND tblprogramregstatus.CurrentStatus = 1 
        AND (tblstudent.StudName REGEXP '$search' OR tblstudent.StudNRICPassportNo REGEXP '$search' OR tblstudent.StudentNo REGEXP '$search')
        AND tblstudent.StudName NOT IN (SELECT StudName FROM localsys.tblconvocationregister WHERE ConvoReturningStudent = 2)
        ";

        switch ($branch) {
            case 2:
                $data = Yii::$app->dbodlcitysys->createCommand($stmt)->queryAll();
                break;
            case 4:
                $data = Yii::$app->dbcitykk->createCommand($stmt)->queryAll();
                break;
            case 5:
                $data = Yii::$app->dbcityjb->createCommand($stmt)->queryAll();
                break;
            case 8:
                $data = Yii::$app->dbclcsys->createCommand($stmt)->queryAll();
                break;
            case 9:
                $data = Yii::$app->dbacademy->createCommand($stmt)->queryAll();
                break;
            case 10:
                $data = Yii::$app->dbacesys->createCommand($stmt)->queryAll();
                break;
            case 14:
                $data = Yii::$app->dbcitycoll->createCommand($stmt)->queryAll();
                break;
            default:
                $data = Yii::$app->db->createCommand($stmt)->queryAll();
                break;
        }

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }

    public function actionGetreturningstud()
    {
        $dataConvo = $this->getConvodetails();

        $stmt = "SELECT ConvoRegId, StudName, StudNRICPassportNo, StudentNo, 
        CASE WHEN ConvoAttend = 1 THEN 'Attend' ELSE 'Not Attend' END AS ConvoAttend
        FROM tblconvocationregister
        WHERE ConvoReturningStudent = 2 AND ConvoGraduateYear = $dataConvo->ConvoYear
        ORDER BY TransactionDate";

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
    }

    public function actionConvostaffdetail()
    {
        $mode = 'new';

        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->request->post('staffId') == 0) {
            $model = new Tblconvocationstaffdetails();
        } else {
            $model = Tblconvocationstaffdetails::findOne(['ConvoStaffDetailsId' => Yii::$app->request->post('staffId')]);
            $mode = 'update';
        }

        $data = Yii::$app->request->post('formData');
        $datadecoded = json_decode($data);
        $arrayData = array();
        $i = 0;

        foreach ($datadecoded as $fieldObject) {
            $arrayData[$i] = $fieldObject->value;
            $i++;
        }

        $model->ConvoUserId = ($mode == 'new') ? $arrayData[1] : $model->ConvoUserId;
        $model->ConvoStaffEmail = ($mode == 'new') ? $arrayData[2] : $arrayData[1];
        $model->ConvoStaffMobileNo = ($mode == 'new') ? $arrayData[3] : $arrayData[2];
        $model->ConvoStaffPositionId = ($mode == 'new') ? Yii::$app->request->post('posId') : $model->ConvoStaffPositionId;
        $model->StatusId = ($mode == 'new') ? $arrayData[4] : $arrayData[3];

        $model->save();

        return ['ConvoStaffDetailsId' => $model->ConvoStaffDetailsId];
    }
    public function actionGetstaffdetails()
    {
        $query = "SELECT EmailAddress FROM tbluser WHERE UserId = " . Yii::$app->request->post('userId');

        $data = \Yii::$app->db->createCommand($query)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['EmailAddress' => $data[0]['EmailAddress']];
    }
}
