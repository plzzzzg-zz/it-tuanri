<?php
/**
 * Created by PhpStorm.
 * User: 李志鹏
 */
namespace App\Http\Controllers\Yiban;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    const Prefix = "data/";

    /**
     * 访问权限：高级权限、校级权限、合作权限
     * POST 上传文件至资料库
     * access_token file_name(原始文件名) file_tmp(应用端完整路径的临时文件（最大上传10M，范例“@/tmp/xxxx”）) share_type(分享方式默认1) share_content(分享范围)
     * return {
     * "status":"success",
     * "info":{
     * "view_url":"下载地址"
     * }
     * }
     * //下载地址仅对上传者和被分享者有效
     *
     * 注意：请求必须用POST方式模拟表单提交，并且注意采用multipart/form-data编码方式
     * 适当调整编程语言环境配置文件“表单提交最大数据”项（如上传允许范围内的文件非接口原因失败）
     * 根据用户的平均上行带宽，需合理设置请求超时时限，建议设置300秒
     * 轻应用类型必须检测用户是否在移动设备上使用，并给出类似“文件较大，建议使用wifi”的说明提示
     *
     * 分享方式
     * 1.私密（share_content参数无需设置）
     * 2.所有好友（share_content参数无需设置）
     * 3.指定加入的公共群/机构群（share_content参数设置群ID，多个群以半角逗号分隔）
     * 4.指定用户（share_content参数设置易班用户ID，多个用户以半角逗号分隔）
     * 5.公开（share_content参数无需设置）
     * @param Request $request
     */
    public function upload(Request $request)
    {
        $file = $request->file;
        echo $file->getClientOriginalName()."  ".$file->getPathname();
    }
}
