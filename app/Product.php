<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name','product_description','product_category', 'price', 'user_id' ,'image' , 'image_url'
    ];
    
    public function orders(){
        return $this->hasMany('App\Order');
    }
}
