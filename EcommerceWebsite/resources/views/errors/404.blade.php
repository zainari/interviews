<!-- resources/views/errors/404.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found - 404</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .container {
            text-align: center;
            background: #fff;
            padding: 60px 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            max-width: 500px;
        }

        h1 {
            font-size: 120px;
            margin: 0;
            color: #FF6B6B;
        }

        h2 {
            font-size: 28px;
            margin: 20px 0 10px;
        }

        p {
            font-size: 18px;
            margin-bottom: 30px;
            color: #666;
        }

        a {
            display: inline-block;
            text-decoration: none;
            background: #3490dc;
            color: #fff;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s;
        }

        a:hover {
            background: #2779bd;
        }

        @media(max-width: 600px) {
            h1 { font-size: 80px; }
            h2 { font-size: 24px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <h2>Page Not Found</h2>
        <p>Sorry, the page you are looking for doesn’t exist or has been moved.</p>
        <a href="{{ url('/') }}">Go Back Home</a>
    </div>
</body>
</html>
