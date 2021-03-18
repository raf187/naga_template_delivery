<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtrasBoll extends Model
{
    use HasFactory;

    public function id(){
        return $this->belongsToMany('App\Menu');
    }
}
