<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;

class PetugasController extends Controller
{
    public function admin() {
        return view('admin.layout.index');
    }

    public function Petugas() {
        return view('admin.petugas.layout.index');
    }

    public function pengaduan() {
        $datas = Pengaduan::get();
        return view('admin.layout.index', compact('datas'));
    }
}
