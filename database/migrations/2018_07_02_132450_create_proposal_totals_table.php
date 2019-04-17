<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalTotalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposal_totals', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('proposal_id');

            $table->string('product');
            $table->integer('term');
            $table->integer('upfront');
            $table->integer('monthly');

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
        Schema::dropIfExists('proposal_totals');
    }
}
