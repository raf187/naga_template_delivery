<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenTime extends Model
{
  protected $fillable = [
      'day',
      'dayFr',
      'morningOpen',
      'morningClose',
      'nightOpen',
      'nightClose',
      'morningIsClose',
      'nigthIsClose'
  ];
    use HasFactory;
}
