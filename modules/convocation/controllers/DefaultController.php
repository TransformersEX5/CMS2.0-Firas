<?php

namespace app\modules\convocation\controllers;

//namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\web\ForbiddenHttpException;

use app\modules\convocation\models\Tblconvocationdetails;
use app\modules\convocation\models\Tblconvocationregister;
use app\modules\convocation\models\Tblconvocationimage;

use app\modules\convocation\models\FileUploadForm;
use app\modules\convocation\models\Tblconvocationstaffdetails;
use app\modules\convocation\models\Tblconvocationstaffposition;
use app\modules\convocation\models\Tblstudent;
use app\modules\convocation\models\Tblbranch;
use app\modules\convocation\models\Tbluser;
use app\modules\convocation\models\Tblefcinvitation;
use yii\helpers\FileHelper;
use yii\bootstrap5\ActiveForm;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * Default controller for the `convocation` module
 */
class DefaultController extends Controller
{

    public $layout = '@app/views/layouts/lexapurple_layouts';

    /**
     * Renders the index view for the module
     * @return string
     */



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
        if (Yii::$app->user->can('Convocation')) {
            return $this->render('index');
        } else {
            throw new ForbiddenHttpException(Yii::t('app', 'Access denied. You do not have permission to access this feature.'));
        }
    }

    public function actionDashboard()
    {
        if (Yii::$app->user->can('Convocation')) {
            $dataConvo = $this->getConvodetails();

            $sql = "SELECT (QConvo.ConfirmSeat + QConvo.NotConfirmSeat) AS TotalRegistration, QConvo.ConfirmSeat, QConvo.NotConfirmSeat, QConvo.TracerSubmit, 
            QConvo.TracerNotSubmit, QConvo.FeePaid, QConvo.FeeUnpaid, QConvo.ResidencyLocal, QConvo.ResidencyInternational
            FROM (
            SELECT 
            SUM(CASE WHEN ConvoConfirmStatus = 1 THEN 1 ELSE 0 END) AS 'ConfirmSeat', 
            SUM(CASE WHEN ConvoConfirmStatus = 2 THEN 1 ELSE 0 END) AS 'NotConfirmSeat', 
            SUM(CASE WHEN ConvoTracerStudy = 1 THEN 1 ELSE 0 END) AS 'TracerSubmit', 
            SUM(CASE WHEN ConvoTracerStudy = 2 THEN 1 ELSE 0 END) AS 'TracerNotSubmit', 
            SUM(CASE WHEN ConvoPaymentStatus = 1 THEN 1 ELSE 0 END) AS 'FeePaid', 
            SUM(CASE WHEN ConvoPaymentStatus = 2 THEN 1 ELSE 0 END) AS 'FeeUnpaid', 
            SUM(CASE WHEN ResidencyId = 1 THEN 1 ELSE 0 END) AS 'ResidencyLocal', 
            SUM(CASE WHEN ResidencyId = 2 THEN 1 ELSE 0 END) AS 'ResidencyInternational' 
            FROM tblconvocationregister 
            WHERE ConvoAttend = 1 AND ConvoGraduateYear = $dataConvo->ConvoYear)QConvo";

            $data = \Yii::$app->db->createCommand($sql)->queryAll();

            $sql2 = "SELECT (ConfirmSeat + NotConfirmSeat) AS AllRegistration, QAll.ConfirmSeat, QAll.NotConfirmSeat, QAll.TracerSubmit, 
            QAll.TracerNotSubmit, QAll.FeePaid, QAll.FeeUnpaid, QAll.ResidencyLocal, QAll.ResidencyInternational FROM (
            SELECT 
            SUM(CASE WHEN ConvoConfirmStatus = 1 THEN 1 ELSE 0 END) AS 'ConfirmSeat', 
            SUM(CASE WHEN ConvoConfirmStatus = 2 THEN 1 ELSE 0 END) AS 'NotConfirmSeat', 
            SUM(CASE WHEN ConvoTracerStudy = 1 THEN 1 ELSE 0 END) AS 'TracerSubmit', 
            SUM(CASE WHEN ConvoTracerStudy = 2 OR ConvoTracerStudy IS NULL THEN 1 ELSE 0 END) AS 'TracerNotSubmit', 
            SUM(CASE WHEN ConvoPaymentStatus = 1 THEN 1 ELSE 0 END) AS 'FeePaid', 
            SUM(CASE WHEN ConvoPaymentStatus = 2 THEN 1 ELSE 0 END) AS 'FeeUnpaid', 
            SUM(CASE WHEN ResidencyId = 1 THEN 1 ELSE 0 END) AS 'ResidencyLocal', 
            SUM(CASE WHEN ResidencyId = 2 THEN 1 ELSE 0 END) AS 'ResidencyInternational' 
            FROM tblconvocationregister 
            WHERE ConvoGraduateYear = $dataConvo->ConvoYear)QAll";

            $data2 = \Yii::$app->db->createCommand($sql2)->queryAll();

            $sql3 = "SELECT CASE WHEN NationalityName IN ('Malaysia', 'Malaysian') THEN 'Malaysian' ELSE NationalityName END AS Nationality, COUNT(*) AS NumberOfStudents
            FROM tblconvocationregister
            WHERE ConvoGraduateYear = $dataConvo->ConvoYear
            GROUP BY Nationality";

            $data3 = \Yii::$app->db->createCommand($sql3)->queryAll();

            $sql4 = "SELECT ProgramTypeName, COUNT(*) AS NumberOfStudents
            FROM tblconvocationregister
            WHERE ConvoGraduateYear = $dataConvo->ConvoYear
            GROUP BY ProgramTypeName
            ORDER BY FIELD(ProgramTypeName,'Diploma', 'Degree', 'Master', 'Doctorate')";

            $data4 = \Yii::$app->db->createCommand($sql4)->queryAll();

            $sql5 = "SELECT FacultyName, ProgramTypeName, COUNT(*) AS NumberOfStudents 
            FROM tblconvocationregister
            WHERE ConvoGraduateYear = $dataConvo->ConvoYear
            GROUP BY FacultyName, ProgramTypeName
            ORDER BY FacultyName";

            $data5 = \Yii::$app->db->createCommand($sql5)->queryAll();

            return $this->render('dashboard', ['data' => $data, 'data2' => $data2, 'data3' => $data3, 'data4' => $data4, 'data5' => $data5]);
        } else {
            throw new ForbiddenHttpException(Yii::t('app', 'Access denied. You do not have permission to access this feature.'));
        }
    }

    public function actionEfcstudentlist()
    {
        $dataConvo = $this->getConvodetails();

        $stmt = "SELECT DataFrom, ProgramRegId, StudName, StudNRICPassportNo, StudentNo, NationalityName, FacultyCode, FacultyName, ProgramCode, ProgramCode2, 
        ProgramName, Robesize, TotalOuts, ConvocationFee, TransactionDate, ConvocationRegisterStatus 
        FROM
        (
        SELECT 'citysys' AS DataFrom, citysys.tblprogramregister.ProgramRegId, citysys.tblstudent.StudName, citysys.tblconvocationregister.StudNRICPassportNo, 
        citysys.tblstudent.StudentNo, citysys.tblstudent.StudEmail, citysys.tblconvocationregister.NationalityName, citysys.tblprogram.ProgramCode, 
        citysys.tblprogram.ProgramCode2, citysys.tblprogram.ProgramName, citysys.tblconvocationrobe.Robesize, 
        FORMAT((citysys.tblprogramregister.AcademicOuts + citysys.tblprogramregister.HostelOuts), 2) AS TotalOuts, 
        FORMAT(qconvocationfee.ConvocationFee, 2) AS ConvocationFee, citysys.tblprogramregstatus.TransactionDate, 
        CONCAT(citysys.tblefcinvitation.TransactionDate, '<br>', citysys.tbluser.FullName) AS SendDate, 
        CASE WHEN citysys.tblconvocationregister.ConvoRegisterStatusId = 1 THEN 'Registered' ELSE 'Not Register' END AS ConvocationRegisterStatus, 
        ConvoRegisterStatusId, citysys.tblfaculty.FacultyCode, citysys.tblfaculty.FacultyName 
        FROM citysys.tblprogramregister 
        INNER JOIN citysys.tblstudent ON citysys.tblstudent.StudentId = citysys.tblprogramregister.StudentId 
        INNER JOIN citysys.tblprogramregstatus ON citysys.tblprogramregstatus.ProgramRegId = citysys.tblprogramregister.ProgramRegId 
        INNER JOIN citysys.tblprogram ON citysys.tblprogram.ProgramId = citysys.tblprogramregister.ProgramId 
        INNER JOIN citysys.tblfaculty ON citysys.tblfaculty.FacultyId = citysys.tblprogram.FacultyId 
        LEFT JOIN 
        ( 
            SELECT ProgramRegId, SUM(qfee.feeamount) AS ConvocationFee 
            FROM 
            ( 
            SELECT citysys.tbl_fee.ProgramRegId, citysys.tbl_fee.feeamount FROM citysys.tbl_fee WHERE citysys.tbl_fee.feetypeid = 27 
            UNION 
            SELECT citysys.tbl_fee.ProgramRegId, citysys.tbl_fee.feeamount FROM citysys.tbl_fee WHERE citysys.tbl_fee.feetypeid = 84 
            )qfee 
        GROUP BY ProgramRegId 
        )qconvocationfee ON qconvocationfee.ProgramRegId = citysys.tblprogramregister.ProgramRegId
        LEFT JOIN citysys.tblefcinvitation ON citysys.tblefcinvitation.ProgramRegId = citysys.tblprogramregister.ProgramRegId
        LEFT JOIN citysys.tbluser ON citysys.tbluser.UserId = citysys.tblefcinvitation.UserId
        LEFT JOIN citysys.tblconvocationregister ON citysys.tblconvocationregister.ProgramRegId = citysys.tblprogramregister.ProgramRegId 
        AND citysys.tblconvocationregister.DataFrom = 'citysys'
        LEFT JOIN citysys.tblconvocationrobe ON citysys.tblconvocationrobe.RobeId = citysys.tblconvocationregister.RobeId
        WHERE citysys.tblprogramregister.CurrentStatus = 1 AND citysys.tblprogramregstatus.CurrentStatus = 1 AND citysys.tblprogramregstatus.StudentStatus = 26 
        AND (citysys.tblefcinvitation.CurrentStatusId = 1 OR citysys.tblefcinvitation.CurrentStatusId IS NULL)
    
        UNION
    
        SELECT 'academy' AS DataFrom, academy.tblprogramregister.ProgramRegId, academy.tblstudent.StudName, citysys.tblconvocationregister.StudNRICPassportNo, 
        academy.tblstudent.StudentNo, academy.tblstudent.StudEmail, citysys.tblconvocationregister.NationalityName, academy.tblprogram.ProgramCode, 
        academy.tblprogram.ProgramCode2, academy.tblprogram.ProgramName, citysys.tblconvocationrobe.Robesize, 
        FORMAT((academy.tblprogramregister.AcademicOuts + academy.tblprogramregister.HostelOuts), 2) AS TotalOuts, 
        FORMAT(qconvocationfee.ConvocationFee, 2) AS ConvocationFee, academy.tblprogramregstatus.TransactionDate, 
        CONCAT(citysys.tblefcinvitation.TransactionDate, '<br>', citysys.tbluser.FullName) AS SendDate, 
        CASE WHEN citysys.tblconvocationregister.ConvoRegisterStatusId = 1 THEN 'Registered' ELSE 'Not Register' END AS ConvocationRegisterStatus, 
        ConvoRegisterStatusId, academy.tblfaculty.FacultyCode, academy.tblfaculty.FacultyName 
        FROM academy.tblprogramregister 
        INNER JOIN academy.tblstudent ON academy.tblstudent.StudentId = academy.tblprogramregister.StudentId 
        INNER JOIN academy.tblprogramregstatus ON academy.tblprogramregstatus.ProgramRegId = academy.tblprogramregister.ProgramRegId 
        INNER JOIN academy.tblprogram ON academy.tblprogram.ProgramId = academy.tblprogramregister.ProgramId 
        INNER JOIN academy.tblfaculty ON academy.tblfaculty.FacultyId = academy.tblprogram.FacultyId 
        LEFT JOIN 
            ( 
            SELECT ProgramRegId, SUM(qfee.feeamount) AS ConvocationFee 
            FROM 
            ( 
                SELECT academy.tbl_fee.ProgramRegId, academy.tbl_fee.feeamount FROM academy.tbl_fee WHERE academy.tbl_fee.feetypeid = 27 
                UNION 
                SELECT academy.tbl_fee.ProgramRegId, academy.tbl_fee.feeamount FROM academy.tbl_fee WHERE academy.tbl_fee.feetypeid = 84 
            )qfee 
        GROUP BY ProgramRegId 
        )qconvocationfee ON qconvocationfee.ProgramRegId = academy.tblprogramregister.ProgramRegId
        LEFT JOIN citysys.tblefcinvitation ON citysys.tblefcinvitation.ProgramRegId = academy.tblprogramregister.ProgramRegId
        LEFT JOIN citysys.tbluser ON citysys.tbluser.UserId = citysys.tblefcinvitation.UserId
        LEFT JOIN citysys.tblconvocationregister ON citysys.tblconvocationregister.ProgramRegId = academy.tblprogramregister.ProgramRegId 
        AND citysys.tblconvocationregister.DataFrom = 'academy'
        LEFT JOIN citysys.tblconvocationrobe ON citysys.tblconvocationrobe.RobeId = citysys.tblconvocationregister.RobeId
        WHERE academy.tblprogramregstatus.CurrentStatus = 1 AND academy.tblprogramregstatus.StudentStatus = 26 AND 
        (citysys.tblefcinvitation.CurrentStatusId = 1 OR citysys.tblefcinvitation.CurrentStatusId IS NULL)
    
        UNION
    
        SELECT 'acesys' AS DataFrom, acesys.tblprogramregister.ProgramRegId, acesys.tblstudent.StudName, acesys.tblstudent.StudentNo, 
        citysys.tblconvocationregister.StudNRICPassportNo, acesys.tblstudent.StudEmail, citysys.tblconvocationregister.NationalityName, 
        acesys.tblprogram.ProgramCode, acesys.tblprogram.ProgramCode2, acesys.tblprogram.ProgramName, citysys.tblconvocationrobe.Robesize, 
        FORMAT((acesys.tblprogramregister.AcademicOuts + acesys.tblprogramregister.HostelOuts), 2) AS TotalOuts, 
        FORMAT(qconvocationfee.ConvocationFee, 2) AS ConvocationFee, acesys.tblprogramregstatus.TransactionDate, 
        CONCAT(citysys.tblefcinvitation.TransactionDate, '<br>', citysys.tbluser.FullName) AS SendDate, 
        CASE WHEN citysys.tblconvocationregister.ConvoRegisterStatusId = 1 THEN 'Registered' ELSE 'Not Register' END AS ConvocationRegisterStatus, 
        ConvoRegisterStatusId, acesys.tblfaculty.FacultyCode, acesys.tblfaculty.FacultyName
        FROM acesys.tblprogramregister 
        INNER JOIN acesys.tblstudent ON acesys.tblstudent.StudentId = acesys.tblprogramregister.StudentId 
        INNER JOIN acesys.tblprogramregstatus ON acesys.tblprogramregstatus.ProgramRegId = acesys.tblprogramregister.ProgramRegId 
        INNER JOIN acesys.tblprogram ON acesys.tblprogram.ProgramId = acesys.tblprogramregister.ProgramId 
        INNER JOIN acesys.tblfaculty ON acesys.tblfaculty.FacultyId = acesys.tblprogram.FacultyId 
        LEFT JOIN 
        ( 
            SELECT ProgramRegId, SUM(qfee.feeamount) AS ConvocationFee 
            FROM 
            ( 
                SELECT acesys.tbl_fee.ProgramRegId, acesys.tbl_fee.feeamount FROM acesys.tbl_fee WHERE acesys.tbl_fee.feetypeid = 27 
                UNION 
                SELECT acesys.tbl_fee.ProgramRegId, acesys.tbl_fee.feeamount FROM acesys.tbl_fee WHERE acesys.tbl_fee.feetypeid = 84 
            )qfee 
        GROUP BY ProgramRegId 
        )qconvocationfee ON qconvocationfee.ProgramRegId = acesys.tblprogramregister.ProgramRegId
        LEFT JOIN citysys.tblefcinvitation ON citysys.tblefcinvitation.ProgramRegId = acesys.tblprogramregister.ProgramRegId
        LEFT JOIN citysys.tbluser ON citysys.tbluser.UserId = citysys.tblefcinvitation.UserId
        LEFT JOIN citysys.tblconvocationregister ON citysys.tblconvocationregister.ProgramRegId = acesys.tblprogramregister.ProgramRegId 
        AND citysys.tblconvocationregister.DataFrom = 'acesys'
        LEFT JOIN citysys.tblconvocationrobe ON citysys.tblconvocationrobe.RobeId = citysys.tblconvocationregister.RobeId
        WHERE acesys.tblprogramregstatus.CurrentStatus = 1 AND acesys.tblprogramregstatus.StudentStatus = 26 AND 
        (citysys.tblefcinvitation.CurrentStatusId = 1 OR citysys.tblefcinvitation.CurrentStatusId IS NULL)
    
        UNION
    
        SELECT 'citycoll' AS DataFrom, citycoll.tblprogramregister.ProgramRegId, citycoll.tblstudent.StudName, citycoll.tblstudent.StudentNo, 
        citysys.tblconvocationregister.StudNRICPassportNo, citycoll.tblstudent.StudEmail, citysys.tblconvocationregister.NationalityName, 
        citycoll.tblprogram.ProgramCode, citycoll.tblprogram.ProgramCode2, citycoll.tblprogram.ProgramName, citysys.tblconvocationrobe.Robesize, 
        FORMAT((citycoll.tblprogramregister.AcademicOuts + citycoll.tblprogramregister.HostelOuts), 2) AS TotalOuts, 
        FORMAT(qconvocationfee.ConvocationFee, 2) AS ConvocationFee, citycoll.tblprogramregstatus.TransactionDate, 
        CONCAT(citysys.tblefcinvitation.TransactionDate, '<br>', citysys.tbluser.FullName) AS SendDate, 
        CASE WHEN citysys.tblconvocationregister.ConvoRegisterStatusId = 1 THEN 'Registered' ELSE 'Not Register' END AS ConvocationRegisterStatus, 
        ConvoRegisterStatusId, citycoll.tblfaculty.FacultyCode, citycoll.tblfaculty.FacultyName
        FROM citycoll.tblprogramregister 
        INNER JOIN citycoll.tblstudent ON citycoll.tblstudent.StudentId = citycoll.tblprogramregister.StudentId 
        INNER JOIN citycoll.tblprogramregstatus ON citycoll.tblprogramregstatus.ProgramRegId = citycoll.tblprogramregister.ProgramRegId 
        INNER JOIN citycoll.tblprogram ON citycoll.tblprogram.ProgramId = citycoll.tblprogramregister.ProgramId 
        INNER JOIN citycoll.tblfaculty ON citycoll.tblfaculty.FacultyId = citycoll.tblprogram.FacultyId 
        LEFT JOIN 
        ( 
            SELECT ProgramRegId, SUM(qfee.feeamount) AS ConvocationFee 
            FROM 
            ( 
            SELECT citycoll.tbl_fee.ProgramRegId, citycoll.tbl_fee.feeamount FROM citycoll.tbl_fee WHERE citycoll.tbl_fee.feetypeid = 27 
            UNION 
            SELECT citycoll.tbl_fee.ProgramRegId, citycoll.tbl_fee.feeamount FROM citycoll.tbl_fee WHERE citycoll.tbl_fee.feetypeid = 84 
            )qfee 
        GROUP BY ProgramRegId 
        )qconvocationfee ON qconvocationfee.ProgramRegId = citycoll.tblprogramregister.ProgramRegId
        LEFT JOIN citysys.tblefcinvitation ON citysys.tblefcinvitation.ProgramRegId = citycoll.tblprogramregister.ProgramRegId
        LEFT JOIN citysys.tbluser ON citysys.tbluser.UserId = citysys.tblefcinvitation.UserId
        LEFT JOIN citysys.tblconvocationregister ON citysys.tblconvocationregister.ProgramRegId = citycoll.tblprogramregister.ProgramRegId 
        AND citysys.tblconvocationregister.DataFrom = 'citycoll'
        LEFT JOIN citysys.tblconvocationrobe ON citysys.tblconvocationrobe.RobeId = citysys.tblconvocationregister.RobeId
        WHERE citycoll.tblprogramregstatus.CurrentStatus = 1 AND citycoll.tblprogramregstatus.StudentStatus = 26 AND 
        (citysys.tblefcinvitation.CurrentStatusId = 1 OR citysys.tblefcinvitation.CurrentStatusId IS NULL)
    
        UNION
    
        SELECT 'cityjb' AS DataFrom, cityjb.tblprogramregister.ProgramRegId, cityjb.tblstudent.StudName, cityjb.tblstudent.StudentNo, 
        citysys.tblconvocationregister.StudNRICPassportNo, cityjb.tblstudent.StudEmail, citysys.tblconvocationregister.NationalityName, 
        cityjb.tblprogram.ProgramCode, cityjb.tblprogram.ProgramCode2, cityjb.tblprogram.ProgramName, citysys.tblconvocationrobe.Robesize, 
        FORMAT((cityjb.tblprogramregister.AcademicOuts + cityjb.tblprogramregister.HostelOuts), 2) AS TotalOuts, 
        FORMAT(qconvocationfee.ConvocationFee, 2) AS ConvocationFee, cityjb.tblprogramregstatus.TransactionDate, 
        CONCAT(citysys.tblefcinvitation.TransactionDate, '<br>', citysys.tbluser.FullName) AS SendDate, 
        CASE WHEN citysys.tblconvocationregister.ConvoRegisterStatusId = 1 THEN 'Registered' ELSE 'Not Register' END AS ConvocationRegisterStatus, 
        ConvoRegisterStatusId, cityjb.tblfaculty.FacultyCode, cityjb.tblfaculty.FacultyName
        FROM cityjb.tblprogramregister 
        INNER JOIN cityjb.tblstudent ON cityjb.tblstudent.StudentId = cityjb.tblprogramregister.StudentId 
        INNER JOIN cityjb.tblprogramregstatus ON cityjb.tblprogramregstatus.ProgramRegId = cityjb.tblprogramregister.ProgramRegId 
        INNER JOIN cityjb.tblprogram ON cityjb.tblprogram.ProgramId = cityjb.tblprogramregister.ProgramId 
        INNER JOIN cityjb.tblfaculty ON cityjb.tblfaculty.FacultyId = cityjb.tblprogram.FacultyId 
        LEFT JOIN 
        ( 
            SELECT ProgramRegId, SUM(qfee.feeamount) AS ConvocationFee 
            FROM 
            ( 
                SELECT cityjb.tbl_fee.ProgramRegId, cityjb.tbl_fee.feeamount FROM cityjb.tbl_fee WHERE cityjb.tbl_fee.feetypeid = 27 
                UNION 
                SELECT cityjb.tbl_fee.ProgramRegId, cityjb.tbl_fee.feeamount FROM cityjb.tbl_fee WHERE cityjb.tbl_fee.feetypeid = 84 
            )qfee 
            GROUP BY ProgramRegId 
        )qconvocationfee ON qconvocationfee.ProgramRegId = cityjb.tblprogramregister.ProgramRegId
        LEFT JOIN citysys.tblefcinvitation ON citysys.tblefcinvitation.ProgramRegId = cityjb.tblprogramregister.ProgramRegId
        LEFT JOIN citysys.tbluser ON citysys.tbluser.UserId = citysys.tblefcinvitation.UserId
        LEFT JOIN citysys.tblconvocationregister ON citysys.tblconvocationregister.ProgramRegId = cityjb.tblprogramregister.ProgramRegId 
        AND citysys.tblconvocationregister.DataFrom = 'cityjb'
        LEFT JOIN citysys.tblconvocationrobe ON citysys.tblconvocationrobe.RobeId = citysys.tblconvocationregister.RobeId
        WHERE cityjb.tblprogramregstatus.CurrentStatus = 1 AND cityjb.tblprogramregstatus.StudentStatus = 26 AND 
        (citysys.tblefcinvitation.CurrentStatusId = 1 OR citysys.tblefcinvitation.CurrentStatusId IS NULL)
    
        UNION

        SELECT 'citykk' AS DataFrom, citykk.tblprogramregister.ProgramRegId, citykk.tblstudent.StudName, citykk.tblstudent.StudentNo, 
        citysys.tblconvocationregister.StudNRICPassportNo, citykk.tblstudent.StudEmail, citysys.tblconvocationregister.NationalityName, 
        citykk.tblprogram.ProgramCode, citykk.tblprogram.ProgramCode2, citykk.tblprogram.ProgramName, citysys.tblconvocationrobe.Robesize, 
        FORMAT((citykk.tblprogramregister.AcademicOuts + citykk.tblprogramregister.HostelOuts), 2) AS TotalOuts, 
        FORMAT(qconvocationfee.ConvocationFee, 2) AS ConvocationFee, citykk.tblprogramregstatus.TransactionDate, 
        CONCAT(citysys.tblefcinvitation.TransactionDate, '<br>', citysys.tbluser.FullName) AS SendDate, 
        CASE WHEN citysys.tblconvocationregister.ConvoRegisterStatusId = 1 THEN 'Registered' ELSE 'Not Register' END AS ConvocationRegisterStatus, 
        ConvoRegisterStatusId, citykk.tblfaculty.FacultyCode, citykk.tblfaculty.FacultyName
        FROM citykk.tblprogramregister 
        INNER JOIN citykk.tblstudent ON citykk.tblstudent.StudentId = citykk.tblprogramregister.StudentId 
        INNER JOIN citykk.tblprogramregstatus ON citykk.tblprogramregstatus.ProgramRegId = citykk.tblprogramregister.ProgramRegId 
        INNER JOIN citykk.tblprogram ON citykk.tblprogram.ProgramId = citykk.tblprogramregister.ProgramId 
        INNER JOIN citykk.tblfaculty ON citykk.tblfaculty.FacultyId = citykk.tblprogram.FacultyId 
        LEFT JOIN 
        ( 
            SELECT ProgramRegId, SUM(qfee.feeamount) AS ConvocationFee 
            FROM 
            ( 
                SELECT citykk.tbl_fee.ProgramRegId, citykk.tbl_fee.feeamount FROM citykk.tbl_fee WHERE citykk.tbl_fee.feetypeid = 27 
                UNION 
                SELECT citykk.tbl_fee.ProgramRegId, citykk.tbl_fee.feeamount FROM citykk.tbl_fee WHERE citykk.tbl_fee.feetypeid = 84 
            )qfee 
            GROUP BY ProgramRegId 
        )qconvocationfee ON qconvocationfee.ProgramRegId = citykk.tblprogramregister.ProgramRegId
        LEFT JOIN citysys.tblefcinvitation ON citysys.tblefcinvitation.ProgramRegId = citykk.tblprogramregister.ProgramRegId
        LEFT JOIN citysys.tbluser ON citysys.tbluser.UserId = citysys.tblefcinvitation.UserId
        LEFT JOIN citysys.tblconvocationregister ON citysys.tblconvocationregister.ProgramRegId = citykk.tblprogramregister.ProgramRegId 
        AND citysys.tblconvocationregister.DataFrom = 'citykk'
        LEFT JOIN citysys.tblconvocationrobe ON citysys.tblconvocationrobe.RobeId = citysys.tblconvocationregister.RobeId
        WHERE citykk.tblprogramregstatus.CurrentStatus = 1 AND citykk.tblprogramregstatus.StudentStatus = 26 AND 
        (citysys.tblefcinvitation.CurrentStatusId = 1 OR citysys.tblefcinvitation.CurrentStatusId IS NULL)
    
        UNION
    
        SELECT 'clcsys' AS DataFrom, clcsys.tblprogramregister.ProgramRegId, clcsys.tblstudent.StudName, clcsys.tblstudent.StudentNo, 
        citysys.tblconvocationregister.StudNRICPassportNo, clcsys.tblstudent.StudEmail, citysys.tblconvocationregister.NationalityName, 
        clcsys.tblprogram.ProgramCode, clcsys.tblprogram.ProgramCode2, clcsys.tblprogram.ProgramName, citysys.tblconvocationrobe.Robesize, 
        FORMAT((clcsys.tblprogramregister.AcademicOuts + clcsys.tblprogramregister.HostelOuts), 2) AS TotalOuts, 
        FORMAT(qconvocationfee.ConvocationFee, 2) AS ConvocationFee, clcsys.tblprogramregstatus.TransactionDate, 
        CONCAT(citysys.tblefcinvitation.TransactionDate, '<br>', citysys.tbluser.FullName) AS SendDate, 
        CASE WHEN citysys.tblconvocationregister.ConvoRegisterStatusId = 1 THEN 'Registered' ELSE 'Not Register' END AS ConvocationRegisterStatus, 
        ConvoRegisterStatusId, clcsys.tblfaculty.FacultyCode, clcsys.tblfaculty.FacultyName
        FROM clcsys.tblprogramregister 
        INNER JOIN clcsys.tblstudent ON clcsys.tblstudent.StudentId = clcsys.tblprogramregister.StudentId 
        INNER JOIN clcsys.tblprogramregstatus ON clcsys.tblprogramregstatus.ProgramRegId = clcsys.tblprogramregister.ProgramRegId 
        INNER JOIN clcsys.tblprogram ON clcsys.tblprogram.ProgramId = clcsys.tblprogramregister.ProgramId 
        INNER JOIN clcsys.tblfaculty ON clcsys.tblfaculty.FacultyId = clcsys.tblprogram.FacultyId 
        LEFT JOIN 
        ( 
            SELECT ProgramRegId, SUM(qfee.feeamount) AS ConvocationFee 
            FROM 
            ( 
                SELECT clcsys.tbl_fee.ProgramRegId, clcsys.tbl_fee.feeamount FROM clcsys.tbl_fee WHERE clcsys.tbl_fee.feetypeid = 27 
                UNION 
                SELECT clcsys.tbl_fee.ProgramRegId, clcsys.tbl_fee.feeamount FROM clcsys.tbl_fee WHERE clcsys.tbl_fee.feetypeid = 84 
            )qfee 
            GROUP BY ProgramRegId 
        )qconvocationfee ON qconvocationfee.ProgramRegId = clcsys.tblprogramregister.ProgramRegId
        LEFT JOIN citysys.tblefcinvitation ON citysys.tblefcinvitation.ProgramRegId = clcsys.tblprogramregister.ProgramRegId
        LEFT JOIN citysys.tbluser ON citysys.tbluser.UserId = citysys.tblefcinvitation.UserId
        LEFT JOIN citysys.tblconvocationregister ON citysys.tblconvocationregister.ProgramRegId = clcsys.tblprogramregister.ProgramRegId 
        AND citysys.tblconvocationregister.DataFrom = 'clcsys'
        LEFT JOIN citysys.tblconvocationrobe ON citysys.tblconvocationrobe.RobeId = citysys.tblconvocationregister.RobeId
        WHERE clcsys.tblprogramregstatus.CurrentStatus = 1 AND clcsys.tblprogramregstatus.StudentStatus = 26 AND 
        (citysys.tblefcinvitation.CurrentStatusId = 1 OR citysys.tblefcinvitation.CurrentStatusId IS NULL)

        UNION
    
        SELECT 'odlcitysys' AS DataFrom, odlcitysys.tblprogramregister.ProgramRegId, odlcitysys.tblstudent.StudName, odlcitysys.tblstudent.StudentNo, 
        citysys.tblconvocationregister.StudNRICPassportNo, odlcitysys.tblstudent.StudEmail, citysys.tblconvocationregister.NationalityName, 
        odlcitysys.tblprogram.ProgramCode, odlcitysys.tblprogram.ProgramCode2, odlcitysys.tblprogram.ProgramName, citysys.tblconvocationrobe.Robesize, 
        FORMAT((odlcitysys.tblprogramregister.AcademicOuts + odlcitysys.tblprogramregister.HostelOuts), 2) AS TotalOuts, 
        FORMAT(qconvocationfee.ConvocationFee, 2) AS ConvocationFee, odlcitysys.tblprogramregstatus.TransactionDate, 
        CONCAT(citysys.tblefcinvitation.TransactionDate, '<br>', citysys.tbluser.FullName) AS SendDate, 
        CASE WHEN citysys.tblconvocationregister.ConvoRegisterStatusId = 1 THEN 'Registered' ELSE 'Not Register' END AS ConvocationRegisterStatus, 
        ConvoRegisterStatusId, odlcitysys.tblfaculty.FacultyCode, odlcitysys.tblfaculty.FacultyName
        FROM odlcitysys.tblprogramregister 
        INNER JOIN odlcitysys.tblstudent ON odlcitysys.tblstudent.StudentId = odlcitysys.tblprogramregister.StudentId 
        INNER JOIN odlcitysys.tblprogramregstatus ON odlcitysys.tblprogramregstatus.ProgramRegId = odlcitysys.tblprogramregister.ProgramRegId 
        INNER JOIN odlcitysys.tblprogram ON odlcitysys.tblprogram.ProgramId = odlcitysys.tblprogramregister.ProgramId 
        INNER JOIN odlcitysys.tblfaculty ON odlcitysys.tblfaculty.FacultyId = odlcitysys.tblprogram.FacultyId 
        LEFT JOIN 
        ( 
            SELECT ProgramRegId, SUM(qfee.feeamount) AS ConvocationFee 
            FROM 
            ( 
                SELECT odlcitysys.tbl_fee.ProgramRegId, odlcitysys.tbl_fee.feeamount FROM odlcitysys.tbl_fee WHERE odlcitysys.tbl_fee.feetypeid = 27 
                UNION 
                SELECT odlcitysys.tbl_fee.ProgramRegId, odlcitysys.tbl_fee.feeamount FROM odlcitysys.tbl_fee WHERE odlcitysys.tbl_fee.feetypeid = 84 
            )qfee 
            GROUP BY ProgramRegId 
        )qconvocationfee ON qconvocationfee.ProgramRegId = odlcitysys.tblprogramregister.ProgramRegId
        LEFT JOIN citysys.tblefcinvitation ON citysys.tblefcinvitation.ProgramRegId = odlcitysys.tblprogramregister.ProgramRegId
        LEFT JOIN citysys.tbluser ON citysys.tbluser.UserId = citysys.tblefcinvitation.UserId
        LEFT JOIN citysys.tblconvocationregister ON citysys.tblconvocationregister.ProgramRegId = odlcitysys.tblprogramregister.ProgramRegId 
        AND citysys.tblconvocationregister.DataFrom = 'odlcitysys'
        LEFT JOIN citysys.tblconvocationrobe ON citysys.tblconvocationrobe.RobeId = citysys.tblconvocationregister.RobeId
        WHERE odlcitysys.tblprogramregstatus.CurrentStatus = 1 AND odlcitysys.tblprogramregstatus.StudentStatus = 26 AND 
        (citysys.tblefcinvitation.CurrentStatusId = 1 OR citysys.tblefcinvitation.CurrentStatusId IS NULL)

        UNION

        SELECT 'Returning Student' AS DataFrom, tblconvocationregister.ProgramRegId, StudName, tblconvocationregister.StudentNo, StudNRICPassportNo, StudPortalEmail, 
        NationalityName, 
        tblprogram.ProgramCode, ProgramCode2, tblprogram.ProgramName, Robesize, 
        FORMAT((tblprogramregister.AcademicOuts + tblprogramregister.HostelOuts), 2) AS TotalOuts, FORMAT(qconvocationfee.ConvocationFee, 2) AS ConvocationFee, 
        tblprogramregstatus.TransactionDate, '' AS SendDate, 
        CASE WHEN tblconvocationregister.ConvoRegisterStatusId = 1 THEN 'Registered' ELSE 'Not Register' END AS ConvocationRegisterStatus, ConvoRegisterStatusId, 
        FacultyCode, tblfaculty.FacultyName 
        FROM tblconvocationregister 
        INNER JOIN tblprogramregister ON tblprogramregister.ProgramRegId = tblconvocationregister.ProgramRegId 
        INNER JOIN tblprogramregstatus ON tblprogramregstatus.ProgramRegId = tblprogramregister.ProgramRegId 
        INNER JOIN tblprogram ON tblprogram.ProgramId = tblprogramregister.ProgramId 
        INNER JOIN tblfaculty ON tblfaculty.FacultyId = tblprogram.FacultyId 
        LEFT JOIN tblconvocationrobe ON tblconvocationrobe.RobeId = tblconvocationregister.RobeId 
        LEFT JOIN 
        ( 
            SELECT ProgramRegId, SUM(qfee.feeamount) AS ConvocationFee 
            FROM 
            ( 
                SELECT tbl_fee.ProgramRegId, tbl_fee.feeamount FROM tbl_fee WHERE tbl_fee.feetypeid = 27 
                UNION 
                SELECT tbl_fee.ProgramRegId, tbl_fee.feeamount FROM tbl_fee WHERE tbl_fee.feetypeid = 84 
            )qfee 
        GROUP BY ProgramRegId 
        )qconvocationfee ON qconvocationfee.ProgramRegId = tblprogramregister.ProgramRegId
        WHERE tblprogramregister.CurrentStatus = 1 AND tblprogramregstatus.CurrentStatus = 1 AND tblprogramregstatus.StudentStatus = 12 AND ConvoReturningStudent = 2 
        AND ConvoGraduateYear = $dataConvo->ConvoYear
        )qEFCList
        ORDER BY DataFrom, TransactionDate";

        $data = \Yii::$app->db->createCommand($stmt)->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['data' => $data];
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
        if (Yii::$app->user->can('Convocation')) {
            return $this->render('student');
        } else {
            throw new ForbiddenHttpException(Yii::t('app', 'Access denied. You do not have permission to access this feature.'));
        }
    }

    public function actionReturning()
    {
        if (Yii::$app->user->can('Convocation')) {
            return $this->render('returning');
        } else {
            throw new ForbiddenHttpException(Yii::t('app', 'Access denied. You do not have permission to access this feature.'));
        }
    }

    public function actionInvitationletter()
    {
        if (Yii::$app->user->can('Convocation') || Yii::$app->user->can('Convocation-Exam')) {
            $stmt = "SELECT DataFrom, ProgramRegId, StudName, StudentNo, CONCAT(StudentNo, '<br>', ConvocationRegisterStatus) AS StudentRegister, StudEmail, ProgramCode, 
            ProgramName, TotalOuts, ConvocationFee, TransactionDate, SendDate 
            FROM
            (
            SELECT 'citysys' AS DataFrom, citysys.tblprogramregister.ProgramRegId, citysys.tblstudent.StudName, citysys.tblstudent.StudentNo, citysys.tblstudent.StudEmail, 
            citysys.tblprogram.ProgramCode, citysys.tblprogram.ProgramName, 
            FORMAT((citysys.tblprogramregister.AcademicOuts + citysys.tblprogramregister.HostelOuts), 2) AS TotalOuts, 
            FORMAT(qconvocationfee.ConvocationFee, 2) AS ConvocationFee, citysys.tblprogramregstatus.TransactionDate, 
            CONCAT(citysys.tblefcinvitation.TransactionDate, '<br>', citysys.tbluser.FullName) AS SendDate, 
            CASE WHEN citysys.tblconvocationregister.ConvoRegisterStatusId = 1 THEN 'Registered' ELSE 'Not Register' END AS ConvocationRegisterStatus 
            FROM citysys.tblprogramregister 
            INNER JOIN citysys.tblstudent ON citysys.tblstudent.StudentId = citysys.tblprogramregister.StudentId 
            INNER JOIN citysys.tblprogramregstatus ON citysys.tblprogramregstatus.ProgramRegId = citysys.tblprogramregister.ProgramRegId 
            INNER JOIN citysys.tblprogram ON citysys.tblprogram.ProgramId = citysys.tblprogramregister.ProgramId 
            LEFT JOIN 
            ( 
            SELECT ProgramRegId, SUM(qfee.feeamount) AS ConvocationFee FROM ( 
            SELECT citysys.tbl_fee.ProgramRegId, citysys.tbl_fee.feeamount FROM citysys.tbl_fee WHERE citysys.tbl_fee.feetypeid = 27 
            UNION 
            SELECT citysys.tbl_fee.ProgramRegId, citysys.tbl_fee.feeamount FROM citysys.tbl_fee WHERE citysys.tbl_fee.feetypeid = 84 
            )qfee 
            GROUP BY ProgramRegId 
            )qconvocationfee ON qconvocationfee.ProgramRegId = citysys.tblprogramregister.ProgramRegId
            LEFT JOIN citysys.tblefcinvitation ON citysys.tblefcinvitation.ProgramRegId = citysys.tblprogramregister.ProgramRegId
            LEFT JOIN citysys.tbluser ON citysys.tbluser.UserId = citysys.tblefcinvitation.UserId
            LEFT JOIN citysys.tblconvocationregister ON citysys.tblconvocationregister.ProgramRegId = citysys.tblprogramregister.ProgramRegId 
            AND citysys.tblconvocationregister.DataFrom = 'citysys'
            WHERE citysys.tblprogramregister.CurrentStatus = 1 AND citysys.tblprogramregstatus.CurrentStatus = 1 AND citysys.tblprogramregstatus.StudentStatus = 26 
            AND (citysys.tblefcinvitation.CurrentStatusId = 1 OR citysys.tblefcinvitation.CurrentStatusId IS NULL)
    
            UNION
    
            SELECT 'academy' AS DataFrom, academy.tblprogramregister.ProgramRegId, academy.tblstudent.StudName, academy.tblstudent.StudentNo, academy.tblstudent.StudEmail, 
            academy.tblprogram.ProgramCode, academy.tblprogram.ProgramName, 
            FORMAT((academy.tblprogramregister.AcademicOuts + academy.tblprogramregister.HostelOuts), 2) AS TotalOuts, 
            FORMAT(qconvocationfee.ConvocationFee, 2) AS ConvocationFee, academy.tblprogramregstatus.TransactionDate, 
            CONCAT(citysys.tblefcinvitation.TransactionDate, '<br>', citysys.tbluser.FullName) AS SendDate, 
            CASE WHEN citysys.tblconvocationregister.ConvoRegisterStatusId = 1 THEN 'Registered' ELSE 'Not Register' END AS ConvocationRegisterStatus 
            FROM academy.tblprogramregister 
            INNER JOIN academy.tblstudent ON academy.tblstudent.StudentId = academy.tblprogramregister.StudentId 
            INNER JOIN academy.tblprogramregstatus ON academy.tblprogramregstatus.ProgramRegId = academy.tblprogramregister.ProgramRegId 
            INNER JOIN academy.tblprogram ON academy.tblprogram.ProgramId = academy.tblprogramregister.ProgramId 
            LEFT JOIN 
            ( 
            SELECT ProgramRegId, SUM(qfee.feeamount) AS ConvocationFee FROM ( 
            SELECT academy.tbl_fee.ProgramRegId, academy.tbl_fee.feeamount FROM academy.tbl_fee WHERE academy.tbl_fee.feetypeid = 27 
            UNION 
            SELECT academy.tbl_fee.ProgramRegId, academy.tbl_fee.feeamount FROM academy.tbl_fee WHERE academy.tbl_fee.feetypeid = 84 
            )qfee 
            GROUP BY ProgramRegId 
            )qconvocationfee ON qconvocationfee.ProgramRegId = academy.tblprogramregister.ProgramRegId
            LEFT JOIN citysys.tblefcinvitation ON citysys.tblefcinvitation.ProgramRegId = academy.tblprogramregister.ProgramRegId
            LEFT JOIN citysys.tbluser ON citysys.tbluser.UserId = citysys.tblefcinvitation.UserId
            LEFT JOIN citysys.tblconvocationregister ON citysys.tblconvocationregister.ProgramRegId = academy.tblprogramregister.ProgramRegId 
            AND citysys.tblconvocationregister.DataFrom = 'academy'
            WHERE academy.tblprogramregstatus.CurrentStatus = 1 AND academy.tblprogramregstatus.StudentStatus = 26 AND 
            (citysys.tblefcinvitation.CurrentStatusId = 1 OR citysys.tblefcinvitation.CurrentStatusId IS NULL)
    
            UNION
    
            SELECT 'acesys' AS DataFrom, acesys.tblprogramregister.ProgramRegId, acesys.tblstudent.StudName, acesys.tblstudent.StudentNo, acesys.tblstudent.StudEmail, 
            acesys.tblprogram.ProgramCode, acesys.tblprogram.ProgramName, 
            FORMAT((acesys.tblprogramregister.AcademicOuts + acesys.tblprogramregister.HostelOuts), 2) AS TotalOuts, 
            FORMAT(qconvocationfee.ConvocationFee, 2) AS ConvocationFee, acesys.tblprogramregstatus.TransactionDate, 
            CONCAT(citysys.tblefcinvitation.TransactionDate, '<br>', citysys.tbluser.FullName) AS SendDate, 
            CASE WHEN citysys.tblconvocationregister.ConvoRegisterStatusId = 1 THEN 'Registered' ELSE 'Not Register' END AS ConvocationRegisterStatus 
            FROM acesys.tblprogramregister 
            INNER JOIN acesys.tblstudent ON acesys.tblstudent.StudentId = acesys.tblprogramregister.StudentId 
            INNER JOIN acesys.tblprogramregstatus ON acesys.tblprogramregstatus.ProgramRegId = acesys.tblprogramregister.ProgramRegId 
            INNER JOIN acesys.tblprogram ON acesys.tblprogram.ProgramId = acesys.tblprogramregister.ProgramId 
            LEFT JOIN 
            ( 
            SELECT ProgramRegId, SUM(qfee.feeamount) AS ConvocationFee FROM ( 
            SELECT acesys.tbl_fee.ProgramRegId, acesys.tbl_fee.feeamount FROM acesys.tbl_fee WHERE acesys.tbl_fee.feetypeid = 27 
            UNION 
            SELECT acesys.tbl_fee.ProgramRegId, acesys.tbl_fee.feeamount FROM acesys.tbl_fee WHERE acesys.tbl_fee.feetypeid = 84 
            )qfee 
            GROUP BY ProgramRegId 
            )qconvocationfee ON qconvocationfee.ProgramRegId = acesys.tblprogramregister.ProgramRegId
            LEFT JOIN citysys.tblefcinvitation ON citysys.tblefcinvitation.ProgramRegId = acesys.tblprogramregister.ProgramRegId
            LEFT JOIN citysys.tbluser ON citysys.tbluser.UserId = citysys.tblefcinvitation.UserId
            LEFT JOIN citysys.tblconvocationregister ON citysys.tblconvocationregister.ProgramRegId = acesys.tblprogramregister.ProgramRegId 
            AND citysys.tblconvocationregister.DataFrom = 'acesys'
            WHERE acesys.tblprogramregstatus.CurrentStatus = 1 AND acesys.tblprogramregstatus.StudentStatus = 26 AND 
            (citysys.tblefcinvitation.CurrentStatusId = 1 OR citysys.tblefcinvitation.CurrentStatusId IS NULL)
    
            UNION
    
            SELECT 'citycoll' AS DataFrom, citycoll.tblprogramregister.ProgramRegId, citycoll.tblstudent.StudName, citycoll.tblstudent.StudentNo, 
            citycoll.tblstudent.StudEmail, citycoll.tblprogram.ProgramCode, citycoll.tblprogram.ProgramName, 
            FORMAT((citycoll.tblprogramregister.AcademicOuts + citycoll.tblprogramregister.HostelOuts), 2) AS TotalOuts, 
            FORMAT(qconvocationfee.ConvocationFee, 2) AS ConvocationFee, citycoll.tblprogramregstatus.TransactionDate, 
            CONCAT(citysys.tblefcinvitation.TransactionDate, '<br>', citysys.tbluser.FullName) AS SendDate, 
            CASE WHEN citysys.tblconvocationregister.ConvoRegisterStatusId = 1 THEN 'Registered' ELSE 'Not Register' END AS ConvocationRegisterStatus 
            FROM citycoll.tblprogramregister 
            INNER JOIN citycoll.tblstudent ON citycoll.tblstudent.StudentId = citycoll.tblprogramregister.StudentId 
            INNER JOIN citycoll.tblprogramregstatus ON citycoll.tblprogramregstatus.ProgramRegId = citycoll.tblprogramregister.ProgramRegId 
            INNER JOIN citycoll.tblprogram ON citycoll.tblprogram.ProgramId = citycoll.tblprogramregister.ProgramId 
            LEFT JOIN 
            ( 
            SELECT ProgramRegId, SUM(qfee.feeamount) AS ConvocationFee FROM ( 
            SELECT citycoll.tbl_fee.ProgramRegId, citycoll.tbl_fee.feeamount FROM citycoll.tbl_fee WHERE citycoll.tbl_fee.feetypeid = 27 
            UNION 
            SELECT citycoll.tbl_fee.ProgramRegId, citycoll.tbl_fee.feeamount FROM citycoll.tbl_fee WHERE citycoll.tbl_fee.feetypeid = 84 
            )qfee 
            GROUP BY ProgramRegId 
            )qconvocationfee ON qconvocationfee.ProgramRegId = citycoll.tblprogramregister.ProgramRegId
            LEFT JOIN citysys.tblefcinvitation ON citysys.tblefcinvitation.ProgramRegId = citycoll.tblprogramregister.ProgramRegId
            LEFT JOIN citysys.tbluser ON citysys.tbluser.UserId = citysys.tblefcinvitation.UserId
            LEFT JOIN citysys.tblconvocationregister ON citysys.tblconvocationregister.ProgramRegId = citycoll.tblprogramregister.ProgramRegId 
            AND citysys.tblconvocationregister.DataFrom = 'citycoll'
            WHERE citycoll.tblprogramregstatus.CurrentStatus = 1 AND citycoll.tblprogramregstatus.StudentStatus = 26 AND 
            (citysys.tblefcinvitation.CurrentStatusId = 1 OR citysys.tblefcinvitation.CurrentStatusId IS NULL)
    
            UNION
    
            SELECT 'cityjb' AS DataFrom, cityjb.tblprogramregister.ProgramRegId, cityjb.tblstudent.StudName, cityjb.tblstudent.StudentNo, cityjb.tblstudent.StudEmail, 
            cityjb.tblprogram.ProgramCode, cityjb.tblprogram.ProgramName, 
            FORMAT((cityjb.tblprogramregister.AcademicOuts + cityjb.tblprogramregister.HostelOuts), 2) AS TotalOuts, 
            FORMAT(qconvocationfee.ConvocationFee, 2) AS ConvocationFee, cityjb.tblprogramregstatus.TransactionDate, 
            CONCAT(citysys.tblefcinvitation.TransactionDate, '<br>', citysys.tbluser.FullName) AS SendDate, 
            CASE WHEN citysys.tblconvocationregister.ConvoRegisterStatusId = 1 THEN 'Registered' ELSE 'Not Register' END AS ConvocationRegisterStatus 
            FROM cityjb.tblprogramregister 
            INNER JOIN cityjb.tblstudent ON cityjb.tblstudent.StudentId = cityjb.tblprogramregister.StudentId 
            INNER JOIN cityjb.tblprogramregstatus ON cityjb.tblprogramregstatus.ProgramRegId = cityjb.tblprogramregister.ProgramRegId 
            INNER JOIN cityjb.tblprogram ON cityjb.tblprogram.ProgramId = cityjb.tblprogramregister.ProgramId 
            LEFT JOIN 
            ( 
            SELECT ProgramRegId, SUM(qfee.feeamount) AS ConvocationFee FROM ( 
            SELECT cityjb.tbl_fee.ProgramRegId, cityjb.tbl_fee.feeamount FROM cityjb.tbl_fee WHERE cityjb.tbl_fee.feetypeid = 27 
            UNION 
            SELECT cityjb.tbl_fee.ProgramRegId, cityjb.tbl_fee.feeamount FROM cityjb.tbl_fee WHERE cityjb.tbl_fee.feetypeid = 84 
            )qfee 
            GROUP BY ProgramRegId 
            )qconvocationfee ON qconvocationfee.ProgramRegId = cityjb.tblprogramregister.ProgramRegId
            LEFT JOIN citysys.tblefcinvitation ON citysys.tblefcinvitation.ProgramRegId = cityjb.tblprogramregister.ProgramRegId
            LEFT JOIN citysys.tbluser ON citysys.tbluser.UserId = citysys.tblefcinvitation.UserId
            LEFT JOIN citysys.tblconvocationregister ON citysys.tblconvocationregister.ProgramRegId = cityjb.tblprogramregister.ProgramRegId 
            AND citysys.tblconvocationregister.DataFrom = 'cityjb'
            WHERE cityjb.tblprogramregstatus.CurrentStatus = 1 AND cityjb.tblprogramregstatus.StudentStatus = 26 AND 
            (citysys.tblefcinvitation.CurrentStatusId = 1 OR citysys.tblefcinvitation.CurrentStatusId IS NULL)
    
            UNION
    
            SELECT 'citykk' AS DataFrom, citykk.tblprogramregister.ProgramRegId, citykk.tblstudent.StudName, citykk.tblstudent.StudentNo, citykk.tblstudent.StudEmail, 
            citykk.tblprogram.ProgramCode, citykk.tblprogram.ProgramName, 
            FORMAT((citykk.tblprogramregister.AcademicOuts + citykk.tblprogramregister.HostelOuts), 2) AS TotalOuts, 
            FORMAT(qconvocationfee.ConvocationFee, 2) AS ConvocationFee, citykk.tblprogramregstatus.TransactionDate, 
            CONCAT(citysys.tblefcinvitation.TransactionDate, '<br>', citysys.tbluser.FullName) AS SendDate, 
            CASE WHEN citysys.tblconvocationregister.ConvoRegisterStatusId = 1 THEN 'Registered' ELSE 'Not Register' END AS ConvocationRegisterStatus 
            FROM citykk.tblprogramregister 
            INNER JOIN citykk.tblstudent ON citykk.tblstudent.StudentId = citykk.tblprogramregister.StudentId 
            INNER JOIN citykk.tblprogramregstatus ON citykk.tblprogramregstatus.ProgramRegId = citykk.tblprogramregister.ProgramRegId 
            INNER JOIN citykk.tblprogram ON citykk.tblprogram.ProgramId = citykk.tblprogramregister.ProgramId 
            LEFT JOIN 
            ( 
            SELECT ProgramRegId, SUM(qfee.feeamount) AS ConvocationFee FROM ( 
            SELECT citykk.tbl_fee.ProgramRegId, citykk.tbl_fee.feeamount FROM citykk.tbl_fee WHERE citykk.tbl_fee.feetypeid = 27 
            UNION 
            SELECT citykk.tbl_fee.ProgramRegId, citykk.tbl_fee.feeamount FROM citykk.tbl_fee WHERE citykk.tbl_fee.feetypeid = 84 
            )qfee 
            GROUP BY ProgramRegId 
            )qconvocationfee ON qconvocationfee.ProgramRegId = citykk.tblprogramregister.ProgramRegId
            LEFT JOIN citysys.tblefcinvitation ON citysys.tblefcinvitation.ProgramRegId = citykk.tblprogramregister.ProgramRegId
            LEFT JOIN citysys.tbluser ON citysys.tbluser.UserId = citysys.tblefcinvitation.UserId
            LEFT JOIN citysys.tblconvocationregister ON citysys.tblconvocationregister.ProgramRegId = citykk.tblprogramregister.ProgramRegId 
            AND citysys.tblconvocationregister.DataFrom = 'citykk'
            WHERE citykk.tblprogramregstatus.CurrentStatus = 1 AND citykk.tblprogramregstatus.StudentStatus = 26 AND 
            (citysys.tblefcinvitation.CurrentStatusId = 1 OR citysys.tblefcinvitation.CurrentStatusId IS NULL)
    
            UNION
    
            SELECT 'clcsys' AS DataFrom, clcsys.tblprogramregister.ProgramRegId, clcsys.tblstudent.StudName, clcsys.tblstudent.StudentNo, clcsys.tblstudent.StudEmail, 
            clcsys.tblprogram.ProgramCode, clcsys.tblprogram.ProgramName, 
            FORMAT((clcsys.tblprogramregister.AcademicOuts + clcsys.tblprogramregister.HostelOuts), 2) AS TotalOuts, 
            FORMAT(qconvocationfee.ConvocationFee, 2) AS ConvocationFee, clcsys.tblprogramregstatus.TransactionDate, 
            CONCAT(citysys.tblefcinvitation.TransactionDate, '<br>', citysys.tbluser.FullName) AS SendDate, 
            CASE WHEN citysys.tblconvocationregister.ConvoRegisterStatusId = 1 THEN 'Registered' ELSE 'Not Register' END AS ConvocationRegisterStatus 
            FROM clcsys.tblprogramregister 
            INNER JOIN clcsys.tblstudent ON clcsys.tblstudent.StudentId = clcsys.tblprogramregister.StudentId 
            INNER JOIN clcsys.tblprogramregstatus ON clcsys.tblprogramregstatus.ProgramRegId = clcsys.tblprogramregister.ProgramRegId 
            INNER JOIN clcsys.tblprogram ON clcsys.tblprogram.ProgramId = clcsys.tblprogramregister.ProgramId 
            LEFT JOIN 
            ( 
            SELECT ProgramRegId, SUM(qfee.feeamount) AS ConvocationFee FROM ( 
            SELECT clcsys.tbl_fee.ProgramRegId, clcsys.tbl_fee.feeamount FROM clcsys.tbl_fee WHERE clcsys.tbl_fee.feetypeid = 27 
            UNION 
            SELECT clcsys.tbl_fee.ProgramRegId, clcsys.tbl_fee.feeamount FROM clcsys.tbl_fee WHERE clcsys.tbl_fee.feetypeid = 84 
            )qfee 
            GROUP BY ProgramRegId 
            )qconvocationfee ON qconvocationfee.ProgramRegId = clcsys.tblprogramregister.ProgramRegId
            LEFT JOIN citysys.tblefcinvitation ON citysys.tblefcinvitation.ProgramRegId = clcsys.tblprogramregister.ProgramRegId
            LEFT JOIN citysys.tbluser ON citysys.tbluser.UserId = citysys.tblefcinvitation.UserId
            LEFT JOIN citysys.tblconvocationregister ON citysys.tblconvocationregister.ProgramRegId = clcsys.tblprogramregister.ProgramRegId 
            AND citysys.tblconvocationregister.DataFrom = 'clcsys'
            WHERE clcsys.tblprogramregstatus.CurrentStatus = 1 AND clcsys.tblprogramregstatus.StudentStatus = 26 AND 
            (citysys.tblefcinvitation.CurrentStatusId = 1 OR citysys.tblefcinvitation.CurrentStatusId IS NULL)
    
            UNION
    
            SELECT 'odlcitysys' AS DataFrom, odlcitysys.tblprogramregister.ProgramRegId, odlcitysys.tblstudent.StudName, odlcitysys.tblstudent.StudentNo, 
            odlcitysys.tblstudent.StudEmail, odlcitysys.tblprogram.ProgramCode, odlcitysys.tblprogram.ProgramName, 
            FORMAT((odlcitysys.tblprogramregister.AcademicOuts + odlcitysys.tblprogramregister.HostelOuts), 2) AS TotalOuts, 
            FORMAT(qconvocationfee.ConvocationFee, 2) AS ConvocationFee, odlcitysys.tblprogramregstatus.TransactionDate, 
            CONCAT(citysys.tblefcinvitation.TransactionDate, '<br>', citysys.tbluser.FullName) AS SendDate, 
            CASE WHEN citysys.tblconvocationregister.ConvoRegisterStatusId = 1 THEN 'Registered' ELSE 'Not Register' END AS ConvocationRegisterStatus 
            FROM odlcitysys.tblprogramregister 
            INNER JOIN odlcitysys.tblstudent ON odlcitysys.tblstudent.StudentId = odlcitysys.tblprogramregister.StudentId 
            INNER JOIN odlcitysys.tblprogramregstatus ON odlcitysys.tblprogramregstatus.ProgramRegId = odlcitysys.tblprogramregister.ProgramRegId 
            INNER JOIN odlcitysys.tblprogram ON odlcitysys.tblprogram.ProgramId = odlcitysys.tblprogramregister.ProgramId 
            LEFT JOIN 
            ( 
            SELECT ProgramRegId, SUM(qfee.feeamount) AS ConvocationFee FROM ( 
            SELECT odlcitysys.tbl_fee.ProgramRegId, odlcitysys.tbl_fee.feeamount FROM odlcitysys.tbl_fee WHERE odlcitysys.tbl_fee.feetypeid = 27 
            UNION 
            SELECT odlcitysys.tbl_fee.ProgramRegId, odlcitysys.tbl_fee.feeamount FROM odlcitysys.tbl_fee WHERE odlcitysys.tbl_fee.feetypeid = 84 
            )qfee 
            GROUP BY ProgramRegId 
            )qconvocationfee ON qconvocationfee.ProgramRegId = odlcitysys.tblprogramregister.ProgramRegId
            LEFT JOIN citysys.tblefcinvitation ON citysys.tblefcinvitation.ProgramRegId = odlcitysys.tblprogramregister.ProgramRegId
            LEFT JOIN citysys.tbluser ON citysys.tbluser.UserId = citysys.tblefcinvitation.UserId
            LEFT JOIN citysys.tblconvocationregister ON citysys.tblconvocationregister.ProgramRegId = odlcitysys.tblprogramregister.ProgramRegId 
            AND citysys.tblconvocationregister.DataFrom = 'odlcitysys'
            WHERE odlcitysys.tblprogramregstatus.CurrentStatus = 1 AND odlcitysys.tblprogramregstatus.StudentStatus = 26 AND 
            (citysys.tblefcinvitation.CurrentStatusId = 1 OR citysys.tblefcinvitation.CurrentStatusId IS NULL)
            )qEFCList
            ORDER BY DataFrom, TransactionDate";

            $data = \Yii::$app->db->createCommand($stmt)->queryAll();

            if (Yii::$app->request->isAjax) {

                Yii::$app->response->format = Response::FORMAT_JSON;

                return ['data' => $data];
            } else {
                return $this->render('invitationletter', ['data' => $data]);
            }
        } else {
            throw new ForbiddenHttpException(Yii::t('app', 'Access denied. You do not have permission to access this feature.'));
        }
        return $this->render('index');
    }

    public function actionSendemail()
    {
        $ProgramRegId = base64_decode(Yii::$app->request->post('ProgramRegId'));
        $DataFrom = base64_decode(Yii::$app->request->post('DataFrom'));
        $StudName = base64_decode(Yii::$app->request->post('StudName'));
        $StudentNo = base64_decode(Yii::$app->request->post('StudentNo'));
        $StudEmail = base64_decode(Yii::$app->request->post('StudEmail'));
        $ProgramName = base64_decode(Yii::$app->request->post('ProgramName'));
        $ConvocationFee = base64_decode(Yii::$app->request->post('ConvocationFee'));

        $day = date('j'); // Day of the month without leading zeros
        $month = date('F'); // Full textual representation of the month
        $year = date('Y'); // Four-digit representation of the year

        // Add superscript for the day
        if ($day % 10 == 1 && $day != 11) {
            $day .= '<sup>st</sup>';
        } elseif ($day % 10 == 2 && $day != 12) {
            $day .= '<sup>nd</sup>';
        } elseif ($day % 10 == 3 && $day != 13) {
            $day .= '<sup>rd</sup>';
        } else {
            $day .= '<sup>th</sup>';
        }

        $date =  str_pad($day, 3, '0', STR_PAD_LEFT) . " $month $year";

        $message = "Our Ref: CITYU/RD/CONVOCATION2023/" . $StudentNo . "<br>";
        $message .= "Date: " . $date . "<br><br><br>";

        $message .= $StudName . "<br>";
        $message .= $ProgramName . "<br>";
        $message .= $StudentNo . "<br><br><br>";

        $message .= "Dear Graduand,<br><br>";
        $message .= "<b>CONVOCATION CEREMONY INVITATION 2023</b><br><br>";
        $message .= "Congratulations! We are thrilled to invite you to attend the City University Convocation Ceremony 2023. This ceremony marks the culmination of your hard work and dedication, and we are honored to celebrate your academic achievements with you.<br><br>";

        $message .= "Find out about important dates, times, and logistics for the Convocation Ceremony below:<br><br>";

        $message .= "<b>Date: 20th July 2024, Saturday</b><br>";
        $message .= "<b>Time: 8:00 am – 5:00 pm</b><br>";
        $message .= "<b>Venue: Dewan Merdeka, World Trade Centre Kuala Lumpur (WTCKL)</b><br>";
        $message .= "<b>Dress code: Formal Attire/National Attire/Traditional Attire</b><br>";
        $message .= "<b>Fee: RM " . $ConvocationFee . "</b><br><br>";

        $message .= "Kindly note to <b><u>register</u></b> and to collect your <b><u>Convocation Robes</u></b> at the designated venue and time:<br><br>";

        $message .= "<b>Date: 19th July 2024, Friday</b><br>";
        $message .= "<b>Time: 10:00 am – 5:00 pm</b><br>";
        $message .= "<b>Venue: Bilik Kuala Lumpur, World Trade Centre Kuala Lumpur (WTCKL)</b><br>";
        $message .= "<b>Deposit: RM100.00 (Refundable)</b><br>";
        $message .= "<b>Rehearsal: 3:00 pm at Dewan Merdeka, Level 4, World Trade Centre Kuala Lumpur (WTCKL) – Attendance is COMPULSARY</b><br><br>";

        $message .= "Please visit our Convocation website or <b><u>https://apps.city.edu.my/convocation</u></b> for the online registration. You are also required to fill up the <b><i>“Kajian Pengesanan Graduan (Tracer Study)”</i></b> conducted by the <i>Ministry of Higher Education (MOHE)</i> for the year 2023 via the website <b><u><i>https://graduan.mohe.gov.my/SKPG24/</i></u></b> from 20th May 2024 until 13th July 2024.<br><br>";

        $message .= "You may forward your inquiries via email to <b><u><i>convocation2023@city.edu.my</i></u></b> for assistance or call us at +603-7949 1653.<br><br>";

        $message .= "We look forward to celebrating your success with you at the Convocation Ceremony!<br><br><br>";

        $message .= "This letter is computer generated and no signature is required.<br>";

        $subject_mail   = 'Convocation Ceremony 2023 Invitation Letter - ' . date('Y-m-d H:i:s');
        // $setToEmail     = 'muhdfiqhree.mahmud@city.edu.my';
        $setToEmail     = $StudEmail;

        $setToName      = $StudName;

        $emailContent = $this->renderPartial("@app/mail/layouts/invitationletter", ["content" => $message]);

        $email =  Yii::$app->mailer_convocation->compose();
        $email->setTo([$setToEmail => $setToName]);

        //base on user login   user ->email
        $email->setFrom(['convocation2023@city.edu.my' => 'convocation 2023']);
        $email->setSubject($subject_mail);

        $email->setHtmlBody($emailContent);

        $email->setBcc(['adila.ahmad@city.edu.my' => 'ADILA BINTI AHMAD NAZRI']);

        // Path to the image file on your server
        $imagePath = Yii::getAlias('@webroot/image/city_logo_white.png');
        $imagePath2 = Yii::getAlias('@webroot/image/invitation_footer.png');
        // Attach the image or logo file to the email
        // for image name ..no need the ext type "city_logo_white" only ..not this "city_logo_white.jpg" 
        $email->attach($imagePath, ['fileName' => 'city_logo_white']);
        $email->attach($imagePath2, ['fileName' => 'invitation_footer']);

        if ($email->Send()) {

            // Clear the recipient after sending (for security reasons)
            $email->setTo([]); // Clear the recipient address

            Tblefcinvitation::updateAll(['CurrentStatusId' => 0], ['DataFrom' => $DataFrom, 'ProgramRegId' => $ProgramRegId]);

            $model = new Tblefcinvitation();

            $model->DataFrom = $DataFrom;
            $model->ProgramRegId = $ProgramRegId;
            $model->UserId = Yii::$app->user->identity->UserId;

            if ($model->save()) {
                Yii::$app->session->setFlash('success', "Record Successfully email.");
            }
        } else {

            Yii::$app->session->setFlash('error', 'Error while sending email: ' . $email->ErrorInfo);
            // Yii::$app->getSession()->setFlash('error', 'Error while sending email: ' . $email->ErrorInfo);
        }

        return true;
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
        if (Yii::$app->user->can('Convocation')) {
            $model = new FileUploadForm();

            return $this->render('upload', ['model' => $model]);
        } else {
            throw new ForbiddenHttpException(Yii::t('app', 'Access denied. You do not have permission to access this feature.'));
        }
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
        if (Yii::$app->user->can('Convocation')) {
            return $this->render('staff');
        } else {
            throw new ForbiddenHttpException(Yii::t('app', 'Access denied. You do not have permission to access this feature.'));
        }
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
        $model->ConvoPortalOpen = $arrayData[12];
        $model->ConvoStatus = $arrayData[13];
        $model->BriefDate = $arrayData[14];
        $model->BriefVenue = $arrayData[15];
        $model->BriefTimeStart = $arrayData[16];
        $model->BriefTimeEnd = $arrayData[17];
        $model->RehearsalTime = $arrayData[18];
        $model->RehearsalVenue = $arrayData[19];
        $model->ConvoTracerDateStart = $arrayData[20];
        $model->ConvoTracerDateEnd = $arrayData[21];
        $model->ConvoMOHE = $arrayData[22];

        if ($dataConvo->ConvoStatus == 1) {
            if ($dataConvo->ConvoDetailsId == $model->ConvoDetailsId || $model->ConvoDetailsId == 0 && $arrayData[13] == 2) {
                $model->save();
            } else {
                if ($arrayData[13] == 2) {
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
        WHERE ConvoGraduateYear = $dataConvo->ConvoYear
        ORDER BY ConvoDateRegister ASC";

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
		WHERE tblconvocationstaffdetails.ConvoStaffPositionId = " . Yii::$app->request->get('posId') . "
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
        AND tblstudent.StudName NOT IN (SELECT StudName FROM citysys.tblconvocationregister WHERE ConvoReturningStudent = 2)
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
