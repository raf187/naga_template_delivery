<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    protected $casts = [
        "orderList" => 'array'
    ];

    protected $fillable = [
        'user_id',
        'orderId',
        'orderList',
        'payMethod',
        'totalPrice',
        'deliTime',
        'deliDate',
        'ticketResto',
        'cbResto',
        'orderStatus',
        'infoOrder',
        'utensils',
        'deliSup',
        'tva6',
        'tva10',
        'tva20',
        'deliType',
        'paygreenID',
        'paymentStatus',
        'updated_at',
        'created_at'
    ];



    public function user_id(){
        return $this->belongsTo('App\User');
    }

}
