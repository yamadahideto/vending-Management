@extends('layouts.app')
<script src="../../public/js/product.js"> </script>
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">商品情報登録</div>
        <div class="card-body">
          <form action="{{route("update", $product->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="name"> メーカー:</label>
              <select id="company_list" name="company_id" type="number" placeholder="会社名">
                <!-- プルダウンでDBから会社名取得 -->
                <option value="{{$product->company->id}}"> {{$product->company->company_name}} </option> <!-- 初期値を設定 -->
                @foreach ($companies as $company)
                <option value={{ $company->id }}>{{ $company->company_name }}</option>
                @endforeach
                <!-- / プルダウンでDBから会社名取得 -->
              </select>

            </div>

            <div class="form-group">
              <label for="name"> 商品名: </label>
              <input id="product_name" type="text" name="product_name" readonly value="{{$product->product_name}}">
              @if($errors->has('product_name')) <p>{{ $errors->first('product_name') }}</p> @endif
            </div>
            <div class="form-group">
              <label for="name"> 価格: </label>
              <input id="price" type="number" name="price" placeholder="価格" readonly value="{{$product->price}}">
              @if($errors->has('price')) <p>{{ $errors->first('price') }}</p> @endif
            </div>
            <div class="form-group">
              <label for="name"> 在庫数: </label>
              <input id="stock" type="number" name="stock" placeholder="在庫数" readonly value="{{$product->stock}}">
              @if($errors->has('stock')) <p>{{ $errors->first('stock') }}</p> @endif
            </div>
            <div class="form-group">
              <label for="name"> コメント: </label>
              <textarea id="comment" placeholder="商品コメント" name="comment" readonly> {{$product->comment}} </textarea>
              @if($errors->has('comment')) <p>{{ $errors->first('comment') }}</p> @endif
            </div>
            <div class="form-group">
              <label for="image_name"> 商品画像:</label>
              <!-- <img src="{{ $product->img_path }}"> -->
              <input type="file" id="img_path" name="img_path" placeholder="商品画像" value="{{old('img_path')}}">

              @if($product->img_path != null)
              <!-- 画像が登録されていれば表示する。なければ非表示 -->
              <img id="image_url" src="{{ asset('storage/'.$product->img_path) }}" width="400" height="250">
              @endif
            </div>
            <button type="submit" id="edit_complete">登録</button>
          </form>
          <a class="navbar-brand" href="{{ url('/product') }}"> 戻る</a>
          <button id="edit_btn">編集</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection