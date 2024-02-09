<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $table = 'reservasi';
    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'id_kegiatan',
        'id_kategori_anggota',
        'id_paket',
        'kode_kupon',
        'potongan_harga',
        'harga_paket',
    ];

    public function paket() {
        return $this->belongsTo('App\Paket', 'id_paket');
    }

    public function kupon() {
        return $this->belongsTo('App\Kupon', 'kode_kupon', 'kode_kupon');
    }
}
