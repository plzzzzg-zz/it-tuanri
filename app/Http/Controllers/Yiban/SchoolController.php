<?php
/**
 * Created by PhpStorm.
 * User: 李志鹏
 */
namespace App\Http\Controllers\Yiban;

use Curl\Curl;

class SchoolController extends Controller
{
    const Prefix = "school/";

    /**
     * 访问权限：校级权限
     * GET 获取当日用户活跃统计
     * access_token
     * return {
     * "status":"success",
     * "info":{
     * "topic_send":"发表话题数",
     * "vote_send":"发表投票数"
     * }
     * }
     */
    public function user_active()
    {
        $result = $this->get(self::Prefix . __FUNCTION__);
        if (false != $result) {
            return ["topic" => $result->topic_send, "vote" => $result->vote_send];
        } else {
            return "error";
        }
    }

    /**
     * 访问权限：校级权限
     * GET 获取行政公共群EGPA统计
     * access_token group_id(行政公共群ID)
     * return {
     * "status":"success",
     * "info":{
     * "all_egpa":"累积总EGPA",
     * "up_egpa":"昨日EGPA增量",
     * "egpa_rank":"EGPA排行榜名次"
     * }
     * }
     * @param $group_id
     * @return array|string
     */
    public function egpa($group_id)
    {
        $curl = new Curl();
        $access_token = $this->access_token;
        $curl->get(parent::RequestPrefix . self::Prefix, compact("access_token", "group_id"));
        $result = self::getResult($curl);
        if (false != $result) {
            return ["all" => $result->all_egpa, "last" => $result->up_egpa, "rank" => $result->egpa_rank];
        } else {
            return "error";
        }
    }

    /**
     * GET 获取当前应用所属开发者/可见学校其它的关联应用
     * access_token [sc_name](学校行政机构号名称（不设置代表开发者关联应用）) [page] [count]
     * return {
     * "status":"success",
     * "info":{
     * "list":[
     * {
     * "app_name":"应用名称",
     * "app_intro":"应用简介",
     * "app_small_logo":"64*64应用logo",
     * "app_big_logo":"108*108应用logo",
     * "app_visit_url":"应用地址"
     * },
     * ......
     * ],
     * "next_page":"是否下一页"
     * }
     * }
     */
    public function relate_app()
    {
        $result = $this->get(self::Prefix . __FUNCTION__);
        if (false != $result) {
            return ["topic" => $result->topic_send, "vote" => $result->vote_send];
        } else {
            return "error";
        }
    }

    /**
     * 访问权限：校级权限
     * GET 学校活动账户向指定用户发放活动网薪
     * access_token yb_userid(接收方易班用户id) award(发放网薪数)
     * return {
     * "status":"success",
     * "info":"返回状态"
     * }
     * //返回状态说明：true-成功、false-失败
     * @param $yb_userid
     * @param $award
     * @return string
     * @internal param Request $request
     */
    public function award_wx($yb_userid, $award)
    {
        $access_token = $this->access_token;
        $curl = new Curl();
        $curl->get(parent::RequestPrefix . self::Prefix . __FUNCTION__, compact("access_token", "yb_userid", "award"));
        $result = $this->getResult($curl->response);
        if (false != $result) {
            return "SUCCESS";
        } else {
            return "FAIL";
        }
    }

    /**
     * 访问权限：校级权限
     * POST 向多个用户发送学校通知
     * access_token to_uid(    接收方用户标示（批量时以半角逗号分隔，最多100个用户）) content [type:yb_uid](用户标示类型，默认易班用户ID)
     * return {
     * "status":"success",
     * "info":{
     * "success":"发送用户数",
     * "error":{
     * "错误编号":["涉及接收方用户标示"],
     * ...
     * },
     * }
     * }
     * @param $to_uid
     * @param $content
     * @return string
     * @internal param Request $request
     */
    public function notice($to_uid, $content)
    {
        $response = $this->post(self::Prefix . __FUNCTION__, compact("to_uid", "content"));
        if (false != $response) {
            return "SUCCESS";
        } else {
            return "FAIL";
        }
    }

    /**
     * 访问权限：校级权限
     * POST 发表所属学校机构号首页通知
     * client_id unix_time(Unix时间戳（单位秒，应用端服务器需要开启时间联网校准）) sig(验证签名（详情见制作说明）) title(通知标题最多50字数) content(通知内容最多10000字数)
     * return {
     * "status":"success",
     * "info":{
     * "status":"发送结果"
     * }
     * }
     * //返回状态说明：true-成功、false-失败
     *
     *
     * <?php //php范例
     * $unix_time = time(); //生成Unix时间戳
     * $app_secret = 'XXX'; //设置调用接口的应用AppSecret，在管理中心应用信息中可见
     * $sig = hash_hmac('sha256', $unix_time, $app_secret); //以Unix时间戳为内容，应用AppSecret为密钥，哈希SHA256加密
     * $sig = base64_encode($sig); //base64编码
     * ?>
     */
    public function organ_notice()
    {

    }
}
