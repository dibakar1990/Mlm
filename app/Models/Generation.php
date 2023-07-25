<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Generation extends Model
{
    use HasFactory;

    protected $table = 'generations';
    protected $fillable = [
        'main_id',
        'member_id',
        'gen_type',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'member_id','id');
    }
}
