<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewComment extends Model
{
    use HasFactory;
    protected $table = 'review_comment';
    public $timestamps = false;
    protected $fillable = ['content', 'user_id'];

    public function review()
    {
        return $this->belongsTo(Review::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function factory()
    {
        return \Illuminate\Database\Eloquent\Factories\Factory::factoryForModel(static::class);
    }
}
