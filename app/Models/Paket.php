<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{

    protected $guarded = [];

    public function users()
{
    return $this->hasMany(User::class);
}

public function jadwals()
{
    return $this->hasMany(Jadwal::class);
}

}
