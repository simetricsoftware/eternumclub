<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('voteable_id')->nullable();
            $table->string('voteable_type')->nullable();
            $table->enum('vote_type', ['like', 'dislike']);
            $table->foreignId('user_id')->nullable()->constrained()->onUpdate('cascade');
            $table->timestamps();

            $table->unique(['user_id', 'voteable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes');
    }
}
