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
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Squada+One&family=Tourney:wght@100&display=swap" rel="stylesheet" />
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
	echo $this->Html->css('theme-default');
	echo $this->Html->css('custom');
	//Vendors
	echo $this->Html->css('perfect-scrollbar.css');
	//Helpers
	echo $this->Html->script('helpers.js');
	echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js');
	//Bottom JS
	echo $this->Html->script('bootstrap.js', ['block' => 'scriptBottom']);
	echo $this->Html->script('custom.js', ['block' => 'scriptBottom']);
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>
</head>
<body>

<?php if($ribbon_status == true): ?>
<?php echo $this->element('ribbon'); ?>
<?php endif; ?>

<?php if($notification_status == true): ?>
<?php echo $this->element('notification_bar'); ?>
<?php endif; ?>
  
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
	<!--Navigation side-bar-->
	<?php echo $this->element('menu/side_bar'); ?>
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
			<?php echo $this->element('menu/top_bar'); ?>
			  <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
				<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
				  <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
					<i class="fas fa-bars"></i>
				  </a>
				</div>
					<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
			<!-- Search -->
			<div class="navbar-nav align-items-center">
				<div class="nav-item d-flex align-items-center">
				  <i class="fas fa-search fa-lg lh-0"></i>
				  <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
				</div>
			</div>
			<!-- /Search -->
<?php if ($this->Identity->isLoggedIn()) { ?>
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
						<?php if ($this->Identity->get('avatar') != NULL) {
								echo $this->Html->image('../files/Users/avatar/' . $this->Identity->get('slug') . '/' . $this->Identity->get('avatar'),['class'=> 'w-px-40 rounded-circle', 'width' => '40px', 'height' => '40px']);
							}else
								echo $this->Html->image('avatar_default.png', ['alt' => 'avatar', 'class' => 'w-px-40 h-auto rounded-circle', 'width' => '40px', 'height' => '40px']); ?>
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
								<?php if ($this->Identity->get('avatar') != NULL) {
										echo $this->Html->image('../files/Users/avatar/' . $this->Identity->get('slug') . '/' . $this->Identity->get('avatar'),['class'=> 'w-px-40 rounded-circle', 'width' => '40px', 'height' => '40px']);
									}else
										echo $this->Html->image('avatar_default.png', ['alt' => 'avatar', 'class' => 'w-px-40 h-auto rounded-circle', 'width' => '40px', 'height' => '40px']); ?>
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block"><?php echo $this->Identity->get('fullname'); ?></span>
                            <small class="text-muted"><?php echo $this->Identity->get('email'); ?></small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
						<?= $this->Html->link(__('<i class="fa-solid fa-user-astronaut"></i> Account'), ['prefix' => false, 'controller' => 'Users', 'action' => 'profile', $this->Identity->get('slug')], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?>
                    </li>
                    <li>
						<?= $this->Html->link(__('<i class="fa-solid fa-arrow-right-from-bracket"></i> Logout'), ['controller' => 'Users', 'action' => 'logout', 'prefix' => false], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?>
                    </li>
                  </ul>
                </li>
              </ul>
<?php } ?>
            </div>
          </nav>
          <!-- / Navbar -->
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
				<?= $this->Flash->render() ?>
				<?= $this->fetch('content') ?>
				<div class="text-end">	
					<a id="back-to-top" href="#" class="btn btn-light back-to-top" role="button"><i class="fas fa-chevron-up"></i></a>
				</div>
            </div>
            <!-- / Content -->
            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
				<div class="container-xxl text-end pe-5">
					<!-- Github Tag -->
					<a class="github-button" href="https://github.com/Asyraf-wa/recrud" data-icon="octicon-star" data-show-count="true" aria-label="Star buttons/github-buttons on GitHub">Star</a>
					<a class="github-button" href="https://github.com/Asyraf-wa/recrud" data-icon="octicon-repo-forked" data-show-count="true" aria-label="Fork buttons/github-buttons on GitHub">Fork</a>
					<a class="github-button" href="https://github.com/Asyraf-wa/recrud" aria-label="Follow @recrud on GitHub">Follow @recrud</a>
					<a class="github-button" href="https://github.com/Asyraf-wa/recrud/archive/refs/heads/main.zip" data-icon="octicon-download" aria-label="Download buttons/github-buttons on GitHub">Download</a>
					<script async defer src="https://buttons.github.io/buttons.js"></script>
				</div>
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  © <?php 
						$year = date("Y"); 
						echo $year; ?>
                  , <i class="fa-solid fa-code"></i> with ❤️ by
                  <a href="https://codethepixel.com" target="_blank" class="footer-link fw-bolder">Code The Pixel</a>
                </div>
                <div>
                  <a href="https://github.com/Asyraf-wa/recrud" class="footer-link me-4" target="_blank">Re-CRUD Github</a>
                  <a href="https://codethepixel.com" target="_blank" class="footer-link me-4">Documentation</a>
                </div>
              </div>
            </footer>
            <!-- / Footer -->
            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>
      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
	<?= $this->fetch('scriptBottom') ?>
</body>
</html>