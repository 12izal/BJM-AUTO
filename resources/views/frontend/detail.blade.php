@extends('frontend.layout')

@section('content')

<section class="hero detail-hero">

<div class="container">

<div class="row">

<div class="col-lg-7">

@if($product->images->count())

<div id="productCarousel"
class="carousel slide shadow rounded-4 overflow-hidden"
data-bs-ride="carousel">

<div class="carousel-inner">

@foreach($product->images as $key=>$image)

<div class="carousel-item {{ $key==0 ? 'active' : '' }}">

<img
src="{{ asset('uploads/product/'.$image->gambar) }}"
class="d-block w-100"
style="height:520px;object-fit:cover;">

</div>

@endforeach

</div>

@if($product->images->count()>1)

<button
class="carousel-control-prev"
type="button"
data-bs-target="#productCarousel"
data-bs-slide="prev">

<span class="carousel-control-prev-icon"></span>

</button>

<button
class="carousel-control-next"
type="button"
data-bs-target="#productCarousel"
data-bs-slide="next">

<span class="carousel-control-next-icon"></span>

</button>

@endif

</div>

@else

<div
class="bg-light rounded-4 shadow d-flex justify-content-center align-items-center"
style="height:520px;">

<h3 class="text-secondary">

Tidak Ada Foto

</h3>

</div>

@endif

</div>

<div class="col-lg-5 detail-card">

<div class="card border-0 shadow rounded-4">

<div class="card-body p-4">

<h2 class="fw-bold">

{{ $product->nama }}

</h2>

<div
class="text-primary fw-bold mb-4"
style="font-size:36px;">

Rp {{ number_format($product->harga,0,',','.') }}

</div>

<hr>

<h5 class="fw-bold">

Deskripsi

</h5>

<p class="text-muted">

{!! nl2br(e($product->deskripsi)) !!}

</p>

<hr>

<a
href="https://wa.me/{{ $company->whatsapp }}?text=Saya%20tertarik%20dengan%20mobil%20{{ urlencode($product->nama) }}"
target="_blank"
class="btn btn-success btn-lg w-100 rounded-pill">

<i class="bi bi-whatsapp"></i>

Hubungi via WhatsApp

</a>

<a
href="{{ route('home') }}"
class="btn btn-outline-secondary w-100 rounded-pill mt-3">

Kembali

</a>

</div>

</div>

</div>

</div>

</div>

</section>

<section class="section">

<div class="container">

<div class="text-center mb-5">

<h2 class="section-title">

Produk Lainnya

</h2>

<p class="section-subtitle">

Mungkin Anda juga tertarik.

</p>

</div>

<div class="row">

@if($relatedProducts->count())

@foreach($relatedProducts as $item)

@php

$cover = $item->images->firstWhere('is_cover',1);

@endphp

<div class="col-lg-3 col-md-4 col-6 mb-4">

<div class="card-product h-100">

<a href="{{ route('frontend.detail',$item->id) }}">

@if($cover)

<img
src="{{ asset('uploads/product/'.$cover->gambar) }}"
class="img-fluid"
alt="{{ $item->nama }}">

@else

<div
class="bg-light d-flex justify-content-center align-items-center"
style="height:220px;">

<i
class="bi bi-image"
style="font-size:60px;color:#999;"></i>

</div>

@endif

</a>

<div class="card-body">

<h6
class="fw-bold mb-2"
style="height:45px;overflow:hidden;">

{{ $item->nama }}

</h6>

<div class="price mb-3">

Rp {{ number_format($item->harga,0,',','.') }}

</div>

<a
href="{{ route('frontend.detail',$item->id) }}"
class="btn btn-outline-primary w-100 rounded-pill">

Lihat Detail

</a>

</div>

</div>

</div>

@endforeach

@else

<div class="col-12">

<div class="alert alert-warning text-center">

Belum ada produk lainnya.

</div>

</div>

@endif

</div>

</div>

</section>

@endsection

@push('styles')

<style>

.carousel-item img{

border-radius:18px;

}

.card-product{

border:none;

border-radius:18px;

overflow:hidden;

background:#fff;

transition:.25s;

box-shadow:0 8px 25px rgba(0,0,0,.08);

}

.card-product:hover{

transform:translateY(-5px);

}

.card-product img{

width:100%;

height:220px;

object-fit:cover;

}

.card-body{

padding:16px;

}

.price{

font-size:20px;

font-weight:700;

color:#0d6efd;

}

@media(max-width:768px){

.carousel-item img{

height:250px !important;

}

.card-product img{

height:140px;

}

.price{

font-size:16px;

}

.card-body h6{

font-size:14px;

height:40px;

}

}

.detail-hero{
    margin-top:90px;
    padding-bottom:50px;
}

/* Card Detail */

.detail-card{
    padding-left:28px;
}

@media(max-width:992px){

.detail-card{

    margin-top:28px;

    padding-left:12px;

    padding-right:12px;

}

}

@media(max-width:768px){

.detail-hero{

    margin-top:75px;

    padding-bottom:30px;

}

.carousel-item img{

    height:250px !important;

}

}

</style>

@endpush