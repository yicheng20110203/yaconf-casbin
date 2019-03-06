<?php
/**
 * Created by PhpStorm.
 * User: yicheng
 * Date: 2019/1/10
 * Time: 16:13
 */
namespace app\controllers;

use app\base\BaseController;
use app\models\Users;
use app\shell\Publish;
use Yii;

class HomeController extends BaseController
{
    public $layout = 'main';

    /**
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'login';
        Yii::$app->view->params['title'] = '登录';
        return $this->render('index');
    }

    /**
     * @throws \Casbin\Exceptions\CasbinException
     */
    public function actionLogin()
    {
        $username = Yii::$app->request->post('username', '');
        $password = Yii::$app->request->post('password', '');
        $data     = (new Users())->login($username, $password);
        if ($data['code'] == 0) {
            // success
            setcookie($this->cookie->cookieKey, $data['data'][$this->session->sessionTokenKey], $this->cookie->expireTime + time(), '/', null, false, false);
            setcookie($this->cookie->username, $username, $this->cookie->expireTime + time(), '/', null, false, false);
        }

        $this->response($data, true);
    }

    public function actionHome()
    {
        return $this->render('home');
    }

    public function actionPublish()
    {
        global $GLOBAL_CONFIG;
        $env = Yii::$app->request->get('env', 'local');
        $envConfig = $GLOBAL_CONFIG[$env];
        $config = file_get_contents($envConfig['config_repo_path'] . 'yaconf/' . $env . '.ini');

        return $this->render("publish/view", ['config' => $config, 'env' => $env]);
    }

    public function actionSaveConfig()
    {
        $env = Yii::$app->request->post('env', '');
        $obj = new Publish($env);
        if (is_array($obj) && isset($obj['code']) && $this->check($obj)) {
            $this->response($obj, true);
        }

        $rs = $obj->publish();
        $this->response($rs, true);
    }
}