@extends('layouts.app')

@section('title','作成画面')

@section('app')

<!--記事作成にはcreateを利用する！(controllerのupdateを利用します)-->
{{Form::open(['route' => ['posts.store']]) }}

    <!--共通フォーム呼び出し-->
    <p align="center">上からタイトル、記事内容です</p>
    @include('posts.form')

    <!--createを行う、最終的にはクローズする-->
    <div align="center">
    {{Form::submit('新規作成')}}
    {{Form::close()}}
    </div>
    
    <!--エラーメッセージを表示！-->
    @include('posts.errormsg')
    
@endsection
<!--戻るボタン作成-->
    <p style="text-align:center">
    {{ link_to_route('posts.index','記事一覧へ') }}
    </p>
    
