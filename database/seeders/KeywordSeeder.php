<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KeywordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $keywords = [];

        for ($i = 1; $i <= 30; $i++) {
            $keywords[] = [
                'title' => 'کلیدواژه ' . $i,
                'title_en' => 'keyword_' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('keywords')->insert($keywords);
    }
}

