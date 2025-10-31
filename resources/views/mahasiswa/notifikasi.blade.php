@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">📬 Kotak Notifikasi</h3>

    <h5>Belum Dibaca</h5>
    @forelse($notifikasiBelumDibaca as $notif)
        <div class="alert alert-warning d-flex justify-content-between align-items-center">
            <div>
                <strong>{{ $notif->data['judul'] }}</strong><br>
                {{ $notif->data['pesan'] }}
                <small class="text-muted d-block">Hari: {{ $notif->data['hari'] }}</small>
            </div>
            <form method="POST" action="{{ route('notifikasi.baca', $notif->id) }}">
                @csrf
                <button class="btn btn-sm btn-success">Tandai Dibaca</button>
            </form>
        </div>
    @empty
        <p class="text-muted">Tidak ada notifikasi baru.</p>
    @endforelse

    <hr>

    <h5>Sudah Dibaca</h5>
    @forelse($notifikasiSudahDibaca as $notif)
        <div class="alert alert-secondary">
            <strong>{{ $notif->data['judul'] }}</strong><br>
            {{ $notif->data['pesan'] }}
            <small class="text-muted d-block">Hari: {{ $notif->data['hari'] }}</small>
        </div>
    @empty
        <p class="text-muted">Belum ada notifikasi yang dibaca.</p>
    @endforelse
</div>
@endsection
