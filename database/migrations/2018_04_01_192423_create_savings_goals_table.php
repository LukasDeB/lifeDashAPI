<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSavingsGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savings_goals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('goal_id')->unsigned();
            $table->text('reason')->nullable();
            $table->integer('targetAmount');
            $table->date('targetDate')->nullable();
            $table->integer('progress');
            

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
        Schema::dropIfExists('savings_goals');
    }
}
