<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HopDong extends Model
{
    use HasFactory;
    public $table = 'HOPDONG';
    public $primaryKey = 'HOPDONG_ID';
    public $timestamps = false;
}
