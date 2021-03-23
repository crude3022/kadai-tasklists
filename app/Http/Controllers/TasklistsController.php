<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasklistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasklists = Task::all();
        
        return view('tasklists.index',[
            'tasklists' => $tasklists,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tasklist = new Task;

        // メッセージ作成ビューを表示
        return view('tasklists.create', [
            'tasklist' => $tasklist,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',   // 追加
            'content' => 'required|max:255',
            'status' => 'required|max:10',
        ]);

          // メッセージを作成
       
        $tasklist = new Task;
        $tasklist->title = $request->title;    // 追加
        $tasklist->content = $request->content;
        $tasklist->status = $request->status;
        $tasklist->save();

        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          // idの値でメッセージを検索して取得
        $tasklist = Task::findOrFail($id);

        // メッセージ詳細ビューでそれを表示
        return view('tasklists.show', [
            'tasklist' => $tasklist,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     
       // idの値でメッセージを検索して取得
        $tasklist = Task::findOrFail($id);

        // メッセージ編集ビューでそれを表示
        return view('tasklists.edit', [
            'tasklist' => $tasklist,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $request->validate([
            'title' => 'required|max:255',   // 追加
            'content' => 'required|max:255',
            'status' => 'required|max:10',
        ]);
        // idの値でメッセージを検索して取得
        $tasklist = Task::findOrFail($id);
        // メッセージを更新
        $tasklist->title = $request->title;    // 追加
        $tasklist->content = $request->content;
        $tasklist->status = $request->status;
        $tasklist->save();

        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // idの値でメッセージを検索して取得
        $tasklist = Task::findOrFail($id);
        // メッセージを削除
        $tasklist->delete();

        // トップページへリダイレクトさせる
        return redirect('/');
    }
}
