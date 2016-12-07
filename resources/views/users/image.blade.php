@extends('app')
@section('content')

<div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="text-center">

                {{--非ajax上传头像使用submit按钮的默认提交行为--}}
                    {{--<img src="{{ Auth::user()->avatar }}" width="120" height="120" class="img-circle">--}}
                    {{--{!!Form::open(['url'=>'/user/changeImage','files'=>true])!!}--}}
                    {{--{!!Form::file('headimg')  !!}--}}
                    {{--<div>{!! Form::submit('上传头像',['class'=>'btn btn-success pull-right']) !!}</div>--}}
                    {{--{!!Form::close()!!}--}}


                {{--ajax上传头像不用submit按钮,使用js进行表单提交--}}
                    <div id="validation-errors"></div>
                    <img src="{{Auth::user()->avatar}}" width="120" class="img-circle" id="user-avatar" alt="">
                    {!! Form::open(['url'=>'/user/changeImage','files'=>true,'id'=>'avatar']) !!}
                    {{--表面按钮--}}
                    <div class="text-center">
                        <button type="button" class="btn btn-success avatar-button" id="upload-avatar">上传新的头像</button>
                    </div>
                    {{--实际上传文件按钮  class avatar在样式上进行了隐藏--}}
                    {!! Form::file('headimg',['class'=>'avatar','id'=>'image']) !!}
                    {!! Form::close() !!}
                    <div class="span5">
                        <div id="output" style="display:none">
                        </div>
                    </div>



                </div>
            </div>
        </div>

        {{--bootstrap模态框  开始--}}
        <div class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">.col-md-4</div>
                                <div class="col-md-4 col-md-offset-4">.col-md-4 .col-md-offset-4</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-md-offset-3">.col-md-3 .col-md-offset-3</div>
                                <div class="col-md-2 col-md-offset-4">.col-md-2 .col-md-offset-4</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">.col-md-6 .col-md-offset-3</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-9">
                                    Level 1: .col-sm-9
                                    <div class="row">
                                        <div class="col-xs-8 col-sm-6">
                                            Level 2: .col-xs-8 .col-sm-6
                                        </div>
                                        <div class="col-xs-4 col-sm-6">
                                            Level 2: .col-xs-4 .col-sm-6
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        {{--bootstrap模态框  结束--}}


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    {!! Form::open( [ 'url' => ['/crop/api'], 'method' => 'POST', 'onsubmit'=>'return checkCoords();','files' => true ] ) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: #ffffff">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">裁剪头像</h4>
                    </div>
                    <div class="modal-body">
                        <div class="content">
                            <div class="crop-image-wrapper">
                                <img src="/images/default-image.jpg" class="ui centered image" id="cropbox" >
                                <input type="hidden" id="photo" name="photo" />
                                <input type="hidden" id="x" name="x" />
                                <input type="hidden" id="y" name="y" />
                                <input type="hidden" id="w" name="w" />
                                <input type="hidden" id="h" name="h" />
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary">裁剪头像</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <script>
//        axaj传头像,不自定义裁剪
/*        $(document).ready(function() {
            var options = {
                beforeSubmit:  showRequest,
                success:       showResponse,
                dataType: 'json'
            };
            $('#image').on('change', function(){
                $('#upload-avatar').html('正在上传...');
                $('#avatar').ajaxForm(options).submit();
            });
        });
        function showRequest() {
            $("#validation-errors").hide().empty();
            $("#output").css('display','none');
            return true;
        }

        function showResponse(response)  {
            if(response.success == false)
            {
                var responseErrors = response.errors;
                $.each(responseErrors, function(index, value)
                {
                    if (value.length != 0)
                    {
                        $("#validation-errors").append('<div class="alert alert-error"><strong>'+ value +'</strong><div>');
                    }
                });
                $("#validation-errors").show();
            } else {

                $('#user-avatar').attr('src',response.avatar);
                $('#upload-avatar').html('更换新的头像');

            }
        }
*/

        $(document).ready(function() {
            var options = {
                beforeSubmit:  showRequest,
                success:       showResponse,
                dataType: 'json'
            };
            $('#image').on('change', function(){
                $('#upload-avatar').html('正在上传...');
                $('#avatar').ajaxForm(options).submit();
            });

        });
        function showRequest() {
            $("#validation-errors").hide().empty();
            $("#output").css('display','none');
            return true;
        }

        function showResponse(response)  {
            if(response.success == false)
            {
                var responseErrors = response.errors;
                $.each(responseErrors, function(index, value)
                {
                    if (value.length != 0)
                    {
                        $("#validation-errors").append('<div class="alert alert-error"><strong>'+ value +'</strong><div>');
                    }
                });
                $("#validation-errors").show();
            } else {
//                $('#user-avatar').attr('src',response.avatar);
//                $('#upload-avatar').html('更换新的头像');
                var cropBox = $("#cropbox");
                cropBox.attr('src',response.avatar); //令裁剪的头像是上传成功的新的头像
                $('#photo').val(response.avatar);//将这个隐藏框的value值设置为上传成功的头像的地址
                $('#upload-avatar').html('更换新头像');
                $('#exampleModal').modal('show');
                cropBox.Jcrop({
                    aspectRatio: 1,
                    onSelect: updateCoords,
                    setSelect: [120,120,10,10]
                });
                $('.jcrop-holder img').attr('src',response.avatar);

            }

            //添加的两个function
            function updateCoords(c)
            {
                $('#x').val(c.x);
                $('#y').val(c.y);
                $('#w').val(c.w);
                $('#h').val(c.h);
            }
            function checkCoords()
            {
                if (parseInt($('#w').val())) return true;
                alert('请选择图片.');
                return false;
            }
        }


    </script>
@stop
