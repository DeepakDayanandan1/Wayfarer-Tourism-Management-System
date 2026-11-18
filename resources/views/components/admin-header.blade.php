<div class="header-main">
	<div class="logo-w3-agile">
		<h1><a href="{{ route('admin.dashboard') }}"><i class="fa fa-compass" style="color:#ff5e3a;margin-right:6px;"></i>Wayfarer Admin</a></h1>
	</div>
	<div class="profile_details w3l">		
		<ul>
			<li class="dropdown profile_details_drop">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<div class="profile_img">	
						<span class="prfil-img"><img src="{{ asset('admin/images/User-icon.png') }}" alt="Admin"></span> 
						<div class="user-name">
							<p>{{ Auth::guard('admin')->user()->UserName ?? 'Administrator' }}</p>
							<span>Administrator</span>
						</div>
						<i class="fa fa-angle-down"></i>
						<i class="fa fa-angle-up"></i>
						<div class="clearfix"></div>	
					</div>	
				</a>
				<ul class="dropdown-menu drp-mnu">
					<li><a href="{{ route('admin.profile.index') }}"><i class="fa fa-user"></i> Profile</a></li> 
					<li><a href="{{ route('admin.profile.password') }}"><i class="fa fa-cog"></i> Settings</a></li> 
					<li>
						<form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
						<a href="#" onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
							<i class="fa fa-sign-out"></i> Logout
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
	<div class="clearfix"></div>	
</div>

