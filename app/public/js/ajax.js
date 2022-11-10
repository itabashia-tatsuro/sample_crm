$(function(){
  console.log($("#loading"));
  $("#btn").click(function () { // 送信ボタンをクリックしたら
    
    // 必要な要素を取得
    $('#loading').removeClass('d-none');
    $("#tbody").empty();
    let startDate = $("#startDate").val();
    let endDate = $("#endDate").val();

    // ajax実行 = サーバー側へのアクションを設定する
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      type: "GET",              // HTTP通信の種類
      url: "analysis/ajax",     // url: は読み込むURLを表す
      data: {
        "startDate": startDate, // controllerに送る
        "endDate": endDate,     // controllerに送る
      },
      dataType: "json",        // 読み込むデータの種類を記入
    }).done((data) => {        // 通信成功時の処理
      
      setTimeout(function(){
        $('#loading').addClass('d-none'); //通信中のぐるぐるを消す
      }, 1000);
      
      let orders = data.orders.data; 
      for (let i = 0; i < orders.length; i++) {
          let html = `
                  <tr>
                      <td class="mx-5">${orders[i].id}</td>
                      <td class="mx-5">${orders[i].name}</td>
                      <td class="mx-5">${orders[i].price}</td>
                      <td class="mx-5">${orders[i].quantity}</td>
                      <td class="mx-5">${orders[i].status}</td>
                      <td class="mx-5">${orders[i].created_at}</td>
                  </tr>
                `
        $("#tbody").append(html);
      };
      if (orders.length === 0) {
        $('table').after('<p class="text-center mt-5 search-null">検索結果がありませんでした</p>');
      }
    }).fail((err) => { // 通信失敗時の処理
      alert('取得に失敗しました');
    });
  });
});