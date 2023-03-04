<?php

namespace Database\Seeders;

use App\Models\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RemoveDuplicateHashesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hash::where(function ($q_where) {
            $q_where->whereNull('email')->orWhere('email', "");
        })->delete();

        $emails = Hash::select('email')
            ->groupBy('email')
            ->havingRaw('COUNT(email) > 1')
            ->get()
            ->pluck('email');

        foreach($emails as $email) {
            $hashes = Hash::where('email', $email)->get();
            for($i = 1; $i < count($hashes); $i++) {
                $hashes[$i]->delete();
            }
        }
    }
}
