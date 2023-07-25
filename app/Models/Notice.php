<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Notice extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'notices';
    protected $dates = ['deleted_at'];

    public function getFileURLAttribute()
    {
        return $this->attributes['file_url'] = $this->file_path ? Storage::url($this->file_path) : null;
    }
}
