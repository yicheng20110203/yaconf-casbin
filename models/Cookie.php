<?php
/**
 * Created by PhpStorm.
 * User: yicheng
 * Date: 2019/1/11
 * Time: 16:03
 */
namespace app\models;

class Cookie
{
    public $cookieKey = 'token';
    public $expireTime = 3600;
    public $username = 'username';
}