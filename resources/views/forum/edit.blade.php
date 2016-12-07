@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" role="main">
                {!! Form::model($discussion,['method'=>'patch','url'=>'/discussions/'.$discussion->id] )!!}
                @include('forum.disform')
                {!! Form::submit('提交修改',['class'=>'btn btn-primary pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
