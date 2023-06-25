<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    public $table = 'HISTORY';
    public $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'ten_nd',
        'action',
        'model_type',
        'model_id',
        'description',
        'Time',
    ];

    public function user()
    {
        return $this->belongsTo(TaiKhoan::class, 'NGUOIDUNG_ID');
    }
}
