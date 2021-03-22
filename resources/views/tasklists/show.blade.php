@extends('layouts.app')

@section('content')

   <h1>id = {{ $tasklist->id }} のタスク詳細ページ</h1>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $tasklist->id }}</td>
        </tr>
        <tr>
            <th>タスク内容</th>
            <td>{{ $tasklist->content }}</td>
        </tr>
    </table>
<!-- ここにページ毎のコンテンツを書く -->
{{-- メッセージ編集ページへのリンク --}}
    {!! link_to_route('tasklist.edit', 'このメッセージを編集', ['tasklist' => $tasklist->id], ['class' => 'btn btn-light']) !!}
    
    

    {{-- メッセージ削除フォーム --}}
    {!! Form::model($tasklist, ['route' => ['tasklist.destroy', $tasklist->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
 
    
@endsection
