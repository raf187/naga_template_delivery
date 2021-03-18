<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalDelivery extends Model
{
    protected $fillable = ['deli_date', 'total_tr', 'total_money'];

    use HasFactory;
}
