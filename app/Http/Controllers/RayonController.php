<?php

namespace App\Http\Controllers;

use App\Models\Rayon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RayonController extends Controller
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
        return view('dashboard.rayon.index', [
            'data' => Rayon::orderBy('name')->paginate($this->limitData),
        ])->with('i', paginationNumber($this->limitData));
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
            'name' => 'required|unique:rayons'
        ]);

        Rayon::create($request->all());

        return redirect('/dashboard/rayon')->with('success', 'Berhasil Menambah Data Baru!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rayon  $rayon
     * @return \Illuminate\Http\Response
     */
    public function show(Rayon $rayon)
    {
        return [$rayon, 'count' => $rayon->user->count()];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rayon  $rayon
     * @return \Illuminate\Http\Response
     */
    public function edit(Rayon $rayon)
    {
        return $rayon;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rayon  $rayon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rayon $rayon)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:rayons'
        ]);

        if ($validator->fails()) {
            return redirect('/dashboard/rayon')
                ->withErrors($validator)
                ->withInput()
                ->with('status', $rayon);
        }

        $rayon->update($request->all());

        return redirect('/dashboard/rayon')->with('success', 'Berhasil Mengubah Data!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rayon  $rayon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rayon $rayon)
    {
        $rayon->delete();

        return redirect('/dashboard/rayon')->with('success', 'Berhasil Menghapus Data!!!');
    }

    public function students(Rayon $rayon)
    {
        return view('dashboard.rayon.students', [
            'data' => User::where('rayon_id', $rayon->id)->where('role', 'Siswa')->paginate($this->limitData),
            'rayon' => $rayon
        ])->with('i', paginationNumber($this->limitData));
    }
}
