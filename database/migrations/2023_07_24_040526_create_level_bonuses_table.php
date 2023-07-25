<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level_bonuses', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('level_id')->unique()->nullable();
            $table->tinyInteger('global_plan_id')->nullable();
            $table->tinyInteger('global_level_id')->nullable();
            $table->float('amount',10,2)->nullable();
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
        Schema::dropIfExists('level_bonuses');
    }
}
