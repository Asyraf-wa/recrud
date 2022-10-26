<?php
$cakeDescription = 'Code The Pixel';
?>
<?php
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
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Icons. Uncomment required icon fonts -->
	<?php echo $this->Html->css('boxicons') ?>
	
	<!-- Core CSS -->
	<?php //echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css') ?>
	<?php echo $this->Html->css('core') ?>
	<?php echo $this->Html->css('theme-default') ?>
	<?php echo $this->Html->css('custom') ?>
	
	<!-- Vendors CSS -->
	<?php echo $this->Html->css('perfect-scrollbar.css') ?>
	
	<!-- Helpers -->
	<?php echo $this->Html->script('helpers.js'); ?>
	
	<?php echo $this->Html->script('config.js'); ?>
<?php //echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js', ['block' => 'scriptBottom']); ?>
	<?php echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'); ?>
	
	<!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
	<?php //echo $this->Html->script('jquery.js', ['block' => 'scriptBottom']); ?>
	<?php echo $this->Html->script('popper.js', ['block' => 'scriptBottom']); ?>
	<?php echo $this->Html->script('bootstrap.js', ['block' => 'scriptBottom']); ?>
	<?php //echo $this->Html->script('perfect-scrollbar.js', ['block' => 'scriptBottom']); ?>
	<?php echo $this->Html->script('menu.js', ['block' => 'scriptBottom']); ?>
	<?php //echo $this->Html->script('bootstrapModal', ['block' => 'scriptBottom']); ?>
	
	<!-- Main JS -->
	<?php echo $this->Html->script('main.js', ['block' => 'scriptBottom']); ?>

    <!-- Page JS -->
	<?php echo $this->Html->script('dashboards-analytics.js', ['block' => 'scriptBottom']); ?>
	
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
<!--Navigation bar-->
<?php echo $this->element('menu/side_bar'); ?>

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
		  
		  <div class="container-fluid mx-0 px-0 d-none d-sm-block shadow">
			<div class="card" style="border-radius: 0rem;">

<div class="badge_card text-end mx-3">
<button class="badge_custom bg-light border-0"><i class="fa-regular fa-calendar"></i> <?php echo date("M d, Y"); ?></button>
<button class="badge_custom bg-light border-0" onclick="toggleFull()" alt=""><i class="fa-solid fa-expand"></i></button>
<?php echo $this->Html->link('<i class="fa-solid fa-arrow-right-from-bracket"></i>', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'badge_custom_link bg-light border-0 kosong', 'escape' => false, 'alt' => 'Sign-out']); ?>
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
			</div>
		  </div>

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
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
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
					  <?php echo $this->Html->image('blank_profile.png', ['class' => 'w-px-40 h-auto rounded-circle', 'alt' => 'Profile']); ?>
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
					  <?php echo $this->Html->image('blank_profile.png', ['class' => 'w-px-40 h-auto rounded-circle', 'alt' => 'Profile']); ?>
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">John Doe</span>
                            <small class="text-muted">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle">Billing</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="auth-login-basic.html">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
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
<script>
$(document).ready(function(){
	$(window).scroll(function () {
			if ($(this).scrollTop() > 50) {
				$('#back-to-top').fadeIn();
			} else {
				$('#back-to-top').fadeOut();
			}
		});
		// scroll body to 0px on click
		$('#back-to-top').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 400);
			return false;
		});
});
</script>	
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  © <?php 
						$year = date("Y"); 
						echo $year; ?>
                  , <i class="fa-solid fa-code"></i> with ❤️ by
                  <a href="https://codethepixel.com" target="_blank" class="footer-link fw-bolder">Code The Pixel</a>
                </div>
                <div>
                  <a href="https://github.com/Asyraf-wa/recrud" class="footer-link me-4" target="_blank">Re-CRUD Github Repository</a>
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
    <!-- endbuild -->

    <!-- Vendors JS -->

    

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>
