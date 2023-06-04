<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('hash')->unique();
            $table->timestamp('used_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->foreignId('post_id')->constrained()->onUpdate('cascade');
            $table->foreignId('assistant_id')->constrained()->onUpdate('cascade');
            $table->foreignId('ticket_type_id')->constrained()->onUpdate('cascade');
            $table->foreignId('voucher_id')->constrained()->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
