<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BJM AUTO</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{

            background:#f1f5f9;

            font-family:Segoe UI,sans-serif;

        }

        .sidebar{

            position:fixed;

            left:0;

            top:0;

            width:250px;

            height:100vh;

            background:#0f172a;

        }

        .logo{

            padding:25px;

            text-align:center;

            border-bottom:1px solid rgba(255,255,255,.08);

        }

        .logo img{

            width:180px;

        }

        .menu{

            margin-top:20px;

        }

        .menu a{

            display:block;

            padding:15px 25px;

            color:#cbd5e1;

            text-decoration:none;

            transition:.3s;

            font-size:15px;

        }

        .menu a:hover{

            background:#2563eb;

            color:white;

        }

        .menu i{

            margin-right:10px;

        }

        .topbar{

            margin-left:250px;

            background:white;

            height:70px;

            display:flex;

            justify-content:space-between;

            align-items:center;

            padding:0 30px;

            box-shadow:0 2px 10px rgba(0,0,0,.05);

        }

        .content{

            margin-left:250px;

            padding:30px;

        }

        .card-box{

            background:white;

            border-radius:12px;

            padding:25px;

            box-shadow:0 2px 10px rgba(0,0,0,.05);

        }

    </style>

</head>

<body>

<div class="sidebar">

    <div class="logo">

        <img src="{{ asset('images/logo.png') }}">

    </div>

    <div class="menu">

        <a href="/admin/dashboard">

            <i class="bi bi-speedometer2"></i>

            Dashboard

        </a>

        <a href="/admin/product">

            <i class="bi bi-box-seam"></i>

            Product

        </a>

        <a href="/admin/company">

            <i class="bi bi-building"></i>

            Company Profile

        </a>

        <a href="/logout">

            <i class="bi bi-box-arrow-right"></i>

            Logout

        </a>

    </div>

</div>

<div class="topbar">

    <h5 class="mb-0">

        Dashboard

    </h5>

    <strong>

        Halo,

        {{ session('admin_name') }}

    </strong>

</div>

<div class="content">

    @yield('content')

</div>

</body>

</html>