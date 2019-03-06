<?php
/**
 * 在线发布配置
 * 通过yaconf扩展实现在线配置
 * 流程：1. cd `APP_PATH`
 *      2. git checkout master
 *      3. git pull --rebase
 *      4. cp {$env}.ini {$env}_bak.ini
 *      5. mv {$env}_bak.ini YACONF_EXTENSION_INI_PATH
 * User: yicheng
 * Date: 2019/1/15
 * Time: 09:35
 */

namespace app\shell;

use app\base\BaseModel;

class Publish
{
    private $_env = null;
    private $_remoteUser = [
        ENV_LOCAL  => 'www',
        ENV_TEST   => 'www',
        ENV_TEST_1 => 'www',
        ENV_TEST_2 => 'www',
        ENV_DEV    => 'www',
        ENV_PROD   => 'www',
    ];

    private $_remoteGroup = [
        ENV_LOCAL  => 'www',
        ENV_TEST   => 'www',
        ENV_TEST_1 => 'www',
        ENV_TEST_2 => 'www',
        ENV_DEV    => 'www',
        ENV_PROD   => 'www',
    ];



    public function __construct($env)
    {
        $this->_env = $env;

        if (!$this->_check()) {
            return BaseModel::error(100101, '发布失败', []);
        }

        return $this;
    }

    /**
     * 发布配置前置动作
     */
    public function beforePublish()
    {
//        system('cd ' . CONFIG_REPO_PATH);
//        system('git checkout master');
//        system('git pull --rebase');
    }

    /**
     * 发布配置完成后执行动作
     */
    public function afterPublish()
    {
        switch ($this->_env) {
            case ENV_LOCAL:
                break;
            default:
                break;
        }
    }

    public function publish()
    {
        $this->beforePublish();

        // do publish
        $this->doPublish();

        $this->afterPublish();

        return BaseModel::error(0, '发布成功', []);
    }

    /**
     * check env
     * @return bool
     */
    public function _check()
    {
        if (!in_array($this->_env, [
            ENV_LOCAL,
            ENV_DEV,
            ENV_TEST,
            ENV_TEST_1,
            ENV_TEST_2,
            ENV_PROD
        ])) {
            return false;
        }

        return true;
    }

    public function doPublish()
    {
        global $GLOBAL_CONFIG;

        $envConfig = $GLOBAL_CONFIG[$this->_env];
        $source = $envConfig['config_repo_path'] . 'yaconf/' . "{$this->_env}.ini";
        $des   = $envConfig['ya_conf_extension_path'] . "{$this->_env}.ini";

        switch ($this->_env) {
            case ENV_LOCAL:
                $bak   = $envConfig['config_repo_path'] . 'yaconf/' . "{$this->_env}_bak.ini";
                copy($source, $bak);
                if (file_exists($des)) {
                    unlink($des);
                }
                rename($bak, $des);
                break;
            case ENV_DEV:
            case ENV_TEST:
            case ENV_TEST_1:
            case ENV_TEST_2:
            case ENV_PROD:
                $hosts = $envConfig['web_server_hosts'];
                $user  = $this->_remoteUser[$this->_env];
                foreach ($hosts as $host) {
                    exec("scp -q {$source} {$user}@{$host}:{$des}");
                }
                break;
            default:
                break;
        }

        return BaseModel::error(0, '发布成功', []);
    }
}