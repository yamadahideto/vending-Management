<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\company;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
  public function showList(Request $request){
    $keyword = $request->input('keyword');
    $company = $request->input('company_id');
    $model = new Product();
    $products = $model->getList();
    $companyModel = new Company();
    $companies = $companyModel->companyNameList();
    $products = Product::query();
    if (!empty($keyword)) {
      // $products = Product::where("product_name", "LIKE", "%{$keyword}%")->where("company_id",$request->company_id)->get();
      $products->where("product_name", "LIKE", "%{$keyword}%");
    }

    if (!empty($company)){
      $products->where("company_id",$company);
    }
    $products = $products->get();
    return view('product')->with([
      'products' => $products,
      'companies' => $companies
    ]);
    // return view('product', ['products' => $Products]);
    // viewのproductに'products'という変数で$productsを返す
  }

  public function register()
  {
    $model = new Company();
    $companies = $model->companyNameList();
    return view('product_register', ['companies' => $companies]);
    // viewの'product_register'にcompaniesという変数で$companies返す
  }

  public function entryProduct(ProductRequest $request)
  {
    // DB登録処理
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
