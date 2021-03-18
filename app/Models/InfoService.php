<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoService extends Model
{
    protected $fillable = ['content', 'author', 'title'];
    use HasFactory;
}
