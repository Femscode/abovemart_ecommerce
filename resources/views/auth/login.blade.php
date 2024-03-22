
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from eduport.webestica.com/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 12 Mar 2022 17:47:37 GMT -->
<head>
	<title>Abovemarts Ecommerce</title>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Webestica.com">
	<meta name="description" content="The Abovemarts Ecommerce Portal">

	<!-- Favicon -->
	<link rel="shortcut icon" href="assets/images/favicon.ico">

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&amp;family=Roboto:wght@400;500;700&amp;display=swap">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="assets/vendor/font-awesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap-icons/bootstrap-icons.css">

	<!-- Theme CSS -->
	<link id="style-switch" rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>

<body>

<!-- **************** MAIN CONTENT START **************** -->
<main>
	<section class="p-0 d-flex align-items-center position-relative overflow-hidden">
	
		<div class="container-fluid">
			<div class="row">
				<!-- left -->
				<div class="col-12 col-lg-6 d-md-flex align-items-center justify-content-center bg-primary bg-opacity-10 vh-lg-100">
					<div class="p-3 p-lg-5">
						<!-- Title -->
						<div class="text-center">
                            <h2>Abovemarts Ecommerce.</h2>
							{{-- <p class="mb-0 h6 fw-light">Let's learn something new today!</p> --}}
						</div>
						<!-- SVG Image -->
						<img src="assets/images/ecomm2.jpg" class="mt-5 rounded" alt="">
						<!-- Info -->
						<div class="d-sm-flex mt-5 align-items-center justify-content-center">
							<ul class="avatar-group mb-2 mb-sm-0">
								<li class="avatar avatar-sm"><img class="avatar-img rounded-circle" src="assets/images/avatar/01.jpg" alt="avatar"></li>
								<li class="avatar avatar-sm"><img class="avatar-img rounded-circle" src="assets/images/avatar/02.jpg" alt="avatar"></li>
								<li class="avatar avatar-sm"><img class="avatar-img rounded-circle" src="assets/images/avatar/03.jpg" alt="avatar"></li>
								<li class="avatar avatar-sm"><img class="avatar-img rounded-circle" src="assets/images/avatar/04.jpg" alt="avatar"></li>
							</ul>
							<!-- Content -->
							<p class="mb-0 h6 fw-light ms-0 ms-sm-3">4k+ innovative products available!</p>
						</div>
					</div>
				</div>

				<!-- Right -->
				<div class="col-12 col-lg-6 m-auto">
					<div class="row my-5">
						<div class="col-sm-10 col-xl-8 m-auto">
							<!-- Title -->
							{{-- <img src="assets/images/element/03.svg" class="h-40px mb-2" alt=""> --}}
						
							{{-- <p class="lead mb-4">Nice to see you! Please Sign up with your account.</p> --}}
						
							<!-- Form START -->
							
						<a href='https://abovemarts.com/login' type="submit" class="btn btn-success d-block w-100 h-45px btn-lg">Backoffice Login →</a>
							<form method='post' action='{{ route("login") }}'>@csrf
								<!-- Email -->
								@if($errors->any())
                                <div class="alert alert-danger">
                                    <p><strong>Opps Something went wrong</strong></p>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif


                                <div class="mb-4">
									<label for="exampleInputEmail1" class="form-label">Username *</label>
									<div class="input-group input-group-lg">
										<span class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i class="bi bi-envelope-fill"></i></span>
										<input type="text" class="form-control border-0 bg-light rounded-end ps-1" name='username' placeholder="Username" id="exampleInputEmail1">
									</div>
								</div>
								<!-- Password -->
								<div class="mb-4">
									<label for="inputPassword5" class="form-label">Password *</label>
									<div class="input-group input-group-lg">
										<span class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i class="fas fa-lock"></i></span>
										<input type="password" name='password' class="form-control border-0 bg-light rounded-end ps-1" placeholder="*********" id="inputPassword5">
									</div>
								</div>
								<!-- Confirm Password -->
								<!-- Button -->
								<div class="align-items-center mt-0">
									<div class="d-grid">
										<button class="btn btn-primary mb-0" type="submit">Log In</button>
									</div>
								</div>
							</form>
							<!-- Form END -->

							<!-- Social buttons -->
							{{-- <div class="row">
								<!-- Divider with text -->
								<div class="position-relative my-4">
									<hr>
									<p class="small position-absolute top-50 start-50 translate-middle bg-body px-5">Or</p>
								</div>
								<!-- Social btn -->
								<div class="col-xxl-6 d-grid">
									<a href="#" class="btn bg-danger text-white mb-2 mb-xxl-0"><i class="fab fa-fw fa-google text-white me-2"></i>Signup with Google</a>
								</div>
								<!-- Social btn -->
								<div class="col-xxl-6 d-grid">
									<a href="#" class="btn bg-facebook mb-0"><i class="fab fa-fw fa-facebook-f me-2"></i>Signup with Facebook</a>
								</div>
							</div> --}}

							<!-- Sign up link -->
							<div class="mt-4 text-center">
								<span>Don't have an account?<a href="https://abovemarts.com/register?ref=FasanyaPelumi"> Sign up here</a></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<!-- **************** MAIN CONTENT END **************** -->

<!-- Back to top -->
<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

<!-- Bootstrap JS -->
<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Template Functions -->
<script src="assets/js/functions.js"></script>

</body>

<!-- Mirrored from eduport.webestica.com/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 12 Mar 2022 17:47:37 GMT -->
</html>