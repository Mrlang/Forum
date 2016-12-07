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
                @if(Session::has('login_info'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('login_info') }}
                    </div>
                @endif
                    {!! Form::open(['url'=>'/user/login']) !!}

                    <!--  email field  -->
                    <div class="form-group">
                        {!! Form::label('email','邮箱:') !!}
                        {!! Form::email('email','邮',['class'=>'form-control']) !!}
                    </div>
                    <!--  password field  -->
                    <div class="form-group">
                        {!! Form::label('password','密码:') !!}
                        {!! Form::password('password',['class'=>'form-control']) !!}
                    </div>


                    {!! Form::submit('登 录',['class'=>'btn btn-success form-control']) !!}
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection