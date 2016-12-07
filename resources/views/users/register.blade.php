@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3" role="main">
                @if($errors->any())
                <ul class="list-group">
                    @foreach($errors->all() as $err)
                        <li class="list-group-item list-group-item-danger">{{ $err }}</li>
                    @endforeach
                </ul>
                @endif
                {!! Form::open(['url'=>'/user/register']) !!}
                <!--  name field  -->
                <div class="form-group">
                    {!! Form::label('name','姓名:') !!}
                    {!! Form::text('name','填写姓名',['class'=>'form-control']) !!}
                </div>
                <!--  email field  -->
                <div class="form-group">
                    {!! Form::label('email','邮箱:') !!}
                    {!! Form::email('email','填写邮箱',['class'=>'form-control']) !!}
                </div>
                <!--  password field  -->
                <div class="form-group">
                    {!! Form::label('password','密码:') !!}
                    {!! Form::password('password',['class'=>'form-control']) !!}
                </div>
                <!--  password second  -->
                <div class="form-group">
                    {!! Form::label('password_confirmation','密码确认:') !!}
                    {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
                </div>

                {!! Form::submit('马上注册',['class'=>'btn btn-success form-control']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection