<?php
/**
 * Created by PhpStorm.
 * User: 李志鹏
 */
namespace App\Http\Controllers\Yiban;

class UserController extends Controller
{
    const Prefix = "user/";

    /**
     * GET 获取当前用户基本信息
     * access_token
     * return {
     * "status":"success",
     * "info":{
     * "yb_userid":"易班用户id",
     * "yb_username":"用户名",
     * "yb_usernick":"用户昵称",
     * "yb_sex":"性别",
     * "yb_money":"持有网薪",
     * "yb_exp":"经验值",
     * "yb_userhead":"用户头像",
     * "yb_schoolid":"所在学校id",
     * "yb_schoolname":"所在学校名称"
     * }
     * }
     */
    public function me()
    {
        $response = $this->get(self::Prefix . __FUNCTION__);
        if (false != $response) {
            return [
                "id" => $response->yb_userid,
                "name" => $response->yb_username,
                "nick" => $response->yb_usernick,
                "sex" => $response->yb_sex,
                "money" => $response->yb_money,
                "exp" => $response->yb_exp,
                "pic" => $response->yb_userhead,
                "sid" => $response->yb_schoolid,
                "sname" => $response->yb_schoolname,
            ];
        } else {
            return "error";
        }
    }

    /**
     * GET 获取指定用户基本信息
     * access_token yb_userid
     * return {
     * "status":"success",
     * "info":{
     * "yb_userid":"易班用户id",
     * "yb_username":"用户名",
     * "yb_usernick":"用户昵称",
     * "yb_sex":"性别",
     * "yb_userhead":"用户头像",
     * "yb_schoolid":"所在学校id",
     * "yb_schoolname":"所在学校名称"
     * }
     * }
     * @param $yb_userid
     * @return array|string
     */
    public function other($yb_userid)
    {
        $response = $this->get(self::Prefix . __FUNCTION__, compact("yb_userid"));;
        if (false != $response) {
            return [
                "id" => $response->yb_userid,
                "name" => $response->yb_username,
                "nick" => $response->yb_usernick,
                "sex" => $response->yb_sex,
                "pic" => $response->yb_userhead,
                "schoolId" => $response->yb_schoolid,
                "school" => $response->yb_schoolname,
            ];
        } else {
            return "error";
        }
    }

    /**
     * 访问权限：校级权限、合作权限
     * GET 获取当前用户实名信息
     * access_token
     * return {
     * "status":"success",
     * "info":{
     * "yb_userid":"易班用户id",
     * "yb_username":"用户名",
     * "yb_usernick":"用户昵称",
     * "yb_sex":"性别",
     * "yb_money":"持有网薪",
     * "yb_exp":"经验值",
     * "yb_userhead":"用户头像",
     * "yb_schoolid":"所在学校id",
     * "yb_schoolname":"所在学校名称",
     * "yb_realname":"真实姓名",
     * "yb_studentid":"学校首选认证类型编号",//如对认证信息的类型敏感，该字段建议使用user/verify_me接口代替
     * "yb_identity":"用户身份"
     * }
     * }
     */
    public function real_me()
    {
        $response = $this->get(self::Prefix . __FUNCTION__);
        if (false != $response) {
            return [
                "id" => $response->yb_userid,
                "name" => $response->yb_username,
                "nick" => $response->yb_usernick,
                "sex" => $response->yb_sex,
                "money" => $response->yb_money,
                "exp" => $response->yb_exp,
                "pic" => $response->yb_userhead,
                "sid" => $response->yb_schoolid,
                "sname" => $response->yb_schoolname,
                "realName" => $response->yb_realname,
                "studentId" => $response->yb_studentid,
                "identity" => $response->yb_identity
            ];
        } else {
            return "error";
        }
    }

    /**
     * 访问权限：校级权限
     * GET 获取当前用户校方认证信息
     * access_token
     * return {
     * "status":"success",
     * "info":{
     * "yb_userid":"易班用户id",
     * "yb_realname":"真实姓名",
     * "yb_schoolid":"所在学校id",
     * "yb_schoolname":"所在学校名称",
     * "yb_studentid":"学号",
     * "yb_examid":"准考证号",
     * "yb_admissionid":"录取通知编号",
     * "yb_employid":"工号"
     * }
     * }
     */
    public function verify_me()
    {
        $response = $this->get(self::Prefix . __FUNCTION__);
        if (false != $response) {
            return [
                "id" => $response->yb_userid,
                "realName" => $response->yb_realname,
                "schoolId" => $response->yb_schoolid,
                "schoolName" => $response->yb_schoolname,
                "studentId" => $response->yb_studentid,
                "examId" => $response->yb_examid,
                "admissionId" => $response->yb_admissionId,
                "employId" => $response->yb_employid
            ];
        } else {
            return "error";
        }
    }

    /**
     * GET 指定用户是否实名认证
     * access_token yb_userid
     * return{
     * "status":"success",
     * "info":"验证结果"
     * }
     * @param $yb_userid
     * @return string
     */
    public function is_real($yb_userid)
    {
        $response = $this->get(self::Prefix . __FUNCTION__, compact("yb_userid"));
        if (false != $response) {
            return "SUCCESS";
        } else {
            return "error";
        }
    }

    /**
     * 访问权限：高级权限、校级权限、合作权限
     * GET 当前用户是否校方认证
     * access_token school_name verify_key verify_value:{student_id(学号) exam_id(准考证号) admission_id(录取通知编号) employ_id(工号)}
     * return {
     * "status":"success",
     * "info":{
     * "sure_schoolname":"系统核实的学校名称",
     * "result":"验证结果"
     * }
     * }
     * //返回状态说明：true-是、false-否
     */
    public function is_verify()
    {

    }

    /**
     * 访问权限：校级权限
     * POST 当前用户完成校方认证
     * access_token school_name real_name verify_key{student_id exam_id admission_id employ_id} verify_value
     * return {
     * "status":"success",
     * "info":"认证结果"
     * }
     * //返回状态说明：true-是、false-否
     */
    public function check_verify()
    {

    }

}
