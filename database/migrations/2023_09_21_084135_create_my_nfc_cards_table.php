<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyNfcCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_nfc_cards', function (Blueprint $table) {
            $table->id();
            $table->string("card_id")->nullable();
            $table->string("label")->nullable();
            $table->string("added_by")->nullable();//userId
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
        Schema::dropIfExists('my_nfc_cards');
    }
}
