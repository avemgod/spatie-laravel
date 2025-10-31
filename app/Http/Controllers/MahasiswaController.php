<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class MahasiswaController extends Controller
{
    public function index()
    {
        $user = auth::user();

        // pastikan paket_id ada
        if (!$user->paket_id) {
            return view('mahasiswa.dashboard', [
                'jadwals' => [],
                'message' => 'Kamu belum memilih paket.',
            ]);
        }
        if (!$user->paket_id && $user->role !== 'admin') {
            return back()->with('error', 'Kamu belum memilih paket.');
        }
        
        // ambil jadwal sesuai paket
        $jadwals = Jadwal::with(['mataKuliah', 'paket'])
            ->where('paket_id', $user->paket_id)
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get();

        return view('mahasiswa.dashboard', compact('jadwals'));
    }
}
