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
			<?php echo $this->Html->link('<i class="menu-icon">' . $menu->icon . '</i></i>' . __($menu->name) . '</i>', ['prefix' => ($menu->prefix == NULL) ? false : $menu->prefix, 'controller' => $menu->controller, 'action' => '' . $menu->action, '' . $menu->target . ''], ['escape' => false, 'title' => __($menu->name), 'class' => 'menu-link']) ?>
		</li>
	<?php endif ?>
	<!--Limited access menu:auth-->
	<?php if (($menu->url == NULL) && ($menu->admin == false) && ($menu->auth == true) && ($this->Identity->isLoggedIn())) : ?>
	<li class="menu-item <?= $c_name == $menu->controller?'active':'' ?>">
		<?php $disabled = $menu->disabled ? "disabled" : ''; ?>
		<?php echo $this->Html->link('<i class="menu-icon">' . $menu->icon . '</i></i>' . __($menu->name) . '</i>', ['prefix' => ($menu->prefix == NULL) ? false : $menu->prefix, 'controller' => $menu->controller, 'action' => '' . $menu->action, '' . $menu->target . ''], ['escape' => false, 'title' => __($menu->name), 'class' => 'menu-link']) ?>
	</li>
	<?php endif ?>
	<!--Public external link-->
	<?php if (($menu->url != NULL) && ($menu->admin == false)) : ?> <!--External link for active menu-->
	<li class="menu-item <?= $c_name == $menu->controller?'active':'' ?>">
		<?php $disabled = $menu->disabled ? "disabled" : ''; ?>
		<?php echo $this->Menu->link(__('<i class="menu-icon">' . $menu->icon . '</i>' . $menu->name), $menu->url, ['class' => 'menu-link' . ' ' . $disabled, 'escape' => false]) ?>
	</li>
	<?php endif ?>
	<!--Public child menu-->
	<?php if ($menu->hasValue('children')) : ?>
		<li class="menu-item">
			<a href="javascript:void(0);" class="menu-link menu-toggle"><i class="menu-icon"><?php echo ($menu->icon) ?></i><div><?php echo ($menu->name) ?></div></a>
				<ul class="menu-sub" aria-labelledby="navbarDropdown-<?= $menu->id; ?>">
				<?php foreach ($menu['children'] as $childMenu) : ?>
				<?php $disabled = $childMenu->disabled ? "disabled" : ''; ?>
				<!--Public child menu divider-->
				<?php if ($childMenu['divider_before']) : ?>
				<li class="menu-item"><hr class="dropdown-divider"></li>
				<?php endif; ?>
				<!--Public child menu normal-->
				<?php if (($childMenu->controller != NULL) && ($childMenu->admin == false) && ($childMenu->url == NULL)) : ?>
				<li class="menu-item <?= $c_name == $menu->controller?'active':'' ?>">
				<?php $disabled = $menu->disabled ? "disabled" : ''; ?>
				<?php echo $this->Html->link('<i class="menu-icon"> ' . $childMenu->icon . '</i></i> &nbsp;' . __($childMenu->name) . '</i>', ['prefix' => ($childMenu->prefix == NULL) ? false : $childMenu->prefix, 'controller' => $childMenu->controller, 'action' => '' . $childMenu->action, '' . $childMenu->target . ''], ['escape' => false, 'title' => __($childMenu->name), 'class' => 'menu-link']) ?>
				</li>
				<?php endif ?>
				<!--Public child menu external link-->
				<?php if (($childMenu->url != NULL) && ($childMenu->admin == false)) : ?>
					<li class="menu-item">
						<?php $disabled = $menu->disabled ? "disabled" : ''; ?>
						<?php echo $this->Menu->link(__('<i class="menu-icon"> ' . $childMenu->icon . '</i> &nbsp;' . $childMenu->name), $childMenu->url, ['class' => 'menu-link' . ' ' . $disabled, 'escape' => false]) ?>
					</li>
				<?php endif ?>
				<?php endforeach; ?>
				</ul>
		</li>
	<?php endif ?>
<!--END Public Accessible Menu-->


<!--START Administrator Accessible Menu. If check: admin=true AND User_Group_ID=1 render:-->
<!--division for active menu-->
<?php if (($menu->division == true) &&  ($menu->admin == true) && ($this->Identity->get('user_group_id') == '1') && ($menu->url == NULL)) : ?>
			<li class="menu-header small text-uppercase">
			  <span class="menu-header-text"><?php echo $menu->name; ?></span>
			</li>
<?php endif; ?>
	<?php if (($menu->admin == true) && ($this->Identity->get('user_group_id') == '1') && ($menu->prefix == 'Admin')) : ?>
		<li class="menu-item <?= $c_name == $menu->controller?'active':'' ?>">
			<?php $disabled = $menu->disabled ? "disabled" : ''; ?>
			<?php echo $this->Html->link('<i class="menu-icon">' . $menu->icon . '</i></i>' . __($menu->name) . '</i>', ['prefix' => ($menu->prefix == NULL) ? false : $menu->prefix, 'controller' => $menu->controller, 'action' => '' . $menu->action, '' . $menu->target . ''], ['escape' => false, 'title' => __($menu->name), 'class' => 'menu-link']) ?>
		</li>
	<?php endif ?>
	
<!--Public external link-->
	<?php if (($menu->url != NULL) && ($menu->admin == true)) : ?> <!--External link for active menu-->
	<li class="menu-item <?= $c_name == $menu->controller && $a_name == 'index'?'active':'' ?>">
		<?php $disabled = $menu->disabled ? "disabled" : ''; ?>
		<?php echo $this->Menu->link(__('<i class="menu-icon">' . $menu->icon . '</i>' . $menu->name), $menu->url, ['class' => 'menu-link' . ' ' . $disabled, 'escape' => false]) ?>
	</li>
	<?php endif ?>
	
<!--Public child menu-->
<?php if (($menu->admin == true) && ($this->Identity->get('user_group_id') == '1') && ($menu->prefix == 'Admin')) : ?>
	<?php if ($menu->hasValue('children')) : ?>
		<li class="menu-item">
			<a href="javascript:void(0);" class="menu-link menu-toggle"><i class="menu-icon"><?php echo ($menu->icon) ?></i><div><?php echo ($menu->name) ?></div></a>
				<ul class="menu-sub" aria-labelledby="navbarDropdown-<?= $menu->id; ?>">
				<?php foreach ($menu['children'] as $childMenu) : ?>
				<?php $disabled = $childMenu->disabled ? "disabled" : ''; ?>
				<!--Public child menu divider-->
				<?php if ($childMenu['divider_before']) : ?>
				<li class="menu-item"><hr class="dropdown-divider"></li>
				<?php endif; ?>
				<!--Public child menu normal-->
				<?php if (($childMenu->controller != NULL) && ($childMenu->admin == true) && ($childMenu->url == NULL)) : ?>
				<li class="menu-item <?= $c_name == $menu->controller?'active':'' ?>">
				<?php $disabled = $menu->disabled ? "disabled" : ''; ?>
				<?php echo $this->Html->link('<i class="menu-icon"> ' . $childMenu->icon . '</i></i> &nbsp;' . __($childMenu->name) . '</i>', ['prefix' => ($childMenu->prefix == NULL) ? false : $childMenu->prefix, 'controller' => $childMenu->controller, 'action' => '' . $childMenu->action, '' . $childMenu->target . ''], ['escape' => false, 'title' => __($childMenu->name), 'class' => 'menu-link']) ?>
				</li>
				<?php endif ?>
				<!--Public child menu external link-->
				<?php if (($childMenu->url != NULL) && ($childMenu->admin == true)) : ?>
					<li class="menu-item <?= $c_name == $menu->controller?'active':'' ?>">
						<?php $disabled = $menu->disabled ? "disabled" : ''; ?>
				?		<?php echo $this->Menu->link(__('<i class="menu-icon"> ' . $childMenu->icon . '</i> &nbsp;' . $childMenu->name), $childMenu->url, ['class' => 'menu-link' . ' ' . $disabled, 'escape' => false]) ?>
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
</aside>