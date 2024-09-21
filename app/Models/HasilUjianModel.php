<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilUjianModel extends Model
{
    use HasFactory;

    protected $table = 'hasil_ujian';

    protected $guarded = [];

    public function ujian()
    {
        return $this->belongsTo(UjianModel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
