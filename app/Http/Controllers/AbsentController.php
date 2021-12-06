<?php

namespace App\Http\Controllers;

use App\Models\Absent;
use App\Models\Presence;
use App\Models\Rayon;
use App\Models\Rombel;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            case 'rombel':
                return view('dashboard.absensi.create', [
                    'create' => $request->create,
                    'data' => Rombel::orderBy('name')->get(),
                ]);
                break;

            case 'rayon':
                return view('dashboard.absensi.create', [
                    'create' => $request->create,
                    'data' => Rayon::orderBy('name')->get(),
                ]);
                break;

            default:
                return view('dashboard.absensi.index', [
                    'data' => Absent::latest()->paginate($this->limitData)
                ])->with('i', (request()->input('page', 1) - 1) * $this->limitData);
                break;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'string']
        ];

        if (!isset($request->rayon))  $rules['rombel'] = ['required'];

        if (!isset($request->rombel)) $rules['rayon'] = ['required'];

        $validatedData = $request->validate($rules);

        if (is_null($request->rayon)) {
            $validatedData['rombel_id'] = intval($request->rombel);
            unset($validatedData['rombel']);
        }

        if (is_null($request->rombel)) {
            $validatedData['rayon_id'] = intval($request->rayon);
            unset($validatedData['rayon']);
        }

        $validatedData['user_id'] = Auth::id();

        Absent::create($validatedData);

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
        $request->validate([
            'name' => ['required', 'string']
        ]);
        
        $absent->update($request->all());

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
        $absent->delete();

        return redirect('/dashboard/absensi')->with('success', 'Berhasil Menghapus Data!');
    }

    public function present(Absent $absent)
    {
        $datang = date('H:i');
        $absentId = $absent->id;
        $userId = Auth::id();

        Presence::create([
            'absent_id' => $absentId,
            'user_id' => $userId,
            'datang' => $datang,
            'is_present' => true,
            'present' => 'Hadir'
        ]);

        return redirect('/dashboard')->with('success', 'Berhasil Absen Hadir!');
    }

    public function goHome(Absent $absent)
    {
        $pulang = date('H:i');

        Presence::where('user_id', Auth::id())->where('absent_id', $absent->id)->update([
            'pulang' => $pulang
        ]);

        return redirect('/dashboard')->with('success', 'Berhasil Absen Pulang!');
    }

    public function student(Absent $absent)
    {
        return view('dashboard.absensi.students', [
            'data' => $absent,
            'siswa' => Presence::where('absent_id', $absent->id)->get()
        ])->with('i', 0);
    }
}
