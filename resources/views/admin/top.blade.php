@extends('admin.layout')

{{-- メインコンテンツ --}}
@section('contets')
        <menu label="リンク">
        <a href="./user_list.html">ユーザー一覧</a><br>
        管理画面機能 1<br>
        管理画面機能 2<br>
        管理画面機能 3<br>
        管理画面機能 4<br>
        <a href="/admin/logout">ログアウト</a><br>
        </menu>
        
        <h1>管理画面</h1>
        (アクセス傾向のグラフや警告などを表示することが多い)<br>
@endsection