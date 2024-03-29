@extends('layouts.app')
<script src="../../public/js/product.js"> </script>
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
              <label for="name"> メーカー: </label>
              <select name="company_id" type="number" placeholder="会社名">
                <!-- プルダウンでDBから会社名取得 -->
                <option value="" selected hidden> 選択してください </option> <!-- 初期値を設定 -->
                @foreach ($companies as $company)
                <option value={{ $company->id }}>{{ $company->company_name }}</option>
                @endforeach
                <!-- / プルダウンでDBから会社名取得 -->
              </select>

              @if($errors->has('company_id'))
              <p>{{ $errors->first('company_id')}}</p>
              @endif
            </div>

            <div class="form-group">
              <label for="name"> 商品名: </label>
              <input type="text" name="product_name" placeholder="商品名を入力してください" value="{{old('product_name')}}">
              @if($errors->has('product_name')) <p>{{ $errors->first('product_name') }}</p> @endif
              <!-- ↑エラー出力 -->
            </div>
            <div class="form-group">
              <label for="name"> 価格: </label>
              <input type="number" name="price" placeholder="価格" value="{{old('price')}}">
              @if($errors->has('price')) <p>{{ $errors->first('price') }}</p> @endif
              <!-- エラー出力 -->
            </div>

            <div class="form-group">
              <label for="name"> 在庫数: </label>
              <input type="number" name="stock" placeholder="在庫数" value="{{old('stock')}}">
              @if($errors->has('stock')) <p>{{ $errors->first('stock') }}</p> @endif
              <!-- エラー出力 -->
            </div>

            <div class="form-group">
              <label for="name"> コメント: </label>
              <textarea placeholder="商品コメント" name="comment"> {{old('comment')}} </textarea>
              @if($errors->has('comment')) <p>{{ $errors->first('comment') }}</p> @endif
              <!-- エラー出力 -->
            </div>

            <div class="form-group">
              <label for="name"> 商品画像: </label>
              <input type="file" name="img_path" placeholder="商品画像" value="{{old('img_path')}}">　
              <!-- 商品画像をファイルから登録 -->
            </div>
            <button id = regBtn type="submit"> 登録 </button>
          </form>
          <a class="navbar-brand" href="{{ url('/product') }}"> 戻る</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection