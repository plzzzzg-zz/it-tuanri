@extends('app')
@section('js')
    <script type="text/javascript" src="{!! asset('js/jquery.cxselect.js') !!}"></script>
    <title>报名</title>
{{--@stop--}}
@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('status'))
        <div class="alert alert-success">
            {!! session('status') !!}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {!! session('error') !!}
        </div>
    @endif
    {{Form::open(['url'=>'/group'])}}
    {!! Form::label('member_num','队伍人数：') !!}
    {!! Form::select('member_num',['1'=>'1','2'=>'2','3'=>'3','4'=>'4'],'4',['class'=>'form-control','onchange'=>'change_form(this.value)']) !!}
    <!--- Content Field --->
    <div class="form-group">
        {!! Form::label('project_name', '作品名称:') !!}
        {!! Form::text('project_name', null, ['class' => 'form-control','placeholder'=>'必填']) !!}
    </div>
    <!--- Content Field --->
    <div class="form-group">
        {!! Form::label('project_type', '作品类型:') !!}
        {!! Form::select('project_type', ['静态展示'=>'静态展示','轻应用'=>'轻应用','App'=>'APP'],null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('group_type', '组队类型:') !!}
        <img src="https://www.easyicon.net/api/resizeApi.php?id=1181948&size=24" alt="" onclick="show_group_type_info()">
        <div class="panel panel-default" id="group_info" style="display: none">
            <div class="panel-body">
                成员有一半或一半以上为IT类专业学生即算为专业组
                <br>
                <br>
                注：①计算机科学与技术、软件工程、网络工程、信息管理与信息系统、信息与计算科学专业为IT类专业；②电子类（未分专业前）和其他专业为非IT类专业

            </div>
        </div>
        {!! Form::select('group_type', ['专业组'=>'专业组','非专业组'=>'非专业组'],null, ['class' => 'form-control']) !!}
    </div>

    <span id="leader">
        <br>
    <h2>队长:</h2>
        <hr>
        <!--- Content Field --->
        <div class="form-group">
            {!! Form::label('leader_name', '姓名:') !!}
            {!! Form::text('leader_name', null, ['class' => 'form-control','placeholder'=>'必填']) !!}
        </div>
        <!--- Content Field --->
        <div class="form-group">
            {!! Form::label('leader_number', '电话号码:') !!}
            {!! Form::text('leader_number', null, ['class' => 'form-control','placeholder'=>'必填']) !!}
        </div>
        <!--- Content Field --->
        <div class="form-group">
            {!! Form::label('leader_qq', 'QQ:') !!}
            {!! Form::text('leader_qq', null, ['class' => 'form-control','placeholder'=>'必填']) !!}
        </div>
        <!--- Content Field --->
        <div class="form-group">
            {!! Form::label('leader_id', '学号:') !!}
            {!! Form::text('leader_id', null, ['class' => 'form-control','placeholder'=>'必填']) !!}
        </div>
        <div class="form-group m"  >
            {!! Form::label('leader_college','学院:') !!}
            {!! Form::select('leader_college',[''=>''],null,['class'=>'college form-control','placeholder'=>'Choose your College']) !!}

            {!! Form::label('leader_major','专业:') !!}
            {!! Form::select('leader_major',[''=>''],null,['class'=>'major form-control','placeholder'=>'Choose your Major']) !!}
        </div>
        </span>
    <br>
    <span class="member1" style="width: 100%">
    <h2>队员 1 :</h2>
        <hr>
        <!--- Content Field --->
        <div class="form-group">
            {!! Form::label('member1_name', '姓名:') !!}
            {!! Form::text('member1_name', null, ['class' => 'form-control']) !!}
        </div>
        <!--- Content Field --->
        <div class="form-group">
            {!! Form::label('member1_number', '电话号码:') !!}
            {!! Form::text('member1_number', null, ['class' => 'form-control']) !!}
        </div>
        <!--- Content Field --->
        <div class="form-group">
            {!! Form::label('member1_qq', 'QQ:') !!}
            {!! Form::text('member1_qq', null, ['class' => 'form-control']) !!}
        </div>
        <!--- Content Field --->
        <div class="form-group">
            {!! Form::label('member1_id', '学号:') !!}
            {!! Form::text('member1_id', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group m" >
            {!! Form::label('member1_college','学院:') !!}
            {!! Form::select('member1_college',[''=>''],null,['class'=>'college form-control','placeholder'=>'Choose your College']) !!}

            {!! Form::label('member1_major','专业:') !!}
            {!! Form::select('member1_major',[''=>''],null,['class'=>'major form-control','placeholder'=>'Choose your Major']) !!}
        </div>
        </span>
    <br>
    <span id="member2"class="member2"style="width: 100%" >
    <h2>队员 2 :</h2>
        <hr>
        <!--- Content Field --->
        <div class="form-group">
            {!! Form::label('member2_name', '姓名:') !!}
            {!! Form::text('member2_name', null, ['class' => 'form-control']) !!}
        </div>
        <!--- Content Field --->
        <div class="form-group">
            {!! Form::label('member2_number', '电话号码:') !!}
            {!! Form::text('member2_number', null, ['class' => 'form-control']) !!}
        </div>
        <!--- Content Field --->
        <div class="form-group">
            {!! Form::label('member2_qq', 'QQ:') !!}
            {!! Form::text('member2_qq', null, ['class' => 'form-control']) !!}
        </div>
        <!--- Content Field --->
        <div class="form-group">
            {!! Form::label('member2_id', '学号:') !!}
            {!! Form::text('member2_id', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group m" >
            {!! Form::label('member2_college','学院:') !!}
            {!! Form::select('member2_college',[''=>''],null,['class'=>'college form-control','placeholder'=>'Choose your College']) !!}

            {!! Form::label('member2_major','专业:') !!}
            {!! Form::select('member2_major',[''=>''],null,['class'=>'major form-control','placeholder'=>'Choose your Major']) !!}
        </div>
        </span>
    <br>
    <span id="member3" class="member3"style="width: 100%">
    <h2>队员 3 :</h2>
        <hr>
        <!--- Content Field --->
        <div class="form-group">
            {!! Form::label('member3_name', '姓名:') !!}
            {!! Form::text('member3_name', null, ['class' => 'form-control']) !!}
        </div>
        <!--- Content Field --->
        <div class="form-group">
            {!! Form::label('member3_number', '电话号码:') !!}
            {!! Form::text('member3_number', null, ['class' => 'form-control']) !!}
        </div>
        <!--- Content Field --->
        <div class="form-group">
            {!! Form::label('member3_qq', 'QQ:') !!}
            {!! Form::text('member3_qq', null, ['class' => 'form-control']) !!}
        </div>
        <!--- Content Field --->
        <div class="form-group">
            {!! Form::label('member3_id', '学号:') !!}
            {!! Form::text('member3_id', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group m"  >
            {!! Form::label('member3_college','学院:') !!}
            {!! Form::select('member3_college',[''=>''],null,['class'=>'college form-control','placeholder'=>'Choose your College']) !!}

            {!! Form::label('member3_major','专业:') !!}
            {!! Form::select('member3_major',[''=>''],null,['class'=>'major form-control','placeholder'=>'Choose your Major']) !!}
        </div>
        </span>



        <button class="btn " type="submit" >submit
        </button>
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
    </script>
    @stop
@stop