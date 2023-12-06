<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewParagraph extends Model
{
    public $timestamps = false;
    protected $table = 'review_paragraph';
    protected $fillable = ['paragraph_text'];
    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
