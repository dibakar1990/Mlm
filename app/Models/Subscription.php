<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Subscription extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'subscriptions';
    protected $dates = ['deleted_at'];

    public function getSubscriptionDateAttribute()
    {
        return $this->attributes['subscription_date'] = $this->created_at ? Carbon::parse($this->created_at)->format('d F Y - h:i A') : null;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(GlobalPlan::class,'global_plan_id','id');
    }
}
