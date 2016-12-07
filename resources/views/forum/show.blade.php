@extends('app')
@section('content')
        <!-- 大横幅 -->
<div class="jumbotron">
    <div class="container">
        <div class="container">
            <div class="media">
                <div class="media-left">
                    <a href="#"><img src="{{ $discussion->user->avatar }}" alt="64x64" class="media-object img-circle" style="width:65px;height: 65px;"></a>
                </div>
                <div class="media-body">
                    @if(Auth::check() && Auth::user()->id==$discussion->user_id)
                    <h4 class="media-heading">{{ $discussion->title }}<a class="btn btn-lg btn-primary pull-right" href="/discussions/{{ $discussion->id }}/edit" role="button">修改帖子</a>
                    </h4>
                    @endif
                    by-{{ $discussion->user->name }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-9" role="main" id="post">{{--宽度 9宽--}}
{{--            {{ $discussion->body }}--}}
            {!! $html !!}
        <hr>
        <h3 style="color:#ffb774">Comments:</h3>
        @foreach($discussion->getCom as $comment)
            <div class="media">
            <div class="media-left">
                <a href="#"><img src="{{ $comment->user->avatar }}" class="media-object img-circle" alt="64x64" style="width:65px;height: 65px;"></a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">{{ $comment->user->name }}</h4>
                {{ $comment->body }}
            </div>
            </div>
        @endforeach
            {{--<div class="media" v-for="comment in comments">--}}
                {{--<div class="media-left">--}}
                    {{--<a href="#"><img src="@{{ comment.avatar }}" class="media-object img-circle" alt="64x64" style="width:65px;height: 65px;"></a>--}}
                {{--</div>--}}
                {{--<div class="media-body">--}}
                    {{--<h4 class="media-heading">@{{ comment.name }}</h4>--}}
                    {{--@ {{ $comment.body }}--}}
                {{--</div>--}}
            {{--</div>--}}
        <hr>
        @if(Auth::check())
        {!! Form::open(['url'=>'/comments','v-on:submit'=>'onSubmitForm']) !!}
            {!! Form::hidden('discussion_id',$discussion->id) !!}
            <div class="form-group">
                {!! Form::label('body','说点什么... ...') !!}
                {!! Form::textarea('body',null,['class'=>'form-control','v-model'=>'newComment.body']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('发表评论',['class'=>'btn btn-primary pull-right']) !!}
            </div>
        {!! Form::close() !!}
        @else
                <a href="/user/login" class="btn btn-block btn-success">登录参与评论</a>
        @endif
        </div>
    </div>
</div>
<script>
    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
    new Vue({
        el:'#post',
        data:{
            comments:[],
            newComment:{
                name:'{{Auth::User()->name}}'   ,
                avatar:'{{Auth::User()->avatar}}',
                body:''
            },
            newPost:{
                discussion_id:'{{$discussion->id}}',
                user_id:'{{Auth::User()->id}}',
                body:''
            }
        },
        methods:{
            onSubmitForm:function(e){
                e.preventDefault();
                var comment = this.newComment;
                var post  = this.newPost;
                post.body = comment.body; //赋上body值
                this.$http.post('/comment',post,function(){  //想后端发送数据
                    this.comments.push(comment);
                });
                this.newComment = {  //发送数据过后,清空输入框
                    name:'{{Auth::User()->name}}',
                    avatar:'{{Auth::User()->avatar}}',
                    body:''
                };
            }
        },
    })
</script>

@stop