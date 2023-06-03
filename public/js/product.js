
// document.addEventListener("DOMContentLoaded", function () {
//   $(function () {
//     $(".deleteBtn").click(function (event) {
//       // event.preventDefault(); // 削除処理無効化
//       var id = $(this).data('product_id');
//       $.ajax({
//         headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
//           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         type: "POST",
//         // url: 'destroy/' + id,
//         url: "http://localhost:8888/Vending-management/public/destroy/" + id,
//         dataType: "json",
//         // data: {"id": id },
//       // }).done(function (data) {
//         success: function (response) {
//           // 削除が成功した場合の処理
//           alert(id);
//           console.log(response);
//         },
//         // }).fail(function (data) {
//         error: function (xhr, status, error) {
//           // エラー時の処理
//           alert(id + "失敗しました");
//           console.error("error" +error);
//           console.log("response", xhr.responseText);
//         }
//       })
//     });

//   });
// });


document.addEventListener("DOMContentLoaded", function () {
  $(function () {
    $(".deleteBtn").click(function (event) {
      var id = $(this).data('product_id');
      $.ajax({
        headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "http://localhost:8888/Vending-management/public/destroy/" + id,
        dataType: "json",
        success: function (response) { // 削除が成功した場合の処理
          alert(id);
          console.log(response);
          console.log("成功しました");
        },
        error: function (xhr, status, error) { // エラー時の処理
          alert(id + "失敗しました");
          console.error("error" + error);
          console.log("response", xhr.responseText);
        }
      })
    });

  });
});


