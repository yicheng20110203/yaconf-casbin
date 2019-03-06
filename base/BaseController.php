<?php
/**
 * Created by PhpStorm.
 * User: yicheng
 * Date: 2019/1/10
 * Time: 16:11
 */

namespace app\base;

use app\models\Cookie;
use app\models\SessionDto;
use yii\web\Controller;

class BaseController extends Controller
{
    public $casbinSub = '';
    public $casbinObj = '';
    public $casbinAct = '';

    public $loginRequestURI = '/home/index';
    public $homeURI = '/home/home';

    public $whiteListURI = [
        '/home/index',
        '/home/login',
        '/home/auto-login',
        '/'
    ];

    /**
     * @var \app\models\Cookie
     */
    public $cookie = null;

    /**
     * @var \app\models\SessionDto
     */
    public $session = null;

    public function init()
    {
        $this->cookie = new Cookie();
        $this->session = new SessionDto();
        $this->_validateToken();
        return parent::init();
    }

    private function _validateToken()
    {
        $cookie   = $_COOKIE;
        $token    = isset($cookie[$this->cookie->cookieKey]) ? $cookie[$this->cookie->cookieKey] : '';
        $username = isset($cookie[$this->cookie->username]) ? $cookie[$this->cookie->username] : '';

        $requestURI = $_SERVER['REQUEST_URI'];
        $tmpRequest = explode('?', $requestURI);

        if (!empty($token) && !empty($username)) {
            if (session_status() != PHP_SESSION_ACTIVE) {
                session_start();
            }
            $session = $_SESSION;
            $saveSession = isset($session[$token]) ? $session[$token] : [];
            if (!isset($saveSession[$this->session->username]) || ($saveSession[$this->session->username] != $username)) {
                if (!in_array($tmpRequest[0], $this->whiteListURI)) {
                    $this->redirect($this->loginRequestURI);
                }
            }

            if (in_array($requestURI, $this->whiteListURI)) {
                $this->redirect($this->homeURI);
            }
        }

        if (empty($token) && empty($username)) {
            if (!in_array($tmpRequest[0], $this->whiteListURI)) {
                $this->redirect($this->loginRequestURI);
            }
        }
    }

    public function check($data)
    {
        return BaseModel::check($data);
    }

    public function error($code, $msg, $data = [])
    {
        return BaseModel::error($code, $msg, $data);
    }

    public function response($data = [], $exit = false)
    {
        return BaseModel::response($data, $exit);
    }

    public function getErrorMsg($code)
    {
        return BaseModel::getErrorMsg($code);
    }

    public function getErrorMap($code)
    {
        return BaseModel::getErrorMap($code);
    }
}