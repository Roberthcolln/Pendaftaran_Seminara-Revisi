<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id_order';
    protected $fillable = [
        'nama',
        'no_tlp',
        'total_harga',
        'status',
    ];
}
