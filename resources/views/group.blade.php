@extends('app')
@section('js')
    <script type="text/javascript" src="{!! asset('js/jquery.cxselect.js') !!}"></script>

    <title>队伍信息</title>


@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {!! session('status') !!}
        </div>
    @endif
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
        <div  class="panel panel-default" >
            <div class="panel-heading" >
                <h3 class="panel-title">
                    {{$group->leader_name}}
                    <span class="pull-right">{{$group->leader_id}}</span>
                </h3>
            </div>
            <div class="panel-body" style="display: none">
                <table class="table table-bordered">
                <tr >
                    <td >{{$group->leader_number}}</td>
                    <td >{{$group->leader_qq}}</td>
                    <td >{{$group->leader_college}}</td>
                    <td >{{$group->leader_major}}</td>
                </tr>
                </table>
            </div>
        </div>
    @if($group->member1_name!=null)
        <div  class="panel panel-default" >
            <div class="panel-heading" >
                <h3 class="panel-title">
                    {{$group->member1_name}}
                    <span class="pull-right">{{$group->member1_id}}</span>
                </h3>
            </div>
            <div class="panel-body" style="display: none">
                <table class="table table-bordered" >
                    <tr >
                        <td >{{$group->member1_number}}</td>
                        <td >{{$group->member1_qq}}</td>
                        <td >{{$group->member1_college}}</td>
                        <td >{{$group->member1_major}}</td>
                    </tr>
                </table>
            </div>
        </div>
        @endif
    @if($group->member2_name!=null)
        <div  class="panel panel-default" >
            <div class="panel-heading" >
                <h3 class="panel-title">
                    {{$group->member2_name}}
                    <span class="pull-right">{{$group->member2_id}}</span>
                </h3>
            </div>
            <div class="panel-body" style="display: none">
                <table class="table table-bordered" >
                    <tr >
                        <td >{{$group->member2_number}}</td>
                        <td >{{$group->member2_qq}}</td>
                        <td >{{$group->member2_college}}</td>
                        <td >{{$group->member2_major}}</td>
                    </tr>
                </table>
            </div>
        </div>
        @endif
    @if($group->member3_name!=null)
        <div  class="panel panel-default" >
            <div class="panel-heading" >
                <h3 class="panel-title">
                    {{$group->member3_name}}
                    <span class="pull-right">{{$group->member3_id}}</span>
                </h3>
            </div>
            <div class="panel-body" style="display: none">
                <table class="table table-bordered" >
                    <tr >
                        <td >{{$group->member3_number}}</td>
                        <td >{{$group->member3_qq}}</td>
                        <td >{{$group->member3_college}}</td>
                        <td >{{$group->member3_major}}</td>
                    </tr>
                </table>
            </div>
        </div>
        @endif

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

        $(document).ready(function () {
{{--            alert(' 密码：{{$group->secret_key}} \n 请记住它，这是修改报名信息的凭据');--}}
            $('div.panel-heading').click(function () {
                $(this).next().slideToggle();
            });
        });
    </script>
@stop
@stop
