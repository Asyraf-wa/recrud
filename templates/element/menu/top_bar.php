<div class="container-fluid mx-0 px-0 d-none d-sm-block shadow">
	<div class="card" style="border-radius: 0rem;">
		<div class="badge_card text-end mx-3">
		<button class="badge_custom bg-light border-0"><i class="fa-regular fa-calendar"></i> <?php echo date("M d, Y"); ?></button>
		<button class="badge_custom bg-light border-0" onclick="toggleFull()" alt=""><i class="fa-solid fa-expand"></i></button>
		<?php echo $this->Html->link('<i class="fa-solid fa-arrow-right-from-bracket"></i>', ['controller' => 'Users', 'action' => 'logout', 'prefix' => false], ['class' => 'badge_custom_link bg-light border-0 kosong', 'escape' => false, 'alt' => 'Sign-out']); ?>
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