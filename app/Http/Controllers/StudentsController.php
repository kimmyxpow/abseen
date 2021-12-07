<?php

namespace App\Http\Controllers;

use App\Models\Rayon;
use App\Models\Rombel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class StudentsController extends Controller
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
        return view('dashboard.user.student.index', [
            'data' => User::where('role', 'Siswa')->orderBy('nis')->paginate($this->limitData)
        ])->with('i', (request()->input('page', 1) - 1) * $this->limitData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.user.student.create', [
            'rombel' => Rombel::orderBy('name')->get(),
            'rayon' => Rayon::orderBy('name')->get(),
        ]);
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
            'nis' => ['required', 'numeric', 'unique:users'],
            'rombel' => ['required'],
            'rayon' => ['required'],
            'username' => ['required', 'min:5', 'max:15', 'string', 'unique:users'],
            'email' => ['required', 'max:255', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'avatar' => ['nullable', 'file', 'image', 'max:2048'],
        ]);

        //? Cek jika avatar tidak diisi maka gunakan avatar default
        if (is_null($request->avatar)) {
            $validatedData['avatar'] = '/img/avatar/' . substr($request->name, 0, 1) . '.png';
        } else {
            $validatedData['avatar'] = '/' . $request->file('avatar')->store('img/avatar/upload', 'to-public');
            $validatedData['is_edited'] = true;
        }

        //? Menentukan role user
        $validatedData['role'] = 'Siswa';

        $validatedData['password'] = bcrypt($request->password);

        //? Menambah field 
        $validatedData['rombel_id'] = $validatedData['rombel'];
        $validatedData['rayon_id'] = $validatedData['rayon'];

        //? Menghapus field
        unset($validatedData['rombel']);
        unset($validatedData['rayon']);

        //? Memasukkan data ke dalam database
        User::create($validatedData);

        //? Redirect ke dashboard user dengan session success
        return redirect('/dashboard/user/siswa')->with('success', 'Berhasil Menambah Data Baru!');
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
        return view('dashboard.user.student.edit', [
            'rombel' => Rombel::orderBy('name')->get(),
            'rayon' => Rayon::orderBy('name')->get(),
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
            'rombel' => ['required'],
            'rayon' => ['required'],
            'avatar' => ['nullable', 'file', 'image', 'max:2048'],
        ];

        //? Menambah Validasi Password Jika Admin Menambah Password Baru
        if (!is_null($request->password)) $rules['password'] = ['confirmed', Rules\Password::defaults()];

        //? Menambah Validasi NIS Jika Admin Mengubah NIS Siswa
        if ($request->nis != $user->nis) $rules['nis'] = ['required', 'numeric', 'unique:users'];

        //? Menambah Validasi Username Jika Admin Mengubah Username Siswa
        if ($request->username != $user->username) $rules['username'] = ['required', 'min:5', 'max:15', 'string', 'unique:users'];

        //? Menambah Validasi Email Jika Admin Mengubah Email Siswa
        if ($request->email != $user->email) $rules['email'] = ['required', 'max:255', 'email', 'unique:users'];

        //? Validasi input
        $validatedData = $request->validate($rules);

        if (!is_null($request->password)) $validatedData['password'] = bcrypt($request->password);

        //? Cek jika ada avatar baru
        if (!is_null($request->avatar)) {
            //? Simpan avatar baru
            $validatedData['avatar'] = '/' . $request->file('avatar')->store('img/avatar/upload', 'to-public');
            $validatedData['is_edited'] = true;

            //? Cek apakah avatar siswa adalah avatar default atau bukan
            if ($user->is_edited) {
                //? Hapus avatar lama jika avatar bukan avatar default
                Storage::disk('to-public')->delete($user->avatar);
            }
        }

        //? Mengubah field
        $validatedData['rombel_id'] = $validatedData['rombel'];
        $validatedData['rayon_id'] = $validatedData['rayon'];

        //? Menghapus field
        unset($validatedData['rombel']);
        unset($validatedData['rayon']);

        //? Mengubah data ke dalam database
        $user->update($validatedData);

        //? Redirect ke dashboard user dengan session success
        return redirect('/dashboard/user/siswa')->with('success', 'Berhasil Mengubah Data!');
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
        return redirect('/dashboard/user/siswa')->with('success', 'Berhasil Menghapus Data!');
    }
}
