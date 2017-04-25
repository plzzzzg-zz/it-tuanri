@extends('app')
@section('content')
    <h1>总组数：{{$groups->count()}}</h1>
    <hr>
    @if($groups->count()>0)
        <table class="table table-striped">
            <thead>
            <tr>
                <th>作品名字</th>
                <th>组长</th>
                <th>组长学号</th>
            </tr>
            </thead>
            @foreach($groups as $group)
                <tr>
                    <td><a href="{{action('Controller@show',[$group->id])}}">{{$group->project_name}}</a></td>
                    <td>{{$group->leader_name}}</td>
                    <td>{{$group->leader_id}}</td>
                </tr>
                @endforeach
        </table>
    @endif

    @stop