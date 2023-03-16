<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\company;

class Product extends Model
{
  public function getList(){
      $products = Product::all(); // DB (Productsテーブル) から全件取得 eloquentの書き方
    // $products = DB::table('products')->get(); ← クエリビルダの書き方 (クエリビルダの場合はSQLのような書き方になる。)
    return $products;
  }

  public function register_product($data){
    // Productsテーブルにインサート処理
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
