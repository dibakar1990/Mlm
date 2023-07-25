<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Passbook extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'passbooks';
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class)->with('country','state');
    }
}
