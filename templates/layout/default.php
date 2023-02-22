<?php
	$cakeDescription = $system_name;
	use Cake\Core\Configure;
	use Cake\Routing\Router;
	$c_name = $this->request->getParam('controller');
	$a_name = $this->request->getParam('action');
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv = "content-language" content = "en">
    <title><?= $cakeDescription ?>: <?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>
    
    <!-- Template CSS -->
    <link rel="stylesheet" href="recrud.css">
    <link rel="stylesheet" href="recrud_custom.css">
	
	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500&display=swap" rel="stylesheet">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- Core CSS -->
	<?php 
	//Meta info
	echo $this->Html->meta('title', $meta_title, ['block' => true]);
	echo $this->Html->meta('keyword', $meta_keyword, ['block' => true]);
	echo $this->Html->meta('subject', $meta_subject, ['block' => true]);
	echo $this->Html->meta('copyright', $meta_copyright, ['block' => true]);
	echo $this->Html->meta('description', $meta_desc, ['block' => true]);
	echo $this->Html->css('core');
	echo $this->Html->css('recrud_custom');
	echo $this->Html->css('recrud');
	echo $this->Html->css('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css');
	
	
	echo $this->Html->css('remixicon/fonts/remixicon.css');
	//Vendors
	//echo $this->Html->css('perfect-scrollbar.css');
	//Helpers
	//echo $this->Html->script('helpers.js');
	//echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js');
	//Bottom JS

	echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js');
	//echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js', ['block' => 'scriptBottom']);
	echo $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js', ['block' => 'scriptBottom']);
	echo $this->Html->script('feathericons/feather.min.js', ['block' => 'scriptBottom']);
	echo $this->Html->script('perfect-scrollbar/perfect-scrollbar.min.js', ['block' => 'scriptBottom']);
	echo $this->Html->script('sidebar.js', ['block' => 'scriptBottom']);
	echo $this->Html->script('darkmode.js', ['block' => 'scriptBottom']);
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>
</head>
<body class="animate">

<?php if($ribbon_status == true): ?>
<?php echo $this->element('ribbon'); ?>
<?php endif; ?>

<?php if($notification_status == true): ?>
<?php echo $this->element('notification_bar'); ?>
<?php endif; ?>


<div class="container-fluid bg-body-tertiary text-end px-3 shadow">



<b class="dropdown">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sun-fill" viewBox="0 0 16 16">
	<symbol id="circle-half" fill="#e6e612" stroke-width="0.5" stroke="#fc6805"  viewBox="0 0 16 16">
	<path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"></path>
	</symbol>
	<symbol id="moon-stars-fill" fill="#e6e612" stroke-width="0.5" stroke="#e6e612" viewBox="0 0 16 16">
	<path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"></path>
	<path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"></path>
	</symbol>
	<symbol id="sun-fill" fill="#e6e612" stroke-width="0.5" stroke="#fc6805" viewBox="0 0 16 16">
	<path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"></path>
	</symbol>
</svg>
  <button class="btn btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
  <svg class="bi theme-icon-active"><use href="#moon-stars-fill"></use></svg>
  </button>
  <ul class="dropdown-menu" aria-labelledby="bd-theme">
    <li><button type="button"  class="dropdown-item" data-bs-theme-value="light">
	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sun-fill" viewBox="0 0 16 16">
  <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
  <use href="#sun-fill"></use>
	</svg>
	
	Light</button></li>
    <li><button type="button"  class="dropdown-item" data-bs-theme-value="dark">
	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-moon-stars-fill" viewBox="0 0 16 16">
  <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
  <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
  <use href="#moon-stars-fill"></use>
</svg>
	Dark</button></li>
    <li><button type="button"  class="dropdown-item" data-bs-theme-value="auto">
	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-half" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
  <use href="#circle-half"></use>
</svg>
	Auto</button></li>
  </ul>
</b>	





<button class="btn bg-transparent" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fa-solid fa-gear" style="color:var(--bs-light-text) !important;"></i></button>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel"></h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  
  <div class="text-center">
<div class="card bg-gold">
<div class="p-3">
<center>
<?php if ($this->Identity->get('avatar') != NULL) {
	echo $this->Html->image('../files/Users/avatar/' . $this->Identity->get('slug') . '/' . $this->Identity->get('avatar'),['class'=> 'd-block rounded-circle shadow', 'width' => '80px', 'height' => '80px']);
}else
	echo $this->Html->image('avatar_default.png', ['alt' => 'avatar', 'class' => 'd-block rounded-circle shadow', 'width' => '80px', 'height' => '80px']);?> 
<br/>
<span class="fw-semibold d-block"><?php echo $this->Identity->get('fullname'); ?></span>
<small class="text-muted"><?php echo $this->Identity->get('email'); ?></small>
</center>
</div>
</div>
  </div>
  
  <div class="offcanvas-body text-start">
  

  
  
		<table class="table">
			<tr>
				<td width="50%">Light/Dark Theme</td>
				<td width="50%">
<div class="btn-group">
  <a class="btn btn-secondary btn-sm" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    Select Theme
  </a>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" data-bs-theme-value="light">Light</a></li>
    <li><a class="dropdown-item" data-bs-theme-value="dark">Dark</a></li>
  </ul>
</div>
				</td>
			</tr>
			<tr>
				<td width="50%">Full Screen</td>
				<td width="50%"><button class="bg-transparent border-0" onclick="toggleFull()" alt=""><i class="fa-solid fa-expand"></i></button></td>
			</tr>
			<tr>
				<td width="50%">Sign-out</td>
				<td width="50%"><?php echo $this->Html->link('<i class="fa-solid fa-arrow-right-from-bracket"></i>', ['controller' => 'Users', 'action' => 'logout', 'prefix' => false], ['class' => 'bg-transparent border-0', 'escape' => false, 'alt' => 'Sign-out']); ?></td>
			</tr>
			<tr>
				<td width="50%">Last Login</td>
				<td width="50%"><?php echo date('M d, Y (h:i A)', strtotime($this->Identity->get('last_login'))); ?></td>
			</tr>
			<tr>
				<td width="50%">aaa</td>
				<td width="50%">xxx</td>
			</tr>
			<tr>
				<td width="50%">aaa</td>
				<td width="50%">xxx</td>
			</tr>
		</table>
  </div>
</div>





		<script>
		// full screen toggle
		function toggleFull() {
			if ((document.fullScreenElement && document.fullScreenElement !== null) ||
			 (!document.mozFullScreen && !document.webkitIsFullScreen)) {
				if (document.documentElement.requestFullScreen) {
					document.documentElement.requestFullScreen();
				} else if (document.documentElement.mozRequestFullScreen) {
					document.documentElement.mozRequestFullScreen();
				} else if (document.documentElement.webkitRequestFullScreen) {
					document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
				}
			} else {
				if (document.cancelFullScreen) {
					document.cancelFullScreen();
				} else if (document.mozCancelFullScreen) {
					document.mozCancelFullScreen();
				} else if (document.webkitCancelFullScreen) {
					document.webkitCancelFullScreen();
				}
			}
		}
		// end full screen toggle
		</script>

</div>	


<?php echo $this->element('menu/side_bar_menu'); ?>


	<div class="content">
		<div class="content-header">
			<a id="contentMenu" href="#" class="content-menu d-none d-lg-flex"><i class="fa-solid fa-bars"></i></a>
			<a id="mobileMenu" href="#" class="content-menu d-lg-none"><i class="fa-solid fa-bars"></i></a>
		</div>
		<div class="content-body">
			<div class="container">
				<?= $this->Flash->render() ?>
				<?= $this->fetch('content') ?>	
							<div class="text-end mt-5">	
								<a id="back-to-top" href="#" class="btn btn-light back-to-top" role="button"><i class="fas fa-chevron-up"></i></a>
							</div>
			</div><!-- container -->	
		</div><!-- content-body -->
	</div><!-- content -->
	<div class="content_footer bg-body-tertiary p-1">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="exp_title">
					© <?php $year = date("Y"); 
					echo $year; ?> , 
					<i class="fa-solid fa-code"></i> by</div>
						<section class='footer_container'><div class="exp_gradient fw-bold">CODETHEPIXEL</div></section>  	
				</div>
				<div class="col-md-4 text-end">
					<a href="https://github.com/Asyraf-wa/recrud" class="footer me-4" target="_blank">Re-CRUD Github</a>
					<a href="https://codethepixel.com" target="_blank" class="footer">Documentation</a>
					<br/>
					<!-- Github Tag -->
					<a class="github-button" href="https://github.com/Asyraf-wa/recrud" data-icon="octicon-star" data-show-count="true" aria-label="Star buttons/github-buttons on GitHub">Star</a>
					<a class="github-button" href="https://github.com/Asyraf-wa/recrud" data-icon="octicon-repo-forked" data-show-count="true" aria-label="Fork buttons/github-buttons on GitHub">Fork</a>
					<a class="github-button" href="https://github.com/Asyraf-wa/recrud" aria-label="Follow @recrud on GitHub">Follow @recrud</a>
					<a class="github-button" href="https://github.com/Asyraf-wa/recrud/archive/refs/heads/main.zip" data-icon="octicon-download" aria-label="Download buttons/github-buttons on GitHub">Download</a>
					<script async defer src="https://buttons.github.io/buttons.js"></script>
				</div>
			</div>
		</div>
	</div>
	<?= $this->fetch('scriptBottom') ?>
</body>
</html>