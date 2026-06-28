@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1">
                User Management
            </h3>

            <small class="text-muted">
                Kelola akun administrator BJM AUTO
            </small>

        </div>

        <a href="{{ route('user.create') }}"
           class="btn btn-primary rounded-pill px-4">

            <i class="bi bi-plus-circle"></i>

            Tambah User

        </a>

    </div>

    @if(session('success'))

    <div class="alert alert-success">

        {{ session('success') }}

    </div>

    @endif

    @if(session('error'))

    <div class="alert alert-danger">

        {{ session('error') }}

    </div>

    @endif

    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header bg-dark text-white py-3">

            <h5 class="mb-0">

                Daftar User

            </h5>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th width="70">
                                No
                            </th>

                            <th>
                                Nama
                            </th>

                            <th>
                                Username
                            </th>

                            <th width="180">
                                Dibuat
                            </th>

                            <th width="170" class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($users as $user)

                        <tr>

                            <td>

                                {{ $loop->iteration + ($users->firstItem() - 1) }}

                            </td>

                            <td>

                                <strong>

                                    {{ $user->nama }}

                                </strong>

                            </td>

                            <td>

                                {{ $user->username }}

                            </td>

                            <td>

                                {{ $user->created_at->format('d M Y') }}

                            </td>

                            <td class="text-center">

                                <a
                                    href="{{ route('user.edit',$user->id) }}"
                                    class="btn btn-warning btn-sm rounded-pill">

                                    <i class="bi bi-pencil-square"></i>

                                    Edit

                                </a>

                                <form
                                    action="{{ route('user.destroy',$user->id) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm rounded-pill"
                                        onclick="return confirm('Yakin ingin menghapus user ini?')">

                                        <i class="bi bi-trash"></i>

                                        Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="5" class="text-center py-5">

                                <img
                                    src="{{ asset('images/empty-data.svg') }}"
                                    width="150"
                                    class="mb-3"
                                    onerror="this.style.display='none'">

                                <h5 class="text-muted">

                                    Belum ada user.

                                </h5>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        @if($users->hasPages())

        <div class="card-footer bg-white">

            {{ $users->links() }}

        </div>

        @endif

    </div>

</div>

@endsection