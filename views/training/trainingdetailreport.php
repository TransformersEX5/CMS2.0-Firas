<?php

namespace app\controllers;

use Yii;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;

use yii\helpers\Url;
?>

<?php

$TrainingId = base64_decode(Yii::$app->request->get('trainingId'));

$training = " SELECT
tbltraining.TrainingId,
tbltraining.TrainingTitle,
tbltraining.TrainingObjective,
tbltraining.TrainingVenue,
tbltraining.TrainerId,
tbltraining.RequestId,
tbltraining.Remarks,
tbltraining.TrainingCategoryId,
tbltraining.TrainingClaimId,
tbltraining.TrainingVenueId,
tbltraining.TrainingGroupId,
tbltraining.TransactionDate,
QTraningDuration.TrainingStart,
QTraningDuration.TrainingEnd,
QTraningDuration.TotHours,
QTraningDuration.TotDays,
tbluser.FullName,
tbltrainingcategory.TrainingCategory,
QTrainingStatus.TrainingStatus,
QTrainingStatus.TrainingStatusId,
COALESCE(QTotAttan.TotStaff,0) AS TotStaff,
tbltrainingclaim.TrainingClaim,
tbltraininggroup.TrainingGroup
FROM
tbltraining
INNER JOIN tbluser ON tbltraining.RequestId = tbluser.UserId
INNER JOIN tbltrainingcategory ON tbltraining.TrainingCategoryId = tbltrainingcategory.TrainingCategoryId
LEFT JOIN (SELECT
tbltrainingduration.TrainingDurationId,
tbltrainingduration.TrainingId,
min(tbltrainingduration.TrainingDate) as TrainingStart,
max(tbltrainingduration.TrainingDate) as TrainingEnd,
Sum(tbltrainingduration.TraningTotHours) as TotHours,
count(tbltrainingduration.TrainingDate) as TotDays
from tbltrainingduration
GROUP BY tbltrainingduration.TrainingId) AS QTraningDuration ON QTraningDuration.TrainingId= tbltraining.TrainingId
LEFT JOIN (SELECT
tbltrainingstatushistory.TrainingId,
tbltrainingstatushistory.Remarks,
tbltrainingstatushistory.TransactionDate,
tbltrainingstatus.TrainingStatus,
tbltrainingstatushistory.TrainingStatusId
FROM
tbltrainingstatushistory
INNER JOIN tbltrainingstatus ON tbltrainingstatushistory.TrainingStatusId = tbltrainingstatus.TrainingStatusId
where tbltrainingstatushistory.CurrentStatusId = 1
) AS QTrainingStatus ON QTrainingStatus.TrainingId= tbltraining.TrainingId
LEFT JOIN (SELECT
tbltrainingattandance.TrainingId,
count(DISTINCT tbltrainingattandance.UserId) as TotStaff
from tbltrainingattandance
GROUP BY tbltrainingattandance.TrainingId) AS QTotAttan ON QTotAttan.TrainingId= tbltraining.TrainingId
INNER JOIN tbltrainingclaim ON tbltraining.TrainingClaimId = tbltrainingclaim.TrainingClaimId
INNER JOIN tbltraininggroup ON tbltraining.TrainingGroupId = tbltraininggroup.TrainingGroupId
where tbltraining.TrainingId = $TrainingId
Group By tbltraining.TrainingId
ORDER BY  tbltraining.TrainingTitle
 ";

$result = Yii::$app->db->createCommand($training)->queryAll();

$data = [];
foreach ($result as $row) {
	// Adjust the column names according to your database schema
	$data[] = [
		// Example column names, replace these with your actual column names
		$row['TrainingTitle'],
		$row['TrainingObjective'],
		$row['TrainingVenue'],
		$row['TrainingStart'],
		$row['TrainingEnd'],
		$row['TotDays'],
		$row['TotHours'],
		$row['TotStaff'],
		$row['TrainingGroup'],
		$row['TrainingCategory'],
		$row['TrainingClaim'],
		$row['TrainingStatus'],
		$row['TransactionDate'],
		$row['Remarks']
	];
}


$stmt = "SELECT 
tbltrainingattandance.TrainingId,
tbluser.UserNo,
tbluser.FullName,
tbldepartment.DepartmentDesc
FROM
tbltrainingattandance
INNER JOIN tbluser ON tbltrainingattandance.UserId = tbluser.UserId
INNER JOIN tbldepartment ON tbluser.DepartmentId = tbldepartment.DepartmentId
where  tbltrainingattandance.TrainingId = $TrainingId
GROUP BY tbltrainingattandance.TrainingId,  tbltrainingattandance.UserId
ORDER BY tbluser.FullName ";

$participant = \Yii::$app->db->createCommand($stmt)->queryAll();

$data2 = [];
foreach ($participant as $row2) {
	// Adjust the column names according to your database schema
	$data2[] = [
		// Example column names, replace these with your actual column names
		$row2['FullName'],
		$row2['DepartmentDesc']
	];
}



$html = '';

$html = '<br><div style="font-size:36px;"><b>Training Detail</b></div><br>';

$html .= "<table width='100%' border='1' class='table'>";
// $html .= "<td>Name</td>";
// $html .= "<td>Email</td>";
// $html .= "<td>UserId</td></tr>";
foreach ($data as $row) {
	$html .= "<tr>";
	$html .= "<td>Training</td>";
	$html .= "<td>" . $row[0] . "</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>Objective</td>";
	$html .= "<td>" . $row[1] . "</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>Venue</td>";
	$html .= "<td>" . $row[2] . "</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>Training Date</td>";
	$html .= "<td>" . $row[3] . " to " . $row[4] . "</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>No of Days</td>";
	$html .= "<td style='text-align:left;'>" . $row[5] . "</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>Total Hours</td>";
	$html .= "<td style='text-align:left;'>" . $row[6] . "</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>No of Paticipant</td>";
	$html .= "<td style='text-align:left;'>" . $row[7] . "</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>Training Group</td>";
	$html .= "<td>" . $row[8] . "</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>Training Category</td>";
	$html .= "<td>" . $row[9] . "</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>Claim</td>";
	$html .= "<td>" . $row[10] . "</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>Status</td>";
	$html .= "<td>" . $row[11] . "</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>Request Date</td>";
	$html .= "<td style='text-align:left;'>" . $row[12] . "</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>Remarks</td>";
	$html .= "<td>" . $row[13] . "</td>";
	$html .= "</tr>";
}

$html .= "</table>";

$html .= "<br><br><br>";

$html .= "<table width='100%' border='1' class='table'>";

$i = 1;

$html .= "<tr>";
$html .= "<td>No.</td>";
$html .= "<td>Participant</td>";
$html .= "<td>Department/Faculty</td>";
$html .= "</tr>";

foreach ($data2 as $row2) {
	$html .= "<tr>";
	$html .= "<td style='text-align:center;'>" . $i . "</td>";
	$html .= "<td>" . $row2[0] . "</td>";
	$html .= "<td>" . $row2[1] . "</td>";
	$html .= "</tr>";

	$i++;
}

$html .= "</table>";

$html .= "<br><br><br>";

$html = trim($html);


if ($html == "") {
	$html = "\n No Record Found!\n";
}


date_default_timezone_set('Asia/Kuala_Lumpur');
$date = date("d-m-Y");
$datetite = date("Ymd");


$header = '<div style="font-size:48px;"><b>List of Training 2023</b></div>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$result[0]['TrainingTitle'] .' Detail Report - '. $datetite . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n\n\n$html";
