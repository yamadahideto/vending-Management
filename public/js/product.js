document.addEventListener("DOMContentLoaded", function () {
  // 詳細画面処理
  const product_name = document.getElementById("product_name");
  const price = document.getElementById("price");
  const stock = document.getElementById("stock");
  const comment = document.getElementById("comment");
  const img_path = document.getElementById("img_path");

// 編集ボタン押下で入力できるようにする
  document.getElementById('edit_btn').addEventListener('click', function () {
    alert("編集しますか？");
    if(product_name.readOnly == true){
      product_name.readOnly = false; //readonlyを解除
      price.readOnly = false;
      stock.readOnly = false;
      comment.readOnly = false;
      img_path.style.visibility = "visible";
      image_url.style.visibility = "hidden";

    } else{
      product_name.readOnly = true; //readonlyに設定
      price.readOnly = true;
      stock.readOnly = true;
      comment.readOnly = true;
      img_path.style.visibility = "hidden";
    }

  });
  // 詳細画面処理 end
});

