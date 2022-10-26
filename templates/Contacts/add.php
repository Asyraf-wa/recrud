<?php
	//echo $this->Html->css('select2/css/select2.css');
	//echo $this->Html->script('select2/js/select2.full.min.js');
	//echo $this->Html->script('tinymce/tinymce.min.js');
	//echo $this->Html->script('ckeditor/ckeditor');
?>
<script src="https://js.hcaptcha.com/1/api.js" async defer></script>

<div class="row mb-3">
	<div class="col-10">
		<h1 class="m-0 me-2 page_title"><?php echo $title; ?></h1>
		<small class="text-muted"><?php echo $system_name; ?></small>
	</div>
	<div class="col-2">
<div class="text-end">
<?= $this->Html->link(__('<i class="far fa-comment-alt"></i> Check Response'), ['action' => 'check'], ['class' => 'btn btn-outline-primary btn-sm', 'escape' => false]) ?>
</div>
	</div>
</div>

<div class="card">
<div class="card-body m-0 p-0">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.2000131893815!2d101.61876301525233!3d3.0409885546548754!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc4bcd2e2268f9%3A0x18a6873c8e308d42!2sPuchong%2C%20Selangor%2C%20Malaysia!5e0!3m2!1sen!2smy!4v1632231729035!5m2!1sen!2smy" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

	<div class="card-body">
<?php
    $length =   7;
    $chrDb  =   array('A','B','C','D','E','F','G','H','J','K','M','N','P','Q','R','S','T','U','V','W','X','Y','Z','2','3','4','5','6','7','8','9');
	
		$str = '';
          for ($count = 0; $count < $length; $count++){

              $chr = $chrDb[rand(0,count($chrDb)-1)];

              if (rand(0,1) == 0){
                 $chr = strtolower($chr);
              }
              if (3 == $count){
                 $str .= '-';
              }
              $str .= $chr;
          }
?>

<?= $this->Form->create($contact) ?>

<div class="row">
	<div class="col-2">
		<div class="badge bg-primary text-wrap">
		  Ticket ID:
		</div>
		<div class="input-group mb-3">
		  <input type="text" class="form-control" placeholder="" aria-label="Copy" aria-describedby="button-addon2" value="<?= $str; ?>" id="ticketid" size="100%" disabled>
		  <button class="btn btn-outline-secondary" onclick="myFunction()"><i class="far fa-clipboard"></i></button>
		</div>
	</div>
	<div class="col-10">
	<fieldset>
		<?php echo $this->Form->hidden('ticket', ['class' => 'form-control','required' => false, 'value' => $str, 'label' => 'Ticket ID']); ?>
		<?php echo $this->Form->control('subject', ['class' => 'form-control','required' => false]); ?>
	</div>
</div>

	<div class="row">
		<div class="col">
		  <?php echo $this->Form->control('name', ['class' => 'form-control','required' => false]); ?>
		</div>
		<div class="col">
		  <?php echo $this->Form->control('email', ['class' => 'form-control','required' => false]); ?>
		</div>
	</div>

	<?php echo $this->Form->control('notes', ['class' => 'form-control ckeditor','required' => false]); ?>
<?php
/* if ($this->Identity->isLoggedIn()) {
    echo '';
}else
	echo $this->Captcha->render(['placeholder' => __('Please solve the riddle')]); */
?>
<?php //echo $this->Captcha->render(['placeholder' => __('Please solve the riddle')]); ?>
<div class="h-captcha" data-sitekey="<?php echo $hcaptcha_sitekey; ?>"></div>
	</fieldset>
				<div class="text-end m-3">
				  <?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-warning']); ?>
				  <?= $this->Form->button(__('Submit'),['type' => 'submit', 'class' => 'btn btn-outline-primary']) ?>
				  <?= $this->Form->end() ?>
                </div>
	</div>
</div>
</div>

<script>
function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("ticketid");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);
  
  /* Alert the copied text */
  alert("Reference copied: " + copyText.value);
}
</script>

