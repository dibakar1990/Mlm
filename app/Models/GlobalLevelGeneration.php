<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GlobalLevelGeneration extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'global_level_generations';
    protected $dates = ['deleted_at'];
}
