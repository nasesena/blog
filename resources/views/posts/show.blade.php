@extends('layouts.app')

@section('title','記事一覧')

@section('content')

<!--詳細記事をここで表示させます。タイトルと文章を真ん中に置きます-->

<!--スタイルシート設定-->
<link rel="stylesheet" href="{{ asset('css/pager.css')}}">
<ul class="title">
<h2 style="text-align:center">
{{$posts->title}}
</h2>
<p style="text-align:center"><span class="content">{{$posts->content}}</span></p>
</ul>

<!--コメント表示-->
<!--ID:名前:日付で公開-->
<ul class="comments">
<hr>
<span class = "content">〜みんなのコメント広場〜</span>
@foreach($comments as $comment)
<p>
    [{{$comment->comment_id}}]ユーザー名：<span>{{$comment->name}}</span>  {{$comment->created_at}}<br>
</p>
<p>
    <span class="comments">{{$comment->comment}}</span>
</p>
<p>
    
</p>
</ul>
<hr>
@endforeach

<!-- コメント入力 -->
@if($user)
{{ Form::open(['url' => '/comment']) }}
{{ csrf_field() }}
<p>
    名前：{{ $user->name }}
</p>
<p>
  コメント：<br>
  {{ Form::textarea('comment') }}
  <!--ログインしてないときのエラー-->
  @if($errors->has('comment'))
  <span class="text-danger">{{ $errors->first('comment') }}</span>
  @endif
</p>
{{ Form::hidden('name',$user->name) }}
{{ Form::hidden('post_id',$posts->id) }}
{{ Form::hidden('comment_id',$id) }}
{{ Form::submit('コメント',['class'=>'btn btn-primary btn-sm']) }} 

<!--フラッシュメッセージ-->
@include('posts.flash')
{{ Form::close() }}
@else

@endif


<!--戻るボタン作成-->
<p style="text-align:center">
{{ link_to_route('posts.index','記事一覧へ') }}
</p>


