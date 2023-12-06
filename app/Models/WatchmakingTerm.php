<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchmakingTerm extends Model
{
    public $timestamps = false;
    protected $table = 'watchmaking_term';
    protected $fillable = ['term', 'explanation'];
}
