<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalAirtimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposal_airtimes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('proposal_id');

            $table->string('tariff');
            $table->string('minutes');
            $table->string('texts');
            $table->string('data');
            $table->integer('term');
            $table->integer('quantity');
            $table->integer('price');

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
        Schema::dropIfExists('proposal_airtimes');
    }
}
