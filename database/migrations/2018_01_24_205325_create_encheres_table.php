<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncheresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encheres', function (Blueprint $table) {
            $table->unsignedInteger('acheteur_id');
            $table->unsignedInteger('good_id');
            $table->float('montant');
            $table->timestamp('date_enchere')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('acheteur_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('good_id')
                ->references('id')->on('goods')
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
        Schema::dropIfExists('encheres');
    }
}
