<!--一覧表示画面です。データベースの文字を表示します！-->

@extends('layouts.app')
@section('content')

<!DOCTYPE html>
<h1 style="text-align:center">THE☆掲示板</h1>
<p style="text-align:center">掲示板一覧です。良かったら書き込んでください。<br>フリーワードと日付検索ができます<p>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/pager.css')}}">
    <title>Document</title>
</head>


<!--表形式にして真ん中にする-->
<table border =" 2" align = "center" >
<tr>
    <th>記事タイトル</th>
    <th>更新日時</th>
    <th>編集する？</th>
    <th>削除する？</th> 
    
</tr>

<!--フリーワード検索はここにする-->
<div class="search">
<form action="{{ route('posts.index') }}" method="get">
                <input type="text" name="keywords" size="50">
    <div>
    日付指定する場合は以下を選択
        <div>
        {{ Form::date('from_date')}}以降
        {{ Form::date('to_date')}}まで
        </div>
        
    {{ Form::submit('検索',['class'=>'btn btn-primary btn-sm'])}}
</form>
    {{ Form::close() }}
    
    </div>

</div>



<br>
<!--
<div align = "center">

<form action="{{route('posts.index')}}" method="GET"　align="center">
   ワード検索：<input type="text" name="keywords" size="30" align="center">
   <br>
<form action="{{route('posts.index')}}" method="GET"　align="center">
   日付検索：
   <input type="text" name="from_date" size="30" align="center">
   〜
    <input type="text" name="to_date" size="30" align="center">
    <input type="submit" value="検索">
</form>
</form>
</div>-->
    <!--Forreachで、postから値を表示させる。-->
    <!--ID,記事タイトル,作成日時,編集,削除と言った、データベースみたいに並べる-->
    <!--削除フォームに関してはアラートを出したいので。javascritptを利用する-->
    @foreach($posts as $post)
        <tr>
            <td>{{ link_to_route('posts.show', $post->title, [$post->id]) }}</td>
            <td>{{ $post->updated_at }}</td>
            <td>{{ link_to_route('posts.edit', 'Edit', [$post->id])}}</td>
            <td> {{ Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete', 'name' => 'delete_' . $post->id, 'style' => 'display:inline;'])}}
                <a href="javascript:document.{{'delete_'.$post->id}}.submit()" onclick="return confirm('削除します！？');">けす！</a>
                {{Form::close()}}
            </td>
            
    </tr>
    @endforeach    
   
</table>


<main class="mt-4">
    @yield('content')
</main>

<table class="newmake">
    <td>{{ link_to_route('posts.create', '新規作成')}}</td>
</table>

<!--フラッシュメッセージを表示する-->
@include('posts.flash')


<!--ページャーはここ-->
{{ $posts->links() }}

@endsection

</html>
