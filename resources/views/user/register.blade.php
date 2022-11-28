@extends('layout')

{{-- タイトル --}}
@section('title')(詳細画面)@endsection

{{-- メインコンテンツ --}}
@section('contets')
        <h1>ユーザ登録</h1>
            @if (session('front.user_register_success') ==true)
                ユーザを登録しました!!<br>
            @endif
            @if ($errors->any())
                <div>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
                </div>
            @endif
        <form action="/user/register" method="post">
            @csrf
            名前:<input name="user_name" value="{{ old('user_name') }}"><br> 
            email:<input name="email" value="{{ old('email') }}"><br>
            パスワード:<input name="password" type="password"><br>
            <button>登録する</button><br>
        </form>
@endsection