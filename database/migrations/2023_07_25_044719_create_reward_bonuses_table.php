<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reward_bonuses', function (Blueprint $table) {
            $table->id();
            $table->string('rank_name')->unique()->nullable();
            $table->bigInteger('a_team')->nullable();
            $table->bigInteger('b_team')->nullable();
            $table->bigInteger('c_team')->nullable();
            $table->float('amount',10,2)->nullable();
            $table->bigInteger('days')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0 = Inactive, 1 = Active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reward_bonuses');
    }
}
