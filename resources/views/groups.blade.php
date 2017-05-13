@extends('app')
@section('js')
	<style>
		table td{
			word-break: keep-all;
			white-space:nowrap;
		}
		table th{
			word-break: keep-all;
			white-space:nowrap;
		}
		
	</style>
	
@section('content')
    <h1>总组数：{{$groups->count()}}</h1>
    <hr>
    @if($groups->count()>0)
		<div style="width:100%;overflow-x:scroll;">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>作品名字</th>
                <th>作品类型</th>
                <th>队伍人数</th>
				<th>组队类型</th>
				
				<th>队长姓名</th>
				<th>队长学号</th>
				<th>队长联系方式</th>
				<th>队长QQ</th>
				<th>队长学院</th>
				<th>队长专业</th>
				
				<th>队员1姓名</th>
				<th>队员1学号</th>
				<th>队员1联系方式</th>
				<th>队员1QQ</th>
				<th>队员1学院</th>
				<th>队员1专业</th>
				
				<th>队长姓名</th>
				<th>队员2学号</th>
				<th>队员2联系方式</th>
				<th>队员2QQ</th>
				<th>队员2学院</th>
				<th>队员2专业</th>
				
				<th>队员3姓名</th>
				<th>队员3学号</th>
				<th>队员3联系方式</th>
				<th>队员3QQ</th>
				<th>队员3学院</th>
				<th>队员3专业</th>
            </tr>
            </thead>
            @foreach($groups as $group)
                <tr>
                    <td><a href="{{action('Controller@show',[$group->id])}}">{{$group->project_name}}</a></td>
                    <td>{{$group->project_type}}</td>
                    <td>{{$group->member_num}}</td>
					<td>{{$group->group_type}}</td>
					
					
                    <td>{{$group->leader_name}}</td>
                    <td>{{$group->leader_id}}</td>
					<td>{{$group->leader_number}}</td>
					<td>{{$group->leader_qq}}</td>
					<td>{{$group->leader_college}}</td>
                    <td>{{$group->leader_major}}</td>
					
                    <td>{{$group->member1_name}}</td>
                    <td>{{$group->member1_id}}</td>
					<td>{{$group->member1_number}}</td>
					<td>{{$group->member1_qq}}</td>
					<td>{{$group->member1_college}}</td>
                    <td>{{$group->member1_major}}</td>
					
					
                    <td>{{$group->member2_name}}</td>
                    <td>{{$group->member2_id}}</td>
					<td>{{$group->member2_number}}</td>
					<td>{{$group->member2_qq}}</td>
					<td>{{$group->member2_college}}</td>
                    <td>{{$group->member2_major}}</td>
					
                    <td>{{$group->member3_name}}</td>
                    <td>{{$group->member3_id}}</td>
					<td>{{$group->member3_number}}</td>
					<td>{{$group->member3_qq}}</td>
					<td>{{$group->member3_college}}</td>
                    <td>{{$group->member3_major}}</td>
					
                </tr>
                @endforeach
        </table>
		</div>
    @endif

    @stop