<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <title>Syndron - Bootstrap5 Admin Template</title>
</head>

<body class="bg-login">
    <!--wrapper-->
    <div class="wrapper">
        <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                    <div class="col mx-auto">
                        <div class="my-4 text-center">
                            <img src="assets/images/logo-img.png" width="180" alt="" />
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Register Your Store</h3>
                                        <p>Already have an account? <a href="authentication-signin.html">Sign in
                                                here</a>
                                        </p>
                                    </div>
                                    {{-- <div class="d-grid">
                                        <a class="btn my-4 shadow-sm btn-white" href="javascript:;"> <span
                                                class="d-flex justify-content-center align-items-center">
                                                <img class="me-2" src="assets/images/icons/search.svg" width="16"
                                                    alt="Image Description">
                                                <span>Sign Up with Google</span>
                                            </span>
                                        </a> <a href="javascript:;" class="btn btn-facebook"><i
                                                class="bx bxl-facebook"></i>Sign Up with Facebook</a>
                                    </div> --}}
                                    <div class="login-separater text-center mb-4"> <span>SIGN UP</span>
                                        <hr />
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" method='post' action='{{ route("register") }}'>@csrf
                                            <div class="col-sm-6">
                                                <label for="inputFirstName" class="form-label">Name</label>
                                                <input type="text" required name='name' class="form-control" id="name"
                                                    placeholder="Fasanya Pelumi">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="inputLastName" class="form-label">Store Name</label>
                                                <input type="text" required name='storename' class="form-control" id="storename"
                                                    placeholder="Restaurant/Store Name">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Email Address</label>
                                                <input type="email" name='email' required class="form-control" id="inputEmailAddress"
                                                    placeholder="example@user.com">
                                            </div>
                                          
                                            <div class="col-12">
                                                <label for="inputSelectCountry" class="form-label">Institution Name</label>
                                                <select class="form-select" required id="institution" name='school_id'
                                                    aria-label="Default select example">
                                                    <option value=''>Select Institution</option>
                                                    @foreach(App\Models\School::all() as $school)
                                                    <option value='{{ $school->id }}'>{{ $school->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputSelectCountry" class="form-label">Store Type</label>
                                                <select class="form-select" required id="institution" name='type'
                                                    aria-label="Default select example">
                                                    <option value=''>Select Type</option>
                                                  
                                                    <option value='Foods and Drinks'>Foods and Drinks</option>
                                                    <option value='Cake and Pasteries'>Cake and Pasteries</option>
                                                  
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0"
                                                        id="inputChoosePassword" name='password' value="12345678"
                                                        placeholder="Enter Password"> <a href="javascript:;"
                                                        class="input-group-text bg-transparent"><i
                                                            class='bx bx-hide'></i></a>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Confirm Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input class="form-control border-end-0"
                                                    id="password-confirm" type="password" name="password_confirmation" value="12345678"
                                                        placeholder="Enter Password"> <a href="javascript:;"
                                                        class="input-group-text bg-transparent"><i
                                                            class='bx bx-hide'></i></a>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckChecked">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">I read
                                                        and agree to Terms & Conditions</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class='bx bx-user'></i>Sign up</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
    </script>

    <!--app JS-->
    <script src="assets/js/app.js"></script>
</body>

</html>