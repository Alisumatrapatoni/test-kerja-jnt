<?php

namespace Database\Seeders;

use App\Models\Cabang;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CabangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run():void
    {
        Cabang::create([
            'nama' => 'Pusat',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
