@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">商品情報登録</div>
        <div class="card-body">
          <form action="{{route("submit")}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="name"> メーカー: {{$detailProduct->company->company_name}}</label>
              <!-- / プルダウンでDBから会社名取得 -->
              </select>

            </div>

            <div class="form-group">
              <label for="name"> 商品名: {{$detailProduct->product_name}}</label>
              <!-- <input type="text" name="product_name" readonly value="{{$detailProduct->product_name}}"> -->

            </div>
            <div class="form-group">
              <label for="name"> 価格: {{$detailProduct->price}}</label>
              <!-- <input type="number" name="price" placeholder="価格" readonly value="{{$detailProduct->price}}"> -->

            </div>

            <div class="form-group">
              <label for="name"> 在庫数: {{$detailProduct->stock}}</label>
              <!-- <input type="number" name="stock" placeholder="在庫数" readonly value="{{$detailProduct->stock}}"> -->

            </div>

            <div class="form-group">
              <label for="name"> コメント: {{$detailProduct->comment}}</label>
              <!-- <textarea placeholder="商品コメント" name="comment" readonly> {{$detailProduct->comment}} </textarea> -->

            </div>

            <div class="form-group">
              <label for="name"> 商品画像:</label>
              <!-- <img src="{{ $detailProduct->img_path }}"> -->
              <img src="{{ asset('storage/'.$detailProduct->img_path) }}" width="400" height="250">
            </div>
          </form>
          <a class="navbar-brand" href="{{ url('/product') }}"> 戻る</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection