@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>

                    <h3 class="fw-bold mb-1">
                        Edit Kendaraan
                    </h3>

                    <small class="text-muted">
                        Perbarui data kendaraan showroom BJM AUTO
                    </small>

                </div>

                <a href="{{ route('product.index') }}"
                   class="btn btn-secondary rounded-pill px-4">

                    <i class="bi bi-arrow-left"></i>

                    Kembali

                </a>

            </div>

            <div class="card border-0 shadow-lg rounded-4 mb-4">

                <div class="card-header bg-dark text-white py-4">

                    <h4 class="mb-0">

                        📷 Galeri Kendaraan

                    </h4>

                </div>

                <div class="card-body">

                    <div class="row">

                        @forelse($product->images as $image)

                        <div class="col-lg-3 col-md-4 col-6 mb-4">

                            <div class="card border-0 shadow rounded-4 overflow-hidden h-100">

                                <img
                                    src="{{ asset('uploads/product/'.$image->gambar) }}"
                                    class="w-100"
                                    style="height:190px;object-fit:cover;">

                                <div class="card-body text-center">

                                    @if($image->is_cover)

                                        <span class="badge bg-success mb-3">

                                            Cover

                                        </span>

                                    @endif

                                    <form
                                        action="{{ route('product.image.cover',$image->id) }}"
                                        method="POST">

                                        @csrf
                                        @method('PUT')

                                        <button
                                            type="submit"
                                            class="btn btn-outline-primary btn-sm w-100">

                                            ⭐ Jadikan Cover

                                        </button>

                                    </form>

                                    <form
                                        action="{{ route('product.image.destroy',$image->id) }}"
                                        method="POST"
                                        class="mt-2">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            onclick="return confirm('Hapus foto ini?')"
                                            class="btn btn-outline-danger btn-sm w-100">

                                            🗑 Hapus Foto

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                        @empty

                        <div class="col-12">

                            <div class="alert alert-warning text-center">

                                Belum ada foto kendaraan.

                            </div>

                        </div>

                        @endforelse

                    </div>

                </div>

            </div>

                        <div class="card border-0 shadow-lg rounded-4">

                <div class="card-header bg-primary text-white py-4">

                    <h4 class="mb-0">

                        📝 Informasi Kendaraan

                    </h4>

                </div>

                <div class="card-body">

                    <form
                        action="{{ route('product.update',$product->id) }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="mb-5">

                            <h5 class="fw-bold mb-3">

                                📷 Upload Foto Baru

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
                                value="{{ old('nama',$product->nama) }}"
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
                                    value="{{ number_format($product->harga,0,',','.') }}"
                                    required>

                            </div>

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-bold">

                                Deskripsi

                            </label>

                            <textarea
                                name="deskripsi"
                                rows="8"
                                class="form-control">{{ old('deskripsi',$product->deskripsi) }}</textarea>

                        </div>

                        <div class="d-flex justify-content-between">

                            <a
                                href="{{ route('product.index') }}"
                                class="btn btn-secondary btn-lg rounded-pill px-4">

                                <i class="bi bi-arrow-left"></i>

                                Kembali

                            </a>

                            <button
                                type="submit"
                                class="btn btn-primary btn-lg rounded-pill px-5">

                                💾 Simpan Perubahan

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

height:240px;

border:3px dashed #0d6efd;

border-radius:20px;

display:flex;

justify-content:center;

align-items:center;

cursor:pointer;

background:#f8f9fa;

transition:.3s;

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

</style>

<script>

const input=document.getElementById('images');
const preview=document.getElementById('preview');

if(input){

input.addEventListener('change',function(){

preview.innerHTML='';

Array.from(this.files).forEach(function(file,index){

const reader=new FileReader();

reader.onload=function(e){

preview.innerHTML+=`

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

}

const harga=document.getElementById('harga');

if(harga){

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

const updateForm = document.querySelector(
    'form[action="{{ route('product.update',$product->id) }}"]'
);

if(updateForm){

    updateForm.addEventListener('submit',function(){

        harga.value = harga.value.replace(/\./g,'');

    });

}

}

</script>

@endsection