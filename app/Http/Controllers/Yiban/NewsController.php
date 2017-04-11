<?php
/**
 * Created by PhpStorm.
 * User: 李志鹏
 */
namespace App\Http\Controllers\Yiban;


class NewsController extends Controller
{
    const Prefix = "news/";

    /**
     * GET 获取易班推荐资讯
     * access_token [page] [count]
     * return {
     * "status":"success",
     * "info":{
     * "list":[
     * {
     * "push_title":"资讯标题",
     * "push_href":"资讯链接",
     * "push_pic":"资讯图片链接",//资讯可能存在无图情况，应用端需自行判断
     * "create_time":"发表时间"
     * },
     * ......
     * ]
     * }
     * }
     */
    public function yb_push()
    {
        $result = $this->get(self::Prefix . __FUNCTION__);
        if (false != $result) {
            $news = $result->list;
            $newsList = [];
            foreach ($news as $new) {
                $newsList[] = [
                    "title" => $new->push_title,
                    "href" => $new->push_href,
                    "pic" => isset($new->push_pic) ? $new->push_pic : "",
                    "createTime" => $new->create_time
                ];
            }
            return $newsList;
        } else {
            return "ERROR";
        }
    }
}
