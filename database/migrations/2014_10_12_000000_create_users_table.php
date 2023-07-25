<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            
            $table->tinyInteger('type')->nullable()->comment('1 = admin, 2 = user 3 = support');
            $table->string('unique_code')->nullable();
            $table->string('sponser_code')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->string('city')->nullable();
            $table->bigInteger('direct_group')->default(0);
            $table->bigInteger('total_group')->default(0);
            $table->bigInteger('level')->default(1);
            $table->bigInteger('level_group')->default(0);
            $table->bigInteger('total_group_active')->default(0);
            $table->float('wallet_amount')->default(0);
            $table->float('total_group_deposite')->default(0);
            $table->float('total_deposite')->default(0);
            $table->float('total_income')->default(0);
            $table->float('total_withdraw')->default(0);
            $table->float('current_withdraw_request')->default(0);
            $table->tinyInteger('status')->default(1)->comment('0 = inactive, 1 = active');
            $table->string('avatar')->nullable();
            $table->tinyInteger('is_active')->default(0);
            $table->timestamp('date_of_joning')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
