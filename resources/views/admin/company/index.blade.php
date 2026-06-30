@extends('layouts.admin')

@section('content')

<div class="container-fluid">

<div class="row justify-content-center">

<div class="col-lg-10">

@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif

@if($errors->any())

<div class="alert alert-danger">

<ul class="mb-0">

@foreach($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>

</div>

@endif

<div class="card border-0 shadow-lg rounded-4">

<div class="card-header bg-dark text-white py-4">

<h3 class="mb-1">

Company Profile

</h3>

<small class="text-secondary">

Informasi yang akan tampil pada website publik.

</small>

</div>

<div class="card-body p-4">

<form
action="{{ route('company.update') }}"
method="POST"
enctype="multipart/form-data">

@csrf

@method('PUT')

<div class="row">

</div>

<div class="mb-4">

<label class="form-label fw-bold">

Nama Perusahaan

</label>

<input
type="text"
name="company_name"
class="form-control form-control-lg"
value="{{ old('company_name',$company->company_name) }}">

</div>

<div class="mb-4">

    <label class="form-label fw-bold">

        Tentang Perusahaan

    </label>

    <textarea
        name="tentang"
        rows="6"
        class="form-control">{{ old('tentang',$company->tentang) }}</textarea>

</div>

<div class="row">

    <div class="col-lg-6">

        <div class="mb-4">

            <label class="form-label fw-bold">

                Alamat

            </label>

            <textarea
                name="alamat"
                rows="4"
                class="form-control">{{ old('alamat',$company->alamat) }}</textarea>

        </div>

    </div>

    <div class="col-lg-6">

        <div class="mb-4">

            <label class="form-label fw-bold">

                Google Maps (Embed URL)

            </label>

            <textarea
                name="google_maps"
                rows="4"
                class="form-control"
                placeholder="https://www.google.com/maps/embed?...">{{ old('google_maps',$company->google_maps) }}</textarea>

        </div>

    </div>

</div>

<hr>

<h5 class="fw-bold mb-3">

Kontak Perusahaan

</h5>

<div class="row">

    <div class="col-lg-6">

        <div class="mb-4">

            <label class="form-label fw-bold">

                Telepon

            </label>

            <input
                type="text"
                name="telepon"
                class="form-control"
                value="{{ old('telepon',$company->telepon) }}">

        </div>

    </div>

    <div class="col-lg-6">

        <div class="mb-4">

            <label class="form-label fw-bold">

                WhatsApp

            </label>

            <input
                type="text"
                name="whatsapp"
                class="form-control"
                placeholder="628xxxxxxxxxx"
                value="{{ old('whatsapp',$company->whatsapp) }}">

        </div>

    </div>

    <div class="col-lg-6">

        <div class="mb-4">

            <label class="form-label fw-bold">

                Email

            </label>

            <input
                type="email"
                name="email"
                class="form-control"
                value="{{ old('email',$company->email) }}">

        </div>

    </div>

</div>

<hr>

<h5 class="fw-bold mb-3">

Media Sosial

</h5>

<div class="row">

    <div class="col-lg-6">

        <div class="mb-4">

            <label class="form-label fw-bold">

                Facebook

            </label>

            <input
                type="text"
                name="facebook"
                class="form-control"
                value="{{ old('facebook',$company->facebook) }}">

        </div>

    </div>

    <div class="col-lg-6">

        <div class="mb-4">

            <label class="form-label fw-bold">

                Instagram

            </label>

            <input
                type="text"
                name="instagram"
                class="form-control"
                value="{{ old('instagram',$company->instagram) }}">

        </div>

    </div>

    <div class="col-lg-6">

        <div class="mb-4">

            <label class="form-label fw-bold">

                TikTok

            </label>

            <input
                type="text"
                name="tiktok"
                class="form-control"
                value="{{ old('tiktok',$company->tiktok) }}">

        </div>

    </div>

    <div class="col-lg-6">

        <div class="mb-4">

            <label class="form-label fw-bold">

                YouTube

            </label>

            <input
                type="text"
                name="youtube"
                class="form-control"
                value="{{ old('youtube',$company->youtube) }}">

        </div>

    </div>

</div>

<hr>

<div class="save-button-wrapper mt-4">

    <button
        type="submit"
        class="btn btn-primary btn-lg rounded-pill save-btn">

        💾 Simpan Perubahan

    </button>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

@push('styles')

<style>

.save-button-wrapper{

    display:flex;

    justify-content:flex-end;

}

.save-btn{

    min-width:240px;

    font-weight:600;

    padding:12px 30px;

}

@media(max-width:768px){

    .save-button-wrapper{

        justify-content:center;

    }

    .save-btn{

        width:85%;

        max-width:320px;

    }

}

</style>

@endpush

@endsection