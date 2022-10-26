<!DOCTYPE html>
<html>
<head>
<title>PDF</title>
<style>
@page {
    margin: 0px 0px 0px 0px !important;
    padding: 0px 0px 0px 0px !important;
}
</style>
</head>
<body>
<?php foreach ($users as $user): ?>
<?= h($user->fullname) ?><br>
<?php endforeach; ?>
</body>
</html>