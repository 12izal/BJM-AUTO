<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BJM AUTO | Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>

        *{
            font-family:'Segoe UI',sans-serif;
        }

        body{

            background:#0f172a;

            height:100vh;

            display:flex;

            justify-content:center;

            align-items:center;

        }

        .login-card{

            width:460px;

            background:#1e293b;

            border:none;

            border-radius:18px;

            box-shadow:0 15px 35px rgba(0,0,0,.45);

            padding:40px;

        }

        .logo{

            width:280px;

            display:block;

            margin:auto;

            margin-bottom:35px;

        }

        .form-label{

            color:#cbd5e1;

            font-weight:600;

        }

        .input-group-text{

            background:#334155;

            border:none;

            color:white;

        }

        .form-control{

            background:#334155;

            border:none;

            color:white;

            height:52px;

        }

        .form-control:focus{

            background:#334155;

            color:white;

            box-shadow:none;

        }

        .form-control::placeholder{

            color:#94a3b8;

        }

        .btn-login{

            height:52px;

            border-radius:10px;

            font-weight:bold;

            margin-top:10px;

        }

        .copyright{

            margin-top:30px;

            text-align:center;

            color:#94a3b8;

            font-size:13px;

        }

    </style>

</head>

<body>

<div class="login-card">

    <img src="{{ asset('images/logo.png') }}" class="logo">

    @if(session('error'))

        <div class="alert alert-danger">

            {{ session('error') }}

        </div>

    @endif

    <form method="POST" action="/login">

        @csrf

        <div class="mb-3">

            <label class="form-label">

                Username

            </label>

            <div class="input-group">

                <span class="input-group-text">

                    <i class="bi bi-person-fill"></i>

                </span>

                <input
                    type="text"
                    class="form-control"
                    name="username"
                    placeholder="Masukkan Username"
                    required>

            </div>

        </div>

        <div class="mb-4">

            <label class="form-label">

                Password

            </label>

            <div class="input-group">

                <span class="input-group-text">

                    <i class="bi bi-lock-fill"></i>

                </span>

                <input
                    type="password"
                    class="form-control"
                    name="password"
                    placeholder="Masukkan Password"
                    required>

            </div>

        </div>

        <button class="btn btn-primary btn-login w-100">

            <i class="bi bi-box-arrow-in-right"></i>

            LOGIN

        </button>

    </form>

    <div class="copyright">

        © {{ date('Y') }} BJM AUTO

    </div>

</div>

</body>
</html>