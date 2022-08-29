<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('decks', function (Blueprint $table) {
            $table->float('hard_interval_factor')->default(1.5);
            $table->float('normal_interval_factor')->default(2);
            $table->float('easy_interval_factor')->default(2.5);
        });

        Schema::table('cards', function (Blueprint $table) {
            $table->float('last_interval')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('decks', function (Blueprint $table) {
            $table->dropColumn(['hard_interval_factor', 'normal_interval_factor', 'easy_interval_factor']);
        });

        Schema::table('cards', function (Blueprint $table) {
            $table->dropColumn('last_interval');
        });
    }
};
