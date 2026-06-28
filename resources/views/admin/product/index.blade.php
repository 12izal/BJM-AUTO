@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-0">

                Kendaraan

            </h2>

            <small class="text-muted"><

                Kelola seluruh kendaraan showroom.

            </small>

        </div>

        <a href="{{ route('product.create') }}"
            class="btn btn-primary rounded-pill px-4">

            <i class="bi bi-plus-circle"></i>

            Tambah Kendaraan

        </a>

    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body">

            <div class="row">

                <div class="col-lg-8">

                    <input

                        type="text"

                        class="form-control form-control-lg"

                        placeholder="Cari kendaraan...">

                </div>

                <div class="col-lg-4">

                    <div class="text-end">

                        <span class="badge bg-dark fs-6">

                            Total :

                            {{ $products->total() }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

@forelse($products as $product)

@php

$cover = $product->images->where('is_cover',true)->first();

@endphp

<div class="col-xl-3 col-lg-4 col-md-6 mb-4">

<div class="card border-0 shadow rounded-4 overflow-hidden h-100">

@if($cover)

<img

src="{{ asset('uploads/product/'.$cover->gambar) }}"

style="height:220px;object-fit:cover;">

@else

<div

class="bg-secondary d-flex align-items-center justify-content-center"

style="height:220px;">

<div class="text-center text-white">

<h1>

📷

</h1>

Tidak Ada Foto

</div>

</div>

@endif

<div class="card-body">

<h5 class="fw-bold">

{{ $product->nama }}

</h5>

<h4 class="text-primary fw-bold">

Rp {{ number_format($product->harga,0,',','.') }}

</h4>

<p class="text-muted mb-3">

{{ Str::limit($product->deskripsi,70) }}

</p>

<div class="d-flex justify-content-between">

<span class="badge bg-success">

{{ $product->images->count() }}

Foto

</span>

@if($product->status)

<span class="badge bg-primary">

READY

</span>

@else

<span class="badge bg-danger">

SOLD

</span>

@endif

</div>

<hr>

<div class="d-grid gap-2">

<a

href="{{ route('product.edit',$product->id) }}"

class="btn btn-warning">

✏️ Edit

</a>

<form

action="{{ route('product.destroy',$product->id) }}"

method="POST">

@csrf

@method('DELETE')

<button

onclick="return confirm('Hapus kendaraan?')"

class="btn btn-danger w-100">

🗑 Hapus

</button>

</form>

</div>

</div>

</div>

</div>

@empty

<div class="col-12">

<div class="card border-0 shadow rounded-4">

<div class="card-body text-center py-5">

<h4>

Belum Ada Kendaraan

</h4>

<p>

Silakan tambah kendaraan pertama.

</p>

</div>

</div>

</div>

@endforelse

</div>

<style>

.card{

transition:.25s;

}

.card:hover{

transform:translateY(-8px);

}

.card img{

transition:.3s;

}

.card:hover img{

transform:scale(1.05);

}

</style>

<script>

document.addEventListener("DOMContentLoaded", function () {

    const searchInput = document.querySelector('input[placeholder="Cari kendaraan..."]');

    const cards = document.querySelectorAll('.col-xl-3');

    searchInput.addEventListener('keyup', function(){

        let keyword = this.value.toLowerCase();

        cards.forEach(function(card){

            let text = card.innerText.toLowerCase();

            if(text.indexOf(keyword) > -1){

                card.style.display='block';

            }else{

                card.style.display='none';

            }

        });

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

@if($products->hasPages())

<div class="mt-4 d-flex justify-content-center">

    {{ $products->links() }}

</div>

@endif

@endsection