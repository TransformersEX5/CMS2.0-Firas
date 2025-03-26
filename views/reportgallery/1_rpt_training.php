<?php
set_time_limit(600);
ini_set("memory_limit","256M");

define('_MPDF_URI','../'); 	// must be  a relative or absolute URI - not a file system path
define('_MPDF_PATH', '../');

define("_TTF_FONT_NORMAL", 'arial.ttf');
define("_TTF_FONT_BOLD", 'arialbd.ttf');

$vendorPath = Yii::getAlias('@vendor');
require_once $vendorPath . '/autoload.php';

$mpdf = new \Mpdf\Mpdf();

?>


<?php 

// Include the autoload.php file

$html = ' <table class="table table-bordered table-hover" width="100%" cellspacing="0" border=1>
<tr>
  <th>Company</th>
  <th>Contact</th>
  <th>Country</th>
</tr>
<tr>
  <td>Alfreds Futterkiste</td>
  <td>Maria Anders</td>
  <td>Germany</td>
</tr>
<tr>
  <td>Centro comercial Moctezuma</td>
  <td>Francisco Chang</td>
  <td>Mexico</td>
</tr>
</table>
';

$mpdf->WriteHTML($html);

$mpdf->Output(); exit;

//$mpdf->Output('test.pdf','D'); exit;

$s = $mpdf->Output('','S');  echo nl2br(htmlspecialchars($s));  exit;


exit;