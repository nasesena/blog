<!--エラーメッセージを表示させる。バリデーション専用-->

@extends('layouts.app')

@section('app')

@if ($errors->any())
<section style="border: 1px red solid">
	<table style="color:red" align = "center"> 
	    <div class="alert alert-danger">
	        <th>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </th>
	    </div>
	@endif

