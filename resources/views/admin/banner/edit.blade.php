@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1">

                Edit Homepage Banner

            </h3>

            <p class="text-muted mb-0">

                Perbarui banner yang akan tampil pada halaman utama.

            </p>

        </div>

        <a href="{{ route('banner.index') }}"
           class="btn btn-secondary rounded-pill">

            <i class="bi bi-arrow-left"></i>

            Kembali

        </a>

    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form
                action="{{ route('banner.update',$banner) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-lg-7">

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Judul Banner

                            </label>

                            <input
                                type="text"
                                name="title"
                                value="{{ old('title',$banner->title) }}"
                                class="form-control @error('title') is-invalid @enderror">

                            @error('title')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                            @enderror

                        </div>

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Sub Judul

                            </label>

                            <textarea
                                name="subtitle"
                                rows="3"
                                class="form-control">{{ old('subtitle',$banner->subtitle) }}</textarea>

                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="mb-3">

                                    <label class="form-label fw-semibold">

                                        Text Tombol

                                    </label>

                                    <input
                                        type="text"
                                        name="button_text"
                                        value="{{ old('button_text',$banner->button_text) }}"
                                        class="form-control">

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="mb-3">

                                    <label class="form-label fw-semibold">

                                        Link Tombol

                                    </label>

                                    <input
                                        type="text"
                                        name="button_link"
                                        value="{{ old('button_link',$banner->button_link) }}"
                                        class="form-control">

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="mb-3">

                                    <label class="form-label fw-semibold">

                                        Urutan

                                    </label>

                                    <input
                                        type="number"
                                        name="sort_order"
                                        value="{{ old('sort_order',$banner->sort_order) }}"
                                        class="form-control">

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="mb-3">

                                    <label class="form-label fw-semibold">

                                        Status

                                    </label>

                                    <select
                                        name="status"
                                        class="form-select">

                                        <option
                                            value="1"
                                            {{ $banner->status ? 'selected' : '' }}>

                                            Aktif

                                        </option>

                                        <option
                                            value="0"
                                            {{ !$banner->status ? 'selected' : '' }}>

                                            Nonaktif

                                        </option>

                                    </select>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-5">

                        <label class="form-label fw-semibold">

                            Ganti Banner

                        </label>

                        <input
                            type="file"
                            id="image"
                            name="image"
                            accept=".jpg,.jpeg,.png,.webp"
                            class="form-control">

                        <div class="mt-4 text-center">

                            <img
                                id="preview"
                                src="{{ asset('uploads/banner/'.$banner->image) }}"
                                class="img-fluid rounded shadow-sm">

                        </div>

                    </div>

                </div>

                <hr>

                <button
                    class="btn btn-primary rounded-pill px-5">

                    <i class="bi bi-save"></i>

                    Update Banner

                </button>

            </form>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>

document
.getElementById('image')
.addEventListener('change',function(e){

    const file=e.target.files[0];

    if(file){

        document
        .getElementById('preview')
        .src=URL.createObjectURL(file);

    }

});

</script>

@endpush