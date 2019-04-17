<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');
            $table->integer('prospect_id');
            $table->timestamp('completed_at')->nullable();
            $table->integer('completed_by')->nullable();
            $table->timestamp('validated_at')->nullable();
            $table->timestamp('invalidated_at')->nullable();
            $table->integer('validated_by')->nullable();
            $table->string('reviewable_type')->nullable();
            $table->integer('reviewable_id')->nullable();

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
        Schema::dropIfExists('reviews');
    }
}
