<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bukti extends Model
{
    use HasFactory;
    protected $table = 'bukti';
    protected $primaryKey = 'id_bukti';
    public $timestamps = true;
    protected $fillable = [
        'bukti_pembayaran',
        'nama',
        'email',
        
    ];
}
