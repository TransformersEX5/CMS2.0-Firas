<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use app\models\Tblrmcdocument;
?>

<?php foreach ($files as $file): ?>
    <div id="file-<?= htmlspecialchars($file->RMCDocumentId, ENT_QUOTES, 'UTF-8') ?>">
        <p> 
            File:
            <button class="btn btn-link btn-sm" onclick="window.open('<?= Url::to(['upload/view-file', 'fileName' => $file->RMCDocument]) ?>', '_blank')">
                <?= htmlspecialchars($file->RMCDocument, ENT_QUOTES, 'UTF-8') ?>
            </button>
            <button class="btn btn-secondary btn-sm" onclick="window.location.href='<?= Url::to(['upload/download-file', 'fileName' => $file->RMCDocument]) ?>'">Download</button>
            <button class="btn btn-danger btn-sm" onclick="deleteFile('<?= $file->RMCDocumentId ?>')">Remove</button>
        </p>
    </div>
<?php endforeach; ?>

<?php if (empty($files)): ?>
    <p>No files found in the specified path.</p>
<?php endif; ?>

<script>
function deleteFile(fileId) {
    if (confirm('Are you sure you want to delete this file?')) {
        fetch('<?= Url::to(['upload/delete-file']) ?>?id=' + fileId, {
            method: 'POST',
            headers: {
                'X-CSRF-Token': '<?= Yii::$app->request->csrfToken ?>'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('file-' + fileId).remove();
            } else {
                alert('Failed to delete file.');
            }
        });
    }
}
</script>