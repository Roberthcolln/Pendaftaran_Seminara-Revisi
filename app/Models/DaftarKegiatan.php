<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarKegiatan extends Model
{
    use HasFactory;
    protected $table = 'daftar_kegiatans';
    protected $primaryKey = 'id_daftar_kegiatan';
    public $timestamps = true;
    protected $fillable = [
        
        'id_kegiatan',
        'id',
        'id_kategori_anggota',
        'tanggal_kegiatan',
        'biaya_kegiatan',
        'kupon',
        'potongan_harga',
        'status',
        
    ];
   public function getTotalBiaya()
    {
        return $this->biaya_kegiatan - $this->potongan_harga;
    }
}
