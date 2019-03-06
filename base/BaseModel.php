<?php
/**
 * Created by PhpStorm.
 * User: yicheng
 * Date: 2019/1/11
 * Time: 10:15
 */
namespace app\base;

use app\config\ErrorCode;
use Casbin\Model\Model;

class BaseModel extends Model
{
    public static function getDbConfig()
    {
        return require_once(CONFIG_PATH . 'db' . '/' . 'mysql.php');
    }

    public static function check($data)
    {
        if (isset($data['code']) && ($data['code'] == 0)) {
            return true;
        }

        return false;
    }

    public static function error($code, $msg, $data)
    {
        return [
            'code' => $code,
            'msg'  => $msg,
            'data' => $data
        ];
    }

    public static function response($data = [], $exit = false)
    {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        if ($exit) {
            exit(0);
        }
    }

    public static function getErrorMap($code)
    {
        $config = ErrorCode::$config;
        if (isset($config[$code])) {
            return [
                'code' => $code,
                'msg'  => $config[$code],
                'data' => []
            ];
        }

        return [
            'code' => $code,
            'msg'  => 'undefined error!',
            'data' => []
        ];
    }

    public static function getErrorMsg($code)
    {
        $config = ErrorCode::$config;
        if (isset($config[$code])) {
            return $config[$code];
        }

        return 'undefined error!';
    }
}