<?php 

namespace App\Http\Controllers;

use App\Models\Tanggapan;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class TanggapanController extends Controller
{
    // public function index() {
    //     return view('admin.tanggapan');
    // }

    // public function store(Request $request) {
    //     Tanggapan::create ([
    //         'nama_petugas' => request('nama_petugas'), 'required',
    //         'username' => request('username'), 'required',
    //         'password' => Hash::make($request->password), 'requied',
    //         'telp' => request('telp'), 'required',
    //     ]);
    //     return redirect()->back()->with('sucsess');
    // }
    // public function tanggapan() {
    //     $data = Tanggapan::all();
    //     return view('admin.history_tanggapan', compact('data'));
    // }
    public function index()
    {
        $datas = Pengaduan::get();
        return view('admin.layout.index', compact('datas'));
    }

    public function create($id_pengaduan)
    {
        $item = Pengaduan::findOrFail($id_pengaduan);
        return view('admin.tanggapan', compact('item'));
    }

    public function store(Request $request, $id_pengaduan)
    {
        $validate = $request->all();
        $validate = $request->validate([
            'tgl_tanggapan' => 'required',
            'tanggapan' => 'required',
        ]);

        $validate['id_petugas'] = Auth::guard('petugas')->user()->id;
        $validate['id_pengaduan'] = $request->id_pengaduan;
        Tanggapan::create($validate);

        $data = Pengaduan::findOrFail($id_pengaduan);
        $pengaduan['status'] = 'selesai';
        $data->update($pengaduan);

        return redirect()->route('tanggapan');
    }

    public function update($id)
    {
        $data = Pengaduan::findOrFail($id);
        if ($data->status == 'belumproses') {
            $status = 'proses';
        } else {
            $status = 'proses';
        }

        $data = Pengaduan::where('id_pengaduan', $id)->update(['status' => $status]);
        return redirect()->route('tanggapan');
    }

    public function show($id_pengaduan)
    {
        $data = Pengaduan::with('tanggapan')->where('id_pengaduan', $id_pengaduan)->get();
        return view('admin.tanggapan.index', compact('data'));
    }

    public function pdf($id_pengaduan)
    {
        $data = Pengaduan::with('tanggapan')->where('id_pengaduan', $id_pengaduan)->get();
        // dd($data);
        $pdf = pdf::loadView('admin.tanggapan.cetak-pdf', compact('data'))->setOptions(['enable_php', true, 'dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->download('PengaduanMasyarakat.pdf');
    }
}
