<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPostToSchedulersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedulers', function (Blueprint $table) {
            $table->foreignId('post_id')
                ->constrained()
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('schedulers', 'post_id')) {
            Schema::table('schedulers', function (Blueprint $table) {
                $table->dropColumn('post_id');
            });
        }
    }
}
