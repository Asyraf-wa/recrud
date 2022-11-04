<?php 
	$c_name = $this->request->getParam('controller');
	$a_name = $this->request->getParam('action');
	//echo $c_name;
	//exit;
?>
<!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              
              <span class="app-brand-text demo menu-text fw-bolder ms-2">

			<div id="logoFade" class="logo-fade hide"><b class="gradient-animate-small">&lt;&#47;&gt; <?php echo $system_abbr; ?></b></div>
			  </span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
			  <i class="fas fa-chevron-left fa-sm" style="padding-left:8px;padding-top:12px;"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
<?php if ($this->Identity->isLoggedIn() == NULL) { ?>
		<li class="menu-item <?= $c_name == 'Users' && $a_name == 'login'?'active':'' ?>">
		  <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-code"></i> Sign-in'), ['controller' => 'Users', 'action' => 'login', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
		</li>
<?php } ?>
<?php if ($this->Identity->isLoggedIn()) { ?>
            <!-- Dashboard -->
			<li class="menu-item <?= $c_name == 'Dashboards' && $a_name == 'index'?'active':'' ?>">
              <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-code"></i> Dashboard'), ['controller' => 'Dashboards', 'action' => 'index', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
            </li>
<?php } ?>
			<li class="menu-item <?= $c_name == 'Faqs' && $a_name == 'index'?'active':'' ?>">
              <?= $this->Html->link(__('<i class="menu-icon fa-regular fa-circle-question"></i> FAQ'), ['controller' => 'Faqs', 'action' => 'index', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
            </li>
			<li class="menu-item <?= $c_name == 'Contact' && $a_name == 'add'?'active':'' ?>">
              <?= $this->Html->link(__('<i class="menu-icon fa-regular fa-message"></i> Contact Us'), ['controller' => 'Contact', 'action' => 'index', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
            </li>
            <li class="menu-item <?= $c_name == 'Pages' && $a_name == 'manual'?'active':'' ?>">
              <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-circle-info"></i> Documents'), ['controller' => 'Pages', 'action' => 'manual', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
            </li>
			
<?php
if ($this->Identity->isLoggedIn()) { ?>
            <!-- My Account -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">My Account</span></li>
			
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon fa-solid fa-user-tie"></i>
                <div data-i18n="Account Settings">My Profile</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item <?= $c_name == 'Users' && $a_name == 'profile'?'active':'' ?>">
					<?= $this->Html->link(__('<i class="menu-icon fa-solid fa-user-tie"></i> Profile'), ['controller' => 'Users', 'action' => 'profile', 'prefix' => false, $this->Identity->get('slug')], ['class' => 'menu-link', 'escape' => false]) ?>
				</li>
				<li class="menu-item <?= $c_name == 'Users' && $a_name == 'update'?'active':'' ?>">
				  <?= $this->Html->link(__('<i class="menu-icon fa-regular fa-pen-to-square"></i> Update'), ['controller' => 'Users', 'action' => 'update', 'prefix' => false, $this->Identity->get('slug')], ['class' => 'menu-link', 'escape' => false]) ?>
				</li>
				<li class="menu-item <?= $c_name == 'Users' && $a_name == 'changePassword'?'active':'' ?>">
				  <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-unlock-keyhole"></i> Password'), ['controller' => 'Users', 'action' => 'change_password', 'prefix' => false, $this->Identity->get('slug')], ['class' => 'menu-link', 'escape' => false]) ?>
				</li>
				<li class="menu-item <?= $c_name == 'Users' && $a_name == 'activity'?'active':'' ?>">
				  <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-cubes-stacked"></i> Activities'), ['controller' => 'Users', 'action' => 'activity', 'prefix' => false, $this->Identity->get('slug')], ['class' => 'menu-link', 'escape' => false]) ?>
				</li>
              </ul>
            </li>
            <li class="menu-item <?= $c_name == 'Users' && $a_name == 'logout'?'active':'' ?>">
              <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-arrow-right-from-bracket"></i> Sign-out'), ['controller' => 'Users', 'action' => 'logout', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
            </li>
            <!-- Administrator -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Administrator</span>
            </li>
			<li class="menu-item <?= $c_name == 'Settings' && $a_name == 'update'?'active':'' ?>">
              <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-gear"></i> Site Configuration'), ['prefix' => 'Admin', 'controller' => 'Settings', 'action' => 'update','1'], ['class' => 'menu-link', 'escape' => false]) ?>
            </li>
			<li class="menu-item <?= $c_name == 'Users' && $a_name == 'index'?'active':'' ?>">
              <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-users-viewfinder"></i> User Management'), ['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'index'], ['class' => 'menu-link', 'escape' => false]) ?>
            </li>
			<li class="menu-item <?= $c_name == 'Todos' && $a_name == 'index'?'active':'' ?>">
              <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-list-check"></i> Todo'), ['prefix' => 'Admin', 'controller' => 'Todos', 'action' => 'index'], ['class' => 'menu-link', 'escape' => false]) ?>
            </li>
			<li class="menu-item <?= $c_name == 'Contacts' && $a_name == 'index'?'active':'' ?>">
              <?= $this->Html->link(__('<i class="menu-icon fa-regular fa-message"></i> Contacts'), ['prefix' => 'Admin', 'controller' => 'Contacts', 'action' => 'index'], ['class' => 'menu-link', 'escape' => false]) ?>
            </li>
			<li class="menu-item <?= $c_name == 'AuditLogs' && $a_name == 'index'?'active':'' ?>">
              <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-timeline"></i> Audit Trail'), ['prefix' => 'Admin', 'controller' => 'auditLogs', 'action' => 'index'], ['class' => 'menu-link', 'escape' => false]) ?>
            </li>
			<li class="menu-item <?= $c_name == 'Faqs' && $a_name == 'index'?'active':'' ?>">
              <?= $this->Html->link(__('<i class="menu-icon fa-regular fa-circle-question"></i> FAQ'), ['prefix' => 'Admin', 'controller' => 'Faqs', 'action' => 'index'], ['class' => 'menu-link', 'escape' => false]) ?>
            </li>
<?php } ?>
          </ul>
        </aside>
        <!-- / Menu -->