<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryPost extends Model
{
    public $timestamps = false;
    protected $table = 'gallery_post';
    protected $fillable = ['name', 'picture'];
}
