<!DOCTYPE html>
<html>

<head>
   <style>
    
    
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f3f2;
            margin: 0;
            padding: 0;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
           
    
        }
    
        .certificate {
            width: 800px;
            margin: 50px auto;
            background-color: #fff;
            border: 10px solid #282b2d;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
          
                border: 10px solid transparent;
                border-image: linear-gradient(135deg, orange, #282b2d, orange, #282b2d,orange, #282b2d) 10;
                border-image-slice: 1;
            
        }
    
        .header img {
            max-width: 450px;
            margin-top: 10px;
        }
    
        .content {
            padding: 20px;
        }
    
        h1 {
            font-family: 'Times New Roman', serif;
            font-size: 40px;
            color: #f3663f;
            margin: 20px 0;
        }
    
        h2 {
            font-family: 'Cursive', cursive;
            font-size: 32px;
            margin: 10px 0;
        }
    
        h3 {
            font-family: 'Georgia', serif;
            font-size: 28px;
            margin: 10px 0;
        }
    
        p {
            font-size: 20px;
            margin: 10px 0;
            color: #333;
        }
    
        .date {
            font-weight: bold;
            color: #f3663f;
        }
    
        .signature img {
            max-width: 150px;
            margin-top: 20px;
        }
    
        .signature p {
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            font-size: 24px;
            margin: 10px 0;
            color: #333;
        }
    
        .certificate-id {
            font-weight: bold;
            font-size: 18px;
            color: #fff;
            background-color: #333;
            padding: 2px 5px;
        }
    
        .footer a {
            color: #fff;
            text-decoration: none;
        }
    
        @media print {
            body {
                background-color: #fff;
            }
        }
    </style>
    
</head>

<body>
    <div class="certificate">
        <div class="border-overlay"></div>
        <div class="header">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQRYEiqP88V-II_fQt_VSz_eNqEDZ-n-4wjibzxx-EbUiq2x0rEsjExw_PNJwPMyLH8x0Q&usqp=CAU"
                style='width:150px !important' alt="Certificate Logo">
        </div>
        <div class="content">
            <div style='display:flex;align-items:center !important;text-align:center;margin-left:15% !important'>
                <img style='height:100px;width:70px;' src="https://www.sanire.co.za/images/stories/News/awards.png" />
                <h1 style='text-align:center'> Certificate of Completion</h1>

            </div>
            <p>This is to certify that</p>
            <h2>{{ $name ?? "Fasanya Oluwapelumi" }}</h2>
            <p>has successfully completed the course</p>
            <h3>{{ $course ?? "Introduction To Artificial Intelligence" }}</h3>
            <p>awarded on this day of</p>
            <p><span class="date">{{ \Carbon\Carbon::now()->format('jS F, Y') }}</span></p>
        </div>
        <div class="signature">
            <img style='height:70px;width:70px' src="https://i.pinimg.com/736x/11/ef/54/11ef542764a2397f7ee0e64732e1b731.jpg"
                alt="Authorized Signature"><br>
                ___________________<br>
                <p1>DATE/SIGNATURE</p1><br>
            <p>Steve Everest (HOD)</p>
        </div>
        <div class="footer">
            <p>Certificate ID: <span class="certificate-id">{{ $certificate_no ?? '2fcec2b3-787c-4b82-bca6-1b71ff4f766d/1
                ' }}</span></p>
            <p>Certificate URL: <span><i>https://learn.abovemarts.com/verify_certificate/...</i></span></p>
        </div>
    </div>
</body>

</html>