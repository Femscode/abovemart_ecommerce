<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="AboveMarts Test Page">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>AboveMarts Test Portal</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="{{asset('testassets/plugins/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('testassets/plugins/jquery-steps/jquery.steps.css')}}">

<!-- Custom Css -->
<link rel="stylesheet" href="{{asset('testassets/css/style.min.css')}}">
</head>

<body class="theme-blush">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="assets/images/loader.svg" width="48" height="48" alt="Crown"></div>
        <p>Please wait...</p>
    </div>
</div>

<!-- Overlay For Sidebars -->
<div class="overlay"></div>




<!-- Right Sidebar -->


<section class="content" style='margin:20px !important'>
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>AboveMarts Test Portal</h2>
                    <h4>{{ $test->title }} | Section {{ $test->section_id }}</h4>
                  
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class=" float-right "><div id='countdown'></div></button>                                
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Basic Example | Horizontal Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2>Test Duration: {{$time}} Minutes</h2>
                            <input type='hidden' value='{{$time}}' id='time'>
                          
                        </div>
                        <div class="body">
                            <div id="wizard_horizontal">
                                @foreach($testQuestions as $key => $question)
                                <h2>Question {{++$key}}</h2>
                                <section>
                                    <p>{{$question->question}}</p>
                                    <input id='userId' type='hidden' value='{{Auth::user()->id}}'>
                                    <input id='testId' type='hidden' value='{{$test->id}}'>
                                    <input id='questionId' type='hidden' data-id="{{$question->id}}">
                                    <ol>
                                        @foreach($question->answers as $answer)



                                        
                                            <li><label>
                                        <input id='answerId' type='radio'  class='testoption' data-id="{{$answer->id}}" name='answer'> {{$answer->answer}}
                                            </label> </li>
                                        @endforeach
                                    <ol>

                                </section>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Jquery Core Js --> 
<script src="{{asset('testassets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->
<script src="{{asset('testassets/bundles/vendorscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->

<script src="{{asset('testassets/plugins/jquery-validation/jquery.validate.js')}}"></script> <!-- Jquery Validation Plugin Css -->
<script src="{{asset('testassets/plugins/jquery-steps/jquery.steps2.js')}}"></script> <!-- JQuery Steps Plugin Js -->

<script src="{{asset('testassets/bundles/mainscripts.bundle.js')}}"></script><!-- Custom Js -->
<script src="{{asset('testassets/js/pages/forms/form-wizard.js')}}"></script>
<script src="{{asset('testassets/jquerycountdown/cdn/jquery.min.js')}}"></script>
<script src="{{asset('testassets/jquerycountdown/dist/jquery.countdown360.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready( function() {
    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    $timeInseconds = $("#time").val() * 60;
//    alert( $timeInseconds)

    var countdown = $("#countdown").countdown360({
    radius      : 35.5,
    seconds     :  $timeInseconds,
    
    strokeWidth: undefined,
   
    fontColor:"#477050",
    fontFamily:"sans-serif",
    label: ["second","seconds"],
    fontSize: undefined,
    fontColor   : '#FFFFFF',
    autostart   : false,
    onComplete  : function () {  
        swal('info','Test Successfully Completed','info')
        window.location.href = "http://127.0.0.1:8000/usertest"
 }
});
countdown.start();
$(".testoption").click(function() {

    var answerId = $(this).data('id')
    var questionId = $("#questionId").data('id')
    var testId = $("#testId").val()
   

                // var id = $("#profileId").val();

                fd = new FormData();

                // fd.append('id', id);
                fd.append('questionId', $("#questionId").val());
                fd.append('testId', $("#testId").val());
                fd.append('answerId', answerId);
               

                console.log(fd, 'this is the fd');

                $.ajax({
                    type: 'POST',
                    url: "{{ route('submittest') }}",
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        // console.log(data)
                        // window.location.reload();
                    },
                    error: function(data) {
                        console.log(data);
                        
                    }
                });
            
   
})
})
</script>
</body>
</html>