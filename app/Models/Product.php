<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
  public function getList(){
    $products = DB::table('products')->get();
    return $products;
  }
}
