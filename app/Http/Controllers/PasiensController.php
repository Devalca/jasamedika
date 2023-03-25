<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\Pasien;
use App\Tables\Pasiens;
use Illuminate\Support\Carbon;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Http\Request;

class PasiensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pasien.index', [
            'pasiens' => Pasiens::class
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jk = [
            'laki-laki' => 'Laki-Laki',
            'perempuan' => 'Perempuan',
        ];
        return view('pasien.create', [
            'kelurahan_id' => Kelurahan::pluck('kelurahan', 'id'),
            'jenis_kelamin' => $jk
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
        $data = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'rt_rw' => 'required',
            'nomor' => 'required',
            'kelurahan_id' => 'required',
            'ttl' => 'required',
            'jenis_kelamin' => 'required',
        ]);

        $cek_id = Pasien::orderBy('id', 'DESC')->first();
        $currentDate = Carbon::now()->format('ym');
        $val = $cek_id == null ? 1 : $cek_id->id; 
        $code = str_pad($val + 1,6,"0",STR_PAD_LEFT);

        $data['pasien_id'] = $currentDate.$code;

        Pasien::create($data);

        Toast::title('Success add Pasien!')->success()->backdrop();

        return redirect()->route('pasien.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function show(Pasien $pasien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function edit(Pasien $pasien)
    {
        $jk = [
            'laki-laki' => 'Laki-Laki',
            'perempuan' => 'Perempuan',
        ];
        return view('pasien.edit', [
            'pasien' => $pasien,
            'jenis_kelamin' => $jk,
            'kelurahan_id' => Kelurahan::pluck('kelurahan', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pasien $pasien)
    {
        $data = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'rt_rw' => 'required',
            'nomor' => 'required',
            'kelurahan_id' => 'required',
            'ttl' => 'required',
            'jenis_kelamin' => 'required',
        ]);

        $pasien->update($data);

        Toast::title('Success update Pasien!')->success()->backdrop();

        return redirect()->route('pasien.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pasien $pasien)
    {
        $pasien->delete();
        Toast::title('Success delete Pasien!')->success()->backdrop();
        return redirect()->route('pasien.index');
    }
}
