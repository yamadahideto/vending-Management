<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
  public function showList(){
    $model = new Product();
    $Products = $model->getList();
    // $Products = $model->company();
    return view('product', ['products' => $Products]);
  }

  // public function register(){
  //   return view('product_register');
  // }
  public function register()
  {
    return view('product_register');
  }

  public function entry_product(ProductRequest $request)
  {
    DB::beginTransaction();
    try {
      $model = new Product();
      $model->register_product($request);
      DB::commit();
    } catch (\Exception $e) {
      DB::rollback();
      return back();
    }
    // return redirect(route('postRegister'));
    return redirect(route('list'));
  }
}
