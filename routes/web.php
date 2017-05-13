<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});
// Route::get('/signup','Controller@signup');
//Route::post('/store','Controller@store');
//Route::get('/group/{id}/edit','Controller@edit');
Route::post('/search','Controller@search');
Route::resource('group','Controller');


//以下为易班接口调用路由
Route::get('yiban/oauth', 'Yiban\OauthController@auth')->name('yiban_oauth');//申请授权入口
Route::get('yiban/access', 'Yiban\OauthController@access_token');//保存授权码
Route::get('yiban/reset', 'Yiban\OauthController@reset_token');//取消授权
Route::group(['prefix' => 'yiban', 'middleware' => 'yiban'], function () {
    Route::get('profile', 'Yiban\UserController@me');//获取用户基本信息
    Route::get('other/{id}', 'Yiban\UserController@other');//获取他人信息
    Route::get('profile/aboutMe', 'Yiban\UserController@real_me');//获取用户真实资料
    Route::get('profile/identity', 'Yiban\UserController@verify_me');//得知用户认证信息
    Route::get('other/{id}/hasIdentity', 'Yiban\UserController@is_real');//判断某人是否已认证

    Route::post('uploadFile', 'Yiban\DataController@upload');//上传文件至资料库

    Route::get('friend', 'Yiban\FriendController@me_list');//获取用户的朋友列表
    Route::get('friend/{friend}/is', 'Yiban\FriendController@check');//判断朋友关系
    Route::post('friend/make', 'Yiban\FriendController@apply');//好友申请
    Route::get('friend/{friend}/break', 'Yiban\FriendController@remove');//解除好友关系
    Route::get('friend/recommend', 'Yiban\FriendController@recommend');//推荐好友

    Route::get('publicGroups', 'Yiban\GroupController@public_group');//查看用户加入的公共群
    Route::get('organGroups', 'Yiban\GroupController@organ_group');//查看用户加入的机构群
    Route::get('groupInfo/{group_id}', 'Yiban\GroupController@group_info');//获取指定群的信息
    Route::get('myGroups', 'Yiban\GroupController@my_group');//用户创建的群
    Route::get('myTopics', 'Yiban\GroupController@my_topic');//获取用户参与过的话题
    Route::get('groupInfo/{group_id}/members', 'Yiban\GroupController@group_member');//获取指定群的群成员列表
    Route::get('groupInfo/{group_id}/topics', 'Yiban\GroupController@group_topic');//获取指定群的话题
    Route::get('schoolTopics', 'Yiban\GroupController@organ_topic');//获取用户对应机构号的话题
    Route::get('publicGroup/topics', 'Yiban\GroupController@getPublicTopicInfo');//获取指定公共群的话题信息
    Route::get('organGroup/topics', 'Yiban\GroupController@getOrganTopicInfo');//获取指定机构群的话题信息
    Route::get('publicGroup/{group_id}/{topic_id}/comments', 'Yiban\GroupController@getPublicTopicComments');//获取指定公共群的话题的评论列表
    Route::get('organGroup/{organ_id}/{topic_id}/comments', 'Yiban\GroupController@getOrganTopicComments');//获取指定机构群的话题的评论列表
    Route::get('publicGroup/delete/{group_id}/{topic_id}/{comment_id}', 'Yiban\GroupController@deleteCommentTopicInPublicGroup');//删除指定公共群的话题评论
    Route::get('organGroup/delete/{group_id}/{topic_id}/{comment_id}', 'Yiban\GroupController@deleteCommentTopicInOrganGroup');//删除指定机构群的话题评论
    Route::get('myTopics/{group_id}/{topic_id}/delete', 'Yiban\GroupController@delete_topic');//删除指定群的话题
    Route::post('sendTopic', 'Yiban\GroupController@send_topic');//发布话题
    Route::post('sendComment', 'Yiban\GroupController@send_comment');//发布评论
    Route::post('commentTopicInPublicGroup', 'Yiban\GroupController@commentTopicInPublicGroup');//评论指定公共群的话题
    Route::post('commentTopicInOrganGroup', 'Yiban\GroupController@commentTopicInOrganGroup');//评论指定机构群的话题
    Route::post('commentOtherOneInPublicGroup', 'Yiban\GroupController@commentOtherOneInPublicGroup');//评论指定公共群的某条评论
    Route::post('commentOtherOneInOrganGroup', 'Yiban\GroupController@commentOtherOneInOrganGroup');//评论指定机构群的某条评论
    Route::get('deleteCommentInPublicGroup/{group_id}/{topic_id}/{comment_id}', 'Yiban\GroupController@deleteCommentTopicInPublicGroup');//删除指定公共群的某条评论
    Route::get('deleteCommentInOrganGroup/{group_id}/{topic_id}/{comment_id}', 'Yiban\GroupController@deleteCommentTopicInOrganGroup');//删除指定机构群的某条评论

    Route::get('pay/{pay}', 'Yiban\PayController@yb_wx');//支付网薪
    Route::get('trade', 'Yiban\PayController@trade_wx');//交易网薪

    Route::get('activity', 'Yiban\SchoolController@user_active');//获取用户今日活跃度
    Route::get('{group_id}/egpa', 'Yiban\SchoolController@egpa');//获取指定群活跃度

    Route::get('myShares', 'Yiban\ShareController@me_list');//获取用户动态
    Route::get('otherShares', 'Yiban\ShareController@other_list');//获取朋友动态
    Route::get('getShareInfo/{id}', 'Yiban\ShareController@info_share');//获取指定动态信息
    Route::post('myShares/send', 'Yiban\ShareController@send_share');//发表动态
    Route::post('myShares/comment', 'Yiban\ShareController@send_comment');//对指定动态发表评论
    Route::get('praise/{$id}', 'Yiban\ShareController@expressPraise');//对指定动态点赞
    Route::get('pity/{$id}', 'Yiban\ShareController@expressPity');//对指定动态同情
});