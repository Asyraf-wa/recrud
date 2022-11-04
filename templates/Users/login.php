<?php echo $this->Html->css('animate.min'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Morphext/2.4.4/morphext.css" integrity="sha256-iwSnUqgAndMlZnwFWAAzto9R/6Un2RBguZEITMb0Olk=" crossorigin="anonymous" />

<!--Header-->
<div class="row mb-3">
	<div class="col-10">
		<h1 class="m-0 me-2 page_title"><?php echo $title; ?></h1>
		<small class="text-muted"><?php echo $system_name; ?></small>
	</div>
	<div class="col-2">
		<div class="text-end">

		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
<div class="card shadow">
	<div class="card-body">
<div class="my-4 text-center">
<b class="gradient-animate-small">&lt;&#47;&gt; <?php echo $system_abbr; ?></b>
</div>

<?= $this->Form->create() ?>
<div class="row">
	<div class="col-md-6">
	<?= $this->Form->control('email', ['required' => true, 'class'=>'form-control', 'autocomplete'=>'off']) ?>
	</div>
	<div class="col-md-6">
	<?= $this->Form->control('password', ['required' => true, 'class'=>'form-control']) ?>
	</div>
</div>
				<div class="text-end">
				  <?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-warning']); ?>
				  <?= $this->Form->button(__('Submit'),['type' => 'submit', 'class' => 'btn btn-outline-primary']) ?>
				  <?= $this->Form->end() ?>
                </div>	
  
<div class="postlink_space">
<?php echo $this->Html->link('Register', ['controller'=>'Users','action'=>'registration']); ?> | 
<?php //echo $this->Html->link('Forgot Username', array('controller'=>'Users','action'=>'forgot_username')); ?>
<?php echo $this->Html->link('Forgot Password', array('controller'=>'Users','action'=>'forgot_password')); ?>
</div>	

<hr>

<div class="btn-grid">
<?php echo $this->Html->link(__('User Manual'), array('controller' => 'pages', 'action' => 'manual'), array('class' => 'btn btn-primary btn-sm', 'escape' => false)); ?> 

<?php echo $this->Html->link(__('Frequently Asked Question'), array('controller' => 'Faqs', 'action' => 'index'), array('class' => 'btn btn-primary btn-sm', 'escape' => false)); ?> 

<?php echo $this->Html->link(__('Contact Us'), array('controller' => 'Contacts', 'action' => 'add'), array('class' => 'btn btn-primary btn-sm', 'escape' => false)); ?> 
</div>
<hr>
<div id="supported" align="center">
<b class="gradient-animate-tiny">&lt;&#47;&gt; <?php echo $system_abbr; ?></b>
&nbsp;&nbsp;&nbsp;
<?php echo $this->Html->link($this->Html->image('ctp.png', 
			  array('alt' => 'Code The Pixel', 'class'=>'gambar',  'width'=>'78px', 'height'=>'22px')) . '' . (''), 'https://codethepixel.com', array('target' => 'blank', 'escape' => false)); ?>
&nbsp;&nbsp;&nbsp;
<?php echo $this->Html->link($this->Html->image('github.png', 
			  array('alt' => 'Github', 'class'=>'gambar',  'width'=>'78px', 'height'=>'22px')) . '' . (''), 'https://github.com/', array('target' => 'blank', 'escape' => false)); ?>
&nbsp;&nbsp;&nbsp;
<?php echo $this->Html->link($this->Html->image('gitlab.png', 
			  array('alt' => 'GitLab', 'class'=>'gambar',  'width'=>'78px', 'height'=>'22px')) . '' . (''), 'https://gitlab.com/', array('target' => 'blank', 'escape' => false)); ?>
</div>

<br><br>
<div class="">
  <p class="text-center"> 
Leading The CRUD Evolution<br>
	<?= $system_name; ?> (<?= $system_abbr; ?>)<br>
	<SCRIPT LANGUAGE="JavaScript">
    today=new Date();
    y0=today.getFullYear();
    </SCRIPT>
    Copyright &copy; 2022-<SCRIPT LANGUAGE="JavaScript">
    document.write(y0);
    </SCRIPT> <?= $system_abbr; ?>. All rights reserved. [V <?= $version; ?>] <br>
<br>
  </p>
</div>

	</div>
</div>
	</div>
	<div class="col-md-6">
<div class="card shadow">
	<div class="card-body">
<div class="my-4 text-center">
<b class="gradient-animate-big">&lt;&#47;&gt;</b>
<div class="crud_tag"><b class="page_title_gradient">Leading The CRUD Evolution</b></div>
</div>

<br>
<div class="justify mb-3">
<?= $system_abbr; ?> is a framework that enables the developer to generate comprehensive Create Read Update Delete Search and Report CRUD components using the <?= $system_abbr; ?> generator. The integrated important features in the CRUD operation enable the code automation for generating web application functions such as  <span id="js-rotating">create, retrieve, update, delete, search, report, authentication, configurations, contact management, FAQ management</span> and comprehensive form helper features. All you need to do is to set your database, then <?= $system_abbr; ?> them!
</div>
<br>
<style>
  .fa-stack { font-size: 3em; }
  i { vertical-align: middle; }
</style>
<div class="row mb-2" align="center">
  <div class="col-md-4">
<span class="fa-stack" style="vertical-align: top;">
  <i class="far fa-circle fa-stack-2x"></i>
  <i class="fab fa-connectdevelop fa-stack-1x"></i>
</span>
<br>RE-CRUD<br>
Integrated &amp; Multi-features 
  </div>
  <div class="col-md-4">
<span class="fa-stack" style="vertical-align: top;">
  <i class="far fa-circle fa-stack-2x"></i>
  <i class="fas fa-unlock-alt fa-stack-1x"></i>
</span>
<br>AUTH READY<br>
Authentication &amp; Authorization
  </div>
  <div class="col-md-4">
<span class="fa-stack" style="vertical-align: top;">
  <i class="far fa-circle fa-stack-2x"></i>
  <i class="fas fa-print fa-stack-1x"></i>
</span>
<br>ENHANCEMENT<br>
Form Features Enrichment
  </div>
</div>
	</div>
</div>
	</div>
</div>



	<script src="https://cdnjs.cloudflare.com/ajax/libs/Morphext/2.4.4/morphext.min.js" integrity="sha256-qG3zvg7/f5CZHwV8IeaQfBY5Hm+M0KR3PMk9lAHp39s=" crossorigin="anonymous"></script>
	<script>
		$("#js-rotating").Morphext({
			animation: "fadeInDown",
			complete: function () {
			console.log("This is called after a phrase is animated in! Current phrase index: " + this.index);
			}
		});
	</script>