<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class TaiKhoan extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;
    public $timestamps = false;
    public $table = 'TAIKHOAN';
    public $primaryKey = 'NGUOIDUNG_ID';

        /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
