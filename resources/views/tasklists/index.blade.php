@extends('layouts.app')

@section('content')

<h1>タスクリスト一覧</h1>

    @if (count($tasklists) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>タイトル</th>
                    <th>タスク内容</th>
                    <th>ステータス</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasklists as $tasklist)
                <tr>
                    <td>{!! link_to_route('tasklist.show', $tasklist->id,['tasklist' => $tasklist->id])!!}</td>
                    <td>{{ $tasklist->title }}</td>
                    <td>{{ $tasklist->content }}</td>
                    <td>{{ $tasklist->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
　　
　　{{-- メッセージ作成ページへのリンク --}}
    {!! link_to_route('tasklist.create', '新規タスクの投稿', [], ['class' => 'btn btn-primary']) !!}

@endsection