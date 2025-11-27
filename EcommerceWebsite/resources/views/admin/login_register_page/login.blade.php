<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: #f0f2f5;
        }
        .card {
            border-radius: 15px;
        }
        .form-control {
            border-radius: 10px;
        }
        .btn-custom {
            background: #4a6cf7;
            color: white;
            border-radius: 10px;
        }
        .btn-custom:hover {
            background: #3954c3;
        }
        .link {
            color: #4a6cf7;
            text-decoration: none;
        }
        .link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow p-4" style="width: 400px;">
            <h3 class="text-center mb-4">Login</h3>

            <form action="{{route('user.login')}}" method="POST">
               @csrf
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required />
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required />
                </div>

                <button class="btn btn-custom w-100 mt-2" type="submit">Login</button>
            </form>

            <p class="text-center mt-3">
                Don't have an account?
                <a href="{{route('user.showregisterform')}}" class="link">Register</a>
            </p>
        </div>
    </div>
</body>
</html>