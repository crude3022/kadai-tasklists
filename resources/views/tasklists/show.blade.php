@extends('layouts.app')

@section('content')

   @if (Auth::check())
   <h1>id = {{ $tasklist->id }} のタスク詳細ページ</h1>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $tasklist->id }}</td>
        </tr>
        <tr>
            <th>タイトル</th>
            <td>{{ $tasklist->title }}</td>
        </tr>
        <tr>
            <th>タスク内容</th>
            <td>{{ $tasklist->content }}</td>
        </tr>
        <tr>
            <th>ステータス</th>
            <td>{{ $tasklist->status }}</td>
        </tr>
    </table>
<!-- ここにページ毎のコンテンツを書く -->
{{-- メッセージ編集ページへのリンク --}}
    {!! link_to_route('tasklist.edit', 'このメッセージを編集', ['tasklist' => $tasklist->id], ['class' => 'btn btn-light']) !!}
    
    

    {{-- メッセージ削除フォーム --}}
    {!! Form::model($tasklist, ['route' => ['tasklist.destroy', $tasklist->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
    @else
     <div class="center jumbotron">
        <div class="text-center">
            <h1>タスクリスト</h1>
            {{-- ユーザ登録ページへのリンク --}}
            {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
            {!! link_to_route('login', 'Login', [], ['class' => 'btn btn-lg btn-primary']) !!}   
        </div>
    </div>
    @endif
@endsection
