<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    use HasFactory;
    public $table = 'KHACHHANG';
    public $primaryKey = 'KHACHHANG_ID';
    public $timestamps = false;

    public function history()
    {
        return $this->hasMany(History::class, 'NGUOIDUNG_ID');
    }
}
