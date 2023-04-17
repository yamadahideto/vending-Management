@extends('layouts.app')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@section('content')
<body>
  <div class="flex-center position-ref full-height">
    @if (Route::has('login'))
    <div class="top-right links">
      @auth

      @else
      <a href="{{ route('login') }}">Login</a>

      @endauth
    </div>
    @endif
    <div class="content">
      <div class="title m-b-md">
        <!-- Vending-management -->
        ProductList
      </div>
      <!-- 商品名検索窓 -->
      <div class="top_content">
        <form class="productSearch" action="{{route('list')}}" method="get">
          <div class="formGroup">
            <label for="name"> 商品名: </label>
            <input type="search" name="keyword" value="{{request('search')}}" placeholder="商品を検索">
            <!-- </div> //inputのvalueをvalue=” request (‘search’) ”にする事で入力すると値がURLに反映される -->
            <!-- // 商品名検索窓 -->
            <!-- ↓プルダウンでDBから会社名取得 -->
            <label for="name"> メーカー: </label>
            <select name="company_id" type="number" placeholder="会社名">
              <option value="" selected hidden> 選択してください </option> <!-- 初期値を設定 -->
              @foreach ($companies as $company)
              <option value={{ $company->id }}>{{ $company->company_name }}</option>
              @endforeach
              <!-- //プルダウンでDBから会社名取得 -->
              <input type="submit" value="検索">
          </div>
        </form>

        <button class="newRegisterBtn">
          <a href="{{ url('/product/register') }}"> 新規登録 </a>
        </button>
      </div>

      <div class="links">
        <table>
          <thead>
            <tr>
              <th>商品名</th>
              <th>価格</th>
              <th>在庫</th>
              <th>コメント</th>
              <th>メーカー</th>
              <th>詳細</th>
              <!-- <th>編集</th> -->
              <th>削除</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $product)
            <tr>
              <td>{{ $product->product_name }}</td>
              <td>{{ $product->price }}</td>
              <td>{{ $product->stock }}</td>
              <td>{{ $product->comment }}</td>
              <td>{{ $product->company->company_name }}</td>
              <td>
                <button class="editBtn">
                  <a href="{{ route("detail", $product->id) }}"> 詳細 </a> </td>
              </button>
              <td>
                <form action="{{route("destroy", $product->id)}}" method="post">
                  @csrf
                  <button id="deleteBtn" class="deleteBtn" type="submit"> 削除 </button>
                </form>
              </td>
              <!-- <td> <a href="{{route("destroy", $product->id)}}"> 削除</a> </td> -->
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
@endsection