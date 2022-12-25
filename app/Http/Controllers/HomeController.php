<?php

namespace App\Http\Controllers;

use App\Models\Admin\Armada;
use App\Models\Admin\Transaksi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->type;
        $data = Armada::query()
            ->when($type, function ($query) use ($type) {
                $query->where('type', $type);
            })->get();
        return view('home.index', compact('type', 'data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'armada_id' => 'required|numeric',
            'total' => 'required|numeric',
            'identitas' => 'required|numeric|min:16',
            'handphone' => 'required|numeric',
            'jadwal' => 'required',
            'normal' => 'required|numeric|min:1',
            // 'lansia' => 'numeric'
        ]);

        $armada = Armada::find($request->armada_id);
        if (empty($armada)) {
            # code...
            return redirect()->route('index')->with('galat', 'Armada Bus Tidak Tersedia');
        }

        $data = Transaksi::create([
            'armada_id' => $armada->id,
            'nama' => $request->nama,
            'ktp' => $request->identitas,
            'normal' => $request->normal,
            'lansia' => $request->lansia,
            'harga' => $request->total,
            'handphone' => $request->handphone,
            'jadwal' => $request->jadwal
        ]);


        return view('home.success', compact('armada', 'data'));
    }
}
