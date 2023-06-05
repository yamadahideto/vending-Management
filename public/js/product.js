document.addEventListener("DOMContentLoaded", function () {
  $(function () {
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
      }else{
        // キャンセル処理
        // 特に何もしない
      }
    });

  });
});


