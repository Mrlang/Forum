<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel City</title>
    <link rel="stylesheet" href="{{ URL::asset('/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/style.css ')}}">
    <link rel="stylesheet" href="{{ URL::asset('/css/jquery.Jcrop.css') }}">

    <script src="{{ URL::asset('/js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('/js/jquery.Jcrop.min.js') }}"></script>
    <script src="{{ URL::asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('/js/jquery.form.js') }}"></script>
    {{--<script src="/js/vue.min.js"></script>--}}
    {{--<script src="/js/vue-resource.min.js"></script>--}}

    <meta id="token" name="token" value="{{ csrf_token() }}">

</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">    <!-- 导航栏 -->
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Laravel City</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="/">Home</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li>
                        <a id="dLabel" type="button" data-toggle="dropdown" aria-labelledby=""dLabel href="#" style="color:green">{{ Auth::User()->name }}</a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="/user/getImage"><i class="fa fa-user">更换头像</i></a></li>
                            <li><a href="#"><i class="fa fa-cog">更换密码</i></a></li>
                            <li><a href="#"><i class="fa fa-heart">特别感谢</i></a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/user/logout"><i class="fa fa-sign-out">退出登录</i></a></li>
                        </ul>
                    </li>
                    <li><img src="{{ Auth::user()->avatar }}" alt="" class="img-circle" width="50" height="50"></li>
                @else
                    <li><a href="/user/login/">登 录</a></li>
                    <li><a href="/user/register">注  册</a></li>
                @endif
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    @yield('content')
    {{--<script src="//cdn.bootcss.com/jquery/3.0.0-alpha1/jquery.min.js"></script>--}}
    {{--<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>--}}
</body>
</html>
