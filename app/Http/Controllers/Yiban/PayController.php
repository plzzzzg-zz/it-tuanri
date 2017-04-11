<?php
/**
 * Created by PhpStorm.
 * User: 李志鹏
 */
namespace App\Http\Controllers\Yiban;

use Curl\Curl;
use Illuminate\Http\Request;

class PayController extends Controller
{
    const Prefix = "pay/";


    /**
     * 访问权限：校级权限
     * GET 当前用户网薪支付
     * access_token pay(支付网薪数)
     * return {
     * "status":"success",
     * "info":"返回状态"
     * }
     * //返回状态说明：true-成功、false-失败
     * @param $pay
     * @return string
     * @internal param Request $request
     */
    public function yb_wx($pay)
    {
        $access_token = $this->access_token;
        $curl = new Curl();
        $curl->get(parent::RequestPrefix . self::Prefix . __FUNCTION__, compact("access_token", "pay"));
        return $this->getResult($curl->response);
    }

    /**
     * 访问权限：高级权限、校级权限、合作权限
     * GET 当前用户网薪交易
     * access_token pay sign_back yb_userid
     * return ......
     * @param Request $request
     * @return string
     * @internal param $pay
     * @internal param $sign_back
     * @internal param $yb_userid
     * @internal param Request $request
     */
    public function trade_wx(Request $request)
    {
        $pay = $request->input("pay");
        $sign_back = $request->input("sign");
        $yb_userid = $request->input("with");
        $access_token = $this->access_token;
        $curl = new Curl();
        $curl->get(parent::RequestPrefix . self::Prefix . __FUNCTION__, compact("access_token", "pay", "sign_back", "yb_userid"));
        return $this->getResult($curl->response);
    }
}
