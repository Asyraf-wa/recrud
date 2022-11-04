<!DOCTYPE html>
<html>
<head>
<title>PDF</title>
<style>
@page {
    margin: 0px 0px 0px 0px !important;
    padding: 0px 0px 0px 0px !important;
}
.bg {
  background: #FDCD3B;
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
<div class="bg">
	<div class="profile">
<?php if ($user->avatar != NULL) {
	echo $this->Html->image('../files/Users/avatar/' . $user->slug . '/' . $user->avatar,['fullBase' => true, 'class'=> '', 'width'=>'130px', 'height'=>'130px']);
	}else
	echo $this->Html->image('blank_profile.png', ['fullBase' => true, 'class'=> '', 'width'=>'130px', 'height'=>'130px']);
?>
	</div>
</div>
<div class="content">
<?php echo $user->fullname; ?><br/>
<?= h($user->email) ?><br/>
<?= $user->user_group->name; ?><br/>
<?php echo date('M d, Y (h:i A)', strtotime($user->created)); ?><br/>
</div>
</body>
</html>