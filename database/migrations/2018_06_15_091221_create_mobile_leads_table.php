<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobileLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_leads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status')->default(0);
            $table->timestamp('status_updated_at')->default(Carbon::now());

            $table->integer('user_id')->nullable();

            $table->string('existing_networks')->nullable();
            $table->integer('number_of_handsets')->nullable();
            $table->string('tablets_or_sim_devices')->nullable();
            $table->string('handsets_working')->nullable();
            $table->string('network_or_third_party')->nullable();
            $table->string('customer_service_satisfaction')->nullable();
            $table->string('customer_service_improvement')->nullable();
            $table->text('customer_service_improvement_detail')->nullable();
            $table->string('signal_and_service')->nullable();
            $table->integer('monthly_bill')->nullable();
            $table->string('bill_fluctuation')->nullable();
            $table->string('bill_format')->nullable();
            $table->string('receives_bill_analysis')->nullable();
            $table->string('overseas_calls')->nullable();
            $table->timestamp('contract_end_date')->nullable();
            $table->string('add_numbers_after_contact_start')->nullable();

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
        Schema::dropIfExists('mobile_leads');
    }
}
