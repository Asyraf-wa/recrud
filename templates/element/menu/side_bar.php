<?php 
	$c_name = $this->request->getParam('controller');
	$a_name = $this->request->getParam('action');
?>
<style>
a.navi:link { 
	text-decoration:none;
    height: 40px;
    padding: 0 10px;
    display: flex;
    align-items: center;
    border-radius: 5px;
    white-space: nowrap;
	color: var(--bs-nav-link-color);
}
a.navi:visited { 
	text-decoration:none;
    height: 40px;
    padding: 0 10px;
    display: flex;
    align-items: center;
    border-radius: 5px;
    white-space: nowrap;
	color: var(--bs-nav-link-color);
}
a.navi:hover { 
	text-decoration:none;
    height: 40px;
    padding: 0 10px;
    display: flex;
    align-items: center;
    border-radius: 5px;
    white-space: nowrap;
	color: var(--bs-nav-link-color);
}
.sidebar_active { 
	font-weight: bold;
    height: 40px;
    display: flex;
    align-items: center;
    border-radius: 5px;
    white-space: nowrap;
	color: var(--bs-nav-link-color);
}

</style>
<div class="sidebar bg-body-tertiary">
<div class="sidebar-header">
<a href="#" class="sidebar-logo"><b class="gradient-animate-sidebar-logo"><i class="fa-solid fa-code"></i></b></a>
<a href="#" class="sidebar-logo-text"><span><b class="gradient-animate-small">Re-CRUD</b></span></a>
</div><!-- sidebar-header -->
<div class="sidebar-body">
<ul class="nav-sidebar">

<?php if ($this->Identity->isLoggedIn() == NULL) { ?>
		<li class="nav-item <?= $c_name == 'Users' && $a_name == 'login'?'sidebar_active':'' ?>">
		<?= $this->Html->link(__('<i class="sidebar_icon fa-solid fa-arrow-right-to-bracket"></i><span">Sign-in</span>'), ['controller' => 'Users', 'action' => 'login', 'prefix' => false], ['class' => 'navi', 'escape' => false]) ?>
		</li>
		
<?php } ?>
<?php if ($this->Identity->isLoggedIn()) { ?>
            <!-- Dashboard -->
			<li class="nav-item <?= $c_name == 'Dashboards' && $a_name == 'index'?'sidebar_active':'' ?>">
              <?= $this->Html->link(__('<i class="sidebar_icon fa-solid fa-code"></i><span">Dashboard</span>'), ['controller' => 'Dashboards', 'action' => 'index', 'prefix' => false], ['class' => 'navi', 'escape' => false]) ?>
            </li>
<?php } ?>

<li class="nav-item <?= $c_name == 'Faqs' && $a_name == 'index'?'sidebar_active':'' ?>">
	<?= $this->Html->link(__('<i class="sidebar_icon fa-regular fa-circle-question"></i><span"> FAQ</span>'), ['controller' => 'Faqs', 'action' => 'index', 'prefix' => false], ['class' => 'navi', 'escape' => false]) ?>
</li>


<li class="nav-item <?= $c_name == 'Contacts' && $a_name == 'index'?'sidebar_active':'' ?>">
	<?= $this->Html->link(__('<i class="sidebar_icon fa-regular fa-message"></i><span"> Contact Us</span>'), ['controller' => 'Contacts', 'action' => 'index', 'prefix' => false], ['class' => 'navi', 'escape' => false]) ?>
</li>

<li class="nav-item <?= $c_name == 'Pages' && $a_name == 'manual'?'sidebar_active':'' ?>">
	<?= $this->Html->link(__('<i class="sidebar_icon fa-solid fa-circle-info"></i><span"> Documents</span>'), ['controller' => 'Pages', 'action' => 'manual', 'prefix' => false], ['class' => 'navi', 'escape' => false]) ?>
</li>



<li class="nav-item"><a href="https://codethepixel.com" class="nav-link"><i class="sidebar_icon fa-solid fa-code"></i>Dashboard</a></li>

<li class="nav-item">
<a href="" class="nav-link with-sub"><i class="sidebar_icon fa-regular fa-folder"></i><span>Documentation</span></a>
<nav class="nav-sub">
<a href="" class="sub-link active"><i class="sidebar_icon fa-regular fa-folder"></i> Overview</a>
<a href="" class="sub-link">Insights</a>
<a href="" class="sub-link">Transactions</a>
<a href="" class="sub-link">Reports</a>
</nav>
</li>
</ul>
<hr/>


<nav class="nav-sidebar">
<a href="" class="nav-link"><i data-feather="activity"></i><span>Activity Logs</span></a>
<a href="" class="nav-link"><i data-feather="settings"></i><span>Preferences</span></a>
<a href="" class="nav-link"><i data-feather="help-circle"></i><span>Help &amp; Support</span></a>
<a href="" class="nav-link"><i data-feather="edit-3"></i><span>Give Feedback</span></a>
</nav>
</div><!-- sidebar-body -->
<div class="sidebar-footer">
<a href="" class="avatar online"><span class="avatar-initial">s</span></a>
<div class="avatar-body">
<div class="d-flex align-items-center justify-content-between">
<h6>Samantha Doe</h6>
<a href="" class="footer-menu"><i class="ri-settings-4-line"></i></a>
</div>
<span>Superuser/Administrator</span>
</div><!-- avatar-body -->
</div><!-- sidebar-footer -->
</div><!-- sidebar -->