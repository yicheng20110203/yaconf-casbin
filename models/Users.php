<?php
/**
 * 用户登录服务
 * Created by PhpStorm.
 * User: yicheng
 * Date: 2019/1/11
 * Time: 13:45
 */

namespace app\models;

use app\base\BaseModel;
use app\config\ErrorCode;
use Casbin\Enforcer;

class Users extends BaseModel
{
    private $_sessionDto = null;

    public function __construct()
    {
        $this->_sessionDto = new SessionDto();
    }

    /**
     * 登录服务
     *
     * @param       $username
     * @param       $password
     * @param array $ext
     *
     * @return array
     * @throws \Casbin\Exceptions\CasbinException
     */
    public function login($username, $password, $ext = [])
    {
        $e   = new Enforcer(CONFIG_PATH . 'define/users_model.conf', CONFIG_PATH . 'define/users_policy.csv');
        $sub = $username;
        $obj = 'home';
        $act = 'login';

        //check auth
        if ($e->enforce($sub, $obj, $act) === true) {
            // check password
            $e = new Enforcer(CONFIG_PATH . 'define/users_model.conf', CONFIG_PATH . 'define/users_password_policy.csv');
            if ($e->enforce($username, 'auth', trim($password)) === true) {
                if (session_status() != PHP_SESSION_ACTIVE) {
                    session_start();
                }

                $token = self::createSessionToken($username, $password);
                $_SESSION[$token] = [
                    $this->_sessionDto->sessionTokenKey => $token,
                    $this->_sessionDto->username        => $username,
                    $this->_sessionDto->loginTime       => time(),
                ];

                return self::error(0, 'success', $_SESSION[$token]);
            }

            return self::getErrorMap(ErrorCode::LOGIN_PASS_ERROR);
        }

        return self::getErrorMap(ErrorCode::LOGIN_AUTH_FAIL);
    }

    /**
     * 构造登录成功后的session缓存，session生命周期为浏览器关闭前的默认生命周期
     *
     * @param $username
     * @param $password
     *
     * @return string
     */
    public static function createSessionToken($username, $password)
    {
        return md5($username . '_' . $password . '_' . time());
    }

    public function autoLogin($ext = [])
    {

    }
}