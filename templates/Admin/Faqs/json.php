

<?php
foreach ($faqs as $faq) {
    unset($faq->generated_html);
}
//echo json_encode(compact('faqs'));
$json_pretty = json_encode(compact('faqs'), JSON_PRETTY_PRINT);
echo "<pre>" . $json_pretty . "<pre/>";
?>

