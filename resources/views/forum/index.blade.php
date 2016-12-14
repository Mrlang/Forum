@extends('app')
@section('content')
    <!-- 大横幅 -->
    <div class="jumbotron">
        <div class="container">
            <h1>
                Welcome to LaravelCity~
                <a class="btn btn-lg btn-primary pull-right" href="/discussions/create" role="button">发布新帖 »</a>
            </h1>
            <p>王良(2014211547),龙宪永(2014211562),陈熙(2014211560)</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main">
                @foreach( $discussions as $dis )
                    <div class="media">
                        <div class="media-left">
                            <a href="#"><img src="{{ $dis->user->avatar }}" alt="64x64" class="media-object img-circle" style="width:65px;height: 65px;"></a>
                        </div>
                        <div class="media-body">
                            <a href="/discussions/{{$dis->id}}"><h4 class="media-heading">{{ $dis->title }}</h4></a>
                            by-{{ $dis->user->name }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        alert("王良(2014211547),龙宪永(2014211562),陈熙(2014211560)");
    </script>
@stop