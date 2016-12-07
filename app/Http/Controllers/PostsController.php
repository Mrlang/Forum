<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Markdown\Markdown;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use YuanChao\Editor\EndaEditor;

class PostsController extends Controller       //显示社区主题内容
{
    protected $markdown;

    public function __construct(Markdown $markdown)
    {
        $this->middleware('auth',['only'=>'create','store','edit','update']);
        $this->markdown = $markdown;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discussions = Discussion::latest()->get();
        return View('forum.index',compact('discussions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forum.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreBlogPostRequest $request)
    {
        $discussion = $request->all();
        $discussion['user_id'] = \Auth::user()->id;
        $discussion['last_user_id'] = \Auth::user()->id;
        $res = Discussion::create($discussion);
        return redirect()->action('PostsController@show',['id'=>$res->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $discussion = Discussion::findOrFail($id);
        $html = $this->markdown->markdown($discussion->body);
        return view('forum.show',compact('discussion','html'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $discussion = Discussion::findOrFail($id);
//        echo \Auth::user();//{"id":31,"name":"wangliang","avatar":"\/images\/default-image.jpg","confirm_code":"","is_confirmed":1,"email":"578423625@qq.com","created_at":"2016-04-01 05:25:08","updated_at":"2016-04-04 10:04:58"}
//        var_dump($discussion->user_id);//int 31
//        if(\Auth::user() !== $discussion->user_id)   错误的
        if(\Auth::user()->id !== $discussion->user_id)
            echo "这篇帖子不是你的哦~";//return redirect('/');
        return view('forum.edit',compact('discussion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\StoreBlogPostRequest $request, $id)
    {
        $discussion = Discussion::findOrFail($id);
        $discussion->update($request->all());
        return redirect()->action('PostsController@show',['id'=>$discussion->id]);
    }

    public function upload(){
        $data = EndaEditor::uploadImgFile('uploads');
        return json_encode($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
