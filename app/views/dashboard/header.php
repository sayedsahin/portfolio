<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="<?= BASE_URL; ?>/public/css/sidebar.css">
	<title><?= session()->get('name'); ?> - Dashboard</title>
	<style>
		#wrapper {overflow-x: hidden;}
		#sidebar-wrapper {min-height: 100vh;margin-left: -15rem;transition: margin 0.25s ease-out;}
		#sidebar-wrapper .sidebar-heading {padding: 0.875rem 1.25rem;font-size: 1.2rem;}
		#sidebar-wrapper .sidebar {width: 15rem;}
		#page-content-wrapper {min-width: 100vw;}
		body.sb-sidenav-toggled #wrapper #sidebar-wrapper {margin-left: 0;}
		@media (min-width: 768px) {
			#sidebar-wrapper {	margin-left: 0;}
			#page-content-wrapper {	min-width: 0;	width: 100%;}
			body.sb-sidenav-toggled #wrapper #sidebar-wrapper {	margin-left: -15rem;}
		}
	</style>
</head>
<body>
	<div class="d-flex" id="wrapper">
		<!-- Sidebar-->
		<div id="sidebar-wrapper" style="background: #f5f5f5;">
			<div class="sidebar flex-shrink-0 p-3">
			<a href="<?= BASE_URL; ?>/dashboard" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none fs-5 fw-bold">
		      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
		      <span class="fs-4">Dashboard</span>
		  </a>
		  <ul class="list-unstyled ps-0" id="navbarToggleExternalContent">
		  	<li class="mb-1">
		  		<button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
		  			Information
		  		</button>
		  		<div class="collapse" id="home-collapse" style="">
		  			<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
		  				<li><a href="<?= BASE_URL ?>/user" class="link-dark rounded">My Info</a></li>
		  				<li><a href="<?= BASE_URL ?>/site" class="link-dark rounded">Site Info</a></li>
		  			</ul>
		  		</div>
		  	</li>
		  	<li class="mb-1">
		  		<button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#project-collapse" aria-expanded="false">
		  			Project
		  		</button>
		  		<div class="collapse" id="project-collapse" style="">
		  			<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
		  				<li><a href="<?= BASE_URL ?>/projects" class="link-dark rounded">Project List</a></li>
		  				<li><a href="<?= BASE_URL ?>/projects/create" class="link-dark rounded">Project Add</a></li>
		  			</ul>
		  		</div>
		  	</li>
		  	<li class="mb-1">
		  		<button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#message-collapse" aria-expanded="false">
		  			Social Link
		  		</button>
		  		<div class="collapse" id="message-collapse" style="">
		  			<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
		  				<li><a href="<?= BASE_URL ?>/socials" class="link-dark rounded">Social List</a></li>
		  				<li><a href="<?= BASE_URL ?>/socials/create" class="link-dark rounded">Add Social</a></li>
		  			</ul>
		  		</div>
		  	</li>
		  	<li class="mb-1">
		  		<button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
		  			Message
		  		</button>
		  		<div class="collapse" id="dashboard-collapse" style="">
		  			<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
		  				<li><a href="<?= BASE_URL ?>/messages" class="link-dark rounded">Inbox</a></li>
		  				<li><a href="<?= BASE_URL ?>/messages/new" class="link-dark rounded">New</a></li>
		  			</ul>
		  		</div>
		  	</li>
		  	<li class="border-top my-3"></li>
		  	<li class="mb-1">
		  		<button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
		  			Account
		  		</button>
		  		<div class="collapse" id="account-collapse" style="">
		  			<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
		  				<li><a href="<?= BASE_URL ?>/password" class="link-dark rounded">Change Password</a></li>
		  				<li><a href="<?= BASE_URL; ?>/logout" class="link-dark rounded">Sign out</a></li>
		  			</ul>
		  		</div>
		  	</li>
		  </ul>
		</div>
	</div>
	<!-- Page content wrapper-->
	<div id="page-content-wrapper">
		<!-- Top navigation-->
		<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
			<div class="container-fluid">
				<div id="sidebarToggle" style="cursor: pointer;">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
					</svg>
				</div>
				<div>
					<ul class="navbar-nav mt-2 mt-lg-0">
						<li class="nav-item active">
							<a class="nav-link" href="<?= BASE_URL; ?>" target="_blank">Sayed Sahin 
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-external-link"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- Page content-->
		<div class="container-fluid">