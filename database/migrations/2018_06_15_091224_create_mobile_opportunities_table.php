<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobileOpportunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_opportunities', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');
            $table->integer('mobile_lead_id');

            $table->integer('status');
            $table->timestamp('status_updated_at');

            $table->timestamp('decision_date')->nullable();
            $table->integer('confidence_percent')->nullable()->default(0);
            $table->integer('number_of_connections')->nullable()->default(0);
            $table->integer('gp')->nullable()->default(0);
            $table->string('line_rental')->nullable()->default(0);
            $table->string('network')->nullable();

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
        Schema::dropIfExists('mobile_opportunities');
    }
}
