<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryPost extends Model
{
    public $timestamps = false;
    protected $table = 'gallery_post';
    protected $fillable = ['name', 'picture', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
