<?php
/**
 * Created by PhpStorm.
 * User: 李志鹏
 */
namespace App\Http\Controllers\Yiban;

use Curl\Curl;

class ShareController extends Controller
{
    const Prefix = "share/";

    /**
     * GET 获取当前用户动态列表
     * access_token [page] [count]
     * return {
     * "status":"success",
     * "info":{
     * "list":[
     * {
     * "yb_feedid":"动态id",
     * "yb_content":"动态内容",
     * "yb_userid":"发表者用户ID",
     * "yb_username":"发表者用户名",
     * "yb_usernick":"发表者用户昵称",
     * "yb_userhead":"发表者用户头像",
     * "yb_sendtime":"发表时间",
     * "yb_goodnum":"点赞数",
     * "yb_pitynum":"同情数",
     * "yb_replynum":"回复数",
     * "yb_share":{
     * "share_title":"分享标题",
     * "share_content":"分享内容",
     * "share_href":"分享网址",
     * "share_image":"分享图片",
     * "share_source":"分享来源"
     * }
     * },
     * ......
     * ],
     * "page":"总页码"
     * }
     * }
     */
    public function me_list()
    {
        $response = $this->get(self::Prefix . __FUNCTION__);
        if (false != $response) {
            return $this->toDynamicList($response);
        } else {
            return "error";
        }
    }

    /**
     * GET 获取指定用户动态列表
     * access_token yb_userid [page] [count]
     * return {
     * "status":"success",
     * "info":{
     * "list":[
     * {
     * "yb_feedid":"动态id",
     * "yb_content":"动态内容",
     * "yb_userid":"发表者用户ID",
     * "yb_username":"发表者用户名",
     * "yb_usernick":"发表者用户昵称",
     * "yb_userhead":"发表者用户头像",
     * "yb_sendtime":"发表时间",
     * "yb_goodnum":"点赞数",
     * "yb_pitynum":"同情数",
     * "yb_replynum":"回复数",
     * "yb_share":{
     * "share_title":"分享标题",
     * "share_content":"分享内容",
     * "share_href":"分享网址",
     * "share_image":"分享图片",
     * "share_source":"分享来源"
     * }
     * },
     * ......
     * ],
     * "page":"总页码"
     * }
     * }
     * @param $yb_userid
     * @return string
     * @internal param Request $request
     */
    public function other_list($yb_userid)
    {
        $response = $this->get(self::Prefix . __FUNCTION__, compact("yb_userid"));
        if (false != $response) {
            return $this->toDynamicList($response);
        } else {
            return "error";
        }
    }

    /**
     * GET 获取指定动态内容
     * access_token feeds_id(查询的动态id)
     * return {
     * "status":"success",
     * "info":{
     * "yb_feedid":"动态id",
     * "yb_content":"动态内容",
     * "yb_userid":"发表者用户ID",
     * "yb_username":"发表者用户名",
     * "yb_usernick":"发表者用户昵称",
     * "yb_userhead":"发表者用户头像",
     * "yb_sendtime":"发表时间",
     * "yb_goodnum":"点赞数",
     * "yb_pitynum":"同情数",
     * "yb_replynum":"回复数",
     * "yb_replylist":[
     * {
     * "reply_commid":"评论id",
     * "reply_userid":"评论用户id",
     * "reply_username":"评论用户名",
     * "reply_usernick":"评论用户昵称",
     * "reply_userhead":"评论用户头像",
     * "reply_content":"评论内容",
     * "reply_sendtime":"评论时间"
     * },
     * ......
     * ],
     * "yb_share":{
     * "share_title":"分享标题",
     * "share_content":"分享内容",
     * "share_href":"分享网址",
     * "share_image":"分享图片",
     * "share_source":"分享来源"
     * }
     * }
     * }
     * @param $feeds_id
     * @return string
     * @internal param Request $request
     */
    public function info_share($feeds_id)
    {
        $curl = new Curl();
        $access_token = $this->access_token;
        $curl->get(self::RequestPrefix . self::Prefix . __FUNCTION__, compact("access_token", "feeds_id"));
        $response = $curl->response;
        if ("error" != $response) {
            return $this->toReplyList(json_decode($response)->info);
        } else {
            return "error";
        }
    }

    /**
     * POST 发表分享动态
     * access_token content(动态内容（UTF-8编码最多1000字数）) share_title(分享标题（UTF-8编码最多50字数）) share_url(分享链接（必须带http://或https://的完整链接）) [share_image](    分享缩略图链接（必须带http://或https://的完整链接）)
     * return {
     * "status":"success",
     * "info":"返回状态"
     * }
     * //返回状态说明：true-成功、false-失败
     * @param $content
     * @param $share_title
     * @param $share_url
     * @param null $share_image
     * @return string
     * @internal param Request $request
     */
    public function send_share($content, $share_title, $share_url, $share_image = null)
    {
        if (is_null($share_image)) {
            $response = $this->post(self::Prefix . __FUNCTION__, compact("content", "share_title", "share_url"));
        } else {
            $response = $this->post(self::Prefix . __FUNCTION__, compact("content", "share_title", "share_url", "share_image"));
        }
        if (false != $response) {
            return "SUCCESS";
        } else {
            return "FAIL";
        }
    }

    /**
     * POST 对指定分享动态发表评论/回复指定评论
     * access_token feeds_id(回复的动态id) content(发送的评论内容最多500字数) [comment_id](指定动态回复的评论id)
     * return {
     * "status":"success",
     * "info":"返回状态"
     * }
     * //返回状态说明：true-成功、false-失败
     * @param $feeds_id
     * @param $content
     * @param null $comment_id
     * @return string
     * @internal param Request $request
     */
    public function send_comment($feeds_id, $content, $comment_id = null)
    {
        if (is_null($comment_id)) {
            $response = $this->post(self::Prefix . __FUNCTION__, compact("content", "feeds_id"));
        } else {
            $response = $this->post(self::Prefix . __FUNCTION__, compact("content", "feeds_id", "comment_id"));
        }
        if (false != $response) {
            return "SUCCESS";
        } else {
            return "FAIL";
        }
    }

    /**
     * GET 对指定分享动态点赞/同情
     * access_token feeds_id action(操作类型1-点赞；2-同情)
     * return {
     * "status":"success",
     * "info":"返回状态"
     * }
     * //返回状态说明：true-成功、false-失败
     * @param $feeds_id
     * @param $action
     * @return string
     * @internal param Request $request
     */
    public function praise($feeds_id, $action)
    {
        $response = $this->get(self::Prefix . __FUNCTION__, compact("feeds_id", "action"));
        if (false != $response) {
            return "SUCCESS";
        } else {
            return "FAIL";
        }
    }

    public function expressPraise($id)
    {
        return $this->praise($id, 1);
    }

    public function expressPity($id)
    {
        return $this->praise($id, 2);
    }

    public function toDynamicList($info)
    {
        $dynamics = $info->list;
        $dynamicList = [];
        foreach ($dynamics as $dynamic) {
            if (0 != count($dynamic->yb_share)) {
                $shareTitle = $dynamic->yb_share->share_title;
                $shareContent = $dynamic->yb_share->share_content;
                $shareHref = $dynamic->yb_share->share_href;
                $shareImage = $dynamic->yb_share->share_image;
                $shareSource = $dynamic->yb_share->share_source;
            } else {
                $shareTitle = $shareContent = $shareHref = $shareImage = $shareSource = null;
            }
            $dynamicList[] = [
                "fid" => $dynamic->yb_feedid,//动态id
                "content" => $dynamic->yb_content,//动态内容
                "id" => $dynamic->yb_userid,//发表者用户ID
                "name" => $dynamic->yb_username,//发表者用户名
                "nick" => $dynamic->yb_usernick,//发表者用户昵称
                "pic" => $dynamic->yb_userhead,//发表者用户头像
                "sendTime" => $dynamic->yb_sendtime,//发表时间
                "good" => $dynamic->yb_goodnum,//点赞数
                "pity" => $dynamic->yb_pitynum,//同情数
                "reply" => $dynamic->yb_replynum,//回复数
                "shareTitle" => $shareTitle,//分享标题
                "shareContent" => $shareContent,//分享内容
                "shareHref" => $shareHref,//分享网址
                "shareImage" => $shareImage,//分享图片
                "shareSource" => $shareSource//分享来源
            ];
        }
        return $dynamicList;
    }

    public function toReplyList($info)
    {
        $replies = $info->yb_replylist;
        if(0 == count($replies))return null;
        $replyList = [];
        foreach ($replies as $reply) {
            $replyList[] = [
                "cid" => $reply->reply_commid,//评论id
                "id" => $reply->reply_userid,//评论用户id
                "name" => $reply->reply_username,//评论用户名
                "nick" => $reply->reply_usernick,//评论用户昵称
                "pic" => $reply->reply_userhead,//评论用户头像
                "content" => $reply->reply_content,//评论内容
                "sendTime" => $reply->reply_sendtime//评论时间
            ];
        }
        return $replyList;
    }
}
