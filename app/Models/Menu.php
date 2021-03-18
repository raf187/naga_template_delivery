<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
  protected $fillable = ["off_stock"];

    public function extra()
    {
        return $this->belongsToMany('App\ExtrasBoll');
    }
  
}
