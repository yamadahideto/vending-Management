<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Vending-management</title>

  <!-- Fonts -->
  <!-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet"> -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
  <div class="flex-center position-ref full-height">
    @if (Route::has('login'))
    <div class="top-right links">
      @auth
      <a href="{{ url('/product/register') }}"> 新規登録 </a>
      <a href="{{ url('/home') }}">Home</a>
      @else
      <a href="{{ route('login') }}">Login</a>

      @if (Route::has('register'))
      <a href="{{ route('register') }}">Register</a>
      @endif
      @endauth
    </div>
    @endif
    <div class="content">
      <div class="title m-b-md">
        <!-- Vending-management -->
        ProductList
      </div>
      <!-- 商品名検索窓 -->
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

      </form>

      <div class="links">
        <table>
          <thead>
            <tr>
              <th>商品名</th>
              <th>価格</th>
              <th>在庫</th>
              <th>コメント</th>
              <th>メーカー</th>
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
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>