<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasang extends Model
{
    use HasFactory;
    protected $fillable =['tiketing','teknisi_id','nama_pelanggan','jenis_koneksi','status','waktu_pasang','lokasi_pasang','keterangan'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($complaint) {
            $complaint->tiketing = self::generateNomorTiket();
        });
    }

    public static function generateNomorTiket()
    {
        $ambilhari = now()->format('Ymd'); // Format: YYYYMMDD
        $ambillasttiket = self::where('tiketing', 'like', "{$ambilhari}-%")
            ->orderBy('tiketing', 'desc')
            ->first();

        if ($ambillasttiket) {
            // Ambil angka terakhir dari format tiket
            $lastNumber = (int) substr($ambillasttiket->tiketing, -4);
        } else {
            $lastNumber = 0;
        }

        // Tambahkan 1 untuk nomor berikutnya
        $newNumber = $lastNumber + 1;

        // Format nomor baru dengan padding 4 digit
        $formattedNumber = str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        // Gabungkan ke format YYYYMMDD-XXXX
        return "{$ambilhari}-{$formattedNumber}";
    }

    public function teknisi()
    {
        return $this->belongsTo(Teknisi::class);
    }

}
