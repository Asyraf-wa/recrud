<?php
	echo $this->Html->script('qr-code-styling-1-5-0.min.js');
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

<div class="card bg-gold-full fs-5 fw-bold px-3 py-2 mb-3">
Hello, <?php echo $this->Identity->get('fullname'); ?>, 
<?php
        date_default_timezone_set("Asia/Kuala_Lumpur");  
        $h = date('G');

        if($h>=5 && $h<=11)
        {
            echo "Good morning";
        }
        else if($h>=12 && $h<=15)
        {
            echo "Good afternoon";
        }
        else
        {
            echo "Good evening";
        }
    ?>.
</div>


<div class="row">
	<div class="col-md-9">

	</div>
	<div class="col-md-3">

	</div>
</div>



<div class="row g-3">
	<div class="col-md-8">
<div class="card shadow">
	<div class="card-header d-flex align-items-center justify-content-between border-bottom">
		<div class="card-title mb-0">
		  <h1 class="m-0 me-2 page_title">Welcome Note</h1>
		  <small class="text-muted"><?php echo $system_name; ?></small>
		</div>
	</div>
	<div class="card-body mt-4 justify">
<?= $system_name; ?> (<?= $system_abbr; ?>) is a framework that enables the developer to generate comprehensive Create Read Update Delete Search and Report CRUD components using the <?= $system_abbr; ?> generator. With the integrated important features in the CRUD operation, it enables the code automation for generating the web application functions such as create, retrieve, update, delete, search, report, authentication, configurations, contact management and FAQ management together with comprehensive form helper and features. All you need to do is to set your database, then <?= $system_name; ?> them!
<br><br>
<style>
  .fa-stack { font-size: 3em; }
  i { vertical-align: middle; }
</style>
<div class="row" align="center">
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

<div class="card shadow mt-3">
	<div class="card-body">
<div class="row">
		  <div class="col">
		  <?php echo $this->Html->link(
		   '<div class="col kotak kotak-blue">
			<div class="icon"><i class="fa fa-cog fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Menu</div>
			</div>',
			array('controller'=>'dashboards','action'=>'#'),
			array('escape' => false)); ?>
			
		<?php echo $this->Html->link(
		   '<div class="col kotak kotak-green">
			<div class="icon"><i class="fab fa-staylinked fa-3x"></i></div>
			<div class="nota">Menu</div>
			</div>',
			array('controller'=>'dashboards','action'=>'#'),
			array('escape' => false)); ?>
			
		<?php echo $this->Html->link(
		   '<div class="col kotak kotak-yellow">
			<div class="icon"><i class="far fa-envelope fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Menu</div>
			</div>',
			array('controller'=>'dashboards','action'=>'#'),
			array('escape' => false)); ?>
			
		<?php echo $this->Html->link(
		   '<div class="col kotak kotak-orange">
			<div class="icon"><i class="fas fa-users fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Menu</div>
			</div>',
			array('controller'=>'dashboards','action'=>'#'),
			array('escape' => false)); ?>
			
		<?php echo $this->Html->link(
		   '<div class="col kotak kotak-red">
			<div class="icon"><i class="far fa-user fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Menu</div>
			</div>',
			array('controller'=>'dashboards','action'=>'#'),
			array('escape' => false)); ?>

		<?php echo $this->Html->link(
		   '<div class="col kotak kotak-purple">
			<div class="icon"><i class="fa fa-id-badge fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Menu</div>
			</div>',
			array('controller'=>'dashboards','action'=>'#'),
			array('escape' => false)); ?>
			
		<?php echo $this->Html->link(
		   '<div class="col kotak kotak-darkblue">
			<div class="icon"><i class="far fa-keyboard fa-3x"></i></div>
			<div class="nota">Menu</div>
			</div>',
			array('controller'=>'dashboards','action'=>'#'),
			array('escape' => false)); ?>
			
		<?php echo $this->Html->link(
		   '<div class="col kotak kotak-brown">
			<div class="icon"><i class="fas fa-diagnoses fa-3x"></i></div>
			<div class="nota">Menu</div>
			</div>',
			array('controller'=>'dashboards','action'=>'#'),
			array('escape' => false)); ?>
			
		<?php echo $this->Html->link(
		   '<div class="col kotak kotak-emerald">
			<div class="icon"><i class="fab fa-connectdevelop fa-3x"></i></div>
			<div class="nota">Menu</div>
			</div>',
			array('controller'=>'dashboards','action'=>'#'),
			array('escape' => false)); ?>
			
		<?php echo $this->Html->link(
		   '<div class="col kotak kotak-grey">
			<div class="icon"><i class="fa fa-cube fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Menu</div>
			</div>',
			array('controller'=>'dashboards','action'=>'#'),
			array('escape' => false)); ?>
			
		<?php echo $this->Html->link(
		   '<div class="col kotak kotak-pink">
			<div class="icon"><i class="far fa-bookmark fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Menu</div>
			</div>',
			array('controller'=>'dashboards','action'=>'#'),
			array('escape' => false)); ?>
			
		<?php echo $this->Html->link(
		   '<div class="col kotak kotak-amber">
			<div class="icon"><i class="far fa-building fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Menu</div>
			</div>',
			array('controller'=>'dashboards','action'=>'#'),
			array('escape' => false)); ?>

		<?php echo $this->Html->link(
		   '<div class="col kotak kotak-lightred">
			<div class="icon"><i class="fa fa-bullhorn fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Menu</div>
			</div>',
			array('controller'=>'dashboards','action'=>'#'),
			array('escape' => false)); ?>
			
		<?php echo $this->Html->link(
		   '<div class="col kotak kotak-lightpurple">
			<div class="icon"><i class="fas fa-ad fa-3x"></i></div>
			<div class="nota">Menu</div>
			</div>',
			array('controller'=>'dashboards','action'=>'#'),
			array('escape' => false)); ?>
			
		<?php echo $this->Html->link(
		   '<div class="col kotak kotak-red">
			<div class="icon"><i class="far fa-comment-alt fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Menu</div>
			</div>',
			array('controller'=>'dashboards','action'=>'#'),
			array('escape' => false)); ?>
			
		  </div>
		</div>
	</div>
</div>







	</div>
	<div class="col-md-4">
	
<div class="special_card mb-3">
  <div class="profile-card js-profile-card shadow">
	<div class="profile-card__img shadow" style="background-color: #dc3545;color: #ffffff;">
	  <i class="fa-solid fa-qrcode fa-xl" style="margin-left: 12px;margin-top: 22px;"></i> <?php echo $system_name; ?>
	</div>
		<div class="card-body small-text pt-0">
<div id="qr" align="center"></div>
<script type="text/javascript">
	const qrCode = new QRCodeStyling({
		width: 130,
		height: 130,
		margin: 0,
		//type: "svg",
		data: "<?php echo $this->request->getUri(); ?>",
		dotsOptions: {
			//color: "#4267b2",
			type: "dots"
		},
		cornersSquareOptions: {
			type: "dots",
			color: "#007bff",
		},
		cornersDotOptions: {
			type: "dots"
		},
		backgroundOptions: {
			//color: "#ffffff",
		},
		imageOptions: {
			crossOrigin: "anonymous",
			margin: 20
		}
	});

	qrCode.append(document.getElementById("qr"));
	//qrCode.download({ name: "qr", extension: "png" });
</script>
		</div>
  </div>
</div>	


<div class="special_card mb-3">
  <div class="profile-card js-profile-card shadow">
	<div class="profile-card__img shadow" style="background-color: #696cff;color: #ffffff;">
	  <i class="far fa-bookmark fa-xl" style="margin-left: 14px;margin-top: 21px;"></i> Useful Link
	</div>
		<div class="card-body pt-0">
			<div class="table-responsive">
<table class="table table-sm table-borderless">
	<tr>
		<td><i class="far fa-bookmark" style="color: var(--bs-blue);"></i> <?php echo $this->Html->link('Re-CRUD repository','https://github.com/Asyraf-wa', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
	<tr>
		<td><i class="far fa-bookmark" style="color: var(--bs-indigo);"></i> <?php echo $this->Html->link('Code The Pixel - Re-CRUD tutorial','https://codethepixel.com', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
	<tr>
		<td><i class="far fa-bookmark" style="color: var(--bs-purple);"></i> <?php echo $this->Html->link('GetBootstrap - Theme components','https://getbootstrap.com', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
	<tr>
		<td><i class="far fa-bookmark" style="color: var(--bs-pink);"></i> <?php echo $this->Html->link('Font Awesome Icon - Icon collection','https://fontawesome.com', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
	<tr>
		<td><i class="far fa-bookmark" style="color: var(--bs-red);"></i> <?php echo $this->Html->link('Feather Icon - Icon collection','https://feathericons.com', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
	<tr>
		<td><i class="far fa-bookmark" style="color: var(--bs-orange);"></i> <?php echo $this->Html->link('Github - Codes repository','https://github.com', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
	<tr>
		<td><i class="far fa-bookmark" style="color: var(--bs-yellow);"></i> <?php echo $this->Html->link('Composer - Dependecy manager','https://getcomposer.org/', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
	<tr>
		<td><i class="far fa-bookmark" style="color: var(--bs-green);"></i> <?php echo $this->Html->link('ChartJS - Flexible charting library','https://www.chartjs.org/', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
	<tr>
		<td><i class="far fa-bookmark" style="color: var(--bs-teal);"></i> <?php echo $this->Html->link('DataTables - Table features enhancement','https://datatables.net/', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
	<tr>
		<td><i class="far fa-bookmark" style="color: var(--bs-cyan);"></i> <?php echo $this->Html->link('Google Fonts - Font library','https://fonts.google.com/', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
	<tr>
		<td><i class="far fa-bookmark" style="color: var(--bs-warning);"></i> <?php echo $this->Html->link('Optimizilla - Image optimizer','https://imagecompressor.com/', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
	<tr>
		<td><i class="far fa-bookmark" style="color: var(--bs-danger);"></i> <?php echo $this->Html->link('PHP - Official PHP references','https://www.php.net/manual/en/', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
	<tr>
		<td><i class="far fa-bookmark"></i> <?php echo $this->Html->link('CakePHP - Web Application Framework','https://cakephp.org/', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
</table>
			</div>
		</div>
  </div>
</div>
	
	

	</div>


</div>




