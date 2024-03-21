<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>:: Test Result ::</title>
<link rel="stylesheet" href="{{asset('testassets/plugins/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('testassets/plugins/jquery-steps/jquery.steps.css')}}">

<!-- Custom Css -->
<link rel="stylesheet" href="{{asset('testassets/css/style.min.css')}}">
</head>

<body class="theme-blush">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="assets/images/loader.svg" width="48" height="48" alt="Aero"></div>
        <p>Please wait...</p>
    </div>
</div>

<!-- Overlay For Sidebars -->
<div class="overlay"></div>


<section class="content" style='margin: 20px !important'>
    <div class="body_scroll">
        
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12" >
                    <div class="card" >
                        <div class="blogitem mb-5">
                            
                            <div class="blogitem-content">
                                <div class="blogitem-header">
                                   
                                </div>
                                <h3><strong>{{$test->title}}</strong></h3>
                                <blockquote class='blockquote' style='background:#d1ecf1;color:#0c5460;border-left-color:#0c5460;border-left-width:5px'>
                                    <p>Total Questions:<a> {{$totalQuestions}}</a></p>
                                    <p>Attempted Questions:<a> {{$attemptQuestion}}</a></p>
                                    <p>Correct Answers:<a> {{$userCorrectedAnswer}}</a></p>
                                    <p>Wrong Answers:<a> {{$userWrongAnswer}}</a></p>
                                    <p>Total Score:<a> {{$userCorrectedAnswer}}/{{$totalQuestions}}</a></p>
                                    <p>Test Percentage:<a> {{number_format($percentage,2)}} %</a></p>
                                </blockquote>
                                @foreach($results as $key=>$result)
                                <blockquote class="blockquote">
                                    <h5>{{$result->question->question}}</h5>
                                    <p>
                                        @php
    				$i=1;

    				$answers = DB::table('answers')->where('question_id',$result->question_id)->get();
    				foreach($answers as $ans){
    				echo'<p>'.$i++.')' .$ans->answer.
    				'</p>';
    			}

    				@endphp
                                    </p>
                                 
                                    <footer>Your answer:<a >{{$result->answer->answer}}</a></footer>
                                    @php
    					$correctAnswers = DB::table('answers')->where('question_id',$result->question_id)->where('is_correct',1)->get();
    					foreach($correctAnswers as $ans){
    					echo "Correct Answer:".$ans->answer;
    				}

    				@endphp
    				@if($result->answer->is_correct)
    				<p>
    					<span class="badge badge-success">Result:Correct</span>
    				</p>
    				@else
    				<p>
    					<span class="badge badge-danger">Result:Incorrect</span>
    				</p>

    				@endif
                                </blockquote>
                               @endforeach
                        </div>
                    </div>
                    
                </div>
                {{-- <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="body search">
                            <div class="input-group mb-0">
                                <input type="text" class="form-control" placeholder="Search...">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2"><i class="zmdi zmdi-search"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>                    
                    <div class="card">
                        <div class="header">
                            <h2><strong>Categories</strong></h2>                        
                        </div>
                        <div class="body">
                            <ul class="list-unstyled mb-0 widget-categories">
                                <li><a href="javascript:void(0);">Business Report</a></li>
                                <li><a href="javascript:void(0);">Business Growth</a></li>
                                <li><a href="javascript:void(0);">Business Strategy</a></li>
                                <li><a href="javascript:void(0);">Financial Advise</a></li>
                                <li><a href="javascript:void(0);">Creative Idea</a></li>
                                <li><a href="javascript:void(0);">Marketing</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2><strong>Recent</strong> Posts</h2>
                        </div>
                        <div class="body">
                            <ul class="list-unstyled mb-0 widget-recentpost">
                                <li>
                                    <a href="blog-details.html"><img src="assets/images/image-gallery/1.jpg" alt="blog thumbnail"></a>
                                    <div class="recentpost-content">
                                        <a href="blog-details.html">Fundamental analysis services</a>
                                        <span>August 01, 2018</span>
                                    </div>
                                </li>
                                <li>
                                    <a href="blog-details.html"><img src="assets/images/image-gallery/2.jpg" alt="blog thumbnail"></a>
                                    <div class="recentpost-content">
                                        <a href="blog-details.html">Steps to a successful Business</a>
                                        <span>November 01, 2018</span>
                                    </div>
                                </li>
                                <li>
                                    <a href="blog-details.html"><img src="assets/images/image-gallery/3.jpg" alt="blog thumbnail"></a>
                                    <div class="recentpost-content">
                                        <a href="#blog-details.html">Development Progress Conference</a>
                                        <span>December 01, 2018</span>
                                    </div>
                                </li>
                                <li>
                                    <a href="blog-details.html"><img src="assets/images/image-gallery/12.jpg" alt="blog thumbnail"></a>
                                    <div class="recentpost-content">
                                        <a href="blog-details.html">Steps to a successful Business</a>
                                        <span>December 15, 2018</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card">
                        <div class="header">
                            <h2><strong>Tag</strong> Clouds</h2>                        
                        </div>
                        <div class="body">
                            <ul class="list-unstyled mb-0 tag-clouds">
                                <li><a href="javascript:void(0);" class="tag badge badge-default">Design</a></li>
                                <li><a href="javascript:void(0);" class="tag badge badge-success">Project</a></li>
                                <li><a href="javascript:void(0);" class="tag badge badge-info">Creative UX</a></li>
                                <li><a href="javascript:void(0);" class="tag badge badge-success">Wordpress</a></li>
                                <li><a href="javascript:void(0);" class="tag badge badge-warning">HTML5</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2><strong>Instagram</strong> Post</h2>                        
                        </div>
                        <div class="body">
                            <ul class="list-unstyled mb-0 instagram-plugin">
                                <li><a href="javascript:void(0);"><img src="assets/images/blog/05-img.jpg" alt="image description"></a></li>
                                <li><a href="javascript:void(0);"><img src="assets/images/blog/06-img.jpg" alt="image description"></a></li>
                                <li><a href="javascript:void(0);"><img src="assets/images/blog/07-img.jpg" alt="image description"></a></li>
                                <li><a href="javascript:void(0);"><img src="assets/images/blog/08-img.jpg" alt="image description"></a></li>
                                <li><a href="javascript:void(0);"><img src="assets/images/blog/09-img.jpg" alt="image description"></a></li>
                                <li><a href="javascript:void(0);"><img src="assets/images/blog/10-img.jpg" alt="image description"></a></li>
                                <li><a href="javascript:void(0);"><img src="assets/images/blog/11-img.jpg" alt="image description"></a></li>
                                <li><a href="javascript:void(0);"><img src="assets/images/blog/12-img.jpg" alt="image description"></a></li>
                                <li><a href="javascript:void(0);"><img src="assets/images/blog/13-img.jpg" alt="image description"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2><strong>Email</strong> Newsletter</h2>
                        </div>
                        <div class="body newsletter">                            
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Enter Email">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2"><i class="zmdi zmdi-mail-send"></i></span>
                                </div>
                            </div>
                            <small>Get our products/news earlier than others, let’s get in touch.</small>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</section>
<!-- Jquery Core Js --> <script src="{{asset('testassets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->
<script src="{{asset('testassets/bundles/vendorscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->

<script src="{{asset('testassets/plugins/jquery-validation/jquery.validate.js')}}"></script> <!-- Jquery Validation Plugin Css -->
<script src="{{asset('testassets/plugins/jquery-steps/jquery.steps2.js')}}"></script> <!-- JQuery Steps Plugin Js -->

<script src="{{asset('testassets/bundles/mainscripts.bundle.js')}}"></script><!-- Custom Js -->
<script src="{{asset('testassets/js/pages/forms/form-wizard.js')}}"></script>
<script src="{{asset('testassets/jquerycountdown/cdn/jquery.min.js')}}"></script>
<script src="{{asset('testassets/jquerycountdown/dist/jquery.countdown360.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>