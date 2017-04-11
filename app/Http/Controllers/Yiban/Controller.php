<?php
/**
 * Created by PhpStorm.
 * User: 李志鹏
 */

namespace App\Http\Controllers\Yiban;

use App\Http\Controllers\Controller as BaseController;
use Curl\Curl;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    /**
     * @var string
     * 接口请求地址
     */
    const RequestPrefix = 'https://openapi.yiban.cn/';

    /**
     * @var string
     * 机构号id
     */
    const Organ_uid = '';
    /**
     * @var string
     * APP_KEY
     */
    const Client_id = '';

    /**
     * @var string
     * APP_SECRET
     */
    const Client_secret = '';

    /**
     * @var string
     * 授权回调地址
     */
    const Redirect_uri = '';

    /**
     * @var string
     * 开发者id
     */
    const Dev_uid = '';

    protected $access_token;

    /**
     * Controller constructor.
     * @param Request $request
     * @internal param $access_token
     */
    public function __construct(Request $request = null)
    {
        $this->access_token = session("access_token", null);
    }

    protected static function getResult(Curl $curl)
    {
        $response = json_decode($curl->response);
        if (isset($response->status) && $response->status == "error") {
            //return redirect()->route("error");
        } elseif (isset($response->info)) {
            return $response->info;
        } elseif (isset($response->status)) {
            return $response->status;
        } else {
            return $response;
        }
    }

    protected function get(string $target, $group_id = null, $organ_id = null)
    {
        $curl = new Curl();
        $access_token = $this->access_token;
        if (is_array($group_id)) {
            $params = $group_id;
            $params[] = ["access_token" => $access_token];
            $curl->get(self::RequestPrefix . $target, $params);
        } elseif (is_null($group_id) && is_null($organ_id)) {
            $curl->get(self::RequestPrefix . $target, compact("access_token"));
        } elseif (is_null($organ_id)) {
            $curl->get(self::RequestPrefix . $target, compact("access_token", "group_id"));
        } else {
            $curl->get(self::RequestPrefix . $target, compact("access_token", "organ_id"));
        }
        return self::getResult($curl);
    }

    protected function post(string $target, array $params, $addAccess = true)
    {
        $curl = new Curl();
        if ($addAccess) {
            $params[] = ["access_token" => $this->access_token];
        }
        $curl->post(self::RequestPrefix . $target, $params);
        return self::getResult($curl);
    }
}
