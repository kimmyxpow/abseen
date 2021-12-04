<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class AdministratorController extends Controller
{
    //? Maksimal data (pagination)
    protected $limitData = 8;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.user.admin.index', [
            'data' => User::where('role', 'Admin')->orderBy('name')->paginate($this->limitData)
        ])->with('i', (request()->input('page', 1) - 1) * $this->limitData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.user.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //? Validasi input
        $validatedData = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'username' => ['required', 'min:5', 'max:15', 'string', 'unique:users'],
            'email' => ['required', 'max:255', 'email:dns', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'avatar' => ['nullable', 'file', 'image', 'max:2048'],
        ]);

        //? Cek jika avatar tidak diisi maka gunakan avatar default
        if (is_null($request->avatar)) {
            $validatedData['avatar'] = '/img/avatar/' . substr($request->name, 0, 1) . '.png';
        } else {
            $validatedData['avatar'] = '/' . $request->file('avatar')->store('img/avatar', 'to-public');
            $validatedData['is_edited'] = true;
        }

        //? Menentukan role user
        $validatedData['role'] = 'Admin';

        //? Memasukkan data ke dalam database
        User::create($validatedData);

        //? Redirect ke dashboard user dengan session success
        return redirect('/dashboard/user/admin')->with('success', 'Berhasil Menambah Data Baru!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.user.admin.edit', [
            'data' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //? Rules Untuk Validasi input
        $rules = [
            'name' => ['required', 'max:255', 'string'],
            'avatar' => ['nullable', 'file', 'image', 'max:2048'],
        ];

        //? Menambah Validasi Password Jika Admin Menambah Password Baru
        if (!is_null($request->password)) {
            $rules['password'] = ['confirmed', Rules\Password::defaults()];
        }

        //? Menambah Validasi Username Jika Admin Mengubah Username Siswa
        if ($request->username != $user->username) {
            $rules['username'] = ['required', 'min:5', 'max:15', 'string', 'unique:users'];
        }

        //? Menambah Validasi Email Jika Admin Mengubah Email Siswa
        if ($request->email != $user->email) {
            $rules['email'] = ['required', 'max:255', 'email:dns', 'unique:users'];
        }

        //? Validasi input
        $validatedData = $request->validate($rules);

        //? Cek jika ada avatar baru
        if (!is_null($request->avatar)) {
            //? Simpan avatar baru
            $validatedData['avatar'] = '/' . $request->file('avatar')->store('img/avatar', 'to-public');
            $validatedData['is_edited'] = true;

            //? Cek apakah avatar siswa adalah avatar default atau bukan
            if ($user->is_edited) {
                //? Hapus avatar lama jika avatar bukan avatar default
                Storage::disk('to-public')->delete($user->avatar);
            }
        }

        //? Mengubah data ke dalam database
        $user->update($validatedData);

        //? Redirect ke dashboard user dengan session success
        return redirect('/dashboard/user/admin')->with('success', 'Berhasil Mengubah Data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //? Cek apakah avatar siswa adalah avatar default atau bukan
        if ($user->is_edited) {
            //? Hapus avatar lama jika avatar bukan avatar default
            Storage::disk('to-public')->delete($user->avatar);
        }

        //? Menghapus data user
        $user->delete();

        //? Redirect ke dashboard user dengan session success
        return redirect('/dashboard/user/admin')->with('success', 'Berhasil Menghapus Data!');
    }
}
