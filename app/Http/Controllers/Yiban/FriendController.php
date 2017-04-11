<?php
/**
 * Created by PhpStorm.
 * User: 李志鹏
 */
namespace App\Http\Controllers\Yiban;

use Illuminate\Http\Request;

class FriendController extends Controller
{
    const Prefix = "friend/";

    /**
     * GET 获取当前用户好友列表
     * access_token [page] [count]
     * return {
     * "status":"success",
     * "info":{
     * "list":[
     * {
     * "yb_userid":"好友用户id",
     * "yb_username":"好友用户名",
     * "yb_usernick":"好友用户昵称",
     * "yb_sex":"好友性别",
     * "yb_userhead":"好友用户头像",
     * "yb_useractive":"好友用户在线率"
     * },
     * ......
     * ],
     * "num":"好友总数"
     * }
     * }
     */
    public function me_list()
    {
        $response = $this->get(self::Prefix . __FUNCTION__);
        return $this->getFriendList($response);
    }

    /**
     * GET 当前用户与指定用户是否为好友关系
     * access_token yb_friend_uid(待检测的易班用户ID)
     * return {
     * "status":"success",
     * "info":"关系结果"
     * }
     * //返回状态说明：true-是、false-否
     * @param $friend
     * @return \Illuminate\Http\RedirectResponse|string
     * @internal param Request $request
     */
    public function check($friend)
    {
        return $this->isOrDel(__FUNCTION__, $friend);
    }

    /**
     * GET 获取推荐好友列表
     * access_token [count]
     * return {
     * "status":"success",
     * "info":{
     * "list":[
     * {
     * "yb_userid":"好友用户id",
     * "yb_username":"好友用户名",
     * "yb_usernick":"好友用户昵称",
     * "yb_sex":"好友性别",
     * "yb_userhead":"好友用户头像"
     * },
     * ......
     * ]  }
     * }
     */
    public function recommend()
    {
        $response = $this->get(self::Prefix . __FUNCTION__);
        return $this->getFriendList($response);
    }

    /**
     * POST 发送好友申请
     * access_token to_yb_uid(接收方易班用户ID) [content](申请理由最多50字数)
     * return {
     * "status":"success",
     * "info":"发送结果"
     * }
     * //返回状态说明：true-成功、false-失败
     * @param Request $request
     * @return string
     * @internal param $to_yb_uid
     * @internal param $content
     * @internal param Request $request
     */
    public function apply(Request $request)
    {
        $to_yb_uid = $request->input('friend');
        $content = $request->input('content', '我想加您为好友。');
        return $this->post(parent::RequestPrefix . self::Prefix . __FUNCTION__, compact("to_yb_uid", "content"));
    }

    /**
     * GET 删除指定好友
     * access_token yb_friend_uid
     * return {
     * "status":"success",
     * "info":"处理结果"
     * }
     * //返回状态说明：true-成功、false-失败
     * @param $yb_friend_uid
     * @return \Illuminate\Http\RedirectResponse
     * @internal param Request $request
     */
    public function remove($yb_friend_uid)
    {
        return $this->isOrDel(__FUNCTION__, $yb_friend_uid);
    }

    protected function isOrDel($target, $yb_friend_uid)
    {
        return $this->get(parent::RequestPrefix . self::Prefix . $target, compact("access_token", "yb_friend_uid"));
    }

    protected function getFriendList($friends)
    {
        $friends = $friends->list;
        if (0 == count($friends)) return null;
        $friendList = [];
        foreach ($friends as $friend) {
            $active = isset($friend->yb_useractive) ? $friend->yb_useractive : null;
            $friendList[] = [
                "id" => $friend->yb_userid,
                "name" => $friend->yb_username,
                "nick" => $friend->yb_usernick,
                "sex" => $friend->yb_sex,
                "pic" => $friend->yb_userhead,
                "active" => $active
            ];
        }
        return $friendList;
    }

}
