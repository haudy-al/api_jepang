<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalUjianModel extends Model
{
    use HasFactory;

    protected $table = 'soal_ujian';

    protected $fillable = [
        'ujian_id',
        'type',
        'question',
        'choices',
        'correct_answer',
        'audio_url',
        'image_url'
    ];

    protected $casts = [
        'choices' => 'array'
    ];

    public function ujian()
    {
        return $this->belongsTo(UjianModel::class);
    }
}
