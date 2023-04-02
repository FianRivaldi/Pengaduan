<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use Illuminate\Http\Request;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    public function index() {
        return view('pengaduan');
    }

    public function histori()
    {
        $datas = Pengaduan::get();
        return view('histori', compact('datas'));
    }

    public function store(Request $request) {
        $validate = $request->all();
        $validate = $request->validate([
            'tgl_pengaduan' => 'required',
            'nik' => 'required',
            'isi_laporan' => 'required',
            'foto' => 'required'
        ]);
        if($request->file('foto')) {
            $validate['foto']->file('foto')->store('img_pengaduan');
        }
        Pengaduan::create($validate);
        return redirect()->back();

        // Pengaduan::create([
        //     'tgl_pengaduan',
        //     'nik',
        //     'isi_laporan',
        //     'foto'
        // ]);
        // return redirect()->back()->with('data berhasil terkirim');
    }

    public function pengaduan($id_pengaduan)
    {
        $data = Pengaduan::where('id_pengaduan', $id_pengaduan)->get();
        return view('pengaduan', compact('data'));
    }



    public function delete($id)
    {
	// menghapus data pegawai berdasarkan id yang dipilih
	Pengaduan::table('pengaduan')->where('id_pengaduan',$id)->delete();

	// alihkan halaman ke halaman pegawai
	return redirect()->back();
}
}
