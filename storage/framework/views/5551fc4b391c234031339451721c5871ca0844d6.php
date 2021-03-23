<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="/dashboard"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<?php if(auth()->user()->role =='admin'): ?>
						<li><a href="/siswa" class=""><i class="lnr lnr-user"></i> <span>Siswa</span></a></li>
						<li><a href="/posts" class=""><i class="lnr lnr-pencil"></i> <span>Post</span></a></li>
						<?php endif; ?>
					</ul>
				</nav>
			</div>
		</div><?php /**PATH C:\xampp\htdocs\crud_laravel\resources\views/layouts/includes/_saidbar.blade.php ENDPATH**/ ?>