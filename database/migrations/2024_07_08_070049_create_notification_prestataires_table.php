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
        Schema::create('notification_prestataires', function (Blueprint $table) {
            $table->id();
            $table->integer('IdUser');
            $table->integer('IdElement');
            $table->text('element')->nullable();
            $table->integer('idPrestataire');
            $table->text('type')->nullable();
            $table->text('view')->nullable();
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
        Schema::dropIfExists('notification_prestataires');
    }
};
