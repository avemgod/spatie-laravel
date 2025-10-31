<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $guarded = [];

    public function paket()
{
    return $this->belongsTo(Paket::class);
}

public function mataKuliah()
{
    return $this->belongsTo(MataKuliah::class);
}

}
