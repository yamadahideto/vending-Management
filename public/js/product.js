document.addEventListener("DOMContentLoaded", function () {

  $(function () {
    $(".productName").click(function () {
      alert("商品名でソート");
    });

    $(".price").click(function () {
      alert("価格でソート");
    });
    $(".stock").click(function () {
      alert("在庫数でソート");
    });

    $(".comment").click(function () {
      alert("コメントでソート");
    });

    $(".company").click(function () {
      alert("会社名でソート");
    });

  });
});