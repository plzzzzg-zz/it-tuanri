@extends('app')
@section('js')
    <script type="text/javascript" src="{!! asset('js/jquery.cxselect.js') !!}"></script>

@section('content')
    <h1>UPDATE</h1>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{Form::model($group,['url'=>'/group/'.$group->id,'method'=>'patch'])}}
    {!! Form::label('member_num','队伍人数：') !!}
    {!! Form::select('member_num',['1'=>'1','2'=>'2','3'=>'3','4'=>'4'],$group->member_num,['class'=>'form-control','onchange'=>'change_form(this.value)']) !!}
    <!--- Content Field --->
    <div class="form-group">
        {!! Form::label('project_name', '作品名称:') !!}
        {!! Form::text('project_name', null, ['class' => 'form-control','placeholder'=>'必填']) !!}
    </div>
    <!--- Content Field --->
    <div class="form-group">
        {!! Form::label('project_type', '作品类型:') !!}
        {!! Form::select('project_type', ['web_static'=>'静态展示','qingyingyong'=>'轻应用','app'=>'APP'],null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('group_type', '组队类型:') !!}
        <img src="https://www.easyicon.net/api/resizeApi.php?id=1181948&size=24" alt="" onclick="show_group_type_info()">
        <div class="panel panel-default" id="group_info" style="display: none">
            <div class="panel-body">
                成员有一半或一半以上为IT类专业学生即算为专业组
            </div>
        </div>
        {!! Form::select('group_type', ['professional'=>'专业组','unprofessional'=>'非专业组'],null, ['class' => 'form-control']) !!}
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
        <div class="form-group m" >
            {!! Form::label('leader_college','学院:') !!}
            {!! Form::select('leader_college',[''=>''],'$group->leader_college',[ 'data-first-title'=>"1", 'data-first-value'=>"1" ,'class'=>'college form-control','data-value'=>$group->learder_college]) !!}
            {!! Form::label('leader_major','专业:') !!}
            {!! Form::select('leader_major',[''=>''],null,['class'=>'major form-control','data-value'=>$group->learder_major]) !!}
            {{--<select name="leader_college" id="leader_college" class="college 2222" value={{$group->leader_college}}>--}}
            {{--</select>--}}
        </div>
        </span>
    <br>
    @if(!nullValue($group->member1_name))
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
    @endif
    @if(!nullOrEmptyString($group->member2_name))
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
    @endif
    @if(!nullOrEmptyString($group->member3_name))
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
    @endif



    <button class="btn " type="submit" >修改
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
        $(document).ready(function () {
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