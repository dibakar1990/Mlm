<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GlobalLevel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'global_levels';
    protected $dates = ['deleted_at'];

    public function globalLevelGeneration()
    {
        return $this->hasMany(GlobalLevelGeneration::class);
    }

    public function globalPlan()
    {
        return $this->belongsTo(GlobalPlan::class);
    }
}
