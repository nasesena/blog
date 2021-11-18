<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
$(function(){
  history.pushState(null, null, null); //ブラウザバック無効化
  //ブラウザバックボタン押下時
  $(window).on("popstate", function (event) {
    history.pushState(null, null, null);
    window.alert('恐れ入りますが、ブラウザバックは出来ません。終了する場合はブラウザを閉じてください。');
  });
});
</script> 