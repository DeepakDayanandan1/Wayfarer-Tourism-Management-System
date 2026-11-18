<div class="sidebar-menu">
	<header class="logo1">
		<a href="#" class="sidebar-icon"><span class="fa fa-bars"></span></a> 
	</header>
	<div style="border-top:1px ridge rgba(255, 255, 255, 0.15)"></div>
	<div class="menu">
		<ul id="menu">
			<li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
				<a href="{{ route('admin.dashboard') }}"><i class="fa fa-tachometer"></i> <span>Dashboard</span><div class="clearfix"></div></a>
			</li>
			<li id="menu-packages" class="{{ request()->routeIs('admin.packages.*') ? 'active open' : '' }}">
				<a href="javascript:void(0);" class="menu-packages-toggle" onclick="togglePackageSubmenu(event);">
					<i class="fa fa-list-ul" aria-hidden="true"></i>
					<span> Tour Packages</span>
					<span class="fa fa-angle-right menu-chevron" style="float: right"></span>
					<div class="clearfix"></div>
				</a>
				<ul id="menu-packages-sub">
					<li class="{{ request()->routeIs('admin.packages.create') ? 'active' : '' }}">
						<a href="{{ route('admin.packages.create') }}"><i class="fa fa-plus-circle"></i> Create</a>
					</li>
					<li class="{{ request()->routeIs('admin.packages.index') ? 'active' : '' }}">
						<a href="{{ route('admin.packages.index') }}"><i class="fa fa-th-list"></i> Manage</a>
					</li>
				</ul>
			</li>
			<li class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
				<a href="{{ route('admin.users.index') }}"><i class="fa fa-users" aria-hidden="true"></i><span>Manage Users</span><div class="clearfix"></div></a>
			</li>
			<li class="{{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
				<a href="{{ route('admin.bookings.index') }}"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> <span>Manage Bookings</span><div class="clearfix"></div></a>
			</li>
			<li class="{{ request()->routeIs('admin.issues.*') ? 'active' : '' }}">
				<a href="{{ route('admin.issues.index') }}"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <span>Manage Issues</span><div class="clearfix"></div></a>
			</li>
			<li class="{{ request()->routeIs('admin.enquiries.*') ? 'active' : '' }}">
				<a href="{{ route('admin.enquiries.index') }}"><i class="fa fa-envelope-o" aria-hidden="true"></i> <span>Manage Enquiries</span><div class="clearfix"></div></a>
			</li>
			<li class="{{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
				<a href="{{ route('admin.pages.index') }}"><i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Manage Pages</span><div class="clearfix"></div></a>
			</li>
		</ul>
	</div>
</div>

<script>
function togglePackageSubmenu(e) {
	if (e) e.preventDefault();
	var menuPackages = document.getElementById('menu-packages');
	if (menuPackages) {
		menuPackages.classList.toggle('open');
	}
}
</script>
