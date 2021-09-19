<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeoToPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('keyword')->nullable();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug')->nullable();
            $table->dropColumn('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('keyword');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->text('description')->nullable();
        });
    }
}
