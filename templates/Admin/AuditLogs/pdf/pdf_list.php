<!DOCTYPE html>
<html>
<head>
<title>PDF</title>
<style>
@page {
    margin: 0px 0px 0px 0px !important;
    padding: 0px 0px 0px 0px !important;
}
.profile{
	padding-top: 30px;
	margin-left: 30px;
	padding-bottom: 30px;
}
.content{
	padding-top: 30px;
	margin-left: 30px;
}
</style>
</head>
<body>
<div class="content">
<table width="100%">
	<tr>
		<td><b>Log ID</b></td>
		<td><b>Activity</b></td>
		<td><b>PK</b></td>
		<td><b>Source</b></td>
		<td><b>Logged on</b></td>
		<td><b>Status</b></td>
	</tr>
	
	<?php foreach ($auditLogs as $auditLog): ?>
	<tr>
		<td><?= $this->Number->format($auditLog->id) ?></td>
		<td><?php echo ($auditLog->type) ?></td>
		<td><?= $auditLog->primary_key === null ? '' : $this->Number->format($auditLog->primary_key) ?></td>
		<td><?= h($auditLog->source) ?></td>
		<td><?php echo date('M d, Y (h:i A)', strtotime($auditLog->created)); ?></td>
		<td>
<?php if($auditLog->status == 1	){
	echo 'Active';
	}else
	echo 'Status';
?>		
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
</body>
</html>