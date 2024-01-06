<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public $timestamps = false;
    protected $table = 'review';

    protected $fillable = ['watch_name', 'picture', 'user_id'];
    public function paragraphs()
    {
        return $this->hasMany(ReviewParagraph::class);
    }
    public function comments()
    {
        return $this->hasMany(ReviewComment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
