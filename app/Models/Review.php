<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public $timestamps = false;
    protected $table = 'review';
    protected $fillable = ['watch_name', 'picture'];
    public function paragraphs()
    {
        return $this->hasMany(ReviewParagraph::class);
    }
}
