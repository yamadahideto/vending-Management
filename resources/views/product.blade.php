@extends('layouts.app')
<script src="../../public/js/product.js"> </script>
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

      <div class="top_content">
        <form class="productSearch" action="{{route('list')}}" method="get">
          <div class="formGroup-1">
            <!-- 商品名検索窓 -->
            <label for="name"> 商品名: </label>
            <input type="search" name="keyword" value="{{request('search')}}" placeholder="商品を検索" id="product_name">
            <!-- </div> //inputのvalueをvalue=” request (‘search’) ”にする事で入力すると値がURLに反映される -->
            <!-- // 商品名検索窓 -->

            <!-- ↓プルダウンでDBから会社名取得 -->
            <label for="name"> メーカー: </label>
            <select id="company_id" name="company_id" type="number" placeholder="会社名">
              <option value="" selected hidden> 選択してください </option> <!-- 初期値を設定 -->
              @foreach ($companies as $company)
              <option value={{ $company->id }}>{{ $company->company_name }}</option>
              @endforeach
              <!-- //プルダウンでDBから会社名取得 -->
            </select>
          </div>
          <!--価格・在庫検索 -->
          <div class="formGroup-2">
            <div class="priceRange">
              <label for="priceRangeLabel"> 価格： </label>
              <input inputmode="decimal" name="priceRangeFrom" class="rangeArea" id="priceRangeFrom">
              <label for="range"> 〜 </label>
              <input inputmode="decimal" name="priceRangeTo" class="rangeArea" id="priceRangeTo">
            </div>
            <div class="stockRange">
              <label for="stockRangeLabel"> 在庫数： </label>
              <input inputmode="decimal" name="stockRangeFrom" class="rangeArea" id="stockRangeFrom">
              <label for="range"> 〜 </label>
              <input inputmode="decimal" name="stockRangeTo" class="rangeArea" id="stockRangeTo">
            </div>
          </div>
          <!-- //価格・在庫検索 -->
          <button class = "searchBtn"> 検索 </button>
          <!-- <input type="submit" value="検索" class="searchBtn"> -->
          <!-- <input type="submit" value="検索" class="searchBtn"> -->
        </form>

        <button class="newRegisterBtn">
          <a href="{{ url('/product/register') }}"> 新規登録 </a>
        </button>
      </div>

      <div class="links">
        <table>
          <thead>
            <tr class="culumnName">
              <!-- <th class="productName">商品名</th>
              <th class="price">価格</th>
              <th class="stock">在庫</th>
              <th class="comment">コメント</th>
              <th class="company">メーカー</th>
              <th>詳細</th>
              <th>削除</th> -->

              <th scope="col">@sortablelink("product_name", "商品名", $products)</th>
              <th class="price">@sortablelink("price", "価格", $products)</th>
              <th class="stock"> @sortablelink("stock", "在庫", $products)</th>
              <th class="comment"> @sortablelink("comment", "コメント", $products)</th>
              <th class="company"> @sortablelink("company_id", "メーカー", $products)</th>
              <th>詳細</th>
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
                <!-- <form action="{{route("destroy", $product->id)}}" method="post" data-id="{{$product->id}}">
                  @csrf -->
                <button data-product_id="{{$product->id}}" id="deleteBtn" class="deleteBtn"> 削除 </button>
                <!-- </form> -->
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