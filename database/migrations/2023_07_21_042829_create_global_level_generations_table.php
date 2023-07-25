<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlobalLevelGenerationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_level_generations', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('global_level_id')->nullable();
            $table->tinyInteger('level')->nullable();
            $table->string('level_name')->nullable();
            $table->tinyInteger('team')->nullable();
            $table->float('amount',10,2)->nullable();
            $table->float('total_amount',10,2)->nullable();
            $table->bigInteger('recycle')->nullable();
            $table->bigInteger('upgrade')->nullable();
            $table->bigInteger('double_recycle')->nullable();
            $table->bigInteger('direct')->nullable();
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
        Schema::dropIfExists('global_level_generations');
    }
}
