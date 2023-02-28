<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hashes', function (Blueprint $table) {
            $table->string('instagram')->after('voucher')->nullable();
            $table->enum('sex', [ 'M', 'F' ])->after('instagram')->nullable();
            $table->boolean('is-ready')->after('sex')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hashes', function (Blueprint $table) {
            $table->dropColumn('instagram');
            $table->dropColumn('sex');
            $table->dropColumn('is-ready');
        });
    }
};
