<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Jadwal;
use App\Models\User;
use App\Notifications\JadwalMendekatNotification;
use Carbon\Carbon;

class CekJadwalCommand extends Command
{
    protected $signature = 'jadwal:cek';
    protected $description = 'Cek jadwal kuliah dan kirim notifikasi ke mahasiswa jika kelas akan dimulai 1 jam lagi.';

    public function handle()
    {
        $now = Carbon::now();
        $today = strtolower($now->format('l')); // contoh: monday, tuesday, dll

        $jadwals = Jadwal::with(['paket', 'mataKuliah'])
            ->where('hari', ucfirst($today))
            ->get();

        foreach ($jadwals as $jadwal) {
            $jamMulai = Carbon::parse($jadwal->jam_mulai);
            $selisihMenit = $now->diffInMinutes($jamMulai, false);

            if ($selisihMenit === 60) { // 1 jam sebelum mulai
                $mahasiswas = User::where('paket_id', $jadwal->paket_id)->get();
                foreach ($mahasiswas as $mhs) {
                    $mhs->notify(new JadwalMendekatNotification($jadwal));
                }
                $this->info("Notifikasi dikirim untuk jadwal {$jadwal->mataKuliah->nama_matkul}");
            }
        }

        return Command::SUCCESS;
    }
}
