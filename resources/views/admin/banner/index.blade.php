@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h3 class="fw-bold mb-1">Homepage Banner</h3>
        <p class="text-muted mb-0">
            Banner yang tampil pada halaman utama website.
        </p>
    </div>

    <a href="{{ route('banner.create') }}"
       class="btn btn-primary rounded-pill px-4">

        <i class="bi bi-plus-circle"></i>

        Tambah Banner

    </a>

</div>

@if($banners->count())

<div class="row">

@foreach($banners as $banner)

<div class="col-lg-6 mb-4">

<div class="card border-0 shadow-sm h-100">

    <img
        src="{{ asset('uploads/banner/'.$banner->image) }}"
        class="card-img-top"
        style="height:250px;object-fit:cover;">

    <div class="card-body">

        <div class="d-flex justify-content-between">

            <div>

                <h5 class="fw-bold">

                    {{ $banner->title }}

                </h5>

                @if($banner->subtitle)

                    <p class="text-muted">

                        {{ $banner->subtitle }}

                    </p>

                @endif

            </div>

            <div>

                @if($banner->status)

                    <span class="badge bg-success">

                        Aktif

                    </span>

                @else

                    <span class="badge bg-danger">

                        Nonaktif

                    </span>

                @endif

            </div>

        </div>

        <hr>

        <div class="row">

            <div class="col-6">

                <small class="text-muted">

                    Tombol

                </small>

                <div>

                    {{ $banner->button_text }}

                </div>

            </div>

            <div class="col-6">

                <small class="text-muted">

                    Urutan

                </small>

                <div>

                    {{ $banner->sort_order }}

                </div>

            </div>

        </div>

    </div>

    <div class="card-footer bg-white">

        <div class="d-flex gap-2">

            <a
                href="{{ route('banner.edit',$banner) }}"
                class="btn btn-warning w-100">

                <i class="bi bi-pencil-square"></i>

                Edit

            </a>

            <form
                action="{{ route('banner.destroy',$banner) }}"
                method="POST"
                class="w-100">

                @csrf
                @method('DELETE')

                <button
                    onclick="return confirm('Hapus banner ini?')"
                    class="btn btn-danger w-100">

                    <i class="bi bi-trash"></i>

                    Hapus

                </button>

            </form>

        </div>

    </div>

</div>

</div>

@endforeach

</div>

@else

<div class="card border-0 shadow-sm">

<div class="card-body text-center py-5">

<i
class="bi bi-images"
style="font-size:80px;color:#cbd5e1;"></i>

<h4 class="mt-4">

Belum ada Banner

</h4>

<p class="text-muted">

Silakan tambahkan banner homepage pertama.

</p>

<a
href="{{ route('banner.create') }}"
class="btn btn-primary rounded-pill px-4">

Tambah Banner

</a>

</div>

</div>

@endif

@endsection