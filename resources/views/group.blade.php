@extends('app')
@section('js')
    <script type="text/javascript" src="{!! asset('js/jquery.cxselect.js') !!}"></script>
    <style>
        #project_name{
            readonly:"readonly"!important;
        }
    </style>
    <title>队伍信息</title>

@section('content')
    <h1>{{$group->project_name}} <span class="pull-right"><a href="{!! url('/group/'.$group->id.'/edit') !!}"}><button class="btn" type="button" >前往修改
    </button></a></span></h1>
    <hr>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <ul class="list-group">
            <li class="list-group-item ">人数
            <span class="badge">{{$group->member_num}}</span></li>
        </ul>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    作品类型:
                </h3>
            </div>
            <div class="panel-body">
                {{$group->project_type}}
            </div>
        </div>
        <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        组队类型:
                    </h3>
                </div>
                <div class="panel-body">
                    {{$group->group_type}}
                </div>
            </div>

        <br>
    <h2>成员信息:</h2>
        <hr>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    {{$group->leader_name}}
                    <span class="pull-right">{{$group->leader_id}}</span>
                </h3>
            </div>
            <div class="panel-body">
                {{$group->group_type}}
            </div>
        </div>
        {{--<!--- Content Field --->--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('leader_name', '姓名:') !!}--}}
            {{--{!! Form::text('leader_name', null, ['class' => 'form-control','placeholder'=>'必填']) !!}--}}
        {{--</div>--}}
        {{--<!--- Content Field --->--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('leader_number', '电话号码:') !!}--}}
            {{--{!! Form::text('leader_number', null, ['class' => 'form-control','placeholder'=>'必填']) !!}--}}
        {{--</div>--}}
        {{--<!--- Content Field --->--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('leader_qq', 'QQ:') !!}--}}
            {{--{!! Form::text('leader_qq', null, ['class' => 'form-control','placeholder'=>'必填']) !!}--}}
        {{--</div>--}}
        {{--<!--- Content Field --->--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('leader_id', '学号:') !!}--}}
            {{--{!! Form::text('leader_id', null, ['class' => 'form-control','placeholder'=>'必填']) !!}--}}
        {{--</div>--}}
        {{--<div class="form-group m" >--}}
            {{--{!! Form::label('leader_college','学院:') !!}--}}
            {{--{!! Form::select('leader_college',[''=>''],'$group->leader_college',[ 'data-first-title'=>"1", 'data-first-value'=>"1" ,'class'=>'college form-control','data-value'=>$group->learder_college]) !!}--}}
            {{--{!! Form::label('leader_major','专业:') !!}--}}
            {{--{!! Form::select('leader_major',[''=>''],null,['class'=>'major form-control','data-value'=>$group->learder_major]) !!}--}}
            {{--<select name="leader_college" id="leader_college" class="college 2222" value={{$group->leader_college}}>--}}
            {{--</select>--}}
        {{--</div>--}}
    {{--<br>--}}
    {{--@if(!nullValue($group->member1_name))--}}
        {{--<span class="member1" style="width: 100%">--}}
    {{--<h2>队员 1 :</h2>--}}
        {{--<hr>--}}
            {{--<!--- Content Field --->--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('member1_name', '姓名:') !!}--}}
            {{--{!! Form::text('member1_name', null, ['class' => 'form-control']) !!}--}}
        {{--</div>--}}
            {{--<!--- Content Field --->--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('member1_number', '电话号码:') !!}--}}
            {{--{!! Form::text('member1_number', null, ['class' => 'form-control']) !!}--}}
        {{--</div>--}}
            {{--<!--- Content Field --->--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('member1_qq', 'QQ:') !!}--}}
            {{--{!! Form::text('member1_qq', null, ['class' => 'form-control']) !!}--}}
        {{--</div>--}}
            {{--<!--- Content Field --->--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('member1_id', '学号:') !!}--}}
            {{--{!! Form::text('member1_id', null, ['class' => 'form-control']) !!}--}}
        {{--</div>--}}
        {{--<div class="form-group m" >--}}
            {{--{!! Form::label('member1_college','学院:') !!}--}}
            {{--{!! Form::select('member1_college',[''=>''],null,['class'=>'college form-control','placeholder'=>'Choose your College']) !!}--}}

            {{--{!! Form::label('member1_major','专业:') !!}--}}
            {{--{!! Form::select('member1_major',[''=>''],null,['class'=>'major form-control','placeholder'=>'Choose your Major']) !!}--}}
        {{--</div>--}}
        {{--</span>--}}
        {{--<br>--}}
    {{--@endif--}}
    {{--@if(!nullOrEmptyString($group->member2_name))--}}
        {{--<span id="member2"class="member2"style="width: 100%" >--}}
    {{--<h2>队员 2 :</h2>--}}
        {{--<hr>--}}
            {{--<!--- Content Field --->--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('member2_name', '姓名:') !!}--}}
            {{--{!! Form::text('member2_name', null, ['class' => 'form-control']) !!}--}}
        {{--</div>--}}
            {{--<!--- Content Field --->--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('member2_number', '电话号码:') !!}--}}
            {{--{!! Form::text('member2_number', null, ['class' => 'form-control']) !!}--}}
        {{--</div>--}}
            {{--<!--- Content Field --->--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('member2_qq', 'QQ:') !!}--}}
            {{--{!! Form::text('member2_qq', null, ['class' => 'form-control']) !!}--}}
        {{--</div>--}}
            {{--<!--- Content Field --->--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('member2_id', '学号:') !!}--}}
            {{--{!! Form::text('member2_id', null, ['class' => 'form-control']) !!}--}}
        {{--</div>--}}
        {{--<div class="form-group m" >--}}
            {{--{!! Form::label('member2_college','学院:') !!}--}}
            {{--{!! Form::select('member2_college',[''=>''],null,['class'=>'college form-control','placeholder'=>'Choose your College']) !!}--}}

            {{--{!! Form::label('member2_major','专业:') !!}--}}
            {{--{!! Form::select('member2_major',[''=>''],null,['class'=>'major form-control','placeholder'=>'Choose your Major']) !!}--}}
        {{--</div>--}}
        {{--</span>--}}
        {{--<br>--}}
    {{--@endif--}}
    {{--@if(!nullOrEmptyString($group->member3_name))--}}
        {{--<span id="member3" class="member3"style="width: 100%">--}}
    {{--<h2>队员 3 :</h2>--}}
        {{--<hr>--}}
            {{--<!--- Content Field --->--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('member3_name', '姓名:') !!}--}}
            {{--{!! Form::text('member3_name', null, ['class' => 'form-control']) !!}--}}
        {{--</div>--}}
            {{--<!--- Content Field --->--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('member3_number', '电话号码:') !!}--}}
            {{--{!! Form::text('member3_number', null, ['class' => 'form-control']) !!}--}}
        {{--</div>--}}
            {{--<!--- Content Field --->--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('member3_qq', 'QQ:') !!}--}}
            {{--{!! Form::text('member3_qq', null, ['class' => 'form-control']) !!}--}}
        {{--</div>--}}
            {{--<!--- Content Field --->--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('member3_id', '学号:') !!}--}}
            {{--{!! Form::text('member3_id', null, ['class' => 'form-control']) !!}--}}
        {{--</div>--}}
        {{--<div class="form-group m"  >--}}
            {{--{!! Form::label('member3_college','学院:') !!}--}}
            {{--{!! Form::select('member3_college',[''=>''],null,['class'=>'college form-control','placeholder'=>'Choose your College']) !!}--}}

            {{--{!! Form::label('member3_major','专业:') !!}--}}
            {{--{!! Form::select('member3_major',[''=>''],null,['class'=>'major form-control','placeholder'=>'Choose your Major']) !!}--}}
        {{--</div>--}}
        {{--</span>--}}
    {{--@endif--}}




    {{Form::close()}}
@stop
@section('js-2')
    <script>
        (function () {
            var urlMajor='{!! asset('js/Major.min.json') !!}';
            $.cxSelect.defaults.url = urlMajor;
            $('div.m').cxSelect({
                selects:['college','major'],
                required:    true
            });
        })();
    </script>
    <script>
        function change_form(num) {
            if(num==1) {
                $('span.member1').slideUp();
                $('span.member2').slideUp();
                $('span.member3').slideUp();
            }
            if(num==2){
                $('span.member1').slideDown();
                $('span.member2').slideUp();
                $('span.member3').slideUp();
            }
            if(num==3){
                $('span.member1').slideDown();
                $('span.member2').slideDown();
                $('span.member3').slideUp();
            }
            if(num==4){
                $('span.member1').slideDown();
                $('span.member2').slideDown();
                $('span.member3').slideDown();
            }
        }
        function show_group_type_info() {
            $('#group_info').slideToggle();
        }
        $(document).ready(function () {
            alert(' 密码：{{$group->secret_key}} \n 请记住它，这是修改报名信息的凭据');


//            $('#leader_college').filter()
            {{--document.getElementsByName('leader_college').value = "{{$group->leader_college}}";--}}
            //            $('#leader_college option:last').attr('selected',true);
            $('#leader_college ').append("<option selected=true value = '{{$group->leader_college}}'>{{$group->leader_college}}</option>");
            $('#leader_major ').append("<option selected=true value = '{{$group->leader_major}}'>{{$group->leader_major}}</option>");
            $('#member1_college ').append("<option selected=true value = '{{$group->member1_college}}'>{{$group->member1_college}}</option>");
            $('#member1_major ').append("<option selected=true value = '{{$group->member1_major}}'>{{$group->member1_major}}</option>");
            $('#member2_college ').append("<option selected=true value = '{{$group->member2_college}}'>{{$group->member2_college}}</option>");
            $('#member2_major ').append("<option selected=true value = '{{$group->member2_major}}'>{{$group->member2_major}}</option>");
            $('#member3_college ').append("<option selected=true value = '{{$group->member3_college}}'>{{$group->member3_college}}</option>");
            $('#member3_major ').append("<option selected=true value = '{{$group->member3_major}}'>{{$group->member3_major}}</option>");
            {{--$("#leader_college option[value='{{$group->leader_college}}']").css('color','red');--}}
            //            alert('done');
        });
    </script>
@stop
@stop
