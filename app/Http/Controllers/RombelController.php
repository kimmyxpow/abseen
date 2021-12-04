<?php

namespace App\Http\Controllers;

use App\Models\Rombel;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RombelController extends Controller
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
        return view('dashboard.rombel.index', [
            'data' => Rombel::orderBy('name')->paginate($this->limitData),
        ])->with('i', (request()->input('page', 1) - 1) * $this->limitData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:rombels'
        ]);

        Rombel::create($request->all());

        return redirect('/dashboard/rombel')->with('success', 'Berhasil Menambah Data Baru!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rombel  $rombel
     * @return \Illuminate\Http\Response
     */
    public function show(Rombel $rombel)
    {
        return [$rombel, 'count' => $rombel->user->count()];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rombel  $rombel
     * @return \Illuminate\Http\Response
     */
    public function edit(Rombel $rombel)
    {
        return $rombel;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rombel  $rombel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rombel $rombel)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:rombels'
        ]);

        if ($validator->fails()) {
            return redirect('/dashboard/rombel')
                ->withErrors($validator)
                ->withInput()
                ->with('status', $rombel);
        }

        $rombel->update($request->all());

        return redirect('/dashboard/rombel')->with('success', 'Berhasil Mengubah Data!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rombel  $rombel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rombel $rombel)
    {
        $rombel->delete();

        return redirect('/dashboard/rombel')->with('success', 'Berhasil Menghapus Data!!!');
    }

    public function students(Rombel $rombel)
    {
        return view('dashboard.rombel.students', [
            'data' => User::where('rombel_id', $rombel->id)->where('role', 'Siswa')->paginate($this->limitData),
            'rombel' => $rombel
        ])->with('i', (request()->input('page', 1) - 1) * $this->limitData);
    }
}
