<!--共通部品。タイトルと記事内容を「作成画面」と「編集画面」で利用する(真ん中寄せを適応)-->
    
    <!--タイトルを入力します-->
    <div align="center">
        {{Form::text('title',$post->title)}}
    </div>

    <!--記事内容を入力する-->
    <div align="center">
        {{Form::textarea('content',$post -> content)}}
    </div>