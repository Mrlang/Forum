<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Mail;
use Image;

class UsersController extends Controller
{
    public function test(){
        $user = Discussion::all();
        var_dump($user[32]->user);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(){
        return view('users.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\UserRegisterRequest $request)
    {
        $data = ['confirm_code' => str_random(48),'avatar'=>'/images/default-image.jpg'];
        $user = User::create(array_merge($request->all(),$data));
        //User::create();
        /*$subject = 'Confirm Your Email';
        $view = 'email.register';
        $this->sendTo($user,$subject,$view,$data);
        */
        if(\Auth::attempt(['email'=>$request->get('email'), 'password'=>$request->get('password'), 'is_confirmed'=>1]))
            return redirect('/');

    }

    public function confirmEmail($confirm_code){
        $user = User::where('confirm_code',$confirm_code)->first();
        if(is_null($user)){
            return redirect('/');
        }
        $user->is_confirmed = 1;
        $user->confirm_code = str_random(48);
        $user->save();
        return redirect('/user/login');
    }

    public function sendTo($user,$subject,$view,$data){
        \Mail::queue($view,$data,function($message) use($user,$subject){
            $message->to($user->email)->subject($subject);
        });
    }

    public function login(){
        return view('users.login');
    }

    public function signin(Requests\UserLoginRequest $request)
    {
        if(\Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'is_confirmed' => 1,
        ])){
            return redirect('/');
        }

        \Session::flash('login_info','密码错误或邮箱为验证(is_confirmed_code为0)');
        return redirect('user/login')->withInput();
    }

    public function logout(){
        \Auth::logout();
        return redirect('/');
    }

    public function getImage(){
        return view('users.image');
    }

    public function changeImage(Request $request){
    /*  非ajax
        $head = $request->file('headimg');//获取到键名为'headimg'的文件
        $path = 'uploads/';
        $filename = \Auth::User()->id.'_'.time().$head->getClientOriginalName();
        $head->move($path,'/'.$filename);//从临时文件移动到UPLOADS
        Image::make($path.$filename)->fit(200)->save();
        //代码剪出一块正方形并压缩200*200,如果是长方形的不剪成方形,页面头像显示椭圆形.还可以减小空间
        $loginUser = User::find(\Auth::User()->id);     //非ajax接收头像保存数据库
        $loginUser->avatar = '/'.$path.$filename;//跟新用户头像路径,前端获取今静态资源要加'/'
        $loginUser->save();
        return redirect('/user/getImage');    //非ajax传输头像
    */


    /*  ajax穿头像
        $head = $request->file('headimg');//获取到键名为'headimg'的文件
        //对传递过来的文件进行自定义规则检验
        $input = array('image'=>$head);
        $rules = array('image'=>'image');
        $validator = \Validator::make($input,$rules);
        if($validator->fails()){
            return \Response::json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray()]);
        }
        //检验结束

        $path = 'uploads/';
        $filename = \Auth::User()->id.'_'.time().$head->getClientOriginalName();
        $head->move($path,'/'.$filename);//从临时文件移动到UPLOADS
        Image::make($path.$filename)->fit(200)->save();
        $loginUser = User::find(\Auth::User()->id);
        $loginUser->avatar = '/'.$path.$filename;//跟新用户头像路径,前端获取今静态资源要加'/'
        $loginUser->save();

        return \Response::json(['success'=> true,'avatar'=>'/'.$path.$filename]);
    */


        //ajax传头像,得到后JS裁剪保存
        $head = $request->file('headimg');//获取到键名为'headimg'的文件
        //对传递过来的文件进行自定义规则检验
        $input = array('image'=>$head);
        $rules = array('image'=>'image');
        $validator = \Validator::make($input,$rules);
        if($validator->fails()){
            return \Response::json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray()]);
        }
        //检验结束

        $path = 'uploads/';
        $filename = \Auth::User()->id.'_'.time().$head->getClientOriginalName();
        $head->move($path,$filename);//从临时文件移动到UPLOADS
        Image::make($path.$filename)->fit(200)->save();//保存200大小的图片,还未剪裁


        return \Response::json(['success'=> true,'avatar'=>'/'.$path.$filename]);
    }

    public function cropImage(Request $request){
//        dd($request->all());die();//长宽高是string类型
//        $photo = $request->get('photo');//报错:NotReadableException    changeImage返回的地址是给前端的带'/'
        //去掉开头的'/'
        $photo = mb_substr($request->get('photo'),1);//一个隐藏的input框,他的name为'photo',值为头像地址
        $width = (int)$request->get('w');
        $height = (int)$request->get('h');
        $xAlign = (int)$request->get('x');
        $yAlign = (int)$request->get('y');

        Image::make($photo)->crop($width,$height,$xAlign,$yAlign)->save();//将200的剪裁成用户自定义的形状

        $user = \Auth::user();
        //$user->avatar = $photo;//然而这里存数据库的图片是要给前端的,需要'/'
        $user->avatar= $request->get('photo');
        $user->save();

        return redirect('user/getImage');
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
