<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BJM AUTO</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('styles')

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        html,
        body{

            width:100%;
            min-height:100%;
            overflow-x:hidden;
            background:#eef3f8;
            font-family:'Segoe UI',sans-serif;

        }

        :root{

            --sidebar-width:280px;
            --sidebar-bg:#0f172a;
            --sidebar-hover:#1e293b;
            --primary:#2563eb;

        }

        .sidebar{

            position:fixed;
            left:0;
            top:0;

            width:var(--sidebar-width);
            height:100vh;

            background:var(--sidebar-bg);

            overflow-y:auto;

            z-index:1040;

            transition:.30s;

        }

        .logo{

            padding:30px 20px;

            text-align:center;

            border-bottom:1px solid rgba(255,255,255,.08);

        }

        .logo img{

            width:145px;

        }

        .menu{

            padding:20px 0;

        }

        .menu a{

            display:flex;

            align-items:center;

            gap:14px;

            padding:15px 28px;

            color:#d1d5db;

            text-decoration:none;

            transition:.25s;

            font-size:16px;

        }

        .menu a:hover{

            background:var(--sidebar-hover);

            color:#fff;

        }

        .menu a.active{

            background:var(--primary);

            color:#fff;

        }

        .menu i{

            font-size:19px;

        }

        .content{

            margin-left:var(--sidebar-width);

            width:calc(100% - var(--sidebar-width));

            min-height:100vh;

            transition:.30s;

        }

        .topbar{

            height:72px;

            background:#fff;

            display:flex;

            align-items:center;

            justify-content:space-between;

            padding:0 30px;

            box-shadow:0 2px 15px rgba(0,0,0,.05);

            position:sticky;

            top:0;

            z-index:100;

        }

        .page{

            padding:30px;

        }

        .mobile-toggle{

            display:none;

            cursor:pointer;

            font-size:28px;

        }

        .mobile-overlay{

            position:fixed;

            inset:0;

            background:rgba(0,0,0,.45);

            opacity:0;

            visibility:hidden;

            transition:.30s;

            z-index:1035;

        }

        .mobile-overlay.show{

            opacity:1;

            visibility:visible;

        }

        @media (max-width:992px){

            .sidebar{

                left:0;

                transform:translateX(-100%);

            }

            .sidebar.show{

                transform:translateX(0);

            }

            .content{

                margin-left:0;

                width:100%;

            }

            .mobile-toggle{

                display:block;

            }

            .page{

                padding:20px;

            }

        }

    </style>

</head>

<body>

<div class="mobile-overlay" id="overlay"></div>

<aside class="sidebar" id="sidebar">

    <div class="logo">

        <img src="{{ asset('images/logo.png') }}" alt="BJM AUTO">

    </div>

    <nav class="menu">

        <a href="{{ url('/admin/dashboard') }}"
           class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">

            <i class="bi bi-speedometer2"></i>

            Dashboard

        </a>

        <a href="{{ route('product.index') }}"
           class="{{ request()->is('admin/product*') ? 'active' : '' }}">

            <i class="bi bi-car-front-fill"></i>

            Product

        </a>

        <a href="{{ route('user.index') }}"
            class="{{ request()->is('admin/user*') ? 'active' : '' }}">

            <i class="bi bi-people-fill"></i>

            User

        </a>

        <a href="{{ route('banner.index') }}"
            class="{{ request()->is('admin/banner*') ? 'active' : '' }}">

            <i class="bi bi-images"></i>

            Homepage Banner

        </a>

        <a href="{{ url('/admin/company') }}"
            class="{{ request()->is('admin/company*') ? 'active' : '' }}">

            <i class="bi bi-building"></i>

            Company Profile

        </a>

        <a href="{{ url('/logout') }}">

            <i class="bi bi-box-arrow-right"></i>

            Logout

        </a>

    </nav>

</aside>

<div class="content">

<header class="topbar">

<div class="d-flex align-items-center gap-3">

<i class="bi bi-list mobile-toggle" id="toggleSidebar"></i>

<h4 class="mb-0 fw-bold">

BJM AUTO Dashboard

</h4>

</div>

<div class="fw-semibold">

Halo, {{ auth()->user()->name ?? 'Admin' }}

</div>

</header>

<div class="page">

@yield('content')

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const toggle = document.getElementById('toggleSidebar');

    if(toggle){

        toggle.addEventListener('click', function(){

            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');

        });

    }

    overlay.addEventListener('click', function(){

        sidebar.classList.remove('show');
        overlay.classList.remove('show');

    });

    document.querySelectorAll('.sidebar a').forEach(function(item){

        item.addEventListener('click', function(){

            if(window.innerWidth < 992){

                sidebar.classList.remove('show');
                overlay.classList.remove('show');

            }

        });

    });

    window.addEventListener('resize', function(){

        if(window.innerWidth >= 992){

            sidebar.classList.remove('show');
            overlay.classList.remove('show');

        }

    });

});

</script>

@if(session('success'))

<script>

document.addEventListener('DOMContentLoaded',function(){

    Swal.fire({

        icon:'success',

        title:'Berhasil',

        text:'{{ session("success") }}',

        timer:1800,

        showConfirmButton:false

    });

});

</script>

@endif

@if(session('error'))

<script>

document.addEventListener('DOMContentLoaded',function(){

    Swal.fire({

        icon:'error',

        title:'Oops...',

        text:'{{ session("error") }}'

    });

});

</script>

@endif

@stack('scripts')

</body>

</html>