<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kupon extends Model
{
    use HasFactory;

    protected $table = 'kupon';
    protected $primaryKey = 'id_kupon';

    protected $fillable = [
        'id_paket',
        'kode_kupon',
        'potongan_harga',
    ];

    public function paket() {
        return $this->belongsTo('App\Paket', 'id_paket');
    }
}