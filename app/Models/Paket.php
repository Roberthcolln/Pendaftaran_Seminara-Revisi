<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $table = 'paket';
    protected $primaryKey = 'id_paket';

    protected $fillable = [
        'nama_paket',
        'harga_paket',
        'deskripsi_paket',
    ];

    public function reservasi() {
        return $this->hasMany('App\Reservasi', 'id_paket');
    }
}