<nav class="sidebar-nav">
	<ul class="nav">
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url("call-logs") ?>">
				<i class="nav-icon icon-diamond"></i>
				Jewelry List
			</a>
		</li>
		<?php if(sesdata('access') == 1): ?>
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url("users") ?>">
					<i class="nav-icon icon-user"></i>
					User Management
				</a>
			</li>
		<?php endif; ?>
	</ul>
</nav>
<button class="sidebar-minimizer brand-minimizer" type="button"></button>