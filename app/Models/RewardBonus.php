<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RewardBonus extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'reward_bonuses';
    protected $dates = ['deleted_at'];
}
