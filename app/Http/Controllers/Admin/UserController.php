<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Daftar User
     */
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('admin.user.index', compact('users'));
    }

    /**
     * Form Tambah User
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Simpan User
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'                  => 'required|max:100',
            'username'              => 'required|max:50|unique:users,username',
            'password'              => 'required|min:6|confirmed',
        ]);

        User::create([
            'nama'      => $request->nama,
            'username'  => $request->username,
            'password'  => Hash::make($request->password),
        ]);

        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

        /**
     * Form Edit User
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update User
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama'     => 'required|max:100',
            'username' => 'required|max:50|unique:users,username,' . $user->id,
        ]);

        // Update nama & username
        $user->update([
            'nama'     => $request->nama,
            'username' => $request->username,
        ]);

        // Jika ingin ganti password
        if (
            $request->filled('old_password') ||
            $request->filled('password') ||
            $request->filled('password_confirmation')
        ) {

            $request->validate([
                'old_password' => 'required',
                'password' => 'required|min:6|confirmed',
            ]);

            if (!Hash::check($request->old_password, $user->password)) {

                return back()
                    ->withInput()
                    ->with('error', 'Password lama salah.');

            }

            $user->update([
                'password' => Hash::make($request->password),
            ]);

        }

        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Hapus User
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil dihapus.');
    }

}