

<?php
foreach ($playgrounds as $playground) {
    unset($playground->generated_html);
}
//echo json_encode(compact('playgrounds'));
$json_pretty = json_encode(compact('playgrounds'), JSON_PRETTY_PRINT);
echo "<pre>" . $json_pretty . "<pre/>";
?>

