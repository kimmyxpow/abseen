<?php

namespace App\Http\Controllers;

use App\Models\Absent;
use App\Models\Presence;
use App\Models\Rayon;
use App\Models\Rombel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class AbsentController extends Controller
{
    protected $limitData = 8;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        switch ($request->create) {
                //? Menampilkan halaman untuk membuat absensi rombel
            case 'rombel':
                return view('dashboard.absensi.create', [
                    'create' => $request->create,
                    'data' => Rombel::orderBy('name')->get(),
                ]);
                break;

                //? Menampilkan halaman untuk membuat absensi rayon
            case 'rayon':
                return view('dashboard.absensi.create', [
                    'create' => $request->create,
                    'data' => Rayon::orderBy('name')->get(),
                ]);
                break;

                //? Menampilkan halaman index rayon
            default:
                return view('dashboard.absensi.index', [
                    'data' => Absent::latest()->paginate($this->limitData)
                ])->with('i', paginationNumber($this->limitData));
                break;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //? Rules untuk validasi input
        $rules = [
            'name' => ['required', 'string']
        ];

        //? Tambah rules validasi untuk rombel jika absensi yang di create adalah rombel
        if (!isset($request->rayon))  $rules['rombel'] = ['required'];

        //? Tambah rules validasi untuk rayon jika absensi yang di create adalah rayon
        if (!isset($request->rombel)) $rules['rayon'] = ['required'];

        //? Validasi input
        $validatedData = $request->validate($rules);

        //? Cek jika yang dipilih adalah rombel
        if (is_null($request->rayon)) {
            $validatedData['rombel_id'] = intval($request->rombel);
            unset($validatedData['rombel']);
            $siswa = User::where('rombel_id', $validatedData['rombel_id'])->get();
        }

        //? Cek jika yang dipilih adalah rayon
        if (is_null($request->rombel)) {
            $validatedData['rayon_id'] = intval($request->rayon);
            unset($validatedData['rayon']);
            $siswa = User::where('rayon_id', $validatedData['rayon_id'])->get();
        }

        //? Set field user_id
        $validatedData['user_id'] = Auth::id();
        //? Set field date
        $validatedData['date'] = date('Y-m-d');
        //? Set field hash
        $validatedData['hash'] = md5(bcrypt(time() . $validatedData['user_id'] . $validatedData['date'] . $validatedData['name'] . uniqid()));

        //? Memasukkan data ke database
        Absent::create($validatedData);

        //? Ambil data absensi yang baru saja di insert tadi
        $absent = Absent::firstWhere('hash', $validatedData['hash']);

        //? Loop data siswa yang telah di ambil saat pengecekkan pilihan rombel/rayon
        foreach ($siswa as $row) {
            //? Set semua siswa pada rombel/rayon yang dipilih ke absensi yang telah dibuat
            Presence::create([
                'absent_id' => $absent->id,
                'user_id' => $row->id,
            ]);
        }

        //? Kembalikan ke halaman index absensi dengan session success
        return redirect('/dashboard/absensi')->with('success', 'Berhasil Menambah Data Baru!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function show(Absent $absent)
    {
        //? Mengembalikan nilai absensi dari fetch API yang akan digunakan di halaman absensi index
        return $absent;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function edit(Absent $absent)
    {
        //? Pengecekkan gate
        if (!Gate::allows('update-absensi', $absent)) {
            //? Set not autorize/forbiden jika tidak lolos gate
            abort(403);
        }

        //? Tampilkan halaman edit absensi juga lolos gate
        return view('dashboard.absensi.edit', [
            'data' => $absent
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absent $absent)
    {
        //? Pengecekkan gate
        if (!Gate::allows('update-absensi', $absent)) {
            //? Set not autorize/forbiden jika tidak lolos gate
            abort(403);
        }

        //? Validasi input
        $request->validate([
            'name' => ['required', 'string']
        ]);

        //? Update data di database
        $absent->update($request->all());

        //? Kembalikan ke halaman index absensi dengan session success
        return redirect('/dashboard/absensi')->with('success', 'Berhasil Mengedit Data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absent $absent)
    {
        //? Hapus data di database
        $absent->delete();

        //? Kembalikan ke halaman index absensi dengan session success
        return redirect('/dashboard/absensi')->with('success', 'Berhasil Menghapus Data!');
    }

    public function present(Absent $absent)
    {
        //? Update nilai di database menjadi hadir
        Presence::where('absent_id', $absent->id)->where('user_id', Auth::id())->update([
            'absen' => date('H:i'),
            'is_present' => true,
            'present' => 'Hadir'
        ]);

        //? Kembalikan ke halaman dashboard absensi dengan session success
        return redirect('/dashboard')->with('success', 'Berhasil Absen Hadir!');
    }

    public function goHome(Absent $absent)
    {
        //? Update nilai kepulangan siswa di database
        Presence::where('user_id', Auth::id())->where('absent_id', $absent->id)->update([
            'pulang' => date('H:i')
        ]);

        //? Kembalikan ke halaman dashboard absensi dengan session success
        return redirect('/dashboard')->with('success', 'Berhasil Absen Pulang!');
    }

    public function student(Absent $absent)
    {
        //? Menampilkan halaman kehadiran absensi siswa
        return view('dashboard.absensi.students', [
            'data' => $absent,
            'siswa' => DB::table('presences')
                ->select('presences.*', 'users.*', 'rombels.name AS rombel', 'rayons.name AS rayon', 'presences.id AS presence_id')
                ->join('users', 'users.id', '=', 'presences.user_id')
                ->join('absents', 'absents.id', '=', 'presences.absent_id')
                ->join('rombels', 'rombels.id', '=', 'users.rombel_id')
                ->join('rayons', 'rayons.id', '=', 'users.rayon_id')
                ->where('absents.id', '=', $absent->id)
                ->where(
                    fn ($query) =>
                    is_null($absent->rombel_id) ?
                        $query->where('users.rayon_id', '=', $absent->rayon_id) :
                        $query->where('users.rombel_id', '=', $absent->rombel_id)
                )
                ->orderBy('name')
                ->get()
        ])->with('i', paginationNumber());
    }

    public function permission(Absent $absent)
    {
        //? Menampilkan form untuk memberi keterangan izin tidak masuk
        return view('dashboard.absensi.permission', [
            'data' => $absent
        ]);
    }

    public function attendance(Request $request, Absent $absent)
    {
        //? Validasi input
        $validatedData = $request->validate([
            'present' => ['required', Rule::in(['Sakit', 'Izin'])],
            'description' => ['required'],
            'proof' => ['required', 'file', 'image', 'max:2048']
        ]);

        //? Set field absent_id
        $validatedData['absent_id'] = $absent->id;
        //? Set field user_id
        $validatedData['user_id'] = Auth::id();
        //? Set field kehadiaran
        $validatedData['is_present'] = false;
        //? Set field waktu absensi
        $validatedData['absen'] = date('H:i');
        //? Set field bukti izin
        $validatedData['proof'] = '/' . $request->file('proof')->store('img/bukti-izin');

        //? Update data ke database
        Presence::where('user_id', Auth::id())->where('absent_id', $absent->id)->update($validatedData);

        //? Kembalikan ke halaman dashboard absensi dengan session success
        return redirect('/dashboard')->with('success', 'Data Berhasil Tersimpan!');
    }

    public function proof(Presence $presence)
    {
        //? Mengembalikan nilai bukti absensi dari fetch API yang akan digunakan di halaman absensi index
        return $presence;
    }
}
