<?php 
$base_url = base_url();

$cookie_user = NULL;

if (is_member()) $cookie_user = get_user_cookie();

// Bypass data from middleware
$list_unavail_menu = \Request::get('list_unavail_menu');
$list_avail_menu = \Request::get('list_avail_menu');
$list_access_current_menu = \Request::get('list_access_current_menu');

?>
<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<header class="topbar" data-navbarbg="skin5">
	<nav class="navbar top-navbar navbar-expand-md navbar-dark">
		<div class="navbar-header" data-logobg="skin5">
			<!-- This is for the sidebar toggle which is visible on mobile only -->
			<a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
			<!-- ============================================================== -->
			<!-- Logo -->
			<!-- ============================================================== -->
			<a class="navbar-brand" href="<?php echo $base_url.Request::segment(1)?>">
				<!-- Logo icon -->
				<b class="logo-icon p-l-10">
					<!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
					<!-- Dark Logo icon -->
					<img src="../public/matrix/assets/images/logo-icon.png" alt="homepage" class="light-logo" />
				   
				</b>
				<!--End Logo icon -->
				 <!-- Logo text -->
				<span class="logo-text">
					 <!-- dark Logo text -->
					 <img src="../public/matrix/assets/images/logo-text.png" alt="homepage" class="light-logo" />
					
				</span>
				<!-- Logo icon -->
				<!-- <b class="logo-icon"> -->
					<!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
					<!-- Dark Logo icon -->
					<!-- <img src="../public/matrix/assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->
					
				<!-- </b> -->
				<!--End Logo icon -->
			</a>
			<!-- ============================================================== -->
			<!-- End Logo -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- Toggle which is visible on mobile only -->
			<!-- ============================================================== -->
			<a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
		</div>
		<!-- ============================================================== -->
		<!-- End Logo -->
		<!-- ============================================================== -->
		<div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
			<!-- ============================================================== -->
			<!-- toggle and nav items -->
			<!-- ============================================================== -->
			<ul class="navbar-nav float-left mr-auto">
				<li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
				<!-- ============================================================== -->
				<!-- create new -->
				<!-- ============================================================== -->
				<!-- <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					 <span class="d-none d-md-block">Create New <i class="fa fa-angle-down"></i></span>
					 <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>   
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="#">Action</a>
						<a class="dropdown-item" href="#">Another action</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Something else here</a>
					</div>
				</li> -->
				<!-- ============================================================== -->
				<!-- Search -->
				<!-- ============================================================== -->
				<!-- <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
					<form class="app-search position-absolute">
						<input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
					</form>
				</li> -->
			</ul>
			<!-- ============================================================== -->
			<!-- Right side toggle and nav items -->
			<!-- ============================================================== -->
			<ul class="navbar-nav float-right">
				<!-- ============================================================== -->
				<!-- Comment -->
				<!-- ============================================================== -->
				<!-- <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell font-24"></i>
					</a>
					 <div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="#">Action</a>
						<a class="dropdown-item" href="#">Another action</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Something else here</a>
					</div>
				</li> -->
				<!-- ============================================================== -->
				<!-- End Comment -->
				<!-- ============================================================== -->
				<!-- ============================================================== -->
				<!-- Messages -->
				<!-- ============================================================== -->
				<!-- <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="font-24 mdi mdi-comment-processing"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
						<ul class="list-style-none">
							<li>
								<div class="">

									<a href="javascript:void(0)" class="link border-top">
										<div class="d-flex no-block align-items-center p-10">
											<span class="btn btn-success btn-circle"><i class="ti-calendar"></i></span>
											<div class="m-l-10">
												<h5 class="m-b-0">Event today</h5> 
												<span class="mail-desc">Just a reminder that event</span> 
											</div>
										</div>
									</a>
									
									<a href="javascript:void(0)" class="link border-top">
										<div class="d-flex no-block align-items-center p-10">
											<span class="btn btn-info btn-circle"><i class="ti-settings"></i></span>
											<div class="m-l-10">
												<h5 class="m-b-0">Settings</h5> 
												<span class="mail-desc">You can customize this template</span> 
											</div>
										</div>
									</a>
									
									<a href="javascript:void(0)" class="link border-top">
										<div class="d-flex no-block align-items-center p-10">
											<span class="btn btn-primary btn-circle"><i class="ti-user"></i></span>
											<div class="m-l-10">
												<h5 class="m-b-0">Pavan kumar</h5> 
												<span class="mail-desc">Just see the my admin!</span> 
											</div>
										</div>
									</a>
									
									<a href="javascript:void(0)" class="link border-top">
										<div class="d-flex no-block align-items-center p-10">
											<span class="btn btn-danger btn-circle"><i class="fa fa-link"></i></span>
											<div class="m-l-10">
												<h5 class="m-b-0">Luanch Admin</h5> 
												<span class="mail-desc">Just see the my new admin!</span> 
											</div>
										</div>
									</a>
								</div>
							</li>
						</ul>
					</div>
				</li> -->
				<!-- ============================================================== -->
				<!-- End Messages -->
				<!-- ============================================================== -->

				<!-- ============================================================== -->
				<!-- User profile and search -->
				<!-- ============================================================== -->
				<?php 
				if (is_member()) {
					// $cookie_user = get_cookie('tokenhash');
					// if (isset($cookie_user['member_id'])) 
					// if (isset($cookie_user['name'])) 
					// if (isset($cookie_user['email'])) 
					// cookie_user
					// debug($cookie,1);
				
				?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../public/matrix/assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"> Welcome, {{ $cookie_user['fullname'] or '' }}, Role: {{ $cookie_user['role_name'] or '' }}</a>
					<div class="dropdown-menu dropdown-menu-right user-dd animated">
						<a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
						<!--
						<a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>
						-->
						<a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i> Inbox</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?php echo $base_url.'logout'; ?>"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
						<div class="dropdown-divider"></div>
						<div class="p-l-30 p-10"><a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded">View Profile</a></div>
					</div>
				</li>
				<?php 
				}
				?>
				<!-- ============================================================== -->
				<!-- User profile and search -->
				<!-- ============================================================== -->
			</ul>
		</div>
	</nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin5">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav" class="p-t-30">
				<li class="sidebar-item hide"><a class="sidebar-link" id="client_dashboard" href="dashboard"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
				<li class="sidebar-item hide"> 
					<a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Master User</span></a>
					<ul aria-expanded="false" class="collapse  first-level">						
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_user" href="user"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">User</span></a></li>
						<li class="sidebar-item hide"> <a class="sidebar-link waves-effect waves-dark sidebar-link " id="client_user-attribute" href="user-attribute"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">User attribute</span></a></li>
						<li class="sidebar-item hide"> <a class="sidebar-link waves-effect waves-dark sidebar-link " id="client_user-role" href="user-role"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">User role</span></a></li>
					</ul>
				</li>
				
				<li class="sidebar-item hide"> 
					<a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-pencil"></i><span class="hide-menu">Master Article</span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_article" href="article"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Article</span></a></li>
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_article_attribute" href="article-attribute"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Article Attribute</span></a></li>
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_article_attribute_value" href="article-attribute-value"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Article Attribute Value</span></a></li>
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_article_stock" href="article-stock"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Article Stock</span></a></li>
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_rfid_article" href="rfid-article"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">RFID Article</span></a></li>
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_article_po" href="article-po"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Article PO</span></a></li>
					</ul>
				</li>
				
				<li class="sidebar-item hide"> 
					<a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-face"></i><span class="hide-menu">Master Other</span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_company" href="company"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Company</span></a></li>
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_site" href="site"><i class="mdi mdi-chart-bar"></i><span>Site</span></a></li>
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_pic" href="pic"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">PIC</span></a></li>						
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_level" href="level"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Level</span></a></li>
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_reason" href="reason"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Reason</span></a></li>
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_reason-type" href="reason-type"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Reason Type</span></a></li>
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_reason-type-mapping" href="reason-type-mapping"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Reason Type Mapping</span></a></li>
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_config" href="config"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Config</span></a></li>
					</ul>
				</li>
							
				<!-- <li class="sidebar-item"> <a class="sidebar-link" id="client_transaction" href="transaction"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Transaction</span></a></li> -->
				
				<li class="sidebar-item hide"> 
					<a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-face"></i><span class="hide-menu">Transaction</span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_transaction" href="transaction"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Transaction</span></a></li>
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_article_logistic_site" href="article-logistic-site"><i class="mdi mdi-chart-bar"></i><span>Article Logistic Site</span></a></li>
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_article_logistic_site_detail" href="article-logistic-site-detail"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Article Logistic Site Detail</span></a></li>						
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_article_po_history" href="article-po-history"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Article PO History</span></a></li>						
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_movement_article" href="movement-article"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Movement Article</span></a></li>
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_movement_quota_level" href="movement-quota-level"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Movement Quota Level</span></a></li>
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_prepack_bundling_header" href="prepack-bundling-header"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Prepack Bundling Header</span></a></li>
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_prepack_bundling_detail" href="prepack-bundling-detail"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Prepack Bundling Detail</span></a></li>	
					</ul>
				</li>
				
				
				<li class="sidebar-item hide"> 
					<a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-note-plus"></i><span class="hide-menu">Access Role</span></a>
					<ul aria-expanded="false" class="collapse first-level">
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_capability" href="capability"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Capability</span></a></li>
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_role" href="role"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Role</span></a></li>
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_role-capability" href="role-capability"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Role Capability</span></a></li>
						<li class="sidebar-item hide"> <a class="sidebar-link" id="client_movement" href="movement"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Movement</span></a></li>
					</ul>
				</li>
				
				<?php 
				// $acl = $cookie = NULL;
				// $cookie = get_user_cookie();
				// debug($cookie);
				
				// $api_url = $api_method = $api_param = $api_header = NULL;
				// $api_param['token'] = env('API_KEY');
				// $api_param['user_id'] = $cookie['user_id'];
				// $api_url = env('API_URL').'user_role/get';
				// $api_method = 'get';
				// // $api_header['debug'] = 1;
				
				// $acl = curl_api_liquid($api_url, $api_method, $api_header, $api_param);
				// debug($acl);
				// $url = curl_api_liquid(,'get',);
				// debug($menu);
				?>
				
				<!--
				DUMMY MENU AND ICON START
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.html" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
				
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link active" id="charts" href="charts.html" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Charts</span></a></li>
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="widgets.html" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Widgets</span></a></li>
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="tables.html" aria-expanded="false"><i class="mdi mdi-border-inside"></i><span class="hide-menu">Tables</span></a></li>
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="grid.html" aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">Full Width</span></a></li>
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Forms </span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="form-basic.html" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Form Basic </span></a></li>
						<li class="sidebar-item"><a href="form-wizard.html" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Form Wizard </span></a></li>
					</ul>
				</li>
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-buttons.html" aria-expanded="false"><i class="mdi mdi-relative-scale"></i><span class="hide-menu">Buttons</span></a></li>
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-face"></i><span class="hide-menu">Icons </span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="icon-material.html" class="sidebar-link"><i class="mdi mdi-emoticon"></i><span class="hide-menu"> Material Icons </span></a></li>
						<li class="sidebar-item"><a href="icon-fontawesome.html" class="sidebar-link"><i class="mdi mdi-emoticon-cool"></i><span class="hide-menu"> Font Awesome Icons </span></a></li>
					</ul>
				</li>
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-elements.html" aria-expanded="false"><i class="mdi mdi-pencil"></i><span class="hide-menu">Elements</span></a></li>
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-move-resize-variant"></i><span class="hide-menu">Addons </span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="index2.html" class="sidebar-link"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu"> Dashboard-2 </span></a></li>
						<li class="sidebar-item"><a href="pages-gallery.html" class="sidebar-link"><i class="mdi mdi-multiplication-box"></i><span class="hide-menu"> Gallery </span></a></li>
						<li class="sidebar-item"><a href="pages-calendar.html" class="sidebar-link"><i class="mdi mdi-calendar-check"></i><span class="hide-menu"> Calendar </span></a></li>
						<li class="sidebar-item"><a href="pages-invoice.html" class="sidebar-link"><i class="mdi mdi-bulletin-board"></i><span class="hide-menu"> Invoice </span></a></li>
						<li class="sidebar-item"><a href="pages-chat.html" class="sidebar-link"><i class="mdi mdi-message-outline"></i><span class="hide-menu"> Chat Option </span></a></li>
					</ul>
				</li>
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">Authentication </span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="authentication-login.html" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Login </span></a></li>
						<li class="sidebar-item"><a href="authentication-register.html" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Register </span></a></li>
					</ul>
				</li>
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-alert"></i><span class="hide-menu">Errors </span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="error-403.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 403 </span></a></li>
						<li class="sidebar-item"><a href="error-404.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 404 </span></a></li>
						<li class="sidebar-item"><a href="error-405.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 405 </span></a></li>
						<li class="sidebar-item"><a href="error-500.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 500 </span></a></li>
					</ul>
				</li>
				DUMMY MENU AND ICON END
				-->
			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<!--
$('#charts').parent('li').addClass('selected')
-->
<script>
$(document).ready(function(){
	// disable all menu
	// $('li.sidebar-item').addClass('hide');
	$('li.sidebar-item').removeClass('hide');

	<?php 
	// [NOT_USED]Hide menu when not avail
	// if (! empty($list_unavail_menu)) {

	// }
	?>

	<?php 
	// [READY_DEPLOY] Activate when menu avail
	// if (! empty($list_avail_menu)) {
		// foreach ($list_avail_menu as $key => $menu) {

		?>
		// open menu
	// $("a[href*=<?php // echo $menu['capability'] ?>").parents('.sidebar-item').removeClass('hide');

		<?php 

		// }
	// }

	// [READY_DEPLOY], inactive due to open all limitation
	// if (! empty($list_access_current_menu)) 
	// {
	// 	if ($list_access_current_menu['create'] != 1) {
	// 		echo "$('.btncreate').hide();";
	// 	}

	// 	if ($list_access_current_menu['read'] != 1) {
	// 		echo "$('.btnread').hide();";
	// 	}

	// 	if ($list_access_current_menu['update'] != 1) {
	// 		echo "$('.btnupdate').hide();";
	// 	}

	// 	if ($list_access_current_menu['delete'] != 1) {
	// 		echo "$('.btndelete').hide();";
	// 	}
	// }
	?>

	//disable bulk action but this is no effect
	$('#group_action').addClass('hide');

	// $('.btnview').hide(); // no access for view data
	// $('.btninsert').hide(); // no access for save data
	// $('.btnedit').hide(); // no access for edit data	
	// $('.btndelete').hide(); // no access for delete data
})
</script>