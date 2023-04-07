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
        Schema::create('to__do__list__group', function (Blueprint $table) {
            $table->id();
            $table->timestamp('End_Date')->nullable();
            $table->bigInteger('ID_Group');
            $table->string('descriptions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('to__do__list__group');
    }
};
