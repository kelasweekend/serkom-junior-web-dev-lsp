<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Armada;
use Illuminate\Http\Request;

class ArmadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        # membuat variabel untuk menampung data armada
        $search = $request->cari;
        $type = $request->status;
        $data = Armada::query()
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->when($type, function ($query) use ($type) {
                $query->where('type', $type);
            })
            ->get();

        # mengembalikan ke dalam template dengan membawa variabel
        return view('admin.armada.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        # membuat template create armada
        return view('admin.armada.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validasi request dari form 
        $request->validate([
            'title' => 'required',
            'harga' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,png,jpeg',
            'type' => 'required',
        ], [
            'title.required' => 'Wajib di isi',
            'harga.required' => 'Wajib di isi',
            'harga.numeric' => 'Harga Wajib Angka',
            'image.required' => 'Wajib di isi',
            'image.image' => 'Wajib berupa image',
            'image.mimes' => 'Gambar Hanya JPG dan PNG',
            'image.size' => 'Size Gambar Hanya Max 2 MB',
            'type.required' => 'Wajib di isi',
        ]);

        # membuat variabel baru untuk penamaan file image kita menggunakan time() agar unique tidak sama dengan gambar lain
        $imageName = time() . '.' . $request->image->extension();

        # gunakan query untuk update data baru kedalam database dengan memanggil model armada

        # awal query
        Armada::create([
            'title' => $request->title,
            'harga' => $request->harga,
            'type' => $request->type,
            'image' => $imageName
        ]);
        # akhir query

        # menentukan folder mana yang akan menyimpan gambar hasil upload kita
        $request->image->move(public_path('fe/img/'), $imageName);
        # kita akan menyimpan gambar pada folder public/storage/img/namafile.png

        // balikan ke halaman list armada
        return redirect()->route('armada.index')->with('success', 'Armada Berhasil di tambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        # membuat variabel untuk menampung data armada dari where by Id
        $data = Armada::find($id);

        # gunakan if kondisi jika data diatas kosong atau ID tidak sesuai pada database
        if (empty($data)) {
            # jika data kosong empty() maka 
            return redirect()->route('armada.index')->with('galat', 'armada not found');
            # fungsi with() adalah untuk membawa notifikasi dengan session yang berupa pemberitahuan
        }

        # jika variabel data ada tidak kosong maka kita kembalikan kedalam view edit untuk mengubah data tersebut
        return view('admin.armada.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        # membuat variabel untuk cek apakah id tersebut ada atau tidak menggunakan find / where by id 
        $data = Armada::find($id);

        # membuat if satu kondisi dimana jika kosong data tersebut akan di kembalikan
        if (empty($data)) {
            # kembalikan ke halaman list armada dengan notifikasi with
            return redirect()->route('armada.index')->with('galat', 'armada not found');
        }

        # membuat validasi kembali dari request yang didapatkan dari form update
        $request->validate([
            'title' => 'required',
            'harga' => 'required|numeric',
            'image' => 'image|mimes:jpg,png,jpeg',
            'type' => 'required',
        ], [
            'title.required' => 'Wajib di isi',
            'harga.required' => 'Wajib di isi',
            'harga.numeric' => 'Harga Wajib Angka',
            'image.required' => 'Wajib di isi',
            'image.mimes' => 'Gambar Hanya JPG dan PNG',
            'image.size' => 'Size Gambar Hanya Max 2 MB',
            'status.required' => 'Wajib di isi',
        ]);

        # membuat if 2 kondisi dimana jika ada request pergantian thumbnail atau gambar maka
        if ($request->image) {
            # jika da request image / thumbnail maka system akan mengganti gambar tersebut

            # gunakan fitur unlink untuk menghapus gambar pada folder penyimpanan kita sesuai dengan nama file pada database
            unlink(public_path('fe/img/' . $data->image));

            # jika sudah berhasil menghapus maka kita buat persiapan untuk gambar baru

            # membuat variabel baru untuk penamaan file image kita menggunakan time() agar unique tidak sama dengan gambar lain
            $imageName = time() . '.' . $request->image->extension();

            # gunakan query untuk update data baru kedalam database dengan memanggil model armada

            # awal query
            $data->update([
                'title' => $request->title,
                'harga' => $request->harga,
                'type' => $request->type,
                'image' => $imageName
            ]);
            # akhir query

            # menentukan folder mana yang akan menyimpan gambar hasil upload kita
            $request->image->move(public_path('fe/img/'), $imageName);
            # kita akan menyimpan gambar pada folder public/fe/img/namafile.png

        } else {
            # jika tidak ada request image maka memanggil query update dengan model

            # awal query
            $data->update([
                'title' => $request->title,
                'harga' => $request->harga,
                'type' => $request->type,
            ]);
            # akhir query
        }

        # kembalikan hasil controller ini ke halaman list armada
        return redirect()->route('armada.index')->with('success', 'armada Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        # membuat variabel untuk cek apakah id tersebut ada atau tidak menggunakan find / where by id 
        $data = Armada::find($id);

        # membuat if satu kondisi dimana jika kosong data tersebut akan di kembalikan
        if (empty($data)) {
            # kembalikan ke halaman list armada dengan notifikasi with
            return redirect()->route('armada.index')->with('galat', 'armada not found');
        }

        # gunakan fitur unlink untuk menghapus gambar pada folder penyimpanan kita sesuai dengan nama file pada database
        unlink(public_path('fe/img/' . $data->image));

        # gunakan query delete orm untuk menghapus data pada tabel

        # awal query
        $data->delete();
        # akhir query

        # kembalikan hasil controller ini ke halaman list armada
        return redirect()->route('armada.index')->with('success', 'armada Berhasil di Hapus');
    }
}
