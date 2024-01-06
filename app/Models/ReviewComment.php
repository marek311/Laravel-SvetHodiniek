<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewComment extends Model
{
    use HasFactory;
    protected $table = 'review_comment';
    public $timestamps = false;
    protected $fillable = ['content'];

    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
