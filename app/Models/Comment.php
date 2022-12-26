<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'content',
        'name',
        'email',
        'icon',
        'password'
    ];
}