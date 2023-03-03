<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class company extends Model
{
  public function products(){
    return $this->hasMany('App\Models\product');
  }
}
