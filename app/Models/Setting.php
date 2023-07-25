<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    use HasFactory;
    protected $appends = ['file_url','file_url_vertical'];
    protected $table = 'settings';

    public function getFileURLAttribute() {
        return $this->attributes['file_url'] = $this->file_path_squre ? Storage::url($this->file_path_squre) : null;
    }

    public function getFileURLVerticalAttribute() {
        return $this->attributes['file_url_vertical'] = $this->file_path_vertical ? Storage::url($this->file_path_vertical) : null;
    }
}
