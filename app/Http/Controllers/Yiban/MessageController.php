<?php
/**
 * Created by PhpStorm.
 * User: 李志鹏
 */
namespace App\Http\Controllers\Yiban;

class MessageController extends Controller
{
    const Prefix = "msg/";

    /**
     * POST 向指定用户发送易班站内信应用提醒
     * access_token to_yb_uid(接收方易班用户ID) content(发送的站内信内容最多300字数)
     * @param $to_yb_uid
     * @param $content
     * @internal param Request $request
     * @return string
     */
    public function letter($to_yb_uid, $content)
    {
        $response = $this->post(self::Prefix . __FUNCTION__, compact("to_yb_uid", "content"));
        if (json_decode($response)->status == "success") {
            return "SUCCESS";
        } else {
            return "FAIL";
        }
    }
}
