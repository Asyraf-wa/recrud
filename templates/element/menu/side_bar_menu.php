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
<!--ForEach Start-->
<?php foreach ($menuTree as $menu) : ?>
<!--START Public Accessible Menu. If check: active=true AND admin=false render:-->
	<?php if(($menu->active == true) && ($menu->admin == false) && ($menu->url == NULL) && ($menu->level == 0) && ($menu->parent_separator == NULL) && ($menu->auth == NULL)) : ?>
		<!--division for active menu-->
		<?php if ($menu->division == true) : ?> 
			<li class="menu-header small text-uppercase">
			  <span class="menu-header-text"><?php echo $menu->name; ?></span>
			</li>
		<?php endif ?>
		<!--Public menu-->
		<li class="menu-item <?= $c_name == $menu->controller?'active':'' ?>">
			<?php $disabled = $menu->disabled ? "disabled" : ''; ?>
			<?php echo $this->Html->link('<i class="sidebar_icon">' . $menu->icon . '</i></i>' . __($menu->name) . '</i>', ['prefix' => ($menu->prefix == NULL) ? false : $menu->prefix, 'controller' => $menu->controller, 'action' => '' . $menu->action, '' . $menu->target . ''], ['escape' => false, 'title' => __($menu->name), 'class' => 'navi']) ?>
		</li>
	<?php endif ?>
	<!--Limited access menu:auth-->
	<?php if (($menu->url == NULL) && ($menu->admin == false) && ($menu->auth == true) && ($this->Identity->isLoggedIn())) : ?>
	<li class="menu-item <?= $c_name == $menu->controller?'active':'' ?>">
		<?php $disabled = $menu->disabled ? "disabled" : ''; ?>
		<?php echo $this->Html->link('<i class="sidebar_icon">' . $menu->icon . '</i></i>' . __($menu->name) . '</i>', ['prefix' => ($menu->prefix == NULL) ? false : $menu->prefix, 'controller' => $menu->controller, 'action' => '' . $menu->action, '' . $menu->target . ''], ['escape' => false, 'title' => __($menu->name), 'class' => 'navi']) ?>
	</li>
	<?php endif ?>
	<!--Public external link-->
	<?php if (($menu->url != NULL) && ($menu->admin == false)) : ?> <!--External link for active menu-->
	<li class="menu-item <?= $c_name == $menu->controller?'active':'' ?>">
		<?php $disabled = $menu->disabled ? "disabled" : ''; ?>
		<?php echo $this->Menu->link(__('<i class="sidebar_icon">' . $menu->icon . '</i>' . $menu->name), $menu->url, ['class' => 'navi' . ' ' . $disabled, 'escape' => false]) ?>
	</li>
	<?php endif ?>
	

	
	<!--Public child menu-->
	<?php if ($menu->hasValue('children')) : ?>
		<li class="nav-item">
			<a href="javascript:void(0);" class="nav-link with-sub"><i class="sidebar_icon"><?php echo ($menu->icon) ?></i><div><?php echo ($menu->name) ?></div></a>
				<nav class="nav-sub">
				
<?php foreach ($menu['children'] as $childMenu) : ?>
				<?php $disabled = $childMenu->disabled ? "disabled" : ''; ?>
				<!--Public child menu divider-->
				<?php if ($childMenu['divider_before']) : ?>
				<li class="sub-link"><hr class="dropdown-divider"></li>
				<?php endif; ?>
				<!--Public child menu normal-->
				<?php if (($childMenu->controller != NULL) && ($childMenu->admin == false) && ($childMenu->url == NULL)) : ?>
				<li class="sub-link <?= $c_name == $menu->controller?'active':'' ?>">
				<?php $disabled = $menu->disabled ? "disabled" : ''; ?>
				<?php echo $this->Html->link('<i class="sidebar_icon"> ' . $childMenu->icon . '</i></i> &nbsp;' . __($childMenu->name) . '</i>', ['prefix' => ($childMenu->prefix == NULL) ? false : $childMenu->prefix, 'controller' => $childMenu->controller, 'action' => '' . $childMenu->action, '' . $childMenu->target . ''], ['escape' => false, 'title' => __($childMenu->name), 'class' => 'navi']) ?>
				</li>
				<?php endif ?>
				<!--Public child menu external link-->
				<?php if (($childMenu->url != NULL) && ($childMenu->admin == false)) : ?>
					<li class="sub-link">
						<?php $disabled = $menu->disabled ? "disabled" : ''; ?>
						<?php echo $this->Menu->link(__('<i class="sidebar_icon"> ' . $childMenu->icon . '</i> &nbsp;' . $childMenu->name), $childMenu->url, ['class' => 'navi' . ' ' . $disabled, 'escape' => false]) ?>
					</li>
				<?php endif ?>
<?php endforeach; ?>		
				

			</nav>
		</li>
	<?php endif ?>
<!--END Public Accessible Menu-->

<!--START Administrator Accessible Menu. If check: admin=true AND User_Group_ID=1 render:-->
<!--division for active menu-->
<?php if (($menu->division == true) &&  ($menu->admin == true) && ($this->Identity->get('user_group_id') == '1') && ($menu->url == NULL)) : ?>
			<li class="separator text-uppercase my-4">
			  <span class="menu-header-text"><?php echo $menu->name; ?></span>
			</li>
<?php endif; ?>
	<?php if (($menu->admin == true) && ($this->Identity->get('user_group_id') == '1') && ($menu->prefix == 'Admin')) : ?>
		<li class="nav-item <?= $c_name == $menu->controller?'active':'' ?>">
			<?php $disabled = $menu->disabled ? "disabled" : ''; ?>
			<?php echo $this->Html->link('<i class="sidebar_icon">' . $menu->icon . '</i></i>' . __($menu->name) . '</i>', ['prefix' => ($menu->prefix == NULL) ? false : $menu->prefix, 'controller' => $menu->controller, 'action' => '' . $menu->action, '' . $menu->target . ''], ['escape' => false, 'title' => __($menu->name), 'class' => 'navi']) ?>
		</li>
	<?php endif ?>
	
<!--Public external link-->
	<?php if (($menu->url != NULL) && ($menu->admin == true)) : ?> <!--External link for active menu-->
	<li class="nav-item <?= $c_name == $menu->controller && $a_name == 'index'?'active':'' ?>">
		<?php $disabled = $menu->disabled ? "disabled" : ''; ?>
		<?php echo $this->Menu->link(__('<i class="sidebar_icon">' . $menu->icon . '</i>' . $menu->name), $menu->url, ['class' => 'navi' . ' ' . $disabled, 'escape' => false]) ?>
	</li>
	<?php endif ?>
	
<!--Public child menu-->
<?php if (($menu->admin == true) && ($this->Identity->get('user_group_id') == '1') && ($menu->prefix == 'Admin')) : ?>
	<?php if ($menu->hasValue('children')) : ?>
		<li class="nav-item">
			<a href="javascript:void(0);" class="menu-link menu-toggle"><i class="sidebar_icon"><?php echo ($menu->icon) ?></i><div><?php echo ($menu->name) ?></div></a>
				<ul class="menu-sub" aria-labelledby="navbarDropdown-<?= $menu->id; ?>">
				<?php foreach ($menu['children'] as $childMenu) : ?>
				<?php $disabled = $childMenu->disabled ? "disabled" : ''; ?>
				<!--Public child menu divider-->
				<?php if ($childMenu['divider_before']) : ?>
				<li class="sub-link"><hr class="dropdown-divider"></li>
				<?php endif; ?>
				<!--Public child menu normal-->
				<?php if (($childMenu->controller != NULL) && ($childMenu->admin == true) && ($childMenu->url == NULL)) : ?>
				<li class="sub-link <?= $c_name == $menu->controller?'active':'' ?>">
				<?php $disabled = $menu->disabled ? "disabled" : ''; ?>
				<?php echo $this->Html->link('<i class="menu-icon"> ' . $childMenu->icon . '</i></i> &nbsp;' . __($childMenu->name) . '</i>', ['prefix' => ($childMenu->prefix == NULL) ? false : $childMenu->prefix, 'controller' => $childMenu->controller, 'action' => '' . $childMenu->action, '' . $childMenu->target . ''], ['escape' => false, 'title' => __($childMenu->name), 'class' => 'navi']) ?>
				</li>
				<?php endif ?>
				<!--Public child menu external link-->
				<?php if (($childMenu->url != NULL) && ($childMenu->admin == true)) : ?>
					<li class="sub-link <?= $c_name == $menu->controller?'active':'' ?>">
						<?php $disabled = $menu->disabled ? "disabled" : ''; ?>
				?		<?php echo $this->Menu->link(__('<i class="menu-icon"> ' . $childMenu->icon . '</i> &nbsp;' . $childMenu->name), $childMenu->url, ['class' => 'navi' . ' ' . $disabled, 'escape' => false]) ?>
					</li>
				<?php endif ?>
				<?php endforeach; ?>
				</ul>
		</li>
	<?php endif ?>
<?php endif ?>
<!--END Administrator Accessible Menu-->

<?php endforeach; ?>
<!--ForEach End-->
</ul>
<hr/>



</div><!-- sidebar-body -->
<div class="sidebar-footer">
<a href="" class="avatar online">
<?php if ($this->Identity->get('avatar') != NULL) {
	echo $this->Html->image('../files/Users/avatar/' . $this->Identity->get('slug') . '/' . $this->Identity->get('avatar'),['class'=> 'd-block rounded-circle shadow', 'width' => '36px', 'height' => '36px']);
}else
	echo $this->Html->image('avatar_default.png', ['alt' => 'avatar', 'class' => 'd-block rounded-circle shadow', 'width' => '36px', 'height' => '36px']);
?> 
</a>
<div class="avatar-body">
<div class="d-flex align-items-center justify-content-between">
<h6><?php echo $this->Identity->get('fullname'); ?></h6>
</div>
<span>
<?php if ($this->Identity->get('user_group_id') == 1){
	echo 'Administrator';
}elseif ($this->Identity->get('user_group_id') == 2){
	echo 'Moderator';
}elseif ($this->Identity->get('user_group_id') == 3){
	echo 'User';
}else
	echo 'Error';
?> 
</span>
</div><!-- avatar-body -->
</div><!-- sidebar-footer -->
</div><!-- sidebar -->