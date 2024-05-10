
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>AboveMarts Academy</title>
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <!-- Meta Tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="learn.abovemarts.com">
        <meta name="description" content="Abovemarts Learning Portal">
    
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

<main>

<!-- =======================
Page content START -->
<section class="pt-5">
	<div class="container" data-sticky-container>
		<div class="row g-4 g-sm-5">

			<!-- Left sidebar START -->
			<div class="col-xl-4">
				<div data-sticky data-margin-top="80" data-sticky-for="992">
					<div class="row justify-content-center">
						<div class="col-md-8 col-xl-12">

							<!-- Card START -->
                            <h3>AboveMarts Academy</h3>
							<div class="card shadow">
								<!-- Image -->
								<div class="rounded-3">
									<img src="https://learn.abovemarts.com/public/ebook_images/{{ $ebook->image}}" class="card-img-top" alt="book image">
								</div>
			
								<!-- Card body -->
							
							</div>
							<!-- Card END -->

						</div>
					</div> <!-- Row End -->
				</div>
			</div>
			<!-- Left sidebar END -->
				
			<!-- Main content START -->
			<div class="col-xl-8">
			
				<!-- Title -->
				<h1 class="mb-4">{{ $ebook->title }}</h1>

				<!-- Rating -->
				<div class="d-flex align-items-center mb-4">
					<h4 class="me-3 mb-0 text-success">{{ $ebook->cat->name ?? ""}}</h4>
					<h5 class="me-3 mb-0 text-success">{{ $ebook->subcat->name ?? "" }}</h5>
				
				</div>


				<!-- Content -->
				<h4>Description</h4>
				<p>{{ $ebook->description }}</p>
				
				<!-- Additional info -->
				<div class="row mb-3">
					<div class="col-md-6">
						<!-- List START -->
						<ul class="list-group list-group-borderless">
							<li class="list-group-item px-0">
								<span class="h6 fw-light"><i class="bi fa-fw bi-calendar-fill text-primary me-2"></i>Date Added:</span>
								<span class="h6">{{ Date('d-m-y',strtotime($ebook->created_at)) }}</span>
							</li>
							<li class="list-group-item px-0">
								<span class="h6 fw-light"><i class="fas fa-fw fa-book text-primary me-2"></i>Page count:</span>
								<span class="h6">180</span>
							</li>
							
							<li class="list-group-item px-0">
								<span class="h6 fw-light"><i class="bi fa-fw bi-translate text-primary me-2"></i>Language:</span>
								<span class="h6">English</span>
							</li>
						</ul>
						<!-- List END -->
					</div>

					<div class="col-md-6">
						<!-- List START -->
						<ul class="list-group list-group-borderless">
							<li class="list-group-item px-0">
								<span class="h6 fw-light"><i class="bi fa-fw bi-person-circle text-primary me-2"></i>Author:</span>
								<span class="h6">{{ $ebook->author }}</span>
							</li>
							<li class="list-group-item px-0">
								<span class="h6 fw-light"><i class="bi fa-fw bi-eye-fill text-primary me-2"></i>Total Downloads:</span>
								<span class="h6">18K</span>
							</li>
							
							<li class="list-group-item px-0">
								<span class="h6 fw-light"><i class="bi fa-fw bi-star-fill text-primary me-2"></i>Rating/Review:</span>
								<span class="h6">4.5 </span>
							</li>
						</ul>

						
						<!-- List END -->
					</div>
				</div>
				<div class="card-body pb-3">
					<!-- Buttons and price -->
					<div class="text-center">
						<!-- Buttons -->
						<a href="/preview_ebook/{{ $ebook->uid }}" class="btn btn-light mb-0"><i class="bi bi-bookmark me-2"></i>Preview Book</a>
					</div>
				</div>
			</div>
			<!-- Main content END -->
		</div> <!-- Row END -->
	</div>
</section>

</main>
<!-- **************** MAIN CONTENT END **************** -->

<footer class="bg-dark p-3">
    <div class="container">
        <div class="row align-items-center">
            <!-- Widget -->
            <div class="col-md-4 text-center text-md-start">
                <!-- Logo START -->
                <h5 class='text-white'>AboveMarts Academy</h5>
                {{-- <a href="index.html"> <img class="h-20px" src="assets/images/logo-light.svg" alt="logo"> </a> --}}
            </div>

            <!-- Widget -->
            <div class="col-md-4 mb-md-0">
                <div class="text-center text-white">
                    Copyrights © <?php echo Date('Y'); ?> <a href="#" class="text-reset btn-link">AboveMarts Academy</a>. All rights reserved.
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

</body>
</html>