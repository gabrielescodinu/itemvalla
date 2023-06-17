<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'image', 'user_id', 'repeatable_fields'];


    protected $casts = [
        'repeatable_fields' => 'array',
    ];    
}
