<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Menyimpan pengguna baru berdasarkan data dari form admin yang lengkap.
     */
    public function store(Request $request)
    {
        // 1. Validasi diperbarui untuk mencakup semua field baru
        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,member'],
            'age' => ['required', 'integer', 'min:1'],
            'gender' => ['required', 'in:male,female'],
            'height' => ['required', 'numeric', 'min:0'],
            'weight' => ['required', 'numeric', 'min:0'],
            'activity_level' => ['required', 'string'],
            'medical_history' => ['nullable', 'string', 'max:255'],
        ]);

        // 2. Data yang disimpan ke database diperbarui
        User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'age' => $request->age,
            'gender' => $request->gender,
            'height' => $request->height,
            'weight' => $request->weight,
            'activity_level' => $request->activity_level,
            'medical_history' => $request->medical_history,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Mengupdate pengguna berdasarkan data dari form admin yang lengkap.
     */
    public function update(Request $request, User $user)
    {
        // 1. Validasi diperbarui untuk mencakup semua field baru
        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:admin,member'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'age' => ['required', 'integer', 'min:1'],
            'gender' => ['required', 'in:male,female'],
            'height' => ['required', 'numeric', 'min:0'],
            'weight' => ['required', 'numeric', 'min:0'],
            'activity_level' => ['required', 'string'],
            'medical_history' => ['nullable', 'string', 'max:255'],
        ]);

        // 2. Mengambil semua data yang relevan dari request
        $userData = $request->only(
            'fullname', 'email', 'role', 'age', 'gender', 'height', 
            'weight', 'activity_level', 'medical_history'
        );

        // Jika password diisi, hash dan tambahkan ke data update
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        // Lakukan update
        $user->update($userData);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() == $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak dapat menghapus diri sendiri.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}
