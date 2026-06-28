@extends('layouts.admin')

@section('content')

<div class="container-fluid">

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card border-0 shadow-lg rounded-4">

<div class="card-header bg-dark text-white py-4">

<h3 class="mb-1">

Edit User

</h3>

<small class="text-secondary">

Perbarui informasi user.

</small>

</div>

<div class="card-body p-4">

@if(session('error'))

<div class="alert alert-danger">

{{ session('error') }}

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

<form
action="{{ route('user.update',$user->id) }}"
method="POST">

@csrf

@method('PUT')

<div class="mb-4">

<label class="form-label fw-bold">

Nama

</label>

<input
type="text"
name="nama"
class="form-control form-control-lg"
value="{{ old('nama',$user->nama) }}"
required>

</div>

<div class="mb-4">

<label class="form-label fw-bold">

Username

</label>

<input
type="text"
name="username"
class="form-control form-control-lg"
value="{{ old('username',$user->username) }}"
required>

</div>

<hr class="my-4">

<h5 class="fw-bold">

Ganti Password (Opsional)

</h5>

<p class="text-muted">

Kosongkan jika tidak ingin mengganti password.

</p>

<div class="mb-4">

<label class="form-label fw-bold">

Password Lama

</label>

<input
type="password"
name="old_password"
class="form-control form-control-lg">

</div>

<div class="mb-4">

<label class="form-label fw-bold">

Password Baru

</label>

<input
type="password"
name="password"
class="form-control form-control-lg">

</div>

<div class="mb-4">

    <label class="form-label fw-bold">

        Konfirmasi Password Baru

    </label>

    <input
        type="password"
        name="password_confirmation"
        class="form-control form-control-lg">

</div>

<hr class="my-4">

<div class="d-flex justify-content-between">

    <a
        href="{{ route('user.index') }}"
        class="btn btn-secondary btn-lg rounded-pill px-4">

        <i class="bi bi-arrow-left"></i>

        Kembali

    </a>

    <button
        type="submit"
        class="btn btn-primary btn-lg rounded-pill px-5">

        <i class="bi bi-save"></i>

        Simpan Perubahan

    </button>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

@endsection