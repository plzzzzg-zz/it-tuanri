<?php
/**
 * Created by PhpStorm.
 * User: 李志鹏
 */

namespace App\Http\Controllers\Yiban;

use Illuminate\Http\Request;
use Curl\Curl;


/**
 * Class OauthController
 * @package App\Http\Yiban
 */
class OauthController extends Controller
{
    /**
     * @var string
     */
    const Prefix = 'oauth/';

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function auth(Request $request)
    {
        $state = str_random();
        $request->session()->flush();
        return redirect("https://openapi.yiban.cn/oauth/authorize?client_id=" . parent::Client_id . "&redirect_uri=" . parent::Redirect_uri . "&state={$state}");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function access_token(Request $request)
    {
        $response = $this->post(self::Prefix . __FUNCTION__, [
            "client_id" => parent::Client_id,
            "client_secret" => parent::Client_secret,
            "redirect_uri" => parent::Redirect_uri,
            "code" => $request->input("code")
        ], false);
        $request->session()->flush();
        if(isset($response->access_token)){
            $request->session()->put(["access_token" => $response->access_token, "userid" => $response->userid, "expires" => $response->expires]);
            /*$user = new UserController();
            $user->access_token = $response->access_token;
            $profile = $user->me();
            session(["profile"=>$profile]);*/
        }
        return redirect()->route('/');//返回首页位置
    }

    /**
     * @return bool
     */
    public function token_info()
    {
        $client_id = parent::Client_id;
        $response = $this->post(parent::RequestPrefix . self::Prefix . __FUNCTION__, compact("client_id"));
        //intval($response == 200) ? "Success." : "Failed.";
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return string
     */
    public function revoke_token(Request $request)
    {
        $client_id = parent::Client_id;
        $response = $this->post(parent::RequestPrefix . self::Prefix . __FUNCTION__, compact("access_token", "client_id"));
        //return intval($response == 200) ? "Success." : "Failed.";
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return string
     */
    public function reset_token(Request $request)
    {
        $dev_uid = parent::Dev_uid;
        $client_secret = parent::Client_secret;
        $client_id = parent::Client_id;
        $response = $this->post(self::Prefix . __FUNCTION__, compact("client_secret", "client_id", "dev_uid"), false);
        //return intval($response == 200) ? "Success." : "Failed.";
        $request->session()->forget("profile");
        return redirect()->back();
    }

}