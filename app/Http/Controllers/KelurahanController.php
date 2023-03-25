<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\Pasien;
use App\Tables\Kelurahans;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;

class KelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kelurahan.index', [
            'kelurahans' => Kelurahans::class,   
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kelurahan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kota' => 'required',
        ]);

        Kelurahan::create($data);

        Toast::title('Success add Kelurahan!')->success()->backdrop();

        return redirect()->route('kelurahan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function show(Kelurahan $kelurahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelurahan $kelurahan)
    {
        return view('kelurahan.edit', [
            'kelurahan' => $kelurahan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelurahan $kelurahan)
    {
        $data = $request->validate([
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kota' => 'required',
        ]);

        $kelurahan->update($data);

        Toast::title('Success update Kelurahan!')->success()->backdrop();

        return redirect()->route('kelurahan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelurahan $kelurahan)
    {
        $cek_pasien = Pasien::where('kelurahan_id', $kelurahan->id)->first();
        if($cek_pasien != null) {
            Toast::title('Kelurahan is still in use!')->danger()->backdrop();
        } else {
            $kelurahan->delete();
            Toast::title('Success delete kelurahan!')->success()->backdrop();
        }
        return redirect()->route('kelurahan.index');
    }
}
