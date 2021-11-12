@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">ログイン成功！ようこそ！</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                            
                        </div>
                    @endif

                    ログインに成功しました！こちらのリンクをクリックしてください！
                    <a href="{{ action('PostsController@index') }}">記事一覧画面へ</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
