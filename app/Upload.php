<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $fillable = ['original_name', 'size', 'mime_type', 'cloud_path'];
}
