<?php

namespace App\Http\Controllers;

use App\Group;
use Doctrine\DBAL\Schema\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function signup(){
        return view('signup');
    }
    public function store(Request $request) {
        $message=[
            'leader_name.required'=>'名字嘞？',
            'project_name.required'=>'需要有一个项目名字噢~',
            'leader_college.required'=>'还没有选择学院',
            'leader_major.required'=>'还没有选择专业',
            'leader_number.required'=>'留个电话呗',
            'leader_qq.required'=>'没有填QQ',
            'leader_id.required'=>'告诉我们学号才能加分呀'
        ];
        $pro_count=0;
        if ($request['leader_college']=='数学与信息学院'&&$request['leader_major']!='工业工程'&&$request['leader_major']!='统计学')
            $pro_count++;
        if ($request['member1_college']=='数学与信息学院'&&$request['member1_major']!='工业工程'&&$request['member1_major']!='统计学')
            $pro_count++;
        if ($request['member2_college']=='数学与信息学院'&&$request['member2_major']!='工业工程'&&$request['member2_major']!='统计学')
            $pro_count++;
        if ($request['member3_college']=='数学与信息学院'&&$request['member3_major']!='工业工程'&&$request['member3_major']!='统计学')
            $pro_count++;
        if ($request['member_num']/2<=$pro_count&&$request['group_type']=='非专业组'){
            return back()->with('error','成员有一半或一半以上为IT类专业学生需选择专业组');
        }
        $this->validate($request,[
            'leader_name'=>'required',
            'leader_number'=>'required',
            'leader_qq'=>'required',
            'leader_id'=>'required',
            'leader_college'=>'required',
            'leader_major'=>'required',
            'project_type'=>'required',
            'project_name'=>'required',
            'group_type'=>'required',
            'member_num'=>'required',

        ],$message);
        $input = $request->all();

        $input['secret_key'] = str_random(6);
        $group = Group::create($input);

        return redirect()->action('Controller@show',$group->id)->with('status','报名成功!<br>请记住下面的操作密码：<br>'.$group->secret_key);
    }
    public function show($id){
        $group = Group::findorfail($id);
        return view('group',compact('group'));
    }
    public function edit($id){
        $group =Group::findorfail($id);
//      $group = Group::where('id',$id)->get();
        return view('edit',compact('group'));
    }
    public function update(Request $request,$id){
        $message=[
            'leader_name.required'=>'名字嘞？',
            'project_name.required'=>'需要有一个项目名字噢~',
            'leader_college.required'=>'还没有选择学院',
            'leader_major.required'=>'还没有选择专业',
            'leader_number.required'=>'留个电话呗',
            'leader_qq.required'=>'没有填QQ',
            'leader_id.required'=>'告诉我们学号才能加分呀',
            'secret'=>'操作密码不正确'
        ];
        $this->validate($request,[
            'leader_name'=>'required',
            'leader_number'=>'required',
            'leader_qq'=>'required',
            'leader_id'=>'required',
            'leader_college'=>'required',
            'leader_major'=>'required',
            'project_type'=>'required',
            'project_name'=>'required',
            'group_type'=>'required',
            'member_num'=>'required',
            'secret'=>'required',
        ],$message);
        $group = Group::findorfail($id);
        $request['secret_key']=$request['secret'];
        $group->update($request->all());
        return redirect()->action('Controller@show',$group->id)->with('status','Data updated!');
    }
    public function search(Request $request){
            $group = Group::where('leader_id',$request['id'])->firstOrFail();
            return redirect()->action('Controller@show',$group->id);
    }

    public function index(){
        $groups = Group::all();
        return view('groups',compact('groups'));
    }

}
