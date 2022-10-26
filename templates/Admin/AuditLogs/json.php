

<?php
foreach ($auditLogs as $auditLog) {
    unset($auditLog->generated_html);
}
//echo json_encode(compact('auditLogs'));
$json_pretty = json_encode(compact('auditLogs'), JSON_PRETTY_PRINT);
echo "<pre>" . $json_pretty . "<pre/>";
?>

