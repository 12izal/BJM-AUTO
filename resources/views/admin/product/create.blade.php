@extends('layouts.admin')

@section('content')

<div class="container-fluid">

<div class="row justify-content-center">

<div class="col-lg-10">

<div class="card border-0 shadow-lg rounded-4">

<div class="card-header bg-dark text-white py-4">

<h3 class="mb-1">

Tambah Produk

</h3>

<small class="text-secondary">

Upload kendaraan baru ke showroom BJM AUTO

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

action="{{ route('product.store') }}"

method="POST"

enctype="multipart/form-data">

@csrf

<div class="mb-5">

<h5 class="fw-bold mb-3">

📷 Upload Foto Kendaraan

</h5>

<label

for="images"

class="upload-box">

<div>

<div class="display-3 mb-2">

📸

</div>

<h5>

Klik atau Drag Foto ke sini

</h5>

<p class="text-muted mb-0">

Maksimal 20 Foto

</p>

</div>

</label>

<input

type="file"

id="images"

name="gambar[]"

multiple

accept="image/*"

hidden>

<div

id="preview"

class="row mt-4">

</div>

</div>

<hr>

<div class="mb-4">

<label class="form-label fw-bold">

Judul Iklan

</label>

<input

type="text"

name="nama"

class="form-control form-control-lg"

placeholder="Contoh : Toyota Fortuner VRZ Diesel 2022"

required>

</div>

<div class="mb-4">

<label class="form-label fw-bold">

Harga

</label>

<div class="input-group input-group-lg">

<span class="input-group-text">

Rp

</span>

<input

type="text"

name="harga"

id="harga"

class="form-control"

placeholder="0"

required>

</div>

</div>

<div class="mb-4">

<label class="form-label fw-bold">

Deskripsi Kendaraan

</label>

<textarea

name="deskripsi"

rows="8"

class="form-control"

placeholder="Tuliskan kondisi kendaraan, pajak, service record, kelengkapan surat, aksesoris, dan informasi penting lainnya..."></textarea>

</div>

<div class="save-button-wrapper">

<button

class="btn btn-primary btn-lg rounded-pill save-btn">

💾 Simpan Produk

</button>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

<style>

.upload-box{

height:260px;

border:3px dashed #0d6efd;

border-radius:20px;

display:flex;

justify-content:center;

align-items:center;

cursor:pointer;

transition:.3s;

background:#f8f9fa;

text-align:center;

}

.upload-box:hover{

background:#eef5ff;

border-color:#198754;

}

#preview img{

width:100%;

height:170px;

object-fit:cover;

border-radius:15px;

box-shadow:0 10px 25px rgba(0,0,0,.15);

}

.save-button-wrapper{

display:flex;

justify-content:flex-end;

margin-top:30px;

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

<script>

const input = document.getElementById('images');

const preview = document.getElementById('preview');

input.addEventListener('change', function () {

    preview.innerHTML = '';

    Array.from(this.files).forEach(function(file,index){

        const reader = new FileReader();

        reader.onload = function(e){

            preview.innerHTML += `

            <div class="col-lg-3 col-md-4 col-6 mb-4">

                <div class="card border-0 shadow rounded-4 overflow-hidden">

                    <img src="${e.target.result}">

                    <div class="card-body text-center py-2">

                        <small class="text-muted">

                            Foto ${index+1}

                        </small>

                    </div>

                </div>

            </div>

            `;

        }

        reader.readAsDataURL(file);

    });

});

const harga = document.getElementById('harga');

harga.addEventListener('keyup',function(){

    let angka=this.value.replace(/[^,\d]/g,'');

    let split=angka.split(',');

    let sisa=split[0].length%3;

    let rupiah=split[0].substr(0,sisa);

    let ribuan=split[0].substr(sisa).match(/\d{3}/gi);

    if(ribuan){

        let separator=sisa?'.':'';

        rupiah+=separator+ribuan.join('.');

    }

    rupiah=split[1]!=undefined

        ?rupiah+','+split[1]

        :rupiah;

    this.value=rupiah;

});

document.querySelector('form').addEventListener('submit',function(){

    harga.value=harga.value.replace(/\./g,'');

});

</script>

@endsection