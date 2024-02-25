<!DOCTYPE html>
<html>
<head>
    <title>Certificate</title>
    <style>
        /* Define your CSS styles here */
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .content {
            text-align: center;
            margin-bottom: 20px;
        }
        .author {
            font-weight: bold;
        }
        .footer {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
            <div class="page">
                <div class="content">
                    <img src="{{ $qrCodePath }}" alt="QR Code">
                </div>
            </div>
    </div>
</body>
</html>
