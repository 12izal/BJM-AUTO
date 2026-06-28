<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>

{{ $company->company_name ?? 'BJM AUTO' }}

</title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{

margin:0;
padding:0;
box-sizing:border-box;

}

html{

scroll-behavior:smooth;

}

body{

font-family:'Poppins',sans-serif;

background:#f5f7fb;

overflow-x:hidden;

}

a{

text-decoration:none;

}

img{

max-width:100%;

display:block;

}

:root{

--primary:#0d6efd;

--dark:#1f2937;

--light:#ffffff;

--radius:18px;

}

.navbar-custom{

position:fixed;

top:0;

left:0;

width:100%;

z-index:999;

padding:22px 0;

transition:.35s ease;

background:transparent;

box-shadow:none;

}

.navbar-custom.scrolled{

background:#111827;

padding:14px 0;

box-shadow:0 10px 30px rgba(0,0,0,.20);

backdrop-filter:blur(10px);

}

.logo{

height:72px;

transition:.3s;

}

.navbar-custom.scrolled .logo{

height:60px;

}

.menu a{

margin-left:30px;

font-weight:600;

color:#fff;

transition:.3s;

}

.navbar-custom.scrolled .menu a{

color:#fff;

}

.navbar-custom.scrolled .menu a:hover{

color:#ef4444;

}

.menu a:hover{

color:var(--primary);

}

.hero{

margin-top:90px;

}

.section{

padding:80px 0;

}

.section-title{

font-size:34px;

font-weight:700;

margin-bottom:15px;

text-align:center;

}

.section-subtitle{

text-align:center;

color:#777;

margin-bottom:50px;

}

.card-product{

border:none;

border-radius:20px;

overflow:hidden;

background:#fff;

transition:.25s;

box-shadow:0 5px 20px rgba(0,0,0,.06);

}

.card-product:hover{

transform:translateY(-6px);

}

.card-product img{

width:100%;

height:210px;

object-fit:cover;

}

.card-body{

padding:18px;

}

.price{

font-size:22px;

font-weight:700;

color:#0d6efd;

}

.footer{

background:#111827;

color:#fff;

padding:60px 0;

margin-top:80px;

}

.footer h3,
.footer h5{

margin-bottom:20px;

}

.footer p{

margin-bottom:18px;

line-height:1.8;

}

.footer .social{

display:flex;

gap:18px;

font-size:32px;

margin-top:15px;

}

.footer .social a{

color:#0d6efd;

transition:.3s;

}

.footer .social a:hover{

color:#fff;

transform:translateY(-3px);

}

.whatsapp{

position:fixed;

right:25px;

bottom:25px;

width:65px;

height:65px;

border-radius:50%;

background:#25D366;

display:flex;

align-items:center;

justify-content:center;

font-size:30px;

color:#fff;

box-shadow:0 10px 30px rgba(0,0,0,.2);

z-index:999;

}

@media(max-width:768px){

.section{

padding:50px 0;

}

.menu{

display:none;

}

.section-title{

font-size:28px;

}

/* Footer */

.footer{

text-align:left;

padding:45px 0;

}

.footer .col-lg-5,

.footer .col-lg-4,

.footer .col-lg-3{

margin-bottom:35px;

}

.footer h3{

font-size:34px;

margin-bottom:18px;

}

.footer h5{

margin-bottom:15px;

}

.footer .social{

gap:22px;

font-size:34px;

}

.footer hr{

margin:20px 0;

}

}

</style>

@stack('styles')

</head>

<body>

<nav class="navbar-custom {{ request()->is('mobil/*') ? 'scrolled' : '' }}">

<div class="container">

<div class="d-flex justify-content-between align-items-center">

<a href="{{ route('home') }}">

    <img
        src="{{ asset('images/logo.png') }}"
        class="logo"
        alt="BJM AUTO">

</a>

<div class="menu d-none d-lg-block">

<a href="#home">

Home

</a>

<a href="#mobil">

Mobil

</a>

<a href="#tentang">

Tentang

</a>

<a href="#kontak">

Kontak

</a>

<a
href="https://wa.me/{{ $company->whatsapp }}"
class="btn btn-success rounded-pill px-4 ms-3">

<i class="bi bi-whatsapp"></i>

WhatsApp

</a>

</div>

</div>

</div>

</nav>

<main>

@yield('content')

</main>

<footer
class="footer"
id="kontak">

<div class="container">

<div class="row">

<div class="col-lg-5">

<h3 class="mb-3">

{{ $company->company_name }}

</h3>

<p class="text-light opacity-75 mb-0">

Showroom Mobil Baru & Bekas<br>
Service • Repair • Ganti Oli<br>
Spare Part & Perawatan Kendaraan

</p>

</div>

<div class="col-lg-3">

<h5 class="mb-3">

Kontak

</h5>

<p>

<i class="bi bi-geo-alt"></i>

{{ $company->alamat }}

</p>

<p>

<i class="bi bi-telephone"></i>

{{ $company->telepon }}

</p>

<p>

<i class="bi bi-envelope"></i>

{{ $company->email }}

</p>

</div>

<div class="col-lg-4">

<h5 class="mb-3">

Ikuti Kami

</h5>

<div class="social">

@if($company->facebook)

<a
href="{{ $company->facebook }}"
target="_blank">

<i class="bi bi-facebook"></i>

</a>

@endif

@if($company->instagram)

<a
href="{{ $company->instagram }}"
target="_blank">

<i class="bi bi-instagram"></i>

</a>

@endif

@if($company->tiktok)

<a
href="{{ $company->tiktok }}"
target="_blank">

<i class="bi bi-tiktok"></i>

</a>

@endif

@if($company->youtube)

<a
href="{{ $company->youtube }}"
target="_blank">

<i class="bi bi-youtube"></i>

</a>

@endif

</div>

</div>

</div>

<hr class="border-secondary my-4">

<div class="text-center">

© {{ date('Y') }}

{{ $company->company_name }}

All Rights Reserved.

</div>

</div>

</footer>

@if(!empty($company->whatsapp))

<a
href="https://wa.me/{{ $company->whatsapp }}"
class="whatsapp">

<i class="bi bi-whatsapp"></i>

</a>

@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

<link
rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>

new Swiper(".heroSwiper",{

loop:true,

speed:900,

autoplay:{

delay:5000,

disableOnInteraction:false

},

pagination:{

el:".swiper-pagination",

clickable:true

}

});

</script>

<script>

const navbar = document.querySelector('.navbar-custom');

const isDetailPage = window.location.pathname.startsWith('/mobil/');

if (!isDetailPage) {

    window.addEventListener('scroll', function () {

        if (window.scrollY > 50) {

            navbar.classList.add('scrolled');

        } else {

            navbar.classList.remove('scrolled');

        }

    });

}

</script>

</body>

</html>