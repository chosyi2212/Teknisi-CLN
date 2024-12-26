<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teknisi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_teknisi',
        'no_telefon',
        'keahlian',
        'is_ada'
    ];

    public function complains()
    {
        return $this->hasMany(Pasang::class);
    }
    public function pembenahan()
    {
        return $this->hasMany(pembenahan::class);
    }

}
