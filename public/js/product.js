document.addEventListener("DOMContentLoaded", function () {

  $(function (){ // 検索の非同期処理
    $(".searchBtn").click(function(event){
      event.preventDefault();// 通常の検索処理のキャンセル
      var product_name = document.getElementById("product_name").value;
      var company_id = document.getElementById("company_id").value;
      var price_range_from = document.getElementById("priceRangeFrom").value;
      var price_range_to = document.getElementById("priceRangeTo").value;
      var stock_range_from = document.getElementById("stockRangeFrom").value;
      var stock_range_to = document.getElementById("stockRangeTo").value;

      var table = document.querySelector("tbody");

      $.ajax({
        headers:{
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        type: "GET",
        url: "http://localhost:8888/Vending-management/public/product/search",
        dataType: "json",
        data: {
          "keyword": product_name,
          "company": company_id,
          "priceFrom": price_range_from,
          "priceTo": price_range_to,
          "stockFrom": stock_range_from,
          "stockTo": stock_range_to,
        },
        success: function(response){
          // alert("成功しました");
          // 一覧表示を一度全て削除
          while (table.rows[0]) table.deleteRow(0);
          var tbodyHtml = '';
          console.log(response);
          response.products.forEach(function(product){
            tbodyHtml += '<tr>';
            tbodyHtml += '<td>' + product.product_name + '</td>';
            tbodyHtml += '<td>' + product.price + '</td>';
            tbodyHtml += '<td>' + product.stock + '</td>';
            tbodyHtml += '<td>' + (product['comment'] || '') + '</td>';
            tbodyHtml += '<td>' + (product.company ? product.company.company_name : '') + '</td>';
            tbodyHtml += '<td>';
            tbodyHtml += '<button class="editBtn">';
            tbodyHtml += '<a href="http://localhost:8888/Vending-management/public/detail/' + product.id + '">詳細</a>';
            tbodyHtml += '</button>';
            tbodyHtml += '</td>';
            tbodyHtml += '<td>';
            tbodyHtml += '<button data-product_id="' + product['id'] + '" class="deleteBtn">削除</button>';
            tbodyHtml += '</td>';
            tbodyHtml += '</tr>';
          });
          $(table).html(tbodyHtml);

        },
        error: function (xhr, status, error) { // エラー時の処理
          console.error("エラー: " + error);
          console.log("ステータス: " + status);
          console.log("レスポンス: " + xhr.responseText);
        }
      })
    });
  });

  //検索ここまで

  $(function () {// 削除の非同期処理
    $(".deleteBtn").click(function (event) {
      var id = $(this).data('product_id');
      var deleteButton = $(this);
      var deleteModal = confirm("削除してよろしいですか？"); //削除して良いかの確認モーダル
      if (deleteModal) {
        $.ajax({
          headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: "POST",
          url: "http://localhost:8888/Vending-management/public/destroy/" + id,
          dataType: "json",
          success: function (response) { // 削除が成功した場合の処理
            deleteButton.closest("tr").remove();
          },
          error: function (response, xhr, status, error) { // エラー時の処理
            console.error("error" + error);
            console.log("response", xhr.responseText);
          }
        })
      } else {
        // キャンセル処理
        // 特に何もしない
      }
    });

  });


});


