<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GlobalPlan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'global_plans';
    protected $dates = ['deleted_at'];
}
