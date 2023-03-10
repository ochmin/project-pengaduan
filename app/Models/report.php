<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Response;

class report extends Model
{
    use HasFactory;
    protected $fillable = [
'nik',
'nama',
'no_telp',
'pengaduan',
'foto',
    ];
// hasone : one to one
// table berperan sebagai pk
// nama fungsi == nama model fk

    public function response()
    {
        return $this->hasOne
        (Response::class);
    }
}
