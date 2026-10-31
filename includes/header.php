<header class="floating-header-wrapper">
	<nav class="floating-navbar" aria-label="Main Navigation">
		<!-- Brand Logo -->
		<div class="nav-brand">
			<a href="index.php" class="brand-link">
				<span class="brand-icon-wrap"><i class="fa fa-compass" aria-hidden="true"></i></span>
				<div class="brand-text">
					<span class="brand-title">Wayfarer</span>
					<span class="brand-tagline">For people who love exploring</span>
				</div>
			</a>
		</div>

		<!-- Desktop Navigation Links -->
		<div class="nav-menu-desktop">
			<ul class="nav-links">
				<li><a href="index.php">Home</a></li>
				<li><a href="package-list.php">Tours</a></li>
				<li><a href="page.php?type=aboutus">About</a></li>
				<li><a href="page.php?type=contact">Contact</a></li>
				<?php if($_SESSION['login']) { ?>
					<li><a href="#" data-toggle="modal" data-target="#myModal3">Write Us</a></li>
				<?php } else { ?>
					<li><a href="enquiry.php">Enquiry</a></li>
				<?php } ?>
			</ul>
		</div>

		<!-- Action / Account Section -->
		<div class="nav-actions">
			<?php if($_SESSION['login']) { ?>
				<div class="dropdown user-dropdown">
					<a href="#" class="dropdown-toggle user-pill" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-user-circle-o"></i>
						<span class="user-name-short"><?php echo htmlentities(explode('@', $_SESSION['login'])[0]); ?></span>
						<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-right custom-nav-dropdown">
						<li class="dropdown-header">Logged in as <?php echo htmlentities($_SESSION['login']); ?></li>
						<li role="separator" class="divider"></li>
						<li><a href="profile.php"><i class="fa fa-user"></i> My Profile</a></li>
						<li><a href="tour-history.php"><i class="fa fa-suitcase"></i> My Tour History</a></li>
						<li><a href="issuetickets.php"><i class="fa fa-ticket"></i> Support Tickets</a></li>
						<li><a href="change-password.php"><i class="fa fa-key"></i> Change Password</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="logout.php" class="dropdown-logout"><i class="fa fa-sign-out"></i> Log Out</a></li>
					</ul>
				</div>
			<?php } else { ?>
				<div class="auth-buttons">
					<a href="#" data-toggle="modal" data-target="#myModal4" class="btn-nav-signin">Sign In</a>
					<a href="#" data-toggle="modal" data-target="#myModal" class="btn-nav-signup">Sign Up</a>
				</div>
			<?php } ?>

			<!-- Mobile Hamburger Toggle -->
			<button type="button" class="mobile-toggle-btn" id="wayfarerMobileToggle" aria-label="Toggle navigation">
				<span class="bar"></span>
				<span class="bar"></span>
				<span class="bar"></span>
			</button>
		</div>
	</nav>

	<!-- Mobile Drawer Dropdown -->
	<div class="mobile-nav-drawer" id="wayfarerMobileDrawer">
		<ul class="mobile-nav-list">
			<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="package-list.php"><i class="fa fa-map-o"></i> Tour Packages</a></li>
			<li><a href="page.php?type=aboutus"><i class="fa fa-info-circle"></i> About Us</a></li>
			<li><a href="page.php?type=contact"><i class="fa fa-envelope-o"></i> Contact</a></li>
			<li><a href="page.php?type=privacy"><i class="fa fa-shield"></i> Privacy Policy</a></li>
			<li><a href="page.php?type=terms"><i class="fa fa-file-text-o"></i> Terms of Use</a></li>
			<?php if($_SESSION['login']) { ?>
				<li class="mobile-divider"></li>
				<li><a href="profile.php"><i class="fa fa-user"></i> My Profile</a></li>
				<li><a href="tour-history.php"><i class="fa fa-suitcase"></i> Tour History</a></li>
				<li><a href="issuetickets.php"><i class="fa fa-ticket"></i> Support Tickets</a></li>
				<li><a href="#" data-toggle="modal" data-target="#myModal3"><i class="fa fa-pencil-square-o"></i> Write Us</a></li>
				<li><a href="change-password.php"><i class="fa fa-key"></i> Change Password</a></li>
				<li><a href="logout.php" class="mobile-logout"><i class="fa fa-sign-out"></i> Log Out</a></li>
			<?php } else { ?>
				<li><a href="enquiry.php"><i class="fa fa-paper-plane-o"></i> Trip Enquiry</a></li>
				<li><a href="admin/index.php"><i class="fa fa-lock"></i> Admin Portal</a></li>
				<li class="mobile-auth-cta">
					<a href="#" data-toggle="modal" data-target="#myModal4" class="btn-mobile-signin">Sign In</a>
					<a href="#" data-toggle="modal" data-target="#myModal" class="btn-mobile-signup">Sign Up</a>
				</li>
			<?php } ?>
		</ul>
	</div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
	var toggleBtn = document.getElementById('wayfarerMobileToggle');
	var drawer = document.getElementById('wayfarerMobileDrawer');
	if (toggleBtn && drawer) {
		toggleBtn.addEventListener('click', function(e) {
			e.stopPropagation();
			toggleBtn.classList.toggle('active');
			drawer.classList.toggle('open');
		});
		document.addEventListener('click', function(e) {
			if (!drawer.contains(e.target) && !toggleBtn.contains(e.target)) {
				drawer.classList.remove('open');
				toggleBtn.classList.remove('active');
			}
		});
	}
});
</script>
