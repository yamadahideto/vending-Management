<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Company extends Model
{
  public function companyNameList(){
    $companyList = Company::select('id', 'company_name')->get();
    // ↑ DB(companiesテーブル)からidとcompanynameのカラムのみ全件取得 Eloquentの書き方
    return $companyList;
  }

  public function products(){
    // リレーション作成
    return $this->hasMany('App\Models\product');
  }
}
