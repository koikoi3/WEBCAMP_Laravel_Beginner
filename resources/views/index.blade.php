@extends('layout')

{{-- メインコンテンツ --}}
@section('contets')
        <h1>ログイン</h1>
        <form action="./login" method="post">
            email:<input><br>
            パスワード:<input type="password"><br>
            <button>ログインする</button>
        </form>
@endsection