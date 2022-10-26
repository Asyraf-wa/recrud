<?php
	use Cake\Routing\Router;
	echo $this->Html->css('select2/css/select2.css');
	echo $this->Html->script('select2/js/select2.full.min.js');
	echo $this->Html->css('jquery.datetimepicker.min.css');
	echo $this->Html->script('jquery.datetimepicker.full.js');
	echo $this->Html->script('https://cdn.jsdelivr.net/npm/apexcharts');
	echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js');
	$c_name = $this->request->getParam('controller');
	echo $this->Html->script('bootstrapModal', ['block' => 'scriptBottom']);
?>
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
		<div class="special_card mb-3">
		  <div class="profile-card js-profile-card shadow">
			<div class="profile-card__img shadow" style="background-color: #dc3545;color: #ffffff;">
			  <i class="fa-solid fa-question fa-xl" style="margin-left: 16px;margin-top: 21px;"></i> General
			</div>
				<div class="card-body small-text pt-0">
<?php foreach ($general as $faq): ?>		
<a href="#<?= ($faq->category) . ($faq->id) ?>" class="" data-bs-toggle="collapse" aria-controls="<?= ($faq->category) . ($faq->id) ?>"><i class="far fa-plus-square"></i> <?= h($faq->question) ?><br></a>
<div class="collapse" id="<?= ($faq->category) . ($faq->id) ?>">
    <?= ($faq->answer) ?>
</div>
<?php endforeach; ?>
				</div>
		  </div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="special_card mb-3">
		  <div class="profile-card js-profile-card shadow">
			<div class="profile-card__img shadow" style="background-color: #dc3545;color: #ffffff;">
			  <i class="fa-solid fa-question fa-xl" style="margin-left: 16px;margin-top: 21px;"></i> Account
			</div>
				<div class="card-body small-text pt-0">
<?php foreach ($account as $faq): ?>		
<a href="#<?= ($faq->category) . ($faq->id) ?>" class="" data-bs-toggle="collapse" aria-controls="<?= ($faq->category) . ($faq->id) ?>"><i class="far fa-plus-square"></i> <?= h($faq->question) ?><br></a>
<div class="collapse" id="<?= ($faq->category) . ($faq->id) ?>">
    <?= ($faq->answer) ?>
</div>
<?php endforeach; ?>
				</div>
		  </div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="special_card mb-3">
		  <div class="profile-card js-profile-card shadow">
			<div class="profile-card__img shadow" style="background-color: #dc3545;color: #ffffff;">
			  <i class="fa-solid fa-question fa-xl" style="margin-left: 16px;margin-top: 21px;"></i> Others
			</div>
				<div class="card-body small-text pt-0">
<?php foreach ($other as $faq): ?>		
<a href="#<?= ($faq->category) . ($faq->id) ?>" class="" data-bs-toggle="collapse" aria-controls="<?= ($faq->category) . ($faq->id) ?>"><i class="far fa-plus-square"></i> <?= h($faq->question) ?><br></a>
<div class="collapse" id="<?= ($faq->category) . ($faq->id) ?>">
    <?= ($faq->answer) ?>
</div>
<?php endforeach; ?>
				</div>
		  </div>
		</div>
	</div>
</div>