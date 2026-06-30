@extends('frontend.layout')

@section('content')

{{-- =======================================
    HERO SLIDER V2
======================================== --}}

<section class="hero-slider">

    <div class="swiper heroSwiper">

        <div class="swiper-wrapper">

            @forelse($banners as $banner)

            <div class="swiper-slide">

                <div class="hero-bg">

                    <img
                        src="{{ asset('uploads/banner/'.$banner->image) }}"
                        alt="{{ $banner->title }}">

                </div>

                <div class="hero-overlay"></div>

                <div class="container">

                    <div class="hero-content">

                        <h5 class="hero-small">

                            {{ $banner->title }}

                        </h5>

                        <h1>

                            {{ $company->company_name }}

                        </h1>

                        <p>

                            {{ $banner->subtitle }}

                        </p>

                        <a
                            href="{{ $banner->button_link ?: '#mobil' }}"
                            class="btn btn-danger btn-lg rounded-pill px-5">

                            {{ $banner->button_text }}

                        </a>

                    </div>

                </div>

            </div>

            @empty

            <div class="swiper-slide">

                <div class="hero-empty">

                    Tidak ada banner.

                </div>

            </div>

            @endforelse

        </div>

        <div class="swiper-pagination"></div>

    </div>

</section>

{{-- ===========================
    TENTANG
=========================== --}}

<section
    class="section bg-white"
    id="tentang">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="section-title">

                Tentang Kami

            </h2>

            <p class="section-subtitle">

                Mengenal lebih dekat showroom kami.

            </p>

        </div>

        <div class="row justify-content-center">

            <div class="col-12">

                <div class="card shadow border-0 rounded-4">

                    <div class="card-body p-5">

                        <div class="about-content">

                            {!! nl2br(e($company->tentang)) !!}
                
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- ===========================
    PRODUK
=========================== --}}

<section
    class="section"
    id="mobil">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="section-title">

                Produk Terbaru

            </h2>

            <p class="section-subtitle">

                Pilihan mobil baru & bekas terbaik, dan berbagai produk kami

            </p>

        </div>

        <div class="product-slider">

        @if($products->count())

<div class="product-scroll">

@foreach($products as $product)

@php

$cover = $product->images->firstWhere('is_cover',1);

@endphp

<div class="product-item">

<div class="card-product h-100">

<a href="{{ route('frontend.detail',$product->id) }}">

@if($cover)

<img
src="{{ asset('uploads/product/'.$cover->gambar) }}"
alt="{{ $product->nama }}">

@else

<div
class="d-flex justify-content-center align-items-center bg-light"
style="height:220px;">

<i
class="bi bi-image text-secondary"
style="font-size:70px;"></i>

</div>

@endif

</a>

<div class="card-body">

<h5
class="fw-bold mb-2"
style="height:50px;overflow:hidden;">

{{ $product->nama }}

</h5>

<div class="price mb-3">

Rp {{ number_format($product->harga,0,',','.') }}

</div>

<a
href="{{ route('frontend.detail',$product->id) }}"
class="btn btn-primary w-100 rounded-pill">

Lihat Detail

</a>

</div>

</div>

</div>

@endforeach

</div>

@else

<div class="alert alert-warning text-center">

Belum ada produk tersedia.

</div>

@endif

</div>

</section>

{{-- ===========================
GOOGLE MAPS
=========================== --}}

<section
class="section bg-white">

<div class="container">

<div class="text-center mb-5">

<h2 class="section-title">

Lokasi Kami

</h2>

<p class="section-subtitle">

Silakan datang langsung ke showroom.

</p>

</div>

@if(!empty($company->google_maps))

<div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow">

    {!! $company->google_maps !!}

</div>

@endif

</div>

</section>

@endsection

@push('styles')

<style>

.product-scroll{

display:flex;

gap:20px;

overflow-x:auto;

scroll-behavior:smooth;

padding-bottom:10px;

}

.product-scroll::-webkit-scrollbar{

height:8px;

}

.product-scroll::-webkit-scrollbar-thumb{

background:#d1d5db;

border-radius:20px;

}

.product-item{

flex:0 0 260px;

}

@media(min-width:992px){

.product-scroll{

display:grid;

grid-template-columns:repeat(4,1fr);

overflow:visible;

}

.product-item{

width:100%;

}

}

.hero-slider{

height:100vh;

position:relative;

overflow:hidden;

}

.heroSwiper{

height:100%;

}

.heroSwiper .swiper-slide{

position:relative;

height:100vh;

display:flex;

align-items:center;

}

.hero-bg{

position:absolute;

top:0;

left:0;

width:100%;

height:100%;

}

.hero-bg img{

width:100%;

height:100%;

object-fit:cover;

}

.hero-overlay{

position:absolute;

top:0;

left:0;

width:100%;

height:100%;

background:rgba(0,0,0,.55);

}

.hero-content{

position:relative;

z-index:20;

color:white;

max-width:700px;

}

.hero-small{

color:#ff4d4d;

font-weight:700;

letter-spacing:2px;

text-transform:uppercase;

}

.hero-content h1{

font-size:72px;

font-weight:800;

margin:15px 0;

}

.hero-content p{

font-size:24px;

margin-bottom:35px;

}

.hero-empty{

display:flex;

justify-content:center;

align-items:center;

height:100vh;

font-size:40px;

color:white;

background:#111;

}

@media(max-width:768px){

.hero-slider{

    height:auto;

    margin-top:0;

}

.heroSwiper{

height:auto;

}

.heroSwiper .swiper-slide{

height:auto;

display:block;

}

.hero-bg{

position:relative;

height:auto;

}

.hero-bg img{

width:100%;

height:auto;

aspect-ratio:16/9;

object-fit:cover;

border-radius:0;

}

.hero-overlay{

display:none;

}

.hero-content{

position:relative;

max-width:100%;

text-align:center;

color:#111827;

padding:25px 20px 35px;

}

.hero-small{

font-size:15px;

margin-bottom:8px;

}

.hero-content h1{

font-size:34px;

font-weight:700;

margin:10px 0;

}

.hero-content p{

font-size:16px;

margin-bottom:22px;

color:#666;

}

.hero-content .btn{

width:220px;

}

}

@media(max-width:768px){

.product-item{

flex:0 0 180px;

}

.card-product img{

height:150px;

}

.card-body{

padding:12px;

}

.price{

font-size:17px;

}

.card-body h5{

font-size:15px;

height:42px;

}

} 

/* ===========================
   ABOUT US
=========================== */

.about-content{

    font-size:18px;

    line-height:2;

    text-align:justify;

    color:#555;

}

</style>

</style>

@endpush