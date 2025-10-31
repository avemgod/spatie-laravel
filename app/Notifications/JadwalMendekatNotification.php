<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Jadwal;

class JadwalMendekatNotification extends Notification
{
    use Queueable;

    public $jadwal;

    public function __construct(Jadwal $jadwal)
    {
        $this->jadwal = $jadwal;
    }

    public function via($notifiable)
    {
        return ['database']; 
    }

    public function toDatabase($notifiable)
    {
        return [
            'judul' => 'Kelas akan dimulai!',
            'pesan' => "Mata kuliah {$this->jadwal->mataKuliah->nama_matkul} akan dimulai pada {$this->jadwal->jam_mulai}.",
            'hari' => $this->jadwal->hari,
        ];
    }
}
