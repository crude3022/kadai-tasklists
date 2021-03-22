<header class="mb-4">
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
                {{-- トップページへのリンク --}}
                <a class="navbar-brand" href="/">タスクリスト</a>

                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="nav-bar">
                    <ul class="navbar-nav mr-auto"></ul>
                    <ul class="navbar-nav">
                        　{{-- メッセージ作成ページへのリンク --}}
                       {!! link_to_route('tasklist.create', '新規タスクの投稿', [], ['class' => 'btn btn-primary']) !!}
                    </ul>
                </div>
            </nav>
</header>