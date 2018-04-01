<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('activity_id')->nullable();
            $table->string('activity_title')->nullable();
            $table->string('area_pathJP')->nullable();
            $table->date('activity_start_date');
            $table->date('activity_end_date')->nullable();
            $table->date('purchase_start_date');
            $table->date('purchase_end_date')->nullable();
            $table->integer('rate_type');
            $table->float('amount');
            $table->string('created_user');
            $table->string('updated_user')->nullable();
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
        Schema::dropIfExists('promotions');
    }
}
