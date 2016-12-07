@extends('app')
@section('content')
    @include('editor::head')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-1" role="main">
                {!! Form::open(['url'=>'/discussions']) !!}
                   @include('forum.disform')
                {!! Form::submit('发表',['class'=>'btn btn-primary pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop