<!DOCTYPE html>
<html>
<head>
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans|Pinyon+Script|Rochester"> --}}
   
    <style>
        /* @import url('https://fonts.googleapis.com/css?family=Open+Sans|Pinyon+Script|Rochester'); */

        .cursive {
            font-family: 'Pinyon Script', cursive;
        }

        .sans {
            font-family: 'Open Sans', sans-serif;
        }

        .bold {
            font-weight: bold;
        }

        .block {
            display: block;
        }

        .underline {
            border-bottom: 1px solid #777;
            padding: 5px;
            margin-bottom: 15px;
        }

        .margin-0 {
            margin: 0;
        }

        .padding-0 {
            padding: 0;
        }

        .pm-empty-space {
            height: 40px;
            width: 100%;
        }

        body {
            background-color: #618597;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .pm-certificate-container {
            width: 100%;
            max-width: 800px;
            padding: 30px;
            color: #333;
            font-family: 'Open Sans', sans-serif;
            box-shadow: 0 0 5px rgba(0, 0, 0, .5);
        }

        .pm-certificate-border {
            border: 1px solid #E1E5F0;
            background-color: rgba(255, 255, 255, 1);
            padding: 20px;
        }

        .pm-certificate-title h2 {
            font-size: 34px !important;
        }

        .pm-name-text {
            font-size: 20px;
        }

        .pm-earned-text {
            font-size: 20px;
        }

        .pm-credits-text {
            font-size: 15px;
        }

        .pm-certificate-footer {
            text-align: center;
            margin: 20px 0;
        }

        .pm-certificate-footer img {
            width: 150px;
            height: 50px;
        }

        .pm-certificate-footer .underline {
            border-top: 2px solid #000;
            width: 200px;
            display: block;
            margin: 0 auto;
        }

        .pm-certified {
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container pm-certificate-container">
        <div class="pm-certificate-border">
            <div class="pm-certificate-title text-center cursive">
                <img src='https://abovemarts.com/img/logos/logo-inner.png'/>
                <h2>AboveMart Certificate Of Completion</h2>
            </div>

            <div class="pm-certificate-body">
                <div class="pm-certificate-block">
                    <div class="row">
                        <div class="pm-certificate-name col-12 text-center underline">
                            <span class="pm-name-text bold">{{ $name }}</span>
                        </div>
                    </div>

                    <div class="pm-certificate-earned text-center">
                        <span class="pm-earned-text block cursive">has already completed the course:</span>
                    </div>

                    <div class="pm-course-title text-center">
                        <span class="pm-credits-text block bold">{{ $course }}</span>
                    </div>
                </div>

                <div class="pm-certificate-footer">
                    <img src="signature.jpg" alt="Signature">
                    <div class="underline"></div>
                    <div class="font-size: 18px;">
                        CEO: Mr Steve Everest
                    </div>
                </div>
                <div class="d-flex row" style='text-align:center'>
                    <p style="display: inline;">Certificate No:{{ $certificate_no }}</p>
                    <p style="display: inline;">Certificate URL: https://academy.abovemarts.com/{{ $certificate_no }}</p>
                    <p style="display: inline;">Date Completed: {{ \Carbon\Carbon::now()->format('jS of F, Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

   </body>
</html>
