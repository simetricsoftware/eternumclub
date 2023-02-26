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
            $table->dropForeign(['user_id']);
        });

        Schema::table('hashes', function (Blueprint $table) {
            $table->dropColumn('hash');
            $table->dropColumn('file');
            $table->dropColumn('user_id');
        });

        Schema::table('hashes', function (Blueprint $table) {
            $table->string('hash')->after('id')->nullable();
            $table->string('name')->after('hash');
            $table->string('email')->after('name');
            $table->string('phone')->after('email');
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
            $table->dropColumn('hash');
            $table->dropColumn('name');
            $table->dropColumn('email');
            $table->dropColumn('phone');
        });

        Schema::table('hashes', function (Blueprint $table) {
            $table->string('hash')->after('id');
            $table->string('file')->after('hash');
            $table->foreignId('user_id')->constrained();
        });
    }
};
