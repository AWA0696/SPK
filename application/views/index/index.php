<div class="container-fluid">
    <!DOCTYPE html>
    <html>


    <head>
        <title>Selamat Datang</title>
        <style>
        body {
            background-color: #f0f0f0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .welcome {
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        .welcome h1 {
            font-size: 265px;
            margin-bottom: 20px;
            color: #333;
            animation: slideInDown 1s ease-in-out;
        }

        .welcome p {
            font-size: 24px;
            color: #777;
            animation: slideInUp 1s ease-in-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes slideInDown {
            0% {
                transform: translateY(-100px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideInUp {
            0% {
                transform: translateY(100px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }
        </style>
    </head>

    <body>
        <div class="welcome">
            <h1>Selamat Datang</h1>
            <p>Aplikasi Surat Perintah Kerja</p>
        </div>
    </body>

    </html>
</div>