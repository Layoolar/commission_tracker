<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    public $timestamps = false;

    protected $appends = ['modified_order_date'];

    // public function setOrderDateAttribte($value)
    // {
    //     $this->attributes['order_date'] = gmdate('');
    // }

    public function purchaser()
    {
        // $order->purchaser->name;
        return $this->belongsTo(User::class, 'purchaser_id', 'id');
    }

    public function getModifiedOrderDateAttribute($value)
    {
        return gmdate('jS F, Y', strtotime($value));
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    // public function order_products()
    // {
    //     return $this->hasManyThrough(Products::class, OrderItem::class, 'id', 'id', '')
    // }

    public function order_price()
    {
        $price = 0;
        // return $this->order_items()->first()->qantity;
        foreach ($this->order_items as $item) $price += ($item->qantity * $item->product->price);

        return $price;
    }


    public function percentage()
    {
        if (!$this->purchaser->referral()->count()) return 0;
        $no_ref = $this->purchaser->referral->number_referred($this->order_date);

        if (in_array($no_ref, range(0, 5))) return 5;
        else if (in_array($no_ref, range(5, 10))) return 10;
        else if (in_array($no_ref, range(10, 20))) return 15;
        else if (in_array($no_ref, range(20, 30))) return 20;
        else return 30;
    }

    public function commission()
    {
        return $this->order_price() * ($this->percentage() / 100);
    }
}
