<?php
foreach ($users as $user) {
    unset($user->generated_html);
}
//echo json_encode(compact('users'));
$json_pretty = json_encode(compact('users'), JSON_PRETTY_PRINT);
echo "<pre>" . $json_pretty . "<pre/>";
?>