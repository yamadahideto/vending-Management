<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\company;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;
use Symfony\Component\VarDumper\VarDumper;

class ProductController extends Controller
{
  public function showList(Request $request){
    $model = new Product();
    $keyword = $request->input('keyword'); //<input name= "keyword">のパラメーター取得
    $company = $request->input('company_id');//<input name= "company_id">のパラメーター取得
    $priceFrom = $request->input('priceRangeFrom'); //<input name = "priceRangeFrom">のパラメータ取得
    $priceTo = $request->input('priceRangeTo');  //<input name = "priceRangeTo">のパラメータ取得
    $stockFrom = $request->input('stockRangeFrom');
    $stockTo = $request->input('stockRangeTo');
    // Search_productにinputで取得した引数を渡して検索処理
    $products = $model->Search_product($keyword, $company, $priceFrom, $priceTo, $stockFrom, $stockTo);
    $companyModel = new Company();
    $companies = $companyModel->companyNameList();

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
    //第二引数は"['渡す先での変数名' => 今回渡す変数]"
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
    return redirect(route('list'));
  }

  public function updateProduct(ProductRequest $request, $id){

    // DB更新処理
    DB::beginTransaction();
    try {
      $model = new Product();
      $model->update_product($request, $id);
      DB::commit();
    } catch (\Exception $e) {
      DB::rollback();
      return back();
    }
    return redirect(route('list'));
  }

  public function detail($id){
    // 詳細情報取得
    $product = Product::find($id);
    $model = new Company();
    $companies = $model->companyNameList();
    return view ("detail", compact("companies", "product"));
    // return view('detail', ['detailProduct' => $product]);
  }

  public function destroy($id){
    // 削除処理
    $product = Product::find($id);
    $product->delete();
    return redirect(route('list'));
  }
}
