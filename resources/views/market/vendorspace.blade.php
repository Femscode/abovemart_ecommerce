<!DOCTYPE html>
<html lang="en">


<head>
    <title>AboveMarts Ecommerce</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="learn.abovemarts.com">
    <meta name="description" content="Abovemarts Ecommerce Portal">

    <!-- Favicon -->
    {{--
    <link rel="shortcut icon" href="assets/images/favicon.ico"> --}}

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

    <!-- **************** MAIN CONTENT START **************** -->
    <main>

        <!-- =======================
Page Banner START -->
        <section class="bg-blue align-items-center d-flex"
            style="background:url(assets/images/pattern/04.png) no-repeat center center; background-size:cover;">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <!-- Title -->
                        <h1 class="text-white">Products By {{ $vendor->firstName }}</h1>
                        <!-- Breadcrumb -->
                        <div class="d-flex justify-content-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb breadcrumb-dark breadcrumb-dots mb-0">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All products</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- =======================
Page Banner END -->

        <!-- =======================
Page content START -->
        <section class="py-5">
            <div class="container">
                <div class="row">
                    <!-- Main content START -->
                    <div class="col-lg-12 col-xl-12">

                        <!-- Search option START -->
                        <div class="row mb-4 align-items-center">
                            <!-- Search bar -->
                            <div class="col-xl-6">
                                <form class="border rounded p-2">
                                    <div class="input-group input-borderless">
                                        <input class="form-control me-1" type="search" placeholder="Find a product">
                                        <button type="button" class="btn btn-primary mb-0 rounded z-index-1"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>

                            <!-- Select option -->
                            <div class="col-xl-3 mt-3 mt-xl-0">
                                <form class="border rounded p-2 input-borderless">
                                    <select class="form-select form-select-sm js-choice border-0"
                                        aria-label=".form-select-sm">
                                        @foreach($categories as $key => $category)
                                        <option value="">{{ $category->name }}</option>
                                            
                                        @endforeach
                                      
                                    </select>
                                </form>
                            </div>

                            <!-- Content -->
                            <div class="col-12 col-xl-3 d-flex justify-content-between align-items-center mt-3 mt-xl-0">
                                <!-- Advanced filter responsive toggler START -->
                                <button class="btn btn-primary mb-0 d-lg-none" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                                    <i class="fas fa-sliders-h me-1"></i> Show filter
                                </button>
                              
                            </div>

                        </div>
                        <!-- Search option END -->

                        <!-- Course Grid START -->
                        <div class="row g-4">

                            @foreach($products as $product)
                            <!-- Card item START -->
                           

                            <div class="col-sm-6 col-xl-4">
                                <div class="card shadow h-100">
                                    <!-- Image -->
                                    <img src="https://shop.abovemarts.com/public/productimage/{{ $product->image}}" class="card-img-top" alt="course image">
                                    <!-- Card body -->
                                    <div class="card-body pb-0">
                                        <!-- Badge and favorite -->
                                        <div class="d-flex justify-content-between mb-2">
                                            <a href="#" class="badge bg-purple bg-opacity-10 text-purple">{{ $product->cat->name ??
                                                "" }}</a>
                                            <a href="#" class="h6 fw-light mb-0"><i class="far fa-heart"></i></a>
                                        </div>
                                        <!-- Title -->
                                        <h5 class="card-title fw-normal"><a href="/preview_course/{{ $product->uid }}">{{
                                            $product->title }}</a></h5>
                                       <p class="mb-2 text-truncate-2">{!! Str_limit($product->description,100) !!}</p>
                                       <!-- Rating star -->
                                     
                                    </div>
                                    <!-- Card footer -->
                                    <div class="card-footer pt-0 pb-3">
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            {{-- <span class="h6 fw-light mb-0"><i class="far fa-clock text-danger me-2"></i>{{
                                                $product->duration }}Hrs</span> --}}
                                            @if($product->price == 0)
                                            <label class="btn btn-sm btn-light btn-primary-soft-check border-0 m-0"
                                                for="option1">Free</label>@else
                                            <label class="btn btn-sm btn-light btn-primary-soft-check border-0 m-0" for="option1">
                                                NGN{{ number_format($product->price) }} <s>NGN{{ number_format($product->slashed_price)
                                                    }}</s>
                                            </label>
                                            @endif
                                        </div><br>
                                        
            
            
                                        {{-- //To be reomv later --}}
                                        <a href='/preview_product/{{ $product->uid }}' class='btn btn-info btn-sm'>Preview</a>
							
                                      
                                        <a href='/deliverydetails/{{ $product->uid }}' class='btn btn-success btn-sm'>Buy Now</a>
							
                                        {{-- <a onclick="return confirm('Are you sure you want to purchase this product?')" href='/buyproduct/{{ $product->uid }}' class='btn btn-success btn-sm'>Buy Now</a> --}}
            
                                      
            
            
                                     
                                    </div>
                                </div>
                            </div>
                        
                            @endforeach
                           

                        </div>
                        <!-- Course Grid END -->

                        <!-- Pagination START -->
                        <div class="col-12">
                            {!! $products->links('pagination::bootstrap-4') !!}
                        </div>
                        <!-- Pagination END -->
                    </div>
                    <!-- Main content END -->

                    <!-- Right sidebar START -->
                    <div class="col-lg-4 col-xl-3">
                        <!-- Responsive offcanvas body START -->
                      
                        <!-- Responsive offcanvas body END -->
                    </div>
                    <!-- Right sidebar END -->
                </div><!-- Row END -->
            </div>
        </section>
        <!-- =======================
Page content END -->

        <!-- =======================
Newsletter START -->
        <section class="pt-0">
            <div class="container position-relative overflow-hidden">
                <!-- SVG decoration -->
                <figure class="position-absolute top-50 start-50 translate-middle ms-3">
                    <svg>
                        <path
                            d="m496 22.999c0 10.493-8.506 18.999-18.999 18.999s-19-8.506-19-18.999 8.507-18.999 19-18.999 18.999 8.506 18.999 18.999z"
                            fill="#fff" fill-rule="evenodd" opacity=".502" />
                        <path
                            d="m775 102.5c0 5.799-4.701 10.5-10.5 10.5-5.798 0-10.499-4.701-10.499-10.5 0-5.798 4.701-10.499 10.499-10.499 5.799 0 10.5 4.701 10.5 10.499z"
                            fill="#fff" fill-rule="evenodd" opacity=".102" />
                        <path
                            d="m192 102c0 6.626-5.373 11.999-12 11.999s-11.999-5.373-11.999-11.999c0-6.628 5.372-12 11.999-12s12 5.372 12 12z"
                            fill="#fff" fill-rule="evenodd" opacity=".2" />
                        <path
                            d="m20.499 10.25c0 5.66-4.589 10.249-10.25 10.249-5.66 0-10.249-4.589-10.249-10.249-0-5.661 4.589-10.25 10.249-10.25 5.661-0 10.25 4.589 10.25 10.25z"
                            fill="#fff" fill-rule="evenodd" opacity=".2" />
                    </svg>
                </figure>
                <!-- Svg decoration -->
                <figure class="position-absolute bottom-0 end-0 mb-5 d-none d-sm-block">
                    <svg class="rotate-130" width="258.7px" height="86.9px" viewBox="0 0 258.7 86.9">
                        <path stroke="white" fill="none" stroke-width="2"
                            d="M0,7.2c16,0,16,25.5,31.9,25.5c16,0,16-25.5,31.9-25.5c16,0,16,25.5,31.9,25.5c16,0,16-25.5,31.9-25.5 c16,0,16,25.5,31.9,25.5c16,0,16-25.5,31.9-25.5c16,0,16,25.5,31.9,25.5s16-25.5,31.9-25.5" />
                        <path stroke="white" fill="none" stroke-width="2"
                            d="M0,57c16,0,16,25.5,31.9,25.5c16,0,16-25.5,31.9-25.5c16,0,16,25.5,31.9,25.5c16,0,16-25.5,31.9-25.5 c16,0,16,25.5,31.9,25.5c16,0,16-25.5,31.9-25.5c16,0,16,25.5,31.9,25.5s16-25.5,31.9-25.5" />
                    </svg>
                </figure>

                {{-- <div class="bg-grad-pink p-3 p-sm-5 rounded-3">
                    <div class="row justify-content-center position-relative">
                        <!-- SVG decoration -->
                        <figure class="fill-white opacity-1 position-absolute top-50 start-0 translate-middle-y">
                            <svg width="141px" height="141px">
                                <path
                                    d="M140.520,70.258 C140.520,109.064 109.062,140.519 70.258,140.519 C31.454,140.519 -0.004,109.064 -0.004,70.258 C-0.004,31.455 31.454,-0.003 70.258,-0.003 C109.062,-0.003 140.520,31.455 140.520,70.258 Z" />
                            </svg>
                        </figure>
                        <!-- Newsletter -->
                        <div class="col-12 position-relative my-2 my-sm-3">
                            <div class="row align-items-center">
                                <!-- Title -->
                                <div class="col-lg-6">
                                    <h3 class="text-white mb-3 mb-lg-0">Looking a product that is not in our list of products?
                                    </h3>
                                </div>
                                <!-- Input item -->
                                <div class="col-lg-6 text-lg-end">
                                    <form class="bg-body rounded p-2">
                                        <div class="input-group">
                                            <input class="form-control border-0 me-1" type="email"
                                                placeholder="Type your email here">
                                            <button type="button" class="btn btn-dark mb-0 rounded">Subscribe</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row END -->
                </div> --}}
            </div>
        </section>
        <!-- =======================
Newsletter END -->

    </main>
    <!-- **************** MAIN CONTENT END **************** -->

    <!-- =======================
Footer START -->
    <footer class="pt-5 bg-light">
        <div class="container">
          

            <!-- Divider -->
            <hr class="mt-4 mb-0">

            <!-- Bottom footer -->
            <div class="py-3">
                <div class="container px-0">
                    <div class="d-lg-flex justify-content-between align-items-center py-3 text-center text-md-left">
                        <!-- copyright text -->
                        <div class="text-body text-primary-hover"> Copyrights ©2024 AboveMarts.</div>
                        <!-- copyright links-->
                   
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- =======================
Footer END -->

    <!-- Back to top -->
    <div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

    <!-- Bootstrap JS -->
    <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Vendors -->
    <script src="assets/vendor/choices/js/choices.min.js"></script>

    <!-- Template Functions -->
    <script src="assets/js/functions.js"></script>

</body>

</html>