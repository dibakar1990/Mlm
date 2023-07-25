<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LevelBonus extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'level_bonuses';
    protected $dates = ['deleted_at'];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function globalPlan()
    {
        return $this->belongsTo(GlobalPlan::class);
    }
}
