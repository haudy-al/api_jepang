<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('soal_ujian')->insert([
            [
                'ujian_id' => 1,
                'type' => 'text',
                'question' => 'Apa hiragana yang benar untuk suku kata "ka"?',
                'choices' => json_encode(['か', 'こ', 'き', 'け']),
                'correct_answer' => 'か',
            ],

        ]);

        DB::table('soal_ujian')->insert([
            [
                'ujian_id' => 1,
                'type' => 'text',
                'question' => 'Apa hiragana yang benar untuk suku kata "ko"?',
                'choices' => json_encode(['か', 'こ', 'き', 'け']),
                'correct_answer' => 'こ',
            ],

        ]);
    }
}
