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
    //'public/storageに画像ファイルを保存
    $path = $data->file('img_path')->store('storage');
    $data->file('img_path')->storeAs('public', $path);

    DB::table('products')->insert([ // Productsテーブルにインサート処理
      'company_id' => $data->company_id,
      'product_name' => $data->product_name,
      'price' => $data->price,
      'stock' => $data->stock,
      'comment' => $data->comment,
      'img_path' => $path,
      'created_at' => date("Y-m-d H:i:s"),
      'updated_at' => date("Y-m-d H:i:s")
    ]);
  }

  public function company(){
    return $this->belongsTo('App\Models\company');
  }
}
