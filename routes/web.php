<?php

use App\Http\Controllers\AbsentController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RayonController;
use App\Http\Controllers\RombelController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeacherController;
use App\Models\Absent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//? Tampilan halaman Landing Page
Route::get('/', function () {
    return view('welcome');
});

//? Route yang hanya bisa di akses sebelum Login
Route::middleware('guest')->group(function () {
    //! Login

    //? Tampilan halaman Login
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    //? Fungsi untuk Login
    Route::post('/login', [AuthController::class, 'store'])->name('login.store');

    //! End Login
});

//? Route yang hanya bisa di akses setelah Login
Route::middleware('auth')->group(function () {
    //! Dashboard

    //? Tampilan Dashboard
    Route::get('/dashboard', function () {
        $limitData = 8;

        return view('dashboard.index', [
            'data' => (Auth::user()->role == 'Siswa') ? Absent::where('rombel_id', Auth::user()->rombel_id)->orWhere('rayon_id', Auth::user()->rayon_id)->where('date', date('Y-m-d'))->paginate($limitData) : Absent::where('date', date('Y-m-d'))->paginate($limitData)
        ])->with('i', (request()->input('page', 1) - 1) * $limitData);
    })->name('dashboard');

    //! End Dahboard

    //! Logout

    //? Fungsi untuk Logout
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

    //! End Logout

    Route::middleware('admin')->group(function () {
        //! Rombel

        //? Menampilkan resource rombel
        Route::resource('/dashboard/rombel', RombelController::class);
        //? Menampilkan siswa per-rombel
        Route::get('/dashboard/rombel/{rombel:id}/siswa', [RombelController::class, 'students'])->name('rombel.students');

        //! End Rombel

        //! Rayon

        //? Menampilkan resource rayon
        Route::resource('/dashboard/rayon', RayonController::class);
        //? Menampilkan siswa per-rayon
        Route::get('/dashboard/rayon/{rayon:id}/siswa', [RayonController::class, 'students'])->name('rayon.students');

        //! End Rayon

        //! All User

        Route::get('/dashboard/user', function () {
            $limitData = 8;

            return view('dashboard.user.index', [
                'data' => User::orderBy('name')->paginate($limitData)
            ])->with('i', (request()->input('page', 1) - 1) * $limitData);
        })->name('user.index');

        //! End All User

        //! Siswa

        //? Menampilkan data siswa
        Route::get('/dashboard/user/siswa', [StudentsController::class, 'index'])->name('siswa.index');
        //? Menampilkan form tambah siswa
        Route::get('/dashboard/user/siswa/create', [StudentsController::class, 'create'])->name('siswa.create');
        //? Fungsi untuk menambah data siswa
        Route::post('/dashboard/user/siswa/create', [StudentsController::class, 'store'])->name('siswa.store');
        //? Menampilkan form edit siswa
        Route::get('/dashboard/user/siswa/{user:id}/edit', [StudentsController::class, 'edit'])->name('siswa.edit');
        //? Fungsi untuk mengubah data siswa
        Route::post('/dashboard/user/siswa/{user:id}/edit', [StudentsController::class, 'update'])->name('siswa.update');
        //? Fungsi untuk mengambil data siswa
        Route::get('/dashboard/user/siswa/{user:id}', [StudentsController::class, 'show'])->name('siswa.show');
        //? Fungsi untuk menghapus data siswa
        Route::post('/dashboard/user/siswa/{user:id}/delete', [StudentsController::class, 'destroy'])->name('siswa.destroy');

        //! End Siswa

        //! Guru

        //? Menampilkan data guru
        Route::get('/dashboard/user/guru', [TeacherController::class, 'index'])->name('guru.index');
        //? Menampilkan form tambah guru
        Route::get('/dashboard/user/guru/create', [TeacherController::class, 'create'])->name('guru.create');
        //? Fungsi untuk menambah data guru
        Route::post('/dashboard/user/guru/create', [TeacherController::class, 'store'])->name('guru.store');
        //? Menampilkan form edit guru
        Route::get('/dashboard/user/guru/{user:id}/edit', [TeacherController::class, 'edit'])->name('guru.edit');
        //? Fungsi untuk mengubah data guru
        Route::post('/dashboard/user/guru/{user:id}/edit', [TeacherController::class, 'update'])->name('guru.update');
        //? Fungsi untuk mengambil data guru
        Route::get('/dashboard/user/guru/{user:id}', [TeacherController::class, 'show'])->name('guru.show');
        //? Fungsi untuk menghapus data guru
        Route::post('/dashboard/user/guru/{user:id}/delete', [TeacherController::class, 'destroy'])->name('guru.destroy');

        //! End Guru

        //! Admin

        //? Menampilkan data admin
        Route::get('/dashboard/user/admin', [AdministratorController::class, 'index'])->name('admin.index');
        //? Menampilkan form tambah admin
        Route::get('/dashboard/user/admin/create', [AdministratorController::class, 'create'])->name('admin.create');
        //? Fungsi untuk menambah data admin
        Route::post('/dashboard/user/admin/create', [AdministratorController::class, 'store'])->name('admin.store');
        //? Menampilkan form edit admin
        Route::get('/dashboard/user/admin/{user:id}/edit', [AdministratorController::class, 'edit'])->name('admin.edit');
        //? Fungsi untuk mengubah data admin
        Route::post('/dashboard/user/admin/{user:id}/edit', [AdministratorController::class, 'update'])->name('admin.update');
        //? Fungsi untuk mengambil data admin
        Route::get('/dashboard/user/admin/{user:id}', [AdministratorController::class, 'show'])->name('admin.show');
        //? Fungsi untuk menghapus data admin
        Route::post('/dashboard/user/admin/{user:id}/delete', [AdministratorController::class, 'destroy'])->name('admin.destroy');

        //! End Admin

        //! Absensi

        //? Menampilkan data absen
        Route::get('/dashboard/absensi', [AbsentController::class, 'index'])->name('absent.index');
        //? Fungsi untuk menambah data absensi
        Route::post('/dashboard/absensi/create', [AbsentController::class, 'store'])->name('absent.store');
        //? Menampilkan form edit absensi
        Route::get('/dashboard/absensi/{absent:id}/edit', [AbsentController::class, 'edit'])->name('absent.edit');
        //? Fungsi untuk mengubah data absensi
        Route::post('/dashboard/absensi/{absent:id}/edit', [AbsentController::class, 'update'])->name('absent.update');
        //? Fungsi untuk mengambil data absensi
        Route::get('/dashboard/absensi/{absent:id}', [AbsentController::class, 'show'])->name('absent.show');
        //? Fungsi untuk menghapus data absensi
        Route::post('/dashboard/absensi/{absent:id}/delete', [AbsentController::class, 'destroy'])->name('absent.destroy');
        //? Menampilkan data kehadiran absensi
        Route::get('/dashboard/absensi/{absent:id}/siswa', [AbsentController::class, 'student'])->name('absent.student');
        //? Menampilkan bukti izin tidak hadir siswa
        Route::get('/dashboard/absensi/{presence:id}/bukti', [AbsentController::class, 'proof'])->name('absent.proof');

        //! End Absensi
    });

    Route::middleware('student')->group(function () {
        //! Absensi untuk siswa

        //? Fungsi untuk mengisi 'hadir' siswa
        Route::post('/dashboard/absensi/{absent:id}/hadir', [AbsentController::class, 'present'])->name('absent.present');
        //? Fungsi untuk mengisi 'pulang' siswa
        Route::post('/dashboard/absensi/{absent:id}/pulang', [AbsentController::class, 'goHome'])->name('absent.goHome');
        //? Menampilkan form izin tidak hadir siswa
        Route::get('/dashboard/absensi/{absent:id}/izin', [AbsentController::class, 'permission'])->name('absent.permission');
        //? Fungsi untuk menyimpan data izin tidak hadir siswa
        Route::post('/dashboard/absensi/{absent:id}/izin', [AbsentController::class, 'attendance'])->name('absent.attendance');

        //! End absensi untuk siswa
    });
});
