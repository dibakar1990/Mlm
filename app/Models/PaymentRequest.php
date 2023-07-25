<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class PaymentRequest extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'payment_requests';
    protected $dates = ['deleted_at'];

    public function getFileURLAttribute()
    {
        return $this->attributes['file_url'] = $this->file_path ? Storage::url($this->file_path) : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class)->with('country','state');
    }
}
