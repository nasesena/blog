<!--改良型フラッシュメッセージフォーム、必要なスクリプトを記述-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!--成功時のフラッシュメッセージを表示してみる。toastrが便利-->
<script>

@if (session('msg_success'))
    $(function(){
        toastr.success('{{ session('msg_success')}}');
    });
@endif

@if (session('msg_danger'))
    $(function(){
        toastr.danger('{{ session('msg_danger')}}');
    });
@endif
</script>