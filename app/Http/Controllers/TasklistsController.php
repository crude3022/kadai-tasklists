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
      /**
     *   $data = [];
     *   
     * if (\Auth::check()) { // 認証済みの場合
     *        // 認証済みユーザを取得
     *       $user = \Auth::user();
     *       // ユーザの投稿の一覧を作成日時の降順で取得
     *       // （後のChapterで他ユーザの投稿も取得するように変更しますが、現時点ではこのユーザの投稿のみ取得します）
     *       $tasklists = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
     *
     *       $data = [
     *           'user' => $user,
     *           'tasklists' => $tasklists,
     *         ];
     *   }
     */ 
        $tasklists = Task::orderBy('name','desc')->get();;

        // メッセージ一覧ビューでそれを表示
        return view('tasklists.index', [
            'tasklists' => $tasklists,
        ]);
        
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
       if (\Auth::check()){
        return view('tasklists.create', [
            'tasklist' => $tasklist,
        ]);
       }   
       return redirect('/');
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
           
            'content' => 'required|max:255',
            'status' => 'required|max:10',
            'name' => 'required|max:10',
        ]);

          // メッセージを作成
       
        $tasklist = new Task;
        $tasklist->user_id = $request->user()->id;  
        $tasklist->content = $request->content;
        $tasklist->status = $request->status;
        $tasklist->name = $request->name;
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
         if (\Auth::id() === $tasklist->user_id){
        return view('tasklists.show', [
            'tasklist' => $tasklist,
        ]);
    }
        return redirect('/');
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
        if (\Auth::id() === $tasklist->user_id){
        return view('tasklists.edit', [
            'tasklist' => $tasklist,
        ]);
    }
         return redirect('/');
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
            'content' => 'required|max:255',
            'status' => 'required|max:10',
        ]);
        // idの値でメッセージを検索して取得
        $tasklist = Task::findOrFail($id);
        // メッセージを更新
        if (\Auth::id() === $tasklist->user_id){
        $tasklist->content = $request->content;
        $tasklist->status = $request->status;
        $tasklist->save();
        }
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
        if (\Auth::id() === $tasklist->user_id){
        $tasklist->delete();
        }
        // トップページへリダイレクトさせる
        return redirect('/');
    }
    

}
