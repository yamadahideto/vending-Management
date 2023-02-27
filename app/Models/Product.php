<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\company;

class Product extends Model
{
  public function getList(){
    $products = DB::table('products')->get();
    return $products;
  }

  public function register_product($data){
    DB::table('products')->insert([
      'company_id' => $data->company_id,
      'product_name' => $data->product_name,
      'price' => $data->price,
      'stock' => $data->stock,
      'comment' => $data->comment,
      'img_path' => $data->img_path,
      'created_at' => date("Y-m-d H:i:s"),
      'updated_at' => date("Y-m-d H:i:s")
    ]);
  }

  public function company(){
    return $this->belongsTo('App\Models\company');
  }
}
