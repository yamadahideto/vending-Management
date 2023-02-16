<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
  public function showList(){
    $model = new Product();
    $Products= $model->getList();
    return view('product',['products'=> $Products]);

  }
}
