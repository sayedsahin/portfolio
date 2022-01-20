<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="<?= BASE_URL; ?>/public/css/sidebar.css">
	<title>Document</title>
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
			<!-- <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
		      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
		      <span class="fs-4">Sayed Sahin</span>
		  </a> -->
		  <ul class="list-unstyled ps-0 mt-5" id="navbarToggleExternalContent">
		  	<li class="mb-1">
		  		<button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
		  			Information
		  		</button>
		  		<div class="collapse" id="home-collapse" style="">
		  			<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
		  				<li><a href="<?= BASE_URL ?>/user/edit" class="link-dark rounded">My Info</a></li>
		  				<li><a href="<?= BASE_URL ?>/dashboard/site" class="link-dark rounded">Site Info</a></li>
		  			</ul>
		  		</div>
		  	</li>
		  	<li class="mb-1">
		  		<button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#project-collapse" aria-expanded="false">
		  			Project
		  		</button>
		  		<div class="collapse" id="project-collapse" style="">
		  			<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
		  				<li><a href="<?= BASE_URL ?>/project" class="link-dark rounded">Project List</a></li>
		  				<li><a href="<?= BASE_URL ?>/project/create" class="link-dark rounded">Project Add</a></li>
		  			</ul>
		  		</div>
		  	</li>
		  	<li class="mb-1">
		  		<button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
		  			Social Link
		  		</button>
		  		<div class="collapse" id="dashboard-collapse" style="">
		  			<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
		  				<li><a href="<?= BASE_URL ?>/social" class="link-dark rounded">Social List</a></li>
		  				<li><a href="<?= BASE_URL ?>/social/create" class="link-dark rounded">Add Social</a></li>
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
		  				<li><a href="<?= BASE_URL ?>/dashboard/password" class="link-dark rounded">Change Password</a></li>
		  				<li><a href="<?= BASE_URL; ?>/account/logout" class="link-dark rounded">Sign out</a></li>
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
						<li class="nav-item active"><a class="nav-link" href="/">Sayed Sahin</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- Page content-->
		<div class="container-fluid">