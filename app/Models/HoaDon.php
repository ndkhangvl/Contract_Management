<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    use HasFactory;
    public $table = 'HOADON';
    public $primaryKey = 'HOADON_ID';
    public $timestamps = false;
}
