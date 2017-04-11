<?php
/**
 * Created by PhpStorm.
 * User: 李志鹏
 */
namespace App\Http\Controllers\Yiban;

use Illuminate\Http\Request;

class GroupController extends Controller
{
    const Prefix = "group/";


    /**
     * GET 获取当前用户已加入的公共群
     * access_token [page] [count]
     * return {
     * "status":"success",
     * "info":{
     * "public_group":[
     * {
     * "group_id":"群ID",
     * "group_name":"群名称",
     * "group_icon":"群图标",
     * "group_type":"群类型",
     * "adm_uid":"群创建者用户ID",
     * "adm_nick":"群创建者用户昵称",
     * "group_member":"群成员数"
     * },
     * ......
     * ],
     * "num":"群总数"
     * }
     * }
     *
     */
    public function public_group()
    {
        if (false != ($response = $this->get(self::Prefix . __FUNCTION__))) {
            return $this->toGroupList($response, __FUNCTION__);
        } else {
            return "error";
        }
    }

    /**
     * GET   获取当前用户已加入的机构群
     * access_token [page] [count]
     * return {
     * "status":"success",
     * "info":{
     * "organ_group":[
     * {
     * "group_id":"群ID",
     * "group_name":"群名称",
     * "group_icon":"群图标",
     * "group_type":"群类型",
     * "adm_uid":"群创建者用户ID",
     * "adm_nick":"群创建者用户昵称",
     * "group_member":"群成员数"
     * },
     * ......
     * ],
     * "num":"群总数"
     * }
     * }
     */
    public function organ_group()
    {
        if (false != ($response = $this->get(self::Prefix . __FUNCTION__))) {
            return $this->toGroupList($response, __FUNCTION__);
        } else {
            return "error";
        }
    }

    /**
     * GET 获取当前用户创建的机构群/公共群
     * access_token [page] [count]
     * return {
     * "status":"success",
     * "info":{
     * "group":[
     * {
     * "group_id":"群ID",
     * "group_name":"群名称",
     * "group_icon":"群图标",
     * "group_type":"群类型",
     * "adm_uid":"群创建者用户ID",
     * "adm_nick":"群创建者用户昵称",
     * "group_member":"群成员数"
     * },
     * ......
     * ],
     * "num":"群总数"
     * }
     * }
     */
    public function my_group()
    {
        if (false != ($response = $this->get(self::Prefix . __FUNCTION__))) {
            return $this->toGroupList($response, "group");
        } else {
            return "error";
        }
    }

    /**
     * GET 获取指定机构群/公共群信息
     * access_token group_id(群ID)
     * return {
     * "status":"success",
     * "info":{
     * "group_id":"群ID",
     * "group_name":"群名称",
     * "group_icon":"群图标",
     * "group_type":"群类型",
     * "adm_uid":"群创建者用户ID",
     * "adm_nick":"群创建者用户昵称",
     * "group_member":"群成员数",
     * "group_notice":[
     * {
     * "topic_id":"最新公告话题ID",
     * "topic_title":"公告标题",
     * "topic_content":"公告内容",
     * "create_time":"发表时间"
     * },
     * ......
     * ]
     * }
     * }
     * //group_notice最新公告列表，仅group_type为公共群时有效，显示最新5条公告
     * @param $group_id
     * @return array|string
     */
    public function group_info($group_id)
    {
        $response = $this->get(self::Prefix . __FUNCTION__, $group_id);
        if (false != $response) {
            return ["gid" => $response->group_id,
                "name" => $response->group_name,
                "icon" => $response->group_icon,
                "type" => $response->group_type,
                "id" => $response->adm_uid,
                "nick" => $response->adm_nick,
                "num" => $response->group_memeber,
                "notice" => $response->group_notice
            ];
        } else {
            return "error";
        }
    }

    /**
     * GET 获取指定机构群/公共群成员列表
     * access_token group_id [page] [count]
     * return {
     * "status":"success",
     * "info":{
     * "list":[
     * {
     * "member_uid":"群成员用户ID",
     * "member_nick":"群成员用户昵称",
     * "member_head":"群成员用户头像",
     * "member_remark":"当前用户附加的好友备注"
     * },
     * ......
     * ]
     * }
     * }
     * @param $group_id
     * @return array|string
     */
    public function group_member($group_id)
    {
        $response = $this->get(self::Prefix . __FUNCTION__, $group_id);
        if (false != $response) {
            return $this->toMemberList($response);
        } else {
            return "error";
        }
    }

    /**
     * GET 获取指定机构群/公共群话题列表
     * access_token group_id [page] [count] [order(排序方式（默认1，1-发表时间倒序；2-最后评论时间倒序；3-回帖数倒序）)]
     * return {
     * "status":"success",
     * "info":{
     * "list":[
     * {
     * "topic_id":"话题ID",
     * "topic_title":"话题标题",
     * "pub_uid":"发表者用户ID",
     * "pub_nick":"发表者用户昵称",
     * "pub_head":"发表者用户头像",
     * "reply_count":"回复评论数",
     * "topic_content":"话题内容",
     * "create_time":"发表时间",
     * "reply_time":"最后评论时间"
     * },
     * ......
     * ]
     * }
     * }
     * @param $group_id
     * @return string
     */
    public function group_topic($group_id)
    {
        $response = $this->get(self::Prefix . __FUNCTION__, $group_id);
        if (false != $response) {
            return $this->toTopicList($response);
        } else {
            return "error";
        }
    }

    /**
     * GET 获取指定机构号板块话题列表
     * access_token organ_id [page] [count] [item(完整板块名称默认全部板块)] [order]
     * return {
     * "status":"success",
     * "info":{
     * "list":[
     * {
     * "topic_id":"话题ID",
     * "topic_title":"话题标题",
     * "pub_uid":"发表者用户ID",
     * "pub_nick":"发表者用户昵称",
     * "pub_head":"发表者用户头像",
     * "reply_count":"回复评论数",
     * "topic_content":"话题内容",
     * "create_time":"发表时间",
     * "reply_time":"最后评论时间"
     * },
     * ......
     * ]
     * }
     * }
     * @param $organ_id
     * @return bool
     */
    public function organ_topic($organ_id)
    {
        $response = $this->get(self::Prefix . __FUNCTION__, null, $organ_id);
        if (false != $response) {
            return $this->toTopicList($response);
        } else {
            return "error";
        }
    }

    /**
     * GET 获取当前用户发表的话题列表
     * access_token group_id [page] [count] [order]
     * return {
     * "status":"success",
     * "info":{
     * "list":[
     * {
     * "topic_id":"话题ID",
     * "topic_title":"话题标题",
     * "pub_uid":"发表者用户ID",
     * "pub_nick":"发表者用户昵称",
     * "pub_head":"发表者用户头像",
     * "reply_count":"回复评论数",
     * "topic_content":"话题内容",
     * "create_time":"发表时间",
     * "reply_time":"最后评论时间"
     * },
     * ......
     * ]
     * }
     * }
     * @param $group_id
     * @return string
     */
    public function my_topic($group_id)
    {
        $response = $this->get(self::Prefix . __FUNCTION__, $group_id);
        if (false != $response) {
            return $this->toTopicList($response);
        } else {
            return "error";
        }
    }

    /**
     * GET 获取全站/机构号热门话题列表
     * access_token [page] [count] [organ_userid](    机构号易班ID默认表示获取全站)
     * return {
     * "status":"success",
     * "info":{
     * "list":[
     * {
     * "topic_id":"话题ID",
     * "topic_title":"话题标题",
     * "pub_uid":"发表者用户ID",
     * "pub_nick":"发表者用户昵称",
     * "pub_head":"发表者用户头像",
     * "reply_count":"回复评论数",
     * "topic_content":"话题内容",
     * "create_time":"发表时间",
     * "reply_time":"最后评论时间"
     * },
     * ......
     * ],
     * "num":"话题总数"
     * }
     * }
     * @param bool $selectOrgan
     * @return string
     */
    public function hot_topic($selectOrgan = false)
    {
        if($selectOrgan){
            $response = $this->get(self::Prefix.__FUNCTION__. ["organ_userid"=>parent::Organ_uid]);
        }else{
            $response = $this->get(self::Prefix . __FUNCTION__);
        }
        if (false != $response) {
            return $this->toTopicList($response);
        } else {
            return "error";
        }
    }

    /**
     * GET 获取指定话题内容
     * access_token [group_id]OR[organ_id] topic_id(话题ID)
     * return {
     * "status":"success",
     * "info":{
     * "topic_id":"话题ID",
     * "topic_title":"话题标题",
     * "pub_uid":"发表者用户ID",
     * "pub_nick":"发表者用户昵称",
     * "pub_head":"发表者用户头像",
     * "reply_count":"回复评论数",
     * "topic_content":"话题内容",
     * "create_time":"发表时间",
     * "reply_time":"最后评论时间"
     * }
     * }
     * @param $topic_id
     * @param null $group_id
     * @param null $organ_id
     * @return string
     */
    public function topic_info($topic_id, $group_id = null, $organ_id = null)
    {
        if (is_null($organ_id)) {
            $response = $this->get(parent::RequestPrefix . self::Prefix . __FUNCTION__, compact("topic_id", "group_id"));
        } else {
            $response = $this->get(parent::RequestPrefix . self::Prefix . __FUNCTION__, compact("topic_id", "organ_id"));
        }
        if (false != $response) {
            return $this->toTopicList($response, false);
        } else {
            return "error";
        }
    }

    public function getPublicTopicInfo($group_id, $topic_id){
        return $this->topic_info($topic_id, $group_id);
    }

    public function getOrganTopicInfo($organ_id, $topic_id){
        return $this->topic_info($topic_id, null, $organ_id);
    }
    /**
     * GET 获取指定话题的评论列表
     * access_token [group_id]OR[organ_id] topic_id [page] [count]
     * return {
     * "status":"success",
     * "info":{
     * "list":[
     * {
     * "topic_id":"话题ID",
     * "comment_id":"评论ID",
     * "pub_uid":"评论者用户ID",
     * "pub_nick":"评论者用户昵称",
     * "pub_head":"评论者用户头像",
     * "comment_content":"评论内容",
     * "reply_list":[
     * {
     * "topic_id":"话题ID",
     * "reply_id":"上级评论ID",
     * "comment_id":"评论ID",
     * "pub_uid":"评论者用户ID",
     * "pub_nick":"评论者用户昵称",
     * "pub_head":"评论者用户头像",
     * "comment_content":"评论内容",
     * "create_time":"评论时间"
     * },
     * ......
     * ],
     * "create_time":"评论时间"
     * },
     * ......
     * ]
     * }
     * }
     * @param $topic_id
     * @param null $group_id
     * @param null $organ_id
     * @return array|string
     */
    public function topic_comment($topic_id, $group_id = null, $organ_id = null)
    {
        if (is_null($organ_id)) {
            $response = $this->get(self::Prefix . __FUNCTION__, compact("topic_id", "group_id"));
        } else {
            $response = $this->get(self::Prefix . __FUNCTION__, compact("topic_id", "organ_id"));
        }
        if (false != $response) {
            return $this->toCommentList($response);
        } else {
            return "error";
        }
    }
    public function getPublicTopicComments($group_id, $topic_id){
        return $this->topic_comment($topic_id, $group_id);
    }

    public function getOrganTopicComments($organ_id, $topic_id){
        return $this->topic_comment($topic_id, null, $organ_id);
    }

    /**
     * POST 在指定机构群/公共群范围发表话题
     * access_token group_id topic_title(<=50) topic_content(<+10000不包含html样式)
     * return {
     * "status":"success",
     * "info":{
     * "status":"发送结果"
     * }
     * }
     * //返回状态说明：true-成功、false-失败
     * @param $group_id
     * @param $topic_title
     * @param $topic_content
     * @return string
     * @internal param Request $request
     */
    public function send_topic($group_id, $topic_title, $topic_content)
    {
        $response = $this->post(self::Prefix . __FUNCTION__, compact("group_id", "topic_content", "topic_title"));
        $response = self::getResult($response);
        if (false != $response) {
            return "SUCCESS";
        } else {
            return "FAIL";
        }
    }

    /**
     * POST 对指定话题发表/回复评论
     * assess_token [group_id]OR[organ_id] topic_id comment_content(<=140) [comment_id](上级评论ID)
     * @param $topic_id
     * @param $comment_content
     * @param null $group_id
     * @param null $organ_id
     * @param null $comment_id
     * @return string
     */
    public function send_comment($topic_id, $comment_content, $group_id = null, $organ_id = null, $comment_id = null)
    {
        if (is_null($organ_id)) {
            if (is_null($comment_id)) {
                $response = $this->post(self::Prefix . __FUNCTION__, compact("group_id", "topic_id", "comment_content"));
            } else {
                $response = $this->post(self::Prefix . __FUNCTION__, compact("group_id", "topic_id", "comment_content", "comment_id"));
            }
        } else {
            if (is_null($comment_id)) {
                $response = $this->post(self::Prefix . __FUNCTION__, compact("organ_id", "topic_id", "comment_content"));
            } else {
                $response = $this->post(self::Prefix . __FUNCTION__, compact("organ_id", "topic_id", "comment_content", "comment_id"));
            }
        }
        if (false != $response) {
            return "SUCCESS";
        } else {
            return "FAIL";
        }
    }

    public function commentTopicInPublicGroup(Request $request){
        return $this->send_comment($request->input('topic'), $request->input('comment'),$request->input("group_id"));
    }

    public function commentTopicInOrganGroup(Request $request){
        return $this->send_comment($request->input('topic'), $request->input('comment'),$request->input("organ_id"));
    }

    public function commentOtherOneInPublicGroup(Request $request){
        return $this->send_comment($request->input('topic'), $request->input('comment'),$request->input("group_id", $request->input("comment_id")));
    }

    public function commentOtherOneInOrganGroup(Request $request){
        return $this->send_comment($request->input('topic'), $request->input('comment'),$request->input("organ_id"), $request->input("comment_id"));
    }

    /**
     * GET 删除当前用户指定机构群/公共群范围发表的话题
     * access_token group_id topic_id
     * return {
     * "status":"success",
     * "info":{
     * "status":"处理结果"
     * }
     * }
     * //返回状态说明：true-成功、false-失败
     * @param $group_id
     * @param $topic_id
     * @return string
     * @internal param Request $request
     */
    public function delete_topic($group_id, $topic_id)
    {
        $response = $this->get(self::Prefix . __FUNCTION__, compact("group_id", "topic_id"));
        if (false != $response) {
            return "SUCCESS";
        } else {
            return "FAIL";
        }
    }

    /**
     * GET 删除当前用户发表的话题评论
     * access_token [group_id]OR[organ_id] topic_id comment_id
     * return {
     * "status":"success",
     * "info":{
     * "status":"处理结果"
     * }
     * }
     * //返回状态说明：true-成功、false-失败
     * @param $topic_id
     * @param $comment_id
     * @param null $group_id
     * @param null $organ_id
     * @return string
     */
    public function delete_comment($topic_id, $comment_id, $group_id = null, $organ_id = null)
    {
        if (is_null($organ_id)) {
            $response = $this->get(self::Prefix . __FUNCTION__, compact("group_id", "topic_id", "comment_id"));
        } else {
            $response = $this->get(self::Prefix . __FUNCTION__, compact("organ_id", "topic_id", "comment_id"));
        }
        if (false != $response) {
            return "SUCCESS";
        } else {
            return "FAIL";
        }
    }

    public function deleteCommentTopicInPublicGroup($group_id, $topic_id, $comment_id){
        return $this->send_comment($topic_id, $comment_id, $group_id);
    }

    public function deleteCommentTopicInOrganGroup($organ_id, $topic_id, $comment_id){
        return $this->send_comment($topic_id, $comment_id, $organ_id);
    }

    public function toGroupList($info, $group)
    {
        $groups = $info->$group;
        $groupList = [];
        foreach ($groups as $group) {
            $groupList[] = [
                "gid" => $group->group_id,//群ID
                "name" => $group->group_name,//群名称
                "icon" => $group->group_icon,//群图标
                "type" => $group->group_type,//群类型
                "id" => $group->adm_uid,//群创建者用户ID
                "nick" => $group->adm_nick,//群创群成员数建者用户昵称
                "num" => $group->group_mamber//群成员数量
            ];
        }
        return $groupList;
    }

    public function toTopicList($info, $mode = true)
    {
        if ($mode) {
            $topics = $info->list;
        } else {
            $topics = $info;
        }
        $topicList = [];
        foreach ($topics as $topic) {
            $topicList[] = [
                "tid" => $topic->topic_id,//话题ID
                "title" => $topic->topic_title,//话题标题
                "id" => $topic->pub_uid,//发表者用户ID
                "nick" => $topic->pub_nick,//发表者用户昵称
                "pic" => $topic->pub_head,//发表者用户头像
                "comments" => $topic->reply_count,//回复评论数
                "content" => $topic->topic_content,//话题内容
                "createTime" => $topic->create_time,//发表时间
                "replyTime" => $topic->reply_time//最后评论时间
            ];
        }
        return $topics;
    }

    protected function toMemberList($info)
    {
        $members = $info->list;
        $memberList = [];
        foreach ($members as $member) {
            $memberList[] = [
                "id" => $member->member_uid,//群成员用户ID
                "nick" => $member->member_nick,//群成员用户昵称
                "pic" => $member->member_head,//群成员用户头像
                "remark" => $member->member_remark//当前用户附加的好友备注
            ];
        }
        return $memberList;
    }

    private function toCommentList($info)
    {
        $comments = $info->reply_list;
        $commentList = [];
        foreach ($comments as $comment) {
            $commentList[] = [
                "tid" => $comment->topic_id,//话题ID
                "rid" => $comment->reply_id,//上级评论ID
                "cid" => $comment->comment_id,//评论ID
                "id" => $comment->pub_uid,//评论者用户ID
                "nick" => $comment->pub_nick,//评论者用户昵称
                "pic" => $comment->pub_head,//评论者用户头像
                "content" => $comment->comment_content,//评论内容
                "createTime" => $comment->create_time//评论时间
            ];
        }
        return $commentList;
    }
}
