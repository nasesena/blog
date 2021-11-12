@extends('layouts.app')

@section('title','編集画面')

@section('app')



<!--編集文にはupdateを追加する！(controllerのupdateを利用します)-->
{{Form::open(['route' => ['posts.update',$post->id],'method' => 'put']) }}

    
    <h1 style="text-align:center">編集画面</h1>
    <p align="center">タイトルと記事内容が編集できます</p>
    <!--共通フォーム呼び出し-->
    @include('posts.form')

    

    <!--UPDATEを行う、最終的にはクローズする-->
    <div align="center">
    {{Form::submit('更新する！')}}
    </div>
    

    <!--エラーメッセージを表示！-->
    @include('posts.flash')
    @include('posts.errormsg')
    {{Form::close()}}
    
    @endsection
    
    <!--戻るボタン作成-->
    <p style="text-align:center">
    {{ link_to_route('posts.index','記事一覧へ') }}
    </p>

