<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Vote::class, 2000)->create()->each(function($vote) {
            while(true){
                $user = rand(1,50);
                $rand = rand(0,1);
                if ($rand) $voteable = rand(1,500);
                else $voteable = rand(1,2000);

                $row = DB::table('votes')->where('user_id', $user)->where('voteable_id', $voteable)->first();
                if(!$row) {
                    break;
                }
            }
            $vote->user()->associate($user)->save();

            if($rand) $model = App\Post::find($voteable);
            else $model = App\Comment::find($voteable);

            $vote->voteable()->associate($model)->save();
        });
    }
}
