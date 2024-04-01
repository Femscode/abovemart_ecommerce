<!DOCTYPE html>
<html lang="en">


<head>
	<title>AboveMarts Ecommerce</title>
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="learn.abovemarts.com">
	<meta name="description" content="Abovemarts Learning Portal">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Favicon -->
	{{-- <link rel="shortcut icon" href="assets/images/favicon.ico"> --}}

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;700;700&amp;family=Roboto:wght@400;700;700&amp;display=swap">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/font-awesome/css/all.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/choices/css/choices.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/aos/aos.css')}}">

	<!-- Theme CSS -->
	<link id="style-switch" rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css')}}">
	@yield('header')

</head>

<body>

	<!-- Header START -->
	<header class="navbar-light navbar-sticky">
		<!-- Logo Nav START -->
		<nav class="navbar navbar-expand-xl">
			<div class="container">
				<!-- Logo START -->
				<a class="navbar-brand" href="/">
					<h4>AboveMarts Ecommerce</h4>
					{{-- <img class="light-mode-item navbar-brand-item" src="assets/images/logo.svg" alt="logo">
					<img class="dark-mode-item navbar-brand-item" src="assets/images/logo-light.svg" alt="logo"> --}}
				</a>
				<!-- Logo END -->

				<!-- Responsive navbar toggler -->
				<button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
					data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
					aria-label="Toggle navigation">
					<span class="navbar-toggler-animation">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</button>

				<!-- Main navbar START -->
				<div class="navbar-collapse w-100 collapse" id="navbarCollapse">

					<!-- Nav Main menu START -->
					<ul class="navbar-nav navbar-nav-scroll mx-auto">
						<!-- Nav item 1 Demos -->
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="demoMenu" data-bs-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false">Large Market</a>
							<ul class="dropdown-menu" aria-labelledby="demoMenu">
								<li> <a class="dropdown-item" href="/allproducts">All Products</a></li>
							

								<li>
									<hr class="dropdown-divider">
								</li>

							</ul>
						</li>

						<!-- Nav item 3 Account -->
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="accounntMenu" data-bs-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false">Accounts</a>
							<ul class="dropdown-menu" aria-labelledby="accounntMenu">
								<!-- Dropdown submenu -->


								<li> <a class="dropdown-item" href="#"><i class="fas fa-book fa-fw me-1"></i>Bought Products</a> </li>
								<li> <a class="dropdown-item" href="#"><i
											class="fas fa-pen fa-fw me-1"></i>Wishlist</a> </li>
							
									<hr class="dropdown-divider">
								</li>
							</ul>
						</li>

						<!-- Nav item 4 Component-->
					
						<!-- Nav item 5 link-->
						<li class="nav-item dropdown">
							<a class="nav-link" href="#" id="advanceMenu" data-bs-toggle="dropdown" aria-haspopup="true"
								aria-expanded="false">
								<i class="fas fa-ellipsis-h"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-end min-w-auto" data-bs-popper="none">
								<li>
									<a class="dropdown-item" href="https://support.webestica.com/" target="_blank">
										<i class="text-warning fa-fw bi bi-life-preserver me-2"></i>Support
									</a>
								</li>
								<li>
									<a class="dropdown-item" href="docs/index.html" target="_blank">
										<i class="text-danger fa-fw bi bi-card-text me-2"></i>Contact Us
									</a>
								</li>
								<li>
									<hr class="dropdown-divider">
								</li>
							
							</ul>
						</li>
					</ul>
					<!-- Nav Main menu END -->

					<!-- Nav Search START -->
					<div class="nav my-3 my-xl-0 px-4 flex-nowrap align-items-center">
						<div class="nav-item w-100">
							<form class="position-relative">
								<input class="form-control pe-5 bg-transparent" type="search" placeholder="Search"
									aria-label="Search">
								<button
									class="btn bg-transparent px-2 py-0 position-absolute top-70 end-0 translate-middle-y"
									type="submit"><i class="fas fa-search fs-6 "></i></button>
							</form>
						</div>
					</div>
					<!-- Nav Search END -->
				</div>
				<!-- Main navbar END -->

				<!-- Profile START -->
				<div class="dropdown ms-1 ms-lg-0">
					<a class="avatar avatar-sm p-0" href="#" id="profileDropdown" role="button"
						data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown"
						aria-expanded="false">
						<img class="avatar-img rounded-circle" src="{{ asset('assets/images/avatar/avatar1.png')}}" alt="avatar">
					</a>
					<ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3"
						aria-labelledby="profileDropdown">
						<!-- Profile info -->
						<li class="px-3">
							<div class="d-flex align-items-center">
								<!-- Avatar -->
								<div class="avatar me-3">
									<img class="avatar-img rounded-circle shadow" src="{{ asset('assets/images/avatar/avatar1.png')}}"
										alt="avatar">
								</div>
								<div>
									<a class="h6" href="#">{{ $user->name }}</a>
									<p class="small m-0">{{ $user->email }}</p>
								</div>
							</div>
							<hr>
						</li>
						<!-- Links -->
						<li><a class="dropdown-item" href="https://abovemarts.com/profile"><i class="bi bi-person fa-fw me-2"></i>Edit Profile</a>
						</li>
						<li><a class="dropdown-item" href="#"><i class="bi bi-gear fa-fw me-2"></i>Account Settings</a>
						</li>
						<li><a class="dropdown-item" href="#"><i class="bi bi-info-circle fa-fw me-2"></i>Help</a></li>
						<li><a onclick='return confirm("Are you sure you want to sign out?")' class="dropdown-item bg-danger-soft-hover" href="/logout"><i
									class="bi bi-power fa-fw me-2"></i>Sign Out</a></li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<!-- Dark mode switch START -->
						<li>
							<div class="modeswitch-wrap" id="darkModeSwitch">
								<div class="modeswitch-item">
									<div class="modeswitch-icon"></div>
								</div>
								<span>Dark mode</span>
							</div>
						</li>
						<!-- Dark mode switch END -->
					</ul>
				</div>
				<!-- Profile START -->
			</div>
		</nav>
		<!-- Logo Nav END -->
	</header>
	<!-- Header END -->

	<!-- **************** MAIN CONTENT START **************** -->
	<main>

		<!-- =======================
Page Banner START -->
		<section class="pt-0">
			<div class="container-fluid px-0">
				<div class="card bg-blue h-200px h-md-200px rounded-0"
					style="background:url(assets/images/pattern/04.png) no-repeat center center; background-size:cover;">
					{{-- <h6 style='color:white;text-align:center;padding:10px'>Exciting news! Our E-Library is live, offering free access to a 
						growing collection of e-books, audios, videos, and software. 
						Explore the initial gems now, and stay tuned as we expand our virtual shelves
						 with over 10,000+ resources. Thank you for your understanding and trust
						  in our commitment to a robust E-Learning experience.</h6> --}}
				</div>
			</div>
			<div class="container mt-n4">
				<div class="row">
					<div class="col-12">
						<div class="card bg-transparent card-body pb-0 ps-0 mt-2 mt-sm-0">
							<div class="row d-sm-flex justify-sm-content-between mt-2 mt-md-0">
								<!-- Avatar -->
								<div class="col-auto">
									<div class="avatar avatar-xxl position-relative mt-n3">
										<img class="avatar-img rounded-circle border border-white border-3 shadow"
											src="{{ asset('assets/images/avatar/avatar1.png')}}" alt="">
										{{-- <span
											class="badge bg-success text-white rounded-pill position-absolute top-70 start-100 translate-middle mt-4 mt-md-5 ms-n3 px-md-3">Pro</span> --}}
									</div>
								</div>
								<!-- Profile info -->
								{{-- <div class='alert alert-info col-md-12'>Exciting man</div> --}}
								<div class="col d-sm-flex justify-content-between align-items-center">
									<div>
										<h1 class="my-1 fs-4">Welcome, {{ $user->firstName }} {{ $user->lastName }}</h1>
										<ul class="list-inline mb-0">
											<li class="list-inline-item me-3 mb-1 mb-sm-0">
												{{-- <span class="h6">0</span>
												<span class="text-body fw-light">points</span> --}}
												<span class='text-success'> {{ $user->package }} Package ({{ $user->point ?? "0" }} Points)</span><br>
												<span class='text-success'>Wallet Balance : NGN{{ number_format($balance ?? "0", 2) }}</span>
											</li>
											<li class="list-inline-item me-3 mb-1 mb-sm-0">
												<span class="h6">0</span>
												<span class="text-body fw-light">Available Products</span>
											</li>
											<li class="list-inline-item me-3 mb-1 mb-sm-0">
												<span class="h6">0</span>
												<span class="text-body fw-light">Bought Products</span>
											</li>
										</ul>
									</div>
									
								</div>
							</div>
						</div>

						<!-- Advanced filter responsive toggler START -->
						<!-- Divider -->
						<hr class="d-xl-none">
						<div class="col-12 col-xl-3 d-flex justify-content-between align-items-center">
							<a class="h6 mb-0 fw-bold d-xl-none" href="#">Menu</a>
							<button class="btn btn-primary d-xl-none" type="button" data-bs-toggle="offcanvas"
								data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
								<i class="fas fa-sliders-h"></i>
							</button>
						</div>
						<!-- Advanced filter responsive toggler END -->
					</div>
				</div>
			</div>
		</section>
		<!-- =======================
Page Banner END -->

		<!-- =======================
Page content START -->
		<section class="pt-0">
			<div class="container">
				<div class="row">

					<!-- Right sidebar START -->
					<div class="col-xl-3">
						<!-- Responsive offcanvas body START -->
						<nav class="navbar navbar-light navbar-expand-xl mx-0">
							<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
								aria-labelledby="offcanvasNavbarLabel">
								<!-- Offcanvas header -->
								<div class="offcanvas-header bg-light">
									<h5 class="offcanvas-title" id="offcanvasNavbarLabel">My profile</h5>
									<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
										aria-label="Close"></button>
								</div>
								<!-- Offcanvas body -->
								<div class="offcanvas-body p-3 p-xl-0">
									<div class="bg-dark border rounded-3 pb-0 p-3 w-100">
										<!-- Dashboard menu -->
										<div class="list-group list-group-dark list-group-borderless">
											<a class="list-group-item" href="/dashboard"><i
													class="bi bi-ui-checks-grid fa-fw me-2"></i>Dashboard</a>
											<a class="list-group-item" href="/dashboard"><i
													class="bi bi-card-checklist fa-fw me-2"></i>Available Products</a>
											<a class="list-group-item" href="/allcourses"><i
													class="bi bi-basket fa-fw me-2"></i>All Products</a>
												
											@if($user->package !== "Basic")
													<a class="list-group-item" href="https://abovemarts.com/fund"><i
													class="bi bi-cart-check fa-fw me-2"></i>Fund Wallet</a>
												@endif
											<a class="list-group-item" href="https://abovemarts.com/profile"><i
													class="bi bi-pencil-square fa-fw me-2"></i>Edit Profile</a>
											<a class="list-group-item" href="#"><i
													class="bi bi-gear fa-fw me-2"></i>Settings</a>
											{{-- <a class="list-group-item" href="#"><i
													class="bi bi-trash fa-fw me-2"></i>Delete Profile</a> --}}
											<a onclick='return confirm("Are you sure you want to sign out?")' class="list-group-item text-danger bg-danger-soft-hover" href="/logout"><i
													class="fas fa-sign-out-alt fa-fw me-2"></i>Sign Out</a>
										</div>
									</div>
								</div>
							</div>
						</nav>
						<!-- Responsive offcanvas body END -->
					</div>
					<!-- Right sidebar END -->

					<!-- Main content START -->
				@yield('content')
				</div>
			</div>
		</section>
		<!-- =======================
Page content END -->

	</main>
	<!-- **************** MAIN CONTENT END **************** -->

	<!-- =======================
Footer START -->
	<footer class="bg-dark p-3">
		<div class="container">
			<div class="row align-items-center">
				<!-- Widget -->
				<div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
					<!-- Logo START -->
                    <h5 class='text-white'>AboveMarts Ecommerce</h5>
					{{-- <a href="index.html"> <img class="h-20px" src="assets/images/logo-light.svg" alt="logo"> </a> --}}
				</div>

				<!-- Widget -->
				<div class="col-md-4 mb-3 mb-md-0">
					<div class="text-center text-white">
						Copyrights © <?php echo Date('Y'); ?> <a href="#" class="text-reset btn-link">AboveMarts Ecommerce</a>. All rights reserved.
					</div>
				</div>
				<!-- Widget -->
				<div class="col-md-4">
					<!-- Rating -->
					<ul class="list-inline mb-0 text-center text-md-end">
						<li class="list-inline-item ms-2"><a href="#"><i class="text-white fab fa-facebook"></i></a>
						</li>
						<li class="list-inline-item ms-2"><a href="#"><i class="text-white fab fa-instagram"></i></a>
						</li>
						<li class="list-inline-item ms-2"><a href="#"><i class="text-white fab fa-linkedin-in"></i></a>
						</li>
						<li class="list-inline-item ms-2"><a href="#"><i class="text-white fab fa-twitter"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<!-- =======================
Footer END -->

	<!-- Back to top -->
	<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-70 start-70 translate-middle"></i></div>

	<!-- Bootstrap JS -->
	<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

	<!-- Vendors -->
	<script src="assets/vendor/choices/js/choices.min.js"></script>
	<script src="assets/vendor/purecounterjs/dist/purecounter_vanilla.js"></script>
	<script src="assets/vendor/aos/aos.js"></script>

	<!-- Template Functions -->
	<script src="assets/js/functions.js"></script>
	
	<script src="{{ asset('assets/jquery.js')}}"></script>
	<script src="{{ asset('assets/sweetalert.js')}}"></script>
	<script> 
	$(document).ready(function() {
		
		@if (session('message'))
            			swal('Success!',"{{ session('message') }}",'success');
        			@endif
					@if (session('error'))
            			swal('Error!',"{{ session('error') }}",'error');
        			@endif
	})
	</script>
	@yield('script')
</body>

<!-- Mirrored from eduport.webestica.com/student-dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 15 Mar 2022 20:31:51 GMT -->

</html>