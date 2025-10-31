@extends('layouts.app')


<li class="nav-item">
    <a class="nav-link" href="{{ route('notifikasi.index') }}">
        🔔 Notifikasi 
        @if(auth()->user()->unreadNotifications->count() > 0)
            <span class="badge bg-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
        @endif
    </a>
</li>

@section('content')
<div class="container">
    <h2 class="mb-4">Jadwal Kelas Kamu</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Paket</th>
                <th>Mata Kuliah</th>
                <th>Pengajar</th>
                <th>Hari</th>
                <th>Jam</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jadwals as $j)
                <tr>
                    <td>{{ $j->paket->nama_paket ?? '-' }}</td>
                    <td>{{ $j->mataKuliah->nama_matkul ?? '-' }}</td>
                    <td>{{ $j->mataKuliah->pengajar ?? '-' }}</td>
                    <td>{{ $j->hari }}</td>
                    <td>{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Belum ada jadwal.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
</div>
@endsection
