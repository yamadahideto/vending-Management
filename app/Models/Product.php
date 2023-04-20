<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\company;
use Illuminate\Http\Request;

class Product extends Model
{
  public function getList()
  {
    $products = Product::all(); // DB (Productsテーブル) から全件取得 eloquentの書き方
    // $products = DB::table('products')->get(); ← クエリビルダの書き方 (クエリビルダの場合はSQLのような書き方になる。)
    return $products;
  }

  public function Search_product($keyword,$company){
    // 検索処理
    $products = Product::query();
    if (!empty($keyword)) {
      $products->where("product_name", "LIKE", "%{$keyword}%");
    }
    if (!empty($company)) {
      $products->where("company_id", $company);
    }
    $products = $products->get();

    return $products;
  }

  public function register_product($data)
  {
    if($data->img_path != null){
       // 画像ファイルがあれば、'public/storageに画像ファイルを保存
      $path = $data->file('img_path')->store('storage');
      $data->file('img_path')->storeAs('public', $path);
    }else{
      $path = $data->img_path;
      // 画像ファイルなければスルーして登録
    }
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

  public function update_product(Request $request,$id)
  {
    if ($request->img_path != null) {
      // 画像ファイルがあれば、'public/storageに画像ファイルを保存
      $path = $request->file('img_path')->store('storage');
      $request->file('img_path')->storeAs('public', $path);
    } else {
      $path = $request->img_path;
      // 画像ファイルなければスルーして登録
    }
    //update処理 取得したidを更新
    DB::table('products')->where('id', $id)->update([
      'company_id' => $request->company_id,
      'product_name' => $request->product_name,
      'price' => $request->price,
      'stock' => $request->stock,
      'comment' => $request->comment,
      'img_path' => $path,
      'created_at' => date("Y-m-d H:i:s"),
      'updated_at' => date("Y-m-d H:i:s")
    ]);
  }

  public function company()
  {
    return $this->belongsTo('App\Models\company');
  }
}
