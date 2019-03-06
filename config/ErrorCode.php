<?php
/**
 * Created by PhpStorm.
 * User: yicheng
 * Date: 2019/1/11
 * Time: 11:05
 */
namespace app\config;

class ErrorCode
{
    const CASBIN_AUTH_ACTION_ERROR = -100;

    const HAS_NO_AUTH_CODE   = 100;
    const LOGIN_PARAMS_EMPTY = 200;
    const LOGIN_AUTH_FAIL    = 201;
    const LOGIN_PASS_ERROR   = 201;

    public static $config = [
        self::CASBIN_AUTH_ACTION_ERROR => 'casbin认证服务系统错误',
        self::HAS_NO_AUTH_CODE         => '暂无权限',
        self::LOGIN_PARAMS_EMPTY       => '登录参数为空错误',
        self::LOGIN_AUTH_FAIL          => '登录授权认证失败',
        self::LOGIN_PASS_ERROR         => '登录密码错误',
    ];
}