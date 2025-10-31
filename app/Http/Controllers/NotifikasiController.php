<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $notifikasiBelumDibaca = $user->unreadNotifications;
        $notifikasiSudahDibaca = $user->readNotifications;

        return view('mahasiswa.notifikasi', compact('notifikasiBelumDibaca', 'notifikasiSudahDibaca'));
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->find($id);
        if ($notification) {
            $notification->markAsRead();
        }

        return back()->with('success', 'Notifikasi ditandai sebagai dibaca.');
    }
}
