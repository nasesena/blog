<!--共通部品。タイトルと記事内容を「作成画面」と「編集画面」で利用する(真ん中寄せを適応)-->
    
    <!--タイトルを入力します-->
    <div align="center">
        {{Form::text('title',$post->title)}}
    </div>

    <!--記事内容を入力する-->
    <div align="center">
        {{Form::textarea('content',$post -> content)}}
    </div>

    <!--入力条件に満たない場合はバリデーションを適応させる-->
    @if($errors->has('title'))
  <span class="text-danger">{{ $errors->first('title') }}</span>
    @endif

    @if($errors->has('content'))
  <span class="text-danger">{{ $errors->first('content') }}</span>
    @endif